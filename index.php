<?php 
        require_once 'core/init.php';
  require_once 'helpers/helpers.php';
    include 'includes/head.php';
    include 'includes/nav.php';
 ?>
  <div class="container-fluid bg">
      <div class="row">
        <div class="col-md-6">
    <div class="text-center">
     <p class="data">All Data will be deleted from the database in</p>
    
    <div id="demo">

  </div>
  </div>
        </div>
        <div class="col-md-6">
          <h2 class="featurette-heading">Are You a student? <span class="text-muted">Check Out How this works.</span></h2>
        <p class="lead">This is a Demo System Management Information. Login. don't have an account yet then Register using demo name and login details.</p>
        <p class="lead">Every Data entry in the database will be deleted once this test is complete.</p>
        <div class="row">
            <div class="col-sm-3">
            <a href="studentportal1/login.php" class="btn btn-lg btn-outline btn-success">Student Login</a>
            </div>
              <div class="col-sm-3 mt-10">
            <a href="student_reg.php" class="btn btn-lg btn-outline btn-danger">Register</a>
            </div>
        </div>
        </div>
        <div class="col-md-6">
          <h2 class="featurette-heading">Are You a Lecturar? If interested to check mail me to give you login details 
            <span class="text-muted">Check Out How this works.</span></h2>
        <p class="lead">Staff Login (Lecturar) Only Lecturar Added by the HOD of department have access to this page!</p>
        <a href="lecturars/login.php" class="btn btn-lg btn-outline btn-success">Lecturar Login</a>
        <span class="text-success">(contact for access: uzbgraphixsite@gmail.com)</span> <hr>
        </div> 
        
      </div>

    </div>
	
 <?php include 'includes/footer.php' ?>
 <script type="text/javascript">
var countDownDate = new Date("June 29, 2020 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

// Get todays date and time
var now = new Date().getTime();

// Find the distance between now an the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Display the result in an element with id="demo"
document.getElementById("demo").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

// If the count down is finished, write some text
if (distance < 0) {
  clearInterval(x);
  document.getElementById("demo").innerHTML = "Page is Online Now.";
}
}, 1000);
</script>
<style type="text/css">
    
    .bg{
        margin:0;
        background-color: #061254c4;
        color: #fff;   
         }
        #demo{
          font-size: 50px;
          color: orangered;
          font-family:cursive;
          font-stretch: condensed;
        } 
        .data{
          font-size: 50px;
        }
      .gh{ 
    height: 300px;
    border: 2px solid black;
    border-radius: 15px;
    box-shadow: 7px 7px 15px rgb(0,255,0,0.6);
    padding: 15px;
    color: #fff;
    font-weight: bold;
    text-align:justify;
      }
@media screen and (max-width: 420px) {
   .gh{
    width: auto;
    height:auto;
    padding:none;
    display:block;
    text-align:justify;

     }
    img{
        width:auto;
        height:200px;
    }
    
    .bg{
        margin:0;
        background-color: #061254;
        color: #fff;   
         }
     .mt-10{
        display:block;
        padding:10px;
    }
    
}
</style>