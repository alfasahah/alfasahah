<?php
require('../includes/config.php');
?>


<?php
	$sql = "SELECT category.category_name,category.category_id,section.section_name,section.section_id FROM category,section WHERE section.section_id=category.section_id";
	$result = mysqli_query($con,$sql);
?>
<body>
					<table border="1">
						<tr>
						<th> Sr. No. </th>
						<th> Section </th>
						<th> Category </th>
						<th> Edit </th>
						<th> Delete </th>
						</tr>
						<?php $i=1; while($row = mysqli_fetch_array($result)){ ?>						
						<tr>
						<td> <?php echo $i; ?> </td>
						<td> <?php echo $row['section_name']; ?> </td>
						<td> <?php echo $row['category_name']; ?> </td>
						<td> <a href="edit_category.php?id=<?php echo $row['category_id']; ?>"> edit </a> </td>
						<td> <a href="delete_category.php?id=<?php echo $row['category_id']; ?>"> delete </a> </td>
						<?php $i++; } ?>
						</tr>	
					</table>	
				


	
	
</body>	











