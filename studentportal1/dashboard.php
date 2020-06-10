<?php 
        require_once '../core/init.php';
        require_once '../helpers/helpers.php';
        if (!is_Slogged_in()) {
        stdlogin_error_redirect();
        }
    include 'includes/head.php';

?>  
        <style type="text/css">
  .form{
    background: #222d;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin: 10px;
    font-size:20px;
  }
   .form2{
    background: #112e;
    border-radius: 6px;
    box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
    color: #fff;
    margin-left:20px;
    margin-right: 10px;
    margin-bottom: 10px;
    margin-top: 10px;

  }
  .d{
    text-transform: lowercase;
  }
  .name{
    text-transform: uppercase;
  }
  .b{
     border: 2px solid #ddd;
     margin: 5px;
     padding: 0;
  }
   .b1{
     border: 1px solid #edd;
     padding: 10;
     text-align: center;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
     width:100%;
  }
  .b2{
     border: 1px solid #edd;
     padding: 10;
     text-align: center;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
  }

</style>
<?php 
  $sql3 = "SELECT * FROM `student_info` WHERE sess_id = '$student_id' ";
  $query3 = $db->query($sql3);
  $rows = mysqli_fetch_assoc($query3);


  $sql5 = "SELECT * FROM `assignm` WHERE student_id = '$student_id' AND submitted = 1 ";
  $query5 = $db->query($sql5);
  $row5 = mysqli_fetch_assoc($query5);
  
  $sql7 = "SELECT * FROM assignm WHERE student_id = '$student_id' ";
  $query7 = $db->query($sql7);

$sql8 = "SELECT * FROM assignment ";
  $query8 = $db->query($sql8);

  $sql4 = "SELECT * FROM assignment WHERE marked = 'yes' AND student_id = '$student_id' ";
  $query4 = $db->query($sql4);


 ?>
 <div class="container-fluid content">
        <div class="row b">
          <div class="col-md-12 b1">
   <div class="table-responsive ">
    <h6>Assigments</h6>
<table class="table table-hover table-striped">
<thead>
  <th>Course Code</th>
  <th>Course Title</th>
  <th>Date Given</th>
  <th>Date of Submission</th>
  <th>Time of Submission</th>
  <th>Download</th>
</thead>
<tbody>
<?php 
  if (mysqli_num_rows($query8) > 0) {
    while ($red = mysqli_fetch_assoc($query8)) {
      $code3  = $red['sub_code_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code3' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
       <tr>
      <td><?=$resu['sub_code'];?></td>
      <td><?=$resu['sub_name'];?></td>
      <td><?=pretty_dates($red['dateGiven']);?></td>
      <td><?=pretty_dates($red['date_to_submitted']);?></td>
      <td><?=pretty_datee($red['time_to_submitted']);?></td>
      <td>
     <a href="downloads.php?id=<?=$red['id'];?>" class="text-white" download><i class="fa fa-download" aria-hidden="true"></i></a>
      </td>
    </tr>
      <?
    }
  }
 ?>

  </tbody>
</table>
</div>
</div><hr>
           <div class="col-md-12 b2">
            
  <h6 class="text-primary">  Submit Assignment (PDF, DOCS)</h6>

  <form method="POST" action="subass.php" enctype="multipart/form-data">
    <div class="form-group">
      <?php 
      $sql10 = "SELECT * FROM assignment";
       $query10 = $db->query($sql10);
  
 
  ?>  <span>----select course ------</span>
      <select name="sub_code" id="sub_code" class="form-control">

    
      <?php 
      if (mysqli_num_rows($query10) > 0) {
        while ( $row6 = mysqli_fetch_assoc($query10)) {
          $re = $row6['sub_code_id'];
          $sqll = $db->query("SELECT * FROM master_subjects WHERE id = '$re' ");
          $rr = mysqli_fetch_assoc($sqll);
          ?>
          <option value="<?=$row6['sub_code_id'];?>"> <?=$rr['sub_code'];?> <?=$rr['sub_name'];?>  </option>
          <?
        }
      }
    
        ?>
    </select>
    </div>
    <div class="form-group">
      <input type="file" name="file" class="form-control"> 
    </div>
    <button type="submit" name="submit"  class="btn btn-lg btn-info">Submit Assignment</button>
  </form>
</div>
<div class="col-md-12 b1">
   <div class="table-responsive ">
    <h6>Submitted Assigments</h6>
<table class="table table-hover table-striped">
<thead>
  <th>ID</th>
  <th>Course Code</th>
  <th>Course Title</th>
  <th>Date Submitted</th>
  <th>Marked</th>
  <th>Check Score</th>
</thead>
<tbody>
<?php 
  if (mysqli_num_rows($query7) > 0) {
    while ($ress = mysqli_fetch_assoc($query7)) {
      $code2  = $ress['sub_code_id'];
      $sql9= "SELECT * FROM master_subjects WHERE id = '$code2' ";
      $query9 = $db->query($sql9);
      $resu = mysqli_fetch_assoc($query9);
      ?>
       <tr>
      <td><?=$ress['id'];?></td>
      <td><?=$resu['sub_code'];?></td>
      <td><?=$resu['sub_name'];?></td>
      <td><?=pretty_dates($ress['dateSubmitted']);?></td>
      <td>
        <?php if ($ress['marked'] == 'yes'): ?>
          <span class="text-success"><?=$ress['marked'];?></span>
          <?php else: ?>
              <span class="text-danger"><?=$ress['marked'];?></span>
        <?php endif ?>
      </td>
      <td>
       <?php if ($ress['marked'] == 'yes'): ?>
          <a href="result.php?score=<?=$ress['sub_code_id'];?>" class="btn btn-sm btn-success">Score</a>
          <?php else: ?>
            <span class="text-danger">Not Marked</span>
       <?php endif ?>
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
      </div>
 <?php include 'includes/bootfooter.php'; ?>
 <script type="text/javascript">
   // $(document).ready(function(){
   //  $('#getScore').on('click', function(){
   //    var reg_id = $('#reg_id').val();
   //    var sub_code = $('#sub_code').val();

   //    if (sub_code == '') {
   //      $('#sub_code').after('<span class="text-danger">Select Course</span>');
   //    }

   //    $.ajax({
   //      url:'checkScore.php',
   //      method: 'post',
   //      data: {'reg_id':reg_id, 'sub_code':sub_code},
   //      success: function(data){
   //         $('#score').html(data);
   //      }
   //    });
   //  });

   // });
 </script>