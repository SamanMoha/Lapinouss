<div class="row">

    <div class="box_1">
        <h1 class="blog_head">Mes enfants</h1>

        <div class="col-lg-5"></div>
        <div class="col-lg-4">
            <a href="<?php echo action('account', 'registerChild'); ?>" class="btn1 btn2 btn-8 btn-8c"">Ajouter un enfant</a>
            <br><br><br>
        </div>
        <div class="col-lg-12"></div>
    </div>

    <div class="container">

        <?php
        foreach ($children as $child) {
            ?>

            <div class="blog_grid span2 col-lg-3">
                <div class="blog_box">
                    <a class="mask"><img src="resources/images/character/kid.png" alt="image" width="200px" height="200px" class="img-responsive zoom-img" alt=""/></a>
                    <h3><a><?php echo $child->first_name . ' ' . $child->last_name; ?></a></h3>
                    <a href="<?php echo action('account', 'deleteChild', $child->id_child_account); ?>" class="btn1">Supprimer</a>
                </div>
                <div class="clearfix"> </div>
            </div>


            <?php
        }
        ?>

        <div class="pagination col-lg-12">
            <ul><li class="pagination-start firstItem"><span class="pagenav">D&eacute;but</span></li>
                <li class="pagination-prev"><span class="pagenav">Prec</span></li><li>
                    <span class="pagenav">1</span></li><li><a href="#" class="pagenav">2</a></li>
                <li class="pagination-next"><a title="" href="#" class="border pagenav" data-original-title="Next">Suiv</a></li>
                <li class="pagination-end lastItem"><a title="" href="#" class="border pagenav" data-original-title="End">Fin</a></li>
            </ul>
        </div>

    </div>

</div>