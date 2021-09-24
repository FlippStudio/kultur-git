<?php get_header(); $page = get_queried_object(); ?>

<section id="media">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">
                    <?php echo get_the_title(); ?>
                </h2>
                <h6 class="text-center mb-4">
                  <strong>Lokalizacja: </strong><?php echo get_field('lokalizacje'); ?>
                </h6>
                <div class="media-desc">
                    <?php if(get_the_post_thumbnail( $page->ID, 'medium_large')): ?>
                    <div class="media-photo">
                        <?php the_post_thumbnail('medium_large', array('class' => 'img-fluid rounded border border-danger')); ?>
                    </div>
                    <?php endif; if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>
                    
                    <br><br>Wróć do <a href="<?php echo get_page_link(170); ?>" style="color: #E60505;"><?php echo get_the_title(170); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>