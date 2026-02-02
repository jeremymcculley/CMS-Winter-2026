<?php 
  // get_header() pulls your header.php file
  get_header();
  // Fetching the URL of the Featured Image for use as a background-image
  $featuredImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
<section class="post-masthead" style="background: url('<?php echo $featuredImg[0]; ?>')">
  <div>
    <h1><?php the_title(); ?></h1>
  </div>
</section>

<section class="main-body-content">
  <?php the_content(); ?>
</section>
<?php 
  get_footer();
?>