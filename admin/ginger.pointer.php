<?php

if (!class_exists("gingerSimpleNote")) {
    class gingerSimpleNote
    {
        public function __construct() // Constructor
        {
            register_activation_hook(__FILE__, array($this, 'run_on_activate'));
            add_action('admin_enqueue_scripts', array($this, 'gingersimplenote_admin_scripts'));
        }

        function gingersimplenote_admin_scripts()
        {

            $seen_it = explode(',', (string)get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
            //   $seen_it  =false;

            $do_add_script = false;

            if (!in_array('gingertip1', $seen_it)) {
                // flip the flag enabling pointer scripts and styles to be added later
                $do_add_script = true;
                // hook to function that will output pointer script just for gingertip1
                add_action('admin_print_footer_scripts', array($this, 'simplenote_gingertip1_footer_script'));
            }

            // now finally enqueue scripts and styles if we ended up with do_add_script == TRUE
            if ($do_add_script) {
                // add JavaScript for WP Pointers
                wp_enqueue_script('wp-pointer');
                // add CSS for WP Pointers
                wp_enqueue_style('wp-pointer');
            }
        }

        function simplenote_gingertip1_footer_script()
        {
            // Build the main content of your pointer balloon in a variable
            $pointer_content = '<h3>' . __("Ginger Cookie Law Settings", "ginger") . '</h3>'; // Title should be <h3> for proper formatting.
            $pointer_content .= '<p>' . __("<b>One more step</b>: you need to enable banner in ", "ginger") . '<a href="';
            $pointer_content .= '?page=ginger-setup">Ginger Settings</a></p>';

            ?>
            <script type="text/javascript">// <![CDATA[
                jQuery(document).ready(function ($) {

                    if (typeof(jQuery().pointer) != 'undefined') {
                        $('#toplevel_page_ginger-setup').pointer({
                            content: '<?php echo $pointer_content; ?>',
                            position: {
                                edge: 'left',
                                align: 'center'
                            },
                            close: function () {
                                $.post(ajaxurl, {
                                    pointer: 'gingertip1',
                                    action: 'dismiss-wp-pointer'
                                });
                            }
                        }).pointer('open');
                    }
                });
                // ]]></script>
        <?php
        }

        function init_admin()
        {

        }

        function run_on_activate()
        {

        }

    }

} // End Class

// Instantiating the Class
if (class_exists("gingerSimpleNote")) {
    $gingerSimpleNote = new gingerSimpleNote();
}