# 🌺 Hawaiian Art Event Collection System

## Overview

This system automatically collects Hawaiian art events from various cultural institutions across the islands and displays them on a beautiful, dynamic calendar page. The system maintains the existing island-themed design while providing fresh, up-to-date event information weekly.

## 🏗️ System Architecture

### Components

1. **Event Collection Script** (`collect_events.py`)
   - Python script that scrapes Hawaiian cultural institutions
   - Collects events from Downtown Art Center, Volcano Art Center, etc.
   - Stores events in MySQL database with deduplication

2. **CodeIgniter Command** (`app/Commands/CollectEvents.php`)
   - CI4 command interface for running the Python script
   - Handles Python detection and error reporting
   - Displays collection statistics

3. **Dynamic Controller** (`app/Controllers/CalendarController.php`)
   - Updated with database integration
   - Provides both static and dynamic calendar views
   - API endpoints for event data

4. **Dynamic Views**
   - `calendar_dynamic.php` - Database-driven calendar maintaining exact design
   - Preserves island color schemes and responsive layouts
   - Features island-based event sections (Oahu, Big Island, Maui)

## 🚀 Setup Instructions

### Prerequisites

- PHP 7.4+ with CodeIgniter 4
- Python 3.6+ with required packages
- MySQL database
- Web server (Apache/Nginx)

### Installation

1. **Database Setup**
   ```bash
   # Events table should already exist from migrations
   php spark migrate
   ```

2. **Python Dependencies**
   ```bash
   pip install requests beautifulsoup4 mysql-connector-python
   ```

3. **Automation Setup**

   **For Linux/Mac:**
   ```bash
   chmod +x setup_cron.sh
   ./setup_cron.sh
   ```

   **For Windows:**
   ```cmd
   setup_cron.bat
   ```

## 🎯 Usage

### Manual Event Collection

```bash
# Run event collection manually
php spark events:collect

# Test the command
php spark list
```

### View Calendar

- **Static Calendar**: `/calendar` (original design)
- **Dynamic Calendar**: `/calendar-dynamic` (database-driven)
- **API Endpoint**: `/api/events` (JSON data)

### Monitor Logs

```bash
# View collection logs
tail -f writable/logs/event_collection.log

# Check for errors
grep -i error writable/logs/event_collection.log
```

## 🗓️ Automation Schedule

- **Frequency**: Every Monday at 9:00 AM
- **Purpose**: Collect fresh events for the upcoming week
- **Log Location**: `writable/logs/event_collection.log`

## 🏝️ Supported Islands & Institutions

### Oahu (Blue Theme)
- Downtown Art Center
- Honolulu Museum of Art
- Hawaii State Art Museum

### Big Island (Green Theme)
- Volcano Art Center
- East Hawaii Cultural Center
- Wailoa Center

### Maui (Purple Theme)
- Maui Arts & Cultural Center
- Hui No'eau Visual Arts Center
- Schaefer International Gallery

## 🎨 Design Features

### Visual Elements
- **Island Color Schemes**: Blue (Oahu), Green (Big Island), Purple (Maui)
- **Gradient Backgrounds**: Maintains current aesthetic appeal
- **Responsive Grid**: 3-column layout on desktop, stacked on mobile
- **Featured Events**: Highlighted section for special exhibitions

### Technical Features
- **Database-Driven**: Dynamic content from events table
- **Event Deduplication**: Prevents duplicate events
- **Island Detection**: Automatic categorization by location
- **Date Formatting**: Human-readable event dates
- **SEO Friendly**: Proper meta tags and structured data

## 📊 Database Schema

### Events Table
```sql
- id (auto-increment)
- title (varchar 255)
- description (text)
- start_date (datetime)
- end_date (datetime)
- location (varchar 255)
- island (enum: oahu, big_island, maui, kauai, molokai, lanai)
- venue (varchar 255)
- image_url (varchar 500)
- event_url (varchar 500)
- is_featured (boolean)
- created_at (timestamp)
- updated_at (timestamp)
```

## 🔧 Configuration

### Event Collection Settings
- **Timeout**: 30 seconds per request
- **Retry Logic**: 3 attempts per institution
- **Rate Limiting**: 2-second delay between requests
- **User Agent**: Respectful bot identification

### Display Settings
- **Events Per Page**: Unlimited (all current events)
- **Featured Limit**: 6 events in grid
- **Date Range**: Current and future events only
- **Sorting**: By start date ascending

## 🚨 Troubleshooting

### Common Issues

1. **Python Script Not Found**
   ```bash
   # Check if Python is in PATH
   python --version
   python3 --version
   
   # Verify script location
   ls -la collect_events.py
   ```

2. **Database Connection Issues**
   ```bash
   # Check database configuration
   cat app/Config/Database.php
   
   # Test database connection
   php spark db:table events
   ```

3. **Permission Issues**
   ```bash
   # Set proper permissions
   chmod +x spark
   chmod 755 writable/logs/
   ```

4. **Cron Job Not Running**
   ```bash
   # Check cron logs
   grep CRON /var/log/syslog
   
   # List current cron jobs
   crontab -l
   ```

### Debug Mode

Enable debug output in the collection command:
```bash
# Add debug flag to command
php spark events:collect --debug
```

## 📝 Development Notes

### Adding New Institutions

1. Update `collect_events.py` with new scraping methods
2. Add institution to supported venues list
3. Test collection and verify data quality
4. Update documentation

### Customizing Design

1. Modify `calendar_dynamic.php` for layout changes
2. Update CSS classes in view file
3. Ensure responsive design is maintained
4. Test across different screen sizes

## 🔐 Security Considerations

- **Rate Limiting**: Respectful scraping intervals
- **Error Handling**: Graceful failure without exposing internals
- **Data Validation**: Sanitize all collected event data
- **Log Security**: Sensitive information not logged

## 📈 Performance

### Optimization Features
- **Database Indexing**: Optimized queries on date and island fields
- **Caching**: Static file caching for improved load times
- **Lazy Loading**: Images loaded as needed
- **Minimal Dependencies**: Lightweight Python requirements

### Monitoring
- **Collection Time**: Typically 2-5 minutes for all institutions
- **Database Growth**: ~50-100 new events per week
- **Log Rotation**: Automatic cleanup of old log files

## 🤝 Contributing

### Code Standards
- Follow CodeIgniter 4 conventions
- PSR-12 coding standards for PHP
- PEP 8 style guide for Python
- Meaningful commit messages

### Testing
```bash
# Run PHP tests
vendor/bin/phpunit

# Test event collection
php spark events:collect --test-mode
```

## 📞 Support

For issues or questions:
1. Check the troubleshooting section
2. Review log files for errors
3. Test individual components
4. Verify configuration settings

---

**Last Updated**: December 2024  
**Version**: 1.0.0  
**Compatibility**: CodeIgniter 4.x, PHP 7.4+, Python 3.6+

🌴 **Aloha!** This system keeps the Hawaiian art community connected with fresh, beautiful event listings every week!