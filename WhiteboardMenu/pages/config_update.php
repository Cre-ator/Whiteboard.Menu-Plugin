<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'AccessLevel' ) );

form_security_validate( 'plugin_WhiteboardMenu_config_update' );

require_once WHITEBOARDMENU_CORE_URI . 'constant_api.php';
require_once WHITEBOARDMENU_CORE_URI . 'config_api.php';

$config_api = new config_api();

$config_api->updateValue( 'AccessLevel', ADMINISTRATOR );
$config_api->updateButton( 'ShowInFooter' );
$config_api->updateButton( 'ShowMenu' );


form_security_purge( 'plugin_WhiteboardMenu_config_update' );

print_successful_redirect( plugin_page( 'config_page', true ) );