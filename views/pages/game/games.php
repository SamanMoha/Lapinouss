<div class="container">
    <div class="row">
        <div class="comment">
            <h2>En ce moment</h2>
            <ul class="comment-list">
                <li><img src="resources/images/actions/game.png" alt="">
                    <div class="desc1">
                        <h5><a id="<?php echo $games[0]->id_game; ?>"><?php echo $games[0]->title; ?></a></h5>
                        <div class="extra">
                            <time pubdate="" datetime="2014-03-30T14:47:59">
                                Cr&eacute;e le <?php echo $games[0]->created_date; ?></time>
                        </div>
                        <p><?php echo $games[0]->description; ?></p>
                        <div class="reply">
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
                                if ($games[0]->isAlreadyBought) {
                                    echo '<a href="' . action('game', 'delete', 'game', $games[0]->uid) . '" class="comment-reply-link">Supprimer</a>';
                                }
                                else {
                                    echo '<a href="' . action('game', 'buy', 'game', $games[0]->uid) . '" class="comment-reply-link">T&eacute;l&eacute;charger</a>';
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
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/actions/game.png" alt="">
                        <div class="desc1">
                            <h5><a id="<?php echo $game->id_game; ?>"><?php echo $game->title; ?></a></h5>
                            <div class="extra">
                                <time pubdate="" datetime="2014-03-30T14:47:59">
                                    Cr&eacute;e le <?php echo $game->created_date; ?></time>
                            </div>
                            <p><?php echo $game->description; ?></p>
                            <div class="reply">
                                <?php
                                if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
                                    if ($game->isAlreadyBought) {
                                        echo '<a href="' . action('game', 'delete', 'game', $game->uid) . '" class="comment-reply-link">Supprimer</a>';
                                    }
                                    else {
                                        echo '<a href="' . action('game', 'buy', 'game', $game->uid) . '" class="comment-reply-link">T&eacute;l&eacute;charger</a>';
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