<?php

/* @package fstheme
 *
 * =====================
 * Theme Support Options
 * =====================
 *
 */


function remove_admin_bar() {
    show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar');


function fs_register_nav_menu() {

    /*
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'extra-menu' => __('Extra Menu')
        )
    );
    */

    $menu_exists = wp_get_nav_menu_object( 'Header Menu' );
    if( !$menu_exists) {
        register_nav_menu('header-menu', __('Header Menu'));
        $menu_id = wp_create_nav_menu('FS Theme Header Menu');
        //var_dump($menu_id);

        wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'News',
                'menu-item-object-id' => get_page_by_title('News')->ID,
                'menu-item-classes' => 'line_style',
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type')
        );

        wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Aktive Vertreter',
                'menu-item-object-id' => get_page_by_title('Aktive Vertreter')->ID,
                'menu-item-classes' => 'face',
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type')
        );

        wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Keine Panik',
                'menu-item-object-id' => get_page_by_title('Keine Panik')->ID,
                'menu-item-classes' => 'help',
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type')
        );

        wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Livestream',
                'menu-item-object-id' => get_page_by_title('Livestream')->ID,
                'menu-item-classes' => 'help',
                'menu-item-object' => 'page',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'post_type')
        );

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Login'),
            'menu-item-classes' => 'fingerprint',
            'menu-item-url' => home_url( '/wp-admin'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom')
        );

        if( !has_nav_menu( 'header-menu' ) ){
            $locations = get_theme_mod('nav_menu_locations');
            $locations['header-menu'] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

}



function fs_register_default_pages() {

    //$menu = get_term_by('name', 'Header Menu', 'nav_menu')->term_id;
    //var_dump($menu);


    // Set Permalink to /%year%/%monthnum%/%postname%/
    // -------------------------------------------------
    if(get_option('permalink_structure') != '/%postname%/') {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        update_option( "rewrite_rules", FALSE );
        $wp_rewrite->flush_rules( true );
    }


    // Generate Home-Page and set is as default Frontpage
    // --------------------------------------------------
    $content = <<<EOT
Der alberne Troß der Universität Bayreuth begrüßt dich recht herzlich. Wir hoffen du findest dich auf unseren Seiten
gut zurecht. Falls du Fragen bzw. Anregungen an die Fachschaft richten möchtest, hier ist unsere E-Mail-Adresse:
fsmpi@uni-bayreuth.de Alle aktuellen Informationen, Veranstaltungsankündigungen und fakultätsinterne
Stellenausschreibungen findest du unter News.
EOT;

    if(get_page_by_title('Home') == NULL || get_page_by_title('Home')->post_status == 'trash') {
        $id = wp_insert_post(array(
            'post_title'     => 'Home',
            'post_name'      => 'Home',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => '1', // or "1" (super-admin?)
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_content'   => $content
        ));

        if($id == 0 || $id instanceof WP_Error) {
            echo '<script>alert("Fehler: '.$id.'");</script>';
        } else {

            // Set this Site as default Fron-Page
            update_option( 'page_on_front', $id );

            // Set static Page as default Option for the Front-Page
            update_option( 'show_on_front', 'page' );
        }
    }


    // Generate Page for Panik
    // --------------------------------------------------
    $content = <<<EOT
HelloWorld
EOT;

    if(get_page_by_title('Keine Panik') == NULL || get_page_by_title('Keine Panik')->post_status == 'trash') {
        $id = wp_insert_post(array(
            'post_title'     => 'Keine Panik',
            'post_name'      => 'Keine Panik',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => '1', // or "1" (super-admin?)
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_content'   => $content
        ));

        if($id == 0 || $id instanceof WP_Error) {
            echo '<script>alert("Fehler: '.$id.'");</script>';
        } else {

        }
    }


    // Generate Page for Livestream
    // --------------------------------------------------
    $content = <<<EOT
HelloWorld
EOT;

    if(get_page_by_title('Livestream') == NULL || get_page_by_title('Livestream')->post_status == 'trash') {
        $id = wp_insert_post(array(
            'post_title'     => 'Livestream',
            'post_name'      => 'Livestream',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => '1', // or "1" (super-admin?)
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_content'   => $content
        ));

        if($id == 0 || $id instanceof WP_Error) {
            echo '<script>alert("Fehler: '.$id.'");</script>';
        } else {

        }
    }


    // Generate News Page
    // ------------------------------
    if(get_page_by_title('News') == NULL || get_page_by_title('News')->post_status == 'trash') {
        $id = wp_insert_post(array(
            'post_title'     => 'News',
            'post_name'      => 'News',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => '1', // or "1" (super-admin?)
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed'
        ));

        if($id == 0 || $id instanceof WP_Error) {
            echo '<script>alert("Fehler: '.$id.'");</script>';
        } else {
            // Set this Site as default Blog page
            update_option( 'page_for_posts ', $id );
        }
    }


    // Generate Aktive-Vertreter Page
    // ------------------------------
    if(get_page_by_title('Aktive Vertreter') == NULL || get_page_by_title('Aktive Vertreter')->post_status == 'trash') {
        $id = wp_insert_post(array(
            'post_title'     => 'Aktive Vertreter',
            'post_name'      => 'Aktive Vertreter',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_author'    => '1', // or "1" (super-admin?)
            'post_type'      => 'page',
            'menu_order'     => 1,
            'comment_status' => 'closed',
            'ping_status'    => 'closed'
        ));

        if($id == 0 || $id instanceof WP_Error) {
            echo '<script>alert("Fehler: '.$id.'");</script>';
        } else {
            // Set this Site as default Blog page
            //update_option( 'page_for_posts ', $id );
        }
    }


}
add_action('init', 'fs_register_default_pages');
add_action('init', 'fs_register_nav_menu');

