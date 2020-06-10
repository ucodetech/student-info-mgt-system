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

 ?>


 		<div class="container">

 				<?php 
 		
        $full_name = ((isset($_POST['full_name']))?sanitize($_POST['full_name']): '');
        $username = ((isset($_POST['username']))?sanitize($_POST['username']): '');
        $email = ((isset($_POST['email']))?sanitize($_POST['email']): '');
        $password = ((isset($_POST['password']))?sanitize($_POST['password']): '');
        $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']): '');
        $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']): '');
        $courseHandle_id = ((isset($_POST['courseHandle_id']))?sanitize($_POST['courseHandle_id']): '');
        $errors = array();
        if ($_POST) {

            $usernameQuery = $db->query("SELECT * FROM lecturar WHERE username = '$username' ");
            $usernameCount = mysqli_num_rows($usernameQuery);
             if ($usernameCount != 0 ) {
               $errors[] = 'That lecturar already exist in the database!';
             }

          $required = array('full_name', 'email', 'password', 'confirm', 'permissions', 'courseHandle_id');
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
            $lecture_login_name = 'compsci'.'.'.$username;
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO lecturar (full_name, username, email, courseHandle_id, password,permissions) VALUES (?,?,?,?,?,?); ";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            	$errors[] = 'SQL Error';
            }else{
            	mysqli_stmt_bind_param($stmt, "ssssss",$full_name,$lecture_login_name, $email, $courseHandle_id, $hashed, $permissions );
            $result = 	mysqli_stmt_execute($stmt);
              if ($result) {
                $_SESSION['success_flash'] = 'Lecturar added successfully!';
                header('Location: all_lecturars.php');
              }else{
                echo 'Error'.mysqli_error($db);
              }
            	
            }

            // $db->query("INSERT INTO admin (full_name, email, password,permissions) VALUES ('$full_name', '$email', '$hashed', '$permissions') ");

              
          }
        }

      ?>


 				 
<form method="POST" action="add_lecturar.php">
<h3 class="text-primary text-center">Add Lecturar</h3>

<div class="col-md-12 form-group">
	<label>Lecturar Full Name: <span class="text-danger">*</span></label>
	<input type="text" name="full_name" class="form-control">
</div>
<div class="col-md-12 form-group">
	<label>Lecturar Email: <span class="text-danger">*</span></label>
	<input type="email" name="email" class="form-control">
</div>
<div class="col-md-12 form-group">
	<label>Lecturar Username: <span class="text-danger">*</span></label>
	<input type="text" name="username" class="form-control">
</div>
<div class="col-md-12 form-group">
	<label>Lecturar Password: <span class="text-danger">*</span></label>
	<input type="password" name="password" class="form-control">
</div>
<div class="col-md-12 form-group">
	<label>Confirm Password: <span class="text-danger">*</span></label>
	<input type="password" name="confirm" class="form-control">
</div>
<?php $sqlquery = $db->query("SELECT * FROM master_subjects ORDER BY id DESC");
            ?>
 <div class="col-md-12 form-group">
 <label for="permissions">Course Designated</label><br>
<select name="courseHandle_id" id="courseHandle_id">
  <option></option>
    <?php while ($row = mysqli_fetch_assoc($sqlquery)): ?>
 <option value="<?=$row['id'];?>"><?=$row['id'];?> <?=$row['sub_code'];?> <?=$row['sub_name'];?></option>
<?php endwhile; ?>
	</select>
</div>
<div class="form-group col-md-12">
<label for="permissions">Permissions</label><br>
<select  name="permissions">
<option value=""<?=(($permissions == '')?' selected': '');?>></option>
<option value="lecturar"<?=(($permissions == 'lecturar')?' selected': '');?>>Lecturar</option>
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
select, option {
	background-color: #456;
	border: none;
	font-size: 18px;
	color:skyblue;
	width: 40%;
	border-radius: 10px;
	height: 50px;
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