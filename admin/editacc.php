<?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_logged_in()) {
    login_error_redirect();
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
            $required = array('full_name', 'email', 'username');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    echo "<script>alert('All field are Required')</script>";
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE student SET full_name = '$full_name', email = '$email',  username = '$username' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                   $_SESSION['success_flash'] = "Update Successful!";
                   header("Location: dashboard.php?success");
                   

                }

            }


        }
    }



?>
            <form method="post" action="editacc.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>" enctype="multipart/form-data">
                <div class="row">
        
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-primary">Username</label>
                            <input type="text" class="form-control"  value="<?=$username;?>" >
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

                

                
                <a href="dashboard.php" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Update ':'');?> Profile">
                <div class="clearfix"></div>
            </form>
                             
                    </div>
                   
                </div>
            </div>
        </div>

<?php include 'includes/bootfooter.php' ?>