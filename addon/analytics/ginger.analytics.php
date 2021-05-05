<?php
/**
 * Created by PhpStorm.
 * User: matteobarale
 * Date: 26/06/15
 * Time: 12:02
 */

add_action('ginger_add_menu', 'add_ginger_analytics');
function add_ginger_analytics(){
    add_submenu_page( 'ginger-setup', "Ginger Analytics", __("Google Analytics", "ginger"), 'manage_options', 'ginger-analytics', 'ginger_analytics');
}

function ginger_analytics(){
    if ( ! current_user_can( 'manage_options' ) ) die();


    $option_analitycs = get_option('gingeranalytics');
?>
    <?php
        if($_POST):
            if(isset($_POST['enable_ginger_analytics']) && $_POST['enable_ginger_analytics'] == 1):
                $content =  file_get_contents(get_bloginfo('url') .'/?analytics=check');
                $array_to_check = array(
                    'www.google-analytics.com/analytics.js',
                    'google-analytics.com/ga.js',
                    '_getTracker',
                );

                foreach($array_to_check as $check):
                    if(strpos( $content, $check) !== false):
                        $find = 'trovatocodice';
                        $_POST['enable_ginger_analytics'] = 0;
                        break;
                    endif;
                endforeach;

            endif;
            $args = array(
                'enable_ginger_analytics'       => $_POST['enable_ginger_analytics'],
                'ginger_analytics_code'         => $_POST['ginger_analytics_code'],
                'anonymize_ginger_analytics'    => $_POST['anonymize_ginger_analytics']
            );
            update_option('gingeranalytics_option', $args);
        endif;
    ?>
    <div class="wrap">
        <?php $option  = get_option('gingeranalytics_option');?>
        <h2>Ginger - Analytics Add On</h2>
        <?php if(isset($find)): ?>
            <h3><?php _e("Attenzione è stato trovato un codice analytics nella pagina", "ginger"); ?></h3>
        <?php endif; ?>
        <form method="post" action="admin.php?page=<?php echo $_GET["page"]; ?>">
            <?php wp_nonce_field('save_ginger_analytics_options', 'ginger_analytics_options'); ?>
            <table class="form-table striped">
            <thead>
            <tr>
                <td colspan="2">
                    <h3><?php _e('Impostazioni Add on', 'ginger'); ?></h3>
                </td>
            </tr>
            </thead>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Enable Ginger Analytics", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Enable Ginger Analytics", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input name="enable_ginger_analytics" type="radio" value="1" class="tog" <?php if(isset($option['enable_ginger_analytics']) && $option['enable_ginger_analytics'] == 1 ): echo 'checked'; endif;?>>Abilitato
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="enable_ginger_analytics" type="radio" value="0" class="tog" <?php if(isset($option['enable_ginger_analytics']) && $option['enable_ginger_analytics'] == 0 ): echo 'checked'; endif;?>>Disabilitato
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Codice Analytics (Ex: UA-XXXXXXX-X)", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Codice Analytics (Ex: UA-XXXXXXX-X)", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input name="ginger_analytics_code" type="text" value="<?php if(isset($option['ginger_analytics_code']) && $option['ginger_analytics_code'] != '' ): echo $option['ginger_analytics_code']; endif;?>" placeholder="<?php _e('Inserisci qui il tuo traking code', 'ginger'); ?>">
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
        </table>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e("Save Changes", "ginger"); ?>"></p>
        </form>
    </div>

<?php }


add_action( 'wp_head', 'ginger_anyltics_script_anonymize');
function ginger_anyltics_script_anonymize(){ ?>
    <?php $option  = get_option('gingeranalytics_option');?>
    <?php if( is_array( $option ) && isset( $option['enable_ginger_analytics'] ) && $option['enable_ginger_analytics'] == true && (isset($option['ginger_analytics_code']) && $option['ginger_analytics_code'] != '')) : ?>
  <script>gingeranalytics('<?php echo $option['ginger_analytics_code']; ?>')</script>
    <?php endif; ?>
<?php }

// Registro script per il controllo dello script Analytics
add_action( 'wp_enqueue_scripts', 'ginger_analytics_style_script' );
function ginger_analytics_style_script() {
        wp_register_script( 'ginger-analytics_script', plugin_dir_url( __FILE__ ) . 'gingeranalytics.min.js' );
        wp_enqueue_script( 'ginger-analytics_script' );
}

add_filter('ginger_script_tags', 'ginger_analytics_remover',10,3);
function ginger_analytics_remover($array){
    $option  = get_option('gingeranalytics_option');
    if(isset($option['enable_ginger_analytics']) && $option['enable_ginger_analytics'] == 1 ):
        $pos = array_search('www.google-analytics.com/analytics.js', $array);
        unset($array[$pos]);
        $pos = array_search('google-analytics.com/ga.js', $array);
        unset($array[$pos]);
        return $array;
    endif;
    return $array;
}
