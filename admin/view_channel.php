<?php
	require('../includes/config.php');
	$query_selectChannel = "SELECT * FROM channel";
	$result_selectChannel = $con->query($query_selectChannel);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
				$chkId = $_POST['chkId'];
				$query_deleteChannel = $con->prepare("DELETE FROM channel WHERE channel_id = ?");
				$query_deleteChannel->bind_param('i',$id);
				foreach($chkId as $id) {
					$result_deleteChannel = $query_deleteChannel->execute();
				}
				if(!$result_deleteChannel) {
					echo "<script> alert(\"There was some problem deleting channel\"); </script>";
					header('Refresh:0');
				}
				else {
					$query_deleteChannel->close();
					echo "<script> alert(\"Channel(s) Deleted Successfully\"); </script>";
					header('Refresh:0');
				}
			}
			else {
				echo "<script> alert(\"Please select atleast one channel to Delete\"); </script>";
				header('Refresh:0');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> View Channel </title>
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
	<style>
	td {
		border-left: 0px none;
		border-right: 0px none;
	}
	</style>
</head>
<body>
	<?php
		include("../includes/header_admin.inc.php");
		include("../includes/nav_admin.inc.php");
		include("../includes/aside_admin.inc.php");
	?>
	<section>
		<h1>View Channel</h1>
		<?php if($result_selectChannel->num_rows > 0){ ?>
		<form action="" method="POST" class="form" id="formDelete">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> Image </th>
				<th> Channel Name </th>
				<th> Description </th>
				<th> Edit </th> 
			</tr>
			<?php $i=1; while($row_selectChannel = $result_selectChannel->fetch_array()){ ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectChannel['channel_id']; ?>" id="chk[]" /> </td>
				<td> <img src="../images/images_channel/<?php echo $row_selectChannel['channel_image']; ?>" height="50px" width="50px"> </td>
				<td> <?php echo $row_selectChannel['channel_name']; ?> </td>
				<td> <?php echo $row_selectChannel['channel_desc']; ?> </td>
				<td> <a href="edit_channel.php?id=<?php echo $row_selectChannel['channel_id']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="button" value="Delete" class="submit_button" onclick="clicked();" style="margin:0px;margin-left:10px;"/>
		</form>
		<?php } else { echo "<h2>No Channel found</h2>"; } ?>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>