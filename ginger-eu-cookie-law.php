<?php
/*
Plugin Name: Ginger - EU Cookie Law
Plugin URI: http://www.ginger-cookielaw.com/
Description: Make your website compliant with EU Cookie Policy! Now totally free and unlocked
Version: 4.0
Author: Manafactory
Author URI: http://manafactory.it/
License: GPLv2 or later
Text Domain: ginger
*/

if ( !defined('ABSPATH')) exit;

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
