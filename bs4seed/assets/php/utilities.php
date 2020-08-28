<?php

// Custom get_theme_mod function to define default value for empty customizer modifications
function bs4seed_get_theme_mod ($mod_name, $default) {
    $mod = get_theme_mod($mod_name, $default);
    return (!empty($mod))?$mod:$default;
 }
