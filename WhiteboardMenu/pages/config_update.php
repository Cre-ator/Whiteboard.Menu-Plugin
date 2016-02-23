<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'AccessLevel' ) );
form_security_validate( 'plugin_WhiteboardMenu_config_update' );

require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_constant_api.php';
require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_config_api.php';

$whiteboard_config_api = new whiteboard_config_api();
$whiteboard_config_api->updateValue( 'AccessLevel', ADMINISTRATOR );
$whiteboard_config_api->updateButton( 'ShowInFooter' );
$whiteboard_config_api->updateButton( 'ShowMenu' );

form_security_purge( 'plugin_WhiteboardMenu_config_update' );
print_successful_redirect( plugin_page( 'config_page', true ) );