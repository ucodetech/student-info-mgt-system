<?php
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	if (!has_permission('superuser')) {
		permission_error_redirect();
	}
	include 'includes/head1.php';

   if (isset($_GET['delete'])) {
     $deleteSingle_id = (int)$_GET['delete'];
      $singlesResults = $db->query("UPDATE student_marks SET deleted = '' WHERE id = '$deleteSingle_id'");
    $_SESSION['success_flash'] = 'deleted';
      header("Location: student_marks.php");

      }
  
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
         $edit_id = (int)$_GET['edit'];
    $studentResults = $db->query("SELECT * FROM student_marks WHERE id = '$edit_id'");
    $studentf = mysqli_fetch_assoc($studentResults);

    $stu_max_scores = ((isset($_POST['stu_max_scores']) && !empty($_POST['stu_max_scores']))?sanitize($_POST['stu_max_scores']): $studentf['stu_max_scores']);
    $stu_scores_ob = ((isset($_POST['stu_scores_ob']) && !empty($_POST['stu_scores_ob']))?sanitize($_POST['stu_scores_ob']): $studentf['stu_scores_ob']);
    
  
        if ($_POST) {
            $errors = array();
            $required = array('stu_max_scores', 'stu_scores_ob');
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    $errors[] = 'All field are Required';
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            }else {
                if (isset($_GET['edit'])) {
                    $updateSql = "UPDATE student_marks SET stu_max_scores = '$stu_max_scores', stu_scores_ob = '$stu_scores_ob' WHERE id = '$edit_id' ";
                        $updateResult = $db->query($updateSql);
                }
                if ($updateResult) {
                   $_SESSION['success_flash'] = "Update Successful!";
                   header("Location: student_mark.php?success");
                   

                }

            }


        }
    }



?>
            <form method="post" action="edit_Score.php?<?=((isset($_GET['edit']))?'edit='.$edit_id : '');?>" enctype="multipart/form-data">
                <div class="row">
        
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-primary">Max Score</label>
                            <input type="text" class="form-control" name="stu_max_scores"  value="<?=$stu_max_scores;?>" >
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Score Obtained</label>
                            <input type="text" name="stu_scores_ob" class="form-control" value="<?=$stu_scores_ob;?>" placeholder="stu_scores_ob">
                        </div>
                    </div>
                </div>

                <a href="student_mark.php" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-info btn-fill pull-right up" value="<?=((isset($_GET['edit']))?'Update ':'');?> Mark">
                <div class="clearfix"></div>
            </form>
                             
                    </div>
                   
                </div>
            </div>
        </div>

<?php include 'includes/bootfooter.php' ?>