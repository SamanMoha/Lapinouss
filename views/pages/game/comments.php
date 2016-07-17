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
                    </div>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>

        <div class="comment">
            <h2>Commentaires</h2>
            <?php
            if (count($game->comments) == 0) {
                echo '<small>Aucun commentaire</small>';
                echo '<br/><br/>';
                echo 'Soyez le premier &agrave; ajouter un avis !';
            }
            foreach ($game->comments as $comment) {
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/actions/note.png" alt="">
                        <div class="desc1">
                            <h5><a><?php echo $comment->account->first_name . ' ' . $comment->account->last_name; ?></a></h5>
                            <div class="extra">
                                <time datetime="<?php echo DateUtil::format($comment->date_comment); ?>">
                                    Post&eacute; le <?php echo DateUtil::format($comment->date_comment); ?></time>
                            </div>
                            <p><?php echo $comment->comment; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <?php
            }
            ?>

        </div>

    </div>

    <?php
        if (count($game->comments) > 0) {
    ?>
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
    <?php
    }
    ?>

    <?php
        if(isset($_SESSION['user']) && $_SESSION['user'] instanceof Account) {
            ?>
            <div class="comment comments-area">
                <form method="POST" action="<?php echo action('game', 'comments', $game->id_game); ?>">
                    <h3>Poster un commentaire</h3>
                    <ul class="comment-list">
                        <li><img src="resources/images/actions/mail.png" alt="">
                            <div class="desc1">
                                <h5>Nous sommes le <?php echo DateUtil::format(DateUtil::now()); ?></h5>
                                <p>
                                    <textarea name="message"></textarea>
                                </p>
                                <div class="reply">
                                    <label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="comment" value="Poster"></label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </form>
            </div>
    <?php
        }
    ?>

</div>