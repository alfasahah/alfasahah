<?php
require('../includes/config.php');
?>

<?php
	$query_selectSection = "SELECT section_id, section_name FROM section WHERE NOT (section_id=5)";
	$result_selectSection = $con->query($query_selectSection);
	$query_selectPlaylist = "SELECT playlist_id, playlist_name FROM playlist ORDER BY playlist_id DESC";
	$result_selectPlaylist = $con->query($query_selectPlaylist);
	$query_selectChannel = "SELECT channel_id, channel_name FROM channel ORDER BY channel_name ASC";
	$result_selectChannel = $con->query($query_selectChannel);
	$holder_videoName = $holder_language = $holder_section = $holder_playlist = $holder_embedCode = $holder_channel = $holder_metaTitle = $holder_metaDesc = $holder_metaKey = "";
	$err_videoName = $err_language = $err_section = $err_playlist = $err_channel = $err_embedCode = $gen_error = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$video_name = $language = $featured = $playlist = $channel = $embed_code = $meta_title = $meta_desc = $meta_key = '';
		if(!empty($_POST['txtVideoName'])) {
			$video_name = $_POST['txtVideoName'];
			$holder_videoName = $_POST['txtVideoName'];
		}
		else {
			$err_videoName = "* required";
		}
		if(isset($_POST['cmbLanguage'])) {
			$language = $_POST['cmbLanguage'];
			$holder_language = $_POST['cmbLanguage'];
		}
		else {
			$err_language = "* required";
		}
		if(isset($_POST['cmbSection'])) {
			$section = $_POST['cmbSection'];
			$holder_section = $_POST['cmbSection'];
		}
		else {
			$err_section = "* required";
		}
		if(isset($_POST['cmbPlaylist'])) {
			$playlist = $_POST['cmbPlaylist'];
			$holder_playlist = $_POST['cmbPlaylist'];
		}
		else {
			$err_playlist = "* required";
		}
		if(isset($_POST['cmbChannel'])) {
			$channel = $_POST['cmbChannel'];
			$holder_channel = $_POST['cmbChannel'];
		}
		else {
			$err_channel = "* required";
		}
		if(!empty($_POST['txtEmbedCode'])) {
			$embed_code = $_POST['txtEmbedCode'];
			$holder_embedCode = $_POST['txtEmbedCode'];
		}
		else {
			$err_embedCode = "* required";
		}
		$featured = $_POST['featured'];
		$meta_title = $_POST['txtMetaTitle'];
		$holder_metaTitle = $_POST['txtMetaTitle'];
		$meta_desc = $_POST['txtMetaDesc'];
		$holder_metaDesc = $_POST['txtMetaDesc'];
		$meta_key = $_POST['txtMetaKey'];
		$holder_metaKey = $_POST['txtMetaKey'];
		if($video_name=="" || $language=="" || $playlist=="" || $channel=="" || $embed_code==""){
			$gen_error = "Fields marked with * are compulsory";
		}
		else {
			$query_insertVideo = "INSERT into videos(video_name,embed_code,language,featured,playlist_id,channel_id,meta_title,meta_desc,meta_keyword) VALUES('$video_name','$embed_code','$language','$featured','$playlist','$channel','$meta_title','$meta_desc','$meta_key')";
			if($con->query($query_insertVideo) === TRUE) {
				echo "<script>alert(\"New Video added successfully\");</script>";
				header('Refresh:0');
			}
			else {
				echo "<script>alert(\"There was some problem adding this video\");</script>";
				header('Refresh:0');
			}
		}
	}
$con->close();
?>

<!doctype html>
<html>
<head>
	<title>Add Video</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<script type="text/javascript" src="../includes/jquery.js"> </script>
	<script type="text/javascript" src="select_playlist.js"> </script>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Add Video</h1>
	<form action="" method="POST" enctype="multipart/form-data" class="form">
	<ul class="form-list">
<!-- Video Name -->
		<li>
			<div class="label-block"> <label for="videoName">Video Name *</label> </div>
			<div class="input-box"><input type="text" name="txtVideoName" id="videoName" placeholder="Title of the Video" value="<?php echo $holder_videoName; ?>" /> </div> <span class="error_message"><?php echo $err_videoName; ?></span>
		</li>
