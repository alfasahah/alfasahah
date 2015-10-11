<?php
	require('../includes/config.php');
	$query_selectDesigner = "SELECT * FROM designer";
	$result_selectDesigner = $con->query($query_selectDesigner);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
				$chkId = $_POST['chkId'];
				$query_deleteDesigner = $con->prepare("DELETE FROM designer WHERE designer_id = ?");
				$query_deleteDesigner->bind_param('i',$id);
				foreach($chkId as $id) {
					$result_deleteDesigner = $query_deleteDesigner->execute();
				}
				if(!$result_deleteDesigner) {
					echo "<script> alert(\"There was some problem deleting Designer\"); </script>";
					header('Refresh:0');
				}
				else {
					$query_deleteDesigner->close();
					echo "<script> alert(\"Designer(s) Deleted Successfully\"); </script>";
					header('Refresh:0');
				}
			}
			else {
				echo "<script> alert(\"Please select atleast one Designer to Delete\"); </script>";
				header('Refresh:0');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> View Designer </title>
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
		<h1>View Designer</h1>
		<?php if($result_selectDesigner->num_rows > 0){ ?>
		<form action="" method="POST" class="form" id="formDelete">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> Image </th>
				<th> Designer Name </th>
				<th> Description </th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectDesigner = $result_selectDesigner->fetch_array()){ ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectDesigner['designer_id']; ?>" id="chk[]" /> </td>
				 <td> <img src="../images/images_designer/<?php echo $row_selectDesigner['designer_image']; ?>" height="50px" width="50px"> </td>
				<td> <?php echo $row_selectDesigner['designer_name']; ?> </td>
				<td> <?php echo $row_selectDesigner['designer_desc']; ?> </td>
				<td> <a href="edit_designer.php?id=<?php echo $row_selectDesigner['designer_id']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="button" value="Delete" class="submit_button" onclick="clicked();"/>
		</form>
		<?php } else { echo "<h2>No Designer found</h2>"; } ?>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>