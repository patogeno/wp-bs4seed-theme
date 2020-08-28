<?php
/*---- Customizer ----*/
function bs4seed_customize_register( $wp_customize ) {
   // 1. Add Section
   // ~~ No new section for now ~~ 
   
   // 2. Add Settings and Controls
    // 2.1. Site Identity Section (title_tagline)
    // 2.1.1 Site Logo
    $mod_name = 'bs4seed_logo';
    $mod_control_name = $mod_name.'_control';
    $wp_customize->add_setting($mod_name, array(
       'transport' => 'refresh',
       'height'         => 700,
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $mod_control_name, array(
      'label'             => __('Site Logo', 'bt4seed-theme'),
      'section'           => 'title_tagline',
      'settings'          => $mod_name,    
   )));
    
 }
 add_action( 'customize_register', 'bs4seed_customize_register' );