<!-- Language -->
		<li>
			<div class="label-block"> <label for="cmbLanguage">Language *</label> </div>
			<div class="input-box"><select name="cmbLanguage" data-rule-required="true" id="cmbLanguage">
			<option value="" disabled selected>-- Select Language --</option>
			<option value="URDU" <?php if($holder_language == "URDU"){ echo "selected"; } ?> >Urdu</option>
			<option value="ENGLISH" <?php if($holder_language == "ENGLISH"){ echo "selected"; } ?> >English</option>
		</select></div> <span class="error_message"><?php echo $err_language; ?></span>
		</li>
<!-- featured -->
		<li>
			<div class="label-block"> <label for="featured">Featured</label> </div>
			<div class="input-box"><select name="featured" data-rule-required="true" id="featured">
			<option value="0"> No </option>
			<option value="1"> Yes </option>
		</select></div>
		</li>
<!-- Section -->
		<li>
			<div class="label-block"> <label for="cmbSection">Section *</label> </div>
			<div class="input-box"><select name="cmbSection" data-rule-required="true" id="cmbSection">
			<option value="" disabled selected>-- Select Section --</option>
			<?php while($row_selectSection = $result_selectSection->fetch_array()){ ?>
				<option value="<?php echo $row_selectSection['section_id']; ?>"><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_section; ?></span>
		</li>
<!-- playlist -->
 		<li>
			<div class="label-block"> <label for="cmbPlaylist">Playlist *</label> </div>
			<div class="input-box"><select name="cmbPlaylist" data-rule-required="true" id="cmbPlaylist">
			<option value="" disabled selected>Select Section to Activate</option>
		</select></div> <span class="error_message"><?php echo $err_playlist; ?></span>
		</li>
<!-- Channel -->
		<li>
			<div class="label-block"> <label for="cmbChannel">Channel *</label> </div>
			<div class="input-box"><select name="cmbChannel" data-rule-required="true" id="cmbChannel">
			<option value="" disabled selected>-- Select Channel --</option>
			<?php while($row_selectChannel = $result_selectChannel->fetch_array()){ ?>
				<option value="<?php echo $row_selectChannel['channel_id']; ?>" <?php if($holder_channel == $row_selectChannel['channel_id']){ echo "selected";} ?>><?php echo $row_selectChannel['channel_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_channel; ?></span>
		</li>
<!-- Embed Code -->
		<li>
			<div class="label-block"> <label for="embedCode">Embed Code *</label> </div>
			<div class="input-box"><input type="text" name="txtEmbedCode" id="embedCode" placeholder="Embed code of the Video" value="<?php echo $holder_embedCode; ?>" /> </div> <span class="error_message"><?php echo $err_embedCode; ?></span>
		</li>
<!-- meta title -->
		<li>
			<div class="label-block"> <label for="metaTitle">Meta Title</label> </div>
			<div class="input-box"><textarea name="txtMetaTitle" id="metaTitle" rows="5" placeholder="Meta Title"><?php echo $holder_metaTitle; ?></textarea> </div>
		</li>
<!-- meta desc -->
		<li>
			<div class="label-block"> <label for="metaDesc">Meta Description</label> </div>
			<div class="input-box"><textarea name="txtMetaDesc" id="metaTitle" rows="5" placeholder="Meta Description"><?php echo $holder_metaDesc; ?></textarea> </div>
		</li>
<!-- meta keyword -->
		<li>
			<div class="label-block"> <label for="metaKey">Meta Keywords</label> </div>
			<div class="input-box"><textarea name="txtMetaKey" id="metaKey" rows="5" placeholder="Meta Keywords"><?php echo $holder_metaKey; ?></textarea> </div>
		</li>
<!-- submit -->
		<li>
			<input type="submit" value="Add Video" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
		</li>
	</ul>
	</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
	<script type="text/javascript" src="../includes/jquery.js"> </script>
	<script type="text/javascript" src="select_playlist.js"> </script>
</body>
</html>