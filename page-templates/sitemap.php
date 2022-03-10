<?php /** Template Name: Mapa serwisu */ get_header(); ?>

<section id="sitemap">
    <div class="container mt-5" id="content">
        <ul>
            <li>
                <a href="<?php bloginfo('url'); ?>">Strona główna</a>
            </li>
            <li>
                <a href="<?php echo get_page_link(96); ?>"><?php echo get_the_title(94); ?></a>
                <ul>
                    <?php
                        $children = get_page_children(94, get_pages(array('post_type' => 'page', 'sort_column' => 'menu_order')));
                        foreach ($children as $child) : ?>
                            <li><a href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo get_page_link(263); ?>"><?php echo get_the_title(168); ?></a>
                <ul>
                <li><a href="<?php echo admin_url('post-new.php?post_type=meeting'); ?>">Dodaj spotkanie i wydarzenie</a></li>
                <?php
                    $children = get_page_children(168, get_pages(array('post_type' => 'page', 'sort_column' => 'menu_order')));
                    foreach ($children as $child) : ?>
                        <li><a href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="<?php echo get_term_link(8, 'subjects'); ?>">Ogólna dyskusja</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo get_page_link(170); ?>"><?php echo get_the_title(83); ?></a>
                <ul>
                    <?php
                        $children = get_page_children(83, get_pages(array('post_type' => 'page', 'sort_column' => 'menu_order')));
                        foreach ($children as $child) : ?>
                            <li><a href="<?php echo get_page_link($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo wp_get_attachment_url(414); ?>"><?php echo get_the_title(143); ?></a>
                <ul>
                    <li><a href="<?php echo wp_get_attachment_url(414); ?>" target="_blank" rel="noopener noreferrer">Instrukcja korzystania z portalu</a></li>
                    <li><a href="<?php echo wp_get_attachment_url(79); ?>" target="_blank" rel="noopener noreferrer">Regulamin</a></li>
                    <li><a href="<?php echo wp_get_attachment_url(80); ?>" target="_blank" rel="noopener noreferrer">Polityka prywatności</a></li>
                    <li><a href="<?php echo wp_get_attachment_url(82); ?>" target="_blank" rel="noopener noreferrer">Polityka Cookies</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo get_page_link(50); ?>"><?php echo get_the_title(50); ?></a>
            </li>
            <li>
                <a href="<?php if(is_user_logged_in()): echo esc_url(admin_url()); else: echo esc_url(wp_login_url()); endif; ?>"><?php if(is_user_logged_in()): echo 'Mój profil'; else: echo 'Zaloguj się '; endif; ?></a>
            </li>
            <?php if(is_user_logged_in()): ?>
            <li>
                <a href="<?php echo get_page_link(311); ?>"><?php echo get_the_title(311); ?></a>
            </li>
            <?php endif; ?>
            <li>
                <a href="https://www.facebook.com/Spotkania-KulturLove-107291411714622/" tabindex=0>Facebook</a>
            </li>
        </ul>
    </div>
</section>

<?php get_footer(); ?>