<?php

/* @package fstheme
 *
 * =======================
 * ADMIN ENQUEUE FUNCTIONS
 * =======================
 *
*/

function fs_load_admin_scripts( $hook ){

        wp_register_style( 'fs_admin', get_template_directory_uri() . '/assets/css/fs-admin.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'fs_admin' );

        wp_enqueue_media();

        wp_register_script( 'fs-admin-script', get_template_directory_uri() . '/assets/js/fs-admin.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'fs-admin-script' );

}
add_action( 'admin_enqueue_scripts', 'fs_load_admin_scripts' );



/* @package fstheme
 *
 * ==========================
 * FRONTEND ENQUEUE FUNCTIONS
 * ==========================
 *
*/

function fs_load_scripts(){
    wp_enqueue_script('material', get_template_directory_uri() . '/assets/js/material-components-web.js' );
    wp_enqueue_style( 'mdc-web-style', get_template_directory_uri() . '/assets/css/material-components-web.css' );
    wp_enqueue_style('fs', get_template_directory_uri() . '/assets/css/fs.css', array(), '1.0.0', 'all');

    wp_enqueue_style('dashicons');


    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js', false, '3.3.1', true );
    wp_enqueue_script( 'jquery' );

    // Move jquery to the footer
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

    wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js');

    wp_enqueue_script('scrollTo', get_template_directory_uri() . '/assets/js/jquery.scrollTo.js' );
    wp_scripts()->add_data('scrollTo', 'group', 1);
    wp_enqueue_script('watch', get_template_directory_uri() . '/assets/js/watch.js' );
    wp_scripts()->add_data('watch', 'group', 1);
    //wp_enqueue_script('material-icons', get_template_directory_uri() . '/js/material-icons.js' );
    //wp_scripts()->add_data('material-icons', 'group', 1);
    wp_enqueue_script('header', get_template_directory_uri() . '/assets/js/header.js' );
    wp_scripts()->add_data('header', 'group', 1);
}
add_action('wp_enqueue_scripts', 'fs_load_scripts');

function mdc_autoinit(){
    ?>
    <script type="text/javascript">window.mdc.autoInit();</script>
    <?php
}
add_action('wp_footer', 'mdc_autoinit');


function fs_login_stylesheet() {
    wp_enqueue_style( 'fs-login', get_template_directory_uri() . '/assets/css/fs-login.css' );
}
add_action( 'login_enqueue_scripts', 'fs_login_stylesheet' );
