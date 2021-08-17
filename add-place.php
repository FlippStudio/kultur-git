<?php /** Template Name: Zapronuj swoje miejsce */ get_header(); ?>

<section id="form-place" class="flex-center">
    <div class="container">
        <div class="partner-instruction mb-4">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif;?>
        </div>
        <?php echo do_shortcode( '[contact-form-7 id="93" title="form-zaproponuj miejsce"]' ); ?>
    </div>
</section>
<img src="<?php bloginfo('template_directory'); ?>/img/form/background.png" alt="Obrazuje formularz kontaktowy - undraw.io" class="background-image d-xxl-block d-none">
  

<?php get_footer(); ?>