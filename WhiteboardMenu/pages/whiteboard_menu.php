<?php
require_once ( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'wmApi.php' );

echo '<link rel="stylesheet" href="plugins/WhiteboardMenu/files/whiteboardmenu.css"/>';

html_page_top1 ( plugin_lang_get ( 'menu_title' ) );
html_page_top2 ();
wmApi::printWhiteboardMenu ();
html_page_bottom1 ();