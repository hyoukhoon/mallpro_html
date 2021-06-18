<?php
	$now=time();
	$now1=date("mdHis");
	$now2=date("Y-m-d");
	$now3=date("YmdHis");
	$now4=date("Y-m-d H:i:s");
	$now5=date("Ymd");
	$now_time=date("YmdHi");
	$y_1=date("Y")+1;
	$one_year=$y_1.date("m").date("d");

	$d7=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
	$d14=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-14, date("Y")));
	$d30=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")));
	$yesterday=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));

	$rander=rand();

	$domain="http://www.mallpro.kr";

	$admin_mail="escritoyane@gmail.com";

	$company="mallpro";

	$pickFee=5000;//픽을 보는 비용
	$donateFee=100;//기부금
	$returnFee=$pickFee*0.1;
	$pickUpFee=10000;//픽 등록 비용
	$refundFee=3000;//환불수수료
	//$returnFee=200;
	$fromMobile="07088108808";
	$salePercent=0.97;

	define("GOOGLE_API_KEY", "AAAAh5aRLxg:APA91bEcS3v6i2qnxD230NYBLVJ-1ligHDAPJ0ROAiMUPC-mbIcHt5W49zO2hmdCAN2RgXSoWP0QcjPq9FxninbuAVOnL1MOiXt2z0Vf4teEGF6EE-0WOE8MlrZ0vL6ne0zBeoDzoXGD");



function conv_eu($text){
	return mb_convert_encoding("$text","EUC-KR","UTF-8");
}

function conv_ue($text){
	return mb_convert_encoding("$text","UTF-8","EUC-KR");
}

function cnyIs(){
	$ds=json_decode(file_get_contents("https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWCNY"));
	return $ds[0]->basePrice+5;
}

function cashGubunis($n){

		switch($n) {
			
			case 1:$rs="입금";
			break;
			case 2:$rs="픽확인";
			break;
			case 3:$rs="픽스터예측실패보상지출";
			break;
			case 4:$rs="픽스터예측결과수입";
			break;
			case 5:$rs="픽스터예측실패환불";
			break;
			case 6:$rs="픽스터예측실패보상";
			break;
			case 7:$rs="픽스터예측결과어드민수입";
			break;
			case 8:$rs="픽스터디파짓";
			break;
			case 9:$rs="픽스터디파짓 환불";
			break;
			case 10:$rs="프로픽의보상";
			break;
			case 11:$rs="픽등록비용";
			break;
			case 12:$rs="회원가입보너스";
			break;
			case 13:$rs="추천인이벤트";
			break;
			case 14:$rs="상품권구매";
			break;
			case 15:$rs="게임취소에의한환불";
			break;
			case 16:$rs="환불신청";
			break;
			case 17:$rs="입금취소";
			break;
			case 18:$rs="상품구매";
			break;
			case 19:$rs="쿠폰사용";
			break;
			case 20:$rs="테스트용캐쉬";
			break;
			case 21:$rs="캐쉬몰구매";
			break;
			
		}

		return $rs;

	}


function tokenGubunis($n){

		switch($n) {
			
			case 1:$rs="픽스터예측성공으로펀터에게토큰지급";
			break;
			case 2:$rs="픽스터에게보상금만큼토큰지급";
			break;
			case 3:$rs="픽스터예측실패보상지출";
			break;
			case 4:$rs="픽스터예측결과수입";
			break;
			case 5:$rs="픽스터예측실패환불";
			break;
			case 6:$rs="픽스터예측실패보상";
			break;
			case 7:$rs="픽스터예측결과어드민수입";
			break;
			case 8:$rs="회원가입보너스";
			break;
			case 9:$rs="눈치게임경매";
			break;
			case 10:$rs="미정";
			break;
			case 20:$rs="테스트용토큰";
			break;
			
		}

		return $rs;

	}


function gameResult_is($n){

		switch($n) {
			
			case -1:$rs="패";
			break;
			case 0:$rs="무";
			break;
			case 1:$rs="승";
			break;
			case 2:$rs="취소";
			break;
			case 7:$rs="언더";
			break;
			case 8:$rs="오버";
			break;
			

		}

		return $rs;

	}

