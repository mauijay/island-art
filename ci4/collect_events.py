#!/usr/bin/env python3
"""
Hawaiian Art Event Collection Script
Collects art events from various Hawaiian cultural institutions
"""

import logging
import os
import re
import sys
import time
from datetime import datetime, timedelta

import feedparser
import mysql.connector
import pandas as pd
import requests
from bs4 import BeautifulSoup

# Configure logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')
logger = logging.getLogger(__name__)

# -------------------------------
# CONFIG: define sources to fetch
# -------------------------------

sources = [
    {
        "name": "Honolulu Museum of Art",
        "url": "https://honolulumuseum.org/events",
        "island": "Oahu",
        "type": "scrape"
    },
    {
        "name": "Honolulu Museum of Art – On at HoMA (RSS)",
        "url": "https://honolulumuseum.org/events/rss",
        "island": "Oahu",
        "type": "rss"
    },
    {
        "name": "Volcano Art Center",
        "url": "https://volcanoartcenter.org/home/events/",
        "island": "Big Island",
        "type": "scrape"
    },
    {
        "name": "Hui Noʻeau Visual Arts Center",
        "url": "https://huinoeau.com/exhibitions",
        "island": "Maui",
        "type": "scrape"
    },
    {
        "name": "First Friday Honolulu",
        "url": "https://www.firstfridayhawaii.com/calendar.html",
        "island": "Oahu",
        "type": "scrape"
    },
    {
        "name": "Hawaii Watercolor Society",
        "url": "https://www.hawaiiwatercolorsociety.org/calendar",
        "island": "Oahu",
        "type": "scrape"
    },
    {
        "name": "University of Hawaiʻi Art Dept",
        "url": "https://hawaii.edu/art/exhibitions-events-museum/",
        "island": "Oahu",
        "type": "scrape"
    },
    {
        "name": "Capitol Modern",
        "url": "https://www.capitolmodern.org/exhibitions",
        "island": "Oahu",
        "type": "scrape"
    }
]

