<!DOCTYPE html>
<html>
<head>
    <title>Tomoe Summer Camping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo theme_uri()?>/assets/style/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo theme_uri()?>/assets/style/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo theme_uri()?>/assets/style/css/style.css"/>
    <link rel="stylesheet" href="<?php echo theme_uri()?>/assets/style/css/mobile.css"/>
    <link rel="icon" type="image/x-icon" href="<?php echo theme_uri()?>/assets/images/global/logo-teh.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php wp_head(); ?>
</head>
<body <?php itd_body_id() ?>>
<?php wp_body_open(); ?>
<header id="header" class="navigation">
    <div class="container">
        <div class="navigation-wrap">
            <div class="navigation-left">
                <div class="logo">
                    <a href="#">
                        <img src="<?php echo theme_uri()?>/assets/images/global/logo-teh-v3.svg" alt="Tomoe English House Logo">
                    </a>
                </div>
            </div>
            <div class="navigation-right">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'header_navigation',
                    'menu_class' => 'navigation-list menu mx-3 my-2',
                ));
                ?>
            </div>
        </div>
    </div>
</header>

<header class="header-mobile">
    <div class="container">
        <div class="navigation-wrap-mobile">
            <div class="nav-mobile navigation-left-mobile">
                <i class="fa fa-bars text-white" aria-hidden="true"></i>
            </div>
            <div class="navigation-center-mobile">
                <div class="logo-mobile">
                    <a href="#">
                        <img src="/wp-content/themes/main/assets/images/global/logo-teh-v3.svg" alt="Tomoe English House Logo">
                    </a>
                </div>
            </div>
            <div class="nav-mobile navigation-right-mobile">
                <i class="fa fa-times text-white" aria-hidden="true"></i>
            </div>
            <div class="navigation-mobile">
                <div class="opacityBody"></div>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'header_navigation',
                    'menu_class' => 'navigation-list-mobile menu',
                ));
                ?>
            </div>
        </div>
    </div>
</header>