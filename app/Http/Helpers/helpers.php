<?php

//for menu and sub-menu iteration
function getAllSlugs($menu) {
    $slugs = [];
    if (isset($menu->slug)) {
        $slugs[] = $menu->slug;
    }
    if (isset($menu->submenu) && is_array($menu->submenu)) {
        foreach ($menu->submenu as $submenuItem) {
            $slugs = array_merge($slugs, getAllSlugs($submenuItem));
        }
    }
    return $slugs;
}

?>