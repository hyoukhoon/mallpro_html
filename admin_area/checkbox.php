<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<style>
.checks {position: relative;} 

.checks input[type="checkbox"] { 
	/* 실제 체크박스는 화면에서 숨김 */ 
	position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip:rect(0,0,0,0); border: 0 
} 

.checks input[type="checkbox"] + label { 
	display: inline-block; position: relative; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; 
} 

.checks input[type="checkbox"] + label:before { 

/* 가짜 체크박스 */ 
content: ' '; display: inline-block; width: 21px; /* 체크박스의 너비를 지정 */ height: 21px; /* 체크박스의 높이를 지정 */ line-height: 21px; /* 세로정렬을 위해 높이값과 일치 */ margin: -2px 8px 0 0; text-align: center; vertical-align: middle; background: #fafafa; border: 1px solid #cacece; border-radius : 3px; box-shadow: 0px 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05); 
}

.checks input[type="checkbox"] + label:active:before, 

.checks input[type="checkbox"]:checked + label:active:before { 

	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1); 
	
}
	
.checks input[type="checkbox"]:checked + label:before { 
	
	/* 체크박스를 체크했을때 */ 
	content: '\2714';
	
	/* 체크표시 유니코드 사용 */ 
	color: #99a1a7; text-shadow: 1px 1px #fff; background: #e9ecee; border-color: #adb8c0; box-shadow: 0px 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1); 

}


</style>
<div class="checks"> <input type="checkbox" id="ex_chk"> <label for="ex_chk">체크박스</label> </div>
