<?php

add_action('ginger_add_menu', 'add_ginger_logger');
function add_ginger_logger(){
    add_submenu_page( 'ginger-setup', "Ginger Logger", __("Activity Logger", "ginger"), 'manage_options', 'ginger-logger', 'ginger_logger');
}

function ginger_logger(){
    global $wpdb;
    if ( ! current_user_can( 'manage_options' ) ) die();

    if(isset($_POST["submit"]) && !wp_verify_nonce($_POST['ginger_options'], 'save_ginger_logger')){
        return;
    }

    if(isset($_POST["action"]) && $_POST["action"] == "deleteall"){
        $wpdb->query( "DELETE FROM {$wpdb->prefix}logger_ginger WHERE 1" );
    }

    $option_logger = get_option('gingerlogger');
    ?>
        <div class="wrap">
            <h2>Ginger - Logger Add On</h2>
            <?php



            $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
            $limit = 20;
            $offset = ( $pagenum - 1 ) * $limit;
            $entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}logger_ginger WHERE 1 ORDER BY id DESC LIMIT $offset, $limit" );

            echo '<div class="wrap">';

            ?>
            <table class="widefat">
                <thead>
                <tr>
                    <th scope="col" class="manage-column column-name" style="">Time</th>
                    <th scope="col" class="manage-column column-name" style="">IP</th>
                    <th scope="col" class="manage-column column-name" style="">url</th>
                    <th scope="col" class="manage-column column-name" style="">Cookie</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th scope="col" class="manage-column column-name" style="">Time</th>
                    <th scope="col" class="manage-column column-name" style="">IP</th>
                    <th scope="col" class="manage-column column-name" style="">url</th>
                    <th scope="col" class="manage-column column-name" style="">Cookie</th>
                </tr>
                </tfoot>

                <tbody>
                <?php if( $entries ) { ?>

                    <?php
                    $count = 1;
                    $class = '';
                    foreach( $entries as $entry ) {
                        $class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
                        ?>

                        <tr<?php echo $class; ?>>
                            <td><?php echo $entry->time; ?></td>
                            <td><?php echo $entry->ipaddress; ?></td>
                            <td><?php echo $entry->url; ?></td>
                            <td><?php echo $entry->status; ?></td>
                        </tr>

                        <?php
                        $count++;
                    }
                    ?>

                <?php } else { ?>
                    <tr>
                        <td colspan="2">No Logs yet</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php
            $total = $wpdb->get_var( "SELECT COUNT('id') FROM {$wpdb->prefix}logger_ginger" );
            $num_of_pages = ceil( $total / $limit );
            $page_links = paginate_links( array(
                'base' => add_query_arg( 'pagenum', '%#%' ),
                'format' => '',
                'prev_text' => __( '&laquo;', 'aag' ),
                'next_text' => __( '&raquo;', 'aag' ),
                'total' => $num_of_pages,
                'current' => $pagenum
            ) );

            if ( $page_links ) {
                echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
            }

            echo '</div>';
            ?>
            <form method="post" action="admin.php?page=<?php echo $_GET["page"]; ?>"  >
              <?php wp_nonce_field('save_ginger_logger', 'ginger_options'); ?>
              <p><input type="submit" name="submit" value="<?php _e("Delete all logs", "ginger"); ?>" class="button button-primary delete-cookies"></p>
              <input type="hidden" name="action" value="deleteall">
            </form>
<script type="text/javascript">
        jQuery(document).ready(function(){
        jQuery(".delete-cookies").click(function() {
        if (!confirm("<?php _e("Are you sure? This process cannot be undone.", "ginger"); ?>")){
            return false;
        }
        });
        });
</script>
        </div>

<?php }

add_action("wp_head", "ginger_add_log_variable");
function ginger_add_log_variable(){
    ?>
    <script type="text/javascript">
        var ginger_logger = "Y";
        var ginger_logger_url = "<?php bloginfo("url"); ?>";
        var current_url = "<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>";

        function gingerAjaxLogTime(status) {
            var xmlHttp = new XMLHttpRequest();
            var parameters = "ginger_action=time";
            var url= ginger_logger_url + "?" + parameters;
            xmlHttp.open("GET", url, true);

            //Black magic paragraph
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlHttp.onreadystatechange = function() {
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    var time = xmlHttp.responseText;
                    gingerAjaxLogger(time, status);
                }
            }

            xmlHttp.send(parameters);
        }

        function gingerAjaxLogger(ginger_logtime, status) {
            console.log(ginger_logtime);
            var xmlHttp = new XMLHttpRequest();
            var parameters = "ginger_action=log&time=" + ginger_logtime + "&url=" + current_url + "&status=" + status;
            var url= ginger_logger_url + "?" + parameters;
            console.log(url);
            xmlHttp.open("GET", url, true);

            //Black magic paragraph
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlHttp.send(parameters);
        }

    </script>
    <?php
}



function ginger_do_log($url = "", $status = "Y"){
    global $wpdb;
    if($url == "")
        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $table_name = $wpdb->prefix . 'logger_ginger';
    $ipuser = ginger_get_ip_address();
    $now =  current_time( 'mysql' );
    $wpdb->insert(
        $table_name,
        array(
            'time' => $now,
            'ipaddress' => $ipuser,
            'url' => $url,
            'status' => $status
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );
}


function ginger_get_ip_address() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && ginger_validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (ginger_validate_ip($ip))
                    return $ip;
            }
        } else {
            if (ginger_validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && ginger_validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && ginger_validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && ginger_validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && ginger_validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function ginger_validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}


// init to check date and save log
add_action("init", "ginger_activity_log");
function ginger_activity_log(){
    if(!((isset($_GET["ginger_action"]) && $_GET["ginger_action"] == "time") || (isset($_GET["ginger_action"]) && $_GET["ginger_action"] == "log"))) {
        return;
    }
    if($_GET["ginger_action"] == "time"){

        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
        echo  time();
        exit;
    }
    if($_GET["ginger_action"] == "log"){
        if(!isset($_GET["url"]) || $_GET["url"] == "") exit;
        if(!isset($_GET["time"]) || $_GET["time"] == "") exit;
        if(!isset($_GET["status"]) || $_GET["status"] == "") exit;

        if(($_GET["time"] + 10) < time()) exit;
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
        // echo time();
        if(function_exists("ginger_do_log")){
            ginger_do_log($_GET["url"], $_GET["status"]);
        }
        exit;
    }

}