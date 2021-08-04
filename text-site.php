<?php /** Template Name: podstrona tekstowa */ get_header(); ?>

<section id="text-sec">
    <div class="container">
      <div class="text-desc">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>
      </div>
    </div>
  </section>
  <img src="<?php bloginfo('template_directory'); ?>/img/text/background.png" alt="Obrazuje podstrone tekstową - undraw.io" class="background-image d-xxl-block d-none">

<?php get_footer(); ?>