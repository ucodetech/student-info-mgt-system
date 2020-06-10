<?php 
  require_once '../core/init.php';
    require_once '../helpers/helpers.php';

    if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError  = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg');

      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0 ) {
          if ($fileSize < 100000 ) {
            $fileNameNew  = "profile".$student_id.".".$fileActualExt;
            //$fileNameNew  = uniqid('', true).".".$fileActualExt; //user this as template
            $fileDestination = 'profile/'.$fileNameNew;

            move_uploaded_file($fileTmpName, $fileDestination);
            $sql = "UPDATE studentprofile SET status = 0 WHERE student_id = '$student_id'";
            $result = $db->query($sql);
            header("Location: updateImage.php?success");
          }else{
            $_SESSION['error_flash'] = 'File Too Large';
          }
        }else{
            $_SESSION['error_flash'] = 'There was an Error Updating file';
        }
      }else {
        $_SESSION['error_flash'] = 'that type of file can not be uploaded';
      }
}

  

