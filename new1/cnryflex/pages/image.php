<?php session_start();
$_SESSION['captcha'] = substr(md5(mt_rand()), 0, 4);

require dirname(__FILE__, 3).'/root.php';
header("Content-type: image/png");

$img   = imagecreatetruecolor(99, 38);
$white = imagecolorallocate($img, 160, 160, 160);
$black = imagecolorallocate($img, 255, 255, 255);

imagefill($img, 0, 0, $black);
imagettftext($img, 14, 0, 20, 25, $white, dirFlex."assets/font/standard.ttf", $_SESSION['captcha']);

imagepng($img);
imagedestroy($img);