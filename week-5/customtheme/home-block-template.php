<?php
/**
 * Template Name: Homepage (Block Editor) Template
 * Template Post Type: page
 */

get_header(); ?>

<main id="main-content" class="site-main">
    <?php
    // Start the Loop
    while ( have_posts() ) :
        the_post();

        // This function is what renders the blocks from the editor
        the_content();

    endwhile; 
    ?>
</main>

<?php get_footer(); ?>