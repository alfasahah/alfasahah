<?php
	require('../includes/config.php');
	if($_GET['id']) {
 		$id = $_GET['id'];
	}
	else {
		echo "You have not selected any ID.";
	}
	$query_selectPhotos = "SELECT * FROM photos WHERE photo_id='$id'";
	$result_selectPhotos = $con->query($query_selectPhotos);
	$row_selectPhotos = $result_selectPhotos->fetch_array();
	$query_selectDesigner = "SELECT designer_id, designer_name FROM designer";
	$result_selectDesigner = $con->query($query_selectDesigner);
	$query_selectPlaylist = "SELECT playlist_id, playlist_name FROM playlist WHERE section_id=5 ORDER BY playlist_id DESC";
	$result_selectPlaylist = $con->query($query_selectPlaylist);
	$err_imageName = $err_downURL = $err_thumbURL = $err_size = $err_language = $err_designer = $err_playlist = '';
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$image_name = $down_URL = $thumb_URL = $size = $language = $designer = $playlist = $meta_title = $meta_desc = $meta_keyword = '';
		if(!empty($_POST['txtImageName'])) {
			$image_name = trim($_POST['txtImageName']);
		}
		else {
			$err_imageName = "* required";
		}
		if(!empty($_POST['txtDownURL'])) {
			$down_URL = trim($_POST['txtDownURL']);
		}
		else {
			$err_downURL = "* required";
		}
		if(!empty($_POST['txtThumbURL'])) {
			$thumb_URL = trim($_POST['txtThumbURL']);
		}
		else {
			$err_thumbURL = "* required";
		}
		if(isset($_POST['cmbSize'])) {
			$size = $_POST['cmbSize'];
		}
		else {
			$err_size = "* required";
		}
		if(isset($_POST['cmbLanguage'])) {
			$language = $_POST['cmbLanguage'];
		}
		else {
			$err_language = "* required";
		}
		if(isset($_POST['cmbDesigner'])) {
			$designer = $_POST['cmbDesigner'];
		}
		else {
			$err_designer = "* required";
		}
		if(isset($_POST['cmbPlaylist'])) {
			$playlist = $_POST['cmbPlaylist'];
		}
		else {
			$err_playlist = "* required";
		}
		$meta_title = $_POST['txtMetaTitle'];
		$meta_desc = $_POST['txtMetaDesc'];
		$meta_key = $_POST['txtMetaKey'];
		if($image_name != NULL && $down_URL != NULL && $thumb_URL != NULL && $size != NULL && $language != NULL && $designer != NULL && $playlist != NULL) {
			$query_updatePhoto = "UPDATE photos SET photo_name='$image_name',download_url='$down_URL',thumb_url='thumb_URL',size='$size',language='$language',designer_id='$designer',playlist_id='$playlist',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_key' WHERE photo_id='$id'";
			if($con->query($query_updatePhoto) === TRUE) {
				echo "<script>alert(\"Photo Updated successfully\");</script>";
				header('Refresh:0');
			}
			else {
				echo "<script>alert(\"There was some problem updating this Photo\");</script>";
				header('Refresh:0');
			}
		}
	}
	$con->close();
?>

<!doctype html>
<html>
<head>
	<title>Edit Image</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Edit Image</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="imageName">Image Title</label> </div>
			<div class="input-box"><input type="text" name="txtImageName" id="imageName" placeholder="Title of the Image" value="<?php echo $row_selectPhotos['photo_name']; ?>" /> </div> <span class="error_message"><?php echo $err_imageName; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="downURL">Download URL</label> </div>
			<div class="input-box"><input type="text" name="txtDownURL" id="downURL" placeholder="Download URL" value="<?php echo $row_selectPhotos['download_url']; ?>" /> </div> <span class="error_message"><?php echo $err_downURL; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="thumbURL">Thumbnail URL</label> </div>
			<div class="input-box"><input type="text" name="txtThumbURL" id="thumbURL" placeholder="Thumbnail URL" value="<?php echo $row_selectPhotos['thumb_url']; ?>" /> </div> <span class="error_message"><?php echo $err_thumbURL; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="cmbSize">Size</label> </div>
			<div class="input-box">
			<select name="cmbSize" data-rule-required="true" id="cmbSize">
				<option value="" disabled selected>-- Select Size --</option>
				<option value="4x3" <?php if($row_selectPhotos['size'] == "4x3"){ echo "selected"; } ?>>4x3</option>
				<option value="10x8" <?php if($row_selectPhotos['size'] == "10x8"){ echo "selected"; } ?>>10x8</option>
		</select></div> <span class="error_message"><?php echo $err_size; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="cmbLanguage">Language *</label> </div>
			<div class="input-box"><select name="cmbLanguage" data-rule-required="true" id="cmbLanguage">
			<option value="" disabled selected>-- Select Language --</option>
			<option value="URDU" <?php if($row_selectPhotos['language'] == "URDU"){ echo "selected"; } ?> >Urdu</option>
			<option value="ENGLISH" <?php if($row_selectPhotos['language'] == "ENGLISH"){ echo "selected"; } ?> >English</option>
		</select></div> <span class="error_message"><?php echo $err_language; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="cmbDesigner">Designer *</label> </div>
			<div class="input-box"><select name="cmbDesigner" data-rule-required="true" id="cmbDesigner">
			<option value="" disabled selected>-- Select Designer --</option>
			<?php while($row_selectDesigner = $result_selectDesigner->fetch_array()){ ?>
				<option value="<?php echo $row_selectDesigner['designer_id']; ?>" <?php if($row_selectPhotos['designer_id'] == $row_selectDesigner['designer_id']){ echo "selected";} ?>><?php echo $row_selectDesigner['designer_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_designer; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="cmbPlaylist">Playlist *</label> </div>
			<div class="input-box"><select name="cmbPlaylist" data-rule-required="true" id="cmbPlaylist">
			<option value="" disabled selected>-- Select Playlist --</option>
			<?php while($row_selectPlaylist = $result_selectPlaylist->fetch_array()){ ?>
				<option value="<?php echo $row_selectPlaylist['playlist_id']; ?>" <?php if($row_selectPhotos['playlist_id'] == $row_selectPlaylist['playlist_id']){ echo "selected";} ?>><?php echo $row_selectPlaylist['playlist_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_playlist; ?></span>
		</li>
<!-- meta title -->
		<li>
			<div class="label-block"> <label for="metaTitle">Meta Title</label> </div>
			<div class="input-box"><textarea name="txtMetaTitle" id="metaTitle" rows="5" placeholder="Meta Title"><?php echo $row_selectPhotos['meta_title']; ?></textarea> </div>
		</li>
<!-- meta desc -->
		<li>
			<div class="label-block"> <label for="metaDesc">Meta Description</label> </div>
			<div class="input-box"><textarea name="txtMetaDesc" id="metaTitle" rows="5" placeholder="Meta Description"><?php echo $row_selectPhotos['meta_desc']; ?></textarea> </div>
		</li>
<!-- meta keyword -->
		<li>
			<div class="label-block"> <label for="metaKey">Meta Keywords</label> </div>
			<div class="input-box"><textarea name="txtMetaKey" id="metaKey" rows="5" placeholder="Meta Keywords"><?php echo $row_selectPhotos['meta_keyword']; ?></textarea> </div>
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