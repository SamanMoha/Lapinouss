   <div class="grid_4">
		<div class="container"> 
			<h1 class="blog_head">Mes jeux</h1>

			<?php
			for ($i=0; $i<count($games); $i+=2) {
				if ($games[$i]->Available == 1) {
					?>
					<div class="blog_grid span2">
						<div class="col-md-6 blog_box">
							<a href="single.html" class="mask"><img src="resources/images/actions/game.png" alt="image" width="200px" height="200px" class="img-responsive zoom-img" alt=""/></a>
							<h3><a href="single.html"><?php echo $games[$i]->title; ?></a></h3>
							<div class="links">
								<ul>
									<li><i class="fa blog-icon fa-calendar"> </i><span><?php echo $games[$i]->created_date; ?></span></li>
									<li><i class="fa blog-icon fa-user"> </i><span>admin</span></li>
									<li><i class="fa blog-icon fa-comment"> </i><a href="#"><span>No comments</span></a></li>
								</ul>
							</div>
							<p><?php echo $games[$i]->description; ?></p>
							<?php
							 	if ($_SESSION['user'] instanceof ChildAccount) {
									echo '<a href="' . action('game', 'play', $games[$i]->uid) . '" class="btn1 btn-8 btn-8c">Jouer</a>';
								} else {
									echo '<a href="#" class="btn1 btn-8 btn-8c">Supprimer</a>';
								}
							?>
						</div>

						<?php
						if (count($games) > $i+1) {
							?>

							<div class="col-md-6 blog_box">
								<a href="single.html" class="mask"><img src="resources/images/actions/game.png" alt="image" width="200px" height="200px" class="img-responsive zoom-img" alt=""/></a>
								<h3><a href="single.html"><?php echo $games[$i+1]->title; ?></a></h3>
								<div class="links">
									<ul>
										<li><i class="fa blog-icon fa-calendar"> </i><span><?php echo $games[$i]->created_date; ?></span></li>
										<li><i class="fa blog-icon fa-user"> </i><span>admin</span></li>
										<li><i class="fa blog-icon fa-comment"> </i><a href="#"><span>No comments</span></a></li>
									</ul>
								</div>
								<p><?php echo $games[$i+1]->description; ?></p>
								<?php
								if ($_SESSION['user'] instanceof ChildAccount) {
									echo '<a href="#" class="btn1 btn-8 btn-8c">Jouer</a>';
								} else {
									echo '<a href="#" class="btn1 btn-8 btn-8c">Supprimer</a>';
								}
								?>
							</div>

							<?php
						}
						?>
						<div class="clearfix"> </div>
					</div>
					<?php
				}
			}
			?>
		   
		   <div class="pagination">
		    <ul><li class="pagination-start firstItem"><span class="pagenav">D&eacute;but</span></li>
		    	<li class="pagination-prev"><span class="pagenav">Prec</span></li><li>
		    	<span class="pagenav">1</span></li><li><a href="#" class="pagenav">2</a></li>
		    	<li class="pagination-next"><a title="" href="#" class="border pagenav" data-original-title="Next">Suiv</a></li>
		    	<li class="pagination-end lastItem"><a title="" href="#" class="border pagenav" data-original-title="End">Fin</a></li>
		    </ul>	
		  </div>
	   </div>
	</div>