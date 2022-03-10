<?php get_header(); ?>

<section id="media">
    <div class="container" id="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    $ph = get_the_post_thumbnail(NULL, 'thumbnail', array( 'class' => 'img-fluid rounded' ) ); if($ph): ?>
      <div class="media mb-4">
        <div class="row">
          <div class="col-md-6">
            <div class="flex-center">
              <a href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
              </a>
            </div>
          </div>
          <div class="col-md-6">
              <div class="media-flex">
                <div class="flex-end">
                <a href="<?php echo get_permalink(); ?>">
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
                <div class="flex-center media-h">
                <div class="media-desc">
                    <?php echo wp_trim_words(get_the_content(), '35');?>
                </div>
                </div>
                <a href="<?php echo get_permalink(); ?>">
                <div class="media-btn">
                    Zobacz informacje
                </div>
                </a>
              </div>
          </div>
        </div>
      </div>
    <?php endif; endwhile; endif; ?>
    </div>
  </section>
  <img src="<?php bloginfo('template_directory'); ?>/img/news/background.png" alt="Obrazuje nowe wiadomości ze świata - undraw.io" class="background-image d-xxl-block d-none">


<?php get_footer(); ?>