function auth_is($n){

		switch($n) {
			
			case -1:$rs="탈퇴회원";
			break;
			case 0:$rs="미인증회원";
			break;
			case 1:$rs="일반회원";
			break;
			case 100:$rs="관리자";
			break;

		}

		return $rs;

	}


function optionCountCoupon($n){

		switch($n) {
			
			case 0:$rs=1;
			break;
			case 1:$rs=2;
			break;
			case 2:$rs=3;
			break;
			case 3:$rs=5;
			break;

		}

		return $rs;

	}

function orderStatus($n){

		switch($n) {
			
			case 1:$rs="주문완료";
			break;
			case 2:$rs="발송준비";
			break;
			case 3:$rs="발송완료";
			break;
			case -1:$rs="취소";
			break;

		}

		return $rs;

	}


function gameStatus($n){

		switch($n) {
			
			case -1:$rs="<font color='red'>패</font>";
			break;
			case 0:$rs="<font color='green'>무</font>";
			break;
			case 1:$rs="<font color='blue'>승</font>";
			break;
		}

		return $rs;

	}


function payStatus($n){

		switch($n) {

			case 1:$rs="<font color='blue'>신청중</font>";
			break;
			case 2:$rs="<font color='green'>확인중</font>";
			break;
			case 3:$rs="<font color='red'>완료</font>";
			break;

		}

		return $rs;

	}


function refundStatus($n){

		switch($n) {

			case 1:$rs="<font color='blue'>신청중</font>";
			break;
			case 2:$rs="<font color='green'>처리중</font>";
			break;
			case 3:$rs="<font color='red'>완료</font>";
			break;

		}

		return $rs;

	}

function isMemberType($level){
	global $mysqli;

	$que="select mName from memberType where mLevel='$level'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	return $rs[0];
}

function isCouponCnt($uid){
	global $mysqli;
	$now2=date("Y-m-d");
	$que="select sum(buyCoupon-nowCoupon) from memberCoupon where uid='$uid' and isuse=1 and buyCoupon>nowCoupon and startDate<='$now2' and endDate>='$now2'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();
	$cnt=$rs[0]+0;
	return $cnt;
}

function isMyCnt($uid){
	global $mysqli;
	$now2=date("Y-m-d");
	$que="select sum(if(gubun=1,totalDownCnt-nowDownCnt,if(isuse=1,totalDownCnt-nowDownCnt,0))) from memberCoupon where uid='$uid' and startDate<='$now2' and endDate>='$now2'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();
	$cnt=$rs[0]+0;
	return $rs[0];
}

function isTaobaoCnt($uid){
	global $mysqli;

	$que="select count(1) from taobao where uid='$uid' and left(regDate,7)='".date("Y-m")."'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	return $rs[0];
}


function salePrice($price,$company){

	global $salePercent;

	if($company=="신세계"){
		$price=$price;
	}else{
		$price=$price*$salePercent;
	}

	return number_format($price);
}

function cateIs($code){
	global $mysqli;

	$que="select * from naver_category where categoryCode='$code'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_object();
	$cate=$rs->cate1." > ".$rs->cate2." > ".$rs->cate3." > ".$rs->cate4;
	return $cate;
}


function memberPhoto($uid){
	global $mysqli;

	$que="select photo from member where uid='$uid'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();
	$photo=$rs[0]?$rs[0]:"/img/propickImg.png";

	return $photo;
}

function isNickName($uid){
	global $mysqli;

	$que="select nickName from member where uid='$uid'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	return $rs[0];
}

function isMemo($uid){
	global $mysqli;

	$que="select count(1) from memo where toId='$uid' and isRead=0";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();


	return $rs[0];
}


