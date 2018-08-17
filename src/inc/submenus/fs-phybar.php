<h1>Physikerbar</h1>
<?php settings_errors(); ?>

<form id="phybarForm" method="post" action="options.php" class="fs-general-form">
    <?php settings_fields( 'fs-settings-phybar' ); ?>
    <?php do_settings_sections( 'fs_phybar' ); ?>
    <?php submit_button(); ?>
</form>