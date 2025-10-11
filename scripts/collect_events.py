#!/usr/bin/env python3
"""
Hawaii Art Events Collection Script
Collects art events from various Hawaiian cultural institutions and updates the database.
"""

import requests
import json
import mysql.connector
from datetime import datetime, timedelta
import re
from typing import List, Dict, Optional
import logging
from dataclasses import dataclass
import os
from dotenv import load_dotenv

# Load environment variables
load_dotenv()

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('events_collection.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

@dataclass
class Event:
    """Event data structure"""
    title: str
    description: str
    start_date: str
    end_date: Optional[str]
    location: str
    address: Optional[str]
    city: str
    island: str
    event_type: str
    website_url: Optional[str]
    is_featured: bool = False
    contact_email: Optional[str] = None
    contact_phone: Optional[str] = None

class EventCollector:
    """Main event collection class"""
    
    def __init__(self):
        self.db_config = {
            'host': os.getenv('DB_HOST', 'localhost'),
            'user': os.getenv('DB_USER', 'root'),
            'password': os.getenv('DB_PASS', ''),
            'database': os.getenv('DB_NAME', 'sample_island_art'),
            'charset': 'utf8mb4'
        }
        self.events = []
        
    def collect_all_events(self) -> List[Event]:
        """Collect events from all sources"""
        logger.info("Starting event collection from all sources...")
        
        # Collect from various sources
        self.collect_downtown_art_center()
        self.collect_volcano_art_center()
        self.collect_hui_noeau()
        self.collect_maui_arts_center()
        self.collect_hawaii_craftsmen()
        
        logger.info(f"Collected {len(self.events)} events total")
        return self.events
    
    def collect_downtown_art_center(self):
        """Collect events from Downtown Art Center"""
        logger.info("Collecting from Downtown Art Center...")
        try:
            # TODO: Implement actual web scraping/API calls
            # For now, adding sample data structure
            sample_events = [
                Event(
                    title="Hawaiʻi Craftsmen Annual Statewide Exhibition 2025",
                    description="Annual exhibition showcasing the finest contemporary crafts from Hawaii",
                    start_date="2025-10-03",
                    end_date="2025-11-01",
                    location="Downtown Art Center",
                    address="1041 Nuuanu Ave, Honolulu, HI 96817",
                    city="Honolulu",
                    island="Oahu",
                    event_type="exhibition",
                    website_url="https://www.hawaiicraftsmen.org/ASE2025",
                    is_featured=True
                )
            ]
            self.events.extend(sample_events)
            logger.info(f"Added {len(sample_events)} events from Downtown Art Center")
        except Exception as e:
            logger.error(f"Error collecting from Downtown Art Center: {e}")
    
    def collect_volcano_art_center(self):
        """Collect events from Volcano Art Center"""
        logger.info("Collecting from Volcano Art Center...")
        try:
            # TODO: Implement actual web scraping/API calls
            sample_events = [
                Event(
                    title="Hawai'i Nei Invitational: Neʻe­kau",
                    description="Migration/Move with the Seasons - A celebration of seasonal change and cultural movement",
                    start_date="2025-09-01",
                    end_date="2025-09-28",
                    location="Volcano Art Center Gallery",
                    address="Hawaii Volcanoes National Park, HI 96718",
                    city="Volcano",
                    island="Big Island",
                    event_type="exhibition",
                    website_url="https://volcanoartcenter.org/home/events/",
                    is_featured=True
                )
            ]
            self.events.extend(sample_events)
            logger.info(f"Added {len(sample_events)} events from Volcano Art Center")
        except Exception as e:
            logger.error(f"Error collecting from Volcano Art Center: {e}")
    
    def collect_hui_noeau(self):
        """Collect events from Hui Noʻeau Visual Arts Center"""
        logger.info("Collecting from Hui Noʻeau...")
        try:
            # TODO: Implement actual web scraping/API calls
            # Placeholder for Maui events
            pass
        except Exception as e:
            logger.error(f"Error collecting from Hui Noʻeau: {e}")
    
    def collect_maui_arts_center(self):
        """Collect events from Maui Arts & Cultural Center"""
        logger.info("Collecting from Maui Arts Center...")
        try:
            # TODO: Implement actual web scraping/API calls
            # Placeholder for Maui events
            pass
        except Exception as e:
            logger.error(f"Error collecting from Maui Arts Center: {e}")
    
    def collect_hawaii_craftsmen(self):
        """Collect events from Hawaii Craftsmen"""
        logger.info("Collecting from Hawaii Craftsmen...")
        try:
            # TODO: Implement actual web scraping/API calls
            # Placeholder - may be covered by Downtown Art Center
            pass
        except Exception as e:
            logger.error(f"Error collecting from Hawaii Craftsmen: {e}")
    
    def save_events_to_database(self):
        """Save collected events to the database"""
        if not self.events:
            logger.warning("No events to save")
            return
        
        try:
            connection = mysql.connector.connect(**self.db_config)
            cursor = connection.cursor()
            
            for event in self.events:
                # Check if event already exists (by title and start_date)
                check_query = """
                    SELECT id FROM events 
                    WHERE title = %s AND start_date = %s
                """
                cursor.execute(check_query, (event.title, event.start_date))
                
                if cursor.fetchone():
                    logger.info(f"Event already exists: {event.title}")
                    continue
                
                # Generate slug
                slug = self.generate_slug(event.title)
                
                # Insert new event
                insert_query = """
                    INSERT INTO events (
                        title, slug, description, event_type, start_date, end_date,
                        location, address, city, state, country, website_url,
                        is_featured, status, created_at, updated_at
                    ) VALUES (
                        %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s
                    )
                """
                
                values = (
                    event.title,
                    slug,
                    event.description,
                    event.event_type,
                    event.start_date,
                    event.end_date,
                    event.location,
                    event.address,
                    event.city,
                    'Hawaii',
                    'USA',
                    event.website_url,
                    event.is_featured,
                    'approved',
                    datetime.now().strftime('%Y-%m-%d %H:%M:%S'),
                    datetime.now().strftime('%Y-%m-%d %H:%M:%S')
                )
                
                cursor.execute(insert_query, values)
                logger.info(f"Saved event: {event.title}")
            
            connection.commit()
            logger.info(f"Successfully saved {len(self.events)} events to database")
            
        except mysql.connector.Error as e:
            logger.error(f"Database error: {e}")
            if connection:
                connection.rollback()
        finally:
            if connection:
                cursor.close()
                connection.close()
    
    def generate_slug(self, title: str) -> str:
        """Generate URL-friendly slug from title"""
        slug = title.lower()
        slug = re.sub(r'[^a-z0-9\s-]', '', slug)
        slug = re.sub(r'\s+', '-', slug)
        slug = slug.strip('-')
        return slug[:100]  # Limit length

def main():
    """Main execution function"""
    logger.info("Starting Hawaii Art Events Collection")
    
    collector = EventCollector()
    
    # Collect events from all sources
    events = collector.collect_all_events()
    
    # Save to database
    collector.save_events_to_database()
    
    logger.info("Event collection completed successfully")

if __name__ == "__main__":
    main()