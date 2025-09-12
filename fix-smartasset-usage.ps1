# Normalize @smartasset usage in Blade files
$ErrorActionPreference = 'Stop'
$views = 'resources\views'
$updatedFiles = @()

Get-ChildItem $views -Recurse -Filter *.blade.php | ForEach-Object {
  $path = $_.FullName
  $content = Get-Content -Raw -Encoding UTF8 $path
  $original = $content

  # Replace {{ @smartasset('...') }} -> @smartasset('...')
  $content = [System.Text.RegularExpressions.Regex]::Replace(
    $content,
    '\{\{\s*@smartasset\((.*?)\)\s*\}\}',
    '@smartasset($1)'
  )

  # Replace {!! @smartasset('...') !!} -> @smartasset('...')
  $content = [System.Text.RegularExpressions.Regex]::Replace(
    $content,
    '\{\!\!\s*@smartasset\((.*?)\)\s*\!\!\}',
    '@smartasset($1)'
  )

  if ($content -ne $original) {
    Set-Content -Encoding UTF8 -NoNewline -Value $content -Path $path
    Write-Host "Updated: $path"
    $updatedFiles += $path
  }
}

php artisan view:clear | Out-Host
Write-Host "Done. Updated $($updatedFiles.Count) files."
