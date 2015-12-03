<?php
include WHITEBOARDMENU_CORE_URI . 'print_api.php';

$print_api = new print_api();

html_page_top1( plugin_lang_get( 'menu_title' ) );
html_page_top2();

$print_api->printWhiteboardMenu();

html_page_bottom1();