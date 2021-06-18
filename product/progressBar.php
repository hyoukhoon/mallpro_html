<!DOCTYPE html>
<html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>
<body>

<h1>데이타를 수집하고 있습니다.<br>잠시만 기다려주십시오.</h1>

<div id="myProgress">
  <div id="myBar">1%</div>
</div>

<br>
<div id="closeButton" style="display:none;">
<button onclick="opener.location.reload();window.close();">창닫기</button> 
</div>
<script>
$(document).ready(function(){

  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 600);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
	  $("#closeButton").show();
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }

});

</script>

</body>
</html>