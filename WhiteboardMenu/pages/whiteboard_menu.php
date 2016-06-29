<?php
require_once ( __DIR__ . '/../core/whiteboard_print_api.php' );

html_page_top1 ( plugin_lang_get ( 'menu_title' ) );
html_page_top2 ();
whiteboard_print_api::printWhiteboardMenu ();
html_page_bottom1 ();