<?php
require_once ( __DIR__ . '/../core/whiteboard_config_api.php' );

auth_reauthenticate ();
access_ensure_global_level ( config_get ( 'AccessLevel' ) );
form_security_validate ( 'plugin_WhiteboardMenu_config_update' );

whiteboard_config_api::updateButton ( 'show_in_footer' );
whiteboard_config_api::updateButton ( 'show_menu' );

form_security_purge ( 'plugin_WhiteboardMenu_config_update' );
print_successful_redirect ( plugin_page ( 'config_page', true ) );