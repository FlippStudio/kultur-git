<?php /** Template Name: chat */ get_header(); ?>

<section id="contact">
  <div class="container">
  <?php if(is_user_logged_in()): if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; else: echo '<h2 class="text-center mt-5">Aby móc zobaczyć zawartość, <a href="' . esc_url(wp_login_url()) . '">zaloguj się </a></h2>'; endif; ?>
  </div>
</section>
<img src="<?php bloginfo('template_directory'); ?>/img/contact/background.png" alt="Obrazuje formularz kontaktowy - undraw.io" class="background-image d-xxl-block d-none">


<?php get_footer(); ?>