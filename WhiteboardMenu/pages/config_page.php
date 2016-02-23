<?php
require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_constant_api.php';
require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_config_api.php';

$whiteboard_config_api = new whiteboard_config_api();

auth_reauthenticate();
access_ensure_global_level( plugin_config_get( 'AccessLevel' ) );

html_page_top1( plugin_lang_get( 'config_title' ) );
html_page_top2();

print_manage_menu();

echo '<br/>';
echo '<form action="' . plugin_page( 'config_update' ) . '" method="post">';
echo form_security_field( 'plugin_WhiteboardMenu_config_update' );

if ( substr( MANTIS_VERSION, 0, 4 ) == '1.2.' )
{
   echo '<table align="center" class="width75" cellspacing="1">';
}
else
{
   echo '<div class="form-container">';
   echo '<table>';
}

$whiteboard_config_api->printFormTitle( 3, 'config_caption' );
$whiteboard_config_api->printTableRow();
echo '<td class="category" width="30%">';
echo '<span class="required">*</span>' . plugin_lang_get( 'config_accesslevel' );
echo '</td>';
echo '<td width="200px">';
echo '<select name="AccessLevel">';
print_enum_string_option_list( 'access_levels', plugin_config_get( 'AccessLevel', PLUGINS_WHITEBOARDMENU_THRESHOLD_LEVEL_DEFAULT ) );
echo '</select>';
echo '</td>';
echo '</tr>';

$whiteboard_config_api->printTableRow();
$whiteboard_config_api->printCategoryField( 1, 1, 'config_show_footer' );
$whiteboard_config_api->printRadioButton( 1, 'ShowInFooter' );
echo '</tr>';

$whiteboard_config_api->printTableRow();
$whiteboard_config_api->printCategoryField( 1, 1, 'config_show_menu' );
$whiteboard_config_api->printRadioButton( 1, 'ShowMenu' );
echo '</tr>';

echo '<tr>';
echo '<td class="center" colspan="3">';
echo '<input type="submit" name="change" class="button" value="' . lang_get( 'update_prefs_button' ) . '"/>';
echo '</td>';
echo '</tr>';

echo '</table>';

if ( substr( MANTIS_VERSION, 0, 4 ) != '1.2.' )
{
   echo '</div>';
}

echo '</form>';

html_page_bottom1();