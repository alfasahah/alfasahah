<?php
require('../includes/config.php');

$edit_id=$_GET['id'];

?>

<?php
	if(empty($_POST) == false){
		$cat_name = $_POST['cat_name'];
		$sec_id = $_POST['section'];
	$sql_2= "UPDATE category SET category_name='$cat_name',section_id=$sec_id WHERE category_id=$edit_id";
	if($con->query($sql_2)===TRUE) {
			echo "Update category successfully";
		}
		else {
			echo "Query Fail.";
		}
	}
?>	