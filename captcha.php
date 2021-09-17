<?php

session_start();

function hexToRGB($hexstring)
{
	$integar = hexdec($hexstring);
	
	return [
		'red'	=> 0xFF & ($integar >> 0x10), 
		'green' => 0xFF & ($integar >> 0x8), 
		'blue'	=> 0xFF & $integar
	];
}


$i			= 0;
$imgHeight		= 80;
$imgWidth		= 250;
$randTotal		= 7;
$randomDots		= 50;
$randomLines		= 25;
$font			= realpath('./fonts/monofont.ttf');
$random			= '';
$captTextColor		= "0x142864";
$noiseColor		= "0x142864";
$fontSize		= $imgHeight * 0.65;
$random			= substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0 , $randTotal);
$image			= @imagecreate($imgWidth, $imgHeight);


// Atur latar belakang, teks, dan warna noise
$arrTextColor	= hexToRGB($captTextColor);
$arrNoiseColor	= hexToRGB($noiseColor);
$bgColor	= imagecolorallocate($image, 255, 255, 255);
$captTextColor 	= imagecolorallocate($image, $arrTextColor['red'], $arrTextColor['green'], $arrTextColor['blue']);
$imgNoiseColor	= imagecolorallocate($image, $arrNoiseColor['red'], $arrNoiseColor['green'], $arrNoiseColor['blue']);


// Cetak titik acak di latar belakang gambar
for ($i = 0; $i < $randomDots; $i++) 
{
	imagefilledellipse($image, mt_rand(0, $imgWidth), mt_rand(0, $imgHeight), 2, 3, $imgNoiseColor);
}


// Cetak garis acak di latar belakang gambar
for ($i = 0; $i < $randomLines; $i++) 
{
	imageline(
		$image,
		mt_rand(0,$imgWidth),
		mt_rand(0,$imgHeight),
		mt_rand(0,$imgWidth),
		mt_rand(0,$imgHeight),
		$imgNoiseColor
	);
}


// Cetak kotak teks dan tambahkan 6 kode huruf captcha
$textBox		= imagettfbbox($fontSize, 0, $font, $random); 
$x			= ($imgWidth - $textBox[4]) / 2;
$y			= ($imgHeight - $textBox[5]) / 2;
$_SESSION['captcha'] 	= $random;


imagettftext($image, $fontSize, 0, $x, $y, $captTextColor, $font, $random);
header('Content-Type: image/jpeg'); 
imagejpeg($image);
imagedestroy($image);


?>
