       <?php 
  require_once '../core/init.php';
  require_once '../helpers/helpers.php';
    if (!is_logged_in()) {
    login_error_redirect();
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
     margin: 20px;
     padding: 10;
     text-align: center;
     box-shadow: 7px 7px 15px rgb(0,0,0,0.6);
  }


</style>
    <div class="content">
 <div class="container-fliud">

      <?php
     

             $sql = "SELECT * FROM student WHERE deleted = 0 ORDER BY id DESC";
             $result = $db->query($sql);



 ?>

    <div class="container-fliud"><hr>
<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search Students" id="searchStudent" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
 <h4 class="text-center">All Students</h4>
 <hr>
 <table class="table table-stripped table-bordered table-condensed">
   <thead>
     <th>Name</th><th>Email</th><th>Username</th><th>Joined Date</th><th>Last Login</th><th>control</th><th>Get</th>
   </thead>
   <tbody>
     <?php while($student = mysqli_fetch_assoc($result)) : ?>
     <tr>
     
       <td><?=$student['full_name'];?></td>
       <td><?=$student['email'];?></td>
       <td><?=$student['username'];?></td>
       <td><?=pretty_date($student['dateCreated']);?></td>
       <td><?=(($student['last_login'] == '0000-00-00 00:00:00')?'Never ':pretty_date($student['last_login']));?></td>
         <td>
        <a href="editacc.php?edit=<?=$student['id']; ?>" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span></a>
        <a href="editacc.php?delete=<?=$student['id']; ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a></td>
        <td><a href="viewstudentdetails.php?view=<?=$student['id'];?>">View Student Details</a></td>
     </tr>
   <?php endwhile;?>
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