function punterCash($uid){
	global $mysqli;

	$que="select nowCash from punterCashList where uid='$uid' and isRefund=0 order by num desc limit 1";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	$que2="select nowCash from punterCashList where uid='$uid' and isRefund=1 order by num desc limit 1";
	$result2 = $mysqli->query($que2);
	$rs2 = $result2->fetch_array();

	return $rs[0]+$rs2[0];
}

function punterRefundCash($uid){
	global $mysqli;

	$que2="select nowCash from punterCashList where uid='$uid' and isRefund=1 order by num desc limit 1";
	$result2 = $mysqli->query($que2);
	$rs2 = $result2->fetch_array();

	return $rs2[0];
}

function pixterCash($uid){
	global $mysqli;

	$que="select nowCash from pixterCashList where uid='$uid' and isRefund=0 order by num desc limit 1";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	$que2="select nowCash from pixterCashList where uid='$uid' and isRefund=1 order by num desc limit 1";
	$result2 = $mysqli->query($que2);
	$rs2 = $result2->fetch_array();

	return $rs[0]+$rs2[0];
}

function pixterRefundCash($uid){
	global $mysqli;

	$que2="select nowCash from pixterCashList where uid='$uid' and isRefund=1 order by num desc limit 1";
	$result2 = $mysqli->query($que2);
	$rs2 = $result2->fetch_array();

	return $rs2[0];
}


function punterToken($uid){
	global $mysqli;

	$que="select nowCash from punterTokenList where uid='$uid' order by num desc limit 1";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	return $rs[0];
}


function pixterToken($uid){
	global $mysqli;

	$que="select nowCash from pixterTokenList where uid='$uid' order by num desc limit 1";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();

	return $rs[0];
}


function comm_title_is($multi){
	
	global $mysqli;
	$que="select multi_title from cboard_admin where multi='$multi'";
	$result = $mysqli->query($que) or die($mysqli->error);
	$rs = $result->fetch_object();
	return $rs->multi_title;
}


function auto_link($str) 
{ 
if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches)) 
{ 
for ($i = 0; $i < count($matches['0']); $i++) 
{ 
$period = ''; 
if (preg_match("|\.$|", $matches['6'][$i])) 
{ 
$period = '.'; 
$matches['6'][$i] = substr($matches['6'][$i], 0, -1); 
} 

$str = str_replace($matches['0'][$i], 
$matches['1'][$i].'<a href="http'. 
$matches['4'][$i].'://'. 
$matches['5'][$i]. 
$matches['6'][$i].'" target="_blank">http'. 
$matches['4'][$i].'://'. 
$matches['5'][$i]. 
$matches['6'][$i].'</a>'. 
$period, $str); 
} 
} 

return $str; 
} 



function content_is($content){
	$content=stripslashes($content);
	$content=str_replace("<TBODY><br />","<TBODY>",$content);
	$content=str_replace("</TR><br />","</TR>",$content);
	$content=str_replace("<TR><br />","<TR>",$content);
	$content=str_replace("</TD><br />","</TD>",$content);
	$content = auto_link($content);
	$content = stripslashes($content);
	return $content;
}

function content_is2($content){
	$content=stripslashes(nl2br($content));
	$content=str_replace("<TBODY><br />","<TBODY>",$content);
	$content=str_replace("</TR><br />","</TR>",$content);
	$content=str_replace("<TR><br />","<TR>",$content);
	$content=str_replace("</TD><br />","</TD>",$content);
	$content=str_replace("<P>","<DIV>",$content);
	$content=str_replace("</P>","</DIV>",$content);
	$content=str_replace("<p>","<DIV>",$content);
	$content=str_replace("</p>","</DIV>",$content);
	$content=str_replace("<br />","",$content);
	$content=str_replace("<BR />","",$content);
	$content = auto_link($content);
	return $content;
}


function null_check($a,$txt){
		if(!trim($a)){
			echo "
				<script language=javascript>
					alert('$txt 넣어주세요.');
					history.back();
				</script>
				";
				exit;
		}
		return $a;
	}


function sns_is($n){

		switch($n) {

			case 1:$power="카카오톡";
			break;
			case 2:$power="위챗";
			break;
			case 3:$power="페이스북";
			break;

		}

		return $power;

	}


