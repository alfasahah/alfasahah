<?php
require('../includes/config.php');

$edit_id=$_GET['id'];

?>

<?php
		
//		$sql = "SELECT playlist.playlist_name,category.category_id,category.category_name,section.section_id,section.section_name FROM playlist,category,section WHERE section.section_id=playlist.section_id AND category.category_id=playlist.category_id AND playlist_id=$edit_id";

//		$sql = "SELECT section.section_id,category.category_id,playlist.* FROM playlist,category,section WHERE section.section_id=playlist.section_id AND category.category_id=playlist.category_id AND playlist_id=$edit_id";

		$sql = "SELECT * FROM playlist WHERE playlist_id=$edit_id";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		$sql_s = "SELECT section_id, section_name FROM section";
		$result_s = mysqli_query($con,$sql_s);
		
		$sql_c = "SELECT category_id, category_name FROM category";
		$result_c = mysqli_query($con,$sql_c);

	?>

<!doctype html>
<html>
<head>
</head>
<body>
	<form  action="edit_playlist_a.php" method="POST" >
<!-- playlist name -->
		<div><label>Playlist Name</label>
		<input type="text" name="playlist_name" value="<?php echo $row['playlist_name']; ?>">
		</div>
<!-- section -->
		<div><label>Section</label>
		<select name="section" data-rule-required="true" >
			<?php	$sec_id = $row['section_id']; ?>
			<?php while($row_s = mysqli_fetch_array($result_s)){ ?>
			<option <?php if($sec_id == $row_s['section_id']) {  ?> selected <?php } ?> value="<?php echo $row_s['section_id']; ?>"><?php echo $row_s['section_name']; ?></option>
			<?php } ?>
		</select>
		</div>
<!-- category -->
		<div><label>Category</label>
		<select name="category" data-rule-required="true" >
			<?php	$cat_id = $row['category_id']; ?>
			<?php while($row_c = mysqli_fetch_array($result_c)){ //if($row_c['section_id']==$sec_id){?>
			<option <?php if($cat_id == $row_c['category_id']) {  ?> selected <?php } ?> value="<?php echo $row_c['category_id']; ?>"><?php echo $row_c['category_name']; ?></option>
			<?php }//} ?>  
		</select>
		</div>
<!-- featured -->
		<div><label>Featured</label>
		<select name="featured" data-rule-required="true" >
			<?php	$featured = $row['featured']; ?>
			<option <?php if($featured == 0) {  ?> selected <?php } ?> value="0"> No </option>
			<option <?php if($featured == 1) {  ?> selected <?php } ?> value="1"> Yes </option>
		</select>
		</div>
<!-- image -->
		<div><label>Image</label>
			<input type="file" name="image" id="image" >
		</div>
<!-- playlist desc -->
		<div><label>playlist desc</label>
			<textarea name="playlist_desc" id="elm1" rows="5" > <?php echo $row['playlist_desc']; ?> </textarea>
		</div>
<!-- meta title -->
		<div><label>meta title</label>
			<textarea name="meta_title" id="elm1" rows="5" > <?php echo $row['meta_title']; ?> </textarea>
		</div>
<!-- meta desc -->
		<div><label>meta desc</label>
			<textarea name="meta_desc" id="elm1" rows="5" > <?php echo $row['meta_desc']; ?> </textarea>
		</div>
<!-- meta keyword -->
		<div><label>meta keyword</label>
			<textarea name="meta_keyword" id="elm1" rows="5" > <?php echo $row['meta_keyword']; ?> </textarea>
		</div>
<!-- submit -->
		<div>
		<input type="submit" value="Submit">
		</div>
	</form>	
</body>
</html>