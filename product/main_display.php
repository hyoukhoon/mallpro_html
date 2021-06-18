<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";
?>

<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">상품관리 > 메인화면관리 &nbsp; </li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1">+메인상품추가</button></li>
			<li><button type="button" class="button05" id="add2">+프로모션추가</button></li>
			</ul>
		</div>
     </ul>
	

     
    
    <!-- 조회영역 S -->
       <div class="search_area">
					
   	     <div class="search_box">
   	       <table >
			     	       <colgroup>
                           <col width="170" />
                           <col width="88" />
                           <col width="*" />
                           </colgroup>
                      
                             <tr>
                               <td scope="col" class="title1">메뉴선택</td>
                               <td>
									<select name="menu1">
										<option value="Todaypick">Todaypick</option>
										<option value="Women">Women</option>
										<option value="Event">Event</option>
									</select>
									&nbsp;&nbsp;
									<select name="menu2">
										<option value="">메인동영상</option>
										<option value="">Mediapick신상품</option>
										<option value="">지금뜨는상품</option>
										<option value="">찜많이받은상품</option>
										<option value="">동대문인기매장</option>
									</select>
                              </td>
                               <td style="padding-left:30px;">
								<button class="button03_2">조회</button>
                              </td>
                             </tr>
           </table>

   	     </div>
	      </div>
     
     
      <!-- 조회영역 E -->
      
     
     
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>Women > 메인동영상</dt>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=3%/>
                  <col width=5%/>
                  <col width=9%/>
                  <col width=8%/>
                  <col width=10% />
                  <col width="*"/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=9% />
                  <col width=5% />
                  <col width=5% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col"><input type="checkbox"></th>
                      <th scope="col">노출순서</th>
					  <th scope="col">노출위치</th>
                      <th scope="col">구분</th>
                      <th scope="col">상품코드</th>
                      <th scope="col">상품/프로모션정보</th>
                      <th scope="col">매장명</th>
                      <th scope="col">등록(수정)일</th>
                      <th scope="col">진열/노출상태</th>
					  <th scope="col">진열/노출기간</th>
					  <th scope="col">조회수</th>
					  <th scope="col">찜수</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>0</td>
                      <td class="pl20">Women>메인동영상</td>
                      <td>상품</td>
                      <td>010700058</td>
                      <td>체크 BBY Women>자켓/코트</td>
                      <td>GRAYMOON</td>
                      <td class="pl20">2017-03-21</td>
					  <td>진열중</td>
					  <td>2017-03-21 ~ 2017-12-31</td>
					  <td>10</td>
					  <td>0</td>
                    </tr>
       
                     <tr>
                      <td><input type="checkbox"></td>
                      <td>1</td>
                      <td class="pl20">Women>메인동영상</td>
                      <td>상품</td>
                      <td>010700225</td>
                      <td>체크 BBY Women>자켓/코트</td>
                      <td>GRAYMOON</td>
                      <td class="pl20">2017-03-21</td>
					  <td>진열중</td>
					  <td>2017-03-21 ~ 2017-12-31</td>
					  <td>10</td>
					  <td>0</td>
                    </tr>
                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     
       <!-- page_skip -->
<div class="page_skip_area">
<div class="page_skip">
  <a href="#"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a>   
   <strong>11</strong>  <a href="#">12</a>  <a href="#">13</a>  <a href="#">14</a> <a href="#">15</a>  <a href="#">16</a>  <a href="#">17</a>  <a href="#">18</a>  <a href="#">19</a> <a href="#">20</a> 
  <a href="#"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a>  

<!-- //page_skip --> 



</div>       
    </div>     
  <!-- 메인메뉴 E -->


<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>