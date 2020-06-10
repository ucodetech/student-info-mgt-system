<?php 
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	if (!has_permission('admin')) {
		permission_error_redirect();
	}
	include 'includes/head.php';

$userQuery =$db->query("SELECT * FROM lecturar ORDER BY full_name");
 ?>
 <div class="content">
 <h4 class="text-primary  text-center" >Lecturars</h4>
 <a href="add_lecturar.php?add=1" class="btn btn-success pull-right " id="add-product-btn">Add New Lecturar</a>
 <hr>
 <table class="table table-stripped table-bordered table-condensed">
   <thead>
     <th>control</th>
     <th>Name</th>
     <th>Email</th>
     <th>Username</th>
     <th>Course Designated</th>
     <th>Course Title</th>
     <th>Last Login</th>
     <th>Permissions</th>
   </thead>
   <tbody>

     <?php
       if (mysqli_num_rows($userQuery) > 0) {
    while ($user = mysqli_fetch_assoc($userQuery)) {
      $code2  = $user['courseHandle_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code2' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
      <tr>
       <td>
        <a href="updateLecturar.php?edit=<?=$user['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
         <a href="updateLecturar.php?delete=<?=$user['id']; ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
       </td>
       <td><?=$user['full_name'];?></td>
       <td><?=$user['email'];?></td>
      <td><?=$user['username'];?></td>
      <td><?=$resu['sub_code'];?></td>
      <td><?=$resu['sub_name'];?></td>
       <td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never ':pretty_date($user['last_login']));?></td>
       <td><?=$user['permissions'];?></td>
     </tr>
      <?
    }
  }
 ?>
    
     
   </tbody>
 </table>
</div>


