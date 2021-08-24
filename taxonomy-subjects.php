<?php get_header(); $page = get_queried_object(); //print_r($page); ?>

<section id="forum">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="breadcrubs">
                Forum / 
                <?php if($page->parent != 0): ?>
                    <a href="<?php echo get_term_link($page->parent, 'subjects'); ?>">Ogólne</a> / <a href="<?php echo get_term_link($page->term_id, 'subjects'); ?>"><?php echo $page->name; ?></a>
                <?php else: ?>
                    <a href="<?php echo get_term_link($page->term_id, 'subjects'); ?>"><?php echo $page->name; ?></a>
                <?php endif; ?>
                </div>
            </div>

<?php if(is_tax('subjects', 8)): 

$terms = get_terms( array('taxonomy' => 'subjects', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC', 'parent' => $page->term_id ) ); ?>

        <?php foreach($terms as $term): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?php echo get_term_link($term->term_id); ?>">
                    <div class="thread">
                        <h2 class="forum-title">
                            <?php echo $term->name; ?>
                        </h2>
                        <div class="forum-post-amount">
                            Ilość wątków: <?php echo $term->count; ?>
                        </div>
                        <div class="forum-desc">
                            <?php echo $term->description; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

<?php else: ?>

    <?php
            $arg = array(
                'post_type' => 'discussion',
                'posts_per_page' => '-1',
                'tax_query' => array(
                    array (
                        'taxonomy' => 'subjects',
                        'field' => 'term_id',
                        'terms' => $page->term_id,
                    )
                ),
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            $my_query = new WP_Query($arg); ?>

            <?php if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post(); ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="thread">
                                    <h2 class="forum-title">
                                        <?php echo get_the_title(); ?>
                                    </h2>
                                    <div class="forum-post-amount">
                                        Ilość komentarzy: <?php echo get_comments_number(); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
            <?php 
                endwhile;
            endif;
            wp_reset_postdata(); ?>

<?php endif; ?>

        </div>
    </div>
</section>


<?php get_footer(); ?>