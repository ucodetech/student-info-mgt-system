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


	if ($_POST) {
		
	 $sqlim = "SELECT *  FROM lecturar WHERE id = '$lecturar_id'";
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
                $_SESSION['success_flash'] = 'Profile created! now update your profile picture!(optional)';
                header('Location: profile.php');
              }else{
                echo 'Error'.mysqli_error($db);
              }
	}
 ?>