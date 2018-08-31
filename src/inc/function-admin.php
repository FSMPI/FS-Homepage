<?php

/* @package fstheme
 *
 * ==========
 * Admin Page
 * ==========
 *
 */


function fs_add_admin_page() {

    //Generate Admin Page
    //TODO: Change icon
    add_menu_page( 'FS-Theme Options', 'Fachschaft', 'manage_options', 'fs', 'fs_theme_create_page', get_template_directory_uri() . '/img/sunset-icon.png', 110 );

    //Generate Admin Sub Pages
    add_submenu_page( 'fs', 'FS General Settings', 'Allgemein', 'manage_options', 'fs', 'fs_theme_create_page' );
    add_submenu_page( 'fs', 'FS Job Settings', 'Fachschaftler', 'manage_options', 'fs_jobs', 'fs_theme_job_page');
    //add_submenu_page( 'fs', 'FS Uni-Kino Settings', 'Uni-Kino', 'manage_options', 'fs_uk', 'fs_theme_uk_page');
    //add_submenu_page( 'fs', 'FS Physikerbar Settings', 'Physikerbar', 'manage_options', 'fs_phybar', 'fs_theme_phybar_page');
    //add_submenu_page( 'fs', 'FS Theme Setup', 'Setup', 'manage_options', 'fs_setup', 'fs_theme_setup_page');

}
add_action( 'admin_menu', 'fs_add_admin_page' );



