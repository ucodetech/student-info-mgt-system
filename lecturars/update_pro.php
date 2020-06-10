<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';

$file = ((isset($_POST['file']))?sanitize($_POST['file']): '');

 if (isset($_POST['upload'])) {
   $errors = array();
        
     if (!empty($_FILES)) {
      $file =$_FILES['file'];
      $name = $file['name'];
      $nameArray = explode('.', $name);
      $fileName = $nameArray[0];
      $fileExt = $nameArray[1];
      $fileType = $file['type'];
      $tmpLoc = $file['tmp_name'];
      $fileSize = $file['size'];
      $allowed  = array('jpeg' );
      $uploadName = "profile".$lecturar_id.".".$fileExt;
      $uploadPath ='profile/'.$uploadName;
      $dbpath = $uploadName;
  
      if (!in_array($fileExt, $allowed )) {
          $errors[] ='The file extension not supported!';
      }
      if ($fileSize > 1500000) {
         $errors[] ='The file size must be blow 15MB.';

      }
    
    }
    if (!empty($errors)) {
      echo display_errors($errors);
    }else{
      //Upload file and Insert into database
      if (!empty($_FILES)) {
         move_uploaded_file($tmpLoc, $uploadPath);
      }
        
       $sql = "UPDATE lecturarprofile SET status = ? WHERE lecturar_id = $lecturar_id";
                    $stmt = mysqli_stmt_init($db);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                      $errors[] = 'SQL Error';
                    }else{
                      $status = 0;
                    mysqli_stmt_bind_param($stmt, "s", $status);
                    $result =  mysqli_stmt_execute($stmt);
                    
              }
                  
                  
                    if ($result) {
                      $_SESSION['success_flash'] = "Profile Updated";
                      header("Location: profile.php");
                    }else {
                      echo "something went wrong!".mysqli_error($db);
                    }
    }
  }