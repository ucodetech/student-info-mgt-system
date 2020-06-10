<?php

	  $db = mysqli_connect('127.0.0.1', 'uzbgraph_graveth', 'echo@mike12@@@','uzbgraph_student_info_system');
  session_start();
  if (mysqli_connect_errno()) {
    echo 'Database connection failed with errors: '  .mysqli_connect_error();
    die();
session_destroy();
  }

    // require_once  $_SERVER['DOCUMENT_ROOT']. '/studentinfosystem/config.php';
    // require_once BASEURL. 'helpers/helpers.php';
    // require_once BASEURL. 'config.php';


      if (isset($_SESSION['SBAdmin'])) {
      $user_id = $_SESSION['SBAdmin'];
      $query = $db->query("SELECT * FROM admin WHERE id = '$user_id'");
      $user_data = mysqli_fetch_assoc($query);
      $fn = explode(' ', $user_data['full_name']);
      $user_data['first'] = $fn[0];
      $user_data['last'] = $fn[1];
    }
    
    if (isset($_SESSION['LECturar'])) {
      $lecturar_id = $_SESSION['LECturar'];
      $lecquery = $db->query("SELECT * FROM lecturar WHERE id = '$lecturar_id'");
      $lecturar_data = mysqli_fetch_assoc($lecquery);
      $lec = explode(' ', $lecturar_data['full_name']);
      $lecturar_data['first'] = $lec[0];
      $lecturar_data['last'] = $lec[1];
    }

     if (isset($_SESSION['STuser'])) {
      $student_id = $_SESSION['STuser'];
      $studentquery = $db->query("SELECT * FROM student WHERE id = '$student_id'");
      $student_data = mysqli_fetch_assoc($studentquery);
      $name = explode(' ', $student_data['full_name']);
      $student_data['first'] = $name[0];
      $student_data['last'] = $name[1];
      $llogin = explode(' ', $student_data['last_login']);
      $student_data['last_login'] = $llogin[1];
      
    }

  if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success"><p class="text-light text-center">'.$_SESSION['success_flash'].'</p></div>';
      unset($_SESSION['success_flash']);
    }


  if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-danger"><p class="text-light text-center">'.$_SESSION['error_flash'].'</p></div>';
      unset($_SESSION['error_flash']);
    }


 ?>
