<?php
require('../includes/config.php');

$edit_id=$_GET['id'];

?>

<?php	
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
		
		$sql="UPDATE playlist SET playlist_name='$playlist_name',section_id='$sec_id',category_id='$cat_id',featured='$featured',playlist_image='$image_name',playlist_desc='$playlist_desc',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE playlist_id=$edit_id";
		if($con->query($sql)===TRUE) {
			echo "New playlist added successfully";
		}
		else {
			echo "Query Fail.";
		}
	}
	$con->close();	
?>