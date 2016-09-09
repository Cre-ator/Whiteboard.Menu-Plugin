<?php

class WhiteboardMenuPlugin extends MantisPlugin
{
   private $shortName = null;

   function register ()
   {
      $this->shortName = 'WhiteboardMenu';
      $this->name = 'Whiteboard.' . $this->shortName;
      $this->description = 'Adds underlying menu for all Whiteboard Management plugins.';
      $this->page = 'config_page';

      $this->version = '1.0.22';
      $this->requires = array
      (
         'MantisCore' => '1.2.0, <= 1.3.99',
      );

      $this->author = 'cbb software GmbH (Rainer Dierck, Stefan Schwarz)';
      $this->contact = '';
      $this->url = 'https://github.com/Cre-ator';
   }

   function hooks ()
   {
      $hooks = array
      (
         'EVENT_LAYOUT_PAGE_FOOTER' => 'footer',
         'EVENT_MENU_MAIN' => 'menu'
      );
      return $hooks;
   }

   function config ()
   {
      return array
      (
         'show_in_footer' => ON,
         'show_menu' => ON
      );
   }

   function schema ()
   {
      require_once ( __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'wmApi.php' );
      $tableArray = array ();

      $whiteboardMenuTable = array
      (
         'CreateTableSQL', array ( plugin_table ( 'menu', 'whiteboard' ), "
            id                   I       NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
            plugin_name          C(250)  DEFAULT '',
            plugin_access_level  I       UNSIGNED,
            plugin_show_menu     I       UNSIGNED,
            plugin_menu_path     C(250)  DEFAULT ''
            " )
      );

      $boolArray = wmApi::checkWhiteboardTablesExist ();
      # add whiteboardmenu table if it does not exist
      if ( !$boolArray[ 0 ] )
      {
         array_push ( $tableArray, $whiteboardMenuTable );
      }

      return $tableArray;
   }

   function footer ()
   {
      if ( plugin_config_get ( 'show_in_footer' ) )
      {
         return '<address>' . $this->shortName . ' ' . $this->version . ' Copyright &copy; 2016 by ' . $this->author . '</address>';
      }
      return null;
   }

   function menu ()
   {
      if ( plugin_config_get ( 'show_menu' ) )
      {
         require_once ( __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'wmApi.php' );

         $projectId = helper_get_current_project ();
         $userId = auth_get_current_user_id ();
         $userAccessLevel = user_get_access_level ( $userId, $projectId );
         $whiteboardPlugins = wmApi::getWhiteboardPlugins ();

         $showMenu = false;
         foreach ( $whiteboardPlugins as $whiteboardPlugin )
         {
            $pluginAccessLevel = $whiteboardPlugin[ 2 ];
            if ( ( user_is_administrator ( $userId ) )
               || ( $userAccessLevel >= $pluginAccessLevel )
            )
            {
               $showMenu = true;
               break;
            }
         }

         if ( $showMenu )
         {
            return '<a href="' . plugin_page ( 'whiteboard_menu' ) . '">' . plugin_lang_get ( 'menu_title' ) . '</a>';
         }
      }
      return null;
   }
}