<?php
require('../includes/config.php');
?>

<?php	
	$sql = "SELECT section_id, section_name FROM section";
	$result = mysqli_query($con,$sql);
?>

<!doctype html>
<html>
<head>
</head>
<body>
	<form action="add_category_a.php" method="POST" >
	<select name="section" data-rule-required="true" >
		<option value="">-- Select Section --</option>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
		<?php } ?>  
	</select>
	<input type="text" name="cat_name" >
	<input type="submit" value="Submit">
	</form>	
</body>	
</html>