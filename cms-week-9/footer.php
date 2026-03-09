    <footer>
      <section class="top-footer">
        <div class="first widget-area">
          <a href="<?php echo esc_url( home_url() );?>">
            <?php dynamic_sidebar( 'footer-widget-area-one' ); ?>
          </a>
        </div><!-- .first .widget-area -->

        <div class="second quarter widget-area">
          <?php dynamic_sidebar( 'footer-widget-area-two' ); ?>
        </div><!-- .second .widget-area -->

        <div class="third widget-area">
          <?php dynamic_sidebar( 'footer-widget-area-three' ); ?>
        </div><!-- .third .widget-area -->

        <div class="fourth widget-area">
          <?php dynamic_sidebar( 'footer-widget-area-four' ); ?>
        </div><!-- .fourth .widget-area -->
      </section>
    </footer>
  </body>
</html>