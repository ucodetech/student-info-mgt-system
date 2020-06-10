<?php
     require_once '../core/init.php';
  require_once '../helpers/helpers.php';
  include 'includes/head1.php';


 $username = ((isset($_POST['username']))?sanitize($_POST['username']):'');
 $username = trim($username);
 $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
 $password = trim($password);
 $errors = array();
 ?>
 <style type="text/css">
 	body{
 		background-image:url(../images/18541.jpg);
 		background-repeat:repeat;
 		background-size: 100vw 100vh;
 		background-attachment: fixed;
 		color:#fff;
}
/*#login-form{*/
/*    width:60%;*/
/*    height: 60%;*/
/*    border: 2px solid black;*/
/*    border-radius: 15px;*/
/*    margin: 8% auto;*/
/*    padding: 15px;*/
/*    color: #fff;*/
/*    font-weight: bold;*/
/*     background-color: #a256aa;*/
/*}*/
.big{
  font-size: 60px;
  color: red;
  padding-right:60px;
}
.bg-steel{
  background-color: #5f788a;
}
.content-section{
  padding: 10px 20px;
  border: 5px solid #ddd;
  border-radius: 20px;
  box-shadow: 7px 7px 15px rgb(234,222,0,0.6);
  margin: 8% auto;
  padding: 15px;
  background-color: #709;
  width: 60%;
  font-weight: bolder;
  font-size: 20px;
  color: #fff;
}
@media screen and (max-width: 420px) {
.content-section{
  border: 5px solid #ddd;
  border-radius: 20px;
  box-shadow: 7px 7px 15px rgb(234,222,0,0.6);
  margin:auto;
  padding: 15px;
  background-color: #709;
  width: 100%;
  font-weight: bolder;
  font-size: 20px;
  color: #fff;
  margin: 8% auto;

}
}


 </style>
 	<div id="login-form" class="content-section text-light">
 	
 			<?php
 			if ($_POST) {
 				//form validetion
 				if (empty($_POST['username']) || empty($_POST['password'])) {

 					$errors[] = 'You must provide username and password';
 				}
 				
 					//password is more than 6 charaters
 					if (strlen($password )< 6) {
 						$errors[] = 'Password must be atleast 6 characters';
 					}


 				//check if username exit in the database
 				$query = $db->query("SELECT * FROM student WHERE username = '$username'");
 				$student = mysqli_fetch_assoc($query);
 				$studentCount = mysqli_num_rows($query);
 				if ($studentCount < 1) {
 					$errors[] = 'student does not exit in the database';
 				}
 			if(!password_verify($password, $student['password'])) {
 					$errors[] = 'Wrong Password! Retype';
 				}

 				//check for errors
 			if (!empty($errors)) {
 				echo display_errors($errors);
 			}else{
 				// login student in
 				$student_id = $student['id'];
 				studentlogin($student_id);
 			}
 			}
 			?>

 		<h2 class="text-center"><i class="fa fa-user big"></i>Login</h2>
 		<form action="login.php" method="post">
 			<div class="col-md-6 form-group">
 				<label for="username">Username:*</label>
 				<i class="fa fa-envelope form-inline"></i><input type="text" name="username" id="username"  class="form-control" >
 			</div>
 			<div class="col-md-6 form-group">
 				<label for="password">Password:*</label>
 				<i class="fa fa-lock form-inline"></i><input type="password" name="password" id="password"
 				 class="form-control" >
 			</div>
 			<div class="col-md-12 form-group">
        <a href="../student_reg.php" class="btn btn-danger">Don't Have Account?</a>
 				<input type="submit" value="Login" class="btn btn-primary">
 			</div>
      <hr>
      <a href="" class="text-warning">Forgotten Password?</a>
 		</form>
 		
 	</div>