function newimg($a){
							if(substr($a,0,10)==date("Y-m-d") ){
								$b="<img src=/img/ico_new_01.gif border=0 align=absmiddle>";
							}
							return $b;
						}

function new_img($a){

						$reg_date=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
							if(substr($a,0,10)>=$reg_date){
								$b="<img src=\"/img/ico_new_01.gif\" align=absmiddle>";
							}
							return $b;
						}

function new_img_7($a){

						$reg_date=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
							if(substr($a,0,10)>=$reg_date){
								$b="<img src=\"/home/img/ico_new_01.gif\" align=absmiddle>";
							}
							return $b;
						}

function new_img_14($a){

						$reg_date=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-14, date("Y")));
							if(substr($a,0,10)>=$reg_date){
								$b="<img src=\"/home/img/ico_new_01.gif\" align=absmiddle style='display:inline;'>";
							}
							return $b;
						}


	function multi_title_is($multi){

		$list=mysql_query("select multi_title from kboard_admin where multi='$multi'") or die("db error");
		$ls=mysql_fetch_array($list);
		mysql_free_result($list);
		return $ls[0];

	}

	


function bank_is($bc){


		switch($bc) {

			case "01":$pm="한국";
			break;
			case "02":$pm="산업";
			break;
			case "03":$pm="기업";
			break;
			case "04":$pm="국민";
			break;
			case "05":$pm="외환";
			break;
			case "06":$pm="국민";
			break;
			case "07":$pm="수협";
			break;
			case "08":$pm="수출입";
			break;
			case "10":$pm="농협";
			break;
			case "11":$pm="농협";
			break;
			case "12":$pm="농협";
			break;
			case "13":$pm="농협";
			break;
			case "14":$pm="농협";
			break;
			case "15":$pm="농협";
			break;
			case "16":$pm="농협";
			break;
			case "17":$pm="농협";
			break;
			case "19":$pm="국민";
			break;
			case "20":$pm="우리";
			break;
			case "21":$pm="신한";
			break;
			case "22":$pm="우리";
			break;
			case "23":$pm="ＳＣ제일";
			break;
			case "24":$pm="우리";
			break;
			case "25":$pm="하나";
			break;
			case "26":$pm="신한";
			break;
			case "27":$pm="한국씨티";
			break;
			case "28":$pm="신한";
			break;
			case "29":$pm="국민";
			break;
			case "31":$pm="대구";
			break;
			case "32":$pm="부산";
			break;
			case "33":$pm="하나";
			break;
			case "34":$pm="광주";
			break;
			case "35":$pm="제주";
			break;
			case "36":$pm="한국씨티";
			break;
			case "37":$pm="전북";
			break;
			case "39":$pm="경남";
			break;
			case "45":$pm="새마을금고";
			break;
			case "46":$pm="새마을금고";
			break;
			case "48":$pm="신협";
			break;
			case "49":$pm="신협";
			break;
			case "50":$pm="상호저축은행";
			break;
			case "51":$pm="외국은행";
			break;
			case "53":$pm="한국씨티";
			break;
			case "54":$pm="HSBC(홍콩상하이은행)";
			break;
			case "55":$pm="도이치은행";
			break;
			case "56":$pm="에이비엔암로은행";
			break;
			case "58":$pm="미즈호코퍼레이트은행";
			break;
			case "59":$pm="미쓰비시도쿄UFJ은행";
			break;
			case "60":$pm="B. O. A";
			break;
			case "71":$pm="우체국";
			break;
			case "72":$pm="우체국";
			break;
			case "73":$pm="우체국";
			break;
			case "74":$pm="우체국";
			break;
			case "75":$pm="우체국";
			break;
			case "76":$pm="신용보증기금";
			break;
			case "77":$pm="기술신용보증기금";
			break;
			case "81":$pm="하나";
			break;
			case "82":$pm="하나";
			break;
			case "83":$pm="우리";
			break;
			case "84":$pm="우리";
			break;
			case "85":$pm="새마을금고";
			break;
			case "86":$pm="새마을금고";
			break;
			case "88":$pm="신한";
			break;
			case "95":$pm="경찰청";
			break;
			case "99":$pm="금융결제원";
			break;

		}

		return $pm;

	}



	function location_is($url,$option,$text){

		if($text and $url){
			echo "
			<script language=javascript>
				alert('$text');
				location.href='$url?$option';
			</script>
			";
		}else if(!$text and $url){
			echo "
			<script language=javascript>
				location.href='$url?$option';
			</script>
			";
		}else if($text and !$url){
			echo "
			<script language=javascript>
				alert('$text');
				history.back();
			</script>
			";
		}else if(!$text and !$url){
			echo "
			<script language=javascript>
				history.back();
			</script>
			";
		}

	}


	function location_is_reload($url,$option,$text){

		if($text and $url){
			echo "
			<script language=javascript>
				alert('$text');
				location.href='$url?$option';
				opener.location.reload();
			</script>
			";
		}else if(!$text and $url){
			echo "
			<script language=javascript>
				location.href='$url?$option';
			opener.location.reload();
			</script>
			";
		}else if($text and !$url){
			echo "
			<script language=javascript>
				alert('$text');
				opener.location.reload();
				window.close();
			</script>
			";
		}else if(!$text and !$url){
			echo "
			<script language=javascript>
				opener.location.reload();
				window.close();
				history.back();
			</script>
			";
		}

	}

	function location_is_close($text){

		if($text){
			echo "
			<script language=javascript>
				alert('$text');
				window.close();
				opener.location.reload();
			</script>
			";
		}else{
			echo "
			<script language=javascript>
				window.close();
			opener.location.reload();
			</script>
			";
		}

	}

	function location_is_direct($url,$option,$text){

		if($url){
			echo "
			<script language=javascript>
				window.close();
				opener.location.href='$url?$option';
			</script>
			";
		}else{
			echo "
			<script language=javascript>
				window.close();
			opener.location.reload();
			</script>
			";
		}

	}

	function window_close_is($text){

		if($text){
			echo "
			<script language=javascript>
				alert('$text');
				window.close();
			</script>
			";
		}else{
			echo "
			<script language=javascript>
				window.close();
			</script>
			";
		}

	}

