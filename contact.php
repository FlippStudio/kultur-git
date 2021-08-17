<?php /** Template Name: kontakt */ get_header(); ?>

<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="c-title text-center mb-3">Autor innowacji</h2>
        <div class="c-info">
          <span>Adres:</span> <?php the_field('adres_1'); ?>
        </div>
        <div class="c-info">
          <span>NIP:</span> <?php the_field('nip_1'); ?>
        </div>
        <div class="c-info">
          <span>REGON:</span> <?php the_field('regon_1'); ?>
        </div>
        <div class="c-info">
          <span>KRS:</span> <?php the_field('krs'); ?>
        </div>
        <div class="c-info">
          <span>Telefon:</span> <a href="tel:<?php the_field('telefon_1'); ?> "> <?php the_field('telefon_1'); ?> </a> 
        </div>
        <div class="c-info">
          <span>Telefon:</span> <a href="tel:731000169"><?php the_field('telefon_2'); ?></a>
        </div>
        <div class="c-info">
          <span>Strona:</span> <a href="<?php the_field('strona_1'); ?>"><?php the_field('strona_1'); ?></a> 
        </div>
        <div class="c-info">
          <span>Email:</span> <a href="mailto:<?php the_field('email_1'); ?>"><?php the_field('email_1'); ?></a> 
        </div>
        <div class="flex-center mt-4">
            <?php $ph = get_field('logo_1'); ?>
          <img src="<?php echo $ph['url']; ?>" alt="<?php echo $ph['alt']; ?>" class="img-fluid">
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="c-title text-center mb-3">Inkubator innowacji</h2>
        <div class="c-info">
          <span>Adres:</span> <?php the_field('adres_2'); ?>
        </div>
        <div class="c-info">
          <span>NIP:</span> <?php the_field('nip_2'); ?>
        </div>
        <div class="c-info">
          <span>REGON:</span> <?php the_field('regon_2'); ?>
        </div>
        <div class="c-info">
          <span>Telefon:</span> <a href="tel:<?php the_field('telefon_3'); ?>"><?php the_field('telefon_3'); ?></a> 
        </div>
        <div class="c-info">
          <span>Telefon:</span> <a href="tel:<?php the_field('telefon_4'); ?>"><?php the_field('telefon_4'); ?></a> 
        </div>
        <div class="c-info">
          <span>Telefon:</span> <a href="tel:<?php the_field('telefon_5'); ?>"><?php the_field('telefon_5'); ?></a>
        </div>
        <div class="c-info">
          <span>Strona:</span> <a href="<?php the_field('strona_2'); ?>"><?php the_field('strona_2'); ?></a> 
        </div>
        <div class="c-info">
          <span>Email:</span> <a href="mailto:<?php the_field('email_2'); ?>"><?php the_field('email_2'); ?></a> 
        </div>
        <div class="flex-center mt-4">
          <?php $ph = get_field('logo_2'); ?>
          <img src="<?php echo $ph['url']; ?>" alt="<?php echo $ph['alt']; ?>" class="img-fluid"></div>
      </div>
    </div>
  </div>
</section>
<section id="form">
  <div class="container">
      <?php echo do_shortcode( '[contact-form-7 id="74" title="form-kontakt"]' ); ?>
  </div>
</section>
<img src="<?php bloginfo('template_directory'); ?>/img/contact/background.png" alt="Obrazuje formularz kontaktowy - undraw.io" class="background-image d-xxl-block d-none">


<?php get_footer(); ?>