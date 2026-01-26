<!doctype html>
<html lang="<?php language_attributes(); ?>">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo esc_url(home_url('wp-content/themes/customtheme/style.css')); ?>">
  </head>
  <body <?php body_class(); ?>>
    <header class="default-header navbar">
      <div>
        <a href="<?php echo esc_url(home_url()); ?>">
          <img src="<?php echo esc_url(home_url('wp-content/uploads/2026/01/coffee-logo.png')); ?>" alt="coffee brand logo">
        </a>
      </div>
      <nav>
        <?php 
          // This displays the menu you created in the Admin panel
          wp_nav_menu(array(
            'menu'           => 'main',
            'theme_location' => '',
            'depth'          => 2,
            'fallback_cb'    => false
          ));
        ?>
      </nav>
    </header>