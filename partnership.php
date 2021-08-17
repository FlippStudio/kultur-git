<?php /** Template Name: partnerzy strategiczni */ get_header(); ?>

<section id="partner-sec">
    <div class="container">
      <div class="row">

      <?php
            $arg = array(
                'post_type' => 'partner',
                'posts_per_page' => '-1',
                'tax_query' => array(
                    array (
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => 2,
                    )
                ),
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            $my_query = new WP_Query($arg); ?>

            <?php if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post(); ?>
                    <?php $ph = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-fluid' ) ); if($ph): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="partner">
                                <div class="partner-logo flex-center">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                                </div>
                                <div class="partner-name flex-center">
                                <?php echo get_the_title(); ?>
                                </div>
                                <div class="partner-desc flex-center">
                                <?php echo get_field('krotki_opis_partnera'); ?>
                                </div>
                            </div>
                        </div>
            <?php endif;
                endwhile;
            endif;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <img src="<?php bloginfo('template_directory'); ?>/img/partnership/background.png" alt="Obrazuje formularz kontaktowy - undraw.io" class="background-image d-xxl-block d-none">
  

<?php get_footer(); ?>