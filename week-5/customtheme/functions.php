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
  // Week Five Starts Here
  /**
  * Step 1: Register Custom Post Type 'Staff'
  */
  function my_theme_register_staff_cpt(){
    // This is defining labels for the post-type, viewable from the dashboard
    $labels = array(
      'name'          => 'Staff',
      'singular_name' => 'Staff Member',
      'add_new'       => 'Add New Member',
      'all_items'     => 'All Staff',
      'menu_name'     => 'Staff Directory'
    );
    $args = array(
      'labels'       => $labels,
      'public'       => true,
      'has_archive'  => true,
      'menu_icon'    => 'dashicons-businessperson', // Sets the sidebar icon
      'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
      'show_in_rest' => true,
    );
    register_post_type('staff', $args);
  }
  add_action('init', 'my_theme_register_staff_cpt');
  /**
  * Step 2: Create Shortcode [staff_alert name="Name"]
  */
  function my_theme_staff_shortcode($atts){
    // 1. Set default attributes
    $pairs = shortcode_atts(array(
      'name' => 'Team Member',
    ), $atts);
    // 2. Build the output (Return not echo!)
    $output = '<div class="col-sm-12 col-md-4 col-lg-4">';
      $output .= '<h3 class="member-title">' . esc_url($pairs['name']) . '</h3>';
    $output .= '</div>';
    return $output;
  }
  add_shortcode('staff_alert', 'my_theme_staff_shortcode');
  /**
  * Step 3: Custom Widget Class
  */
  class My_Custom_Staff_Widget extends WP_Widget{
    public function __construct(){
      parent::__construct('staff_widget', 'Staff Notice Widget', array(
        'description' => 'Displays a custom notice in the footer'
      ));
    }
    // Front-end display
    public function widget($args, $instance){
      echo $args['before_widget'];
      if(!empty($instance['title'])){
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
      }
      echo '<p>Join our Team!!!!</p>';
      echo $args['after_widget'];
    }
    public function form($instance){
      // admin settings
      $title = !empty($instance['title']) ? $instance['title'] : 'Work With Us';
      ?>
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
      </p>
      <?php
    }
  }
  // Register Widget
    function my_theme_register_widget(){
      register_widget('My_Custom_Staff_Widget');
    }
    add_action('widgets_init', 'my_theme_register_widget');
  // Registering the Sidebar
  function my_theme_sidebars() {
    register_sidebar( array(
        'name'          => 'Main Sidebar',
        'id'            => 'main-sidebar',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
    ));
  }
  add_action( 'widgets_init', 'my_theme_sidebars' );  
?>