<?php
/**
 * File per la gestione ed erigazione di script e style nella head e footer
 */


/*
 * wp_head()
 */

// Registro style di base
add_action( 'wp_enqueue_scripts', 'ginger_style_script' );
function ginger_style_script() {
    $option_ginger_bar = get_option('ginger_banner');
    if(isset($_COOKIE['ginger-cookie']) && $_COOKIE['ginger-cookie'] == 'N' || $option_ginger_bar['ginger_banner_type'] == 'dialog'):
        wp_register_style( 'ginger-style-dialog', plugin_dir_url( __FILE__ ) . 'css/cookies-enabler-dialog.css' );
        wp_enqueue_style( 'ginger-style-dialog' );
    else:
        wp_register_style( 'ginger-style', plugin_dir_url( __FILE__ ) . 'css/cookies-enabler.css' );
        wp_enqueue_style( 'ginger-style' );
    endif;
    wp_enqueue_script('ginger-cookies-enabler', plugin_dir_url( __FILE__ ) . "js/cookies-enabler.min.js" );
}

//Aggioungo i custom style
add_action('wp_head', 'ginger_custom_style' );
function ginger_custom_style(){
    $option_ginger_general = get_option('ginger_general');
    $option_ginger_bar = get_option('ginger_banner');
    if($option_ginger_general['enable_ginger'] != 1) return;
    //Recupero style custom
    if($option_ginger_bar['background_color'] || $option_ginger_bar['text_color'] || $option_ginger_bar['link_color'] || $option_ginger_bar['ginger_css'] || $option_ginger_bar['button_color'] || $option_ginger_bar['button_text_color']): ?>
        <style>
            .ginger_container.<?php echo $option_ginger_bar['theme_ginger']; ?>{
            <?php if($option_ginger_bar['background_color']): ?> background-color: <?php echo $option_ginger_bar['background_color']; ?>;<?php endif; ?>
            <?php if($option_ginger_bar['text_color']): ?> color: <?php echo $option_ginger_bar['text_color']; ?>;<?php endif; ?>
            }
            <?php if($option_ginger_bar['button_color']): ?>
            a.ginger_btn.ginger-accept, a.ginger_btn.ginger-disable, .ginger_btn{
                background: <?php echo $option_ginger_bar['button_color']; ?> !important;
            }
            a.ginger_btn.ginger-accept:hover, a.ginger_btn.ginger-disable:hover, .ginger_btn{
                background: <?php echo $option_ginger_bar['button_color']; ?> !important;
            }
            <?php endif; ?>
            <?php if($option_ginger_bar['button_text_color']): ?>
            a.ginger_btn {
                color: <?php echo $option_ginger_bar['button_text_color']; ?> !important;
            }
            <?php endif; ?>
            <?php if($option_ginger_bar['link_color']): ?>
            .ginger_container.<?php echo $option_ginger_bar['theme_ginger']; ?> a{
            <?php if($option_ginger_bar['link_color']): ?> color: <?php echo $option_ginger_bar['link_color']; ?>;<?php endif; ?>
            }
            <?php endif;?>
            <?php if($option_ginger_bar['ginger_css']): ?>
            <?php echo $option_ginger_bar['ginger_css']; ?>
            <?php endif;?>
        </style>
    <?php endif;
}

/*
 * wp_footer()
 */

