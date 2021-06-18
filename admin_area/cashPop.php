<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$uid=$_GET['uid'];
$gubun=$_GET['gubun'];
$memberGubun=$_GET['memberGubun'];

if($memberGubun=="P" and $gubun=="cash"){
	$db="pixterCashList";
	$title="픽스터 캐쉬 리스트";
}else if($memberGubun=="P" and $gubun=="token"){
	$db="pixterTokenList";
	$title="픽스터 토큰 리스트";
}else if($memberGubun=="U" and $gubun=="cash"){
	$db="punterCashList";
	$title="펀터 캐쉬 리스트";
}else if($memberGubun=="U" and $gubun=="token"){
	$db="punterTokenList";
	$title="픽스터 토큰 리스트";
}

	$query="select * from $db where uid='$uid' order by num desc";
	$result = $mysqli->query($query) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
	
		$rsc[]=$rs;
		
			
	}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/to-do.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	<div class="row mt">
                  <div class="col-md-12">
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i><?=$title?></h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">

                                  <ul class="task-list">


<?php
foreach($rsc as $p){

?>

                                      <li>
                                          <div class="task-title">
                                              <span class="task-title-sp"><?=$p->income?></span>
                                              <div class="pull-right">
                                                  <?php
									if($gubun=="cash"){
										echo cashGubunis($p->gubun);
									  }else if($gubun=="token"){
										  echo tokenGubunis($p->gubun);
									  }
									  echo ",".$p->regDate;
									  ?>
                                              </div>
                                          </div>
                                      </li>
<?}?>
                                  </ul>
                              </div>

                              <div class=" add-task-row">
                                  <!-- <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Add New Tasks</a> -->
                                  <a class="btn btn-default btn-sm pull-right" href="javascript:window.close();">창닫기</a>
                              </div>
                          </div>
                      </section>
                  </div><!-- /col-md-12-->
              </div><!-- /row -->


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    <script src="assets/js/tasks.js" type="text/javascript"></script>

    <script>
      jQuery(document).ready(function() {
          TaskList.initTaskWidget();
      });

      $(function() {
          $( "#sortable" ).sortable();
          $( "#sortable" ).disableSelection();
      });

    </script>
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
