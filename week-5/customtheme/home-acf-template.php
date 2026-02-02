<?php 
    /**
     * Template Name: Homepage (ACF) Template
     * Template Post Type: page
     */
    get_header();
?>
<section class="home-hero" style="background-image: url('<?php echo wp_kses_post(get_field('hero_image')); ?>')">
    <h1><?php echo wp_kses_post(get_field('main_title')); ?></h1>
</section>
<main>
    <section class="home-intro">
        <h2><?php echo wp_kses_post(get_field('intro_title')); ?></h2>
        <p><?php echo wp_kses_post(get_field('intro_text')); ?></p>
    </section>
    <section class="home-row-one">
        <div>
            <img 
                src="<?php echo wp_kses_post(get_field('row_one_img')); ?>" 
                alt="<?php echo wp_kses_post(get_field('row_one_img_alt')); ?>"
            />
        </div>
        <div>
            <h3><?php echo wp_kses_post(get_field('row_one_heading')); ?></h3>
            <p><?php echo wp_kses_post(get_field('row_one_text')); ?></p>
        </div>
    </section>
</main>
<?php 
    get_footer();
?>