<?php 
 		require_once '../core/init.php';
        require_once '../helpers/helpers.php';
 


$sub_code = ((isset($_GET['sub_code']))?sanitize($_GET['sub_code']): '');
 $reg_id = ((isset($_GET['reg_id']))?sanitize($_GET['reg_id']): '');
 $errors = array();
 if (empty($_GET['sub_code'])) {
   $errors[] = 'Select the course to check score';
 }
  if (!empty($errors)) {
        echo display_errors($errors);
      }else{

       $sqlall = "SELECT  * FROM `student_marks` WHERE stu_id = '$reg_id' AND sub_id = '$sub_code' ORDER BY id DESC ";
      $queryall =$db->query($sqlall);
      
  if (mysqli_num_rows($queryall) > 0) {
    while ($row = mysqli_fetch_assoc($queryall)) {
      $code2  = $row['sub_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code2' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
    <tr>
    <td><?=$resu['sub_code'];?></td>
    <td><?=$resu['sub_name'];?></td>
    <td><?=$row['stu_max_scores'];?></td>
    <td><?=$row['stu_scores_ob'];?></td>
    
</tr>
      <?
    }
  }
}
}
 ?>


 ?>