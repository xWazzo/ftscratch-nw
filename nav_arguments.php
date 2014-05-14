<?php
// ===================================
// Nav Menu Arguments
// ===================================

$args_utilities_nav = array(
	'theme_location' => 'utilities-nav',
	'menu'            => 'utilities-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'utilities-nav-container',
	'container_id'    => 'utilities-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'utilities-nav-menu',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_main_nav = array(
	'theme_location' => 'main-nav',
	'menu'            => 'main-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'main-nav-container col-xs-12',
	'container_id'    => 'main-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'main-nav-menu',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

$args_secondary_nav = array(
	'theme_location' => 'secondary-nav',
	'menu'            => 'secondary-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'secondary-nav-container',
	'container_id'    => 'secondary-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'secondary-nav-menu',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

$args_footer_main_nav = array(
	'theme_location' => 'footer-main-nav',
	'menu'            => 'footer-main-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-main-nav-container',
	'container_id'    => 'footer-main-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-main-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_footer_first_col_nav = array(
	'theme_location' => 'footer-first-col-nav',
	'menu'            => 'footer-first-col-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-first-col-nav-container',
	'container_id'    => 'footer-first-col-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-first-col-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_footer_second_col_nav = array(
	'theme_location' => 'footer-second-col-nav',
	'menu'            => 'footer-second-col-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-second-col-nav-container',
	'container_id'    => 'footer-second-col-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-second-col-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_footer_third_col_nav = array(
	'theme_location' => 'footer-third-col-nav',
	'menu'            => 'footer-third-col-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-third-col-nav-container',
	'container_id'    => 'footer-third-col-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-third-col-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_footer_fourth_col_nav = array(
	'theme_location' => 'footer-fourth-col-nav',
	'menu'            => 'footer-fourth-col-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-fourth-col-nav-container',
	'container_id'    => 'footer-fourth-col-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-fourth-col-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);

$args_footer_legal_nav = array(
	'theme_location' => 'footer-legal-nav',
	'menu'            => 'footer-legal-nav', // The menu that is desired; accepts (matching in order) id, slug, name
	'container'       => 'nav',
	'container_class' => 'footer-legal-nav-container',
	'container_id'    => 'footer-legal-nav',
	'menu_class'      => 'menu',
	'menu_id'         => 'footer-legal-nav',
	'echo'            => true,
	'fallback_cb'     => false,
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => -1,
	'walker'          => ''
);
?>