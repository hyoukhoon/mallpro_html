<?php include "/var/www/mallpro/public_html/inc/dbcon.php";

	$que="SELECT * FROM mallpro.taobao where uid like 'ich%'";
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			//echo $rs->thumbFile."<br>";
			$thumb=explode(",",$rs->thumbFile);
			foreach($thumb as $t){
				$th="";
				$th="/data/mallpro/thumb/".$t;
				if(file_exists($th)){
					if(unlink($th)){
						echo "thumb delok ";
					}
				}
			}

			$img= json_decode($rs->itemImage);
			foreach($img as $g){
				$im="";
				$im="/data/mallpro/itemImage/".$g;
				if(file_exists($im)){
					if(unlink($im)){
						echo "item Image delok ";
					}
				}
			}

			$q1="delete from taobao where num='".$rs->num."'";
			$sql=$mysqli->query($q1) or die("3:".$mysqli->error);

			$q2="delete from optiontable where pnum='".$rs->num."'";
			$sql=$mysqli->query($q2) or die("3:".$mysqli->error);
	}

?>
