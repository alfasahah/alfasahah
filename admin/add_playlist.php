<?php
require('../includes/config.php');
?>

<?php	
	$query_selectSection = "SELECT section_id, section_name FROM section";
	$result_selectSection = $con->query($query_selectSection);
	$query_selectCategory = "SELECT category_id, category_name FROM category";
	$result_selectCategory = $con->query($query_selectCategory);
	$holder_playName = $holder_section = $holder_category = $holder_playDesc = $holder_metaTitle = $holder_metaDesc = $holder_metaKey = "";
	$err_playName = $err_section = $err_category = $err_image = $gen_error = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$play_name = $section = $category = $featured = $image_path = $play_desc = $meta_title = $meta_desc = $meta_key = '';
		if(!empty($_POST['txtPlayName'])) {
			$play_name = $_POST['txtPlayName'];
			$holder_playName = $_POST['txtPlayName'];
		}
		else {
			$err_playName = "* required";
		}
		if(isset($_POST['cmbSection'])) {
			$section = $_POST['cmbSection'];
			$holder_section = $_POST['cmbSection'];
		}
		else {
			$err_section = "* required";
		}
		if(isset($_POST['cmbCategory'])) {
			$category = $_POST['cmbCategory'];
			$holder_category = $_POST['cmbCategory'];
		}
		else {
			$err_category = "* required";
		}
		$featured = $_POST['featured'];
		$play_desc = $_POST['txtPlayDesc'];
		$holder_playDesc = $_POST['txtPlayDesc'];
		$meta_title = $_POST['txtMetaTitle'];
		$holder_metaTitle = $_POST['txtMetaTitle'];
		$meta_desc = $_POST['txtMetaDesc'];
		$holder_metaDesc = $_POST['txtMetaDesc'];
		$meta_key = $_POST['txtMetaKey'];
		$holder_metaKey = $_POST['txtMetaKey'];
		if(empty($_FILES["image"]["name"])) {
			$err_image = "* required";
		}
		if(empty($_FILES["image"]["name"]) || $play_name=="" || $section=="" || $category==""){
			$gen_error = "Playlist Name, Section, Category and Image are compulsory";
		}
		else {
			//------------ Image Handling Code --------------//
		
		$target_dir = "../images/images_playlist/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$new_image_name = $target_dir . $play_name.'_'.$section.'_'.$category . '.' . pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["image"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_name)) {
				//echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		
		$image_name=$play_name.'_'.$section.'_'.$category . "." .pathinfo($target_file,PATHINFO_EXTENSION);
		$sql="INSERT INTO playlist (playlist_name,section_id,category_id,featured,playlist_image,playlist_desc,meta_title,meta_desc,meta_keyword) VALUES ('$play_name','$section','$category','$featured','$image_name','$play_desc','$meta_title','$meta_desc','$meta_key')";
		if($con->query($sql)===TRUE) {
			echo "<script> alert(\"Playlist Added Successfully\"); </script>";
			header('Refresh:0');
			$from_name = $play_name.'_'.$section.'_'.$category . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
			$to_name = $play_name.'_'.$section.'_'.$category . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
			// save to file (true) or output to browser (false)
			$save_to_file = true;
			// Quality for JPEG and PNG.
			// 0 (worst quality, smaller file) to 100 (best quality, bigger file)
			// Note: PNG quality is only supported starting PHP 5.1.2
			$image_quality = 100;
			// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
			// enter code of the image type if you want override it
			// or set it to -1 to determine automatically
			$image_type = -1;
			// maximum thumb side size
			$max_x = 224;
			$max_y = 126;
			// cut image before resizing. Set to 0 to skip this.
			$cut_x = 0;
			$cut_y = 0;
			// Folder where source images are stored (thumbnails will be generated from these images).
			// MUST end with slash.
			$images_folder = '../images/images_playlist/';
			// Folder to save thumbnails, full path from the root folder, MUST end with slash.
			// Only needed if you save generated thumbnails on the server.
			// Sample for windows:     c:/wwwroot/thumbs/
			// Sample for unix/linux:  /home/site.com/htdocs/thumbs/
			$thumbs_folder = '../images/thumb_playlist/';
			
			// include image processing code
			include('thumb_generator/image.class.php');
			$img = new Zubrag_image;

			// initialize
			$img->max_x        = $max_x;
			$img->max_y        = $max_y;
			$img->cut_x        = $cut_x;
			$img->cut_y        = $cut_y;
			$img->quality      = $image_quality;
			$img->save_to_file = $save_to_file;
			$img->image_type   = $image_type;

			// generate thumbnail
			$img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);
			}
			else {
				echo "Query Fail.";
			}
			
				
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			
			//------------ Image Handling Code --------------//
		}
	}
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
				<option value="<?php echo $row_selectSection['section_id']; ?>" <?php if($holder_section == $row_selectSection['section_id']){ echo "selected";} ?>><?php echo $row_selectSection['section_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_section; ?></span>
		</li>
<!-- category -->
		<li>
			<div class="label-block"> <label for="cmbCategory">Category</label> </div>
			<div class="input-box"><select name="cmbCategory" data-rule-required="true" id="cmbCategory">
			<option value="" disabled selected>-- Select Category --</option>
			<?php while($row_selectCategory = $result_selectCategory->fetch_array()){ ?>
				<option value="<?php echo $row_selectCategory['category_id']; ?>" <?php if($holder_category == $row_selectCategory['category_id']){ echo "selected";} ?>><?php echo $row_selectCategory['category_name']; ?></option>
			<?php } ?>  
		</select></div> <span class="error_message"><?php echo $err_category; ?></span>
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
			<div class="input-box"><input type="file" name="image" id="image" /> </div> <span class="error_message"><?php echo $err_image; ?></span>
		</li>
<!-- playlist desc -->
		<li>
			<div class="label-block"> <label for="playDesc">Description</label> </div>
			<div class="input-box"><textarea name="txtPlayDesc" id="playDesc" rows="5" placeholder="Description of Playlist"><?php echo $holder_playDesc; ?></textarea> </div>
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
			<input type="submit" value="Add Playlist" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
		</li>
	</ul>
	</form>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>