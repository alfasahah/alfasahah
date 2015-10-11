<?php
	include("includes/config.php");
	if(isset($_GET['playlist'])) {
		$playlist_id = $_GET['playlist'];
		$query_selectPlaylist = "SELECT playlist_name,playlist_image,playlist_desc FROM playlist WHERE playlist_id=$playlist_id";
		$result_selectPlaylist = $con->query($query_selectPlaylist);
		$row_selectPlaylist = $result_selectPlaylist->fetch_array();
		$query_selectVideos = "SELECT * FROM videos,channel WHERE playlist_id=$playlist_id AND channel.channel_id=videos.channel_id";
		$result_selectVideos = $con->query($query_selectVideos);
	}
	else {
		echo "The link you are trying to access is broken.<br/>Try <a href=\"www.alfasahah.com/video_home?type=movies\">Alfasahah Movies</a>  OR  <a href=\"www.alfasahah.com/video_home?type=documentaries\">Alfasahah Documentaries</a>";
		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
		<title> Alfasahah Home </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
	<script src="bootstrap-3.3.4-dist/js/jquery.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="main_style.css">
</head>
<body>
	<!-- Header Image & Navigation Bar -->
	<?php include("includes/header_nav.inc.php"); ?>

	<!-- Main & Sidebar Container -->
	<div class="container content_wrapper">
		<div class="row">
			
			<!-- Sidebar -->
			<?php include("includes/sidebar_playlist.inc.php"); ?>

			<!-- Main Content -->
			<div class="col-md-9 col-sm-9">
				<div class="row playlist_cover_wrapper">
					<div class="col-md-4">
						<img class="img-responsive img-portfolio img-hover img_playlist_cover" src="images/images_playlist/<?php echo $row_selectPlaylist['playlist_image']; ?>" alt="Playlist_Cover_Photo">
					</div>
					<div class="col-md-8">
						<h3> <?php echo $row_selectPlaylist['playlist_name']; ?> </h3>
						<p> <?php echo $row_selectPlaylist['playlist_desc']; ?> </p>
					</div>
				</div>
				<?php while($row_selectVideos = $result_selectVideos->fetch_array()) { ?>
				<div class="row playlist_list">
					<a href="video_play.php?playlist=<?php echo $playlist_id; ?>&video=<?php echo $row_selectVideos['video_id']; ?>">
					<div class="col-md-3">
						<img class="img-responsive img-portfolio img-hover playlist_thumb" src="https://i.ytimg.com/vi/<?php echo $row_selectVideos['embed_code']; ?>/default.jpg" alt="Playlist_Cover_Photo">
					</div>
					<div class="col-md-9">
						<h5 style="border:none; padding:0px;"> <?php echo $row_selectVideos['video_name']; ?> </h5></a> <h5><small> <?php echo $row_selectVideos['channel_name']; ?> </small></h5>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("includes/footer_main.inc.php"); ?>
</body>
</html>