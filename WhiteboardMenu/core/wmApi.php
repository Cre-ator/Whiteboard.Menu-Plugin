<?php

/**
 * Class wmApi
 *
 * provides functions to calculate and process data
 *
 * @author Stefan Schwarz
 */
class wmApi
{
   /**
    * get database connection infos and connect to the database
    *
    * @return mysqli
    */
   public static function initializeDbConnection ()
   {
      $dbPath = config_get ( 'hostname' );
      $dbUser = config_get ( 'db_username' );
      $dbPass = config_get ( 'db_password' );
      $dbName = config_get ( 'database_name' );

      $mysqli = new mysqli( $dbPath, $dbUser, $dbPass, $dbName );
      $mysqli->connect ( $dbPath, $dbUser, $dbPass, $dbName );

      return $mysqli;
   }

   /**
    * returns array with 1/0 values when plugin comprehensive table is installed
    *
    * @return array
    */
   public static function checkWhiteboardTablesExist ()
   {
      $boolArray = array ();

      $boolArray[ 0 ] = self::checkTable ( 'menu' );

      return $boolArray;
   }

   /**
    * checks if given table exists
    *
    * @param $tableName
    * @return bool
    */
   private static function checkTable ( $tableName )
   {
      $mysqli = self::initializeDbConnection ();

      $query = /** @lang sql */
         'SELECT COUNT(id) FROM mantis_plugin_whiteboard_' . $tableName . '_table';
      $result = $mysqli->query ( $query );
      $mysqli->close ();
      if ( $result->num_rows != 0 )
      {
         return true;
      }
      else
      {
         return false;
      }
   }

   /**
    * get all registered whiteboard plugins
    *
    * @return array
    */
   public static function getWhiteboardPlugins ()
   {
      $pluginArray = array ();

      $mysqli = self::initializeDbConnection ();

      $query = /** @lang sql */
         'SELECT * FROM mantis_plugin_whiteboard_menu_table';

      $result = $mysqli->query ( $query );
      $mysqli->close ();
      if ( 0 != $result->num_rows )
      {
         while ( $pluginRow = $result->fetch_row () )
         {
            $pluginArray[] = $pluginRow;
         }
      }

      return $pluginArray;
   }

   /**
    * print menu entrys for each plugin
    */
   public static function printWhiteboardMenu ()
   {
      $projectId = helper_get_current_project ();
      $userId = auth_get_current_user_id ();
      $userAccessLevel = user_get_access_level ( $userId, $projectId );

      $whiteboardPlugins = self::getWhiteboardPlugins ();
      $whiteboardPluginCount = count ( $whiteboardPlugins );

      echo '<div class="table">';
      for ( $index = 0; $index < $whiteboardPluginCount; $index++ )
      {
         $whiteboardPlugin = $whiteboardPlugins[ $index ];
         $plugin = $whiteboardPlugin[ 1 ];
         $pluginAccessLevel = $whiteboardPlugin[ 2 ];
         $pluginShowMenu = $whiteboardPlugin[ 3 ];
         if ( ( user_is_administrator ( $userId ) || ( $userAccessLevel >= $pluginAccessLevel ) )
            && ( $pluginShowMenu == 1 )
         )
         {
            if ( $index > 0 )
            {
               echo '<div class="item">&nbsp;|&nbsp;</div>';
            }

            $pluginLink = $whiteboardPlugin[ 4 ];
            echo '<div class="item">' . $pluginLink . plugin_lang_get ( 'menu_title', $plugin ) . '</a></div>';
         }
      }
      echo '</div>';
   }

   public static function printFormTitle ( $lang_string )
   {
      echo '<tr>';
      echo '<td class="form-title" colspan="2">';
      echo plugin_lang_get ( $lang_string );
      echo '</td>';
      echo '</tr>';
   }

   public static function printTableRow ()
   {
      if ( substr ( MANTIS_VERSION, 0, 4 ) == '1.2.' )
      {
         echo '<tr ' . helper_alternate_class () . '>';
      }
      else
      {
         echo '<tr>';
      }
   }

   public static function printCategoryField ( $lang_string )
   {
      echo '<td class="category">';
      echo plugin_lang_get ( $lang_string );
      echo '</td>';
   }

   public static function printRadioButton ( $name )
   {
      echo '<td width="100px">';
      echo '<label>';
      echo '<input type="radio" name="' . $name . '" value="1"';
      echo ( ON == plugin_config_get ( $name ) ) ? 'checked="checked"' : '';
      echo '/>' . lang_get ( 'yes' );
      echo '</label>';
      echo '<label>';
      echo '<input type="radio" name="' . $name . '" value="0"';
      echo ( OFF == plugin_config_get ( $name ) ) ? 'checked="checked"' : '';
      echo '/>' . lang_get ( 'no' );
      echo '</label>';
      echo '</td>';
   }

   public static function updateButton ( $config )
   {
      $button = gpc_get_int ( $config );

      if ( plugin_config_get ( $config ) != $button )
      {
         plugin_config_set ( $config, $button );
      }
   }
}