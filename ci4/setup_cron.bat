@echo off
:: Setup script for automated event collection on Windows
:: This script helps set up Windows Task Scheduler for Hawaiian art event collection

echo 🌺 Setting up Island Art News - Event Collection Automation (Windows)
echo ====================================================================

:: Get the current directory (project root)
set "PROJECT_ROOT=%~dp0"
set "SPARK_PATH=%PROJECT_ROOT%spark"

:: Remove trailing backslash
if "%PROJECT_ROOT:~-1%"=="\" set "PROJECT_ROOT=%PROJECT_ROOT:~0,-1%"

:: Check if spark file exists
if not exist "%SPARK_PATH%" (
    echo ❌ Error: spark file not found at %SPARK_PATH%
    echo Please run this script from your CI4 project root directory.
    pause
    exit /b 1
)

:: Check if PHP is available
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Error: PHP is not installed or not in PATH
    echo Please install PHP and add it to your PATH to continue.
    pause
    exit /b 1
)

echo ✅ Project root: %PROJECT_ROOT%
echo ✅ Spark command: %SPARK_PATH%

echo.
echo 📅 Windows Task Scheduler Setup
echo ===============================
echo.
echo This script will create a Windows Task Scheduler task to run event collection
echo every Monday at 9:00 AM automatically.
echo.

:: Create the batch file that will be executed by Task Scheduler
set "TASK_BATCH=%PROJECT_ROOT%\run_event_collection.bat"

echo @echo off > "%TASK_BATCH%"
echo cd /d "%PROJECT_ROOT%" >> "%TASK_BATCH%"
echo php spark events:collect ^>^> "%PROJECT_ROOT%\writable\logs\event_collection.log" 2^>^&1 >> "%TASK_BATCH%"

echo ✅ Created task batch file: %TASK_BATCH%
echo.

:: Create the Task Scheduler task
echo 🔧 Creating Windows Task Scheduler task...

schtasks /create /tn "Island Art News - Event Collection" /tr "\"%TASK_BATCH%\"" /sc weekly /d MON /st 09:00 /f

if %errorlevel% equ 0 (
    echo ✅ Task Scheduler job successfully created!
    echo.
    echo 📋 Task Details:
    echo    Name: Island Art News - Event Collection
    echo    Schedule: Every Monday at 9:00 AM
    echo    Command: %TASK_BATCH%
    echo    Log: %PROJECT_ROOT%\writable\logs\event_collection.log
    echo.
    echo 🧪 Test the setup manually:
    echo    cd "%PROJECT_ROOT%"
    echo    php spark events:collect
    echo.
    echo 🌺 Event collection will now run automatically every Monday at 9:00 AM
    echo    This will collect fresh Hawaiian art events for the week!
) else (
    echo ❌ Error: Failed to create Task Scheduler job
    echo You may need to run this script as Administrator
    pause
    exit /b 1
)

echo.
echo 🎯 Next Steps:
echo 1. Test the command manually: php spark events:collect
echo 2. Check logs at: writable\logs\event_collection.log
echo 3. Visit /calendar-dynamic to see the new dynamic calendar
echo 4. Monitor the first automatic run next Monday
echo.
echo 🌴 Aloha! Your Hawaiian art events will now be collected automatically!
echo.
pause