add_action('wp_footer', 'ginger_script', 100);
function ginger_script(){ ?>
    <?php
    //Recupero le informazioni necessarie per stampare il banner
    $option_ginger_general = get_option('ginger_general');
    $option_ginger_policy = get_option('ginger_policy_disable_ginger');

    $id_privacy_policy = get_option('ginger_policy');
    $id_current=get_the_id();

    if((isset($option_ginger_general['pagine_escluse'])) && (!empty($option_ginger_general['pagine_escluse']))):
        $pagine=array();
        foreach ($option_ginger_general['pagine_escluse'] as $array_pagine):
            $pagine[] = $array_pagine['select-input'];
           // $pagine=array_push($pagine, $array_pagine['select-input']);
        endforeach;
        if ($id_current && in_array($id_current, $pagine)):
            return;
        endif;
    endif;

    if(isset($option_ginger_general['ginger_logged_users']) && $option_ginger_general['ginger_logged_users']=='1' && is_user_logged_in()) return;
    $option_ginger_bar = get_option('ginger_banner');
    if($option_ginger_general['enable_ginger'] != 1) return;
    //Verifoco la tipologia di accettazione dei cookie
    if($option_ginger_general['ginger_scroll'] ==  1):
        $type_scroll = 'true';
    else:
        $type_scroll = 'false';
    endif;
    //Verifico se è abilitato il click sulla pagina
    if($option_ginger_general['ginger_click_out'] == 1):
        $click_outside = 'true';
    else:
        $click_outside = 'false';
    endif;
    if ($id_current==$id_privacy_policy && $option_ginger_policy == 1):

        $click_outside = 'false';
        $type_scroll = 'false';
    endif;
    //Verifico se è abilitato il forceReload
    if($option_ginger_general['ginger_force_reload'] == 1):
        $ginger_force_reload = 'true';
    else:
        $ginger_force_reload = 'false';
    endif;
    //Recupero le impostazioni per il banner
    //Testo Banner
    $ginger_text = ginger_get_text_banner($option_ginger_bar);

    //Definisco se è bar modal top o bottom
    if($option_ginger_bar['ginger_banner_position'] == 'top'):
        $banner_class = 'top';
    else:
        $banner_class = 'bottom';
    endif;
    if($option_ginger_bar['ginger_banner_type'] == 'dialog'):
        $banner_class .= ' dialog';
    endif;
    if($option_ginger_bar['theme_ginger'] == 'dark'):
        $banner_class .= ' dark';
    else:
        $banner_class .= ' light';
    endif;
    //Recupero Testo Iframe

    $ginger_iframe_text = ginger_get_text_iframe($option_ginger_bar);
    $label_accept_cookie = ginger_get_label_accept_cookie($option_ginger_bar);
    $label_disable_cookie = ginger_get_label_disable_cookie($option_ginger_bar);

?>

    <!-- Init the script -->
    <script>
        COOKIES_ENABLER.init({
            scriptClass: 'ginger-script',
            iframeClass: 'ginger-iframe',
            acceptClass: 'ginger-accept',
            disableClass: 'ginger-disable',
            dismissClass: 'ginger-dismiss',
            bannerClass: 'ginger_banner-wrapper',
            bannerHTML:
                document.getElementById('ginger-banner-html') !== null ?
                    document.getElementById('ginger-banner-html').innerHTML :
                    '<div class="ginger_banner <?php echo $banner_class; ?> ginger_container ginger_container--open">'
                    <?php if($option_ginger_bar['ginger_banner_type'] == 'dialog'): ?>
                        +'<p class="ginger_message">'
                        +'<?php echo $ginger_text; ?>'
                        +'</p>'
                        +'<a href="#" class="ginger_btn ginger-accept ginger_btn_accept_all">'
                        + '<?php echo $label_accept_cookie; ?>'
                        +'<\/a>'
                        <?php if($option_ginger_bar['disable_cookie_button_status'] != 0 && $option_ginger_general['ginger_opt'] != 'out'): ?>
                        + '<a href="#" class="ginger_btn ginger-disable ginger_btn_accept_all">'
                        + '<?php echo $label_disable_cookie; ?>'
                        + '<\/a>'
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(isset($option_ginger_bar['disable_cookie_button_status']) && $option_ginger_bar['disable_cookie_button_status'] != 0 && $option_ginger_general['ginger_opt'] != 'out'): ?>
                        + '<a href="#" class="ginger_btn ginger-disable ginger_btn_accept_all">'
                        + '<?php echo $label_disable_cookie; ?>'
                        + '<\/a>'
                        <?php endif; ?>
                        +'<a href="#" class="ginger_btn ginger-accept ginger_btn_accept_all">'
                        + '<?php echo $label_accept_cookie; ?>'
                        +'<\/a>'
                        +'<p class="ginger_message">'
                        +'<?php echo $ginger_text; ?>'
                        +'</p>'
                    <?php endif; ?>
                    +'<\/div>',
            <?php if(isset($option_ginger_bar['disable_cookie_button_status']) &&  $option_ginger_bar['disable_cookie_button_status'] != 0 && $option_ginger_general['ginger_opt'] != 'out' && $option_ginger_general['ginger_keep_banner'] == 1): ?>
            forceEnable: true,
            forceBannerClass: 'ginger-banner bottom dialog force <?php echo $option_ginger_bar['theme_ginger']; ?> ginger_container',
            forceEnableText:
                '<p class="ginger_message">'
                +'<?php echo $ginger_text; ?>'
                +'</p>'
                +'<a href="#" class="ginger_btn ginger-accept ginger_btn_accept_all">'
                + '<?php echo $label_accept_cookie; ?>'
                +'<\/a>',
            <?php endif; ?>
            <?php if($option_ginger_general['ginger_cookie_duration']): ?>
            cookieDuration: <?php echo $option_ginger_general['ginger_cookie_duration']; ?>,
            <?php endif; ?>
            eventScroll: <?php echo $type_scroll; ?>,
            scrollOffset: 20,
            clickOutside: <?php echo $click_outside; ?>,
            cookieName: 'ginger-cookie',
            forceReload: <?php echo $ginger_force_reload; ?>,
            iframesPlaceholder: true,
            iframesPlaceholderClass: 'ginger-iframe-placeholder',
            iframesPlaceholderHTML:
                document.getElementById('ginger-iframePlaceholder-html') !== null ?
                    document.getElementById('ginger-iframePlaceholder-html').innerHTML :
                '<p><?php echo $ginger_iframe_text;  ?>'
                +'<a href="#" class="ginger_btn ginger-accept"><?php echo $label_accept_cookie; ?></a>'
                +'<\/p>'
        });
    </script>
    <!-- End Ginger Script -->

<?php }


