<?php

	require_once ('../core/init.php');
    require_once ('../helpers/helpers.php');

 if (isset($_GET['id'])) {
    $ids = (int)$_GET['id'];

    // fetch file to download from database
    $sql = "SELECT * FROM assignment WHERE id = '$ids' "; 
    $result = $db->query($sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../assignments/' . $file['file'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' .filesize('../assignments/' . $file['file']));
        readfile('../assignments/' . $file['file']);
        exit;
    }

}
		
		
  ?>