<div class="container">
    <div class="row">
        <div class="comment">
            <h2>Mes jeux</h2>
            <?php
            if (count($games) == 0) {
                echo 'Aucun jeu trouv&eacute;';
            }
            foreach ($games as $game) {
                $comments_count = count($game->comments);
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/actions/game.png" alt="">
                        <div class="desc1">
                            <h5><a id="<?php echo $game->id_game; ?>"><?php echo $game->title; ?></a></h5>
                            <div class="links">
                                <ul>
                                    <li><i class="fa blog-icon fa-calendar"> </i><span><?php echo DateUtil::format($game->created_date); ?></span></li>
                                    <li><i class="fa blog-icon fa-money"> </i><span><?php echo $game->price > 0 ? $game->price . ' euros' : 'Gratuit'; ?></span></li>
                                    <li>
                                        <i class="fa blog-icon fa-comment"> </i><a href="<?php echo action('game', 'comments', $game->id_game); ?>"><span><?php echo $comments_count . ' commentaire' . ($comments_count > 1 ? 's' : ''); ?></span></a>
                                    </li>
                                </ul>
                            </div>
                            <p><?php echo $game->description; ?></p>
                            <div class="reply">
                                <?php
                                echo '<a href="' . action('game', 'play', $game->id_game) . '" class="comment-reply-link navbar-blink">';
                                echo $_SESSION['user'] instanceof ChildAccount ? 'Jouer' : 'Demo';
                                echo '</a>';
                                ?>
                                &nbsp;&nbsp;
                                <?php
                                if ($_SESSION['user'] instanceof Account) {
                                    echo '<a href="' . action('game', 'delete', 'game', $game->id_game) . '" class="comment-reply-link btn-8c">Supprimer</a>';
                                }
                                ?>
                                &nbsp;&nbsp;
                                <?php
                                if ($_SESSION['user'] instanceof Account) {
                                    echo '<a href="' . action('game', 'setting', $game->id_game) . '" class="comment-reply-link navbar-blink">Permissions</a>';
                                }
                                ?>
                                &nbsp;&nbsp;
                                <?php
                                if ($_SESSION['user'] instanceof ChildAccount) {
                                    echo '<a href="' . action('game', 'detail', $game->id_game) . '" class="comment-reply-link">Scores</a>';
                                }
                                ?>
                                &nbsp;&nbsp;
                                <?php
                                if ($_SESSION['user'] instanceof Account) {
                                    echo '<a href="' . action('game', 'stats', $game->id_game) . '" class="comment-reply-link navbar-blink">Statistiques</a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="row">
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
