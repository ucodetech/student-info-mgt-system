<?php include '../core/init.php' ;
	include '../helpers/helpers.php';

	$sql = "SELECT * FROM `master_subjects`";
	$result  = $db->query($sql);
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$out[]=$row;
	}
	echo json_encode($out);


?>

