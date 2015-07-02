<?php
require('../includes/config.php');

$playlist_id=$_GET['id'];

?>

<!doctype html>
<html>
<head>
</head>
<body>
	<?php
		$sql = "DELETE FROM playlist WHERE playlist_id=$playlist_id";
		
		if($con->query($sql)===TRUE) {
			echo "Delete category successfully";
		}
		else {
			echo "Query Fail.";
		}
	?>	
</body>	