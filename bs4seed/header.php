<?php 
    /* Header Template */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
        <?php wp_body_open(); ?>
        <header id="bs4seed-header" class="container-fluid">
            <nav class="navbar-top navbar navbar-expand">
                <?php
                    wp_nav_menu([
                        'menu'            => 'top-nav',
                        'theme_location'  => 'top-nav',
                        'container'       => 'div',
                        'container_id'    => 'navbar-top',
                        'container_class' => '',
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-nav nav-fill ml-auto',
                        'depth'           => 2,
                        'fallback_cb'     => 'bs4navwalker::fallback',
                        'walker'          => new bs4navwalker()
                    ]);
                ?>
            </nav>
            <nav class="navbar-main navbar navbar-expand-lg navbar-dark justify-content-between">
                <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img class="logo" src="<?php echo bs4seed_get_theme_mod( 'bs4seed_logo', get_template_directory_uri().'/assets/images/logo.svg'); ?>" alt="Logo" /></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar-main" aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                    wp_nav_menu([
                        'menu'            => 'primary',
                        'theme_location'  => 'primary',
                        'container'       => 'div',
                        'container_id'    => 'navbar-main',
                        'container_class' => 'collapse navbar-collapse bg-dark',
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-nav nav-fill ml-auto',
                        'depth'           => 2,
                        'fallback_cb'     => 'bs4navwalker::fallback',
                        'walker'          => new bs4navwalker()
                    ]);
                ?>
            </nav>
            <div class="slogan"><?php echo get_bloginfo('description'); ?></div>
        </header>