<?php /** Template Name: informacje medialne */ get_header(); ?>

<section id="partner-sec">
    <div class="container">
      <div class="row">

      <?php
            $arg = array(
                'post_type' => 'media',
                'posts_per_page' => '-1',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $my_query = new WP_Query($arg); ?>

            <?php if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post(); ?>
                    <?php $ph = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-fluid' ) ); if($ph): ?>
                        <div class="media mb-4">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="flex-center">
                                <a href="<?php echo get_field('link_do_wpisu'); ?>" target="_blank">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded border border-danger')); ?>
                                </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media-flex">
                                    <div class="flex-end">
                                    <a href="<?php echo get_field('link_do_wpisu'); ?>" target="_blank">
                                        <h2 class="media-title">
                                            <?php echo get_the_title(); ?>
                                        </h2>
                                    </a>
                                    </div>
                                    <div class="flex-end">
                                        <div class="media-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                    <a href="<?php echo get_field('link_do_wpisu'); ?>" target="_blank" class="mt-auto">
                                    <div class="media-btn">
                                        Zobacz informacje
                                    </div>
                                    </a>
                                </div>
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