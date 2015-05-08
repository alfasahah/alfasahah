<?php
require('../includes/config.php');
?>

<?php	
	if(empty($_POST) == false){
		$cat_name=$_POST['cat_name'];
		$sec_id = $_POST['section'];
		$sql="INSERT INTO category (category_name,section_id) VALUES('$cat_name','$sec_id')";
		if($con->query($sql)===TRUE) {
			echo "New category added successfully";
		}
		else {
			echo "Query Fail.";
		}
	}
	$con->close();
?>