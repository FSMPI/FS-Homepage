<?php

/*
 * This is the template for the header
 * @package fs-theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if(is_singular() && pings_open(get_queried_object())): ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?php wp_head(); ?>

</head>

<body class="mdc-typography">
<div class="background"></div>

<aside class="mdc-drawer mdc-drawer--temporary mdc-typography" id="menu_mobile">
    <nav class="mdc-drawer__drawer">
        <header class="mdc-drawer__header">
            <div class="mdc-drawer__header-content">
                <a href="<?php get_site_url(); ?>">
                    <img style="align-self: center; -ms-flex-item-align: center; margin: auto;" src="<?php bloginfo('template_url') ?>/assets/img/tross_orange.png" />
                </a>
            </div>
        </header>
        <nav class="mdc-drawer__content mdc-list" id="menu_section_mobile">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'navigation-mobile mdc-list',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new Walker_Nav_Primary_Mobile()
                )
            )
            ?>
            <!--ul class="navigation">
                <li class="menu-item"><a href="/wp-admin"><i class="material-icons mdc-list-item__graphic">account_circle</i>Login</a></li>
            </ul-->
        </nav>
    </nav>
</aside>


<header id="header" class="mdc-toolbar mdc-toolbar--fixed">
    <div class="mdc-toolbar__row mdc-toolbar__row-default">
        <section class="mdc-toolbar__section logo_section mdc-toolbar__section--align-start">
            <a href="<?php get_home_url(); ?>"><div id="logo" class="mdc-toolbar__logo" style="background-image: url('<?php bloginfo('template_url') ?>/img/tross.svg'); background-size: contain; background-repeat: no-repeat;">

                </div></a>
            <span class="mdc-toolbar__title">Fachschaft MPI</span>
        </section>

        <section class="mdc-toolbar__section menu_section" id="menu_section_mobile">
            <button id="menuBtn" class="menu_element mdc-button"><i class="material-icons md-18 mdc-button__icon">menu</i></button>
        </section>
    </div>
</header>