<?php

require_once('assets/php/bs4navwalker.php');

/* ---- Theme Support Features ---- */
if (! function_exists('bs4seed_setup') ):
   function bs4seed_setup() {
      // let Wordpress handle the Titles tags
      add_theme_support('title-tag');
      // Feature images
      add_theme_support( 'post-thumbnails' );
   }
endif;
add_action('after_setup_theme', 'bs4seed_setup');


/* ---- Register Menus ---- */
function register_bs4seed_menus(){
   register_nav_menus (
      array(
         'primary' => __('Primary Menu'),
         'footer-navigation' => __('Footer Menu'),
      )
   );
}
add_action('init', 'register_bs4seed_menus');

/* ---- Add Stylesheets and Scripts ---- */

function bs4seed_scripts() {

   $cacheNumber = '1597913380056';
   // Styles
   wp_enqueue_style('bs4seed_styles', get_stylesheet_uri(), array(), '1.0.0' );
   wp_enqueue_style('bs4seed_main' , get_template_directory_uri() . '/assets/css/main.css', array(), $cacheNumber );

   // Scripts
   wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',array(),'v1.14.7',true);
   wp_enqueue_script( 'bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), 'v4.3.1', true );
}
add_action('wp_enqueue_scripts','bs4seed_scripts');
