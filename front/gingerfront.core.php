<?php
/* GINGER CORE */
function ginger_get_text_iframe($option_ginger_bar){

    if($option_ginger_bar['ginger_Iframe_text']):
        $ginger_iframe_text = $option_ginger_bar['ginger_Iframe_text'];
        $ginger_iframe_text = str_replace('</', '<\/', $ginger_iframe_text);
        $ginger_iframe_text = str_replace( array("\n", "\r"), "<br \/>", $ginger_iframe_text );
    else:
        $ginger_iframe_text = 'This website uses cookies.';
    endif;

    $ginger_iframe_text = '<!--googleoff: index-->'.$ginger_iframe_text.'<!--googleon: index-->';
    $ginger_iframe_text = apply_filters("ginger_text_iframe", $ginger_iframe_text);
    return $ginger_iframe_text;
}

function ginger_get_text_banner($option_ginger_bar){
    if($option_ginger_bar['ginger_banner_text']):
        $ginger_text = $option_ginger_bar['ginger_banner_text'];
        $ginger_text = str_replace('</', '<\/', $ginger_text);
        $ginger_text = str_replace( array("\n", "\r"), "<br \/>", $ginger_text );
        //Recupero privacy policy se presente
        if(strpos($ginger_text, '{{privacy_page}}') !== false):
            $privacy_policy = get_option('ginger_policy', true);
            $privacy_policy_page = get_post($privacy_policy);
            if($privacy_policy_page){
                $privacy_policy_text = ' <a href="' . get_permalink($privacy_policy_page->ID) . '">' . addslashes($privacy_policy_page->post_title) . '<\/a>';
            $ginger_text = str_replace('{{privacy_page}}', $privacy_policy_text, $ginger_text);
            }
        endif;

    else:
        $ginger_text = 'This website uses cookies.';
    endif;

    $ginger_text = '<!--googleoff: index-->'.$ginger_text.'<!--googleon: index-->';
    $ginger_text = apply_filters("ginger_text_banner", $ginger_text);
    return $ginger_text;
}

function ginger_get_label_accept_cookie($option_ginger_bar){

    //Recupero Label
    if($option_ginger_bar['accept_cookie_button_text']):
        $label_accept_cookie =  $option_ginger_bar['accept_cookie_button_text'];
    else:
        $label_accept_cookie = __('Enable Cookies', 'ginger');
    endif;

    $label_accept_cookie = apply_filters("ginger_label_accept_cookie", $label_accept_cookie);

    return $label_accept_cookie;
}

function ginger_get_label_disable_cookie($option_ginger_bar){

//Recupero Label
if(isset($option_ginger_bar['disable_cookie_button_text']) && $option_ginger_bar['disable_cookie_button_text']):
    $label_disable_cookie =  $option_ginger_bar['disable_cookie_button_text'];
else:
    $label_disable_cookie = __('Disable Cookies', 'ginger');
endif;

    $label_disable_cookie = apply_filters("ginger_label_disable_cookie", $label_disable_cookie);

    return $label_disable_cookie;
}


//Ginger Start
function ginger_run(){
    if(is_feed()) return;
    $option_ginger_general = get_option('ginger_general');
    if(isset($option_ginger_general['ginger_logged_users']) && $option_ginger_general['ginger_logged_users']=='1' && is_user_logged_in()) return;
    if((isset($option_ginger_general['pagine_escluse'])) && (!empty($option_ginger_general['pagine_escluse']))):

        $pagine=array();



        foreach ($option_ginger_general['pagine_escluse'] as $array_pagine):


            $pagine[] = $array_pagine['select-input'];
           // $pagine=array_push($pagine, $array_pagine['select-input']);
        endforeach;
        $id_current=get_the_id();
        if (in_array($id_current, $pagine)):
            return;
        endif;

    endif;

    if(!(isset($option_ginger_general['enable_ginger']) && $option_ginger_general['enable_ginger'] == 1)) return;
    if(isset($_COOKIE['ginger-cookie']) && $_COOKIE['ginger-cookie'] == 'Y'):
        if(isset($option_ginger_general['ginger_cache']) && $option_ginger_general['ginger_cache'] == 'no') return;
    endif;
 

    if(isset($option_ginger_general['ginger_opt']) && $option_ginger_general['ginger_opt'] == 'in'):

        ob_start();
        add_action('shutdown', '__shutdown', 0);
        add_filter('final_output', 'ginger_parse_dom');
    endif;
}
add_action('wp', 'ginger_run');



