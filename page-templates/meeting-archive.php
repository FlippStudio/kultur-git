<?php /** Template Name: Historia spotkań */ get_header(); ?>

<?php if(is_user_logged_in()): ?>
<section id="events">
    <div class="container" id="content">
      <div class="row">

      <?php
        global $current_user;
            $arg = array(
                'post_type' => 'meeting',
                'posts_per_page' => '-1',
                'orderby' => 'date',
                'order' => 'DESC',
                'author' => $current_user->ID,
            );

            $my_query = new WP_Query($arg); 
            
            $flag = false;
            foreach($my_query->posts as $post):
                if($post->post_status == 'closed'):
                    $flag = true;
                    break;
                endif;
            endforeach;

            ?>

            <?php if($flag):
            
            if ($my_query->have_posts()) :

                while ($my_query->have_posts()) :

                    $my_query->the_post(); if($my_query->post->post_status == 'closed'): ?>
                        <div class="col-lg-6 mb-4">
                            <div class="event">
                                <div class="event-title flex-center">
                                    <?php echo get_the_title(); ?> 
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Tytuł wydarzenia / spotkania</span>
                                </div>
                                <div class="event-info flex-center">
                                    <?php echo get_field('rodzaj_wyjscia'); ?>
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Rodzaj wyjścia</span>
                                </div>
                                <div class="event-info flex-center">
                                    <?php $date = get_field('data_i_godzina_rozpoczecia'); echo $date . ' - ' . substr(get_field('data_i_godzina_zakonczenia'), -5); ?> 
                                </div>
                                <div class="flex-center mb-3">
                                    <span class="event-desc">Data i orientacyjna godzina trwania wyjścia</span>
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
                                <?php endif; ?>

                            </div>
                        </div>
            <?php endif;
                endwhile;
            endif; else: echo '<h2 class="text-center mt-5">Brak spotkań</h2>'; endif;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php else: echo '<h2 class="text-center mt-5">Aby móc zobaczyć zawartość, <a href="' . esc_url(wp_login_url()) . '">zaloguj się </a></h2>'; endif; ?>
  <img src="<?php bloginfo('template_directory'); ?>/img/partnership/background.png" alt="Obrazuje formularz kontaktowy - undraw.io" class="background-image d-xxl-block d-none">
  

<?php get_footer(); ?>