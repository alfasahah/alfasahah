<?php
	include("includes/config.php");
	$query_selectFeatured = "SELECT playlist_id,playlist_name,playlist_image FROM playlist WHERE featured=1 ORDER BY playlist_id DESC LIMIT 4";
	$result_selectFeatured = $con->query($query_selectFeatured);
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
	<?php include('includes/body_top.inc.php'); ?> <!-- body_top.inc.php file contains script to be added in the starting part of <body> tag. -->
	<!-- Header Image & Navigation Bar -->
	<?php include("includes/header_nav.inc.php"); ?>

	<!-- Carousel Slider -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
			<li data-target="#myCarousel" data-slide-to="4"></li>
		</ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="images/slider_images/1.gif" alt="Islamic Movies" class="img-responsive">
			</div>
			<div class="item">
			  <img src="images/slider_images/2.jpg" alt="Documentaries" class="img-responsive">
			</div>
			<div class="item">
			  <img src="images/slider_images/3.jpg" alt="Lectures" class="img-responsive">
			</div>
			<div class="item">
			  <img src="images/slider_images/2.jpg" alt="Audio Books" class="img-responsive">
			</div>
			<div class="item">
			  <img src="images/slider_images/3.jpg" alt="Kids" class="img-responsive">
			</div>
		</div>
		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
	  	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		</a>
	</div>

	<!-- Main & Sidebar Container -->
	<div class="container content_wrapper">
		<div class="row">
			
			<!-- Sidebar -->
			<?php include("includes/sidebar_home.inc.php"); ?>

			<!-- Main Content -->
			<div class="col-md-9 col-sm-9">
				<div class="section-header">
					<h4 class="section-title">Featured Videos</h4>
				</div>
				<div class="section-content">
					<div class="row">
						<?php
							while($row_selectFeatured = $result_selectFeatured->fetch_array()) {
						?>
						<div class="col-md-3 col-sm-6"><a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Penguins.jpg" alt="">
							<h5><?php echo $row_selectFeatured['playlist_name']; ?></h5></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="section-header">
					<h4 class="section-title">Latest Videos</h4>
				</div>
				<div class="section-content">
					<div class="row">
						<div class="col-md-3 col-sm-6"><a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Desert.jpg" alt="">
							<h5>Mukhtar Nama</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Koala.jpg" alt="">
							<h5>Prophet Yousuf (s.a)</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Penguins.jpg" alt="">
							<h5>Muhammad</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Lighthouse.jpg" alt="">
							<h5>Sulaiman</h5></a></div>
					</div>
				</div>
				<div class="section-header">
					<h4 class="section-title">Featured Channels</h4>
				</div>
				<div class="section-content">
					<div class="row">
						<div class="col-md-3 col-sm-6"><a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Penguins.jpg" alt="">
							<h5>Sahar Tv</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Lighthouse.jpg" alt="">
							<h5>Al-Balagh</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Desert.jpg" alt="">
							<h5>Al-Fasahah</h5></a></div>
						<div class="col-md-3 col-sm-6">	<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/check/Koala.jpg" alt="">
							<h5>AhlulBayt Tv</h5></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("includes/footer_main.inc.php"); ?>
</body>
</html>