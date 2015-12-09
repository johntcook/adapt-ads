<?php

require_once( '../../../wp-load.php' );


// Get Ad Number
$ad = urldecode($_GET['ad']);

// Get Message
$message = urldecode($_GET['message']);

// Get Image
$image = get_field( "image", $ad );

if( !empty($image) ){
	$url = $image['url'];
}

// Get Font
$fontFile = get_field('message_font', $ad);
$fontFileUrl = $fontFile['url'];

$fontFilePath = substr($fontFileUrl, (strpos($fontFileUrl, "wp-content/") + 11));
$fontFileFolderPath = substr($fontFilePath, 0, (strrpos($fontFilePath, "/") + 1));

putenv('GDFONTPATH=' . realpath('./../../' . $fontFileFolderPath));


$fontFileName = substr($fontFileUrl, (strrpos($fontFileUrl, "/") + 1) );

$font = $fontFileName; // "DK-Lemon-Yellow-Sun.ttf";

// Get Font Size
$fontSize = get_field('font_size', $ad);

// Get Message Color
$messageColor = get_field('message_color', $ad);
$messageColorRGBA = hex2rgb($messageColor);

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}


// Get Distance from Top
$topDistance = get_field('distance_from_top', $ad);

// Get Distance from Left
$leftDistance = get_field('distance_from_left', $ad);
	

// Create Image
$rImg = ImageCreateFromJPEG($url);

// Allocate Image Color
$messageColorRGB = imagecolorallocate($rImg, $messageColorRGBA[0], $messageColorRGBA[1], $messageColorRGBA[2] );

// Add The Text
imagettftext($rImg, $fontSize, 0, $leftDistance, $topDistance, $messageColorRGB, $font, $message);

// Display Image
header('Content-type: image/jpeg');
imagejpeg($rImg , NULL , 100);


?>