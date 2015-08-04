<?php
	require('../includes/config.php');
	if(!isset($_GET['id'])) {
		die();
	}
	else {
		$id = $_GET['id'];
		$query_selectSection = "SELECT section_id, section_name FROM section";
		$result_selectSection = $con->query($query_selectSection);
		$query_selectCategory = "SELECT category_id, category_name FROM category";
		$result_selectCategory = $con->query($query_selectCategory);
        $query_selectPlaylist = "SELECT * FROM playlist WHERE playlist_id = '$id'";
        $result_selectPlaylist = $con->query($query_selectPlaylist);
        $row_selectPlaylist = $result_selectPlaylist->fetch_array();
		$err_playName = $gen_error = "";
		if($_SERVER['REQUEST_METHOD'] == "POST") {
            $play_name = $section = $category = $featured = $image_path = $play_desc = $meta_title = $meta_desc = $meta_key = '';
            if (!empty($_POST['txtPlayName'])) {
                $play_name = $_POST['txtPlayName'];
            } else {
                $err_playName = "* required";
            }
            $section = $_POST['cmbSection'];
            $category = $_POST['cmbCategory'];
            $featured = $_POST['featured'];
            $play_desc = $_POST['txtPlayDesc'];
            $meta_title = $_POST['txtMetaTitle'];
            $meta_desc = $_POST['txtMetaDesc'];
            $meta_key = $_POST['txtMetaKey'];
            if ($play_name == "") {
                $gen_error = "* Playlist Name is compulsory";
            } else {
                $query_updatePlaylist = "UPDATE playlist SET playlist_name='$play_name',playlist_desc='$play_desc',featured='$featured',section_id='$section',category_id='$category',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_key' WHERE playlist_id='$id'";
                if ($con->query($query_updatePlaylist)) {
                    echo "<script> alert(\"Playlist Updated Successfully\"); </script>";
                    header("Refresh:0;url=view_playlist.php");
                } else {
                    echo "<script> alert(\"Updating Playlist Failed\"); </script>";
                    header("Refresh:0");
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
	<title>Edit Playlist</title>
	<link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>Edit Playlist</h1>
	<form action="" method="POST" enctype="multipart/form-data" class="form">
	<ul class="form-list">
<!-- playlist name -->
		<li>
			<div class="label-block"> <label for="playName">Playlist Name</label> </div>
			<div class="input-box"><input type="text" name="txtPlayName" id="playName" placeholder="Playlist Name" value="<?php echo $row_selectPlaylist['playlist_name']; ?>" /> </div> <span class="error_message"><?php echo $err_playName; ?></span>
		</li>
<!-- section -->
		<li>
			<div class="label-block"> <label for="cmbSection">Section</label> </div>
			<div class="input-box"><select name="cmbSection" data-rule-required="true" id="cmbSection">
			<option value="" disabled selected>-- Select Section --</option>
			<?php while($row_selectSection = $result_selectSection->fetch_array()){ ?>
				<option value="<?php echo $row_selectSection['section_id']; ?>" <?php if($row_selectPlaylist['section_id'] == $row_selectSection['section_id']){ echo "selected";} ?>><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?></select>
		</li>
<!-- category -->
		<li>
			<div class="label-block"> <label for="cmbCategory">Category</label> </div>
			<div class="input-box"><select name="cmbCategory" data-rule-required="true" id="cmbCategory">
			<option value="" disabled selected>-- Select Category --</option>
			<?php while($row_selectCategory = $result_selectCategory->fetch_array()){ ?>
				<option value="<?php echo $row_selectCategory['category_id']; ?>" <?php if($row_selectPlaylist['category_id'] == $row_selectCategory['category_id']){ echo "selected";} ?>><?php echo $row_selectCategory['category_name']; ?></option>
			<?php } ?>
                </select>
		</li>
<!-- featured -->
		<li>
			<div class="label-block"> <label for="featured">Featured</label> </div>
			<div class="input-box"><select name="featured" data-rule-required="true" id="featured">
			<option value="0" <?php if($row_selectPlaylist['featured'] == 0) {echo "selected";} ?>> No </option>
			<option value="1" <?php if($row_selectPlaylist['featured'] == 1) {echo "selected";} ?>> Yes </option>
		</select></div>
		</li>
<!-- image
		<li>
			<div class="label-block"> <label for="image">Image</label> </div>
			<div class="input-box"><input type="file" name="image" id="image" /> </div> <span class="error_message"><?php echo $err_image; ?></span>
		</li> -->
<!-- playlist desc -->
		<li>
			<div class="label-block"> <label for="playDesc">Description</label> </div>
			<div class="input-box"><textarea name="txtPlayDesc" id="playDesc" rows="5" placeholder="Description of Playlist"><?php echo $row_selectPlaylist['playlist_desc'] ?></textarea> </div>
		</li>
<!-- meta title -->
		<li>
			<div class="label-block"> <label for="metaTitle">Meta Title</label> </div>
			<div class="input-box"><textarea name="txtMetaTitle" id="metaTitle" rows="5" placeholder="Meta Title"><?php echo $row_selectPlaylist['meta_title'] ?></textarea> </div>
		</li>
<!-- meta desc -->
		<li>
			<div class="label-block"> <label for="metaDesc">Meta Description</label> </div>
			<div class="input-box"><textarea name="txtMetaDesc" id="metaTitle" rows="5" placeholder="Meta Description"><?php echo $row_selectPlaylist['meta_desc'] ?></textarea> </div>
		</li>
<!-- meta keyword -->
		<li>
			<div class="label-block"> <label for="metaKey">Meta Keywords</label> </div>
			<div class="input-box"><textarea name="txtMetaKey" id="metaKey" rows="5" placeholder="Meta Keywords"><?php echo $row_selectPlaylist['meta_keyword'] ?></textarea> </div>
		</li>
<!-- submit -->
		<li>
			<input type="submit" value="Update Playlist" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
		</li>
	</ul>
	</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>