function w_date($w){


		switch($w) {

		case 0:$w_date="<font color=red>일</font>";
		break;

		case 1:$w_date="월";
		break;

		case 2:$w_date="화";
		break;

		case 3:$w_date="수";
		break;

		case 4:$w_date="목";
		break;

		case 5:$w_date="금";
		break;

		case 6:$w_date="<font color=blue>토</font>";
		break;



		}

		return $w_date;

	}

function w_kanji_date($w){


		switch($w) {

		case 0:$w_date="日";
		break;

		case 1:$w_date="月";
		break;

		case 2:$w_date="火";
		break;

		case 3:$w_date="水";
		break;

		case 4:$w_date="木";
		break;

		case 5:$w_date="金";
		break;

		case 6:$w_date="土";
		break;



		}

		return $w_date;

	}


function _mulutiByteStrCut($str,$limit,$after_str){ 
        $_val = $str; 
        $_val  = mb_strcut( $_val,0,$limit); 
        if(strlen($str) > $limit ){ 
            $_val .= $after_str; 
        } 
        return $_val; 
    } 


	function stringcut( $String, $Length, $EndMark='' )
{
		$String=str_replace("\"","",$String);
		$String=str_replace("'","",$String);
       // 자를필요없으면 리턴
       if( strlen( stripslashes($String) ) <= $Length ) return stripslashes($String);

       for( $i=0; $i<strlen( $String ); $i++ )
       {
              //아스키코드 129 번부터는 2 Byte 문자
              //2 Byte 문자인경우 1 Byte 를 더 읽은 샘으로 침.
              if( ord( substr( $String, $i-1, $i ) ) > 128 )
              {
                      $i++;
                      $Length++;
              }
              //$Length 까지 왔을경우 리턴
              if( $i >= $Length )
                     return stripslashes(substr( $String, 0, $Length )).$EndMark;
       }
       // 자를필요가 없지만 글자수와 byte 수를 비교하지 못함으로
       // 루프를 다돌아도 리턴되지 않는다면 그냥 월래 문자열 return;
       return stripslashes($String);
}

