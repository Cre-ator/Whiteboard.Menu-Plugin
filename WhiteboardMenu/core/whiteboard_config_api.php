<?php

class whiteboard_config_api
{
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

    public static function updateValue ( $value, $constant )
    {
        $act_value = null;

        if ( is_int ( $value ) )
        {
            $act_value = gpc_get_int ( $value, $constant );
        }

        if ( is_string ( $value ) )
        {
            $act_value = gpc_get_string ( $value, $constant );
        }

        if ( plugin_config_get ( $value ) != $act_value )
        {
            plugin_config_set ( $value, $act_value );
        }
    }

    public static function updateButton ( $config )
    {
        $button = gpc_get_int ( $config );

        if ( plugin_config_get ( $config ) != $button )
        {
            plugin_config_set ( $config, $button );
        }
    }

    /**
     * Get a plugin configuration option.
     * @param $p_option
     * @param $t_basename
     * @param null $p_default
     * @param bool $p_global
     * @param null $p_user
     * @param null $p_project
     * @return float|int|mixed|null|string
     */
    public static function whitebaord_plugin_config_get ( $p_option, $t_basename, $p_default = null, $p_global = false, $p_user = null, $p_project = null )
    {
        $t_full_option = 'plugin_' . $t_basename . '_' . $p_option;
        if ( $p_global )
        {
            return config_get_global ( $t_full_option, $p_default );
        }
        else
        {
            return config_get ( $t_full_option, $p_default, $p_user, $p_project );
        }
    }
}