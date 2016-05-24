<?php
require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_print_api.php';

$whiteboard_print_api = new whiteboard_print_api();
html_page_top1 ( plugin_lang_get ( 'menu_title' ) );
html_page_top2 ();
$whiteboard_print_api->printWhiteboardMenu ();
html_page_bottom1 ();