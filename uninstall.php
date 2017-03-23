<?php
/**
 * Uninstall functions
 */

if ( ! current_user_can( 'activate_plugins' ) )
	return;


delete_option('ginger_general');
delete_option('ginger_banner');
delete_option('ginger_policy');
