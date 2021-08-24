<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#292222">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/main.css">
    <title><?php bloginfo('Title') ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/contrast.css" disabled>
</head>

<body <?php body_class(); ?>>
<ul class="nav-wcag">
    <li>
        <a href="#menu" tabindex="1">Przejdź do menu</a>
    </li>
    <li>
        <a href="#aktualności" tabindex="2">Przejdź do aktualności</a>
    </li>
    <li>
        <a href="#stopka" tabindex="3">Przejdź do stopki</a>
    </li>
</ul>
    <nav class="navbar navbar-expand-xl navbar-light fixed-top">
        <div class="container position-relative">
            <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                <img src="<?php bloginfo('template_directory'); ?>/img/logo.svg" alt="Logo portalu KulturLove" class="img-fluid d-sm-block d-none normal">
                <img src="<?php bloginfo('template_directory'); ?>/img/logo-sm.svg" alt="Logo portalu KulturLove" class="img-fluid d-sm-none normal">
            </a>
            <div class="top-bar d-xl-none d-flex">
                <div id="increase-font">
                    <img src="<?php bloginfo('template_directory'); ?>/img/nav/plus.svg" alt="Powiększenie czcionki">
                </div>
                <div id="descrease-font">
                    <img src="<?php bloginfo('template_directory'); ?>/img/nav/minus.svg" alt="Zmniejszenie czcionki">
                </div>
                <div id="contrast">
                    <img src="<?php bloginfo('template_directory'); ?>/img/nav/contrast.svg" alt="Zmiana kontrastu">
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-bar"></span>
                <span class="toggler-bar"></span>
                <span class="toggler-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end flex-column align-self-start" id="navbarNav">
                <div class="top-bar d-xl-flex d-none">
                    <div id="increase-font">
                        <img src="<?php bloginfo('template_directory'); ?>/img/nav/plus.svg" alt="Powiększenie czcionki" tabindex=0>
                    </div>
                    <div id="descrease-font">
                        <img src="<?php bloginfo('template_directory'); ?>/img/nav/minus.svg" alt="Zmniejszenie czcionki" tabindex=0>
                    </div>
                    <div id="contrast">
                        <img src="<?php bloginfo('template_directory'); ?>/img/nav/contrast.svg" alt="Zmiana kontrastu" tabindex=0>
                    </div>
                    <div id="sign-in">
                        <a href="<?php echo esc_url(wp_login_url()); ?>">ZALOGUJ SIĘ</a>
                    </div>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="drop1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo get_the_title(94); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="drop1">
                            <?php
                            $children = get_page_children(94, get_pages(array('post_type' => 'page', 'sort_column' => 'ID')));
                            foreach ($children as $child) : ?>
                                <li><a class="dropdown-item" href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="drop2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo get_the_title(168); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="drop2">
                            <li><a class="dropdown-item" href="#">Dodane przez niepełnosprawnych</a></li>
                            <li><a class="dropdown-item" href="#">Dodane przez opiekunów</a></li>
                            <li><a class="dropdown-item" href="#">Dodaj spotkanie i wydarzenie</a></li>
                            <?php
                            $children = get_page_children(168, get_pages(array('post_type' => 'page', 'sort_column' => 'ID')));
                            foreach ($children as $child) : ?>
                                <li><a class="dropdown-item" href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                            <?php endforeach; ?>
                            <li><a class="dropdown-item" href="<?php echo get_term_link(8, 'subjects'); ?>">Ogólna dyskusja</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="drop3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo get_the_title(83); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="drop3">
                            <?php
                            $children = get_page_children(83, get_pages(array('post_type' => 'page', 'sort_column' => 'ID')));
                            foreach ($children as $child) : ?>
                                <li><a class="dropdown-item" href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="drop4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo get_the_title(143); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="drop4">
                            <li><a class="dropdown-item" href="<?php echo get_page_link(145); ?>"><?php echo get_the_title(145); ?></a></li>
                            <li><a class="dropdown-item" href="<?php echo wp_get_attachment_url(79); ?>" target="_blank">Regulamin</a></li>
                            <li><a class="dropdown-item" href="<?php echo wp_get_attachment_url(80); ?>" target="_blank">Polityka prywatności</a></li>
                            <li><a class="dropdown-item" href="<?php echo wp_get_attachment_url(82); ?>" target="_blank">Polityka Cookies</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_page_link(147); ?>"><?php echo get_the_title(147); ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_page_link(50); ?>"><?php echo get_the_title(50); ?></a>
                    </li>
                    <li class="nav-item d-xl-none d-flex sign-in">
                        <a class="nav-link" href="#">ZALOGUJ SIĘ</a>
                    </li>
                </ul>
            </div>
            <img src="<?php bloginfo('template_directory'); ?>/img/nav/menu-back-xxl.png" alt="Tło pod menu" class="menu-back">
            <img src="<?php bloginfo('template_directory'); ?>/img/nav/menu-back-contrast.png" alt="Tło pod menu - kontrast" class="menu-back contrast">
        </div>
    </nav>
    <?php if (!is_front_page()) : ?>
        <section id="page-title">
            <div class="container position-relative">
                <div class="d-flex">
                    <h1 class="page-title ms-auto">
                        <?php if(is_tax() || is_singular()): echo 'Forum'; elseif (is_home() || is_archive() || is_single()) : echo 'Aktualności'; elseif (is_404()): echo 'Błąd 404'; else : echo get_the_title(); endif; ?>
                    </h1>
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/img/bar.png" alt="Tło pod tytuł strony" class="title-bar">
                <img src="<?php bloginfo('template_directory'); ?>/img/bar-contrast.png" alt="Tło pod tytuł strony - kontrast" class="title-bar contrast">
            </div>
        </section>
    <?php endif; ?>