<div class="container">

	<div class="row">

		<h1 class="blog_head">Mes jeux</h1>

		<?php
		if (count($games) == 0) {
			echo 'Aucun jeu trouv&eacute;';
		}
		else {
			foreach ($games as $game) {
				$comments_count = count($game->comments);
				?>
				<div class="blog_grid span2 col-lg-6">
					<div class="blog_box">
						<img src="resources/images/actions/game.png" alt="image" width="200px" height="200px" class="img-responsive zoom-img" alt=""/>
						<h3><?php echo $game->title; ?></h3>
						<div class="links">
							<ul>
								<li><i class="fa blog-icon fa-calendar"> </i><span><?php echo date('j M Y', strtotime($game->created_date)); ?></span></li>
								<li><i class="fa blog-icon fa-user"> </i><span><?php echo $game->account->first_name . ' ' . $game->account->last_name; ?></span></li>
								<li>
									<i class="fa blog-icon fa-comment"> </i><a href="#"><span><?php echo $comments_count . ' commentaire' . ($comments_count > 1 ? 's' : ''); ?></span></a>
								</li>
							</ul>
						</div>
						<p><?php echo $game->description; ?></p>
						<?php
						if ($_SESSION['user'] instanceof ChildAccount) {
							echo '<a href="' . action('game', 'play', $game->uid) . '" class="btn1 btn-8 btn-8c">Jouer</a>';
						} else {
							echo '<a href="' . action('game', 'delete', 'game', $game->uid) . '" class="btn1 btn-8 btn-8c">Supprimer</a>';
						}
						?>
					</div>
					<div class="clearfix"> </div>
				</div>
				<?php
			}
			?>

			<div class="pagination col-lg-12">
				<ul>
					<li class="pagination-start firstItem"><span class="pagenav">D&eacute;but</span></li>
					<li class="pagination-prev"><span class="pagenav">Prec</span></li><li>
						<span class="pagenav">1</span></li><li><a href="#" class="pagenav">2</a></li>
					<li class="pagination-next"><a title="" href="#" class="border pagenav" data-original-title="Next">Suiv</a></li>
					<li class="pagination-end lastItem"><a title="" href="#" class="border pagenav" data-original-title="End">Fin</a></li>
				</ul>
			</div>
			<?php
		}
		?>

	</div>

</div>

