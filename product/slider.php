<?php
	$img=$_GET["img"];
	$tf=explode(",",$img);
?>
<html>
<head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.slider').bxSlider();
    });
  </script>

</head>
<body>

  <div class="slider">
  <?php
	foreach($tf as $t){
  ?>
    <div><img src="/thumb/<?=$t?>" width="360"></div>
<?}?>
    </div>

</body>
</html>