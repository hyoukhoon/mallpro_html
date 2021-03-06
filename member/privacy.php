<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$mode=$_GET['mode'];
$SELLER_CODE=$_GET['SELLER_CODE'];
$CONTRACT_ID=$_GET['CONTRACT_ID'];


$title="이용약관";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>몰프로</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script>
	$(function(){
	
	$( "#start_date, #end_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

	$( "#cont_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

});
</script>
<style>
.ui-datepicker-trigger { position:relative;top:7px ;left:0px ; }
 /* {} is the value according to your need */
</style>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>개인정보처리방침</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
	  <!-- GRID S-->


              <div class="list_table_list01">
                <table width="100%" border="0" >

                  <tbody>

					<tr>
						<td  style="text-align:center;">
							<textarea name="yak" style="width:100%;height:700px;">
주식회사 몰프로(이하 “회사”)는 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 등 모든 관련 법규를 준수하며, 회사의 서비스를 이용하는 고객(이하 “이용자”)의 개인정보가 보호받을 수 있도록 최선을 다하고 있습니다. 회사는 개인정보처리방침의 공개를 통하여 이용자의 개인정보가 어떠한 목적과 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지를 알려 드립니다. 본 개인정보처리방침은 관련 법령의 개정이나 회사 내부방침에 의해 변경될 수 있으므로 회원 가입 시나 사이트 이용 시에 수시로 확인하여 주시기 바랍니다.  

제 1 조 [수집하는 개인정보의 항목 및 수집방법]

①수집하는 개인정보의 항목

1.회사는 회원가입 또는 서비스 이용 시 고객상담, 각종 서비스의 제공을 위하여 다음과 같은 개인정보를 수집 이용하고 있습니다.
가.필수정보 
아이디, 비밀번호, 이메일
나.선택정보 
추천인아이디

※선택 항목을 입력하지 않은 경우에도 서비스 이용의 제한은 없습니다.

2.서비스 이용과정이나 사업처리 과정에서 다음과 같은 정보들이 자동으로 생성되어 수집 될 수 있습니다.
- ip address, 쿠키, 방문 일시, 서비스 이용 기록, 불량 이용 기록
3.유료 서비스 이용 시 다음과 같은 정보들이 수집될 수 있습니다.
가.신용카드 결제 시 : 카드사명, 카드번호 등

②개인정보 수집방법
회사는 다음과 같은 방법으로 개인정보를 수집합니다.
가.홈페이지 회원가입, 서비스 이용, 서면양식, 팩스, 전화, 상담게시판, 이메일, 이벤트 응모등
나.제휴사로부터의 제공
다.생성정보수집 툴 등
③회사는 기본적 인권침해의 우려가 있는 개인정보(인종 및 민족, 사상 및 신조, 출신지 및 본적지, 정치적 성향 및 범죄기록, 건강상태 및 성생활 등)는 요구하지 않습니다. 
  
제 2 조 [개인정보의 수집 및 이용목적]

회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다. 

1.서비스 제공에 관한 계약 이행 및 유료 서비스 제공에 따른 요금 정산, 콘텐츠 제공, 유료 서비스 이용에 대한 과금, 구매 및 요금 결제, 본인인증, 요금 추심
2.회원관리
회원제 서비스 이용에 따른 본인확인, 개인식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 중복가입 확인, 가입의사 확인, 분쟁 조정을 위한 기록보전, 불만처리 등 민원처리, 고지사항 전달
3.신규 서비스 개발 및 마케팅 및 광고에 활용
신규 서비스 개발 및 맞춤 서비스 제공, 통계학적 특성에 따른 서비스 제공 및 광고 게재, 서비스의 유효성 확인, 접속 빈도 파악, 회원의 서비스 이용에 대한 통계, 이벤트 정보 및 참여기회 제공, 광고성 정보 제공
 
제 3 조 [개인정보의 공유 및 제공]

①회사는 이용자의 개인정보를 제2조(개인정보의 수집 및 이용목적)에서 고지한 범위 내에서 이용하며, 이용자의 사전 동의 없이는 동 범위를 초과하여 이용하거나 타인 또는 타 기관에 제공 또는 공유하지 않습니다. 다만, 다음의 경우에는 예외로 합니다.

1.이용자가 사전에 동의 한 경우
2.법령의 규정에 의거하거나, 수사상 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우
3.서비스 제공에 따른 요금 정산을 위해 필요한 경우
4.통계작성, 학술연구 또는 시장조사를 위하여 개인을 식별할 수 없는 형태로 제공하는 경우

②회사는 이용자에 대하여 보다 질 높은 서비스 제공 등을 위해 사전에 동의를 획득한 경우에 한하여 이용자의 개인정보를 제공하고 있습니다.
 
 
제 4 조 [개인정보의 보유 및 이용기간]

①이용자의 개인정보는 이용자가 회원탈퇴를 요청하거나 제공한 개인정보의 수집 및 이용에 대한 동의를 철회하는 경우, 또는 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 보존근거에서 명시한 근거에 따라 보존기간 동안 보존합니다.

1.보존 항목 : 아이디
2.보존 근거 : 회원 탈퇴 시 소비자의 불만 및 분쟁해결 등을 위한 목적, 부정 이용 방지, 불법적 이용자에 대한 관련 기관 수사협조
3.보존 기간 : 12개월

②상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계 법령의 규정에 의해 보존할 필요성이 있는 경우, 회사는 관계법령에서 정한 일정한 기간 이상 이용자의 개인정보를 보관할 수 있습니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며, 보존근거에서 명시한 근거에 따라 보존기간 동안 보존합니다.

1.계약 또는 청약철회 등에 관한 기록
가.보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
나.보존기간: 5년
2.대금결제 및 재화 등의 공급에 관한 기록
가.보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
나.보존기간: 5년
3.전자금융 거래에 관한 기록
가.보존근거: 전자금융거래법
나.보존기간: 5년
4.소비자의 불만 또는 분쟁처리에 관한 기록
가.보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
나.보존기간: 3년
5.표시/광고에 관한 기록
가.보존근거: 전자상거래 등에서의 소비자보호에 관한 법률
나.보존기간: 6개월
6.웹사이트 방문 기록
가.보존근거: 통신비밀보호법
나.보존기간: 3개월
 
제 6 조 [개인정보의 파기절차 및 방법]

이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기됩니다. 회사의 개인정보 파기절차 및 방법은 다음과 같습니다.
1.파기절차
가.이용자가 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 별도의 DB로 옮겨져 내부방침 및 기타 관계법령에 의한 정보보호 사유에 따라 일정 기간 저장 후 파기됩니다.
나.상기 개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되지 않습니다.
2.파기방법
가.종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.
나.전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.
 
제 7 조 [이용자 및 법정대리인의 권리와 그 행사방법]

①이용자는 언제든지 이용자 본인의 개인정보를 조회하거나 정정할 수 있으며, 가입해지(회원탈퇴) 또는 개인정보의 삭제를 요청할 수 있습니다. 단, 서비스 제공을 위해 반드시 필요한 개인정보를 삭제하는 경우 관련 서비스를 제공받지 못할 수 있습니다.
②이용자의 개인정보를 조회, 정정하기 위하여는 개인정보변경을, 가입해지(동의철회)를 위하여는 회원탈퇴를 클릭하여 본인 확인 절차 후 직접 조회, 정정 또는 가입해지(동의철회)할 수 있습니다. 또는 개인정보보호책임자 및 담당자에게 서면, 전화 또는 이메일로 연락하시면 본인 확인 절차 후 지체 없이 필요한 조치를 하겠습니다.
③개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다.
④회사는 이용자의 요청에 의해 해지 또는 삭제된 개인정보를 제5조(개인정보의 보유 및 이용기간)에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.
 
제 8 조 [개인정보의 자동 수집 장치의 설치, 운영 및 그 거부에 관한 사항]

①회사는 이용자에게 개인화되고 맞춤화된 서비스를 제공하기 위해 이용자의 정보를 저장하고 수시로 찾아내는 쿠키(Cookie)를 사용합니다. 쿠키는 웹사이트가 이용자의 웹브라우저(인터넷익스플로러, 파이어폭스, 크롬 등)로 전송하는 소량의 정보입니다.
②이용자는 쿠키에 대한 선택권을 가지고 있습니다. 이용자는 웹브라우저에서 [도구] > [인터넷옵션] > [개인정보] > [설정]을 선택함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때 마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수 있습니다. 단, 모든 쿠키의 저장을 거부하는 경우, 쿠키를 통해 회사에서 제공하는 서비스를 이용할 수 없습니다.
 
제 9 조 [개인정보의 기술적/ 관리적 보호 대책]

회사는 이용자의 개인정보를 처리함에 있어 개인정보가 분실, 도난, 유출, 변조 또는 훼손되지 않도록 안전성 확보를 위해 기술적, 관리적 대책을 마련하고 있습니다.
1.기술적 대책

가.이용자의 비밀번호는 암호화되어 있어 이용자 본인 외에는 알 수 없습니다.
나.회사는 암호화 통신을 통하여 네트워크 상에서 개인정보를 안전하게 전송할 수 있도록 하고 있습니다.
다.회사는 해킹이나 컴퓨터바이러스 등에 의해 이용자의 개인정보가 유출되거나 훼손되는 것을 막기 위해 최선을 다하고 있습니다.
라.회사는 개인정보의 훼손에 대비하여 자료를 수시로 백업하고 있고, 최신 백신프로그램을 이용하여 컴퓨터바이러스에 의한 피해를 방지하기 위한 조치를 취하고 있습니다.
마.회사는 시스템에 대한 접근통제, 권한 관리, 취약점 점검 등의 조치를 통해 보안성이 강화될 수 있도록 지속적으로 노력하고 있습니다.
2.관리적 대책

가.회사는 이용자의 개인정보에 대한 접근권한을 최소한의 인원으로 제한하고 있습니다.
나.회사는 개인정보처리자를 대상으로 개인정보 보호 의무 등에 관해 정기적인 교육을 실시하고 있습니다.
다.회사는 개인정보보호 업무를 전담하는 부서에서 개인정보처리방침 및 내부 규정 준수여부를 확인하여 문제가 발견될 경우, 즉시 바로 잡을 수 있도록 노력하고 있습니다.
라.이용자 본인의 부주의나 회사가 관리하지 않는 영역에서의 사고 등 회사의 귀책에 기인하지 않은 손해에 대해서는 회사는 책임을 지지 않습니다.
 
제 10 조 [영업 양수 등의 통지]

회사는 영업의 전부 또는 일부를 양도하거나 합병, 상속 등으로 그 권리, 의무를 이전하는 경우 이용자에게 관련 내용으로 다음의 항목을 통지합니다.

1.영업의 전부 또는 일부의 양도, 합병 또는 상속의 사실
2.권리, 의무를 승계한 자의 성명, 주소, 연락처
 
제 11 조 [개인정보보호책임자 및 담당자의 연락처]

①회사는 이용자의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 다음과 같이 개인정보보호책임자를 두고 있습니다.

개인정보보호책임자 : 권혁훈
전화번호 : 070-8810-8808
이메일 : partenon@hanmail.net

②기타 개인정보 침해에 대한 신고나 상담이 필요하신 경우 다음 기관에 문의하시기 바랍니다.
가. 개인정보침해신고센터(privacy.kisa.or.kr/ 국번 없이 118)
나. 대검찰청 사이버범죄수사단(cyberid@spo.go.kr/ 02-3480-3571)
다. 경찰청 사이버안전국(www.ctrc.go.kr/ 국번 없이 182)

라. 개인정보 분쟁조정위원회(kopico.go.kr/ 1833-6972)
 
제 12 조 [링크 사이트]

회사는 이용자에게 다른 회사의 웹사이트에 대한 링크를 제공할 수 있습니다. 이 경우 링크되어 있는 웹사이트가 개인정보를 수집하는 행위에 대해서는 본 개인정보처리방침이 적용되지 않습니다.
 
제 13 조 [기타]

본 개인정보처리방침의 내용 추가, 삭제 및 수정이 있을 시에는 최소 7일 전부터 홈페이지의 공지사항을 통해 고지할 것입니다.

공고일자 : 2019년 05월 14일
시행일자 : 2019년 05월 14일 
					</textarea>
						</td>
					</tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->
</form>


   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="button" class="button03" onclick="window.close();">창닫기</button></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
