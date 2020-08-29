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

// Custom wp_nav_menu to add title and nav wrapper
function bs4seed_wp_nav_menu($args) {
    if(empty($args) || empty($args['theme_location'])) return;
    if(empty($args['nav_class'])) $args['nav_class'] = 'navbar navbar-expand';
    if(!empty($args['title_tag'])):
    ?>
<<?php echo $args['title_tag'];?>><?php echo bs4seed_get_menu_name($args['theme_location']);?></<?php echo $args['title_tag'];?>>
    <?php endif; ?>
<nav class="<?php echo $args['nav_class']; ?>">
    <?php wp_nav_menu($args); ?> 
</nav>
<?php
}