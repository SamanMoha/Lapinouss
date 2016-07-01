<!DOCTYPE HTML>
<html>
	<head>
		<title>Viens t'amuser avec Lapinouss !</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="resources/fonts/css/lato.css" rel="stylesheet" type="text/css">
		<link href="resources/fonts/css/font-awesome.min.css" rel="stylesheet">
		<link href="styles/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="styles/jquery-ui.min.css" rel="stylesheet">
		<link href="styles/animate.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		
		<link href="resources/images/logo/favicon.ico" rel="shortcut icon">

		<script src="scripts/jquery-2.2.4.js"></script>
		<script src="scripts/jquery-ui.min.js"></script>
		<script src="scripts/bootstrap.min.js"></script>
		<script src="scripts/wow.min.js"></script>
		<script src="scripts/main.js"></script>
	</head>

	<body>
		<div class="header-home">
			<div class="fixed-header">
				<div class="logo wow bounceInDown" data-wow-delay="0.4s">
					<a>
						<span class="secondary">Viens t'amuser avec</span>
						<span class="main">
							<img src="resources/images/logo/bunnyEgg_small.png" height="80" width="80">
							
							Lapinouss
						</span>
					</a>
				</div>
				<div class="top-nav wow bounce" data-wow-delay="0.4s">
					<span class="menu"> </span>
					<ul>
						<li class="active"><a href="<?php echo action('home'); ?>">Accueil</a></li>
						<li>
							<?php if (isset($_SESSION['user']) && $_SESSION['user'] instanceof ChildAccount) {
								echo '<a href="' . action('game') . '">Mes jeux</a>';
							} else {
								echo '<a href="' . action('game', 'store') . '">Store</a>';
							}
							?>
						</li>
						<?php if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
							echo '<li>';
							echo '<a href="' . action('tutorial') . '">Tutoriels</a>';
							echo '</li>';
						} ?>
						<li>
							<a href="<?php echo action('account'); ?>">
								<?php echo isset($_SESSION['user']) ? 'Mon compte' : 'Connexion'; ?>
							</a>
						</li>
						<?php if (isset($_SESSION['user'])) {
							echo '<li>';
								echo '<a href="' . action('account', 'logout') . '">D&eacute;connexion</a>';
							echo '</li>';
						}
						else {
							echo '<li class="navbar-blink">';
							echo '<a href="' . action('account', 'register') . '">Inscription</a>';
							echo '</li>';
						} ?>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>


		<div class="wow bounceInRight" data-wow-delay="0.1s">
			<div class="box_2">
				<?php
				require_once 'routes.php';
				?>
			</div>
		</div>

		<div class="footer wow fadeInRight" data-wow-delay="0.4s">
			<div class="container">
				<div class="footer_top">
					<div class="col-sm-3">
						<ul class="list1">
							<h3>Menu</h3>
							<li><a href="<?php echo action('home'); ?>">Accueil</a></li>
							<li><a href="<?php echo action('game', 'store'); ?>">Store</a></li>
							<li><a href="<?php echo action('tutorial'); ?>">Tutoriels</a></li>
							<li><a href="<?php echo action('contact'); ?>">Contact</a></li>
						</ul>
					</div>
					
					<div class="col-sm-3">
						<ul class="list1">
							<h3>Th&egrave;mes</h3>
							<li><a href="#">Fran&ccedil;ais</a></li>
							<li><a href="#">Anglais</a></li>
							<li><a href="#">Math&eacute;matiques</a></li>
							<li><a href="#">Logique</a></li>
						</ul>
					</div>
				
					<div class="col-sm-3">
						<ul class="list1">
							<h3>&agrave; propos</h3>
							<li><a href="#">Qui sommes nous ?</a></li>
							<li><a href="#">Recrutement</a></li>
							<li><a href="#">Conditions d'utilisations</a></li>
							<li><a href="<?php echo action('contact'); ?>">Nous contacter</a></li>
						</ul>
					</div>
					
					<div class="col-sm-3">
						<ul class="socials">
							<li><a href="#"><i class="fa fb fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa tw fa-twitter"></i></a></li>
						</ul>
			
						<ul class="list2">
							<li><strong class="phone">+331 22 33 44 55</strong><br><small>Lun - Ven / 9h - 18h</small></li>
							<li>Des questions? <a href="mailto:contact@lapinouss.com">contact(at)lapinouss.com</a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		
		<div class="copy">
			<p>&copy; 2016 - <a href="http://lapinouss.com" target="_blank">Lapinouss</a></p>
		</div>
		
	</body>
</html>