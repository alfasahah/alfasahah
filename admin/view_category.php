<?php
	require('../includes/config.php');
	$query_selectCategory = "SELECT category.category_name,category.category_id,section.section_name,section.section_id FROM category,section WHERE section.section_id=category.section_id";
	$result_selectCategory = $con->query($query_selectCategory);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['chkId'])) {
				$chkId = $_POST['chkId'];
				$query_deleteCategory = $con->prepare("DELETE FROM category WHERE category_id = ?");
				$query_deleteCategory->bind_param('i',$id);
				foreach($chkId as $id) {
					$result_deleteCategory = $query_deleteCategory->execute();
				}
				if(!$result_deleteCategory) {
					echo "<script> alert(\"Can not delete a category which is assigned to a playlist\"); </script>";
					header('Refresh:0');
				}
				else {
					$query_deleteCategory->close();
					echo "<script> alert(\"Category(s) Deleted Successfully\"); </script>";
					header('Refresh:0');
				}
			}
			else {
				echo "<script> alert(\"Please select atleast one category to Delete\"); </script>";
				header('Refresh:0');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> View Category </title>
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
		<h1>View Category</h1>
		<?php if($result_selectCategory->num_rows > 0){ ?>
		<form action="" method="POST" class="form" id="formDelete">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th> Sr. No </th>
				<th> Section </th>
				<th> Category </th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectCategory = $result_selectCategory->fetch_array()){ ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectCategory['category_id']; ?>" id="chk[]" /> </td>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectCategory['section_name']; ?> </td>
				<td> <?php echo $row_selectCategory['category_name']; ?> </td>
				<td> <a href="edit_category.php?id=<?php echo $row_selectCategory['category_id']; ?>"><img src="../images/edit.png" alt="edit" /></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="button" value="Delete" class="submit_button" onclick="clicked();"/>
		</form>
		<?php } else { echo "<h2>No category found</h2>"; } ?>
	</section>
	<?php
		include("../includes/footer_admin.inc.php");
	?>
</body>
</html>