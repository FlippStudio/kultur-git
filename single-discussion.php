<?php get_header(); $page = get_queried_object(); $term_list = get_the_terms($page->ID, 'subjects'); $size = count($term_list); $comments = get_comments(array('post_id' => $page->ID, 'orderby' => 'date', 'order' => 'ASC', 'status' => 'approve', 'parent' => 0)); ?>

<section id="media">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrubs mb-2">
                    <?php echo get_the_term_list( $page->ID, 'subjects', 'Forum / ', ' / ' ); echo ' / ' . $page->post_title; ?>
                </div>
                <div class="comment-link mb-3">
                    <a href="#comments">Przejdź do sekcji komentarzy. Ilość: <?php echo $page->comment_count; ?></a>
                </div>
                <h2 class="text-center mb-4">
                    <?php echo get_the_title(); ?>
                </h2>
                <div class="media-desc">
                    <?php if(get_the_post_thumbnail( $page->ID, 'large')): ?>
                    <div class="media-photo">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </div>
                    <?php endif; if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>

                    <br><br>Wróć do <a href="<?php echo get_term_link($term_list[$size - 1]->term_id); ?>" style="color: #E60505;"><?php echo $term_list[$size - 1]->name; ?></a>
                </div>
            </div>
        </div>
        <?php comments_template(); ?>
    </div>
</section>

<?php get_footer(); ?>