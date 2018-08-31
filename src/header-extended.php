<?php

/* @package fstheme
 *
 * This is the template for the header
 *
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?php wp_head(); ?>

</head>

<body class="mdc-typography">
<div class="background"></div>


<header id="header" class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall mdc-toolbar--flexible mdc-toolbar--flexible-default-behavior mdc-toolbar--flexible-space-maximized header-extended">
    <div class="mdc-toolbar__row mdc-toolbar__row-extended">
        <section class="mdc-toolbar__section menu_section" id="menu_section">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'navigation',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new Walker_Nav_Primary()
                )
            )
            ?>
            <!--a href="/wp-admin"><button id="loginBtn" class="menu_element mdc-button"><i class="material-icons md-18 mdc-button__icon">account_circle</i><span>Login</span></button></a-->

        </section>
        <section class="mdc-toolbar__section" id="logo_section">
            <a href="<?php get_site_url(); ?>"><div id="logo" class="mdc-toolbar__logo" /></a>
        </section>
        <section class="mdc-toolbar__section" id="title_section">
            <div>
                <span class="mdc-toolbar__title" id="title"><span id="inv">Willkommen in der </span>Fachschaft MPI</span>
            </div>
        </section>
    </div>


    <div class="arrow bounce" id="arrow"><a href="#content" id="scrolldown"><i class="material-icons">keyboard_arrow_down</i></a></div>
</header>