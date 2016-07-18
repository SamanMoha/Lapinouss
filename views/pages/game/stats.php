<div class="container">
    <div class="row">
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
                            if ($total_played > 0)  {
                                ?>
                                <p>
                                    Nombre totale de parties jou&eacute;es : <?php echo $total_played; ?>
                                </p>
                                <p>
                                    Nombre totale de troph&eacute;es remport&eacute;es : <?php echo $total_trophies; ?>
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
            <h2>Mes enfants</h2>
            <?php
            if (count($children) == 0) {
                echo '<small>Aucun enfant</small>';
            }

            if ($children  != null)
                foreach ($children as $child) {
                    ?>
                    <ul class="comment-list">
                        <li><img src="resources/images/character/kid.png" alt="">
                            <div class="desc1">
                                <h5><a><?php echo $child->first_name . ' ' . $child->last_name; ?></a></h5>
                            </div>

                            <?php
                            if ($child->played != null) {
                                ?>
                                <p>
                                    Nombre de parties jou&eacute;es : <?php echo $child->played->played_time; ?>
                                </p>
                                <p>
                                    Derni&egrave;re partie jou&eacute;e le : <?php echo DateUtil::format($child->played->date_game); ?>
                                </p>
                                <p>
                                    Nombre de troph&eacute;es obtenus : <?php echo count($child->trophies); ?>
                                </p>
                                <?php
                            }
                            else {
                                echo 'Aucune partie jou&eacute;e';
                            }
                            ?>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                    <?php
                }
            ?>

        </div>

    </div>

</div>