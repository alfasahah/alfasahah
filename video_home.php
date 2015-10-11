<?php
	include("includes/config.php");
	if(isset($_GET['type'])) {
		if($_GET['type'] == "movies" || $_GET['type'] == "documentaries") {
			$type = $_GET['type'];
		}
		else {
			echo "The link you are trying to access is broken.<br/>Try <a href=\"www.alfasahah.com/video_home?type=movies\">Alfasahah Movies</a>  OR  <a href=\"www.alfasahah.com/video_home?type=documentaries\">Alfasahah Documentaries</a>";
			die();
		}
	}
	else {
		echo "The link you are trying to access is broken.<br/>Try <a href=\"www.alfasahah.com/video_home?type=movies\">Alfasahah Movies</a>  OR  <a href=\"www.alfasahah.com/video_home?type=documentaries\">Alfasahah Documentaries</a>";
		die();
	}
	if($type == "movies") {
		$query_selectPlaylist = "SELECT playlist_id,playlist_name,playlist_image,playlist_desc FROM playlist WHERE section_id=2";
		$result_selectPlaylist = $con->query($query_selectPlaylist);
	}
	else if($type == "documentaries") {
		$query_selectPlaylist = "SELECT playlist_id,playlist_name,playlist_image,playlist_desc FROM playlist WHERE section_id=1";
		$result_selectPlaylist = $con->query($query_selectPlaylist);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if($type == "movies") {
				echo "Alfasahah Movies";
			}
			else if($type == "documentaries") {
				echo " Alfasahah Documentaries";
			}
		?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
	<script src="bootstrap-3.3.4-dist/js/jquery.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="main_style.css">
</head>
<body>
	<?php include('includes/body_top.inc.php'); ?> <!-- body_top.inc.php file contains script to be added in the starting part of <body> tag. -->
	<!-- Header Image & Navigation Bar -->
	<?php include("includes/header_nav.inc.php"); ?>

	<!-- Main & Sidebar Container -->
	<div class="container content_wrapper">
		<div class="row">
			
			<!-- Sidebar -->
			<?php include("includes/sidebar_playlist.inc.php"); ?>

			<!-- Main Content -->
			<div class="col-md-9 col-sm-9">
				<div class="video_title">
					<h3>
					<?php
						if($type == "movies") {
							echo "Islamic Movies";
						}
						else if($type == "documentaries") {
							echo "Documentaries";
						}
					?>
					</h3>
				</div>
				<div class="row playlist_icons">
					<?php
						while($row_selectPlaylist = $result_selectPlaylist->fetch_array()) { ?>
					<div class="col-md-6">
						<div class="row icon_wrapper">
						<a href="video_playlist.php?playlist=<?php echo $row_selectPlaylist['playlist_id']; ?>">
						<div class="col-md-7">
							<img class="img-responsive img-portfolio img-hover img_playlist_cover" src="images/thumb_playlist/<?php echo $row_selectPlaylist['playlist_image']; ?>" alt="Playlist_Cover_Photo">
						</div>
						<div class="col-md-5">
							<h3> <?php echo $row_selectPlaylist['playlist_name']; ?> </h3> </a>
							<p> <span title="<?php echo $row_selectPlaylist['playlist_desc']; ?>"><?php echo substr($row_selectPlaylist['playlist_desc'], 0, 140)."..."; ?></span> </p>
						</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("includes/footer_main.inc.php"); ?>
</body>
</html>