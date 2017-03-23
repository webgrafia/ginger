<?php
//Logger
global $ginger_logger_db_version;
$ginger_logger_db_version = '4.0';

function ginger_logger_update_db_check() {
    global $ginger_logger_db_version;
    if ( get_site_option( 'ginger_logger_db_version' ) != $ginger_logger_db_version ) {
        ginger_logger_create_table();
    }
}
add_action( 'plugins_loaded', 'ginger_logger_update_db_check' );

function ginger_logger_create_table(){

    global $wpdb;
    $table_name = $wpdb->prefix . 'logger_ginger';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		id int(10) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		ipaddress varchar(45),
		url text NOT NULL,
		status varchar(1) DEFAULT 'Y' NOT NULL,
		UNIQUE KEY id (id)
    	) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta( $sql );

}

require_once('ginger.logger.php');

