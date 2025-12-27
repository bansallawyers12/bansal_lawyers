# PowerShell script to download missing Poppins font files from Google Fonts
# 
# Usage: .\scripts\download-poppins-fonts.ps1
# 
# This script downloads the missing Poppins font weights (300, 500, 700, 800)
# from Google Fonts and saves them to public/fonts/poppins/

$ErrorActionPreference = "Stop"

# Font weights to download
$fontWeights = @(
    @{ Weight = 300; Name = "poppins-light" },
    @{ Weight = 500; Name = "poppins-medium" },
    @{ Weight = 700; Name = "poppins-bold" },
    @{ Weight = 800; Name = "poppins-extrabold" }
)

# Output directory
$outputDir = Join-Path $PSScriptRoot "..\public\fonts\poppins"
$outputDir = [System.IO.Path]::GetFullPath($outputDir)

# Ensure output directory exists
if (-not (Test-Path $outputDir)) {
    New-Item -ItemType Directory -Path $outputDir -Force | Out-Null
}

Write-Host "🚀 Starting Poppins font download...`n" -ForegroundColor Cyan

foreach ($font in $fontWeights) {
    $filepath = Join-Path $outputDir "$($font.Name).woff2"
    
    # Skip if file already exists
    if (Test-Path $filepath) {
        Write-Host "⏭️  Skipping $($font.Name).woff2 (already exists)" -ForegroundColor Yellow
        continue
    }
    
    try {
        Write-Host "📥 Downloading $($font.Name).woff2 (weight: $($font.Weight))..." -ForegroundColor Blue
        
        # Get CSS from Google Fonts API
        $cssUrl = "https://fonts.googleapis.com/css2?family=Poppins:wght@$($font.Weight)&display=swap"
        $cssContent = Invoke-WebRequest -Uri $cssUrl -UseBasicParsing | Select-Object -ExpandProperty Content
        
        # Extract WOFF2 URL from CSS
        if ($cssContent -match 'url\(([^)]+\.woff2[^)]*)\)') {
            $fontUrl = $matches[1] -replace "['`"]", ""
            
            Write-Host "   URL: $($fontUrl.Substring(0, [Math]::Min(80, $fontUrl.Length)))..." -ForegroundColor Gray
            
            # Download the font file
            Invoke-WebRequest -Uri $fontUrl -OutFile $filepath -UseBasicParsing
            
            # Check file size
            $fileInfo = Get-Item $filepath
            $fileSizeKB = [math]::Round($fileInfo.Length / 1KB, 2)
            Write-Host "✅ Downloaded $($font.Name).woff2 ($fileSizeKB KB)`n" -ForegroundColor Green
            
        } else {
            Write-Host "❌ Could not find WOFF2 URL for weight $($font.Weight)" -ForegroundColor Red
        }
        
    } catch {
        Write-Host "❌ Error downloading $($font.Name).woff2: $($_.Exception.Message)" -ForegroundColor Red
        Write-Host ""
    }
}

Write-Host "✨ Font download complete!" -ForegroundColor Cyan
Write-Host "`n📁 Fonts saved to: $outputDir" -ForegroundColor Cyan

# List all Poppins fonts
Write-Host "`n📋 Current Poppins font files:" -ForegroundColor Cyan
$files = Get-ChildItem -Path $outputDir -Filter "*.woff2"
foreach ($file in $files) {
    $sizeKB = [math]::Round($file.Length / 1KB, 2)
    Write-Host "   - $($file.Name) ($sizeKB KB)" -ForegroundColor White
}

