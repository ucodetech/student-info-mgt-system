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

   if (isset($_GET['delete'])) {
     $deleteid = (int)$_GET['delete'];
      $singlesResults = $db->query("DELETE FROM student_marks  WHERE id = '$deleteid'");
    	$_SESSION['success_flash'] = 'deleted';
      header("Location: student_mark.php?success");
      }
     

    