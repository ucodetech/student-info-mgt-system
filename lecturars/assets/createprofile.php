<?php 
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	if (!has_permission('admin')) {
		permission_error_redirect();
	}
	include 'includes/head1.php';


	 $sqlim = "SELECT *  FROM lecturar WHERE username = '$username' AND email   = '$email'";
            $resultim = $db->query($sqlim);
              if (mysqli_num_rows($resultim) > 0) {
                while ($row = mysqli_fetch_assoc($resultim)) {
                  $lectid = $row['id'];
                  $status = 1;
                  $sqlp = "INSERT INTO  lecturarprofile (lecturar_id, status) VALUES ('$lectid',$status)";
                  $result = $db->query($sqlp);

                }
              }

              if ($result) {
                $_SESSION['success_flash'] = 'Lecturar added successfully!';
                header('Location: all_lecturars.php');
              }else{
                echo 'Error'.mysqli_error($db);
              }
 ?>