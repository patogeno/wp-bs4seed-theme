<?php

// Custom get_theme_mod function to define default value for empty customizer modifications
function bs4seed_get_theme_mod ($mod_name, $default) {
    $mod = get_theme_mod($mod_name, $default);
    return (!empty($mod))?$mod:$default;
 }

// To get menu name to use as title
function bs4seed_get_menu_name ($menu_location) {
    $menu_locations = get_nav_menu_locations();
    $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
    $menu_name = (isset($menu_object->name) ? $menu_object->name : '');
    echo esc_html($menu_name);
}