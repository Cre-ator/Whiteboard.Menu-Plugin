<?php
// URL to WhiteboardMenu plugin
define( 'WHITEBOARDMENU_PLUGIN_URL', config_get_global( 'path' ) . 'plugins/' . plugin_get_current() . '/' );

// Path to WhiteboardMenu plugin folder
define( 'WHITEBOARDMENU_PLUGIN_URI', config_get_global( 'plugin_path' ) . plugin_get_current() . DIRECTORY_SEPARATOR );

// Path to WhiteboardMenu core folder
define( 'WHITEBOARDMENU_CORE_URI', WHITEBOARDMENU_PLUGIN_URI . 'core' . DIRECTORY_SEPARATOR );

define( 'PLUGINS_WHITEBOARDMENU_THRESHOLD_LEVEL_DEFAULT', ADMINISTRATOR );