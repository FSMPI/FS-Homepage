<h1>Fachschaftler</h1>
<?php settings_errors(); ?>

<form id="jobsForm" method="post" action="options.php" class="fs-general-form">
    <?php settings_fields( 'fs-settings-jobs' ); ?>
    <?php do_settings_sections( 'fs_jobs' ); ?>
    <?php submit_button(); ?>
</form>