<?php

/* @package fs-theme
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?php wp_head(); ?>

</head>

<body class="mdc-typography">
<div class="background"></div>


<header id="header" class="mdc-toolbar mdc-toolbar--fixed header-default">
    <div class="mdc-toolbar__row mdc-toolbar__row-default">
        <section class="mdc-toolbar__section logo_section mdc-toolbar__section--align-start">
            <a href="<?php get_site_url(); ?>">
                <div id="logo" class="mdc-toolbar__logo" style="background-image: url('<?php bloginfo('template_url') ?>/assets/img/tross.svg'); background-size: contain; background-repeat: no-repeat;"></div>
            </a>
            <span class="mdc-toolbar__title">Fachschaft MPI</span>
        </section>
        <section class="mdc-toolbar__section menu_section mdc-toolbar__section--align-end" id="menu_section">
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

        </section>

    </div>
</header>