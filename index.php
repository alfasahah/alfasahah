<?php
	include('includes/config.php');
	$query_selectLatest = "SELECT playlist_id,playlist_image FROM playlist Group By playlist_id DESC Limit 5";
	$result_selectLatest = $con->query($query_selectLatest);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Al-Fasahah</title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
	<link rel="stylesheet" href="styles.css">

	
	
	<style>
  
  
  </style>
		
	</head>


<body>

<header class="container-fluid">
	<a href="#"><img src="new_title.png" class="img-responsive"></a>
	</header>
	
	<div class="container-fluid">
		<div class="row">
			<div class="">
				
			
				<nav class="navbar navbar-inverse " role="navigation">
					<div class="container">		
						
						<!--Navigation Bar Header-->
						
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-target="#mainNavbar" data-toggle="collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span></button>
								<a href="#" class="navbar-brand" style="color:white">Al-Fasahah</a>
									<!--<p>An Exploring Truth</p>-->			
						</div>
						
							<!--Main navigation-->
						
						<div class="collapse navbar-collapse" id="mainNavbar">
							<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="#" style="color:white">Home</a></li>
							<li><a href="#" style="color:white">Movies</a></lgi>				
							<li><a href="#" style="color:white">Documentaries</a></li>				
							<li><a href="#" style="color:white">Lectures</a></li>				
							<li><a href="#" style="color:white">Kids</a></li>				
							<li><a href="#" style="color:white">Audio Books</a></li>				
							<li><a href="#" style="color:white">Gallery</a></li>				
							<li><a href="#" style="color:white">Contact</a></li>				
							</ul>
							<!--<ul class="nav navbar-nav navbar-right">
							<li><a href="#"><span class="glyphicon glyphicon-log-in pull-right"> Login </span></a></li>
							</ul>-->
						</div>
					</div>		
				</nav>
			
			</div>			
		</div>
	</div>
		<header id="myslider" class="carousel slide" data-ride="carousel"> 
		<ol class="carousel-indicators">
			<li data-target="#myslider" data-slide-to="0" class="active"></li>
			<li data-target="#myslider" data-slide-to="1"></li>
			<li data-target="#myslider" data-slide-to="2"></li>
			<li data-target="#myslider" data-slide-to="3"></li>
			<li data-target="#myslider" data-slide-to="4"></li>
		</ol>
		
		<div class="carousel-inner">
			<div class="item active">
				<a href="#"><img src="1.jpg" class="img-hover"></a>
				<!--<div class="carousel-caption"></div>-->
			</div>
			<div class="item">
				<a href="#"><img src="2.jpg" class="img-hover"></a>
				<!--<div class="carousel-caption"></div>-->
			</div>
			<div class="item">
				<a href="#"><img src="3.jpg" class="img-hover"></a>
				<!--<div class="carousel-caption"></div>-->
			</div>
			<div class="item">
				<a href="#"><img src="4.jpg" class="img-hover"></a>
				<!--<div class="carousel-caption"></div>-->
			</div>
			<div class="item">
				<a href="#"><img src="5.jpg" class="img-hover"></a>
				<!--<div class="carousel-caption"></div>-->
			</div>
		</div>
		
		
		<a class="carousel-control left" href="#myslider" data-slide="prev">
			<span class="glyphicon glyphicon-menu-left"></span>
		</a>
		<a class="carousel-control right" href="#myslider" data-slide="next">
			<span class="glyphicon glyphicon-menu-right"></span>
		</a>
		
</header><br>
	
<div class="container">			
		<div class="row">
			<div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Latest News</h4>
                    </div>
                    <div class="panel-body">
                        <ol>
							<li><a href="#">Breaking News 1</a></li>							
							<li><a href="#">Breaking News 2</a></li>							
							<li><a href="#">Breaking News 3</a></li>							
							<li><a href="#">Breaking News 4</a></li>							
							<li><a href="#">Breaking News 5</a></li>
						</ol>					
					</div>
                </div>
				<!--<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Usefull Links</h4>
                    </div>
                    <div class="panel-body">
                        <ul>
							<li><a href="#">Islamic Mobility</a></li>							
							<li><a href="#">Shiatv</a></li>							
							<li><a href="#">Duas.org</a></li>							
							<li><a href="#">Al-Islam</a></li>							
							<li><a href="#">Islami Markaz</a></li>
						</ul>						
                    </div>
                </div>-->  		
				
			
			</div>
			
			<div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i href=" #" class="fa fa-fw fa-check"></i> Latest Videos</h4>
                    </div>
                    <div class="panel-body" >
						
						<?php
							while($row_selectLatest = $result_selectLatest->fetch_array()) { ?>
								<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="#">
								<img class="img-responsive img-portfolio img-hover" src="images/images_playlist/<?php echo $row_selectLatest['playlist_image']; ?>" alt="">
								</a>
								</div>	
						<?php }
						?>
							
						
					</div>
                </div>							
			</div>
			
		</div>
</div>

<div class="container">		
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Usefull Links</h4>
                    </div>
                    <div class="panel-body">
                        <ul>
							<li><a href="#">Islamic Mobility</a></li>							
							<li><a href="#">Shiatv</a></li>							
							<li><a href="#">Duas.org</a></li>							
							<li><a href="#">Al-Islam</a></li>							
							<li><a href="#">Islami Markaz</a></li>
						</ul>						
                    </div>
                </div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 style="font-family:myriad pro">Featured Videos</h4>
					</div>
					<div class="panel-body">
						
						<div class="col-md-3 col-sm-6">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/r9uWCPpC4po"></iframe>
							</div>
						</div>	
						<div class="col-md-3 col-sm-6">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/r9uWCPpC4po"></iframe>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/r9uWCPpC4po"></iframe>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/r9uWCPpC4po"></iframe>
							</div>
						</div>	
					</div>
				</div>
			</div>				
		</div>
</div>	
<footer style="background-color:#2E2E2E">
	<div class="container">
		<p style="text-align:center" class="text-primary"><a href="Al-fasahah-home.html" class="text-success"><br>Al-Fasahah Oragnization</a><i> is founded to provide a source of education to facilitate understanding studying, sharing and preserving all relevant media, cultural material,
                    		  literature, speeches, discussions, debates, & talks. We aim to promote education and understanding of the Truth.
                                             </i></p>   <p style="text-align:center" class="text-danger">Copyright © 2013 alfasahah.com. All rights reserved.</p>
	</div>
</footer>
	
</body>
</html>
















