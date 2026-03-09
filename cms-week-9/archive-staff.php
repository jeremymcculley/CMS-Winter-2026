<?php get_header(); ?>
<main id="main-content">
    <section class="row">
        <?php if (have_posts()) : while (have_posts()) : the_posts(); ?>
            <article class="col-sm-12 col-md-4 col-lg-4">
                <div>
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="member-bio">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <?php endwhile; endif; ?>
    </section>
</main>
<?php get_footer(); ?>