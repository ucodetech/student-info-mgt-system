<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
  include 'includes/head1.php';



 ?>
 <style type="text/css">
 
 #login-form{
    width: 50%;
    height: 400px;
    border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    margin: 8% auto;
    padding: 15px;
    color: #fff;
    font-weight: bold;
      background-color: #061254;

}
.container-fluid{
  background-color: #061254;
}
label{
  color: skyblue;
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
@media screen and (max-width: 420px) {
  #login-form{
    width: 100%;
     border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    padding:5px;
    color: #fff;
    font-weight: bold;
    background-color#061254;
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

        
        $query = $db->query("SELECT * FROM lecturar WHERE username = '$username'");
        $lecturar = mysqli_fetch_assoc($query);
        $lecturarCount = mysqli_num_rows($query);
        if ($lecturarCount < 1) {
          $errors[] = 'You do not exit in the database';
         }
      if(!password_verify($password, $lecturar['password'])) {
          $errors[] = 'Wrong Password! Retype';
        }

        //check for errors
      if (!empty($errors)) {
        echo display_errors($errors);
      }else{
        // login visitor in
        $lecturar_id = $lecturar['id'];
        lectlogin($lecturar_id);

      }
      }
      ?>
    <h2 class="text-center">Login </h2>
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
    <a href="../index.php" class="btn btn-outline btn-danger">Cancel</a>
    </div>
    
  </div>
  </form>
  
 </div>
 