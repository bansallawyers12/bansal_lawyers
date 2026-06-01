<?php
$xml = file_get_contents('c:/xampp/htdocs/bansal_lawyers/public/sitemap.xml');
preg_match_all('/<loc>(https:\/\/www\.bansallawyers\.com\.au\/([^<]+))<\/loc>/', $xml, $m);
foreach ($m[2] as $path) {
    echo $path . PHP_EOL;
}
