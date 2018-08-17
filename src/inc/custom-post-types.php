<?php

/* @package fstheme
 *
 * =================
 * Custom Post Types
 * =================
 *
 */


function create_posttype(){

    register_post_type('protokolle',
        array(
            'labels' => array(
                'name' => __('Protokolle'),
                'singular_name' => __('Protokoll')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'protokolle'),
        )
    );
}

// Hooking up our function to theme setup
add_action('init', 'create_posttype');

/*
* Creating a function to create our CPT
*/

function custom_post_type(){

// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Sitzungsprotokolle', 'Post Type General Name'),
        'singular_name' => _x('Sitzungsprotokoll', 'Post Type Singular Name'),
        'menu_name' => __('Protokolle'),
        'all_items' => __('Alle Protokolle'),
        'view_item' => __('Protokoll anzeigen'),
        'add_new_item' => __('Neues Sitzungsprotokoll anlegen'),
        'add_new' => __('Hinzufügen'),
        'edit_item' => __('Sitzungsprotokoll bearbeiten'),
        'update_item' => __('Sitzungsprotokoll aktualisieren'),
        'search_items' => __('Sitzungsprotokoll suchen'),
        'not_found' => __('Keine Sitzungsprotokolle gefunden :('),
        'not_found_in_trash' => __('Der Papierkorb ist leer'),
    );