function stringcututf($str, $len, $checkmb=false, $tail='...') {
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);
 
    $m    = $match[0];
	$str=stripslashes($str);
    $slen = strlen($str);  // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters
 
    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;
 
    $ret   = array();
    $count = 0;
 
    for ($i=0; $i < $len; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
 
        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }
 
    return stripslashes(join('', $ret).$tail);
}

function stringcutname($str, $len, $checkmb=false, $tail='**') {
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);
 
    $m    = $match[0];
	$str=stripslashes($str);
    $slen = strlen($str);  // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters
 
    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;
 
    $ret   = array();
    $count = 0;
 
    for ($i=0; $i < $len; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
 
        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }
 
    return stripslashes(join('', $ret).$tail);
}

function removeHackTag($content) 
    {

        // iframe 제거
        $content = preg_replace("!<iframe(.*?)<\/iframe>!is", '', $content);

        // script code 제거
        $content = preg_replace("!<script(.*?)<\/script>!is", '', $content);

        // meta 태그 제거
        $content = preg_replace("!<meta(.*?)>!is", '', $content);

        // style 태그 제거
        $content = preg_replace("!<style(.*?)<\/style>!is", '', $content);

        // XSS 사용을 위한 이벤트 제거
        $content = preg_replace_callback("!<([a-z]+)(.*?)>!is", removeJSEvent, $content);

        /**
        * 이미지나 동영상등의 태그에서 src에 관리자 세션을 악용하는 코드를 제거
        * - 취약점 제보 : 김상원님
        **/
        $content = preg_replace_callback("!<([a-z]+)(.*?)>!is", removeSrcHack, $content);

        return $content;
    }

function removeJSEvent($matches) 
    {
        $tag = strtolower($matches[1]);
        if(preg_match('/(src|href)=("|\'?)javascript:/i',$matches[2])) $matches[0] = preg_replace('/(src|href)=("|\'?)javascript:/i','$1=$2_javascript:', $matches[0]);
        return preg_replace('/ on([a-z]+)=/i',' _on$1=',$matches[0]);
}

function removeSrcHack($matches){
        $tag = strtolower(trim($matches[1]));

        $buff = trim(preg_replace('/(\/>|>)/','/>',$matches[0]));
        $buff = preg_replace_callback('/([^=^"^ ]*)=([^ ^>]*)/i', fixQuotation, $buff);

        $oXmlParser = new XmlParser();
        $xml_doc = $oXmlParser->parse($buff);

        // src값에 module=admin이라는 값이 입력되어 있으면 이 값을 무효화 시킴
        $src = $xml_doc->{$tag}->attrs->src;
        $dynsrc = $xml_doc->{$tag}->attrs->dynsrc;
        if(_isHackedSrc($src) || _isHackedSrc($dynsrc) ) return sprintf("<%s>",$tag);

        return $matches[0];
    }

function _isHackedSrc($src) {
        if(!$src) return false;
        if($src && preg_match('/javascript:/i',$src)) return true;
        if($src) 
        {
            $url_info = parse_url($src);
            $query = $url_info['query'];
            $queries = explode('&', $query);
            $cnt = count($queries);
            for($i=0;$i<$cnt;$i++) 
            {
                $pos = strpos($queries[$i],'=');
                if($pos === false) continue;
                $key = strtolower(trim(substr($queries[$i], 0, $pos)));
                $val = strtolower(trim(substr($queries[$i] ,$pos+1)));
                if(($key == 'module' && $val == 'admin') || $key == 'act' && preg_match('/admin/i',$val)) return true;
            }
        }
        return false;
}

	?>
