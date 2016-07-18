<div class="container">
    <div class="row">
        <div class="comment">
            <h2>Mes enfants</h2>
            <?php
            if (count($children) == 0) {
                echo 'Aucun enfant trouv&eacute;';
            }

            if ($children != null)
            foreach ($children as $child) {
                ?>
                <ul class="comment-list">
                    <li><img src="resources/images/character/kid.png" alt="">
                        <div class="desc1">
                            <h5><a><?php echo $child->first_name . ' ' . $child->last_name; ?></a></h5>
                            <div class="reply">
                                <a href="<?php echo action('account', 'deleteChild', $child->id_child_account); ?>" class="comment-reply-link">Supprimer</a>
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

    <div class="comment comments-area">
        <a href="<?php echo action('account', 'registerChild'); ?>" class="btn1 btn2 btn-8 btn-8c"">Ajouter un enfant</a>
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
