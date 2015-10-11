<?php
	include("../../includes/config.php");
	$section_id = $_POST['section_id'];
	$query_selectPlaylist = "SELECT playlist_id,playlist_name FROM playlist WHERE section_id='$section_id'";
	$result_selectPlaylist = $con->query($query_selectPlaylist);
	echo '<option value="" disabled selected>-- Select Playlist --</option>';
	while($row_selectPlaylist=$result_selectPlaylist->fetch_array()) {
		echo '<option value="'.$row_selectPlaylist['playlist_id'].'">'.$row_selectPlaylist['playlist_name'].'</option>';
	}
?>