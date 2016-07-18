<div class="grid_4">
	<div class="container-fluid">
		<h2>Th&egrave;mes</h2>

		<?php
		if ($game_types != null)
		foreach ($game_types as $game_type) {
			?>

			<div class="col-sm-3">
				<div class="view view-first">
					<img src="resources/images/tiles/tutorial/<?php echo $game_type->id_game_type; ?>.jpg" class="img-responsive" alt=""/>
				</div>
				<h3><a href="<? echo action('game', 'store', 'type', $game_type->id_game_type); ?>" id="<?php echo $game_type->id_game_type;?>"><?php echo $game_type->name; ?></a></h3>
				<p class="service_desc"><?php echo $game_type->description; ?><br /></p>

				<div class="row">
					<?php
					if ($game_type->isAlreadyBought) {
						?>
						<div class="col-sm-6"><a href="<?php echo action('game', 'store', 'type', $game_type->id_game_type); ?>" class="btn1">Explorer</a></div>
						<div class="col-sm-6">
							<?php
							if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
								echo '<a href="' . action('game', 'delete', 'type', $game_type->id_game_type) . '" class="btn1">Supprimer</a>';
							}
							?>
						</div>
						<?php
					}
					else {
						?>
						<div class="col-sm-6">
							<?php
							if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
								echo '<a href="' . action('game', 'buy', 'type', $game_type->id_game_type) . '" class="btn1">T&eacute;l&eacute;charger</a>';
							}
							?>
						</div>
						<div class="col-sm-6"><a href="<?php echo action('game', 'store', 'type', $game_type->id_game_type); ?>" class="btn1">D&eacute;couvrir</a></div>
						<?php
					}
					?>
				</div>
			</div>

			<?php
		}
		?>

	</div>
</div>