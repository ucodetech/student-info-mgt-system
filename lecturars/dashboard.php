       <?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_lectlogged_in()) {
    login_error_redirect();
  }
  if (!has_permission_lect('lecturar')) {
    lectpermission_error_redirect();
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
     margin: 20px;
     padding: 0;
  }
   .b1{
     border: 1px solid #edd;
     margin: 5px;
     padding: 10;
     text-align: left;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
  }


</style>
  <div class="container-fliud content">
      <?php
     

             $sql = "SELECT * FROM student WHERE deleted = 0 ORDER BY id DESC";
             $result = $db->query($sql);



 ?>

    <div class="container-fliud">
      
      <?php
        $sqlpro = $db->query("SELECT * FROM lecturarprofile WHERE lecturar_id = '$lecturar_id' ");
        $ret = mysqli_fetch_assoc($sqlpro);
        if($ret){
         
        }else{
            ?>
             <form method="post" action="createprofile.php">
        <div class="form-group">
          <label>Create Profile</label> <br>
        <input type="submit" name="create" class="btn btn-lg btn-primary" value="Create Profile">
        </div>
      </form>
            <?
        } 
        
      ?>
      
    
      <hr>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search Students" id="searchStudent" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
 <h4 class="text-center">All Students</h4>
 <hr>
 <div class="table-responsive">
     <table class="table table-stripped table-bordered table-condensed">
   <thead>
     <th>Name</th><th>Email</th><th>Username</th><th>Joined Date</th><th>Last Login</th><th>Get</th>
   </thead>
   <tbody>
     <?php while($student = mysqli_fetch_assoc($result)) : ?>
     <tr>
     
       <td><?=$student['full_name'];?></td>
       <td><?=$student['email'];?></td>
       <td><?=$student['username'];?></td>
       <td><?=pretty_date($student['dateCreated']);?></td>
       <td><?=(($student['last_login'] == '0000-00-00 00:00:00')?'Never ':pretty_date($student['last_login']));?></td>
        
        <td><a href="viewstudentdetails.php?view=<?=$student['id'];?>">View Student Details</a></td>
     </tr>
   <?php endwhile;?>
   </tbody>
 </table>
 </div>    
</div>
<hr>

     <div class="col-md-12 b1">
            
  <h6 class="text-primary text-center">  Give Assignment (PDF, DOCS)</h6>

  <form method="POST" action="giveAss.php" enctype="multipart/form-data">
    <div class="form-group">
      <?php 
  $sql6 = "SELECT * FROM master_subjects WHERE deleted = 0 AND lecturer = '$lecturar_id' ORDER BY id DESC  ";
  $query6 = $db->query($sql6);
   ?>
      <select name="sub_code" id="sub_code" class="form-control">

      <option>----select course ------</option>
      <?php while ($row6 = mysqli_fetch_assoc($query6)): ?>
        <option value="<?=$row6['id'];?>"> <?=$row6['sub_code'];?>  <?=$row6['sub_name'];?>  </option>
      <?php endwhile; ?>
    </select>
    </div>
    <div class="form-group">
      <label>File <span class="text-danger">*</span></label>
      <input type="file" name="file" class="form-control"> 
    </div>
     <div class="form-group">
      <label>Date of Submission <span class="text-danger">*</span></label>
      <input type="date" name="date_sub" class="form-control"> 
    </div>
     <div class="form-group">
      <label>Time of Submission <span class="text-danger">*</span></label>
      <input type="time" name="time_sub" class="form-control"> 
    </div>
    <button type="submit" name="submit"  class="btn btn-lg btn-info">Give Assignment</button>
  </form>
</div>
<hr>



<?php 
  
  $sql7 = "SELECT * FROM assignment WHERE lecturar_id = '$lecturar_id' ";
  $query7 = $db->query($sql7);
 ?>
<div class="col-md-12 b1">
   <div class="table-responsive ">
    <h6>Assigments</h6>
<table class="table table-hover table-striped">
<thead>
  <th>File</th>
  <th>Course Code</th>
  <th>Course Title</th>
  <th>Date Given</th>
  <th>Date of Submission</th>
  <th>Time of Submission</th>
  <th>Download file</th>
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
      <td><?=$ress['file'];?></td>
      <td><?=$resu['sub_code'];?></td>
      <td><?=$resu['sub_name'];?></td>
      <td><?=pretty_dates($ress['dateGiven']);?></td>
      <td><?=pretty_dates($ress['date_to_submitted']);?></td>
      <td><?=pretty_datee($ress['time_to_submitted']);?></td>
      <td>
    <a href="downloads.php?id=<?=$ress['id'];?>" class="text-white" download><i class="fa fa-download" aria-hidden="true"></i></a>
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

    $("#searchStudent").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#searchStudent tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });

 </script>