class EventCollector:
    def __init__(self):
        # Try to load database config from .env file
        self.db_config = self._load_db_config()
        self.headers = {
            'User-Agent': 'Mozilla/5.0 (compatible; Island Art News Event Collector/1.0)'
        }
        self.stats = {'total_collected': 0, 'new_events': 0, 'duplicates': 0, 'errors': 0}

    def _load_db_config(self):
        """Load database configuration from .env file or use defaults"""
        config = {
            'host': 'localhost',
            'user': 'root',
            'password': '',
            'database': 'island_art'
        }

        # Try to read from .env file
        env_path = os.path.join(os.path.dirname(__file__), '.env')
        if os.path.exists(env_path):
            try:
                with open(env_path, 'r') as f:
                    for line in f:
                        if line.startswith('database.default.hostname'):
                            config['host'] = line.split('=')[1].strip()
                        elif line.startswith('database.default.username'):
                            config['user'] = line.split('=')[1].strip()
                        elif line.startswith('database.default.password'):
                            config['password'] = line.split('=')[1].strip()
                        elif line.startswith('database.default.database'):
                            config['database'] = line.split('=')[1].strip()
            except Exception as e:
                logger.warning(f"Could not read .env file: {e}")

        return config

    def connect_db(self):
        """Connect to MySQL database"""
        try:
            return mysql.connector.connect(**self.db_config)
        except Exception as e:
            logger.error(f"Database connection failed: {e}")
            return None

    def clean_text(self, txt):
        """Clean and normalize text"""
        if not txt:
            return ""
        return re.sub(r"\s+", " ", txt.strip())

    def try_parse_date(self, txt):
        """Attempt to parse date from text. Return ISO (YYYY-MM-DD) or None."""
        if not txt or txt.strip() == "TBA" or txt.strip() == "":
            return None

        # Clean the text first
        txt = re.sub(r'\s+', ' ', txt.strip())

        # Common date patterns to look for
        date_patterns = [
            r'(\w+ \d{1,2}, \d{4})',  # January 15, 2024
            r'(\d{1,2}\/\d{1,2}\/\d{4})',  # 01/15/2024
            r'(\d{4}-\d{1,2}-\d{1,2})',  # 2024-01-15
            r'(\w+ \d{1,2})',  # January 15 (current year)
            r'(\d{1,2}-\d{1,2}-\d{4})',  # 15-01-2024
            r'(\d{1,2} \w+ \d{4})',  # 15 January 2024
        ]

        # Try to extract date using patterns
        for pattern in date_patterns:
            match = re.search(pattern, txt, re.IGNORECASE)
            if match:
                date_str = match.group(1)
                parsed_date = self._parse_date_string(date_str)
                if parsed_date:
                    return parsed_date

        # If no specific pattern found, try parsing the whole string
        return self._parse_date_string(txt)

    def _parse_date_string(self, date_str):
        """Try multiple date formats to parse a date string"""
        if not date_str:
            return None

        # Add current year to partial dates
        current_year = datetime.now().year

        fmts = [
            "%B %d, %Y",      # January 15, 2024
            "%b %d, %Y",      # Jan 15, 2024
            "%Y-%m-%d",       # 2024-01-15
            "%m/%d/%Y",       # 01/15/2024
            "%d/%m/%Y",       # 15/01/2024
            "%d-%m-%Y",       # 15-01-2024
            "%d %B %Y",       # 15 January 2024
            "%d %b %Y",       # 15 Jan 2024
            "%B %d",          # January 15 (add current year)
            "%b %d",          # Jan 15 (add current year)
        ]

        for fmt in fmts:
            try:
                if "%Y" not in fmt:  # No year specified, add current year
                    date_str_with_year = f"{date_str}, {current_year}"
                    parsed = datetime.strptime(date_str_with_year, fmt + ", %Y")
                else:
                    parsed = datetime.strptime(date_str, fmt)

                # Only return dates that are reasonable (not too far in past/future)
                if parsed.year >= current_year - 1 and parsed.year <= current_year + 2:
                    return parsed.strftime("%Y-%m-%d")
            except Exception:
                continue

        return None

    def parse_rss(self, source):
        """Parse RSS / feed entries."""
        events = []
        try:
            logger.info(f"Parsing RSS feed: {source['name']}")
            d = feedparser.parse(source["url"])

            for e in d.entries:
                title = self.clean_text(e.get("title", ""))
                if not title:
                    continue

                link = e.get("link")
                published = e.get("published") or e.get("pubDate")
                start_date = None

                if published:
                    try:
                        dt = datetime(*e.published_parsed[:6])
                        start_date = dt.strftime("%Y-%m-%d")
                    except Exception:
                        pass

                events.append({
                    "title": title,
                    "venue": source["name"],
                    "island": source["island"],
                    "start_date": start_date,
                    "end_date": None,
                    "description": self.clean_text(e.get("summary", "")),
                    "url": link,
                    "location": source["name"]
                })

        except Exception as e:
            logger.error(f"Error parsing RSS {source['name']}: {e}")
            self.stats['errors'] += 1

        return events

    def parse_scrape(self, source):
        """Scrape events from a site. Customized per site."""
        events = []
        logger.info(f"Scraping {source['name']} ...")

        try:
            resp = requests.get(source["url"], timeout=15, headers=self.headers)
            resp.raise_for_status()
            soup = BeautifulSoup(resp.text, "html.parser")

            # Site-specific scraping logic
            if "huinoeau.com" in source["url"]:
                events.extend(self._scrape_hui_noeau(soup, source))
            elif "volcanoartcenter.org" in source["url"]:
                events.extend(self._scrape_volcano_art_center(soup, source))
            elif "honolulumuseum.org" in source["url"]:
                events.extend(self._scrape_honolulu_museum(soup, source))
            elif "firstfridayhawaii.com" in source["url"]:
                events.extend(self._scrape_first_friday(soup, source))
            elif "hawaiiwatercolorsociety.org" in source["url"]:
                events.extend(self._scrape_watercolor_society(soup, source))
            elif "hawaii.edu" in source["url"]:
                events.extend(self._scrape_uh_art(soup, source))
            elif "capitolmodern.org" in source["url"]:
                events.extend(self._scrape_capitol_modern(soup, source))
            else:
                events.extend(self._scrape_generic(soup, source))

            # Add a small delay to be respectful
            time.sleep(2)

        except Exception as e:
            logger.error(f"Error scraping {source['name']}: {e}")
            self.stats['errors'] += 1

        return events

    def _scrape_hui_noeau(self, soup, source):
        """Specific scraping for Hui Noʻeau Visual Arts Center"""
        events = []
        for item in soup.select(".exhibition, .exhibitions li, .exhibit, .event-item, .event, .post"):
            title = self.clean_text(item.get_text())
            if not title or len(title) < 5:
                continue

            # Try multiple ways to find date information
            start_date = None
            item_text = item.get_text()

            # Look for date in different parts of the text
            date_match = re.search(r'([A-Za-z]+ \d{1,2}, \d{4})', item_text)
            if not date_match:
                date_match = re.search(r'(\d{1,2}\/\d{1,2}\/\d{4})', item_text)
            if not date_match:
                date_match = re.search(r'([A-Za-z]+ \d{1,2})', item_text)

            if date_match:
                start_date = self.try_parse_date(date_match.group(1))

            a = item.find("a", href=True)
            url = a["href"] if a else source["url"]
            if url and not url.startswith('http'):
                url = f"https://huinoeau.com{url}"

            events.append({
                "title": title[:255],  # Limit title length
                "venue": source["name"],
                "island": source["island"],
                "start_date": start_date,
                "end_date": None,
                "description": "",
                "url": url,
                "location": source["name"]
            })
        return events

    def _scrape_volcano_art_center(self, soup, source):
        """Specific scraping for Volcano Art Center"""
        events = []
        for item in soup.select(".event, .calendar-event, .exhibition, .post, .entry"):
            title = ""
            for tag in ["h2", "h3", ".event-title", "a"]:
                elem = item.select_one(tag)
                if elem:
                    title = self.clean_text(elem.get_text())
                    break

            if not title or len(title) < 5:
                continue

            # Enhanced date parsing
            start_date = None
            item_text = item.get_text()

            # Try multiple date patterns
            for pattern in [r'([A-Za-z]+ \d{1,2}, \d{4})', r'(\d{1,2}\/\d{1,2}\/\d{4})', r'([A-Za-z]+ \d{1,2})']:
                date_match = re.search(pattern, item_text)
                if date_match:
                    start_date = self.try_parse_date(date_match.group(1))
                    if start_date:
                        break

            a = item.find("a", href=True)
            url = a["href"] if a else source["url"]

            events.append({
                "title": title[:255],
                "venue": source["name"],
                "island": source["island"],
                "start_date": start_date,
                "end_date": None,
                "description": "",
                "url": url,
                "location": source["name"]
            })
        return events

    def _scrape_generic(self, soup, source):
        """Generic fallback scraping method with improved date parsing"""
        events = []
        for item in soup.find_all(["div", "li", "article"], class_=re.compile("event|calendar|listing|card|item", re.I)):
            title = ""
            for tag in ["h2", "h3", "h4", "a", "span"]:
                elem = item.find(tag)
                if elem:
                    title = self.clean_text(elem.get_text())
                    break

            if not title:
                title = self.clean_text(item.get_text())[:100]

            if not title or len(title) < 5:
                continue

            # Enhanced date extraction
            start_date = None
            item_text = item.get_text()

            # Try multiple date patterns in order of preference
            date_patterns = [
                r'([A-Za-z]+ \d{1,2}, \d{4})',    # January 15, 2024
                r'(\d{1,2}\/\d{1,2}\/\d{4})',     # 01/15/2024
                r'(\d{4}-\d{1,2}-\d{1,2})',       # 2024-01-15
                r'([A-Za-z]+ \d{1,2})',           # January 15
                r'(\d{1,2}-\d{1,2}-\d{4})',       # 15-01-2024
                r'(\d{1,2} [A-Za-z]+ \d{4})',     # 15 January 2024
            ]

            for pattern in date_patterns:
                date_match = re.search(pattern, item_text)
                if date_match:
                    start_date = self.try_parse_date(date_match.group(1))
                    if start_date:
                        break

            a = item.find("a", href=True)
            url = a["href"] if a else source["url"]

            events.append({
                "title": title[:255],
                "venue": source["name"],
                "island": source["island"],
                "start_date": start_date,
                "end_date": None,
                "description": "",
                "url": url,
                "location": source["name"]
            })
        return events

    # Add other specific scrapers as needed
    def _scrape_honolulu_museum(self, soup, source):
        return self._scrape_generic(soup, source)

    def _scrape_first_friday(self, soup, source):
        return self._scrape_generic(soup, source)

    def _scrape_watercolor_society(self, soup, source):
        return self._scrape_generic(soup, source)

    def _scrape_uh_art(self, soup, source):
        return self._scrape_generic(soup, source)

    def _scrape_capitol_modern(self, soup, source):
        return self._scrape_generic(soup, source)

    def save_event(self, event_data):
        """Save event to database"""
        conn = self.connect_db()
        if not conn:
            return False

        try:
            cursor = conn.cursor()

            # Skip events without start_date as they're required
            if not event_data.get('start_date'):
                logger.debug(f"Skipping event without date: {event_data.get('title', 'Unknown')}")
                return True

            # Check if event already exists
            check_sql = """
                SELECT id FROM events
                WHERE title = %s AND venue_name = %s AND start_date = %s
            """
            cursor.execute(check_sql, (
                event_data['title'],
                event_data['venue'],
                event_data['start_date']
            ))

            if cursor.fetchone():
                self.stats['duplicates'] += 1
                return True

            # Map island names to database format (venue_island enum values)
            island_map = {
                'Oahu': 'Oahu',
                'Big Island': 'Big Island',
                'Maui': 'Maui',
                'Kauai': 'Kauai',
                'Molokai': 'Molokai',
                'Lanai': 'Lanai'
            }

            island_db = island_map.get(event_data['island'], 'Oahu')

            # Insert new event
            insert_sql = """
                INSERT INTO events (
                    gallery_id, organizer_id, title, slug, description,
                    start_date, end_date, venue_name, venue_address, venue_island,
                    status, is_featured,
                    created_at, updated_at
                ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
            """

            # Create a simple slug from the title
            slug = event_data['title'][:100].lower().replace(' ', '-').replace(',', '').replace('.', '')
            slug = re.sub(r'[^a-z0-9\-]', '', slug)

            cursor.execute(insert_sql, (
                None,  # gallery_id (NULL)
                None,  # organizer_id (NULL)
                event_data['title'][:255],  # Ensure title fits in database
                slug[:255],  # slug
                event_data.get('description', '')[:1000],  # Limit description
                event_data['start_date'],
                event_data.get('end_date'),
                event_data['venue'][:255],  # venue_name
                event_data.get('location', '')[:255],  # venue_address
                island_db,  # venue_island
                'published',  # status
                0,  # is_featured
                datetime.now(),
                datetime.now()
            ))

            conn.commit()
            self.stats['new_events'] += 1
            logger.info(f"Saved event: {event_data['title']}")
            return True

        except Exception as e:
            logger.error(f"Error saving event: {e}")
            self.stats['errors'] += 1
            return False
        finally:
            conn.close()

    def collect_events(self):
        """Main method to collect events from all sources"""
        logger.info("🌺 Starting Hawaiian art event collection...")
        start_time = datetime.now()

        all_events = []

        for source in sources:
            try:
                logger.info(f"Processing: {source['name']}")

                if source["type"] == "rss":
                    events = self.parse_rss(source)
                elif source["type"] == "scrape":
                    events = self.parse_scrape(source)
                else:
                    events = []

                all_events.extend(events)
                self.stats['total_collected'] += len(events)

            except Exception as e:
                logger.error(f"Error processing {source['name']}: {e}")
                self.stats['errors'] += 1

        # Deduplicate events using pandas
        if all_events:
            df = pd.DataFrame(all_events)
            df = df.drop_duplicates(subset=["title", "venue", "start_date"])
            df = df[df["title"].str.len() > 5]  # Filter out very short titles

            # Save to database
            for _, event in df.iterrows():
                self.save_event(event.to_dict())

        end_time = datetime.now()
        duration = end_time - start_time

        logger.info("🌴 Event collection completed!")
        logger.info(f"⏱️  Duration: {duration}")
        logger.info(f"📊 Statistics:")
        logger.info(f"   - Total collected: {self.stats['total_collected']}")
        logger.info(f"   - New events saved: {self.stats['new_events']}")
        logger.info(f"   - Duplicates skipped: {self.stats['duplicates']}")
        logger.info(f"   - Errors encountered: {self.stats['errors']}")

        return self.stats

def collect_all_events():
    """Legacy function for compatibility with original script"""
    collector = EventCollector()
    stats = collector.collect_events()

    # Also save to CSV for backup/analysis
    try:
        all_events = []
        for source in sources:
            if source["type"] == "rss":
                events = collector.parse_rss(source)
            elif source["type"] == "scrape":
                events = collector.parse_scrape(source)
            else:
                events = []
            all_events.extend(events)

        if all_events:
            df = pd.DataFrame(all_events)
            df = df.drop_duplicates(subset=["title", "venue", "start_date"])
            df = df[df["title"].str.len() > 1]
            df.to_csv("monthly_events.csv", index=False)
            logger.info(f"Backup CSV saved with {len(df)} events")
    except Exception as e:
        logger.warning(f"Could not save backup CSV: {e}")

    return stats

if __name__ == "__main__":
    collect_all_events()
