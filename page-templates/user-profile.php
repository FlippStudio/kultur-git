<?php /** Template Name: profil użytkownika */ get_header(); $user = get_user_by('login', $_GET['nickname']); if ($user != ''): $user_meta = get_user_meta($user->ID); endif; ?>

<section id="events">

    <div class="container">
      <div class="row">

            <?php if($user != ''):?>  
                <div class="col-lg-4 mb-lg-0 mb-5">
                    <div class="user-photo flex-center">
                        <?php echo get_avatar($user->ID, '250', '', 'Zdjęcie profilowe użytkownika ' . $_GET['nickname'], array('class' => 'img-fluid rounded')); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="flex-start h-100">
                        <div class="user">
                            <div class="user-info">
                                <?php echo $user_meta['first_name'][0]; ?>
                            </div>
                            <div class="user-description">
                                Imię
                            </div>
                            <div class="user-info">
                                <?php $from = new DateTime($user_meta['date_birth'][0]); $to   = new DateTime('today'); echo $from->diff($to)->y; ?>
                            </div>
                            <div class="user-description">
                                Wiek
                            </div>
                            <div class="user-info">
                                <?php if($user_meta['gender'][0] == 'M'): echo 'Mężczyzna'; elseif($user_meta['gender'][0] == 'K'): echo 'Kobieta'; else: 'Nie podano'; endif; ?>
                            </div>
                            <div class="user-description">
                                Płeć
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="flex-start h-100">
                        <div class="user">
                            <div class="user-info">
                                <?php if($user_meta['type'][0] == 'O'): echo 'Potencjalny opiekun'; elseif($user_meta['type'][0] == 'N'): echo 'Osoba niepełnosprawna'; endif; ?>
                            </div>
                            <div class="user-description">
                                Typ użytkownika
                            </div>
                            <div class="user-info">
                                <?php if($user_meta['bpbm_last_activity'][0] != ''): echo $user_meta['bpbm_last_activity'][0]; else: echo 'Brak informacji'; endif; ?>
                            </div>
                            <div class="user-description">
                                Ostatnia aktywność
                            </div>
                        </div>
                    </div>
                </div>
            <? else: ?>
                <h1 class="text-center mt-4">Przykro nam, ale nie ma takiego użytkownika.</h1>
            <?php endif; wp_reset_postdata(); ?>
            <div class="col-12 mt-5">
                Wróć do <a href="<?php if($user_meta['type'][0] == 'O'): echo get_page_link(265); else: echo get_page_link(263); endif; ?>" style="color: #E60505;"><?php if($user_meta['type'][0] == 'O'): echo get_the_title(265); else: echo get_the_title(263); endif; ?></a>
            </div> 
      </div>
    </div>
  </section>
  <img src="<?php bloginfo('template_directory'); ?>/img/events/background.png" alt="Obrazuje kalendarz z eventami - undraw.io" class="background-image d-xxl-block d-none">
  

<?php get_footer(); ?>