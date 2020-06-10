<?php
	require_once '../core/init.php';
	include 		'../includes/head.php';
	include 		'includes/navigation.php';

	
		$dbpath = '';
	if (isset($_GET['add']) || isset($_GET['edit'])) {
		$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']): '');
		
		
		if (isset($_GET['edit'])) {
				$edit_id = (int)$_GET['edit'];
				$quoteResult = $db->query("SELECT * FROM quotes WHERE id = '$edit_id' ");
				$quote = mysqli_fetch_assoc($quoteResult);
				$title = ((isset($_POST['title']) && !empty($_GET['title']))?sanitize($_POST['title']):$quote['title']);
			}
			if ($_POST) {
					$errors = array();
					$required =array('title','file');
					foreach ($required as $field) {
						if($_POST[$field] == ''){
							echo "<script>alert('All Fields are Required');</script>";
							
						}
					}
					if (!empty($_FILES)) {
						var_dump($_FILES);
						$photo = $_FILES['photo'];
						$name = $photo['name'];
						$nameArray = explode('.', $name);
						$fileName = $nameArray[0];
						$fileExt = $nameArray[1];
						$mime = explode('/', $photo['type']);
						$mimeType = $mime[0];
						$mimeExt = $mime[1];
						$tmpLoc = $photo['tmp_name'];
						$fileSize = $photo['size'];
						$allowed = array('jpg', 'png', 'gif', 'jpeg');
						$uploadName = md5(microtime()).'.'.$fileExt;
						$uploadPath = BASEURL.'/uzb_graphix/quotes'.$uploadName;
						$dbpath = BASEURL.'/uzb_graphix/quotes/uploadedquotes'.$uploadName;
						 if (!in_array($fileExt, $allowed)) {
						 	echo "<script>alert('File type must be (jpg, png, jpeg, gif )');</script>";
						 }
						 if ($fileSize > 1000000) {
						 		echo "<script>alert('image Size must be below 10MB');</script>";	
						 }
						 if ($fileExt != $mimeExt  && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
						 	echo "<script>alert('Image Extenstion Does not match the File');</script>";	
						 }
					}else{
						//upload into database
						move_uploaded_file($tmpLoc, $uploadPath);
						$insertSql = "INSERT INTO videos (title, image) VALUES ('$title', '$dbpath') ";
						$db->query($insertSql);
						header('Location: add_videos.php');

					}

				}	

		
	
?>		
  <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add A New ');?> Photo</h2>

<hr><div class="col-md-12">
		<form method="post" action="add_photo.php?add=1" enctype="multipart/form-data">
			<div class="row">
				<div class="form-group col-md-4">
					<label for="title">Title*:</label>
					<input type="text" name="title" id="title" class="form-control" value="<?=((isset($_GET['title']))?sanitize($_GET['title']): '');?>">
				</div>
				<div class="form-group col-md-4">
					<label for="photo">Photo*:</label>
					<input type="file" name="photo" id="photo" class="form-control" value="<?=((isset($_GET['photo']))?sanitize($_GET['photo']): '');?>">
				</div>
				<div class="form-group col-md-4" style="float: right;">
					<a href="add_photo.php?" class="btn btn-danger">Cancel</a>
					<input type="submit" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit ' :'Add A New ');?> Photo">
				</div>
			</div>

		</form>  
	</div>
	
<?php }else{

		$sql = "SELECT * FROM quotes WHERE deleted = 0 ";
		$result = $db->query($sql);
?>
		  <h2 class="text-center text-primary">Add Quotes</h2>

  	<a href="add_photo.php?add=1" class="btn btn-success m-5" > Add Quotes</a><hr>
<div class="col-md-12">
  	<table class="table table-stripped table-condensed table-bordered">
  		<thead>
  			<th>Controls</th><th>Title</th><th>Controls</th>
  		</thead>
  		<tbody>
  			<?php while($photo = mysqli_fetch_assoc($result)): ?>
  			<tr>
  				<td>
  					<a href="add_photo.php?edit=<?=$photo['id'];?>" class="btn btn-xs btn-success"><span class="fa fa-pen"></span></a>
  				</td>
  				<td><?=$photo['title'];?></td>
  				<td><a href="add_photo.php?delete=<?=$photo['id'];?>"  class="btn btn-xs btn-danger"><span class="fa fa-pen"></span></a></td>
  			</tr>
  		<?php endwhile; ?>
  		</tbody>
  	</table>
</div>


  <?php } include 'includes/footer.php'; ?>




