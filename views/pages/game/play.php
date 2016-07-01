<h1 class="blog_head">
    <?php echo $game->title; ?></h1>

    <div class="container">
    <?php
        $title = str_replace(' ', '_', $game->title);

        include 'games/' . $title . '/' . $game->file;
    ?>
</div>
<div class="clearfix"></div>