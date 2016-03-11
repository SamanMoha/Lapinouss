		<div class="footer wow fadeInRight" data-wow-delay="0.4s">
			<div class="container">
				<div class="footer_top">
					<div class="col-sm-3">
						<ul class="list1">
							<h3>Menu</h3>
							<li><a href="">Accueil</a></li>
							<li><a href="views/">Store</a></li>
							<li><a href="#">Tutoriels</a></li>
							<li><a href="#">Contact</a></li>
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
							<li><a href="#">Nous contacter</a></li>
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
			<p>&copy; 2016 - <a href="http://esgi.com" target="_blank">ESGI</a></p>
		</div>
		
		<script src="<?php echo getAbsolutePath("scripts/jquery-1.11.1.min.js"); ?>"></script>
		<script src="<?php echo getAbsolutePath("scripts/bootstrap.min.js"); ?>"></script>
		<script src="<?php echo getAbsolutePath("scripts/wow.min.js"); ?>"></script>
		
		<script>
			addEventListener(
				"load", 
				function() {
					setTimeout(hideURLbar, 0);
				}, 
				false
			);
			
			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		
			new WOW().init();
		
			$("span.menu").click(function(){
				$(".top-nav ul").slideToggle(
					500, 
					function() { }
				);
			});
			
			$(function() {
				$('.about-grid a')
					.Chocolat(
						{
							linkImages:false
						}
					);
			});
			
			$(document).ready(function(){
				$(".top-nav li a").click(function(){
					$(this)
						.parent()
						.addClass("active")
						.siblings()
						.removeClass("active");
				});

				 $(window).scroll(function(){
					$(".header-home")
						[$(window).scrollTop() >= $(".header-home").offset().top 
							? "addClass" 
							: "removeClass"]
						("fixed")
				 });
				 
			});
		</script>
		
	</body>
</html>