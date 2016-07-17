<div class="container">
    <div class="row">
        <div class="comment">
            <h2>En ce moment</h2>
            <?php
            $comments_count = count($games[0]->comments);
            ?>
            <ul class="comment-list">
                <li><img src="resources/images/actions/game.png" alt="">
                    <div class="desc1">
                        <h5><a id="<?php echo $games[0]->id_game; ?>"><?php echo $games[0]->title; ?></a></h5>
                        <div class="links">
                            <ul>
                                <li><i class="fa blog-icon fa-calendar"> </i><span><?php echo DateUtil::format($games[0]->created_date); ?></span></li>
                                <li><i class="fa blog-icon fa-money"> </i><span><?php echo $games[0]->price > 0 ? $games[0]->price . ' euros' : 'Gratuit'; ?></span></li>
                                <li>
                                    <i class="fa blog-icon fa-comment"> </i><a href="<?php echo action('game', 'comments', $games[0]->id_game); ?>"><span><?php echo $comments_count . ' commentaire' . ($comments_count > 1 ? 's' : ''); ?></span></a>
                                </li>
                            </ul>
                        </div>
                        <p><?php echo $games[0]->description; ?></p>
                        <div class="reply">
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account && $game_type != null && $game_type->isAlreadyBought) {
                                if ($games[0]->isAlreadyBought) {
                                    echo '<a href="' . action('game', 'delete', 'game', $games[0]->id_game) . '" class="comment-reply-link">Supprimer</a>';
                                }
                                else {
                                    echo '<a href="' . action('game', 'buy', $games[0]->id_game) . '" class="comment-reply-link">T&eacute;l&eacute;charger</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>

        <div class="comment">
            <h2>Les plus populaires</h2>
            <?php
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
                                if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account && $game_type != null && $game_type->isAlreadyBought) {
                                    if ($game->isAlreadyBought) {
                                        echo '<a href="' . action('game', 'delete', 'game', $game->id_game) . '" class="comment-reply-link">Supprimer</a>';
                                    }
                                    else {
                                        echo '<a href="' . action('game', 'buy', $game->id_game) . '" class="comment-reply-link">T&eacute;l&eacute;charger</a>';
                                    }
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