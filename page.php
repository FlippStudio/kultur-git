<?php get_header(); ?>

<section id="slider" class="d-sm-block d-none">
    <div class="container position-relative d-xl-block d-none">
        <img src="<?php bloginfo('template_directory'); ?>/img/main/slider/slider-back-xxl.png" alt="Tło slidera" class="slider-back">
        <img src="<?php bloginfo('template_directory'); ?>/img/main/slider/slider-back-contrast.png" alt="Tło slidera - kontrast" class="slider-back contrast">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <?php

            $arg = array(
                'post_type' => 'slider',
                'posts_per_page' => '-1',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            $my_query = new WP_Query($arg); ?>
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < $my_query->found_posts; $i++) : ?>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i == 0) : echo "class=\"active\"";
                                                                                                            endif; ?> aria-current="true" aria-label="Slide <?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner">
                <?php if ($my_query->have_posts()) :

                    while ($my_query->have_posts()) :

                        $my_query->the_post();

                        $ph = get_field('obraz');
                        if ($ph) : ?>
                            <div class="carousel-item <?php if ($my_query->current_post == 0) : echo 'active';
                                                        endif; ?>" data-bs-interval="5000">
                                <img src="<?php echo $ph['url'] ?>" class="d-block" alt="<?php echo $ph['alt']; ?>">
                                <div class="container position-relative">
                                    <div class="carousel-caption">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                            </div>

                <?php endif;
                    endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <div id="carousel-small" class="carousel slide d-xl-none d-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post();

                    $ph = get_field('obraz');
                    if ($ph) : ?>
                        <div class="carousel-item <?php if ($my_query->current_post == 0) : echo 'active';
                                                    endif; ?>" data-bs-interval="5000">
                            <img src="<?php echo $ph['url'] ?>" class="img-fluid" alt="<?php echo $ph['alt']; ?>">
                            <div class="container position-relative">
                                <div class="carousel-caption">
                                    <?php the_title(); ?>
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
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-12 order-1">
                <h2 class="m-title">
                    <?php the_field('o_tytul'); ?>
                </h2>
            </div>
            <div class="col-xxl-4 col-lg-5 order-2">
                <div class="photo-about">
                    <?php $ph1 = get_field('obraz_1');
                    $ph2 = get_field('obraz_2');
                    $ph3 = get_field('obraz_3'); ?>
                    <img src="<?php echo $ph1['url']; ?>" alt="<?php echo $ph1['alt']; ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-xxl-8 col-lg-7 order-3">
                <div class="flex-about">
                    <div class="text-about">
                        <?php the_field('opis_1'); ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-lg-7 order-lg-4 order-5">
                <div class="flex-about">
                    <div class="text-about">
                        <?php the_field('opis_2'); ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5 order-lg-5 order-4">
                <div class="photo-about">
                    <img src="<?php echo $ph2['url']; ?>" alt="<?php echo $ph2['alt']; ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5 order-5">
                <div class="photo-about">
                    <img src="<?php echo $ph3['url']; ?>" alt="<?php echo $ph3['alt']; ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-xxl-8 col-lg-7 order-5">
                <div class="flex-about">
                    <div class="text-about">
                        <?php the_field('opis_3'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="news">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="m-title">
                    Aktualności
                </h2>
            </div>
            <?php

            $arg = array(
                'post_type' => 'post',
                'posts_per_page' => '3',
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $my_query = new WP_Query($arg); ?>


            <?php if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post();

                    $ph = get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'img-fluid' ) ); if($ph): ?>
                        <div class="col-lg-4 col-sm-6 <?php if ($my_query->current_post == 1) : echo 'd-sm-block d-none'; elseif($my_query->current_post == 2): echo 'd-lg-block d-none';
                                                    endif; ?>">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="news">
                                    <div class="photo-news flex-center">
                                        <div class="blackout flex-center">
                                            <div class="click-it">
                                                <img src="<?php bloginfo('template_directory'); ?>/img/main/news/tap.svg" alt="Kliknij, aby sprawdzić zawartość">
                                            </div>
                                        </div>
                                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                                    </div>
                                    <div class="title-news flex-center">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                            </a>
                        </div>

            <?php endif;
                endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<section id="partnership" class="d-sm-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="m-title">
                    Partnerzy strategiczni
                </h2>
            </div>
            <?php

            $arg = array(
                'post_type' => 'partner',
                'posts_per_page' => '8',
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
                    <div class="col-lg-3 col-sm-4 mb-2">
                        <div class="photo-partner flex-center h-100">
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                        </div>
                    </div>
            <?php endif;
                endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>