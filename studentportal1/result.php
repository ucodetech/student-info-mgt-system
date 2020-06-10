<?php 
 		require_once '../core/init.php';
        require_once '../helpers/helpers.php';
 	      if (!is_Slogged_in()) {
    stdlogin_error_redirect();
  }
    include 'includes/head.php'; 

 $sub_code = ((isset($_GET['sub_code']))?sanitize($_GET['sub_code']): '');
 $reg_id = ((isset($_GET['reg_id']))?sanitize($_GET['reg_id']): '');
 $errors = array();
 ?>
  <div class="content">
     <div class="container-fluid form">
     	 <div class="col-md-12">
     	<h3 class="text-center">Marked Assignment</h3> <hr>

     	 	<div class="row">
  
 <?
if (isset($_GET['score'])) {
	$scoreid = (int)$_GET['score'];

 	$sqlall = "SELECT  * FROM `student_marks` WHERE  sub_id = '$scoreid'  ORDER BY id DESC ";
      $queryall =$db->query($sqlall);
   
  if (mysqli_num_rows($queryall) > 0) {
    while ($row = mysqli_fetch_assoc($queryall)) {
      $code2  = $row['sub_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code2' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
      <div class="col-md-6 text-center b1">
     	 			<p class="text-info">
     	 				Course Code
     	 		<span class="val-c"><?=$resu['sub_code'];?></span>
     	 			</p>
     	 		</div>
     	 		<div class="col-md-6 text-center b1">
     	 			<p class="text-info">
     	 				Course Title
     	 				<span class="val-c"><?=$resu['sub_name'];?></span>
     	 			</p>
     	 		</div>
     	 		<div class="col-md-6 text-center b2">
     	 			<p class="text-info text-danger">
     	 				Maximum Score 
     	 				<span class="val"><?=$row['stu_max_scores'];?></span>
     	 			</p>
     	 		</div>
     	 		<div class="col-md-6 text-center b2">
     	 			<p class="text-info text-success">
     	 				Score Obtained 
     	 				<span class="val"><?=$row['stu_scores_ob'];?></span>
     	 			</p>
     	 		</div>
     	 	</div>
   
      <?
    }
}
 
}
?>
      </div>

  </div> <hr>
  <div class="col-md-12">
  	<meta http-equiv="refresh" content="30; url=dashboard.php">
    <h4 class="move">Redirecting You Back to dashboard... In 30seconds</h4>
  <div class="text-left" id="backed">
   
  </div>
  <div class="text-center">
     <img src="../preloader/uzb.svg" width="100" height="100">
  </div>
  </div>
   </div>
<?php include 'includes/bootfooter.php' ?>
<script type="text/javascript">

</script>
   <style type="text/css">
   	 .b1{
     border: 1px solid #edd;
     padding: 10;
     text-align: center;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
  }
  .b2{
     border: 1px solid #edd;
     margin-top: 10px;
     padding: 10;
     text-align: center;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
  }
  p{
  	font-size: 20px;
  }
   span.val-c{
  	color: black;
  	font-size: 25px;
  	display: block;
  }
  span.val{
  	color: blue;
  	font-size: 30px;
  	display: block;
  }
   .move{
		  	font-size: 20px;
		  	position: absolute;
		  	left: 30%;
		  	top: 70%;
		    animation-name: move;
		    animation-duration: 4s;
		    animation-delay: 2s;
		  }
		  @keyframes move {
		    from {left: 10px;}
		    to {right: 10px;}

		    from {color: red;}
		    to {color: green;}
		}


   </style>


 
