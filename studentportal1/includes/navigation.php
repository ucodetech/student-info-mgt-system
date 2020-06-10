
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<a class="navbar-brand" href="/uzb_grphix/Admin/admin.index.php" class="text-dark"><span class="admin">
  <i class="fa fa-home" aria-hidden="true">Admin</i></span></a>
  <!-- Links -->
  <ul class="navbar-nav ml-5 text-light">
    <li><a href="add_photo.php"  class="nav-link text-primary"><i class="fas fa-plus">Add Quote</i></a>
    </li>
    <li><a href="add_uzb.php"  class="nav-link text-primary"><i class="fab fa-plus"> Add UZB</i></a>
    </li>
    <li><a href="sampleletter.php"  class="nav-link text-primary"><i class="fab fa-plus">Add Sample letter</i></a>
    </li>
     <li><a href="samplelogo.php"  class="nav-link text-primary"><i class="fab fa-plus">Add Sample logo</i></a>
    </li>
    <li><a href="archived.php" target="_blank" class="nav-link text-primary"><i class="fas fa-archive"> Archived</i></a>
    </li>
    <?php if(has_permission('admin')) :?>
    <li><a href="users.php" target="_blank" class="nav-link text-primary"><i class="fas fa-users"> Users</i></a>
      <a href="sourceuser.php" target="_blank" class="nav-link text-primary"><i class="fas fa-users"> Visitors</i></a>
    </li>
  <?php endif; ?>

  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle fa fa-plus text-primary" aria-hidden="true"
       href="#" id="navbardrop" data-toggle="dropdown">
       Hello
     <?=$user_data['first'];?>
      <span class="caret"></span>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item text-primary" href="change_password.php"><i class="fas fa-key">Change Passcode</i></a>
        <a class="dropdown-item text-primary" href="logout.php"><i class="fas fa-sign-out-alt">Log out</i></a>
      </div>
    </li>
     <li><a href="uzb_grphix/index.php" target="_blank" class="nav-link text-primary"><i class="fab fa-home">visit site</i></a>
    </li>

  </ul>
</nav>
