<div class="container">
    <div class="comment">
        <h2>D&eacute;tails</h2>
        <ul class="comment-list">
            <li><img src="resources/images/actions/game.png" alt="">
                <div class="desc1">
                    <h5><a id="<?php echo $game->id_game; ?>"><?php echo $game->title; ?></a></h5>
                    <div class="links">
                        <ul>
                            <li><i class="fa blog-icon fa-calendar"> </i><span><?php echo DateUtil::format($game->created_date); ?></span></li>
                            <li><i class="fa blog-icon fa-money"> </i><span><?php echo $game->price > 0 ? $game->price . ' euros' : 'Gratuit'; ?></span></li>
                        </ul>
                    </div>
                    <p><?php echo $game->description; ?></p>
                    <div class="reply">
                        <?php
                            if ($played != null) {
                                ?>
                                <p>
                                    Nombre de parties jou&eacute;es : <?php echo $played->played_time; ?>
                                </p>
                                <p>
                                    Derni&egrave;re partie jou&eacute;e le : <?php echo DateUtil::format($played->date_game); ?>
                                </p>
                        <?php
                            }
                            else {
                                echo 'Aucune partie jou&eacute;e';
                            }
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        </ul>
    </div>

    <div class="comment">
        <h2>Mes troph&eacute;es</h2>
        <?php
        if (count($trophies) == 0) {
            echo '<small>Aucun troph&eacute;e</small>';
        }

        if ($trophies  != null)
            foreach ($trophies as $trophy) {
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/egg_small.png" alt="">
                        <div class="desc1">
                            <h5><a><?php echo $trophy->name; ?></a></h5>
                        </div>
                        <p><?php echo $trophy->description; ?></p>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <?php
            }
        ?>

    </div>

</div>