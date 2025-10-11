#!/bin/bash

# Setup script for automated event collection cron job
# This script sets up weekly automation for Hawaiian art event collection

echo "🌺 Setting up Island Art News - Event Collection Automation"
echo "=========================================================="

# Get the current directory (project root)
PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SPARK_PATH="$PROJECT_ROOT/spark"

# Check if spark file exists
if [ ! -f "$SPARK_PATH" ]; then
    echo "❌ Error: spark file not found at $SPARK_PATH"
    echo "Please run this script from your CI4 project root directory."
    exit 1
fi

# Check if Python is available
if ! command -v python3 &> /dev/null && ! command -v python &> /dev/null; then
    echo "❌ Error: Python is not installed or not in PATH"
    echo "Please install Python 3.6+ to continue."
    exit 1
fi

# Make spark executable if needed
chmod +x "$SPARK_PATH"

echo "✅ Project root: $PROJECT_ROOT"
echo "✅ Spark command: $SPARK_PATH"

# Create the cron job command
CRON_COMMAND="0 9 * * 1 cd $PROJECT_ROOT && php spark events:collect >> $PROJECT_ROOT/writable/logs/event_collection.log 2>&1"

echo ""
echo "📅 Cron Job Configuration"
echo "========================="
echo "Schedule: Every Monday at 9:00 AM"
echo "Command: $CRON_COMMAND"
echo ""

# Check if cron job already exists
if crontab -l 2>/dev/null | grep -q "events:collect"; then
    echo "⚠️  Warning: Event collection cron job already exists!"
    echo ""
    echo "Current cron jobs containing 'events:collect':"
    crontab -l 2>/dev/null | grep "events:collect"
    echo ""
    read -p "Do you want to replace it? (y/N): " replace
    
    if [[ $replace =~ ^[Yy]$ ]]; then
        # Remove existing cron job
        crontab -l 2>/dev/null | grep -v "events:collect" | crontab -
        echo "🗑️  Removed existing cron job"
    else
        echo "🚫 Setup cancelled - keeping existing cron job"
        exit 0
    fi
fi

# Add the new cron job
(crontab -l 2>/dev/null; echo "$CRON_COMMAND") | crontab -

if [ $? -eq 0 ]; then
    echo "✅ Cron job successfully added!"
    echo ""
    echo "📋 Current cron jobs:"
    crontab -l
    echo ""
    echo "📝 Log file: $PROJECT_ROOT/writable/logs/event_collection.log"
    echo ""
    echo "🧪 Test the setup manually:"
    echo "   cd $PROJECT_ROOT"
    echo "   php spark events:collect"
    echo ""
    echo "🌺 Event collection will now run automatically every Monday at 9:00 AM"
    echo "   This will collect fresh Hawaiian art events for the week!"
else
    echo "❌ Error: Failed to add cron job"
    exit 1
fi

echo ""
echo "🎯 Next Steps:"
echo "1. Test the command manually: php spark events:collect"
echo "2. Check logs at: writable/logs/event_collection.log"
echo "3. Visit /calendar-dynamic to see the new dynamic calendar"
echo "4. Monitor the first automatic run next Monday"
echo ""
echo "🌴 Aloha! Your Hawaiian art events will now be collected automatically!"