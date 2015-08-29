<?php
	require('../includes/config.php');
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	else {
		echo "No Video was selected. Go back and select the video to edit.";
		die();
	}
	$query_selectVideo = "SELECT *,videos.featured,videos.meta_title,videos.meta_desc,videos.meta_keyword
							FROM videos
							INNER JOIN playlist ON playlist.playlist_id=videos.playlist_id
							INNER JOIN channel ON channel.channel_id=videos.channel_id
							WHERE video_id=$id";
	$result_selectVideo = $con->query($query_selectVideo);
	$row_selectVideo = $result_selectVideo->fetch_array();
	$query_selectPlaylist = "SELECT playlist_id, playlist_name FROM playlist ORDER BY playlist_id DESC";
	$result_selectPlaylist = $con->query($query_selectPlaylist);
	$query_selectChannel = "SELECT channel_id, channel_name FROM channel ORDER BY channel_name ASC";
	$result_selectChannel = $con->query($query_selectChannel);
	$err_videoName = $err_language = $err_playlist = $err_channel = $err_embedCode = $gen_error = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$video_name = $language = $featured = $playlist = $channel = $embed_code = $meta_title = $meta_desc = $meta_key = '';
		if(!empty($_POST['txtVideoName'])) {
			$video_name = $_POST['txtVideoName'];
		}
		else {
			$err_videoName = "* required";
		}
		if(isset($_POST['cmbLanguage'])) {
			$language = $_POST['cmbLanguage'];
		}
		else {
			$err_language = "* required";
		}
		if(isset($_POST['cmbPlaylist'])) {
			$playlist = $_POST['cmbPlaylist'];
		}
		else {
			$err_playlist = "* required";
		}
		if(isset($_POST['cmbChannel'])) {
			$channel = $_POST['cmbChannel'];
		}
		else {
			$err_channel = "* required";
		}
		if(!empty($_POST['txtEmbedCode'])) {
			$embed_code = $_POST['txtEmbedCode'];
		}
		else {
			$err_embedCode = "* required";
		}
		$featured = $_POST['featured'];
		$meta_title = $_POST['txtMetaTitle'];
		$meta_desc = $_POST['txtMetaDesc'];
		$meta_key = $_POST['txtMetaKey'];
		if($video_name=="" || $language=="" || $playlist=="" || $channel=="" || $embed_code==""){
			$gen_error = "Fields marked with * are compulsory";
		}
		else {
			$query_updateVideo = "UPDATE videos SET video_name='$video_name',embed_code='$embed_code',language='$language',featured='$featured',playlist_id='$playlist',channel_id='$channel',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_key' WHERE video_id='$id'";
			if($con->query($query_updateVideo) === TRUE) {
				echo "<script>alert(\"Video updated successfully\");</script>";
				header('Refresh:0;url=view_videos.php');
			}
			else {
				echo "<script>alert(\"There was some problem updating this video\");</script>";
				header('Refresh:0');
			}
		}
	}
$con->close();
?>

<!doctype html>
<html>
<head>
	<title>Edit Video</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Edit Video</h1>
	<form action="" method="POST" enctype="multipart/form-data" class="form">
	<ul class="form-list">
<!-- Video Name -->
		<li>
			<div class="label-block"> <label for="videoName">Video Name *</label> </div>
			<div class="input-box"><input type="text" name="txtVideoName" id="videoName" placeholder="Title of the Video" value="<?php echo $row_selectVideo['video_name']; ?>" /> </div> <span class="error_message"><?php echo $err_videoName; ?></span>
		</li>
<!-- Language -->
		<li>
			<div class="label-block"> <label for="cmbLanguage">Language *</label> </div>
			<div class="input-box"><select name="cmbLanguage" data-rule-required="true" id="cmbLanguage">
			<option value="" disabled selected>-- Select Language --</option>
			<option value="URDU" <?php if($row_selectVideo['language'] == "URDU"){ echo "selected"; } ?> >Urdu</option>
			<option value="ENGLISH" <?php if($row_selectVideo['language'] == "ENGLISH"){ echo "selected"; } ?> >English</option>
		</select></div> <span class="error_message"><?php echo $err_language; ?></span>
		</li>
<!-- featured -->
		<li>
			<div class="label-block"> <label for="featured">Featured</label> </div>
			<div class="input-box"><select name="featured" data-rule-required="true" id="featured">
			<option value="0" <?php if($row_selectVideo['featured'] == 0){ echo "selected"; } ?>> No </option>
			<option value="1" <?php if($row_selectVideo['featured'] == 1){ echo "selected"; } ?>> Yes </option>
		</select></div>
		</li>
<!-- playlist -->
		<li>
			<div class="label-block"> <label for="cmbPlaylist">Playlist *</label> </div>
			<div class="input-box"><select name="cmbPlaylist" data-rule-required="true" id="cmbPlaylist">
			<option value="" disabled selected>-- Select Playlist --</option>
			<?php while($row_selectPlaylist = $result_selectPlaylist->fetch_array()){ ?>
				<option value="<?php echo $row_selectPlaylist['playlist_id']; ?>" <?php if($row_selectVideo['playlist_id'] == $row_selectPlaylist['playlist_id']){ echo "selected";} ?>><?php echo $row_selectPlaylist['playlist_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_playlist; ?></span>
		</li>
<!-- Channel -->
		<li>
			<div class="label-block"> <label for="cmbChannel">Channel *</label> </div>
			<div class="input-box"><select name="cmbChannel" data-rule-required="true" id="cmbChannel">
			<option value="" disabled selected>-- Select Channel --</option>
			<?php while($row_selectChannel = $result_selectChannel->fetch_array()){ ?>
				<option value="<?php echo $row_selectChannel['channel_id']; ?>" <?php if($row_selectVideo['channel_id'] == $row_selectChannel['channel_id']){ echo "selected";} ?>><?php echo $row_selectChannel['channel_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_channel; ?></span>
		</li>
<!-- Embed Code -->
		<li>
			<div class="label-block"> <label for="embedCode">Embed Code *</label> </div>
			<div class="input-box"><input type="text" name="txtEmbedCode" id="embedCode" placeholder="Embed code of the Video" value="<?php echo $row_selectVideo['embed_code']; ?>" /> </div> <span class="error_message"><?php echo $err_embedCode; ?></span>
		</li>
<!-- meta title -->
		<li>
			<div class="label-block"> <label for="metaTitle">Meta Title</label> </div>
			<div class="input-box"><textarea name="txtMetaTitle" id="metaTitle" rows="5" placeholder="Meta Title"><?php echo $row_selectVideo['meta_title']; ?></textarea> </div>
		</li>
<!-- meta desc -->
		<li>
			<div class="label-block"> <label for="metaDesc">Meta Description</label> </div>
			<div class="input-box"><textarea name="txtMetaDesc" id="metaTitle" rows="5" placeholder="Meta Description"><?php echo $row_selectVideo['meta_desc']; ?></textarea> </div>
		</li>
<!-- meta keyword -->
		<li>
			<div class="label-block"> <label for="metaKey">Meta Keywords</label> </div>
			<div class="input-box"><textarea name="txtMetaKey" id="metaKey" rows="5" placeholder="Meta Keywords"><?php echo $row_selectVideo['meta_keyword']; ?></textarea> </div>
		</li>
<!-- submit -->
		<li>
			<input type="submit" value="Update" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
		</li>
	</ul>
	</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>