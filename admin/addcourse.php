
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
                                <h4 class="title"><?=((isset($_GET['edit']))? 'Edit course': 'Addcourse course');?></h4>
                            </div>
        <div class="content">
            <?php
                          //Delete Product
 if (isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
    $db->query("UPDATE master_subjects SET deleted =  1 WHERE id = '$id' ");
    header ('Location: addcourse.php');
}
            //add or edit course      
 if (isset($_GET['add']) || isset($_GET['edit'])) {
    
    $sub_code = ((isset($_POST['sub_code']) && $_POST['sub_code']  != ' ')?sanitize($_POST['sub_code']): '');
    $sub_name = ((isset($_POST['sub_name']) && $_POST['sub_name']  != ' ')?sanitize($_POST['sub_name']): '');



    if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $addcourseResults = $db->query("SELECT * FROM master_subjects WHERE id = '$edit_id'");
    $addcoursef = mysqli_fetch_assoc($addcourseResults);

    $sub_code = ((isset($_POST['sub_code']) && !empty($_POST['sub_code']))?sanitize($_POST['sub_code']): $addcoursef['sub_code']);
    $sub_name = ((isset($_POST['sub_name']) && !empty($_POST['sub_name']))?sanitize($_POST['sub_name']): $addcoursef['sub_name']);
    
    }
        if ($_POST) {
            $errors = array();
            $required = array('sub_code', 'sub_name');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    $errors[] = 'All Fields are required!';
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                $insertSql = "INSERT INTO master_subjects (`sub_code`,  `sub_name`) VALUES ('$sub_code', '$sub_name')";

                if (isset($_GET['edit'])) {
                    $insertSql = "UPDATE master_subjects SET sub_code = '$sub_code', sub_name = '$sub_name' WHERE id = '$edit_id' ";
                 
                }
                $updateResult = $db->query($insertSql);
                if (!$updateResult) {
                   echo 'SQL Error'.mysqli_error();
                   

                }else{
                     $_SESSION['success_flash'] = 'Course Added!';
                    header("Location: addcourse.php?success");
                }

            }


        }



?>
        <form method="POST" action="addcourse.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : 'add=1');?>">
            <div class="row">
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="text-primary">Course Code</label>
                        <input type="text" class="form-control" name="sub_code"  value="<?=$sub_code;?>">
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputsub_name1">Course Name</label>
                        <input type="text" name="sub_name" class="form-control" value="<?=$sub_name;?>" placeholder="Full Name">
                    </div>
                

            
            <a href="addcourse.php" class="btn btn-danger">Cancel</a>
            <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Edit ':' Add ');?> Course">
            <div class="clearfix"></div>
        </form>
                            <?php }else{

                                $addcourseQuery =$db->query("SELECT * FROM master_subjects WHERE deleted = 0 ORDER BY id DESC ");
                                    ?>
                 <div class="container-fliud">
                <a href="dashboard.php" class="btn btn-info "  id="add-product-btn" >Back</a>
                 <hr>
                 <a href="addcourse.php?add=1" class="btn btn-success pull-right" id="add-product-btn" >Add Course</a><div class="clearfix">
                   
                 <table class="table table-stripped table-bordered table-condensed">
                   <thead>
                     <th>control</th><th>Course Code</th><th>Course Name</th><th>Lecturar</th><th>Date Added</th>
                   </thead>
                   <tbody>
                    <?php if (mysqli_num_rows($addcourseQuery) > 0){
                        while($course = mysqli_fetch_assoc($addcourseQuery)){
                            $couresid = $course['id'];
                            $getquery = $db->query("SELECT * FROM lecturar WHERE courseHandle_id = '$couresid ' ");
                            $rowss = mysqli_fetch_assoc($getquery);
                            ?>
                               <tr>
                       <td>
                        <a href="addcourse.php?edit=<?=$course['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
                        <a href="addcourse.php?delete=<?=$course['id']; ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                       </td>
                       <td><?=$course['sub_code'];?></td>
                       <td><?=$course['sub_name'];?></td>
                       <td><?=$rowss['full_name'];?></td>
                       <td><?=pretty_date($course['dateAdded']);?></td>
                       
                     </tr>
                            <?
                        }
                    }
                        

                     ?>
                     
                  
                
                   </tbody>
                 </table>
                </div>

                            <?php } ?>
                            </div>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </div>