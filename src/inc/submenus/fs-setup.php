<?php

$messages = array(
        0 => 'OK',
        1 => 'WARNUNG - Eine Seite mit diesem Namen existiert bereits! Die Seite wurde daher nicht generiert.',
        2 => 'FEHLER - Die Seite konnte nicht generiert werden'
);



function fs_create_default_pages($name, $icon) {

    $content = <<<EOT
Der alberne Troß der Universität Bayreuth begrüßt dich recht herzlich. Wir hoffen du findest dich auf unseren Seiten 
gut zurecht. Falls du Fragen bzw. Anregungen an die Fachschaft richten möchtest, hier ist unsere E-Mail-Adresse: 
fsmpi@uni-bayreuth.de Alle aktuellen Informationen, Veranstaltungsankündigungen und fakultätsinterne 
Stellenausschreibungen findest du unter News.
EOT;

    if($name == 'Home') {
        if(get_page_by_title($name) == NULL || get_page_by_title($name)->post_status == 'trash') {
            $id = wp_insert_post(array(
                'post_title'     => $name,
                'post_name'      => $name,
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_author'    => '1', // or "1" (super-admin?)
                'post_type'      => 'page',
                'menu_order'     => 1,
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_content'   => $content
            ));

            update_option( 'page_on_front', $id );
            update_option( 'show_on_front', 'page' );

            if($id == 0 || $id instanceof WP_Error) {
                return 2;
            } else {
                return 0;
            }
        }
    } else {
        if(get_page_by_title($name) == NULL || get_page_by_title($name)->post_status == 'trash') {
            //if(true) {
            $id = wp_insert_post(array(
                'post_title'     => $name,
                'post_name'      => $name,
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_author'    => '1', // or "1" (super-admin?)
                'post_type'      => 'page',
                'menu_order'     => 1,
                'comment_status' => 'closed',
                'ping_status'    => 'closed'
            ));

            if($id == 0 || $id instanceof WP_Error) {
                return 2;
            } else {
                $menu_name = 'fs-primary-navigation';
                $menu_exists = wp_get_nav_menu_object( $menu_name );
                if( !$menu_exists){
                    $menu_id = wp_create_nav_menu($menu_name);
                    $locations = get_theme_mod('nav_menu_locations');
                    $locations['Primary Navigation Menu'] = $menu_id;
                    set_theme_mod( 'nav_menu_locations', $locations );
                } else {
                    $term = get_term_by('name', $menu_name, 'nav_menu');
                    $menu_id = $term->term_id;
                }


                // Set up default menu items
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __($name),
                    'menu-item-classes' => $icon,
                    'menu-item-url' => get_page_link($id),
                    'menu-item-status' => 'publish'));
            }

            return 0;


        } else {
            return 1;
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST" )
{
    $status = array();
    if(isset($_POST['page_list'])) {
        foreach($_POST['page_list'] as $name => $icon) {
            $status[$name] = fs_create_default_pages($name, $icon);
        }
    }
}


?>


<h1>Setup</h1>
<?php settings_errors(); ?>

<form id="setupForm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?page=fs_setup" class="fs-general-form">
    <?php do_settings_sections( 'fs_setup' ); ?>
    <table>
        <tr>
            <td><input id="aktive" type="checkbox" name="page_list[Aktive Vertreter]" value="face"><label for="aktive"> Aktive Vertreter  </label></td>
            <td><span><?php echo $messages[$status['Aktive Vertreter']] ?></span></td>
        </tr>
        <tr>
            <td><input id="live" type="checkbox" name="page_list[Livestream]" value="videocam"><label for="live"> Livestream  </label></td>
            <td><span><?php echo $messages[$status['Livestream']] ?></span></td>
        </tr>
        <tr>
            <td><input id="unikino" type="checkbox" name="page_list[Unikino]" value="videocam"><label for="unikino"> Uni-Kino  </label></td>
            <td><span><?php echo $messages[$status['Unikino']] ?></span></td>
        </tr>
    </table>
    <p><input type="submit" class="button button-primary" name="someAction" value="Seiten generieren" /></p>
</form>

<?php
echo $test;
?>