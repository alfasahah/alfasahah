<?php
require('../includes/config.php');
?>

<?php	
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
	<form action="add_playlist_a.php" method="POST" enctype="multipart/form-data" >
<!-- playlist name -->
		<div><label>Playlist Name</label>
		<input type="text" name="playlist_name" >
		</div>
<!-- section -->
		<div><label>Section</label>
		<select name="section" data-rule-required="true" >
			<option value=""> -- Select Section -- </option>
			<?php while($row_s = mysqli_fetch_array($result_s)){ ?>
			<option value="<?php echo $row_s['section_id']; ?>"><?php echo $row_s['section_name']; ?></option>
			<?php } ?>
		</select>
		</div>
<!-- category -->
		<div><label>Category</label>
		<select name="category" data-rule-required="true" >
			<option value=""> -- Select Category -- </option>
			<?php while($row_c = mysqli_fetch_array($result_c)){// if($row_c['section_id']==$sec_id){?>
			<option value="<?php echo $row_c['category_id']; ?>"><?php echo $row_c['category_name']; ?></option>
			<?php }//} ?>  
		</select>
		</div>
<!-- featured -->
		<div><label>Featured</label>
		<select name="featured" data-rule-required="true" >
			<option value="0"> No </option>
			<option value="1"> Yes </option>
		</select>
		</div>
<!-- image -->
		<div><label>Image</label>
			<input type="file" name="image" id="image" >
		</div>
<!-- playlist desc -->
		<div><label>playlist desc</label>
			<textarea name="playlist_desc" id="elm1" rows="5" ></textarea>
		</div>
<!-- meta title -->
		<div><label>meta title</label>
			<textarea name="meta_title" id="elm1" rows="5" ></textarea>
		</div>
<!-- meta desc -->
		<div><label>meta desc</label>
			<textarea name="meta_desc" id="elm1" rows="5" ></textarea>
		</div>
<!-- meta keyword -->
		<div><label>meta keyword</label>
			<textarea name="meta_keyword" id="elm1" rows="5" ></textarea>
		</div>
<!-- submit -->
		<div>
		<input type="submit" value="Submit">
		</div>
	</form>	
</body>
</html>