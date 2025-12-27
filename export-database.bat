@echo off
REM Database Export Script for Bansal Lawyers (Batch version)
REM This script exports your MySQL database to a SQL file

echo.
echo ========================================
echo Database Export Script
echo ========================================
echo.

REM Check if .env file exists
if not exist ".env" (
    echo Error: .env file not found!
    echo Please make sure you're in the project root directory.
    pause
    exit /b 1
)

REM XAMPP MySQL path (adjust if your XAMPP is installed elsewhere)
set XAMPP_PATH=C:\xampp
set MYSQLDUMP=%XAMPP_PATH%\mysql\bin\mysqldump.exe

if not exist "%MYSQLDUMP%" (
    echo Error: mysqldump.exe not found at %MYSQLDUMP%
    echo Please update the XAMPP_PATH variable in this script.
    pause
    exit /b 1
)

REM Generate filename with timestamp
for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "YY=%dt:~0,4%"
set "MM=%dt:~4,2%"
set "DD=%dt:~6,2%"
set "HH=%dt:~8,2%"
set "Min=%dt:~10,2%"
set "SS=%dt:~12,2%"
set "timestamp=%YY%%MM%%DD%_%HH%%Min%%SS%"
set "outputFile=database_backup_%timestamp%.sql"

echo Exporting database...
echo Output file: %outputFile%
echo.

REM Note: This batch file requires manual database credentials
REM For automatic reading from .env, use the PowerShell version (export-database.ps1)
REM Or manually set these variables:
set DB_HOST=127.0.0.1
set DB_PORT=3306
set DB_DATABASE=bansal_lawyers
set DB_USERNAME=root
set DB_PASSWORD=

echo Please enter your database credentials:
set /p DB_DATABASE="Database name [%DB_DATABASE%]: "
set /p DB_USERNAME="Username [%DB_USERNAME%]: "
set /p DB_PASSWORD="Password (leave empty if none): "

echo.
echo Exporting database: %DB_DATABASE%

REM Execute mysqldump
if "%DB_PASSWORD%"=="" (
    "%MYSQLDUMP%" -h %DB_HOST% -P %DB_PORT% -u %DB_USERNAME% %DB_DATABASE% > "%outputFile%"
) else (
    "%MYSQLDUMP%" -h %DB_HOST% -P %DB_PORT% -u %DB_USERNAME% -p%DB_PASSWORD% %DB_DATABASE% > "%outputFile%"
)

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ✓ Database exported successfully!
    echo   File: %outputFile%
) else (
    echo.
    echo Error: Database export failed!
    echo Please check your database credentials.
)

echo.
pause


