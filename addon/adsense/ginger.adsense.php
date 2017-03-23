<?php
add_filter('ginger_script_async_tags', 'ginger_addsesneremover',10,3);
function ginger_addsesneremover($array){
    return array_merge($array, array('adsbygoogle', 'googlesyndication'));
}