<div class="grid_4">
    <div class="container">
        <h1 class="blog_head"><?php echo $game->title; ?></h1>

        <ul class="comment-list">
            <li>
                <div class="desc1">
                    <?php
                    $title = str_replace(' ', '_', $game->title);
                    include 'games/' . $title . '/template.html';
                    ?>
                </div>
                <div class="clearfix"></div>
            </li>
        </ul>
    </div>
</div>