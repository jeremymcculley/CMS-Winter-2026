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
  // Week 9 Footer Widgets
  function cmsclass_widgets_init(){
    register_sidebar(array(
      'name'          => __( 'Footer Widget Area One', 'cmsclass' ),
      'id'            => 'footer-widget-area-one',
      'description'   => __( 'The first footer widget area', 'cmsclass' ),
      'before_widget' => '<div class="logo-widget">',
      'after_widget'  => '</div>'
      // 'before_title'  => '<h4 class="widget-title">',
      // 'after_title'   => '</h4>',
    ));
    register_sidebar( array(
      'name'          => __( 'Footer Widget Area Two', 'cmsclass' ),
      'id'            => 'footer-widget-area-two',
      'description'   => __( 'The second footer widget area', 'cmsclass' ),
      'before_widget' => '<div class="about-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h6 class="widget-title">',
      'after_title'   => '</h6>',
    ));
    register_sidebar( array(
      'name'          => __( 'Footer Widget Area Three', 'cmsclass' ),
      'id'            => 'footer-widget-area-three',
      'description'   => __( 'The third footer widget area', 'cmsclass' ),
      'before_widget' => '<div class="menu-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h6 class="widget-title">',
      'after_title'   => '</h6>',
    ));
    register_sidebar( array(
      'name'          => __( 'Footer Widget Area Four', 'cmsclass' ),
      'id'            => 'footer-widget-area-four',
      'description'   => __( 'The fourth footer widget area', 'cmsclass' ),
      'before_widget' => '<div class="contact-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h6 class="widget-title">',
      'after_title'   => '</h6>',
    ));
  }
  add_action( 'widgets_init', 'cmsclass_widgets_init' );
  /**
   * Key Concepts
   * ------------
   * The Query ($args): Think of this as a "Filter Order Form." You tell WordPress what you want (Post type, quantity, category), and WordPress goes to the database to fetch it.
   * The Loop: This is the while statement. It’s a repeating cycle that says, "As long as you found posts, keep making these HTML boxes."
   * Shortcode: This is the "nickname" for your function. Instead of writing 100 lines of code on every page, you just use the nickname [post_archive].
   * Safety (Escaping): You'll see things like esc_url or esc_attr. This is a security habit that "cleans" data before it's displayed to prevent hackers from injecting malicious scripts.
   */
/**
 * Change excerpt length globally
 */
/**
 * 1. ADJUST EXCERPT LENGTH
 * This function changes how many words show up in the post preview.
 */
function custom_excerpt_length( $length ) {
    return 20; // We tell WordPress to only show 20 words
}
// 'add_filter' hooks our function into the built-in WordPress excerpt process
// 999 is the priority (higher numbers run later to override other plugins)
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * 2. THE MAIN FILTER FUNCTION
 * This function handles both the "Logic" (the math of picking posts) 
 * and the "Display" (the HTML we see on the screen).
 */
function my_custom_post_archive_filter() {
    // Safety check: Don't run this code inside the WordPress Admin dashboard
    if ( is_admin() ) return;

    /**
     * STEP 1: CAPTURE DATA FROM THE URL
     * When you click "Filter", the URL changes to something like ?cat_filter=5
     * We need to "grab" those numbers to use them in our search.
     */
    // Check if a category was selected in the dropdown. If yes, turn it into an integer (number).
    $selected_cat = ( isset($_GET['cat_filter']) && $_GET['cat_filter'] != '0' ) ? intval($_GET['cat_filter']) : false;
    
    // Check if a tag was selected. Tags usually use "slugs" (text) instead of IDs.
    $selected_tag = ( isset($_GET['tag_filter']) && $_GET['tag_filter'] != '' ) ? sanitize_text_field($_GET['tag_filter']) : false;

    /**
     * STEP 2: BUILD THE SEARCH RULES (QUERY ARGS)
     * This is like telling WordPress: "Find posts that fit these specific rules."
     */
    $args = array(
        'post_type'      => 'post',      // We only want standard blog posts
        'posts_per_page' => 10,          // Only show 10 at a time
        'post_status'    => 'publish',   // Don't show drafts
        'orderby'        => 'date',      // Sort them by the date they were written
        'order'          => 'DESC',      // Newest posts first
    );

    /**
     * STEP 3: APPLY THE FILTERS
     * If the user actually picked a category or tag, add that rule to our list.
     */
    if ( $selected_cat ) {
        $args['cat'] = $selected_cat; // Filter by the Category ID
    }

    if ( $selected_tag ) {
        $args['tag'] = $selected_tag; // Filter by the Tag Slug
    }

    // Run the search using our rules above
    $archive_query = new WP_Query($args);

    /**
     * STEP 4: PREPARE THE HTML
     * 'ob_start' is like a "record" button. It catches all the HTML below 
     * and saves it so we can return it at the very end of the shortcode.
     */
    ob_start(); ?>

    <div class="archive-container container my-5">
        
        <form action="<?php echo esc_url( strtok($_SERVER["REQUEST_URI"], '?') ); ?>" method="get" class="row g-3 mb-5 p-4 bg-light border rounded">
            
            <div class="col-md-4">
                <label class="form-label fw-bold">Categories</label>
                <?php 
                wp_dropdown_categories(array(
                    'show_option_all' => 'Show All Categories', // The default option
                    'name'            => 'cat_filter',          // This MUST match the $_GET name in Step 1
                    'selected'        => $selected_cat,         // Keeps the chosen item selected after page reload
                    'class'           => 'form-select',         // A Bootstrap class for styling
                )); 
                ?>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Tags</label>
                <select name="tag_filter" class="form-select">
                    <option value="">Show All Tags</option>
                    <?php 
                    $tags = get_tags(); // Get all tags used on the site
                    foreach ($tags as $tag) {
                        // Create an <option> for every tag found in the database
                        printf('<option value="%1$s" %2$s>%3$s</option>',
                            esc_attr($tag->slug),
                            selected($selected_tag, $tag->slug, false),
                            esc_html($tag->name)
                        );
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 me-2">Filter Posts</button>
                <a href="<?php echo esc_url( strtok($_SERVER["REQUEST_URI"], '?') ); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="row">
            <?php 
            // Check if the search actually found any posts
            if ($archive_query->have_posts()) : ?>
                
                <?php 
                // THE LOOP: While there are posts to show, display them one by one
                while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                    
                    <article class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'style' => 'height:200px; object-fit:cover;']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <?php the_title(); // The Post Title ?>
                                    </a>
                                </h4>
                                <div class="mb-2 text-muted" style="font-size: 0.8rem;">
                                    Category: <?php the_category(', '); // List the categories for this specific post ?>
                                </div>
                                <p class="card-text text-muted">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); // Show a 15-word preview ?>
                                </p>
                            </div>
                        </div>
                    </article>

                <?php endwhile; ?>
                
                <?php 
                // IMPORTANT: Clean up the global $post data so we don't break other parts of the page
                wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No posts found matching those filters.</h3>
                    <p>Try selecting a different category or tag.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    // Stop "recording" and send all the captured HTML back to the page
    return ob_get_clean();
}

/**
 * 3. REGISTER THE SHORTCODE
 * This allows you to type [post_archive] into any page to show this whole system.
 */
add_shortcode('post_archive', 'my_custom_post_archive_filter');
?>