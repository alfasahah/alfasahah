<?php
require('../includes/config.php');

$edit_id=$_GET['id'];

?>

<!doctype html>
<html>
<head>
</head>
<body>
	<?php
		$sql = "DELETE FROM category WHERE category_id=$edit_id";
		
		if($con->query($sql)===TRUE) {
			echo "Delete category successfully";
		}
		else {
			echo "Query Fail.";
		}
	?>	
</body>	