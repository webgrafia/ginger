<?php
/**
 * Import/Export tool
 */

add_action('ginger_add_menu', 'add_ginger_export', 100);
function add_ginger_export(){
    add_submenu_page( 'ginger-setup', "Import Export", __("Import/Export", "ginger"), 'manage_options', 'ginger-export', 'ginger_export');
}


function ginger_export(){
    if(isset($_POST["submit"]) && !wp_verify_nonce($_POST['save_ginger_export_options'], 'ginger_export_options')){
        return;
    }
    if(isset($_POST["action"]) && $_POST["action"] == "import"){
        $nonce = $_REQUEST['_wpnonce'];
        if ( ! wp_verify_nonce( $nonce, 'save_ginger_export_options' ) ) {
            exit; // Get out of here, the nonce is rotten!
        }
        if($newconf = @unserialize(stripslashes($_POST["data"]))) {
            $newconf = json_decode(json_encode($newconf));
            foreach($newconf as $key => $val){
                update_option($key, $val);
            }
            echo '<div class="updated"><p>'.__( 'All done! Your configuration was saved!', 'ginger' ).'</p></div>';
        }else{
            echo '<div class="updated error"><p>'.__( 'Error! Copied text is wrong...', 'ginger' ).'</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h2>Ginger - Import/Export</h2>
        <h3><?php _e("Export", "ginger"); ?></h3>
        <p><?php _e("You can export your configuration and import it on a Ginger Managed websites!", "ginger"); ?></p>
        <p><?php _e("Simply copy & paste this code in Import Textarea:", "ginger"); ?></p>
    <textarea style="width:100%;" rows="10" ><?php
        $export = array();

        $export["ginger_general"] = get_option('ginger_general');
        $export["ginger_banner"] = get_option('ginger_banner');
        // $ $export["ginger_policy"] = get_option('ginger_policy');
        $export["gingerjscustom"] = get_option('gingerjscustom');
        $export["ginger_jscustom"]= get_option('ginger_jscustom_options');
        $export["gingeradsense"] = get_option('gingeradsense');
        $export["gingerwpml"] = get_option('gingerwpml');
        $export["ginger_wpml_options"] = get_option('ginger_wpml_options');
        $export["gingerpolylang"] = get_option('gingerpolylang');
        $export["ginger_polylang_options"] = get_option('ginger_polylang_options');
        $export["gingeranalytics"] = get_option('gingeranalytics');
        $export["gingeranalytics_option"] = get_option('gingeranalytics_option');
        echo serialize($export);
        ?></textarea>

        <input type="hidden" name="action" value="export">

        <br>
        <hr>
        <h3><?php _e("Import", "ginger"); ?></h3>

        <p><?php _e("Upload here the export file to overwrite existing settings!", "ginger"); ?></p>
        <form method="post" action="admin.php?page=<?php echo $_GET["page"]; ?>">
            <?php wp_nonce_field('save_ginger_export_options'); ?>
            <input type="hidden" name="action" value="import" >
            <textarea name="data" style="width:100%;" rows="10" ></textarea>
            <p>  <small><b><?php _e("Attention: you must define manually a privacy policy page if you are using {{privacy_policy}} shortcode!", "ginger"); ?></b></small></p>

            <input type="submit" value="<?php _e("Import Configuration", "ginger"); ?>" class="button" />
        </form>
    </div>
<?php
}