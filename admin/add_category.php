<?php
	require('../includes/config.php');
	$query_selectSection = "SELECT section_id, section_name FROM section";
	$result_selectSection = $con->query($query_selectSection);
	$err_sectionId = $err_CatName = '';
	$holder_sectionId = $holder_catName = '';
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$section_id = $cat_name = '';
		if(isset($_POST['cmbSection'])) {
			$section_id = $_POST['cmbSection'];
			$holder_sectionId = $_POST['cmbSection'];
		}
		else {
			$err_sectionId = "* required";
		}
		if(!empty($_POST['txtCatName'])) {
			$cat_name = trim($_POST['txtCatName']);
			$holder_catName = trim($_POST['txtCatName']);
		}
		else {
			$err_CatName = "* required";
		}
		if($section_id != NULL && $cat_name != NULL) {
			$query_InsertCategory="INSERT INTO category (category_name,section_id) VALUES('$cat_name','$section_id')";
			if($con->query($query_InsertCategory) === TRUE) {
				echo "<script>alert(\"New category added successfully\");</script>";
				header('Refresh:0');
			}
			else {
				echo "<script>alert(\"There was some problem adding this category\");</script>";
				header('Refresh:0');
			}
		}
	}
	$con->close();
?>

<!doctype html>
<html>
<head>
	<title>Add Category</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Add Category</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="cmbSection">Section</label> </div>
			<div class="input-box"><select name="cmbSection" data-rule-required="true" id="cmbSection">
			<option value="" disabled selected>-- Select Section --</option>
			<?php while($row_selectSection = $result_selectSection->fetch_array()){ ?>
				<option value="<?php echo $row_selectSection['section_id']; ?>" <?php if($holder_sectionId == $row_selectSection['section_id']){ echo "selected";} ?>><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?>
		</select></div> <span class="error_message"><?php echo $err_sectionId; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="catName">Category Name</label> </div>
			<div class="input-box"><input type="text" name="txtCatName" id="catName" placeholder="Category Name" value="<?php echo $holder_catName; ?>" /> </div> <span class="error_message"><?php echo $err_CatName; ?></span>
		</li>
		<li>
			<input type="submit" value="Add Category" class="submit_button" />
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>	
</html>