<!--style>
    .mdc-layout-grid__cell {
        margin: 0 !important;
    }



    .portrait {
        width: 256px !important;
        height: 256px !important;
        clip-path: circle(100px at center);
    }

    .mdc-typography--subheading2 {
        margin: 0 auto 15px auto;
    }
</style-->

<?php
    $jobs = empty(get_option( 'jobs' )) ? array('Chef', 'Vize', 'Finanzer', 'Öffentlichkeitsarbeit', 'Skripten', 'Uni-Kino 1', 'Uni-Kino 2', 'Grafiken', 'Einkauf', 'Root') :  get_option( 'jobs' );
?>

        <?php foreach($jobs as $job){

            $picture = empty(get_option($job)["profile_picture"]) ? '' : get_option($job)["profile_picture"];
            $first_name = empty(get_option($job)["first_name"]) ? '' : get_option($job)["first_name"];
            $last_name = empty(get_option($job)["last_name"]) ? '' : get_option($job)["last_name"];
            $major = empty(get_option($job)["major"]) ? '' : get_option($job)["major"];


            echo <<<EOT
            <div class="mdc-card">
                <div class="mdc-card__media">
                    <img src="$picture" class="portrait"/>
                    <h2 class="mdc-typography--subheading">$first_name $last_name</h2>
                </div>
                <div class="mdc-card__actions mdc-list-group">
                    <ul class="mdc-list mdc-list--two-line" aria-orientation="vertical">
                        <h3 class="mdc-list-group__subheader">$job</h3>
                        <li role="separator" class="mdc-list-divider"></li>
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">school</span>
                            <span class="mdc-list-item__text">
                              $major
                              <span class="mdc-list-item__secondary-text">
                                Studiengang
                              </span>
                            </span>
                        </li>
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">email</span>
                            <span class="mdc-list-item__text">
                                
                            <span class="mdc-list-item__secondary-text">
                                Email Adresse
                              </span>
                            </span>
                        </li>
                        <li class="mdc-list-item">
                            <span class="mdc-list-item__graphic material-icons" aria-hidden="true">book</span>
                            <span class="mdc-list-item__text"></span>
                        </li>
                    </ul>
                </div>
            </div>
EOT;

        }
        ?>