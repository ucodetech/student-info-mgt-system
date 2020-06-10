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

$userQuery =$db->query("SELECT * FROM admin ORDER BY full_name");
 ?>
 <div class="content">
   <a href="dashboard.php">Admin</a>
 <h4 class="alert alert-info text-center" >Admins</h4>
 <a href="add_admins.php?add=1" class="btn btn-success pull-right " id="add-product-btn">Add New Admin</a>
 <hr>
 <table class="table table-stripped table-bordered table-condensed">
   <thead>
     <th>control</th><th>Name</th><th>Email</th><th>Last Login</th><th>Permissions</th>
   </thead>
   <tbody>
     <?php while($user = mysqli_fetch_assoc($userQuery)) : ?>
     <tr>
       <td>
        <a href="add_admin.php?edit=<?=$user['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
        <?php if($user['id'] != $user_data['id']) : ?>
         <a href="add_admin.php?delete=<?=$user['id']; ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
       <?php else: ?>
        <a class="btn btn-info"><i class="fas fa-user-cog">Admin</i></a>
       <?php endif; ?>
       </td>
       <td><?=$user['full_name'];?></td>
       <td><?=$user['email'];?></td>
       <td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never ':pretty_date($user['last_login']));?></td>
       <td><?=$user['permissions'];?></td>
     </tr>
   <?php endwhile;?>
   </tbody>
 </table>
</div>


