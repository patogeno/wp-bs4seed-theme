<?php
    /* Main Footer File */
?>
        <footer id="bs4seed-footer">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-6 col-md-3">
                        <?php
                            $menu_position = 'left';
                            $menu_location = 'footer-navigation-'.$menu_position;
                        ?>
                        <h3><?php echo bs4seed_get_menu_name($menu_location);?></h3>
                        <nav class="navbar navbar-expand navbar-dark">
                            <?php
                                wp_nav_menu([
                                    'menu'            => $menu_location,
                                    'theme_location'  => $menu_location,
                                    'container'       => 'div',
                                    'container_id'    => 'footer-navbarNav-'.$menu_position,
                                    'container_class' => 'collapse navbar-collapse',
                                    'menu_id'         => false,
                                    'menu_class'      => 'navbar-nav mr-auto',
                                    'depth'           => 2,
                                    'fallback_cb'     => 'bs4navwalker::fallback',
                                    'walker'          => new bs4navwalker()
                                ]);
                            ?> 
                        </nav>
                    </div>
                    <div class="col-6 col-md-3">
                        <?php
                            $menu_position = 'middle';
                            $menu_location = 'footer-navigation-'.$menu_position;
                        ?>
                        <h3><?php echo bs4seed_get_menu_name($menu_location);?></h3>
                        <nav class="navbar navbar-expand navbar-dark">
                            <?php
                                wp_nav_menu([
                                    'menu'            => $menu_location,
                                    'theme_location'  => $menu_location,
                                    'container'       => 'div',
                                    'container_id'    => 'footer-navbarNav-'.$menu_position,
                                    'container_class' => 'collapse navbar-collapse',
                                    'menu_id'         => false,
                                    'menu_class'      => 'navbar-nav mr-auto',
                                    'depth'           => 2,
                                    'fallback_cb'     => 'bs4navwalker::fallback',
                                    'walker'          => new bs4navwalker()
                                ]);
                            ?> 
                        </nav>
                    </div>
                    <div class="col-6 col-md-3">
                        <?php
                            $menu_position = 'right';
                            $menu_location = 'footer-navigation-'.$menu_position;
                        ?>
                        <h3><?php echo bs4seed_get_menu_name($menu_location);?></h3>
                        <nav class="navbar navbar-expand navbar-dark">
                            <?php
                                wp_nav_menu([
                                    'menu'            => $menu_location,
                                    'theme_location'  => $menu_location,
                                    'container'       => 'div',
                                    'container_id'    => 'footer-navbarNav-'.$menu_position,
                                    'container_class' => 'collapse navbar-collapse',
                                    'menu_id'         => false,
                                    'menu_class'      => 'navbar-nav mr-auto',
                                    'depth'           => 2,
                                    'fallback_cb'     => 'bs4navwalker::fallback',
                                    'walker'          => new bs4navwalker()
                                ]);
                            ?> 
                        </nav>
                    </div>
                </div>
                <div class="row bottom-row">
                    <div class="col">
                        <p>Boostrap 4 Seed Theme 2020</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>