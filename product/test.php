<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);

ini_set("display_errors", 1);


include $_SERVER["DOCUMENT_ROOT"]."/inc/class.Images.php";
$path=$_SERVER["DOCUMENT_ROOT"]."/media/SHOP/02/0000000724/MOBILE/0000001039/IMG/";
$t1=$_SERVER["DOCUMENT_ROOT"]."/media/SHOP/02/0000000724/MOBILE/0000001039/IMG/0000001039_201707180121491963.jpg";
$t2="K_0000001039_201707180121491963";

img_limit_resize();

function img_limit_resize($real,$wid_size){   //이미지경로,변경할가로길이
 $img_info = GetImageSize($real);
 $img_wid = $img_info[0];
 $img_hei = $img_info[1];
 $img_type = $img_info[mime];
 if($img_wid>$wid_size){ //업로드이미지가 기준사이즈보다 클경우 이미지 사이즈 축소저장
  $re_hei = (int)(($img_hei*$wid_size)/$img_wid);
  $im=ImageCreate($wid_size,$re_hei);     //이미지의 크기를 정합니다.
  if(ereg('gif',$img_type)){
   $im2 = imagecreatefromgif($real);
  }elseif(ereg('jpeg',$img_type)){
   $im2 = imagecreatefromjpeg($real);
  }elseif(ereg('png',$img_type)){
   $im2 = imagecreatefrompng($real);
  }else{
   echo "지원하지않는 이미지형식입니다.";
   exit;
  }
  imagecopyresized($im, $im2,0,0,0,0,$wid_size,$re_hei,$img_wid,$img_hei);
  ImagePNG($im,$real);       //ImagePNG(이미지, 저장될파일)
  ImageDestroy($im);         // 이미지에 사용한 메모리 제거
 }
}

?>