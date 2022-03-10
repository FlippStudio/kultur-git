<?php /** Template Name: dodane przez opiekunów */ get_header(); ?>

<section id="events">

    <div class="container" id="content">
      <div class="row">

      <?php
        $posts = get_posts(array(
            'numberposts' => '-1',
            'post_type' => 'meeting'
        ));
        $flag = false;
        foreach($posts as $post):
            if(get_user_meta( $post->post_author, 'type', true) == 'O' && $post->post_status != 'closed' && get_field('aktywne', $post->ID) == 1):
                $flag = true;
                break;
            endif;
        endforeach;

            $arg = array(
                'post_type' => 'meeting',
                'posts_per_page' => '-1',
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish'
            );

            $my_query = new WP_Query($arg); 
            
            ?>

            <?php if($flag):
            
            if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post(); ?>
                    <?php if(get_user_meta( $my_query->post->post_author, 'type', true) == 'O' && $my_query->post->post_status != 'closed'): ?>
                        <div class="col-lg-6 mb-4">
                            <div class="event">
                                <div class="event-title flex-center">
                                    <?php echo get_the_title(); ?> 
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Tytuł wydarzenia / spotkania</span>
                                </div>
                                <div class="event-info flex-center">
                                    <?php echo get_field('rodzaj_wyjscia');?>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Rodzaj wyjścia</span>
                                </div>
                                <div class="event-info flex-center">
                                    <?php $date = get_field('data_i_godzina_rozpoczecia'); echo $date; if (get_field('data_i_godzina_zakonczenia')): echo ' - ' . substr(get_field('data_i_godzina_zakonczenia'), -5); endif; ?> 
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Data i orientacyjny czas wyjścia</span>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Adres wydarzenia</span>
                                </div>
                                <div class="event-info flex-center">
                                    <?php echo get_field('miejsca__adres_wydarzenia'); ?>
                                </div>
                                <div class="event-info flex-center">
                                    <?php echo get_field('wybor_miejsca_wydarzenia'); ?>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Miejsce wydarzenia</span>
                                </div>
                                <?php if(get_field('nazwa_innego_wydarzenia')  != ''): ?>
                                <div class="event-info flex-center">
                                    <?php echo get_field('nazwa_innego_wydarzenia'); ?>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Nazwa miejsca własnego wydarzenia</span>
                                </div>
                                <?php endif; if(get_field('uwagi') != ''): ?>
                                <div class="event-info flex-center">
                                    <?php echo get_field('uwagi'); ?>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Uwagi</span>
                                </div>
                                <?php endif; if(is_user_logged_in() && $my_query->post->post_author != get_current_user_id()): ?>
                                <a href="<?php echo get_page_link(357) . '?nickname=' . get_the_author_meta( 'nickname', $my_query->post->post_author); ?>" class="btn-user-info">Informacje o użytkowniku</a>
                                <?php endif; if(is_user_logged_in() && $my_query->post->post_author != get_current_user_id()): echo do_shortcode('[bp_better_messages_pm_button text="Wyślij wiadomość" subject="' . get_the_title() . '" message="Cześć, jestem zainteresowany wspólnym wyjściem." target="_self" class="btn-event" fast_start="0"]'); endif;?>
                            </div>
                        </div>
            <?php endif;
                endwhile;
            endif; else: ?>
                <h1 class="text-center mt-4">Brak aktualnych wydarzeń</h1>
            <?php endif; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <img src="<?php bloginfo('template_directory'); ?>/img/events/background.png" alt="Obrazuje kalendarz z eventami - undraw.io" class="background-image d-xxl-block d-none">
  

<?php get_footer(); ?>