<?php 
	require_once '../core/init.php';
	require_once '../helpers/helpers.php';
  if (!is_Slogged_in()) {
    stdlogin_error_redirect();
}
 include 'includes/head.php';



 ?>

<style type="text/css">
		body{
		  	background-image: url(../preloader/gears.svg);
		  	background-attachment: fixed;
		  	background-position: center;
		  	background-repeat: no-repeat;
		  	background-size: 60%;
		  }
		  .move{
		  	font-size: 20px;
		  	position: absolute;
		  	left: 35%;
		  	top: 32%;
		  	width: 100px;
		    animation-name: move;
		    animation-duration: 4s;
		    animation-delay: 2s;
		  }
		  @keyframes move {
		    from {left: 10px;}
		    to {right: 10px;}

		    from {color: red;}
		    to {color: green;}
		}



	</style>
	<meta http-equiv="refresh" content="10; url=dashboard.php">
</head>
<body>
	<div class="text-center">
		<p class="text-center text-success move">Initializing...</p>
	</div>
</body>
 
