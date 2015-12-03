<?php
require_once( WHITEBOARDMENU_CORE_URI . 'constant_api.php' );
include WHITEBOARDMENU_CORE_URI . 'config_api.php';

$config_api = new config_api();

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

$config_api->printFormTitle( 3, 'config_caption' );
$config_api->printTableRow();
echo '<td class="category" width="30%">';
echo '<span class="required">*</span>' . plugin_lang_get( 'config_accesslevel' );
echo '</td>';
echo '<td width="200px">';
echo '<select name="AccessLevel">';
print_enum_string_option_list( 'access_levels', plugin_config_get( 'AccessLevel', PLUGINS_WHITEBOARDMENU_THRESHOLD_LEVEL_DEFAULT ) );
echo '</select>';
echo '</td>';
echo '</tr>';

$config_api->printTableRow();
$config_api->printCategoryField( 1, 1, 'config_show_footer' );
$config_api->printRadioButton( 1, 'ShowInFooter' );
echo '</tr>';

$config_api->printTableRow();
$config_api->printCategoryField( 1, 1, 'config_show_menu' );
$config_api->printRadioButton( 1, 'ShowMenu' );
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