function fs_custom_settings() {

    // ------------------------
    // Allgemeine Einstellungen
    // ------------------------

    // Wahlplakat

    register_setting('fs-settings-general', 'poster');
    add_settings_section('fs-general-poster', 'Wahlplakat Einstellungen', 'fs_general_poster', 'fs');
    add_settings_field('fs_general_poster', 'Wahlplakat', function(){
        $picture = empty(get_option('poster')) ? '' : esc_attr( get_option('poster'));
        echo '<div class="fs-poster-preview" id="poster-picture-preview" style="background-image: url('.$picture.');"></div>';
        if(empty($picture)){
            echo '<div><input type="button" class="button button-secondary" value="Wahlplakat hochladen" id="poster-select" name="uploadBtn"><input type="hidden" id="poster-picture" name="poster" value="'.$picture.'" /></div>';
        } else {
            echo '<div><input type="button" class="button button-secondary" value="Wahlplakat ändern" id="poster-select" name="uploadBtn"><input type="button" class="button button-secondary" value="Entfernen" id="poster-remove" name="removeBtn"><input type="hidden" id="poster-picture" name="poster" value="'.$picture.'" /></div>';
        }
        echo '<div class="delimiter"></div>';
    }, 'fs', 'fs-general-poster');

    // Jobs

    register_setting('fs-settings-general', 'jobs');
    add_settings_section('fs-general-jobs', 'Job-Einstellungen', 'fs_general_jobs', 'fs');
    add_settings_field('general-jobs', 'Jobs', function(){
        $jobs = empty(get_option( 'jobs' )) ? array('Chef', 'Vize', 'Finanzer', 'Öffentlichkeitsarbeit', 'Skripten', 'Uni-Kino 1', 'Uni-Kino 2', 'Grafiken', 'Einkauf', 'Root') :  get_option( 'jobs' );
        echo '<table class="fs-jobs-table" id="jobsTable">';
        foreach($jobs as $job) {
            echo '<tr><td>'.$job.'</td><td><input type="button" class="button button-warn" value="Entfernen" onclick="$(this).parents(\'tr\').first().remove()" id="deleteBtn-'.$job.'" /></td><td><input type="hidden" name="jobs[]" value="'.$job.'" /></td></tr>';
        }

        echo '<tr><td><input type=text id="addJob" /></td><td><input type="button" class="button button-secondary" value="Hinzufügen" id="addJobBtn"/></td></tr>';
        echo '</table>';
        echo '<div class="delimiter"></div>';
    }, 'fs', 'fs-general-jobs');

    // Sprechstunden
    //TODO: Implement Office Hours

    register_setting('fs-settings-general', 'officehours');
    add_settings_section('fs-general-officehours', 'Sprechstunden', 'fs_general_officehours', 'fs');
    add_settings_field('general-officehours', '', function(){
        $officehours = empty(get_option( 'officehours' )) ? array('13.00' => array('Montag' => '', 'Dienstag' => '', 'Mittwoch' => '', 'Donnerstag' => ''), '14.00' => array('Montag' => '', 'Dienstag' => '', 'Mittwoch' => '', 'Donnerstag' => ''), '15.00' => array('Montag' => '', 'Dienstag' => '', 'Mittwoch' => '', 'Donnerstag' => '')) : get_option( 'officehours' );
        $jobs = empty(get_option( 'jobs' )) ? array('Chef', 'Vize', 'Finanzer', 'Öffentlichkeitsarbeit', 'Skripten', 'Uni-Kino 1', 'Uni-Kino 2', 'Grafiken', 'Einkauf', 'Root') :  get_option( 'jobs' );
        $names = array();
        foreach($jobs as $job) {
            $option = get_option($job);
            (isset($option['first_name']) && $option['first_name'] != '') ? array_push($names, $option['first_name']) : 'NOP';
        }

        echo '<div class="fs-hours"><table><tbody><tr><th></th><th>Mo</th><th>Di</th><th>Mi</th><th>Do</th></tr>';

        foreach($officehours as $hour => $days) {
            echo '<tr><td>'.$hour.'</td>';
            foreach($days as $day => $dname) {
                echo '<td><select name="officehours['.$hour.']['.$day.']">';
                foreach($names as $name) {
                    echo '<option value="'.$name.'"';
                    if($name == $dname) echo ' selected';
                    echo '>'.$name.'</option>';
                }
                echo '</select></td>';
            }
            echo '</tr>';
        }


        echo '</tbody></table></div>';
        echo '<div class="delimiter"></div>';
    }, 'fs', 'fs-general-officehours');


    // Keine Panik

    register_setting('fs-settings-general', 'panik');
    add_settings_section('fs-general-panik', 'Keine Panik', 'fs_general_panik', 'fs');
    add_settings_field('fs_general_panik', 'Keine Panik', function(){
        $panik = empty(get_option('panik')) ? '' : esc_attr( get_option('panik'));
        echo '<div class="fs-panik-preview" id="panik-preview"><iframe src="https://docs.google.com/viewer?url='.$panik.'&embedded=true" frameborder="0"></iframe></div>';
        if(empty($panik)){
            echo '<div><input type="button" class="button button-secondary" value="Panik hochladen" id="panik-select" name="uploadBtn"><input type="hidden" id="panik-picture" name="panik" value="'.$panik.'" /></div>';
        } else {
            echo '<div><input type="button" class="button button-secondary" value="Panik ändern" id="panik-select" name="uploadBtn"><input type="button" class="button button-secondary" value="Entfernen" id="panik-remove" name="removeBtn"><input type="hidden" id="panik-picture-preview" name="panik" value="'.$panik.'" /></div>';
        }
        echo '<div class="delimiter"></div>';
    }, 'fs', 'fs-general-panik');



    // -------------
    // Fachschaftler
    // -------------

    $jobs = empty(get_option( 'jobs' )) ? array('Chef', 'Vize', 'Finanzer', 'Öffentlichkeitsarbeit', 'Skripten', 'Uni-Kino 1', 'Uni-Kino 2', 'Grafiken', 'Einkauf', 'Root') :  get_option( 'jobs' );
    foreach($jobs as $job){
        //echo '<div class="job-wrapper">';
        register_setting('fs-settings-jobs', $job);

        add_settings_section('fs-general-'.$job, $job, function($jobarr){
        }, 'fs_jobs');

        add_settings_field('fs-general-profile-picture', 'Profilbild', function() use ($job) {

            $picture = empty(get_option($job)["profile_picture"]) ? '' : esc_attr(get_option($job)["profile_picture"]);

            //$jobarr = empty(get_option( $job ) ) ? '' : esc_attr( get_option( $job ) );

            echo '<div class="fs-profile-preview" id="profile-picture-preview-'.$job.'" style="background-image: url('.$picture.');"></div>';
            if(empty($picture)){
                echo '<div><input type="button" class="button button-secondary" value="Upload Profile Picture" id="uploadBtn-profile-'.$job.'" name="'.$job.'"><input type="hidden" id="profile-picture-'.$job.'" name="'.$job.'[profile_picture]" value="'.$picture.'" /></div>';
            } else {
                echo '<div><input type="button" class="button button-secondary" value="Change Profile Picture" id="uploadBtn-profile-'.$job.'" name="'.$job.'"><input type="button" class="button button-secondary" value="Remove" id="removeBtn-profile-'.$job.'" name="'.$job.'"><input type="hidden" id="profile-picture-'.$job.'" name="'.$job.'[profile_picture]" value="'.$picture.'" /></div>';
            }
        }, 'fs_jobs', 'fs-general-'.$job );

        add_settings_field('fs-general-profile-name', 'Name', function() use ($job){
            $firstName = empty(get_option($job)["first_name"]) ? '' : esc_attr(get_option($job)["first_name"]);
            $lastName = empty(get_option($job)["last_name"]) ? '' : esc_attr(get_option($job)["last_name"]);
            echo '<div class="linewrapper"><input type="text" name="'.$job.'[first_name]" value="'.$firstName.'" placeholder="First Name" /><input type="text" name="'.$job.'[last_name]" value="'.$lastName.'" placeholder="Last Name" /></div>';
        }, 'fs_jobs', 'fs-general-'.$job );

        add_settings_field('fs-general-profile-age', 'Geburtstag', function() use ($job){
            $birthday = empty(get_option($job)["birthday"]) ? '' : esc_attr(get_option($job)["birthday"]);
            echo '<div class="linewrapper"><input type="date" name="'.$job.'[birthday]" value="'.$birthday.'" /></div>';
        }, 'fs_jobs', 'fs-general-'.$job );

        add_settings_field('fs-general-profile-study', 'Studium', function() use ($job){
            $major = empty(get_option($job)["major"]) ? '' : esc_attr(get_option($job)["major"]);
            $semester = empty(get_option($job)["semester"]) ? '' : esc_attr(get_option($job)["semester"]);
            echo '<div class="linewrapper"><input type="text" id="major_"'.$job.' name="'.$job.'[major]" value="'.$major.'" placeholder="Studiengang" /><input type="text" id="semester_"'.$job.' name="'.$job.'[semester]" value="'.$semester.'" placeholder="Semester" /></div>';
        }, 'fs_jobs', 'fs-general-'.$job );

        add_settings_field('fs-general-profile-description', 'Charakteristik', function() use ($job){
            $description = empty(get_option($job)["description"]) ? '' : esc_attr(get_option($job)["description"]);
            echo '<div class="linewrapper"><textarea name="'.$job.'[description]" rows="4" cols="50">'.$description.'</textarea></div>';
            echo '<div class="delimiter"></div>';
        }, 'fs_jobs', 'fs-general-'.$job );

    }



}
add_action('admin_init', 'fs_custom_settings' );



