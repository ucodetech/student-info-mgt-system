<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="index.php">SIMS</a>

<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item">
         <a class="nav-link text-light" href="contact.php" target="_blank"><i class="fa fa-life-ring"></i>Contact Us</a>

    </li>

  </ul>
  <ul class="navbar-nav navbar-right">
    <?php if (isset($_SESSION['LECturar'])): ?>
  <li class="nav-item"><a class="nav-link  text-light" href="lecturar/logout.php"><i class="  fa fa-close"></i> Logout: <span class="text-danger"><?=$lecturar_data['first'];?></span></a></li>
  <?php elseif (isset($_SESSION['STuser'])): ?>
    <li class="nav-item"><a class="nav-link  text-light" href="studentportal1/logout.php"><i class="  fa fa-close"></i> Logout: <span class="text-danger"><?=$student_data['first'];?></span></a></li>
    <?php endif ?>
  </ul>
</div>
</nav>

<style type="text/css">
  .navbar-brand{
    font-family: StitchyTimes, serif;
    text-transform: capitalize;
    font-size:30px;
  }
  li a{
    font-size: 20px;
    font-family: StitchyTimes, serif;
    text-transform: capitalize;
  }
</style>