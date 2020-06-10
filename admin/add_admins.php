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

 ?>


 		<div class="content">

 				<?php 
 		
        $full_name = ((isset($_POST['full_name']))?sanitize($_POST['full_name']): '');
        $username = ((isset($_POST['username']))?sanitize($_POST['username']): '');
        $email = ((isset($_POST['email']))?sanitize($_POST['email']): '');
        $password = ((isset($_POST['password']))?sanitize($_POST['password']): '');
        $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']): '');
        $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']): '');
        $errors = array();
        if ($_POST) {

            $usernameQuery = $db->query("SELECT * FROM admin WHERE username = '$username' ");
            $usernameCount = mysqli_num_rows($usernameQuery);
             if ($usernameCount != 0 ) {
               $errors[] = 'That username already exist in the database!';
             }

          $required = array('full_name', 'email', 'password', 'confirm', 'permissions');
          foreach ($required as $f) {
            if(empty($_POST[$f])){
     
             $errors[] = 'All field must be filled';
              break;
            }
          }

            if(strlen($password) < 6) {
              $errors[] = 'Password must be atleast 6 characters!';
            }
            if ($password != $confirm) {
              $errors[] = 'Password do not match';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
              $errors[] = 'Invalid Email!';
            }


          if (!empty($errors)) {
            echo display_errors($errors);
          }else{
            //add user to database
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin (full_name, username, email, password,permissions) VALUES (?,?,?,?,?); ";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            	$errors[] = 'SQL Error';
            }else{
            	mysqli_stmt_bind_param($stmt, "sssss",$full_name, $username, $email, $hashed, $permissions );
            	mysqli_stmt_execute($stmt);

            	$_SESSION['success_flash'] = 'User added successfully!';
              	header('Location: all_admin.php');
            }

            // $db->query("INSERT INTO admin (full_name, email, password,permissions) VALUES ('$full_name', '$email', '$hashed', '$permissions') ");

              
          }
        }

      ?>


 				 
 				<form method="POST" action="add_admins.php">
 					<h3 class="text-primary text-center">Add Admin</h3>
 				
 						<div class="col-md-12 form-group">
 							<label>Admin Full Name: <span class="text-danger">*</span></label>
 							<input type="text" name="full_name" class="form-control">
 						</div>
 						<div class="col-md-12 form-group">
 							<label>Admin Email: <span class="text-danger">*</span></label>
 							<input type="email" name="email" class="form-control">
 						</div>
 						<div class="col-md-12 form-group">
 							<label>Admin Username: <span class="text-danger">*</span></label>
 							<input type="text" name="username" class="form-control">
 						</div>
 						<div class="col-md-12 form-group">
 							<label>Admin Password: <span class="text-danger">*</span></label>
 							<input type="password" name="password" class="form-control">
 						</div>
 						<div class="col-md-12 form-group">
 							<label>Confirm Password: <span class="text-danger">*</span></label>
 							<input type="password" name="confirm" class="form-control">
 						</div>
			 			<div class="form-group col-md-6">
			            <label for="permissions">Permissions</label>
			            <select class="form-control" name="permissions">
			              <option value=""<?=(($permissions == '')?' selected': '');?>></option>
			              <option value="editor"<?=(($permissions == 'editor')?' selected': '');?>>Editor</option>
			              <option value="admin,editor"<?=(($permissions == 'admin,editor')?' selected': '');?>>Admin</option>
			            </select>
			          </div>
 						<div class="col-md-12 form-group">
 							<a href="dashboard.php" class="alert alert-danger">Cancel</a>
 							<button class="btn btn-success" name="add" type="submit">Add</button>
 						</div>
 					
 				</form>
 			</div>
      <?php include 'includes/bootfooter.php'; ?>
<style type="text/css">
  
label{
  color: #456789;
  font-size: 20px;
  font-family:Cooper Black, serif;

}

input[type='text'],input[type='email'], input[type='number'],input[type='password']{
  background-color: #456;
  border: none;
  font-size: 18px;
  color:skyblue;

}
input[type='text'] placeholder{
  color: #fff;
}
input[type='text']:hover,input[type='email']:hover, input[type='number']:hover,input[type='password']:hover{
  background-color: #457;
  border: none;
}
input[type='text']:focus,input[type='email']:focus, input[type='number']:focus,input[type='password']:focus{
  background-color: #566656;
  border: 2px solid green;
  color:skyblue;
  
}
input[type='radio']{
  font-size: 18px;
  height: 25px;
    width: 25px;
}
input[type='radio']:checked{
background-color: #2196F3;
  height: 30px;
    width: 30px;
}
</style>