function fs_general_jobs() {
    echo '<p>Hier die aktuellen Jobs (1 pro Zeile) eintragen.</p>';
}
function fs_sanitize_jobs($input) {
    $jobs = explode("\n", $input);
    foreach($jobs as &$item) {
        $item = str_replace("\n","",$item);
        $item = str_replace("\r","",$item);
    }
    if(sizeof($jobs) == 1 && $jobs[0] == "") return array();
    else return $jobs;
}
function fs_sanitize_jobs2($input) {

}

function fs_sanitize_job() {
    return array_fill_keys(array('title', 'profile_picture', 'first_name', 'last_name', 'birthday', 'major', 'semester', 'description'), '');
}
function fs_general_poster() {
    echo '<p>Das aktuelle Wahlplakat</p>';
}
function fs_general_panik() {
    echo '<p>Die aktuelle Ausgabe der Panik</p>';
}
function fs_general_officehours() {
    echo '<p>Hier können die aktuellen Sprechstunden eingetragen werden</p>';
}

function fs_custom_css_section_callback() {
    echo 'Customize Sunset Theme with your own CSS';
}
function fs_custom_css_callback() {
    $css = get_option( 'fs_css' );
    $css = ( empty($css) ? '/* FS-Theme Custom CSS */' : $css );
    echo '<div id="customCss">'.$css.'</div><textarea id="fs_css" name="fs_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}
function fs_theme_options() {
    echo 'Activate and Deactivate specific Theme Support Options';
}
function fs_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact Form';
}
function fs_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /></label>';
}
function fs_post_formats() {
    $options = get_option( 'post_formats' );
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach ( $formats as $format ){
        $checked = ( @$options[$format] == 1 ? 'checked' : '' );
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
    }
    echo $output;
}
function fs_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}
function fs_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}
// Sidebar Options Functions
function fs_sidebar_options() {
    echo '<p>Customize your Sidebar Information</p>';
}
function fs_sidebar_profile() {
    /*$test = empty(get_option( 'test-nr' )) ? 10 :  esc_attr( get_option( 'test-nr' ));
    for($i = 1; $i <= $test; $i++) {
        echo '<div>';
        echo '<div class="fs-sidebar-preview"></div>';
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture['. $i .']" value="" />';
        echo '</div>';
    }*/


    $picture = esc_attr( get_option( 'profile_picture' ) );
    if( empty($picture) ){
        //echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
    } else {
        //echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
    }
    //$test = esc_attr( get_option( 'test-nr' ) ? empty(get_option( 'test-nr' )) : 10 );
    //echo $test;
    //echo '<input type="button" class="button button-secondary" value="Test" id="test-button" /><input type="hidden" id="test-nr" name="test-nr" value="' .$test. '" />';

    //for($i = 0; $i < $test; $i++) {
    //echo '<p>'.$i.'</p>';
    //}

}
function fs_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function fs_sidebar_description() {
    $description = esc_attr( get_option( 'user_description' ) );
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write something smart.</p>';
}
//Sanitization settings
function fs_sanitize_twitter_handler( $input ){
    $output = sanitize_text_field( $input );
    $output = str_replace('@', '', $output);
    return $output;
}
function fs_sanitize_custom_css( $input ){
    $output = esc_textarea( $input );
    return $output;
}


//Template submenu functions
function fs_theme_create_page() {
    require_once( get_template_directory() . '/inc/submenus/fs-admin.php' );
}
function fs_theme_job_page() {
    require_once( get_template_directory() . '/inc/submenus/fs-jobs.php');
}
function fs_theme_uk_page() {
    require_once( get_template_directory() . '/inc/submenus/fs-unikino.php');
}
function fs_theme_phybar_page() {
    require_once( get_template_directory() . '/inc/submenus/fs-phybar.php');
}
function fs_theme_setup_page() {
    require_once( get_template_directory() . '/inc/submenus/fs-setup.php');
}