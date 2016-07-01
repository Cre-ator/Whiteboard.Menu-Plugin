<?php

class WhiteboardMenuPlugin extends MantisPlugin
{
    function register ()
    {
        $this->name = 'WhiteboardMenu';
        $this->description = 'Adds underlying menu for all Whiteboard Management plugins.';
        $this->page = 'config_page';

        $this->version = '1.0.14';
        $this->requires = array
        (
            'MantisCore' => '1.2.0, <= 1.3.99',
        );

        $this->author = 'Stefan Schwarz';
        $this->contact = '';
        $this->url = '';
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
            'show_menu' => ON,
        );
    }

    function footer ()
    {
        if ( plugin_config_get ( 'show_in_footer' ) )
        {
            return '<address>' . $this->name . '&nbsp;' . $this->version . '&nbsp;Copyright&nbsp;&copy;&nbsp;2016&nbsp;by&nbsp;' . $this->author . '</address>';
        }
        return null;
    }

    function menu ()
    {
        if ( plugin_config_get ( 'show_menu' ) )
        {
            require_once ( __DIR__ . '/core/whiteboard_config_api.php' );

            $project_id = helper_get_current_project ();
            $user_id = auth_get_current_user_id ();

            $user_project_view_installed = plugin_is_installed ( 'UserProjectView' ) && file_exists ( config_get_global ( 'plugin_path' ) . 'UserProjectView' );
            $user_project_access_level = $user_project_view_installed ? whiteboard_config_api::whitebaord_plugin_config_get ( 'UserProjectAccessLevel', 'UserProjectView' ) : 0;

            $specmanagement_installed = plugin_is_installed ( 'SpecManagement' ) && file_exists ( config_get_global ( 'plugin_path' ) . 'SpecManagement' );
            $specmanagement_access_level = $specmanagement_installed ? whiteboard_config_api::whitebaord_plugin_config_get ( 'AccessLevel', 'SpecManagement' ) : 0;

            $storyboard_installed = plugin_is_installed ( 'StoryBoard' ) && file_exists ( config_get_global ( 'plugin_path' ) . 'StoryBoard' );
            $storyboard_access_level = $storyboard_installed ? whiteboard_config_api::whitebaord_plugin_config_get ( 'access_level', 'StoryBoard' ) : 0;

            $versionmanagement_installed = plugin_is_installed ( 'VersionManagement' ) && file_exists ( config_get_global ( 'plugin_path' ) . 'VersionManagement' );
            $versionmanagement_access_level = $versionmanagement_installed ? whiteboard_config_api::whitebaord_plugin_config_get ( 'version_management_access_level', 'VersionManagement' ) : 0;

            $roadmappro_installed = plugin_is_installed ( 'RoadmapPro' ) && file_exists ( config_get_global ( 'plugin_path' ) . 'RoadmapPro' );
            $roadmappro_access_level = $roadmappro_installed ? whiteboard_config_api::whitebaord_plugin_config_get ( 'roadmap_pro_access_level', 'RoadmapPro' ) : 0;

            if (
                user_is_administrator ( $user_id )
                || ( user_get_access_level ( $user_id, $project_id ) >= $user_project_access_level )
                || ( user_get_access_level ( $user_id, $project_id ) >= $specmanagement_access_level )
                || ( user_get_access_level ( $user_id, $project_id ) >= $storyboard_access_level )
                || ( user_get_access_level ( $user_id, $project_id ) >= $versionmanagement_access_level )
                || ( user_get_access_level ( $user_id, $project_id ) >= $roadmappro_access_level )
            )
            {
                return '<a href="' . plugin_page ( 'whiteboard_menu' ) . '">' . plugin_lang_get ( 'menu_title' ) . '</a>';
            }
        }
        return null;
    }
}