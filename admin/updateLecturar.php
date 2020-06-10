 <?php
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
 if (!is_logged_in()) {
   login_error_redirect();
 }
 if (!has_permission('admin')) {
		permission_error_redirect();
	}
 include 'includes/head1.php';

//delete function
 if (isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
    $db->query("UPDATE lecturar SET deleted =  '' WHERE id = '$id' ");
    header("Location: all_lecturars.php");
}
$saved_dest = '';

       if (isset($_GET['edit'])) {
         $edit_id = (int)$_GET['edit'];
    $adminResults = $db->query("SELECT * FROM lecturar WHERE id = '$edit_id'");
    $adminf = mysqli_fetch_assoc($adminResults);
        //saved designated course  
      if (isset($_GET['delete_dest'])) {
        $db->query("UPDATE lecturar SET courseHandle_id = '' WHERE id = '$edit_id' ");
        header('Location: updateLecturar.php?edit='.$edit_id);
      }

    $full_name = ((isset($_POST['full_name']) && !empty($_POST['full_name']))?sanitize($_POST['full_name']): $adminf['full_name']);
    $email = ((isset($_POST['email']) && !empty($_POST['email']))?sanitize($_POST['email']): $adminf['email']);
    $username = ((isset($_POST['username']) && !empty($_POST['username']))?sanitize($_POST['username']): $adminf['username']);
    
    $courseHandle_id = ((isset($_POST['courseHandle_id']) && !empty($_POST['courseHandle_id']))?sanitize($_POST['courseHandle_id']): $adminf['courseHandle_id']);

     $saved_dest = (($adminf['courseHandle_id'] != '')?$adminf['courseHandle_id']:'');
     $courseHandle = $saved_dest;
    }
        if ($_POST) {
            $errors = array();
            $required = array('full_name', 'email', 'username', 'courseHandle_id');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    $errors[] = 'All field are Required';
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE lecturar SET full_name = '$full_name', email = '$email', username = '$username', courseHandle_id = '$courseHandle' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                    $_SESSION['success_flash'] ='Lecturar Updated';
                    header("Location: all_lecturars.php");
             
                }else{
                	echo "something went wrong",mysqli_error($db);
                }

            }

}
        



   ?>
   <div class="container">
    <div class="header">
   <h4 class="text-center text-primary"><?=((isset($_GET['edit']))? 'Edit Lecturar': '');?></h4>
     </div>
  <form method="POST"  action="updateLecturar.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>">

<div class="col-md-12 form-group">
  <label>Lecturar Full Name: <span class="text-danger">*</span></label>
  <input type="text" name="full_name"  value="<?=$full_name;?>" class="form-control">
</div>
<div class="col-md-12 form-group">
  <label>Lecturar Email: <span class="text-danger">*</span></label>
  <input type="email" name="email" value="<?=$email;?>" class="form-control">
</div>
<div class="col-md-12 form-group">
  <label>Lecturar Username: <span class="text-danger">*</span></label>
  <input type="text" name="username"  value="<?=$username;?>"class="form-control">
</div>

<?php $sqlquery = $db->query("SELECT * FROM master_subjects ORDER BY id DESC");
?>
  <div class="form-group col-md-12">
    <label for="permissions">Saved Designation</label><br>
      <?php if($saved_dest != ''): ?>
        <div class="saved_dest">
         current designation:<input type="text" disabled name="courseHandle_id" value="<?=$saved_dest;?>" class="form-control">
       <br>
          <a class="btn btn-danger" href="updateLecturar.php?delete_dest=1&edit=<?=$edit_id;?>">Delete Designated Course</a>
        </div>
      <?php else: ?>
   <label for="permissions">Course Designated</label><br>
    <select name="courseHandle_id" id="courseHandle_id">
    <option></option>
    <?php while ($row = mysqli_fetch_assoc($sqlquery)): ?>
 <option value="<?=$row['id'];?>"><?=$row['sub_code'];?> <?=$row['sub_name'];?></option>
<?php endwhile; ?>
  </select>
    <?php endif; ?>
    </div>
 

<div class="col-md-12 form-group">
  <a href="dashboard.php" class="alert alert-danger">Cancel</a>
  <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Update ':'');?> Lecturar">
          <div class="clearfix"></div>
</div>

</form>
</div>
 <?php include 'includes/bootfooter.php'; ?>
<style type="text/css">
  
label{
  color: #456789;
  font-size: 20px;
  font-family:Cooper Black, serif;

}

input[type='text'],input[type='email'], input[type='number'],input[type='password']{
  background-color: #456;
  border: none;
  font-size: 18px;
  color:skyblue;

}
select, option {
  background-color: #456;
  border: none;
  font-size: 18px;
  color:skyblue;
  width: 40%;
  border-radius: 10px;
  height: 50px;
}
input[type='text'] placeholder{
  color: #fff;
}
input[type='text']:hover,input[type='email']:hover, input[type='number']:hover,input[type='password']:hover{
  background-color: #457;
  border: none;
}
input[type='text']:focus,input[type='email']:focus, input[type='number']:focus,input[type='password']:focus{
  background-color: #566656;
  border: 2px solid green;
  color:skyblue;
  
}
input[type='radio']{
  font-size: 18px;
  height: 25px;
    width: 25px;
}
input[type='radio']:checked{
background-color: #2196F3;
  height: 30px;
    width: 30px;
}
</style>