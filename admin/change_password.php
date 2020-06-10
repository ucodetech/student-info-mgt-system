<?php
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
 if (!is_logged_in()) {
   login_error_redirect();
 }
 if (!has_permission('admin')) {
		permission_error_redirect();
	}
 include 'includes/head.php';
       $hashed = $user_data['password'];
       $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
       $old_password = trim($old_password);
       $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
       $password = trim($password);
       $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
       $confirm = trim($confirm);
       $new_hashed = password_hash($password, PASSWORD_DEFAULT);
       $user_id = $user_data['id'];
       $errors = array();
 ?>
 		<div class="content">
 			<?php
 			if ($_POST) {
 				//form validetion
 				if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
 					$errors[] = 'You must provide value for all fields';
 				}
          // if new password matches Confirm
          if ($password != $confirm) {
            $errors[] = 'The New Password does not match Confirm password!';
          }
 					//password is more than 6 charaters
 					if (strlen($password )< 6) {
 						$errors[] = 'Password must be atleast 6 characters';
 					}


 			if(!password_verify($old_password, $hashed)) {
 					$errors[] = 'old Password does not match our record';
 				}

 				//check for errors
 			if (!empty($errors)) {
 				echo display_errors($errors);
 			}else{
 				// change password
        $db->query("UPDATE admin SET password = '$new_hashed' WHERE id = '$user_id'");
        $_SESSION['success_flash'] = 'Your password has been updated!';
        header('Location:index.php');

 			}
 			}
 			?>

 		<h2 class="text-center">Change Password</h2>
 		<form action="change_password.php" method="post">
 			<div class="form-group">
 				<label for="old_password">Old_password:*</label>
 				<input type="password" name="old_password" id="old_password" value="<?=$old_password;?>" class="form-control">
 			</div>
 			<div class="form-group">
 				<label for="password"> New Password:*</label>
 				<input type="password" name="password" id="password"
 				value="<?=$password;?>" class="form-control" >
 			</div>
      <div class="form-group">
 				<label for="confirm">Confirm New Password:*</label>
 				<input type="password" name="confirm" id="confirm"
 				value="<?=$confirm;?>" class="form-control" >
 			</div>
 			<div class="form-group">
        <a href="dashboard.php" class = "btn btn-danger">Cancel</a>
 				<input type="submit" value="Change Password" class="btn btn-primary">
 			</div>
 		</form>
 	</div>
 <?php include 'includes/bootfooter.php'; ?>