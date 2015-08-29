<?php
	require('../includes/config.php');
	$query_selectVideos = "SELECT *
							FROM videos
							INNER JOIN playlist ON playlist.playlist_id=videos.playlist_id
							INNER JOIN channel ON channel.channel_id=videos.channel_id";
	$result_selectVideos = $con->query($query_selectVideos);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
				$chkId = $_POST['chkId'];
				$query_deleteVideos = $con->prepare("DELETE FROM videos WHERE video_id = ?");
				$query_deleteVideos->bind_param('i',$id);
				foreach($chkId as $id) {
					$result_deleteVideos = $query_deleteVideos->execute();
				}
				if(!$result_deleteVideos) {
					echo "<script> alert(\"Can not delete a Video because it is assigned to another table\"); </script>";
					header('Refresh:0');
				}
				else {
					$query_deleteVideos->close();
					echo "<script> alert(\"Video(s) Deleted Successfully\"); </script>";
					header('Refresh:0');
				}
			}
			else {
				echo "<script> alert(\"Please select atleast one video to Delete\"); </script>";
				header('Refresh:0');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> View Videos </title>
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
		<h1>View Videos</h1>
		<?php if($result_selectVideos->num_rows > 0){ ?>
		<form action="" method="POST" class="form" id="formDelete">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> Sr. No </th>
				<th> Video Title </th>
				<th> Playlist </th>
				<th> Channel </th>
				<th> Featured </th>
				<th> Language </th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectVideos = $result_selectVideos->fetch_array()){ ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectVideos['video_id']; ?>" /> </td>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectVideos['video_name']; ?> </td>
				<td> <?php echo $row_selectVideos['playlist_name']; ?> </td>
				<td> <?php echo $row_selectVideos['channel_name']; ?> </td>
				<td> <?php if($row_selectVideos['featured'] == 0) { echo "No"; } else { echo "Yes"; } ?> </td>
				<td> <?php echo $row_selectVideos['language']; ?> </td>
				<td> <a href="edit_video.php?id=<?php echo $row_selectVideos['video_id']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="button" value="Delete" class="submit_button" onclick="clicked();"/>
		</form>
		<?php } else { echo "<h2>No Videos found</h2>"; } ?>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>