<?php
$src = dirname(__DIR__) . '/public/images/CaseStudies.webp';
$dst = dirname(__DIR__) . '/public/images/CaseStudies-card.webp';
if (!function_exists('imagecreatefromwebp')) { exit(1); }
$im = @imagecreatefromwebp($src);
if (!$im) { exit(1); }
$w = imagesx($im); $h = imagesy($im);
$nw = 600; $nh = (int) round($h * ($nw / $w));
$out = imagecreatetruecolor($nw, $nh);
imagecopyresampled($out, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
imagewebp($out, $dst, 75);
echo filesize($dst);
