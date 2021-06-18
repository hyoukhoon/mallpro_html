<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

	$que="SELECT * FROM mallpro.taobao where regDate < DATE_ADD(NOW(),INTERVAL -1 month ) order by num desc";
	//$que="SELECT * FROM mallpro.taobao where regDate < DATE_ADD(NOW(),INTERVAL -6 week ) order by num desc";
	//$que="SELECT * FROM mallpro.taobao where num='6'";
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			//echo $rs->thumbFile."<br>";
			$thumb=explode(",",$rs->thumbFile);
			foreach($thumb as $t){
				$th="";
				$th="/data/mallpro/thumb/".$t;
				if(file_exists($th)){
					if(unlink($th)){
						echo "delok ";
					}
				}
			}

			$img= json_decode($rs->itemImage);
			foreach($img as $g){
				$im="";
				$im="/data/mallpro/itemImage/".$g;
				if(file_exists($im)){
					if(unlink($im)){
						echo "delok ";
					}
				}
			}

			$q1="delete from taobao where num='".$rs->num."'";
			//$sql=$mysqli->query($q1) or die("3:".$mysqli->error);

			$q2="delete from optiontable where pnum='".$rs->num."'";
			//$sql=$mysqli->query($q2) or die("3:".$mysqli->error);
	}

?>
