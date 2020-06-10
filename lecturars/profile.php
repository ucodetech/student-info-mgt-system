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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?=((isset($_GET['edit']))? 'Edit Profile': 'lecturar Profile');?></h4>
                            </div>
                            <div class="content">
                                <?php
 if (isset($_GET['edit'])) {

           if (isset($_GET['edit'])) {
         $edit_id = (int)$_GET['edit'];
    $lecturarResults = $db->query("SELECT * FROM lecturar WHERE id = '$edit_id'");
    $lecturarf = mysqli_fetch_assoc($lecturarResults);

    $full_name = ((isset($_POST['full_name']) && !empty($_POST['full_name']))?sanitize($_POST['full_name']): $lecturarf['full_name']);
    $email = ((isset($_POST['email']) && !empty($_POST['email']))?sanitize($_POST['email']): $lecturarf['email']);
    $username = ((isset($_POST['username']) && !empty($_POST['username']))?sanitize($_POST['username']): $lecturarf['username']);
    
    }
        if ($_POST) {
            $errors = array();
            $required = array('full_name', 'email', 'username');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    $errors[] = 'All field are Required';
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE lecturar SET username = '$username', full_name = '$full_name', email = '$email' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                  $_SESSION['success_flash'] = 'Updated';                   

                }

            }


        }



   ?>
  <form method="post" action="lecturar.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>" enctype="multipart/form-data">
      <div class="row">

          <div class="col-md-3">
              <div class="form-group">
                  <label class="text-primary">username</label>
                  <input type="text" class="form-control" name="username" value="<?=$username;?>">
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

        $lecturarQuery =$db->query("SELECT * FROM lecturar WHERE id = '$lecturar_id'");
            ?>
                 <div class="content table-responsive table-full-width">
                   <table class="table table-hover table-striped table-bordered">
                   <thead class="bg-info text-light">
                     <th>control</th><th>Name</th><th>Email</th><th>Username</th><th>Last Login</th>
                   </thead>
                   <tbody>
                     <?php while($use = mysqli_fetch_assoc($lecturarQuery)) : ?>
                     <tr>
                       <td>
                        <a href="profile.php?edit=<?=$use['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
                       </td>
                       <td><?=$use['full_name'];?></td>
                       <td><?=$use['email'];?></td>
                        <td><?=$use['username'];?></td>
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
         <div class="row b">
      <div class="col-md-3 form2">
         <?php 
                //lecturar image
              $sql = "SELECT * FROM lecturar WHERE id = '$lecturar_id' ";
              $query = $db->query($sql);
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $lectid = $row['id'];
                  
                  $sqlim = "SELECT * FROM lecturarprofile WHERE lecturar_id = '$lectid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                     
                      
                        if ($rowimg['status'] == 0) {
                          echo "<img src='profile/profile".$lecturar_id.".jpeg?'".mt_rand()." class=' align-self-start mr-3' alt='Admin Profile' width='210' height='200'>
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
                $sqlquery  = $db->query("SELECT * FROM lecturar WHERE id = '$lecturar_id' ");
                $rowd = mysqli_fetch_assoc($sqlquery);
                

               ?>
         <hr>
         <span class="name"> Name: <?=$rowd['full_name'];?></span>
         <span class="d">Email: <?=$rowd['email'];?></span>     
      </div>
    
        <div class="col-md-8 form">
       
            <div class="content">
          <div class="container-fluid">
            <h4 class="text-info text-center">Upload Your Picture (<span class="text-danger"><?=$lecturar_data['permissions'];?> </span>)</h4><hr>
                <div class="container">
                  <div class="row">
              
                <div class="col-md-4">
                  <p class="alert alert-danger" >
                
                  Only .jpeg extsion is allowed. thanks
                
              </p>
                </div>
              </div>
            </div>

              
            <hr>
        
              <?php 
                $sqlim = "SELECT * FROM lecturarprofile WHERE lecturar_id = '$lectid' ";
                  $queryim = $db->query($sqlim);
                  if (mysqli_num_rows($queryim) > 0) {
                    while ($rowimg = mysqli_fetch_assoc($queryim)) {
                       if ($rowimg['status'] == 0) {
                        echo '<h1 class="text-info">Profile Updated</h1>';
                       }else{
                        ?>
                         <form action="update_pro.php" method="POST" enctype="multipart/form-data"> 
                      <div class="col-md-6 form-group">
                         <label for="DOA">Lecturar Profile Pic: <span class="text-danger">*</span></label>
                    <input type="file" name="file"  class="form-control">
                  </div>

                  <div class="col-md-12 form-group" align="right">
                    <input type="submit" name="upload" value="Upload"  class="btn btn-success">
                  </div>
         </form>

                        <?php
                       }

                    }
                  }
                     
                      
                       
               ?>
                   
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