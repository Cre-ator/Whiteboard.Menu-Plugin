<?php
require_once ( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'wmApi.php' );

auth_reauthenticate ();
access_ensure_global_level ( config_get ( 'AccessLevel' ) );
form_security_validate ( 'plugin_WhiteboardMenu_config_update' );

wmApi::updateButton ( 'show_in_footer' );
wmApi::updateButton ( 'show_menu' );

form_security_purge ( 'plugin_WhiteboardMenu_config_update' );
print_successful_redirect ( plugin_page ( 'config_page', true ) );