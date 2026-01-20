<?php 
  // This function registers navigation menu locations that you can manage in the WP Admin
  function customtheme_theme_setup(){
    // this is a WordPress hook ... you cannot rename a WP Hook
    register_nav_menus(array(
      'header' => 'Header menu',
      'footer' => 'Footer menu'
    ));
  }
  // add_action hooks our function into a specific WordPress event (theme setup)
  add_action('after_setup_theme', 'customtheme_theme_setup');
  // This enables the "Featured Image" box on the post/page editor screen
  add_theme_support('post-thumbnails');
?>