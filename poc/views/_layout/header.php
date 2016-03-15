<?php
	$_absolute_path = "/Lapinouss/poc/";
	
	function getAbsolutePath($resource) {
		global $_absolute_path;
		
		return $_absolute_path
				. $resource; 
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Viens t'amuser avec Lapinouss !</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link href="<?php echo getAbsolutePath("styles/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo getAbsolutePath("styles/style.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900" rel="stylesheet" type="text/css">
		<link href="<?php echo getAbsolutePath("resources/fonts/css/font-awesome.min.css"); ?>" rel="stylesheet">
		<link href="<?php echo getAbsolutePath("styles/animate.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo getAbsolutePath("resources/images/logo/favicon.ico"); ?>" rel="shortcut icon">
	</head>

	<body>
		<div class="header-home">
			<div class="fixed-header">
				<div class="logo wow bounceInDown" data-wow-delay="0.4s">
					<a>
						<span class="secondary">Viens t'amuser avec</span>
						<span class="main">
							<img src="<?php echo getAbsolutePath("resources/images/logo/bunnyEgg_small.png"); ?>" height="80" width="80">
							
							Lapinouss
						</span>
					</a>
				</div>
				<div class="top-nav wow bounce" data-wow-delay="0.4s">
					<span class="menu"> </span>
					<ul>
						<li class="active"><a href="<?php echo getAbsolutePath("views"); ?>">Accueil</a></li>
						<li><a href="<?php echo getAbsolutePath("views/store"); ?>">Store</a></li>
						<li><a href="<?php echo getAbsolutePath("views/tutorials"); ?>">Tutoriels</a></li>
						<li><a href="<?php echo getAbsolutePath("views/account/signin.php"); ?>">Mon compte</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>