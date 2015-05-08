<?php
require('../includes/config.php');
?>

<?php
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		
//===================================	
	if(empty($_POST) == false){
		$playlist_name = $_POST['playlist_name'];
		$sec_id = $_POST['section'];
		$cat_id = $_POST['category'];
		$featured = $_POST['featured'];
		
		$image_name=$playlist_name.'_'.$sec_id.'_'.$cat_id;
		
		$playlist_desc = $_POST['playlist_desc'];
		$meta_title = $_POST['meta_title'];
		$meta_desc = $_POST['meta_desc'];
		$meta_keyword = $_POST['meta_keyword'];
		
		$sql="INSERT INTO playlist (playlist_name,section_id,category_id,featured,playlist_image,playlist_desc,meta_title,meta_desc,meta_keyword) VALUES ('$playlist_name','$sec_id','$cat_id','$featured','$image_name','$playlist_desc','$meta_title','$meta_desc','$meta_keyword')";
		if($con->query($sql)===TRUE) {
			echo "New playlist added successfully";
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

