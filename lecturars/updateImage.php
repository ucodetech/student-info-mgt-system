<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_lectlogged_in()) {
    login_error_redirect();
  }
  if (!has_permission_lect('lecturar')) {
    lectpermission_error_redirect();
  }
  include 'includes/head.php';
  
 ?>


        <div class="content">
          <div class="container-fluid">
            <h4 class="text-info text-center">Update Your Profile (<span class="text-danger"><?=$lecturar_data['first'];?></span>)</h4><hr>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                     <?php 
              $sql = "SELECT * FROM lecturar WHERE id = '$lecturar_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $lecturarid = $row['id'];
                  
                  $sqlim = "SELECT * FROM lecturarprofile WHERE lecturar_id = '$lecturarid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='profile/profile".$lecturarid.".jpg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 10% !important;margin: 2px;' alt='...' width='200' height='200'>
               <span class='text-success onl'>.</span>  <span class='onl1'>Active </span> <br>";
                        }else{
                          ?>
                           <img src='profile/default.png' class='rounded-circle align-self-start mr-3' style='border-radius: 10% !important;margin: 2px;' width='200' height='200'>
               <span class="onl1">Update Your Profile to have your Image appear here!   </span> <br>
                          <?php
                        }
                    }
                  }
                }
               } 
           ?>
                
                </div>
                <div class="col-md-4">
                  <p class="alert alert-danger" >
                
                  Only .jpg extsion is allowed. thanks
                
              </p>
                </div>
              </div>
            </div>

              
            <hr>
         <form action="update_pro.php" method="POST" enctype="multipart/form-data"> 
             <div class="col-md-6 form-group">
                    <label for="DOA">admin Profile Pic: <span class="text-danger">*</span></label>
                    <input type="file" name="file"  class="form-control">
                  </div>

                  <div class="col-md-12 form-group" align="right">
                    <input type="submit" name="upload" value="Upload"  class="btn btn-success">
                  </div>
         </form>
          </div>
            
        </div>

<?php include 'includes/bootfooter.php'; ?>
