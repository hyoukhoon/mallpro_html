<!DOCTYPE html>
<html>
<head>
<title>Multiple File Upload with PHP</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/pure-min.css">
<link rel="stylesheet" type="text/css" href="css/fileupload.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<!-- javascript dependencies -->
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<!-- main script -->
<script type="text/javascript" src="js/fileupload.js"></script>
<script type="text/javascript">
//var upfiles_cnt = 0; // 전역변수 선언
function viewFileList() {
	var input = document.getElementById("files");
	var ul = document.getElementById("fileList");
	while (ul.hasChildNodes()) {
		ul.removeChild(ul.firstChild);
	}
	//upfiles_cnt = input.files.length; // upload 파일 수 구하기
	for (var i = 0; i < input.files.length; i++) {
		var li = document.createElement("li");
		li.innerHTML = input.files[i].name;
		ul.appendChild(li);
	}
	if(!ul.hasChildNodes()) {
		var li = document.createElement("li");
		li.innerHTML = 'No Files Selected';
		ul.appendChild(li);
	}
}
</script>
</head>
<body>
<div class="container">
	<div class="status"></div>
	<form id="form" action="fileupload.php" method="post" enctype="multipart/form-data" class="pure-form">
		<input type="file" id="files" name="files[]" multiple="multiple" onChange="viewFileList();" />
		<input type="submit" value="Upload" class="pure-button pure-button-primary" />
	</form>
	<ul id="fileList"><li>No Files Selected</li></ul>
	<div class="progress">
		<div class="bar"></div >
		<div class="percent">0%</div >
	</div>

</div><!-- end .container -->

</body>
</html>