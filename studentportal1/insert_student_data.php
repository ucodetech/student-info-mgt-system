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

			        
                  	 // -----------------------------------------
                        
                      $checksql  = "SELECT * FROM student_info WHERE reg_id = '$reg_id' ";
                      $checkquery = $db->query($checksql);
                      $checkresult = mysqli_fetch_assoc($checkquery);
                      if (mysqli_num_rows($checkquery) != 0) {
                        $errors[] = 'You have Updated your details before!';
                        
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
                          $sql = "INSERT INTO `student_info` ( st_mobile, st_date_of_birth , st_father_name ,  st_father_mobile, st_mother_name ,  st_mother_mobile ,  st_lga, st_state, st_address, st_stream , st_date_of_admission); VALUES ( ?,?,?,?,?,?,?,?,?,?,?);";
                           // $query = $db->query($sql);
                           // if (!$query) {
                           //    echo  'SQL Error'.mysqli_connect_error();die();
                           // }else{
                           //   $_SESSION['success_flash'] = 'You have Updated your details successfully!';
                           // }
                          $stmt = mysqli_stmt_init($db);
                          if (!mysqli_stmt_prepare($stmt, $sql)) {
                          echo 'SQL Error'. mysqli_connect_error($db);die();
                          }else{
                            mysqli_stmt_bind_param($stmt, 'ssssssssssss',  $st_mobile,$st_date_of_birth , $st_father_name ,  $st_father_mobile, $st_mother_name ,$st_mother_mobile ,  $st_lga_id,$st_state_id, $st_address,
                              $st_stream_id , $st_date_of_admission );
                            $st = mysqli_stmt_execute($stmt);

                            if (!isset($st)) {
                               echo 'SQL Error2'.mysqli_connect_error();
                            }else{
                          $_SESSION['success_flash'] = 'You have Updated your details successfully!';
                            }
                          }
                         
                         
                        }

                      }
                   