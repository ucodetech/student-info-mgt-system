<?php           
	require_once '../core/init.php';
    require_once '../helpers/helpers.php';


        $st_mobile  = ((isset($_POST['st_mobile']))?sanitize($_POST['st_mobile']): ' ');
        $st_date_of_birth = ((isset($_POST['st_date_of_birth']))?sanitize($_POST['st_date_of_birth']): ' ');
        $st_father_name = ((isset($_POST['st_father_name']))?sanitize($_POST['st_father_name']): ' ');
        $st_father_mobile = ((isset($_POST['st_father_mobile']))?sanitize($_POST['st_father_mobile']): ' ');
        $st_mother_name = ((isset($_POST['st_mother_name']))?sanitize($_POST['st_mother_name']): ' ');
        $st_mother_mobile = ((isset($_POST['st_mother_mobile']))?sanitize($_POST['st_mother_mobile']): ' ');
        $st_lga = ((isset($_POST['st_lga']))?sanitize($_POST['st_lga']): ' ');
        $st_state = ((isset($_POST['st_state']))?sanitize($_POST['st_state']): ' ');
        $st_address = ((isset($_POST['st_address']))?sanitize($_POST['st_address']): ' ');
        $st_stream = ((isset($_POST['st_stream']))?sanitize($_POST['st_stream']): ' ');
        $st_date_of_admission = ((isset($_POST['st_date_of_admission']))?sanitize($_POST['st_date_of_admission']): ' ');
        $errors = array();
        
        
                  if (isset($_POST['submit'])) {
                        $reg_id = '';
                  $mobileQuery = $db->query("SELECT * FROM student_info WHERE reg_id = '$student_id' ");
                  $res = mysqli_fetch_assoc($mobileQuery);
                  $mobileCount = mysqli_num_rows($mobileQuery);
                   if ($mobileCount != 0 ) {
                     $errors[] = 'You have already updated your details!';
                   }

                      $required = array(
                        'st_mobile',
                         'st_date_of_birth' ,
                          'st_father_name' , 
                          'st_father_mobile' , 
                          'st_mother_name' , 
                          'st_mother_mobile' , 
                          'st_lga',
                           'st_state', 
                           'st_address'  ,
                           'st_stream' , 
                           'st_date_of_admission' 
                            );

                        foreach ($required as $detail) {
                          if (empty($_POST[$detail])) {
                            $errors[] = 'All Fields are Required!';
                            break;
                          }
                        }
                          if (strlen($st_mobile) < 11  || strlen($st_mobile) > 11  ) {
                            $errors[] = 'Your Mobile Number is not correct!';
                          }
                           if (strlen($st_father_mobile) < 11  || strlen($st_father_mobile) > 11  ) {
                            $errors[] = 'Your Fathers Mobile Number is not correct!';
                          }
                          if (strlen($st_mother_mobile) < 11  || strlen($st_mother_mobile) > 11  ) {
                            $errors[] = 'Your Mothers  Mobile Number is not correct!';
                          }
                        if (!empty($errors)) {
                          echo display_errors($errors);
                        }else{
                          $reg_id = 'std'.'/'.$student_id; 
                          $sql = "INSERT INTO `student_info` ( st_mobile, st_date_of_birth , st_father_name ,  st_father_mobile, st_mother_name ,  st_mother_mobile ,  st_lga, st_state, st_address, st_stream , st_date_of_admission, reg_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                          $stmt = mysqli_stmt_init($db);
                          if (!mysqli_stmt_prepare($stmt, $sql)) {
                          echo 'SQL Error '.mysqli_error($db);
                          }else{
                           
                         mysqli_stmt_bind_param($stmt, "ssssssssssss", $st_mobile,$st_date_of_birth , $st_father_name ,  $st_father_mobile, $st_mother_name ,$st_mother_mobile ,  $st_lga, $st_state, $st_address,$st_stream ,
                          $st_date_of_admission, 
                           $reg_id );
                          mysqli_stmt_execute($stmt);
                          $_SESSION['success_flash'] = 'You have Updated your details successfully!';
                          header("Location: profile.php");
                          }
                         
                         
                        }

                      }
                    ?>