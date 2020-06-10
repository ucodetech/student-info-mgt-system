
<!doctype php>
<php lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../images/uzb.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Lecturar Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
<!--      jquery-flexdatalist-2.2.4-->
    <link href="../jquery-flexdatalist-2.2.4/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<style type="text/css">
    .nam{
            font-size: 20px;
            font-weight: bold;
             margin: 10px;

          }
          .onl{
            font-size: 50px;
            margin: 0;
            padding: 0;
            font-weight: bold;
          }
           .onl1{
            font-size: 16px;
            margin: 0;
            padding: 0;
           font-family: sans-serif;

          }
</style>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sd1.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <?php
             require_once '../core/init.php';
              require_once '../helpers/helpers.php';
              $email =  '';
              $sql = "SELECT * FROM lecturar WHERE id = '$lecturar_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $lectid = $row['id'];

                  $sqlim = "SELECT * FROM lecturarprofile WHERE lecturar_id = '$lectid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {


                        if ($rowimg['status'] == 0) {
                          echo "<img src='profile/profile".$lectid.".jpeg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='80' height='80'>
               <span class='text-success onl'>.</span>  <span class='onl1'>Online  </span> <br>";
                        }else{
                          ?>
                           <img src='profile/default.png' class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='80' height='80'>
               <span class="text-success onl">.</span>  <span class="onl1">Online  </span> <br>
                          <?php
                        }
                    }
                  }
                }
               }
           ?>


              <span class="nam text-default" ><?=$lecturar_data['first']  ?><?=" "?><?=$lecturar_data['last']  ?></span ><br>
             <span class="text-warning" style="margin: 10px;">last_login: <?=pretty_date($lecturar_data['last_login']);?></span>


           <hr>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                  <li>
                    <a href="student_mark.php">
                        <i class="pe-7s-id"></i>
                        <p>Student Mark</p>
                    </a>
                </li>
                 <li>
                    <a href="updateImage.php">
                        <i class="pe-7s-smile"></i>
                        <p>Update Image</p>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="pe-7s-config"></i>
                        <p>Lecturar Profile</p>
                    </a>
                </li>
                <li>
                    <a href="elearning.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>E-Learning</p>
                    </a>
                </li>
				 <li>
                    <a href="quzzle.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Quiz</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="dashboard.php" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>

                        <li>

                        <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-default"> <i class="fa fa-search"></i></button>
                        </form>


                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a href="logout.php">
                               <p>Log out</p> <span class="text-danger"><?=$lecturar_data['first'];?> </span>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>