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

  // add our Custom CSS & Bootstrap
  function my_theme_enqueue_assets(){
    // Enqueue Bootstrap CDN
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0', 'all' );
    // Enqueue your Custom CSS
    // We use get_template_directory_uri() to get the path to your theme folder
    wp_enqueue_style(
      'my-custom-style',
      get_template_directory_uri() . '/assets/css/custom-style.css',
      array('bootstrap-css'),
      '1.0.0',
      'all'
    );
    // Enqueue the Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true );
  }
  add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');
?>