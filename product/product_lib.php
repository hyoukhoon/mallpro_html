<?php

function watermark($imgPath,$imgUrl){
	$ALIGN_CENTER = 1;
	$IMAGE_PATH =  $imgPath;
	$WATERMARK_PATH = './watermark.png';
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
				$POS_Y = (($IMAGE_H - $WATERMARK_H)/1.3);
			}
			else {
				$POS_X = ($IMAGE_W - $WATERMARK_W);
				$POS_Y = ($IMAGE_H - $WATERMARK_H);
			}
			imagealphablending($image, true);
			imagecopy($image, $watermark, $POS_X, $POS_Y, 0, 0, $WATERMARK_W, $WATERMARK_H);
//			header("Content-type: image/jpeg");
			imagejpeg($image,$imgUrl,100);
			imagedestroy($image);
			imagedestroy($watermark);
		}
	}
}


function resizeimage($maxsize,$smallfile,$picture) 
        {        
                $picsize = getimagesize($picture);
//                if(!$picsize) { 
//						echo("손상된 이미지 이거나 이미지 정보를 가져올 수 없습니다."); 
//						 return; 
//						 }
                
                // 가로가 세로보다 클 경우 가로를 기준으로 비율조정
//                if($picsize[0] > $picsize[1]) {                
//                        $rewidth = $maxsize;
//                        $reheight = round(($picsize[1]*$rewidth) / $picsize[0]);                        
//                } else {
                // 세로가 가로보다 클 경우 세로를 기준으로 비율 조정
//                        $reheight = $maxsize;
//                        $rewidth = round(($picsize[0]*$reheight) / $picsize[1]);
//                }

			$rewidth = $maxsize;
			$reheight = round(($picsize[1]*$rewidth) / $picsize[0]);                        
        
            if($picsize[2]===1) {
            $dstimg=ImageCreate($rewidth,$reheight);
            $srcimg=@ImageCreateFromGIF($picture);
            ImageCopyResized($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagegif($dstimg,$smallfile,100);
            }
            elseif($picsize[2]===2) {
            $dstimg=ImageCreatetruecolor($rewidth,$reheight);
            $srcimg=ImageCreateFromJPEG($picture);
            Imagecopyresampled($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagejpeg($dstimg,$smallfile,100);
            }
            elseif($picsize[2]===3) {
            $dstimg=ImageCreate($rewidth,$reheight);
            $srcimg=ImageCreateFromPNG($picture);
            ImageCopyResized($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagepng($dstimg,$smallfile,0);
            }

            @ImageDestroy($dstimg);
            @ImageDestroy($srcimg); 
        }

		?>