function __shutdown(){
    $final = '';

    // We'll need to get the number of ob levels we're in, so that we can iterate over each, collecting
    // that buffer's output into the final output.
    $levels = count(ob_get_level());

    for ($i = 0; $i < $levels; $i++){
        $final .= ob_get_clean();
    }

    // Apply any filters to the final output
    echo apply_filters('final_output', $final);
}




function ginger_parse_dom($output){

    $ginger_script_tags = array(
        'platform.twitter.com/widgets.js',
        'apis.google.com/js/plusone.js',
        'apis.google.com/js/platform.js',
        'connect.facebook.net',
        'platform.linkedin.com',
        'assets.pinterest.com',
        'www.youtube.com/iframe_api',
        'www.google-analytics.com/analytics.js',
        'google-analytics.com/ga.js',
        'new google.maps.',
        '_getTracker',
        'disqus.com',
    );
    $ginger_script_tags = apply_filters('ginger_script_tags', $ginger_script_tags);
       $ginger_script_async_tags = array(
        'addthis.com',
        'sharethis.com'
    );
    $ginger_script_async_tags = apply_filters('ginger_script_async_tags', $ginger_script_async_tags);
    $ginger_iframe_tags = array(
        'youtube.com',
        'platform.twitter.com',
        'www.facebook.com/plugins/like.php',
        'www.facebook.com/plugins/likebox.php',
        'apis.google.com',
        'www.google.com/maps/embed/',
        'player.vimeo.com',
        'disqus.com'
    );
    $ginger_iframe_tags = apply_filters('ginger_add_iframe', $ginger_iframe_tags);


    if(strpos($output, '<html') === false):
        return $output;
    elseif(strpos($output, '<html') > 200 ):
        return $output;
    endif;
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->encoding = 'utf-8';
    $doc->loadHTML(mb_convert_encoding($output, 'HTML-ENTITIES', 'UTF-8'));
    // get all the script tags
    $script_tags = $doc->getElementsByTagName('script');
    $async_array = array();
    $domElemsToRemove = array();
    foreach($script_tags as $script):
        $src_script =  $script->getAttribute('src');
        if($src_script):
            if(strpos_arr($src_script, $ginger_script_tags) !== false ):
                $script->setAttribute("class", "ginger-script");
                $script->setAttribute("type", "text/plain");
                continue;
            endif;
            if(strpos_arr($src_script, $ginger_script_async_tags) !== false ):
                //return print_r($script->nodeValue);
                $async_array[] = $src_script;
                $domElemsToRemove[] = $script;
                continue;
            endif;
        endif;
        if($script->nodeValue):
            $key = strpos_arr($script->nodeValue, $ginger_script_tags);
            if($key !== false ):
                if($ginger_script_tags[$key] == 'www.google-analytics.com/analytics.js' || $ginger_script_tags[$key] == 'google-analytics.com/ga.js')
                    if(strpos($script->nodeValue, 'anonymizeIp') !== false ):
                        continue;
                    endif;
                $script->setAttribute("class", "ginger-script");
                $script->setAttribute("type", "text/plain");
                if($ginger_script_tags[$key] == 'disqus.com/embed.js' || $ginger_script_tags[$key] == 'disqus.com'):
                    $script->setAttribute("class", "ginger-script");
                    $script->setAttribute("type", "text/plain");
                endif;
            endif;
        endif;
    endforeach;
    foreach( $domElemsToRemove as $domElement ){
        $domElement->parentNode->removeChild($domElement);
    }
    // get all the iframe tags
    $iframe_tags = $doc->getElementsByTagName('iframe');
    foreach($iframe_tags as $iframe):
        $src_iframe =  $iframe->getAttribute('src');
        if($src_iframe):
            if(strpos_arr($src_iframe, $ginger_iframe_tags) !== false ):
                $iframe->removeAttribute('src');
                $iframe->setAttribute("data-ce-src", $src_iframe);
                if($iframe->hasAttribute('class')):
                    $addclass = $iframe->getAttribute('class');
                else:
                    $addclass = '';
                endif;
                $iframe->setAttribute("class", "ginger-iframe " . $addclass);
            endif;
        endif;
    endforeach;
    if(!empty($async_array)):
        $text = json_encode($async_array);
        $text = 'var async_ginger_script = ' . $text . ';';
        $head = $doc->getElementsByTagName('head')->item(0);
        $element = $doc->createElement('script', $text);
        $head->appendChild($element);
    endif;

    // get the HTML string back
    $output = $doc->saveHTML();
    libxml_use_internal_errors(false);
    return $output;
}

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $key => $what) {
        if(($pos = strpos($haystack, $what))!==false) return $key;
    }
    return false;
}

