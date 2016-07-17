<div class="advantages">
    <div class="box_1">
        <h3>
            <?php
                echo date('H') > 18 || date('H') < 3 ? 'Bonsoir' : 'Bonjour';
                echo ' ' . $account->first_name . ' !';
            ?>
        </h3>
        <h4>Comment allez vous aujourd'hui ?</h4>
        <br/>
        <br/>
    </div>
    <div class="container">
        <div class="col-md-6">
            <h3 class="m_3">Tableau de bord</h3>
            
            <div class="feature about_box1">
                <i class="fa fa-globe"> </i>
                <h4><a href="<?php echo action('game'); ?>">Mes jeux</a></h4>
                <p>
                    Consulter la liste des jeux achet&eacute;s, et en  acheter d'avantage.
                </p>
            </div>
            <div class="feature about_box1">
                <i class="fa fa-heart"> </i>
                <h4><a href="<?php echo action('game', 'stats'); ?>">Statistiques</a></h4>
                <p>
                    Suivez le parcours de vos enfants sur les diff&eacute;rents jeux.
                </p>
            </div>
            <div class="feature about_box1">
                <i class="fa fa-gears"> </i>
                <h4><a href="<?php echo action('game', 'settings'); ?>">Permissions de jeux</a></h4>
                <p>
                    Accorder &agrave; vos enfants la possibilit&eacute; de ne jouer qu'&agrave; certains jeux.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <h3 class="m_3">Mes enfants</h3>

            <?php
                if ($children
                    && count($children) > 0) {
                    foreach ($children as $child) {
                        ?>
                        <ul class="about_box span_1">
                            <li class="box_img"><img src="resources/images/character/kid.png" class="img-responsive" alt=""/></li>
                            <li class="box_desc">
                                <h4>
                                    <?php echo $child->first_name . ' ' . $child->last_name; ?>
                                    <?php
                                        $age = DateUtil::age($child->birth_date);

                                        echo '(' . $age . ' ' . ($age > 1 ? 'ans' : 'an') . ')';
                                    ?>
                                </h4>
                                <p>
                                    Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera goth
                                    ica, quam nunc putamus parum claram
                                </p>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                        <?php
                    }
                }
                else {
                    echo "Aucun enfant, qu'attendez vous ?";
            }
            ?>

            <a href="<?php echo action('account', 'children'); ?>" class="btn1 btn2 btn-8 btn-8c"">Voir plus</a>

        </div>
    </div>
</div>