function twentyseventeen_setup() {
    add_theme_support( 'post-formats', array(
        'aside'
    ) );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );


/*
function fs_theme_setup() {

    if ( get_option( 'fs_theme_setup_completed' ) != 'completed' ) {


        // Set Permalink to /%year%/%monthnum%/%postname%/
        // -------------------------------------------------
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%year%/%monthnum%/%postname%/');
        update_option( "rewrite_rules", FALSE );
        $wp_rewrite->flush_rules( true );


        // Generate Home-Page and set is as default Frontpage
        // --------------------------------------------------
        $content = <<<EOT
Der alberne Troß der Universität Bayreuth begrüßt dich recht herzlich. Wir hoffen du findest dich auf unseren Seiten
gut zurecht. Falls du Fragen bzw. Anregungen an die Fachschaft richten möchtest, hier ist unsere E-Mail-Adresse:
fsmpi@uni-bayreuth.de Alle aktuellen Informationen, Veranstaltungsankündigungen und fakultätsinterne
Stellenausschreibungen findest du unter News.
EOT;

        if(get_page_by_title('Home') == NULL || get_page_by_title('Home')->post_status == 'trash') {
            $id = wp_insert_post(array(
                'post_title'     => 'Home',
                'post_name'      => 'Home',
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_author'    => '1', // or "1" (super-admin?)
                'post_type'      => 'page',
                'menu_order'     => 1,
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_content'   => $content
            ));

            if($id == 0 || $id instanceof WP_Error) {
                echo '<script>alert("Fehler: '.$id.'");</script>';
            } else {

                // Set this Site as default Fron-Page
                update_option( 'page_on_front', $id );

                // Set static Page as default Option for the Front-Page
                update_option( 'show_on_front', 'page' );
            }
        }


        // Generate News-Page and set is as default Blog-Page
        // --------------------------------------------------
        if(get_page_by_title('News') == NULL || get_page_by_title('News')->post_status == 'trash') {
            $id = wp_insert_post(array(
                'post_title'     => 'News',
                'post_name'      => 'News',
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_author'    => '1', // or "1" (super-admin?)
                'post_type'      => 'page',
                'menu_order'     => 1,
                'comment_status' => 'closed',
                'ping_status'    => 'closed'
            ));

            if($id == 0 || $id instanceof WP_Error) {
                echo '<script>alert("Fehler: '.$id.'");</script>';
            } else {

                // Set this Site as default Blog page
                update_option( 'page_for_posts ', $id );
            }
        }


        // Setup Theme Menu
        // -----------------
        $menu_name = 'fs-primary-navigation';
        $menu_exists = wp_get_nav_menu_object( $menu_name );
        if( !$menu_exists) {
            $menu_id = wp_create_nav_menu($menu_name);
            $menu = get_term_by('name', 'fs-primary-navigation', 'nav_menu');
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' =>  __('News'),
                'menu-item-classes' => 'line_style',
                'menu-item-url' => home_url( '/news/' ),
                'menu-item-status' => 'publish'));
            if( !has_nav_menu( 'Primary Navigation Menu' ) ) {
                $locations['Primary Navigation Menu'] = $menu;
                set_theme_mod('nav_menu_locations', $locations);
            }
        }

        $locations = get_theme_mod('nav_menu_locations');
        echo '<script>alert('.count($locations).')</script>';


        update_option( 'fs_theme_setup_completed', 'completed' );
    }
}
add_action( 'init', 'fs_theme_setup' );

*/