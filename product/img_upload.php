<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
include $_SERVER["DOCUMENT_ROOT"]."/inc/class.Images.php";

//$iPath=$_POST['iPath'];
$PRODUCT_ID=$_POST['PRODUCT_ID'];
$SELLER_CODE=$_POST['SELLER_CODE'];
$ADMIN=$_POST['ADMIN'];
$USE_FLAG=$_POST['USE_FLAG'];


$iPath="media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
$iPath2="/media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
$iPath3=$_SERVER["DOCUMENT_ROOT"].$iPath;
$iPath4=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID;

if(!is_dir($iPath3)){
	@mkdir($iPath3,0777,true);
	@chmod($iPath4,0777);
	@chmod($iPath3,0777);
}


if ($_FILES["imgfileb"]["error"] > 0){  // 에러가 있는지 검사하는 구문
	echo "Return Code: " . $_FILES["imgfileb"]["error"] . "<br>";  // 에러가 있으면 어떤 에러인지 출력함
}
else
{   // 에러가 없다면
	
	/*
	echo "Upload: " . $_FILES["imgfileb"]["name"] . "<br>";  // 전송된 파일의 실제 이름 값
	echo "Type: " . $_FILES["imgfileb"]["type"] . "<br>";   // 전송된 파일의 형식(type)
	echo "Size: " . ($_FILES["imgfileb"]["size"]) . " Byte<br>";   // 전송된 파일의 용량(기본 byte 값)
	echo "Temp file: " . $_FILES["imgfileb"]["tmp_name"] . "<br>";  //서버에 저장된 임시 복사본의 이름
	*/

	if($_FILES["imgfile1"])
	{
		$info = getimagesize($_FILES["imgfile1"]["tmp_name"]);
		$test = "imgfile1";
	}
	else if($_FILES["imgfile2"])
	{
		$info = getimagesize($_FILES["imgfile2"]["tmp_name"]);
		$test = "imgfile2";
	}
	else if($_FILES["imgfile3"])
	{
		$info = getimagesize($_FILES["imgfile3"]["tmp_name"]);
		$test = "imgfile3";
	}
	else if($_FILES["imgfile4"])
	{
		$info = getimagesize($_FILES["imgfile4"]["tmp_name"]);
		$test = "imgfile4";
	}

	else if($_FILES["imgfile5"])
	{
		$info = getimagesize($_FILES["imgfile5"]["tmp_name"]);
		$test = "imgfile5";
	}

	else if($_FILES["imgfile6"])
	{
		$info = getimagesize($_FILES["imgfile6"]["tmp_name"]);
		$test = "imgfile6";
	}


	else if($_FILES["imgfile7"])
	{
		$info = getimagesize($_FILES["imgfile7"]["tmp_name"]);
		$test = "imgfile7";
	}

	else if($_FILES["imgfile8"])
	{
		$info = getimagesize($_FILES["imgfile8"]["tmp_name"]);
		$test = "imgfile8";
	}

	else if($_FILES["imgfile9"])
	{
		$info = getimagesize($_FILES["imgfile9"]["tmp_name"]);
		$test = "imgfile9";
	}

	else if($_FILES["imgfile10"])
	{
		$info = getimagesize($_FILES["imgfile10"]["tmp_name"]);
		$test = "imgfile10";
	}

		$total=count($_FILES[$test]['name']);//멀티업로드 파일갯수

//		echo "[";
//		echo "{'fnm':'".$total."'}";
//		echo "]";
//		exit;


for($i=0; $i<$total; $i++) {

			

  //Get the temp file path
		$tmpFilePath = $_FILES[$test]['tmp_name'][$i];

		$fnm = $PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4);
		$imgsize=$_FILES[$test]["size"][$i];
		$ext = substr(strrchr($_FILES[$test]["name"][$i],"."),1);
		if($ext!="jpg" && $ext!="gif" && $ext!="png"){
//			echo "[";
			echo "{'fnm':'not'}";
//			echo "]";
			exit;
		}


			move_uploaded_file($_FILES[$test]["tmp_name"][$i], $_SERVER['DOCUMENT_ROOT'].$iPath . $fnm.".".$ext);
			$exifData = getimagesize($_SERVER['DOCUMENT_ROOT'].$iPath.$fnm.".".$ext);

			if ($exifData[0] > $exifData[1])
			{
				$source = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$iPath.$fnm.".".$ext); 
				$source = imagerotate ($source , 270, 0); 
				imagejpeg($source, $_SERVER['DOCUMENT_ROOT'].$iPath.$fnm.".".$ext); 
			}

//워터마크
watermark($_SERVER['DOCUMENT_ROOT'].$iPath.$fnm.".".$ext,$iPath3.$fnm.".".$ext);

//썸네일

        $imgAll = $fnm.".".$ext;

                if(!file_exists($iPath3."T_".$imgAll)) { 
                        resizeimage(720,$iPath3."T_".$imgAll,$iPath3.$imgAll); 

                        set_time_limit(10);
                        flush();
                }                

		$ofn=$_FILES[$test]["name"][$i];
		$fn=$fnm.".".$ext;
		$que="select max(FILE_ORDER) from product_file_info where PRODUCT_ID='".$PRODUCT_ID."' and IMGVOD_FLAG='0' and USE_FLAG='".$USE_FLAG."' and DEL_FLAG='0'";
		$result = $mysqli->query($que) or die("1:".$mysqli->error);
		$rs = $result->fetch_array();
		$fo=$rs[0]+1;
		if($fo==1){
			$rep_flag=1;
		}else{
			$rep_flag=0;
		}

		$IMGVOD_FLAG=0;// 일반이미지
		$que="insert into product_file_info values ('',
		'$PRODUCT_ID',
		'$fo',
		'".$ofn."',
		'".$fn."',
		'$FILE_ID_PARENT',
		'$iPath',
		'$imgsize',
		'$USE_FLAG',
		'0',
		'".$rep_flag."',
		'0',
		now(),
		now()
		)";
		$sql=$mysqli->query($que) or die("1:".$mysqli->error);
		$insert_id=$mysqli->insert_id;

		$imgsize=filesize($iPath3."T_".$fn);

		$IMGVOD_FLAG=3;// 썸네일이미지
		$que="insert into product_file_info values ('',
		'$PRODUCT_ID',
		'$fo',
		'".$ofn."',
		'"."T_".$fn."',
		'$insert_id',
		'$iPath',
		'$imgsize',
		'$USE_FLAG',
		'$IMGVOD_FLAG',
		'".$rep_flag."',
		'0',
		now(),
		now()
		)";
		$sql=$mysqli->query($que) or die("2:".$mysqli->error);

		
		$rt.="{'fnm':'".$fnm.".".$ext."','iid':'".$insert_id."','fo':'".$fo."','iPath2':'".$iPath2."','ofn':'".$ofn."'},";
		


}//멀티업로드 for

}
$rt=substr($rt,0,-1);

echo $rt;


function watermark($imgPath,$imgUrl){
	$ALIGN_CENTER = 1;
	$IMAGE_PATH =  $imgPath;
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
                if(!$picsize) { 
						echo("손상된 이미지 이거나 이미지 정보를 갖어올 수 없습니다."); 
						 return; 
						 }
                
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