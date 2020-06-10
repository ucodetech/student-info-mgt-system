<?php 
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
	 	if (!is_logged_in()) {
		login_error_redirect();
	}
	
	include 'includes/head.php';
 ?>
 	<div class="container-fluid">
   
      <h4 class="text-center">Student who have submitted their assignment</h4>
      <div class="table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                  <th>Reg No</th>
                  <th>Assignment</th>
                  <th>Date Submitted</th>
                  <th>Time Submitted</th>
                  <th>Marked</th>
                  <th>Unmark</th>
              
                </thead>

<tbody>
       <?php
           
      $sqlquery = $db->query("SELECT * FROM assignm WHERE submitted = 1 ORDER BY id DESC");
             
            ?>
            <?php while ($row = mysqli_fetch_assoc($sqlquery)):?>
               <tr>
              <td><?=$row['id'];?></td>
              <td><?=$row['reg_no'];?></td>
              <td><?=$row['file'];?></td>
              <td><?=pretty_dates($row['dateSubmitted']);?></td>
              <td><?=pretty_datee($row['dateSubmitted']);?></td>
              <td>
                <?php if ($row['marked'] == 'yes'): ?>
                  <span class="text-success" style="text-transform: uppercase;"><?=$row['marked'];?></span>
                  <?php else: ?>
                    <span class="text-danger" style="text-transform: uppercase;"><?=$row['marked'];?></span>
                <?php endif ?>
              </td>
           
             <td>
              <a href="edit_mark.php?unmark=<?=$row['id'];?>" class="btn btn-sm btn-warning text-danger"><i class="fa fa-check"></i>Unmark before deleting any score</a>

            </td>
          </tr>

          <?php endwhile; ?>
          </tbody>
            </table>

        </div>

 		<h3 >Insert Student  Marks</h3><hr>
         <form method="post" action="insert_marks.php">

 		<div class="row">
 			<div class="col-md-1">
 				<label>Student ID </label>
 			</div>
            <?php $sqlquery = $db->query("SELECT * FROM assignm WHERE submitted = 1 ORDER BY id DESC");
            ?>
 			<div class="col-md-6 form-group">
            <select name="reg_id" id="reg_id" class="form-control">
                <option>----select student id -----</option>
                <?php while ($row = mysqli_fetch_assoc($sqlquery)): ?>
             <option value="<?=$row['reg_no'];?>"><?=$row['reg_no'];?></option>
            <?php endwhile; ?>
            </select>
 			</div>
 			<div class="col-md-1">
 				<p class="btn btn-success" onclick="LoadData();"> Search</p>
 			</div>
 		</div><hr>
            
 		<div class="row">
 			
            <div class="col-md-1">
                <label>Course Code </label>
            </div>
            <div class="col-md-3 form-group">
                <input type='text'
                   placeholder='Type Course Code'
                   class='form-control flexdatalist'
                   data-search-in='sub_code'
                   data-visible-properties='["id","sub_code","sub_name"]'
                   data-selection-required='true'
                   data-value-property='id'
                   data-min-length='1'
                   name='subid' id="id" disabled="disabled" />
            </div>

            <div class="col-md-3 form-group">
                <label>Maximum Score</label>
                <input type="number" name="stu_max_scores" id="stu_max_scores" class="form-control" disabled="disabled" placeholder="Maximum Score">
            </div>
            <div class="col-md-3 form-group">
                <label>Your Score</label>
                <input type="number" name="stu_scores_ob" id="stu_scores_ob" class="form-control" disabled="disabled" placeholder="Your Score">
            </div>
            <div class="col-md-2">
                <input class="btn btn-success" type="submit" value="Insert Marks" name="insert" disabled="disabled">
            </div>        
 		</div>
     </form>

 		<hr>

            <?php 
              
                $sqlall = "SELECT  * FROM `student_marks` ORDER BY id DESC ";
                $queryall =$db->query($sqlall);
                
             ?>
 		<div class="container-fluid">
 			 <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                	<th>Course Code</th>
                    <th>Course Title</th>
                	<th>Student Reg No</th>
                	<th>Maximum Score</th>
                	<th>Score Obtained</th>
                	<th>Control</th>
                </thead>

<tbody>
    <?php 
  if (mysqli_num_rows($queryall) > 0) {
    while ($row = mysqli_fetch_assoc($queryall)) {
      $code2  = $row['sub_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code2' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
    <tr>
    <td><?=$row['id'];?></td>
    <td><?=$resu['sub_code'];?></td>
    <td><?=$resu['sub_name'];?></td>
    <td><?=$row['stu_id'];?></td>
    <td><?=$row['stu_max_scores'];?></td>
    <td><?=$row['stu_scores_ob'];?></td>
    <td>
     <a href="edit_score.php?edit=<?=$row['id'];?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>   
     <a href="edit_score.php?delete=<?=$row['id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
    </td>
</tr>
      <?
    }
  }
 ?>

</tbody>
            </table>

        </div>
 		</div>


 		
 	</div>
 	<?php include 'includes/bootfooter.php'; ?>
 	<script type="text/javascript">
 		function LoadData(){
 			$("input").prop("disabled",false);
			 $('.flexdatalist').flexdatalist({
			     minLength: 1,
			     textProperty: '{sub_code}, {sub_name}',
			     valueProperty: 'id',
			     selectionRequired: true,
			     visibleProperties: ["sub_code","sub_name"],
			     searchIn: 'sub_code',
			     data: 'ajax_sub_code.php'
			});
 		}

 		// function InsertMarks(){
 		// 	var reg_id = $("#reg_id").val();
 		// 	var sub_id = $("#sub_code").val();
 		// 	var stu_max_scores = $("#stu_max_scores").val();
 		// 	var stu_scores_ob = $("#stu_scores_ob").val();

 		// 	$.ajax({
 		// 		url: 'insert_marks.php',
 		// 		type: 'POST',
 		// 		data: {'reg_id': reg_id, 'sub_id': sub_id, 'stu_max_scores': stu_max_scores, 'stu_scores_ob':stu_scores_ob },
 		// 		datatype: 'json',
 		// 		success: function(data){

 		// 		},
 		// 		error: function(){alert('something went wrong');}
 		// 	});
 		// }
 	</script>