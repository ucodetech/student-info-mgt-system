<?php 
  require_once 'core/init.php';
  require_once 'helpers/helpers.php';
  include 'includes/head.php';

 ?>
 <style type="text/css">
  #Student_form{
    width:80%;
    height: 700px;
    border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    margin: 8% auto;
    padding: 15px;
    color: #fff;
    font-weight: bold;
    background-color: #061254c4;
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
#Student_form{
    width:100%;
    height: auto;
    border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    margin: 8% auto;
    padding: 15px;
    color: #fff;
    font-weight: bold;
    background-color: #061254;
    }

}
 </style>

   
      <div  id="Student_form">
        <?php 
      
        $full_name = ((isset($_POST['full_name']))?sanitize($_POST['full_name']): '');
        $username = ((isset($_POST['username']))?sanitize($_POST['username']): '');
        $email = ((isset($_POST['email']))?sanitize($_POST['email']): '');
        $password = ((isset($_POST['password']))?sanitize($_POST['password']): '');
        $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']): '');
        $errors = array();
        if ($_POST) {

            $usernameQuery = $db->query("SELECT * FROM student WHERE username = '$username' ");
            $usernameCount = mysqli_num_rows($usernameQuery);
             if ($usernameCount != 0 ) {
               $errors[] = 'That username already exist in the database!';
             }

          $required = array('full_name','email','username', 'password', 'confirm');
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
            $sql = "INSERT INTO student (full_name, email, username,  password) VALUES (?,?,?,?); ";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              $errors[] = 'SQL Error';
            }else{
              mysqli_stmt_bind_param($stmt, "ssss",$full_name, $email, $username,  $hashed);
              mysqli_stmt_execute($stmt);

            $sqlim = "SELECT *  FROM student WHERE username = '$username' AND email   = '$email'";
            $resultim = $db->query($sqlim);
            $resultp = '';
              if (mysqli_num_rows($resultim) > 0) {
                while ($row = mysqli_fetch_assoc($resultim)) {
                  $studentid = $row['id'];
                  $status = 1;
                  $sqlp = "INSERT INTO  studentprofile (student_id, status) VALUES ('$studentid',$status)";
                  $resultp = $db->query($sqlp);

                }
              }

               $_SESSION['success_flash'] = 'You have created your account successfully!';
                header('Location: studentportal1/login.php');
            }

            // $db->query("INSERT INTO Student (full_name, email, password,permissions) VALUES ('$full_name', '$email', '$hashed', '$permissions') ");

              
          }
        }

      ?>


         
        <form method="POST" action="student_reg.php">
          <h2 class="text-light text-center">Create Account to Begin</h2>
        
         <div class="col-md-12 form-group">
              <label>Student Full Name: <span class="text-danger">*</span></label>
              <input type="text" name="full_name" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label>Student Email: <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label>Student Username: <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label>Student Password: <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <label>Confirm Password: <span class="text-danger">*</span></label>
              <input type="password" name="confirm" class="form-control">
            </div>
            <div class="col-md-12 form-group">
              <a href="index.php" class="btn btn-danger">Cancel</a>
              <button class="btn btn-success" name="add" type="submit">Create Account</button>
            </div>
          <span>Already Have aan account?</span><a href="studentportal1/login.php"> Login</a>
        </form>
        
      </div>
      
  


