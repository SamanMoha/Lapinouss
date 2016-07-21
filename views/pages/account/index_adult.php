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
                <h4><a href="<?php echo action('game'); ?>">Permissions de jeux</a></h4>
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
                                <h3>
                                    <?php echo $child->first_name . ' ' . $child->last_name; ?>
                                </h3>
                                <p>
                                    Dernier jeu jou&eacute; le : 12 Juin 2016
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