<?php
    require_once '../core/init.php';
    require_once '../helpers/helpers.php';
      include 'includes/boothead.php';
    if (!is_Slogged_in()) {
    stdlogin_error_redirect();
  }
 ?>
 <style media="screen">
 .wrappers{
   width: 100%;
   height: 150px;
   background: green;
   border-radius: 10px;
 }
 .wrappers h4{
    padding: 60px;
    font-size: 80px;
    font-weight: bolder;
    color: white;
    outline: inherit;

 }
 .wrapperse{
   width: 100%;
   height: 150px;
   background: blue;
   border-radius: 10px;
 }
 .wrapperse h4{
    padding: 60px;
    font-size: 80px;
    font-weight: bolder;
    color: white;
    outline: inherit;

 }
 .wrapperssub{
   width: 100%;
   height: 150px;
   background: red;
   border-radius: 10px;
 }
 .wrapperssub h4{
   padding: 60px;
   font-size: 80px;
   font-weight: bolder;
   color: white;
   outline: inherit;
 }
 </style>
<body >

<div class="wrapper">

    <div class="sidebar" data-color="blue" data-image="assets/img/sd3.jpg" style="overflow:hidden; height: auto;">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
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
    	   <div class="sidebar-wrapper">
          <?php 
              $email =  '';
              $sql = "SELECT * FROM student WHERE id = '$student_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $studid = $row['id'];
                  
                  $sqlim = "SELECT * FROM studentprofile WHERE student_id = '$studid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='profile/profile".$studid.".jpg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='80' height='80'>
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
             

              <span class="nam text-default" ><?=$student_data['first']  ?><?=" "?><?=$student_data['last']  ?></span ><br>
             <span class="text-warning" style="margin: 10px;">last_login: <?=pretty_date($student_data['last_login']);?></span>
               
          
           <hr>

            <ul class="nav">
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fa fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                  <li>
                    <a href="personal.php">
                        <i class="pe-7s-graph"></i>
                        <p>Personal Details</p>
                    </a>
                </li>
                <li>
                    <a href="updateImage.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Update Profile Image</p>
                    </a>
                </li>
                <li>
                    <a href="student.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                        <i class="pe-7s-note2"></i>
                        <p>Table List</p>
                    </a>
                </li>
                 <li>
                    <a href="archived.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Archived</p>
                    </a>
                </li>
                <!-- <li>
                    <a href="typography.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Typography</p>
                    </a>
                </li> -->
               <!--  <li >
                    <a href="updates.php">
                        <i class="pe-7s-science"></i>
                        <p>Send Updates</p>
                    </a>
                </li> -->
                <li >
                    <a href="icons.php">
                        <i class="pe-7s-science"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Messages</p>
                    </a>
                </li>
                <!--  <li >
                    <a href="#formgoto" style="padding-bottom: 5px; margin-bottom: 10px;">
                        <i class="pe-7s-rocket"></i>
                       <p>Go to Top</p>
                    </a>
                </li> -->
                
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
                            </a>
                        </li>
                        
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="users.php">
                               Account
                            </a>
                        </li>
                        <?php require_once 'includes/uploads.php' ?>
                        <li>

                            <a href="logout.php">
                                Log out:<span class="text-danger"><?=$student_data['first']  ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>