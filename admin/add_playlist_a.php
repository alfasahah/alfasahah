<?php
require('../includes/config.php');
	if(empty($_POST) == false){
		$playlist_name = $_POST['playlist_name'];
		$sec_id = $_POST['section'];
		$cat_id = $_POST['category'];
		$featured = $_POST['featured'];
	}
$target_dir = "../images/images_playlist/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$new_image_name = $target_dir . $playlist_name.'_'.$sec_id.'_'.$cat_id . '.' . pathinfo($target_file,PATHINFO_EXTENSION);
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
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		
//===================================	
	if(empty($_POST) == false){
		
		
		$image_name=$playlist_name.'_'.$sec_id.'_'.$cat_id . "." .pathinfo($target_file,PATHINFO_EXTENSION);
		
		$playlist_desc = $_POST['playlist_desc'];
		$meta_title = $_POST['meta_title'];
		$meta_desc = $_POST['meta_desc'];
		$meta_keyword = $_POST['meta_keyword'];
		$sql="INSERT INTO playlist (playlist_name,section_id,category_id,featured,playlist_image,playlist_desc,meta_title,meta_desc,meta_keyword) VALUES ('$playlist_name','$sec_id','$cat_id','$featured','$image_name','$playlist_desc','$meta_title','$meta_desc','$meta_keyword')";
		if($con->query($sql)===TRUE) {
			echo "New playlist added successfully";
			$from_name = $playlist_name.'_'.$sec_id.'_'.$cat_id . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
			$to_name = $playlist_name.'_'.$sec_id.'_'.$cat_id . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
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
	}
	$con->close();	
//=======================================
		
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?> 

