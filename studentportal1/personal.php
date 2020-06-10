  <?php 
  require_once '../core/init.php';
    require_once '../helpers/helpers.php';
        if (!is_Slogged_in()) {
    stdlogin_error_redirect();
  }
    include 'includes/head.php'; 

  ?>

<style type="text/css">
  .form{
    background: #232e;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
  }
</style>
  <!-- Student Form -->
        <div class="content">
            <div class="container-fluid form">
                <h4 class="text-info text-center">Update Your Information (<span class="text-danger"><?=$student_data['first'];?></span>) </h4><hr>
                   <!-- row start -->
                   <?php 
                  

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
                        $date = date('Y');
                        $regNO = 'stud/'.$student_id.'/'.$date;
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
                          $sql = "INSERT INTO `student_info` ( st_mobile, st_date_of_birth , st_father_name ,  st_father_mobile, st_mother_name ,  st_mother_mobile ,  st_lga, st_state, st_address, st_stream , st_date_of_admission, reg_id, sess_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                          $stmt = mysqli_stmt_init($db);
                          if (!mysqli_stmt_prepare($stmt, $sql)) {
                          echo 'SQL Error '.mysqli_error($db);
                          }else{
                           
                         mysqli_stmt_bind_param($stmt, "sssssssssssss", $st_mobile,$st_date_of_birth , $st_father_name ,  $st_father_mobile, $st_mother_name ,$st_mother_mobile ,  $st_lga, $st_state, $st_address,$st_stream ,
                          $st_date_of_admission, 
                           $regNO, $student_id );
                          $result = mysqli_stmt_execute($stmt);
                         
                          }
                          if (!$result) {
                            echo 'error '.mysqli_error($db);
                          }else{
                          $_SESSION['success_flash'] = 'You have Updated your details successfully!';
                          header("Location: profile.php");
                          }
                         
                         
                        }

                      }
                    ?>
                  
                 
                <div class="row">
                   <?php 
                      $sql_std = "SELECT full_name FROM `student` WHERE id = '$student_id' ";
                      $query_std = $db->query($sql_std);
                  ?>
                <div class="col-md-6 form-group">
                    <label for="name">Student Full Name: <span class="text-danger">*</span></label>
                     <?php 

                          while ($std = mysqli_fetch_assoc($query_std)) {
                            ?>
                    <input type="text" name="st_name" id="st_name" disabled="disabled" value="<?=$std['full_name'];?>" class="form-control">
                         <?php

                          }
                       ?>
                </div>
                 <?php 
                      $sql_stde = "SELECT email FROM `student` WHERE id = '$student_id' ";
                      $query_stde = $db->query($sql_stde);
                  ?>
                  <div class="col-md-6 form-group">
                    <label for="email">Student Email Address: <span class="text-danger">*</span></label>
                     <?php 

                          while ($stde = mysqli_fetch_assoc($query_stde)) {
                            ?>
                    <input type="email" name="st_email" disabled="disabled" value="<?=$stde['email'];?>" id="st_email" class="form-control">
                     <?php

                          }
                       ?>
                </div>
                <h4 class="text-info text-center">Update</h4>
                <form method="POST" action="personal.php">
                   <div class="col-md-6 form-group">
                    <label for="Mobile">Student Mobile Number: <span class="text-danger">*</span></label>
                    <input type="number" name="st_mobile" id="st_mobile" class="form-control" value="<?=$st_mobile;?>">
                  </div>
                   <div class="col-md-6 form-group">
                    <label for="DOB">Student Date Of Birth: <span class="text-danger">*</span></label>
                    <input type="date" name="st_date_of_birth" id="st_date_of_birth" class="form-control" value="<?=$st_date_of_birth;?>">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="name">Student Fathers Name: <span class="text-danger">*</span></label>
                    <input type="text" name="st_father_name" value="<?=$st_father_name;?>" id="st_father_name" class="form-control">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="Mobile">Student Fathers Mobile Number: <span class="text-danger">*</span></label>
                    <input type="number" name="st_father_mobile" value="<?=$st_father_mobile;?>" id="st_father_mobile" class="form-control">
                  </div>
                    <div class="col-md-6 form-group">
                    <label for="name">Student Mothers Name: <span class="text-danger">*</span></label>
                    <input type="text" name="st_mother_name" value="<?=$st_mother_name;?>" id="st_mother_name" class="form-control">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="Mobile">Student Mothers Mobile Number: <span class="text-danger">*</span></label>
                    <input type="number" name="st_mother_mobile" value="<?=$st_mother_mobile; ?>" id="st_mother_mobile" class="form-control">
                  </div>
                    <?php 
                      $sql_states = "SELECT * FROM `master_states` ORDER BY `mst_state_id` ASC
";
                      $query_states = $db->query($sql_states);
                     ?>
                   <div class="col-md-6 form-group">
                    <label for="state">Student State: <span class="text-danger">*</span></label>
                    <select name="st_state" class="form-control" onchange="choseLga(this.value)" id="state">
                      <option value="">Select</option>
                      <?php 

                          while ($state = mysqli_fetch_assoc($query_states)) {
                            ?>
                            <option value="<?=$state['mst_state_id'];?>"><?=$state['mst_state_name'];?></option>
                            <?php

                          }
                       ?>
                    </select>
                  </div>
                   <?php 
                      $sql_lga = "SELECT * FROM `master_lga`";
                      $query_lga = $db->query($sql_lga);
                     ?>
                   <div class="col-md-6 form-group">
                    <label for="city">Student LGA: <span class="text-danger">*</span></label>
                    <select name="st_lga" class="form-control" id="lga">
                      <option>Select</option>
                      <?php 

                          while ($lga = mysqli_fetch_assoc($query_lga)) {
                            ?>
                            <option value="<?=$lga['mst_lga_id'];?>"><?=$lga['mst_lga_name'];?></option>
                            <?php

                          }
                       ?>
                    </select>
                  </div>
                   <div class="col-md-6 form-group">
                    <label for="address">Student Home Address: <span class="text-danger">*</span></label>
                    <textarea name="st_address"  id="st_address" class="form-control"><?=$st_address;?> </textarea>
                  </div>
                  <?php 
                      $sql_stream = "SELECT * FROM `master_stream` ORDER BY `mst_stream_id` ASC";
                      $query_stream = $db->query($sql_stream);
                     ?>
                   <div class="col-md-6 form-group">
                    <label for="stream">Student Stream: <span class="text-danger">*</span></label>
                    <select name="st_stream" class="form-control">
                      <option>Select</option>
                      <?php 

                          while ($stream = mysqli_fetch_assoc($query_stream)) {
                            ?>
                            <option value="<?=$stream['mst_stream_id'];?>"><?=$stream['mst_stream_name'];?></option>
                            <?php

                          }
                       ?>
                    </select>
                  </div>
                   <div class="col-md-6 form-group">
                    <label for="DOA">Student Date Of Addmission: <span class="text-danger">*</span></label>
                    <input type="date" name="st_date_of_admission" value="<?=$st_date_of_admission;?>" id="st_date_of_admission" class="form-control">
                  </div>
                  <hr>
                    
                  <div class="col-md-12 form-group" align="right">
                    <input type="submit" name="submit" value="Update" class="btn btn-success">
                  </div>
                  
                </div> 
              </form>
                   
<!-- end of row -->
            </div>
        </div>
      </div>
      
     <?php include 'includes/bootfooter.php'; ?>
