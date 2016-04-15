<?php
require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_print_api.php';

$whiteboard_print_api = new whiteboard_print_api();
html_page_top1( plugin_lang_get( 'menu_title' ) );
html_page_top2();
if ( access_get_local_level( auth_get_current_user_id(), helper_get_current_project() ) >= plugin_config_get( 'AccessLevel' ) || user_is_administrator( auth_get_current_user_id() ) )
{
   $whiteboard_print_api->printWhiteboardMenu();
}
else
{
   echo '<table class="width60"><tr><td class="center">' . lang_get( 'access_denied' ) . '</td></tr></table>';
}
html_page_bottom1();