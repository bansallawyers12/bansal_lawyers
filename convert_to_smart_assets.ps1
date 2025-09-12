# Convert asset() calls to @smartasset directive for environment compatibility
$ErrorActionPreference = 'Stop'
$views = 'C:\xampp\htdocs\bansal_lawyers\resources\views'
$updatedFiles = @()

Write-Host "Converting asset() calls to @smartasset directive..."

Get-ChildItem $views -Recurse -Filter *.blade.php | ForEach-Object {
    $filePath = $_.FullName
    $content = Get-Content -Raw -Encoding UTF8 $filePath
    $originalContent = $content
    
    # Track if any changes were made
    $hasChanges = $false
    
    # Convert {{ asset('...') }} to {{ @smartasset('...') }}
    if ($content -match '\{\{\s*asset\(') {
        $content = $content -replace '\{\{\s*asset\(', '{{ @smartasset('
        $hasChanges = $true
    }
    
    # Convert {!! asset('...') !!} to {!! @smartasset('...') !!}
    if ($content -match '\{\!\!\s*asset\(') {
        $content = $content -replace '\{\!\!\s*asset\(', '{!! @smartasset('
        $hasChanges = $true
    }
    
    # Convert src="{{ asset('...') }}" to src="{{ @smartasset('...') }}"
    if ($content -match 'src="\{\{\s*asset\(') {
        $content = $content -replace 'src="\{\{\s*asset\(', 'src="{{ @smartasset('
        $hasChanges = $true
    }
    
    # Convert href="{{ asset('...') }}" to href="{{ @smartasset('...') }}"
    if ($content -match 'href="\{\{\s*asset\(') {
        $content = $content -replace 'href="\{\{\s*asset\(', 'href="{{ @smartasset('
        $hasChanges = $true
    }
    
    # Write back if changes were made
    if ($hasChanges) {
        Set-Content -Encoding UTF8 -NoNewline -Value $content -Path $filePath
        $updatedFiles += $filePath
        Write-Host "Updated: $filePath"
    }
}

Write-Host "`nConversion complete. Updated $($updatedFiles.Count) files."
Write-Host "`nNow your assets will work on both local development and production!"
Write-Host "`nUsage examples:"
Write-Host "  {{ @smartasset('js/jquery.min.js') }}"
Write-Host "  {{ @smartasset('css/style.css') }}"
Write-Host "  {{ @smartasset('img/logo.png') }}"
Write-Host "`nScript completed successfully!"
