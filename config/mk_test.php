<?php

$img_dir=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$shop_code."/".$insert_id."/COMMON/";
$img_dir=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/08/0000000705/COMMON/";

			if(!is_dir($img_dir)){
				@umask(0);
				@mkdir($img_dir,0777,true);
			}

?>