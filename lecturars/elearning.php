<?php 
 require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_lectlogged_in()) {
    login_error_redirect();
  }
  if (!has_permission_lect('lecturar')) {
   lectpermission_error_redirect();
  }
  include 'includes/head.php';
  
 ?>

        <div class="content">
            <div class="container-fluid">
     	<p class="alert alert-info"> Coming Soon </p>
     </div>
     </div>
     
 <?php
     include 'includes/bootfooter.php';
  
 ?>