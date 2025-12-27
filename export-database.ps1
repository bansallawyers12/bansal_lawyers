# Database Export Script for Bansal Lawyers
# This script exports your MySQL database to a SQL file

# Get database credentials from .env file
$envFile = ".env"
if (-not (Test-Path $envFile)) {
    Write-Host "Error: .env file not found!" -ForegroundColor Red
    Write-Host "Please make sure you're in the project root directory." -ForegroundColor Yellow
    exit 1
}

# Read .env file
$envContent = Get-Content $envFile
$dbHost = ""
$dbPort = ""
$dbDatabase = ""
$dbUsername = ""
$dbPassword = ""

foreach ($line in $envContent) {
    if ($line -match "^DB_HOST=(.+)$") {
        $dbHost = $matches[1].Trim()
    }
    if ($line -match "^DB_PORT=(.+)$") {
        $dbPort = $matches[1].Trim()
    }
    if ($line -match "^DB_DATABASE=(.+)$") {
        $dbDatabase = $matches[1].Trim()
    }
    if ($line -match "^DB_USERNAME=(.+)$") {
        $dbUsername = $matches[1].Trim()
    }
    if ($line -match "^DB_PASSWORD=(.+)$") {
        $dbPassword = $matches[1].Trim()
    }
}

# Set defaults if not found
if ([string]::IsNullOrWhiteSpace($dbHost)) { $dbHost = "127.0.0.1" }
if ([string]::IsNullOrWhiteSpace($dbPort)) { $dbPort = "3306" }
if ([string]::IsNullOrWhiteSpace($dbDatabase)) { $dbDatabase = "bansal_lawyers" }
if ([string]::IsNullOrWhiteSpace($dbUsername)) { $dbUsername = "root" }

# Generate filename with timestamp
$timestamp = Get-Date -Format "yyyyMMdd_HHmmss"
$outputFile = "database_backup_$timestamp.sql"

# XAMPP MySQL path (adjust if your XAMPP is installed elsewhere)
$xamppPath = "C:\xampp"
$mysqlPath = "$xamppPath\mysql\bin\mysqldump.exe"

if (-not (Test-Path $mysqlPath)) {
    Write-Host "Error: mysqldump.exe not found at $mysqlPath" -ForegroundColor Red
    Write-Host "Please update the xamppPath variable in this script to match your XAMPP installation." -ForegroundColor Yellow
    exit 1
}

Write-Host "Exporting database: $dbDatabase" -ForegroundColor Green
Write-Host "Host: $dbHost" -ForegroundColor Cyan
Write-Host "Output file: $outputFile" -ForegroundColor Cyan
Write-Host ""

# Build mysqldump command
$mysqldumpArgs = @(
    "-h", $dbHost,
    "-P", $dbPort,
    "-u", $dbUsername
)

if (-not [string]::IsNullOrWhiteSpace($dbPassword)) {
    $mysqldumpArgs += "-p$dbPassword"
}

$mysqldumpArgs += $dbDatabase

# Execute mysqldump
try {
    & $mysqlPath $mysqldumpArgs | Out-File -FilePath $outputFile -Encoding UTF8
    
    if ($LASTEXITCODE -eq 0) {
        $fileSize = (Get-Item $outputFile).Length / 1MB
        Write-Host "Database exported successfully!" -ForegroundColor Green
        Write-Host "  File: $outputFile" -ForegroundColor Cyan
        Write-Host "  Size: $([math]::Round($fileSize, 2)) MB" -ForegroundColor Cyan
    } else {
        Write-Host "Error: Database export failed!" -ForegroundColor Red
        Write-Host "Please check your database credentials in .env file." -ForegroundColor Yellow
    }
} catch {
    $errorMsg = $_.Exception.Message
    Write-Host "Error: $errorMsg" -ForegroundColor Red
}

