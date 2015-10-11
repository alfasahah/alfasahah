<?php
	include("includes/config.php");
	if(isset($_GET['video']) && isset($_GET['playlist'])) {
		$video_id = $_GET['video'];
		$playlist_id = $_GET['playlist'];
		$query_selectVideo = "SELECT * FROM videos WHERE video_id=$video_id AND playlist_id=$playlist_id";
		$result_selectVideo = $con->query($query_selectVideo);
		$row_selectVideo = $result_selectVideo->fetch_array();
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
				<div class="video_title">
					<h3><?php echo $row_selectVideo['video_name']; ?></h3>
				</div>
				<iframe width="640" height="360" src="https://www.youtube.com/embed/<?php echo $row_selectVideo['embed_code']; ?>?&amp;showinfo=0" frameborder="0" allowfullscreen class="iframe_tag"></iframe>
				<div class="row nav_video_row">
					<?php
						$query_selectPrevious = "SELECT * FROM videos WHERE playlist_id=$playlist_id AND video_id<$video_id ORDER BY video_id LIMIT 1";
						$result_selectPrevious = $con->query($query_selectPrevious);
						$row_selectPrevious = $result_selectPrevious->fetch_array();
					?>
					<div class="col-md-6 col-sm-6">
						<div class="thumb_wrapper">
							<a href="#">
							<img class="img-responsive img-portfolio img-hover" src="https://i.ytimg.com/vi/<?php echo $row_selectPrevious['embed_code']; ?>/default.jpg" alt="">
							<h5><?php echo $row_selectPrevious['video_name']; ?></h5>
							</a>
						</div>
					</div>
					<?php
						$query_selectNext = "SELECT * FROM videos WHERE playlist_id=$playlist_id AND video_id>$video_id ORDER BY video_id DESC LIMIT 1";
						$result_selectNext = $con->query($query_selectNext);
						$row_selectNext = $result_selectNext->fetch_array();
					?>
					<div class="col-md-6 col-sm-6">
						<div class="thumb_wrapper">
							<a href="#">
							<img class="img-responsive img-portfolio img-hover" src="https://i.ytimg.com/vi/<?php echo $row_selectNext['embed_code']; ?>/default.jpg" alt="">
							<h5><?php echo $row_selectNext['video_name']; ?></h5>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("includes/footer_main.inc.php"); ?>
</body>
</html>