<h1>Uni-Kino</h1>
<?php settings_errors(); ?>

<form id="unikinoForm" method="post" action="options.php" class="fs-general-form">
    <?php settings_fields( 'fs-settings-uk' ); ?>
    <?php do_settings_sections( 'fs_uk' ); ?>
    <?php submit_button(); ?>
</form>