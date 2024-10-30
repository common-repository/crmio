<?php
namespace crmioplugin;
class Crmio
{
    public static $class = __CLASS__;
    /**
     * @param $action_id
     */
    public static function appContent($action_id){
        global $settings_crmio;
        if ($action_id == 'crmio') {
            $crmio_url = "https://infinity.500apps.com/crmio?a=s&menu=false";
            include 'crmio_content.php';
        }
    }
    public static function action_1(){
        self::appContent('crmio');
    }
    public static function action_2(){
        self::appContent('Other');
    }
    public static function init()
    {
        add_action('admin_menu', array(__CLASS__, 'register_menu_crmio'),10,0);
    }
    public static function register_menu_crmio()
    {
        global $settings_crmio;
        add_menu_page($settings_crmio['menus']['menu'], $settings_crmio['menus']['menu'], 'manage_options', __FILE__, array(__CLASS__, 'action_1'),plugin_dir_url( __FILE__ ) . 'images/crmio_logo.png');
        add_submenu_page(__FILE__, $settings_crmio['menus']['sub_menu_title_1'], $settings_crmio['menus']['sub_menu_title_1'], 'manage_options', $settings_crmio['menus']['sub_menu_url_1'], array(__CLASS__, 'action_2'));
    }
}