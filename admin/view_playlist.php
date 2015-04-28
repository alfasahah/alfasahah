<?php
require('../includes/config.php');

//include('../includes/access.php');

?>


<?php
//	$sql = "SELECT category.category_name,category.category_id,section.section_name,section.section_id FROM category,section WHERE section.section_id=category.section_id";
	$sql = "SELECT playlist.playlist_id,playlist.playlist_name,category.category_id,category.category_name,section.section_id,section.section_name FROM playlist,category,section WHERE section.section_id=playlist.section_id AND category.category_id=playlist.category_id";
	$result = mysqli_query($con,$sql);
?>

					<table border="1">
						<tr>
							<th> Sr. No. </th>
							<th> Section </th>
							<th> Category </th>
							<th> Playlist </th>
							<th> Edit </th>
							<th> Delete </th>
						</tr>
						<?php $i=1; while($row = mysqli_fetch_array($result)){ ?>
						
						<tr>
							<td> <?php echo $i; ?> </td>
							<td> <?php echo $row['section_name']; ?> </td>
							<td> <?php echo $row['category_name']; ?> </td>
							<td> <?php echo $row['playlist_name']; ?> </td>
							<td> <a href="edit_playlist.php?id=<?php echo $row['playlist_id']; ?>"> edit </a> </td>
							<td> <a href="delete_playlist.php?id=<?php echo $row['playlist_id']; ?>"> delete </a> </td>
							<?php $i++; } ?>
						</tr>	
					</table>	

</body>	











