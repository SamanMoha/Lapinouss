<div class="grid_4">
	<div class="container-fluid">
		<h2>Th&egrave;mes</h2>

		<?php
		if (count($game_types) == 0) {
			echo '<br/><br/>Aucun th&egrave;me t&eacute;l&eacute;charg&eacute;';
		}
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
						<div class="col-sm-6"><a href="<?php echo action('game', 'theme', $game_type->id_game_type); ?>" class="btn1">Explorer</a></div>
					</div>
				</div>

				<?php
			}
		?>

	</div>
</div>