// Set other options for Custom Post Type

    $args = array(
        'label' => __('protokolle'),
        'description' => __('Protokolle der Fachschaftssitzungen'),
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

// Registering your Custom Post Type
    register_post_type('protokolle', $args);
    remove_post_type_support('protokolle', 'editor');
    remove_post_type_support('protokolle', 'title');

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action('init', 'custom_post_type');


function add_protokoll_meta_boxes() {
    add_meta_box('head', 'Protokollkopf', 'head_callback', 'protokolle');
    add_meta_box('agenda', 'Tagesordnung', 'agenda_callback', 'protokolle');
    add_meta_box('protocol', 'Protokoll', 'protocol_callback', 'protokolle');

    //add_meta_box('datum', 'Datum', 'datum_callback', 'protokolle');
    //add_meta_box('anwesend', 'Anwesend', 'anwesend_callback', 'protokolle');
    //add_meta_box('abwesend', 'Abwesend', 'abwesend_callback', 'protokolle');
    //add_meta_box('protokollant', 'Protokollant', 'protokollant_callback', 'protokolle');
}
add_action('add_meta_boxes', 'add_protokoll_meta_boxes');

function head_callback( $post ) {
    wp_nonce_field('save_protocol_head_data', 'date_nonce');
    wp_nonce_field('save_protocol_head_data', 'present_nonce');
    wp_nonce_field('save_protocol_head_data', 'absent_nonce');
    wp_nonce_field('save_protocol_head_data', 'recorder_nonce');

    $date = get_post_meta($post->ID, '_date_key', true);
    $present = get_post_meta($post->ID, '_present_key', true);
    $absent = get_post_meta($post->ID, '_absent_key', true);
    $recorder = get_post_meta($post->ID, '_recorder_key', true);


    ?>
    <table>
        <tr><td><label for="date">Datum: </label></td><td><input type="date" id="date" name="date" size="20" value="<?php echo esc_attr($date); ?>" /></td></tr>
        <tr><td><label for="present">Anwesend: </label></td><td style="width: 100%;"><input type="text" id="present" name="present" style="width: 100%;" value="<?php echo esc_attr($present); ?>" /></td></tr>
        <tr><td><label for="absent">Abwesend: </label></td><td style="width: 100%;"><input type="text" id="absent" name="absent" style="width: 100%;" value="<?php echo esc_attr($absent); ?>"  /></td></tr>
        <tr><td><label for="recorder">Protokollant: </label></td><td><input type="text" id="recorder" name="recorder" size="20" value="<?php echo esc_attr($recorder); ?>" /></td></tr>
    </table>
    <?php
}

function save_protocol_head_data( $post_id ) {
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    if(!current_user_can('edit_post', $post_id)) {
        return;
    }


    $tmp = true;
    if(!isset($_POST['date_nonce'])){
        $tmp = false;
    }
    if($tmp && !wp_verify_nonce($_POST['date_nonce'], 'save_protocol_head_data')){
        $tmp = false;
    }
    if($tmp && !isset($_POST['date'])){
        $tmp = false;
    }
    if($tmp) {
        $date = $_POST['date'];
        update_post_meta($post_id, '_date_key', $date);
    } else {
        return;
    }

    $tmp = true;
    if(!isset($_POST['present_nonce'])){
        $tmp = false;
    }
    if($tmp && !wp_verify_nonce($_POST['present_nonce'], 'save_protocol_head_data')){
        $tmp = false;
    }
    if($tmp && !isset($_POST['present'])){
        $tmp = false;
    }
    if($tmp) {
        $present = $_POST['present'];
        update_post_meta($post_id, '_present_key', $present);
    } else {
        return;
    }


}
add_action('save_post', 'save_protocol_head_data');


function agenda_callback( $post ) {
    //wp_nonce_field('save_protocol_agenda_data', 'tops');

    //$agenda = get_post_meta($post->ID, '_agenda_key', true);

    //isset($agenda) ? var_dump($agenda) : assert(true);

    ?>

    <ul id="tops" name="tops" style="list-style-type: none"></ul>
    <label for="top" id="tail" style="vertical-align: middle"></label><input type="text" id="top" name="top" style="vertical-align: middle" /><input type="button" id="btnAddTop" class="button button-primary" style="vertical-align: middle;" value="TOP hinzufügen" />


    <script>
        var updateAllPositions = function() {
            //console.log($('#tops'));
            //console.log($('#tops').children());
            $('#tops').children().each(function(index, element){
                $(element).find('span[name=index]').html('TOP ' + $(element).index() + ':');
                $(element).find('input[name=btnDelete]').attr("data-index", parseInt($(element).index()));
                //$(c).find('span[name=index]').html('TOP ' + $(c).index() + ':');
            });
            l = ($('ul#tops li').length === undefined ? 0 : $('ul#tops li').length);
            $('#tail').html('TOP ' + l + ': ');

        };

        var addSection = function() {
            //$('div#protocol').find('.inside').append('<header>'+$('#top').val()+'</header><hr><section><textarea style="width: 100%" rows=10></textarea></section>');
            $('#contents').append('<li><header>'+$('#top').val()+'</header><hr><section><textarea style="width: 100%" rows=10></textarea></section></li>');
        };

        var removeSection = function(btn) {
            //console.log(  $(btn).data('index') );
            $('ul#contents li').get(parseInt($(btn).data('index'))).remove();
        };

        $( function() {
            $('#tops').sortable({
                update: function( event, ui ) {
                    //$(ui.item).find('span[name=index]').html( 'TOP ' + $( ui.item ).index() + ':');
                    updateAllPositions();
                }
            });
            $('#tops').disableSelection();
            updateAllPositions();
        });
        $('#btnAddTop').on( "click", function(e) {
            e.preventDefault();
            $('#tops').append('<li><span style="vertical-align: middle; margin-left: 5px; margin-right: 5px;" name="index"></span><span name="top-content" style="vertical-align: middle; margin-left: 5px; margin-right: 5px;">'+$('#top').val()+'</span><input style="vertical-align: middle; margin-left: 5px; margin-right: 5px;" type="button" class="button button-secondary" data-index="'+ ($('ul#tops li').length === undefined ? 0 : $('ul#tops li').length) +'" name="btnDelete" value="Löschen" onclick="$(this).parent().remove(); removeSection(this); updateAllPositions();" /></li>');
            updateAllPositions();
            addSection();
        });

    </script>



    <?php
}

function save_protocol_agenda_data( $post_id ) {
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }
    if(!current_user_can('edit_post', $post_id)) {
        return;
    }

    //var_dump($_POST['agenda_nonce']); // string(10) "caf9ecb305"
    //var_dump($_POST['tops']); // NULL

    $tmp = true;
    if(!isset($_POST['tops'])){
        $tmp = false;
    }
    if($tmp && !wp_verify_nonce($_POST['tops'], 'save_protocol_agenda_data')){
        $tmp = false;
    }
    if($tmp && !isset($_POST['tops'])){
        $tmp = false;
    }
    if($tmp) {
        $date = $_POST['tops'];
        update_post_meta($post_id, '_agenda_key', $date);
    } else {
        return;
    }

}
add_action('save_post', 'save_protocol_agenda_data');


function protocol_callback( $post ) {
    ?>

    <ul id="contents" style="list-style-type: none">
    </ul>
    <!--script>
        $(function(){
            console.log($('#tops').children());
            if($('ul#tops li').length === undefined) {

            } else {
                $('#tops').children().each(function(index, element){
                    $('div#protocol').find('.inside').append("HelloWorld");
                });
            }
        });
    </script-->

    <?php
}