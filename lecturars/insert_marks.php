<?php 
  include '../core/init.php' ;
	include '../helpers/helpers.php';

	         

        $reg_id  = ((isset($_POST['reg_id']))?sanitize($_POST['reg_id']): '');
        $subid = ((isset($_POST['subid']))?sanitize($_POST['subid']): '');
        $stu_max_scores = ((isset($_POST['stu_max_scores']))?sanitize($_POST['stu_max_scores']): '');
        $stu_scores_ob = ((isset($_POST['stu_scores_ob']))?sanitize($_POST['stu_scores_ob']): '');
   
        
         if (isset($_POST['insert'])) {
          $errors = array();
        
            if (empty($_POST['reg_id'])) {
              $errors[] = 'Student Reg No is Required!';
              $_SESSION['error_flash'] = 'Student Reg No is required!';
              header("Location: student_mark.php?errror");
            }
             if (empty($_POST['subid'])) {
              $errors[] = 'Subject is Required!';
              $_SESSION['error_flash'] = 'Subject is required!';
               header("Location: student_mark.php?errror");
            }
               if (empty($_POST['stu_max_scores'])) {
              $errors[] = 'Max Score is Required!';
              $_SESSION['error_flash'] = 'Max Score is required!';
               header("Location: student_mark.php?errror");
            }
                if (empty($_POST['stu_scores_ob'])) {
              $errors[] = 'Score obtained is Required!';
              $_SESSION['error_flash'] = 'Score obtained is required!';
               header("Location: student_mark.php?errror");
            }


      if (!empty($errors)) {
        echo display_errors($errors);
      }else{
        $sql = "INSERT INTO `student_marks` (stu_id, sub_id, stu_max_scores, stu_scores_ob) VALUES ( ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'SQL Error '.mysqli_error($db);
        }else{
         
       mysqli_stmt_bind_param($stmt, "ssss", $reg_id, $subid, $stu_max_scores, $stu_scores_ob );
        $result = mysqli_stmt_execute($stmt);
        
        $sql2 = $db->query("SELECT * FROM `student_marks");
        if (mysqli_num_rows($sql2) > 0) {
         while ($st = mysqli_fetch_assoc($sql2)) {
          $reg = $st['stu_id'];
          $sub = $st['sub_id'];
          $mark = 'yes';
          $updates = "UPDATE assignm SET marked = '$mark' WHERE reg_no  = '$reg' AND sub_code_id = '$sub' ";
          $result = $db->query($updates);

         }
        }
      
        }
        
          if (!$result) {
             echo 'SQL Error2 '.mysqli_error($db);
          }else{
            $_SESSION['success_flash'] = 'Score Inserted';
            header("Location: student_mark.php");
          }
       
      }

  

         }