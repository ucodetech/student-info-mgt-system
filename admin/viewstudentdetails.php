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
    margin: 10px;
    font-size:20px;
    padding: 10px;
  }
   .form2{
    background: #112e;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin-left:20px;
    margin-right: 10px;
    margin-bottom: 10px;
    margin-top: 10px;

  }
  .d{
    text-transform: lowercase;
  }
  .name{
    text-transform: uppercase;
  }
  .b{
     border: 2px solid #ddd;
     margin: 20px;
     padding: 0;
  }

</style>
</style>
 <h4 class="alert alert-primary">Student Details
           
          </h4><hr>
      
      <div class="row b">
          <div class="col-md-3 form2">
              
              <?php 
             

                    if (isset($_GET['view'])) {
                       $viewid =(int)$_GET['view'];
                      $sqlall = "SELECT  `sess_id`, `st_mobile`, `st_date_of_birth`, `st_father_name`, `st_father_mobile`, `st_mother_name`, `st_mother_mobile`, `mst_state_name`,`mst_lga_name`, `mst_stream_name`,`st_address`, `st_date_of_admission`
                FROM `student_info` 
                JOIN `master_states` ON `mst_state_id`=`st_state` 
                JOIN `master_lga` ON `mst_lga_id`=`st_lga` 
                JOIN `master_stream` ON `mst_stream_id`=`st_stream`   
                WHERE sess_id = '$viewid' ";

                    $queryq = $db->query($sqlall);
                     $result = mysqli_fetch_assoc($queryq);
                  //student image
              $sql = "SELECT * FROM student WHERE id = '$viewid' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $studid = $row['id'];
                  
                  $sqlim = "SELECT * FROM studentprofile WHERE student_id = '$studid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='../studentportal1/profile/profile".$studid.".jpg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 10% !important;margin: 2px;' alt='...' width='180' height='150'>
                          ";
                        }else{
                          ?>
                           <img src='../studentportal1/profile/default.png' class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='180' height='180'>
              
                          <?php
                        }
                    }
                  }
                }
               }
               //fetching other datas from a the database
                $sqlquery  = $db->query("SELECT * FROM student WHERE id = '$viewid' ");
                $rowd = mysqli_fetch_assoc($sqlquery);
                }
                

               ?>
            
              
              <h6> Name: <?=$rowd['full_name'];?></h6>
             
            
               <h6>Email: <?=$rowd['email'];?></h6>
            </div>
        <div class="col-md-8 form">
         <div class="row">
            
             <div class="col-md-6 ">
                <label>Mobile:</label> <?=$result['st_mobile'];?>
              </div>
              <div class="col-md-6 ">
                <label>Date of Birth: </label><?=pretty_dates($result['st_date_of_birth']);?>
              </div>
              
               <div class="col-md-6 ">
                <label>Father's Name:</label> <?=$result['st_father_name'];?>
              </div>
               <div class="col-md-6 ">
                <label>Father's Mobile Number:</label> <?=$result['st_father_mobile'];?>
              </div>
                <div class="col-md-6 ">
               <label>Mother's Name:</label> <?=$result['st_mother_name'];?>
              </div>
               <div class="col-md-6 ">
                <label>Mother's Mobile Number:</label> <?=$result['st_mother_mobile'];?>
              </div>
               <div class="col-md-6 ">
               <label>LGA:</label><?=$result['mst_lga_name'];?>
              </div>
               <div class="col-md-6 ">
                <label>State: </label><?=$result['mst_state_name'];?>
              </div>
              <div class="col-md-6 ">
                <label>Home Address:</label> <?=$result['st_address'];?>
              </div>
               <div class="col-md-6 ">
                <label>Stream:</label> <?=$result['mst_stream_name'];?>
              </div>
              <div class="col-md-6 ">
                <label>Date of Admission:</label> <?=pretty_dates($result['st_date_of_admission']);?>
              </div>
                      <br>
                    
                      <div class="col-md-4 ">
                        <a class="btn btn-sm btn-danger" href="dashboard.php" >Back</a>
                        <a class="btn btn-sm btn-success" href="editstudent.php?edit=<?=$result['sess_id'];?>" >Edit Student</a>
                      </div>
              

                 
                    </div>
                      

            </div>
         
      </div>
      <div class="col-md-3 form2">
        side
      </div>
      </div>
    <?php include 'includes/bootfooter.php' ?>