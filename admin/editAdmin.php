 <?php
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
 if (!is_logged_in()) {
   login_error_redirect();
 }
 if (!has_permission('admin')) {
		permission_error_redirect();
	}
 include 'includes/headfile.php';



       if (isset($_GET['edit'])) {
         $edit_id = (int)$_GET['edit'];
    $adminResults = $db->query("SELECT * FROM admin WHERE id = '$edit_id'");
    $adminf = mysqli_fetch_assoc($adminResults);

    $full_name = ((isset($_POST['full_name']) && !empty($_POST['full_name']))?sanitize($_POST['full_name']): $adminf['full_name']);
    $email = ((isset($_POST['email']) && !empty($_POST['email']))?sanitize($_POST['email']): $adminf['email']);
    $username = ((isset($_POST['username']) && !empty($_POST['username']))?sanitize($_POST['username']): $adminf['username']);
    
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
                    $updateSql = "UPDATE admin SET full_name = '$full_name', email = '$email', username = '$username' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                    echo "<script>alert('Admin Updated')</script>";
                    header("Location: profile.php");
             
                }else{
                	echo "something went wrong",mysqli_error($db);
                }

            }

}
        



   ?>
    <div class="header">
   <h4 class="text-center text-primary"><?=((isset($_GET['edit']))? 'Edit Profile': '');?></h4>
     </div>
      <form method="post" action="profileEdit.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>" enctype="multipart/form-data">
          <div class="row">
  
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="text-primary">username</label>
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

          <a href="profile.php" class="btn btn-danger">Cancel</a>
          <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Update ':'');?> Profile">
          <div class="clearfix"></div>
      </form>
                