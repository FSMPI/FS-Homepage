<h1>Allgemein</h1>
<?php settings_errors(); ?>

<form id="adminForm" method="post" action="options.php" class="fs-general-form">
    <?php settings_fields( 'fs-settings-general' ); ?>
    <?php do_settings_sections( 'fs' ); ?>
    <?php submit_button(); ?>
</form>
