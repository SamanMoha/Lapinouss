<div class="grid_4">
    <div class="container">
        <h1 class="blog_head"><?php echo $game->title; ?></h1>

        <ul class="comment-list">
            <li>

                //Print game here

                <div class="desc1">
                    <h5><a href="#"><?php echo $game->title; ?></a></h5>
                    <div class="extra">
                        <time pubdate="" datetime="2014-03-30T14:47:59">
                            Cr&eacute;e le <?php echo $game->created_date; ?></time>
                    </div>
                    <p><?php echo $game->description; ?></p>
                    <div class="reply"><a class="comment-reply-link" href="#">T&eacute;l&eacute;charger</a></div>
                </div>
                <div class="clearfix"></div>
            </li>
        </ul>
    </div>
</div>