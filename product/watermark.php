<?php

// Report all PHP errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);

ini_set("display_errors", 1);

	$ALIGN_CENTER = 1;
	$IMAGE_PATH =  $_GET['path'];
	$water_size =  $_GET['water_size'];
	if($water_size){
		$WATERMARK_PATH = './watermark_'.$water_size.'.png';
	}else{
		$WATERMARK_PATH = './watermark.png';
	}
	$IMAGE_TYPE = strtolower(substr($IMAGE_PATH, strlen($IMAGE_PATH)-4, 4));
	$WATERMARK_TYPE = strtolower(substr($WATERMARK_PATH, strlen($WATERMARK_PATH)-4, 4));
	if($IMAGE_TYPE == '.bmp') $image = imagecreatefromwbmp($IMAGE_PATH);
	if($IMAGE_TYPE == '.gif') $image = imagecreatefromgif($IMAGE_PATH);
	if($IMAGE_TYPE == '.jpg') $image = imagecreatefromjpeg($IMAGE_PATH);
	if($IMAGE_TYPE == '.png') $image = imagecreatefrompng($IMAGE_PATH);
	if($image) {
		if($WATERMARK_TYPE == '.bmp') $watermark = imagecreatefromwbmp($WATERMARK_PATH);
		if($WATERMARK_TYPE == '.gif') $watermark = imagecreatefromgif($WATERMARK_PATH);
		if($WATERMARK_TYPE == '.jpg') $watermark = imagecreatefromjpeg($WATERMARK_PATH);
		if($WATERMARK_TYPE == '.png') $watermark = imagecreatefrompng($WATERMARK_PATH);
		if($watermark) {
			list($IMAGE_W, $IMAGE_H) = getimagesize($IMAGE_PATH);
			list($WATERMARK_W, $WATERMARK_H) = getimagesize($WATERMARK_PATH);
			if($ALIGN_CENTER) { // Center
				$POS_X = (($IMAGE_W - $WATERMARK_W)/2);
				$POS_Y = (($IMAGE_H - $WATERMARK_H)/2);
			}
			else {
				$POS_X = ($IMAGE_W - $WATERMARK_W);
				$POS_Y = ($IMAGE_H - $WATERMARK_H);
			}
			imagealphablending($image, true);
			imagecopy($image, $watermark, $POS_X, $POS_Y, 0, 0, $WATERMARK_W, $WATERMARK_H);
			header("Content-type: image/jpeg");
			imagejpeg($image);
			imagedestroy($image);
			imagedestroy($watermark);
		}
	}
?>