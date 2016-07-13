<?php
require_once ( __DIR__ . '/whiteboard_config_api.php' );

class whiteboard_print_api
{
    public static function printWhiteboardMenu ()
    {
        $project_id = helper_get_current_project ();
        $user_id = auth_get_current_user_id ();

        echo '<table align="center">';
        echo '<tr>';

        if ( plugin_is_installed ( 'UserProjectView' )
            && file_exists ( config_get_global ( 'plugin_path' ) . 'UserProjectView' )
        )
        {
            $user_project_access_level = whiteboard_config_api::whitebaord_plugin_config_get ( 'UserProjectAccessLevel', 'UserProjectView' );
            if (
                ( ( user_get_access_level ( $user_id, $project_id ) >= $user_project_access_level ) || user_is_administrator ( $user_id ) )
                && ( whiteboard_config_api::whitebaord_plugin_config_get ( 'ShowMenu', 'UserProjectView' ) )
            )
            {
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'UserProject', false, 'UserProjectView' ) . '&amp;sortVal=userName&amp;sort=ASC">' . plugin_lang_get ( 'menu_userprojecttitle', 'UserProjectView' ) . '</a>';
                echo '</td>';
            }
        }

        if ( plugin_is_installed ( 'SpecManagement' )
            && file_exists ( config_get_global ( 'plugin_path' ) . 'SpecManagement' )
        )
        {
            $specmanagement_access_level = whiteboard_config_api::whitebaord_plugin_config_get ( 'AccessLevel', 'SpecManagement' );
            if (
                ( ( user_get_access_level ( $user_id, $project_id ) >= $specmanagement_access_level ) || user_is_administrator ( $user_id ) )
                && ( whiteboard_config_api::whitebaord_plugin_config_get ( 'ShowMenu', 'SpecManagement' ) )
            )
            {
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'choose_document', false, 'SpecManagement' ) . '">' . plugin_lang_get ( 'menu_title', 'SpecManagement' ) . '</a>';
                echo '</td>';
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'manage_versions', false, 'SpecManagement' ) . '">' . plugin_lang_get ( 'manversions_thead', 'SpecManagement' ) . '</a>';
                echo '</td>';
            }
        }

        if ( plugin_is_installed ( 'StoryBoard' )
            && file_exists ( config_get_global ( 'plugin_path' ) . 'StoryBoard' )
        )
        {
            $storyboard_access_level = whiteboard_config_api::whitebaord_plugin_config_get ( 'access_level', 'StoryBoard' );
            if (
                ( ( user_get_access_level ( $user_id, $project_id ) >= $storyboard_access_level ) || user_is_administrator ( $user_id ) )
                && ( whiteboard_config_api::whitebaord_plugin_config_get ( 'show_menu', 'StoryBoard' ) )
            )
            {
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'storyboard_index', false, 'StoryBoard' ) . '">' . plugin_lang_get ( 'menu_title', 'StoryBoard' ) . '</a>';
                echo '</td>';
            }
        }

        if ( plugin_is_installed ( 'VersionManagement' )
            && file_exists ( config_get_global ( 'plugin_path' ) . 'VersionManagement' )
        )
        {
            $versionmanagement_access_level = whiteboard_config_api::whitebaord_plugin_config_get ( 'access_level', 'VersionManagement' );
            if (
                ( ( user_get_access_level ( $user_id, $project_id ) >= $versionmanagement_access_level ) || user_is_administrator ( $user_id ) )
                && ( whiteboard_config_api::whitebaord_plugin_config_get ( 'show_menu', 'VersionManagement' ) )
            )
            {
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'version_view_page', false, 'VersionManagement' ) . '&amp;edit=0&amp;obsolete=0">' . plugin_lang_get ( 'menu_title', 'VersionManagement' ) . '</a>';
                echo '</td>';
            }
        }

        if ( plugin_is_installed ( 'RoadmapPro' )
            && file_exists ( config_get_global ( 'plugin_path' ) . 'RoadmapPro' )
        )
        {
            $roadmappro_access_level = whiteboard_config_api::whitebaord_plugin_config_get ( 'access_level', 'RoadmapPro' );
            if (
                ( ( user_get_access_level ( $user_id, $project_id ) >= $roadmappro_access_level ) || user_is_administrator ( $user_id ) )
                && ( whiteboard_config_api::whitebaord_plugin_config_get ( 'show_menu', 'RoadmapPro' ) )
            )
            {
                echo '<td>';
                echo '| ';
                echo '<a href="' . plugin_page ( 'roadmap_page', false, 'RoadmapPro' ) . '">' . plugin_lang_get ( 'menu_title', 'RoadmapPro' ) . '</a >';
                echo '</td>';
            }
        }

        echo '<td>';
        echo ' |';
        echo '</td>';

        echo '</tr>';
        echo '</table>';
    }
}