<?php 
    /**
     * Template Name: Archive Post Template
     * Template Post Type: page
     */
    get_header();
?>
    <section class="inner-masthead" style="background-image: url('<?php echo wp_kses_post(get_field('inner_hero_image')); ?>')">
        <h1><?php echo wp_kses_post(get_field('inner_main_title')); ?></h1>
    </section>
    <section class="inner-main-content">
        <?php 
            // if you want to add directly to the template
            // echo do_shortcode('[post_archive]');
        ?>
        <?php 
            //echo wp_kses_post(get_field('archive_shortcode')); 
            $shortcode_value = get_field('archive_shortcode'); 
            echo do_shortcode($shortcode_value);
        ?>
        
    </section>
<?php
    get_footer();
?>