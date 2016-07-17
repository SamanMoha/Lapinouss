<?php
    $count = count($game_type->games);
?>

<div class="students wow  zoomInDown" data-wow-delay="0.4s">
    <div class="container">
        <h3><?php echo $game_type->name; ?></h3>
        <div class="custom_testimonials_wrap_inner">
            <address><img src="<?php echo 'resources/images/tiles/tutorial/' . $game_type->id_game_type .  '.jpg'; ?>" class="img-responsive" alt=""/></address>
            <div class="extra-wrap">
                <p><?php echo $game_type->description; ?></p>
                <p>
                    <i>
                        <small>
                            <?php
                            if ($count == 0)
                                echo 'Ce type ne contient aucun jeu';
                            else if ($count == 1)
                                echo 'Ce type contient ' . $count . ' jeu';
                            else if ($count > 1)
                                echo 'Ce type contient ' . $count . ' jeux';
                            ?>
                        </small>
                    </i>
                </p>
                <p><br/><br/></p>
                <p class="m_2">
                <form method="post">
                    <input type="submit" name="confirm" class="btn1 btn-8 btn-8c" value="Confirmer la suppression">
                </form>

                <a href="<?php echo action('game', 'store', '', '' , $game_type->id_game_type); ?>"><label class="btn1 btn2 btn-8 btn-8c">Annuler</label></a>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>