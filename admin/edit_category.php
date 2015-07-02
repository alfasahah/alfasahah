<?php
	require('../includes/config.php');
	$edit_id=$_GET['id'];
	$query_selectCategory = "SELECT category.category_name,section.section_name,section.section_id,category.section_id AS sec_id FROM category,section WHERE section.section_id=category.section_id AND category_id=$edit_id";
	$result_selectCategory = $con->query($query_selectCategory);
	$row_selectCategory = $result_selectCategory->fetch_array();
	$query_selectSection = "SELECT section_id, section_name FROM section";
	$result_selectSection = $con->query($query_selectSection);
	$err_sectionId = $err_CatName = '';
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$section_id = $cat_name = '';
		if(isset($_POST['cmbSection'])) {
			$section_id = $_POST['cmbSection'];
		}
		else {
			$err_sectionId = "* required";
		}
		if(!empty($_POST['txtCatName'])) {
			$cat_name = trim($_POST['txtCatName']);
		}
		else {
			$err_CatName = "* required";
		}
		if($section_id != NULL && $cat_name != NULL) {
			$query_UpdateCategory="UPDATE category SET category_name='$cat_name',section_id=$section_id WHERE category_id=$edit_id";
			if($con->query($query_UpdateCategory) === TRUE) {
				echo "<script>alert(\"Category Updated successfully\");</script>";
				header('Refresh:0;url=view_category.php');
			}
			else {
				echo "<script>alert(\"There was some problem Updating this category\");</script>";
				header('Refresh:0;url=view_category.php');
			}
		}
	}
	else {
		
	}
?>

<!doctype html>
<html>
<head>
	<head>
	<title>Update Category</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Update Category</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="cmbSection">Section</label> </div>
			<div class="input-box"><select name="cmbSection" data-rule-required="true" id="cmbSection">
			<option value="" disabled selected>-- Select Section --</option>
			<?php while($row_selectSection = $result_selectSection->fetch_array()){ ?>
				<option value="<?php echo $row_selectSection['section_id']; ?>" <?php if($row_selectCategory['sec_id'] == $row_selectSection['section_id']){ echo "selected";} ?>><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?>  
		</select>
			</div> <span class="error_message"><?php echo $err_sectionId; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="catName">Category Name</label> </div>
			<div class="input-box"><input type="text" name="txtCatName" id="catName" placeholder="Category Name" value="<?php echo $row_selectCategory['category_name']; ?>" /> </div> <span class="error_message"><?php echo $err_CatName; ?></span>
		</li>
		<li>
			<input type="submit" value="Update" class="submit_button" />
		</li>
		</ul>
		</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>