<div class="advantages">
    <div class="box_1">
        <h3>Salut <?php echo $account->first_name; ?> !</h3>
        <h4>Comment allez vous aujourd'hui ?</h4>
        <br/>
        <br/>
    </div>
    <div class="container">
        <div class="col-md-6">
            <h3 class="m_3">Mes jeux</h3>
            <div class="feature about_box1">
                <i class="fa fa-globe"> </i>
                <h4>Ut wisi enim ad minim</h4>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
            <div class="feature about_box1">
                <i class="fa fa-heart"> </i>
                <h4>Claritas est etiam processus</h4>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                </p>
            </div>
            <div class="feature">
                <i class="fa fa-gears"> </i>
                <h4>Mirum est notare quam</h4>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
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

                                        echo '(' . $age . ' '. ($age > 1 ? 'an' : 'ans') . ')';
                                    ?>
                                </h4>
                                <p>
                                    Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera goth
                                    ica, quam nunc putamus parum claram
                                </p>
                            </li>
                            <h4>Finibus Bonorum <span><a href="#">http://demolink.org</a></span></h4>
                            <div class="clearfix"> </div>
                        </ul>
                        <?php
                    }
                }
                else {
                    echo "Aucun enfant, qu'attendez vous ?";
            }
            ?>

        </div>
    </div>
</div>