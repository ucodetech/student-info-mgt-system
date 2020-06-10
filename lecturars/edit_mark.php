<?php
    require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_lectlogged_in()) {
    login_error_redirect();
  }
  if (!has_permission_lect('lecturar')) {
   lectpermission_error_redirect();
  }
  include 'includes/head1.php';

   if (isset($_GET['unmark'])) {
     $unmarkid = (int)$_GET['unmark'];
      $singlesResults = $db->query("UPDATE assignm SET marked = 'no'  WHERE id = '$unmarkid'");
    	
      }
     if (!$singlesResults) {
     	echo "error";
     }else{
     	$_SESSION['success_flash'] = 'You have unmarked the assignment now you can delete!';
      header("Location: student_mark.php?success");
     }

    