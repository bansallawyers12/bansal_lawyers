<?php
$reports = [
    'http_5xx_server_errors',
    'broken_canonical_urls',
    'permanent_redirects',
    'malformed_robots.txt',
    'pages_with_only_one_internal_link',
    'links_with_non-descriptive_anchor_text',
];

foreach ($reports as $name) {
    $pattern = 'c:/xampp/htdocs/bansal_lawyers/public/errors/www.bansallawyers.com.au_' . $name . '_20260601.xlsx';
    $files = glob($pattern);
    if (!$files) { echo "\n[NOT FOUND] $name\n"; continue; }
    $file = $files[0];

    $zip = new ZipArchive();
    $zip->open($file);
    $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
    $zip->close();

    echo "\n========== $name ==========\n";
    if (!$sheetXml) { echo "(no sheet)\n"; continue; }

    $sheet = simplexml_load_string($sheetXml);
    $count = 0;
    foreach ($sheet->sheetData->row as $row) {
        $vals = [];
        foreach ($row->c as $cell) {
            $vals[] = (string)($cell->is->t ?? $cell->v ?? '');
        }
        $line = implode(' | ', $vals);
        if (trim($line, '| ') !== '') {
            echo $line . "\n";
            $count++;
        }
    }
    echo "(total data rows: " . ($count - 1) . ")\n";
}
