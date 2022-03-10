<?php get_header(); ?>

<section id="media">
    <div class="container" id="content">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">
                    <?php echo get_the_title(); ?>
                </h2>
                <div class="media-desc">
                    <div class="media-photo">
                    <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </div>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>
                    <br><br>Wróć do <a href="<?php echo get_page_link(96); ?>" style="color: #E60505;">aktualności</a> 
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>