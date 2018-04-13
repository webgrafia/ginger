<?php
if(isset($_GET['tab'])):
    $tab = $_GET['tab'];
    $key = "ginger_". $tab;
else:
    $tab = 'general';
    $key = "ginger_general";
endif;

if($tab == 'banner'):
    wp_enqueue_script('jquery-textarea', plugins_url('/ginger/admin/js/jquery_lined_textarea/jquery-linedtextarea.js'), array( 'jquery' ) );
    wp_enqueue_style('textarea-style', plugins_url('/ginger/admin/js/jquery_lined_textarea/jquery-linedtextarea.css'));
endif;
if($tab == 'general' || $tab==''):
    wp_enqueue_script('repeater', plugins_url('/ginger/admin/js/jquery.repeater-master/jquery.repeater.js'), array( 'jquery' ) );
endif;

if(isset($_POST["submit"]) && !wp_verify_nonce($_POST['ginger_options'], 'save_ginger_options')){
  return;
}

if(isset($_POST["submit"])){
    $params = $_POST;
    unset($params["submit"]);
    unset($params["ginger_options"]);
    unset($params["_wp_http_referer"]);

if ($key == 'ginger_banner'){

    if (isset($params["disable_cookie_button_status"]) && $params["disable_cookie_button_status"]!='1'){
        $params["disable_cookie_button_status"]='0';
    }
    if (isset($params["read_more_button_status"]) && $params["read_more_button_status"]!='1'){
        $params["read_more_button_status"]='0';
    }

}
if ($key=='ginger_policy'){
    if ($_POST["choice"]=="new_page"){

        // controllo se il nome della privacy page è già esistente.
        $title_post = sanitize_text_field($_POST["privacy_page_title"]);
        $content_post = wp_kses_post($_POST["privacy_page_content"]);
        $control_page = get_page_by_title( $title_post , '', 'page' );
        if ($control_page){
            if ($control_page->post_status == 'publish') {
                $control_page_id = $control_page->ID;
                $privacy_page_id = $control_page_id;
                echo '<div class="updated"><p>'.__( 'The page with the specified title already exists and is your current privacy policy page!', 'ginger' ).'</p></div>';

            }else{

                $id_privacy_new_page = save_privacy_page($title_post, $content_post);
                $privacy_page_id = $id_privacy_new_page;
            }

        }else{
        $id_privacy_new_page = save_privacy_page($title_post,$content_post);
        $privacy_page_id = $id_privacy_new_page;
        }

    }else{
        $privacy_page_id = intval($_POST["ginger_privacy_page"]);
    }
    if(is_int($privacy_page_id)):
        update_option($key, $privacy_page_id);
    endif;
        update_option($key.'_disable_ginger', $_POST["ginger_privacy_click_scroll"]);
        update_option($key.'_disable_logger', $_POST["ginger_disable_logger"] == '1');

}else{
    update_option($key, $params);}
    echo '<div class="updated"><p>'.__( 'Updated!', 'ginger' ).'</p></div>';
}

$options = get_option($key);
if ($key=='ginger_policy'):

    $options = get_option($key);
    // recupero la option per il disable click out e scroll in privacy policy page
    $options2 = get_option($key.'_disable_ginger');
    $options_disable_logger = get_option($key.'_disable_logger');

endif;
?>

<div class="wrap">
   <h2>Ginger - EU Cookie Law</h2>
<hr>
   <h2 class="nav-tab-wrapper">
   <a href="admin.php?page=ginger-setup" class="nav-tab <?php echo (($_GET["page"] == 'ginger-setup') && ((!isset($_GET["tab"]) ||  $_GET["tab"] == "" ) || (isset($_GET["tab"]) && $_GET["tab"] == "general"))) ? 'nav-tab-active' : ''; ?>"><?php _e("General Configuration", "ginger"); ?></a>
   <a href="admin.php?page=ginger-setup&tab=banner" class="nav-tab <?php echo (($_GET["page"] == 'ginger-setup') && (isset($_GET["tab"]) && $_GET["tab"] == "banner" )) ? 'nav-tab-active' : ''; ?>"><?php _e("Banner Setup", "ginger"); ?></a>
   <a href="admin.php?page=ginger-setup&tab=policy" class="nav-tab <?php echo (($_GET["page"] == 'ginger-setup') && (isset($_GET["tab"]) && $_GET["tab"] == "policy" )) ? 'nav-tab-active' : ''; ?>"><?php _e("Privacy Policy", "ginger"); ?></a>
       <?php  do_action("ginger_add_tab_menu"); ?>
  <a href="admin.php?page=ginger-setup&tab=more" class="nav-tab <?php echo (($_GET["page"] == 'ginger-setup') && (isset($_GET["tab"]) && $_GET["tab"] == "more" )) ? 'nav-tab-active' : ''; ?>"><?php _e("More", "ginger"); ?></a>

   </h2>
    <form method="post" action="admin.php?page=<?php echo $_GET["page"]; ?><?php if(isset($tab)) echo '&tab=' . $tab; ?>" <?php echo 'class="repeater"';?>>
        <?php wp_nonce_field('save_ginger_options', 'ginger_options'); ?>
        <?php
            switch($tab){
                case "general":
                    include('partial/general.php');
                break;
                case "banner":
                    include('partial/banner.php');
                    break;
                case "policy":
                include('partial/policy.php');
                break;
            case "more":
                include('partial/more.php');
                break;
            }
if($tab != "more"){
?>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e("Save Changes", "ginger"); ?>"></p>
    <?php
}
?>
    </form>
</div>



