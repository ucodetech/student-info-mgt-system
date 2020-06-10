<?php 
        require_once '../core/init.php';
        require_once '../helpers/helpers.php';
 
$sub_code= ((isset($_POST['sub_code']))?sanitize($_POST['sub_code']): '');

 if (isset($_POST['submit'])) {
   $errors = array();
    if (empty($_POST['sub_code'])) {
      $errors[] =  'Select the course!';
    }
   
    $reg_no = '';
    $date = date('Y');
    $regNO = 'stud/'.$student_id.'/'.$date;
     date_default_timezone_set("Africa/Lagos");
      $dt = new DateTime();
      $time =  $dt->format('h:i:sa');
 
     if (!empty($_FILES)) {
      $file =$_FILES['file'];
      $name = $file['name'];
      $nameArray = explode('.', $name);
      $fileName = $nameArray[0];
      $fileExt = $nameArray[1];
      $fileType = $file['type'];
      $tmpLoc = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $allowed  = array('pdf','doc', 'docx', 'odt' );
      $uploadName = $student_data['full_name'].$time.$fileName.'.'.$fileExt;
      $uploadPath ='../assignments/'.$uploadName;
      $dbpath = $uploadName;
  
      if (!in_array($fileExt, $allowed )) {
          $errors[] ='The file extension not supported!';
      }
      if ($fileSize > 150000000) {
        $errors[]  ='The file size must be blow 15MB.';
      }
      if ($fileError != 0) {
      	$errors[] = 'File is required';
      }
    
    }
    if (!empty($errors)) {
      echo display_errors($errors);
    }else{
      //Upload file and Insert into database
      if (!empty($_FILES)) {
         move_uploaded_file($tmpLoc, $uploadPath);
      }
      $status = 1;
      $sql = "INSERT INTO  `assignm`
 (sub_code_id,
  file,
  submitted,
  reg_no,
  student_id
) VALUES 
 (?,?,?,?,?); ";
$stmt = mysqli_stmt_init($db);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  $errors[] = 'SQL Error';
}else{
mysqli_stmt_bind_param($stmt, "sssss", $sub_code, $dbpath, $status, $regNO, $student_id);
$result =  mysqli_stmt_execute($stmt);

}
         
if ($result) {
  $_SESSION['success_flash'] = "You have submitted your assignment";
  header("Location: dashboard.php");
}else {
  echo "something went wrong!".mysqli_error($db);
                    }
    }
  }
