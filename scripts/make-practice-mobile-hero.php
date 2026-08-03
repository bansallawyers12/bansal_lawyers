<?php
$src = dirname(__DIR__) . '/public/images/PracticeArea.webp';
$dst = dirname(__DIR__) . '/public/images/PracticeArea-mobile.webp';
if (!function_exists('imagecreatefromwebp')) {
    fwrite(STDERR, "GD WebP not available\n");
    exit(1);
}
$im = @imagecreatefromwebp($src);
if (!$im) {
    fwrite(STDERR, "Failed to load $src\n");
    exit(1);
}
$w = imagesx($im);
$h = imagesy($im);
$nw = 800;
$nh = (int) round($h * ($nw / $w));
$out = imagecreatetruecolor($nw, $nh);
imagecopyresampled($out, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
imagewebp($out, $dst, 78);
echo "OK {$nw}x{$nh} " . filesize($dst) . " bytes\n";
