<?php


add_action('ginger_add_menu', 'add_ginger_jscustom');
function add_ginger_jscustom(){
    add_submenu_page( 'ginger-setup', "Ginger JsCustom", __("Custom JS", "ginger"), 'manage_options', 'ginger-jscustom', 'ginger_jscustom_menu_page');
    add_submenu_page( 'ginger-setup', "Ginger Iframe Custom", __("Custom Iframe", "ginger"), 'manage_options', 'ginger-iframe', 'ginger_iframe_menu_page');
}


function ginger_jscustom_menu_page(){


    $key = "ginger_jscustom_options";
    if(isset($_POST["submit"]) && !wp_verify_nonce($_POST['ginger_options'], 'save_ginger_jscustom')){
        return;
    }

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "saveurl"){
    $params = $_POST["ginger_urls"];
    update_option($key, $params);
    echo '<div class="updated"><p>'.__( 'Updated!', 'ginger' ).'</p></div>';
}

    $options = get_option($key);
    include("page/ginger-jscustom.php");

}


function ginger_iframe_menu_page(){

    $key = "ginger_iframecustom_options";
    if(isset($_POST["submit"]) && !wp_verify_nonce($_POST['ginger_options'], 'save_ginger_jscustom')){
        return;
    }

    if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "saveurl"){
        $params = $_POST["ginger_urls"];
        update_option($key, $params);
        echo '<div class="updated"><p>'.__( 'Updated!', 'ginger' ).'</p></div>';
    }

    $options = get_option($key);

    include("page/ginger-iframe.php");


}


add_filter("ginger_script_tags", "ginger_jscustom_tags");
function ginger_jscustom_tags($array){
    $key = "ginger_jscustom_options";
    $options = get_option($key);
    if($options == "") return $array;
    // cicle over params to get sync
    foreach ($options as $option) {
        if(isset($option["ginger_url_enable"][0]) && $option["ginger_url_enable"][0]){
            if(!isset($option["ginger_url_async"][0]) || !$option["ginger_url_async"][0]){
                $array[]=$option["ginger_url"];
            }
        }
    }
    return $array;
}


add_filter("ginger_script_async_tags", "ginger_jscustom_async_tags");
function ginger_jscustom_async_tags($array){
    $key = "ginger_jscustom_options";
    $options = get_option($key);
    if($options == "") return $array;
    // cicle over params to get sync
    foreach ($options as $option) {
        if(isset($option["ginger_url_enable"][0]) && $option["ginger_url_enable"][0]){
            if(isset($option["ginger_url_async"][0]) && $option["ginger_url_async"][0]){
                $array[]=$option["ginger_url"];
            }
        }
    }
    return $array;
}

add_filter("ginger_add_iframe", "ginger_iframe_async_tags");
function ginger_iframe_async_tags($array){
    $key = "ginger_iframecustom_options";
    $options = get_option($key);
    if($options == "") return $array;
    // cicle over params to get sync
    foreach ($options as $option) {
        if($option["ginger_url_enable"][0]){
                $array[]=$option["ginger_url"];
        }
    }
    return $array;
}
