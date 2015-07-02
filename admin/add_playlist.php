<?php
require('../includes/config.php');
?>

<?php	
	$query_selectSection = "SELECT section_id, section_name FROM section";
	$result_selectSection = $con->query($query_selectSection);
	$query_selectCategory = "SELECT category_id, category_name FROM category";
	$result_selectCategory = $con->query($query_selectCategory);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$play_name = $section = $category = $featured = $image_path = $play_desc = $meta_title = $meta_desc = $meta_key = '';
	}
	$con->close();
?>

<!doctype html>
<html>
<head>
	<title>Add Playlist</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Add Playlist</h1>
	<form action="" method="POST" enctype="multipart/form-data" class="form">
	<ul class="form-list">
<!-- playlist name -->
		<li>
			<div class="label-block"> <label for="playName">Playlist Name</label> </div>
			<div class="input-box"><input type="text" name="txtPlayName" id="playName" placeholder="Playlist Name" value="<?php echo $holder_playName; ?>" /> </div> <span class="error_message"><?php echo $err_playName; ?></span>
		</li>
<!-- section -->
		<li>
			<div class="label-block"> <label for="cmbSection">Section</label> </div>
			<div class="input-box"><select name="cmbSection" data-rule-required="true" id="cmbSection">
			<option value="" disabled selected>-- Select Section --</option>
			<?php while($row_selectSection = $result_selectSection->fetch_array()){ ?>
				<option value="<?php echo $row_selectSection['section_id']; ?>" <?php if($holder_sectionId == $row_selectSection['section_id']){ echo "selected";} ?>><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_sectionId; ?></span>
		</li>
<!-- category -->
		<li>
			<div class="label-block"> <label for="cmbCategory">Category</label> </div>
			<div class="input-box"><select name="cmbCategory" data-rule-required="true" id="cmbCategory">
			<option value="" disabled selected>-- Select Category --</option>
			<?php while($row_selectCategory = $result_selectCategory->fetch_array()){ ?>
				<option value="<?php echo $row_selectCategory['category_id']; ?>" <?php if($holder_categoryId == $row_selectCategory['category_id']){ echo "selected";} ?>><?php echo $row_selectCategory['category_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_categoryId; ?></span>
		</li>
<!-- featured -->
		<li>
			<div class="label-block"> <label for="featured">Featured</label> </div>
			<div class="input-box"><select name="featured" data-rule-required="true" id="featured">
			<option value="0"> No </option>
			<option value="1"> Yes </option>
		</select></div>
		</li>
<!-- image -->
		<li>
			<div class="label-block"> <label for="image">Image</label> </div>
			<div class="input-box"><input type="file" name="image" id="image" /> </div> <span class="error_message"><?php echo $err_playName; ?></span>
		</li>
<!-- playlist desc -->
		<li>
			<div class="label-block"> <label for="playDesc">Description</label> </div>
			<div class="input-box"><textarea name="txtPlayDesc" id="playDesc" rows="5" placeholder="Description of Playlist" value="<?php echo $holder_playDesc; ?>"></textarea> </div>
		</li>
<!-- meta title -->
		<li>
			<div class="label-block"> <label for="metaTitle">Meta Title</label> </div>
			<div class="input-box"><textarea name="txtMetaTitle" id="metaTitle" rows="5" placeholder="Meta Title" value="<?php echo $holder_metaTitle; ?>"></textarea> </div>
		</li>
<!-- meta desc -->
		<li>
			<div class="label-block"> <label for="metaDesc">Meta Description</label> </div>
			<div class="input-box"><textarea name="txtMetaDesc" id="metaTitle" rows="5" placeholder="Meta Description" value="<?php echo $holder_metaDesc; ?>"></textarea> </div>
		</li>
<!-- meta keyword -->
		<li>
			<div class="label-block"> <label for="metaKey">Meta Keywords</label> </div>
			<div class="input-box"><textarea name="txtMetaKey" id="metaKey" rows="5" placeholder="Meta Keywords" value="<?php echo $holder_metaKey; ?>"></textarea> </div>
		</li>
<!-- submit -->
		<li>
			<input type="submit" value="Add Playlist" class="submit_button" />
		</li>
	</ul>
	</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>