<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
  include 'includes/head1.php';



 ?>
 <style type="text/css">
  #login-form{
    width: 50%;
    height: 400px;
    background:#700;
    border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    margin: 8% auto;
    padding: 15px;
    color: #fff;
    font-weight: bold;
}
@media screen and (min-width: 420px) {
  #login-form{
    width: auto;
  }
}

@media screen and (min-width: 1024px) {
  #login-form {
    width: 50%;
  }
}
 </style>
 <div id="login-form">

     <?php
      if ($_POST) {

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $errors = array();
        //form validetion
        if (empty($_POST['username']) || empty($_POST['password'])) {

          $errors[] = 'You must provide Username and password';
        }
        
          //password is more than 6 charaters
          if (strlen($password )< 6) {
            $errors[] = 'Password must be atleast 6 characters';
          }


        //check if email exit in the database

        
        $query = $db->query("SELECT * FROM admin WHERE username = '$username'");
        $users = mysqli_fetch_assoc($query);
        $usersCount = mysqli_num_rows($query);
        if ($usersCount < 1) {
          $errors[] = 'You do not exit in the database';
         }
      if(!password_verify($password, $users['password'])) {
          $errors[] = 'Wrong Password! Retype';
        }

        //check for errors
      if (!empty($errors)) {
        echo display_errors($errors);
      }else{
        // login visitor in
        $user_id = $users['id'];
        login($user_id);

      }
      }
      ?>
    <h2 class="text-center ">Login </h2>
  <form method="POST" action="login.php">
    
    <div class="m-5">
    <div class="col-md-12  form-group">
      <label>Username:<span class="text-danger">*</span></label>
      <input type="text" name="username"  class="form-control">
    </div>
    <div class="col-md-12  form-group">
      <label>Password:<span class="text-danger">*</span></label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="col-md-12  form-group">
    <button type="submit" name="login" class="btn btn-success">Login</button>
    </div>
    
  </div>
  </form>
  
 </div>
 