<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_logged_in()) {
    login_error_redirect();
  }
  
  include 'includes/head.php';
  
 ?>
<style type="text/css">
  .form{
    background: #222d;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin: 20px;
    
    padding: 30px;
  }
   .form2{
    background: #112e;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin-left: 20px;
  }
</style>
<div class="container-fliud form">
       <h4 class="alert alert-primary">Student Details</h4><hr>
       
            <h2 class="text-center">Personal Details</h2><hr>
        
             
                <?php 
                 if (isset($_GET['edit'])) {

                    if (isset($_GET['edit'])) {
                  $edit_id = (int)$_GET['edit'];
                	$sqla = "SELECT * FROM student_info  WHERE sess_id  = '$edit_id' ";
                  $querya = $db->query($sqla);
                   $studentd = mysqli_fetch_assoc($querya);

                 $sqlquery  = $db->query("SELECT * FROM student WHERE id = '$edit_id' ");

                $st_mobile = ((isset($_POST['st_mobile']) && !empty($_POST['st_mobile']))?sanitize($_POST['st_mobile']):$studentd['st_mobile']);
                $st_date_of_birth = ((isset($_POST['st_date_of_birth']) && !empty($_POST['st_date_of_birth']))?sanitize($_POST['st_date_of_birth']):$studentd['st_date_of_birth']);
                $st_father_name = ((isset($_POST['st_father_name']) && !empty($_POST['st_father_name']))?sanitize($_POST['st_father_name']):$studentd['st_father_name']);
                $st_father_mobile = ((isset($_POST['st_father_mobile']) && !empty($_POST['st_father_mobile']))?sanitize($_POST['st_father_mobile']):$studentd['st_father_mobile']);
                $st_mother_name = ((isset($_POST['st_mother_name']) && !empty($_POST['st_mother_name']))?sanitize($_POST['st_mother_name']):$studentd['st_mother_name']);
                $st_mother_mobile = ((isset($_POST['st_mother_mobile']) && !empty($_POST['st_mother_mobile']))?sanitize($_POST['st_mother_mobile']):$studentd['st_mother_mobile']);
                $st_address = ((isset($_POST['st_address']) && !empty($_POST['st_address']))?sanitize($_POST['st_address']):$studentd['st_address']);
                $st_date_of_admission = ((isset($_POST['st_date_of_admission']) && !empty($_POST['st_date_of_admission']))?sanitize($_POST['st_date_of_admission']):$studentd['st_date_of_admission']);
                $st_state = ((isset($_POST['st_state']) && !empty($_POST['st_state']))?sanitize($_POST['st_state']):$studentd['st_state']);
                $st_lga = ((isset($_POST['st_lga']) && !empty($_POST['st_lga']))?sanitize($_POST['st_lga']):$studentd['st_lga']);
                $st_stream= ((isset($_POST['st_stream']) && !empty($_POST['st_stream']))?sanitize($_POST['st_stream']):$studentd['st_stream']);
                //update takes place here
                 if ($_POST) {
            $errors = array();
            $required = array('st_mobile', 'st_date_of_birth', 'st_father_name', 'st_father_mobile','st_mother_name', 'st_mother_mobile', 'st_address', 'st_stream', 'st_state', 'st_lga', 'st_date_of_admission');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
        	$_SESSION['success_flash'] = "All Fields Are required!";

                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE student_info SET 
               	st_mobile = '$st_mobile',st_date_of_birth = '$st_date_of_birth',st_father_name = '$st_father_name',st_father_mobile = '$st_father_mobile',st_mother_name = '$st_mother_name',st_mother_mobile = '$st_mother_mobile',st_address = '$st_address',st_date_of_admission = '$st_date_of_admission',st_state = '$st_state',st_lga = '$st_lga',st_stream = '$st_stream' WHERE sess_id = '$edit_id' ";
               	$updatequery = $db->query($updateSql);
               	if (!$updatequery) {
               		echo "Your Update Didn't Work!".mysqli_error($db);
               	}else{
               		$_SESSION['success_flash'] = "Your Update was Successful!";
               		header("Location: dashboard.php?success");
               	}

            }


        }
               	
                
}

              }
          }
               //student image
              $sql = "SELECT * FROM student WHERE id = '$edit_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $studid = $row['id'];
                  
                  $sqlim = "SELECT * FROM studentprofile WHERE student_id = '$studid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='../studentportal1/profile/profile".$studid.".jpg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 10% !important;margin: 2px;' alt='...' width='130' height='130'>
               ";
                        }else{
                          ?>
                           <img src='../studentportal1/profile/default.png' class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='80' height='80'>
                          <?php
                        }
                    }
                  }
                }
               } 
                    
           ?>
               
              <div class="row">
              	<?php while ( $rowd = mysqli_fetch_assoc($sqlquery)): ?>
              <div class="col-md-4">
              <h6> Name: <?=$rowd['full_name'];?></h6>
              </div>
               <div class="col-md-4">
               <h6>Email: <?=$rowd['email'];?></h6>
              </div>
            <?php endwhile; ?>
              </div>
              
             
		
			 <form method="POST" action="editstudent.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>">
			 	<div class="row">
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
                    <select name="st_state" class="form-control" id="state">
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
                    <textarea name="st_address"  id="st_address" class="form-control"> <?=$st_address;?> </textarea>
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
                  	<a href="dashboard.php" class="btn  btn-danger">Cancel</a>
                    <input type="submit" name="edit" value="Edit" class="btn btn-success">
                  </div>
                  </div>
             
              </form>
		</div>