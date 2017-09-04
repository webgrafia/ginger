<?php
/*
Plugin Name: Ginger - EU Cookie Law
Plugin URI: http://www.ginger-cookielaw.com/
Description: Make your website compliant with EU Cookie Policy! Now totally free and unlocked
Version: 4.1.3
Author: Manafactory
Author URI: http://manafactory.it/
License: GPLv2 or later
Text Domain: ginger
*/

if ( !defined('ABSPATH')) exit;

add_action("admin_init","check_ginger_plus");
function check_ginger_plus(){
// check compatibility with old ginger plus
    if(is_plugin_active('ginger-plus/ginger-plus.php')){
        deactivate_plugins( 'ginger-plus/ginger-plus.php', true );
    }
}

load_plugin_textdomain( 'ginger', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
require_once('addon/ginger.addon.utils.php');

//Gestione Backend
if(is_admin()){
    require_once("admin/ginger.utils.php");
    require_once("admin/ginger.pointer.php");

}
//Gestione Frontend
if(!is_admin()){
    require_once("front/gingerfront.utils.php");
    require_once("front/gingerfront.core.php");
}
