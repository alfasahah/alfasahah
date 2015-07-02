<?php
	require('../includes/config.php');
	$query_selectPlaylist = "SELECT playlist.playlist_id,playlist.playlist_name,category.category_id,category.category_name,section.section_id,section.section_name FROM playlist,category,section WHERE section.section_id=playlist.section_id AND category.category_id=playlist.category_id";
	$result_selectPlaylist = $con->query($query_selectPlaylist);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
				$chkId = $_POST['chkId'];
				$query_deletePlaylist = $con->prepare("DELETE FROM playlist WHERE playlist_id = ?");
				$query_deletePlaylist->bind_param('i',$id);
				foreach($chkId as $id) {
					$result_deletePlaylist = $query_deletePlaylist->execute();
				}
				if(!$result_deletePlaylist) {
					echo "<script> alert(\"Can not delete a playlist because it is assigned to another table\"); </script>";
					header('Refresh:0');
				}
				else {
					$query_deletePlaylist->close();
					echo "<script> alert(\"Playlist(s) Deleted Successfully\"); </script>";
					header('Refresh:0');
				}
			}
			else {
				echo "<script> alert(\"Please select atleast one playlist to Delete\"); </script>";
				header('Refresh:0');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> View Playlist </title>
	<link rel="stylesheet" href="../includes/main_style.css" >
	<script language="JavaScript">
		function toggle(source) {
			checkboxes = document.getElementsByName('chkId[]');
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			}
		}
		function clicked() {
			if(confirm("Do you want to proceed?") == true) {
				document.getElementById("formDelete").submit();
			}
		}
	</script>
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>View Playlist</h1>
		<?php if($result_selectPlaylist->num_rows > 0){ ?>
		<form action="" method="POST" class="form" id="formDelete">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> Sr. No </th>
				<th> Section </th>
				<th> Category </th>
				<th> Playlist </th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectPlaylist = $result_selectPlaylist->fetch_array()){ ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectPlaylist['playlist_id']; ?>" /> </td>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectPlaylist['section_name']; ?> </td>
				<td> <?php echo $row_selectPlaylist['category_name']; ?> </td>
				<td> <?php echo $row_selectPlaylist['playlist_name']; ?> </td>
				<td> <a href="edit_playlist.php?id=<?php echo $row_selectPlaylist['playlist_id']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="button" value="Delete" class="submit_button" onclick="clicked();"/>
		</form>
		<?php } else { echo "<h2>No Playlist found</h2>"; } ?>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>









