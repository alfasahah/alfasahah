<?php
require('../includes/config.php');

$edit_id=$_GET['id'];

?>

<?php
		$sql = "SELECT category.category_name,section.section_name,section.section_id FROM category,section WHERE section.section_id=category.section_id AND category_id=$edit_id";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		$sql_s = "SELECT section_id, section_name FROM section";
		$result_s = mysqli_query($con,$sql_s);
	?>

<!doctype html>
<html>
<head>
</head>
<body>	
	<form action="" method="POST" >
	<select name="section" data-rule-required="true" >
		<?php	$sec_id = $row['section_id']; ?>
		<?php while($row_s = mysqli_fetch_array($result_s)) { ?>
		<option <?php if($sec_id == $row_s['section_id']) {  ?> selected <?php } ?> value="<?php echo $row_s['section_id']; ?>" > <?php echo $row_s['section_name']; ?> </option>
		<?php } ?>		
	</select>
	<input type="text" name="cat_name" value="<?php echo $row['category_name']; ?>">
	<input type="submit" value="Submit">
	</form>
</body>
</html>

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