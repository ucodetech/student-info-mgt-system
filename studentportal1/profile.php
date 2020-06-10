<?php 
require_once '../core/init.php';
  require_once '../helpers/helpers.php';

         if (!is_Slogged_in()) {
    stdlogin_error_redirect();
  }
  include 'includes/head.php';

 ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?=((isset($_GET['edit']))? 'Edit Profile': 'Student Profile');?></h4>
                            </div>
                            <div class="content">
                                <?php
 if (isset($_GET['edit'])) {

           if (isset($_GET['edit'])) {
         $edit_id = (int)$_GET['edit'];
    $studentResults = $db->query("SELECT * FROM student WHERE id = '$edit_id'");
    $studentf = mysqli_fetch_assoc($studentResults);

    $full_name = ((isset($_POST['full_name']) && !empty($_POST['full_name']))?sanitize($_POST['full_name']): $studentf['full_name']);
    $email = ((isset($_POST['email']) && !empty($_POST['email']))?sanitize($_POST['email']): $studentf['email']);
     $username = ((isset($_POST['username']) && !empty($_POST['username']))?sanitize($_POST['username']): $studentf['username']);
    
    }
        if ($_POST) {
            $errors = array();
            $required = array('full_name', 'email',);
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                   $errors[] = 'All field are Required';
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE student SET full_name = '$full_name', email = '$email' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                    $_SESSION['success_flash']= 'Success';
                    header("Location: profile.php?success");      
                }else{
                  echo 'errors '.mysqli_error($db);
                }

            }


        }



?>
        <form method="post" action="profile.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>" enctype="multipart/form-data">
            <div class="row">
    
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control"  value="<?=$username;?>" disabled>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full  Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?=$full_name;?>" placeholder="Full Name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="Email">
                    </div>
                </div>
            </div>

            

            
            <a href="profile.php" class="btn btn-danger">Cancel</a>
            <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Update ':'');?> Profile">
            <div class="clearfix"></div>
        </form>
    <?php }else{

        $studentQuery =$db->query("SELECT * FROM student WHERE id = '$student_id'");
            ?>
                 <div class="content table-responsive table-full-width">
                   <table class="table table-hover table-striped table-bordered">
                   <thead class="bg-info text-light">
                     <th>control</th><th>Name</th><th>Email</th><th>Username</th><th>Joined Date</th><th>Last Login</th>
                   </thead>
                   <tbody>
                     <?php while($use = mysqli_fetch_assoc($studentQuery)) : ?>
                     <tr>
                       <td>
                        <a href="profile.php?edit=<?=$use['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
                       </td>
                       <td><?=$use['full_name'];?></td>
                       <td><?=$use['email'];?></td>
                        <td><?=$use['username'];?></td>
                       <td><?=pretty_date($use['dateCreated']);?></td>
                       <td><?=(($use['last_login'] == '0000-00-00 00:00:00')?'Never ':pretty_date($use['last_login']));?></td>
                     </tr>
                   <?php endwhile;?>
                   </tbody>
                 </table>
                </div>

                            <?php } ?>
                            </div>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
       
        <h2 class="text-center">Personal Details</h2><hr>
     <div class="row b">
      <div class="col-md-3 form2">
         <?php 
                //student image
              $sql = "SELECT * FROM student WHERE id = '$student_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $studid = $row['id'];
                  
                  $sqlim = "SELECT * FROM studentprofile WHERE student_id = '$studid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='profile/profile".$studid.".jpg?'".mt_rand()." class='rounded-circle align-self-start mr-3' style='border-radius: 10% !important;margin: 2px;' alt='...' width='180' height='150'>
               ";
                        }else{
                          ?>
                           <img src='profile/default.png' class='rounded-circle align-self-start mr-3' style='border-radius: 50% !important;margin: 2px;' alt='...' width='180' height='180'>
               
                          <?php
                        }
                    }
                  }
                }
               } 
           ?>
              <?php 
                //fetching other datas from a the database
                $sqlquery  = $db->query("SELECT * FROM student WHERE id = '$student_id' ");
                $rowd = mysqli_fetch_assoc($sqlquery);
                

               ?>
         <hr>
         <h6 class="name"> Name: <?=$rowd['full_name'];?></h6>
         <h6 class="d">Email: <?=$rowd['email'];?></h6>     
      </div>
    
        <div class="col-md-8 form">
       
           
            <div class="row">
             
              
           
               
            <?php 
            
                $sqlall = "SELECT   `st_mobile`, `st_date_of_birth`, `st_father_name`, `st_father_mobile`, `st_mother_name`, `st_mother_mobile`, `mst_state_name`,`mst_lga_name`, `mst_stream_name`,`st_address`, `st_date_of_admission`
                FROM `student_info` 
                JOIN `master_states` ON `mst_state_id`=`st_state` 
                JOIN `master_lga` ON `mst_lga_id`=`st_lga` 
                JOIN `master_stream` ON `mst_stream_id`=`st_stream`   
                WHERE sess_id = '$student_id' ";

                $queryall =$db->query($sqlall);
                // JOIN ` master_lga` ON `mst_lga_id`= `st_lga`  JOIN `master_stream` ON `mst_stream_id`=`st_stream`
                $result = mysqli_fetch_assoc($queryall);
             ?>
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
           
         
     </div>
   </div>
      </div>
      </div>
<script type="text/javascript">

</script>

<?php include 'includes/bootfooter.php'; ?>
<style type="text/css">
  .form{
    background: #222d;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin: 10px;
    font-size:20px;
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