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
            <h2>Accorder une permission</h2>
            <?php
            if (count($children) == 0) {
                echo '<small>Aucun enfant</small>';
            }
            foreach ($children as $child) {
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/character/kid.png" alt="">
                        <div class="desc1">
                            <h5><a id="<?php echo $child->id_child_account; ?>"><?php echo $child->first_name . ' ' . $child->last_name; ?></a></h5>
                        </div>
                        <p><br/><br/></p>
                        <div class="reply">
                            <form method="post">
                                <input type="hidden" name="child" value="<?php echo $child->id_child_account; ?>">
                                <?php
                                if (in_array($child, $childrenPermissions)) {
                                    echo '<input type="submit" name="decline" class="comment-reply-link navbar-blink" value="D&eacute;cliner" />';
                                }
                                else {
                                    echo '<input type="submit" name="allow" class="comment-reply-link navbar-blink" value="Autoriser" />';
                                }
                                ?>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <?php
            }
            ?>

        </div>

    </div>

</div>