<?php 
  get_header();
?>
<main class="container">
    <?php 
        /**
        * THE LOOP
        * This is the heart of WordPress. It checks if there is content
        * and loops through it to display it.
        */
        if(have_posts()):
            while (have_posts()) : the_post();
    ?>
                <article id="post-<?php the_ID();?>" <?php post_class();?>>
                <section class="entry-heading">
                    <h1><?php the_title(); ?></h1>
                    <div class="post-meta">
                        <p>Posted on: <?php the_date(); ?></p>
                        <p>By: <?php the_author(); ?></p>
                    </div>
                </section>
                <?php if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); // Automatically generates <img> tag  ?>
                    </div>
                <?php endif; ?>
                <section class="entry-content">
                    <?php the_content(); ?>
                </section>
            </article>
    <?php 
            endwhile;
        endif;
    ?>        
</main>
<?php get_footer(); ?>