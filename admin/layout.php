<?php
include('../includes/access.php');
require('../includes/config.php');

if ($userType == "Admin" || $userType == "mentor" || $userType == "content-manager" || $userType == "forum-manager") {

?>
    <script type="text/javascript">
        window.open('home.php', '_self');
    </script>
<?php
    exit;
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<script>
		$("document").ready(function(){			
			$(".main_cat").click(function(){
				cat_id = $(this).val();
				if(cat_id){				   
					$.ajax({					  
						type:'post',
						url:'getsectioncat.php',
						dataType:'html',
						data:{cat_id : cat_id},
						success:function(data){						  
							$("#category_type").html(data);						  
						}
					});				   
				}else{				   
					return false;
				}			   
			});			
		});
	</script>
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="js/plugins/flot/jquery.flot.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	<!-- Favicon -->
	<script src="tinymce/tinymce.min.js" type="text/javascript"></script>
	<script>
	tinymce.init({
		selector: "textarea#elm1",
		theme: "modern",
		width: "100%",
		height: 300,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		],
		content_css: "css/content.css",
		theme_advanced_font_sizes: "8px,10px,12px,14px,16px,18px,20px,24px,32px,36px",
		theme_advanced_fonts: "Andale Mono=andale mono,times;" +
			"Arial=arial,helvetica,sans-serif;" +
			"Arial Black=arial black,avant garde;" +
			"Book Antiqua=book antiqua,palatino;" +
			"Comic Sans MS=comic sans ms,sans-serif;" +
			"Courier New=courier new,courier;" +
			"Century Gothic=century_gothic;" +
			"Georgia=georgia,palatino;" +
			"Gill Sans MT=gill_sans_mt;" +
			"Gill Sans MT Bold=gill_sans_mt_bold;" +
			"Gill Sans MT BoldItalic=gill_sans_mt_bold_italic;" +
			"Gill Sans MT Italic=gill_sans_mt_italic;" +
			"Helvetica=helvetica;" +
			"Impact=impact,chicago;" +
			"Iskola Pota=iskoola_pota;" +
			"Iskola Pota Bold=iskoola_pota_bold;" +
			"Symbol=symbol;" +
			"Tahoma=tahoma,arial,helvetica,sans-serif;" +
			"Terminal=terminal,monaco;" +
			"Times New Roman=times new roman,times;" +
			"Trebuchet MS=trebuchet ms,geneva;" +
			"Verdana=verdana,geneva;" +
			"Webdings=webdings;" +
			"Wingdings=wingdings,zapf dingbats",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l ink image | print preview media fullpage | forecolor backcolor emoticons",
		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Font Sizes', items: [
					{title: '10px', inline: 'span', styles: {fontSize: '10px'}},
					{title: '13px', inline: 'span', styles: {fontSize: '13px'}},
					{title: '15px', inline: 'span', styles: {fontSize: '15px'}},
					{title: '18px', inline: 'span', styles: {fontSize: '18px'}},
					{title: '21px', inline: 'span', styles: {fontSize: '21px'}},
					{title: '24px', inline: 'span', styles: {fontSize: '24px'}},
					{title: '27px', inline: 'span', styles: {fontSize: '27px'}},
					{title: '30px', inline: 'span', styles: {fontSize: '30px'}}
				]},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		]
	});
	</script>   
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
</head>

<!---------------- main body ------------------>
<body class="theme-lime" data-theme="theme-lime">
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">Admin Panel</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
<!-- main menu -->
			<?php
			include('admin_menu.php');
			?>
			<div class="user">
				<div class="dropdown asdf">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $_SESSION['user1'] ?> <img src="img/demo/user-avatar.jpg" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="#">Edit profile</a></li>
						<li><a href="logout.php">Sign out</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left">
			<form action="#" method="GET" class='search-form'>
				<div class="search-pane">
					<input type="text" name="search" placeholder="Search here...">
					<button type="submit"><i class="icon-search"></i></button>
				</div>
			</form>
		</div>
		
		<div id="main">
			<?php
			date_default_timezone_set("Asia/Calcutta");
			$dt = date('F d, Y');
			$week = date('l');
			?>
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left"><h1>Dashboard</h1></div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details"><span class="big"><?php echo $dt; ?></span><span><?php echo $week; ?></span></div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="home.php">Home</a><i class="icon-angle-right"></i></li>
						<li><a href="#">Category</a><i class="icon-angle-right"></i></li>
						<li><a href="#">Add Category</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="icon-remove"></i></a></div>
				</div>
<!--------------------- Main content start ----------------------------->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered box-color">
							<div class="box-title"><h3><i class="icon-th-list"></i> Add Category</h3></div>
							<div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'><a href="#engfirst1" data-toggle='tab'><img src="images/en.gif">English</a></li>
									<li><a href="#frfirst2" data-toggle='tab'><img src="images/fr.gif">French</a></li>
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom" style="padding:20px 0 !important">
									<div class="tab-pane active" id="engfirst1">
										<form action="addcategoryaction.php?type=english" enctype="multipart/form-data" method="POST" class='form-horizontal form-bordered form-validate' id="bb">
<!-------------------- Main content is here ----------------------------->                                              
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<!------------------- Main content end -------------------------------->
			</div>
		</div>
	</div>
</body>
</html>

