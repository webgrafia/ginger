<?php
/**
 * Date: 22/07/15
 * Time: 23.05
 */
?>

    <div class="wrap">
        <h2><?php _e("Custom Javascript Configuration", "ginger"); ?></h2>

        <p><?php _e("Add here the javascript url that you want to block in relation to user's choice (if are not included in default ginger setup). <br>Mark <i>asynchronous</i> mode only if standard mode is not working properly!", "ginger"); ?></p>
        <hr>

        <form method="post" action="admin.php?page=<?php echo $_GET["page"]; ?>"  class="repeater" >
            <?php wp_nonce_field('save_ginger_jscustom', 'ginger_options'); ?>

            <div data-repeater-list="ginger_urls">
                <?php

                if (is_array($options)) {
                    foreach ($options as $option) {
                        ?>
                        <div data-repeater-item style="margin-top: 20px;">

                            <small><?php _e("URL", "ginger"); ?>:</small> <input type="text" name="ginger_url" id="ginger_url" value="<?php echo $option["ginger_url"]; ?>" size="40"/>

                            | <small><?php _e("Enable", "ginger"); ?>:</small> <input type="checkbox" name="ginger_url_enable" value="1" <?php if(isset($option["ginger_url_enable"][0]) && $option["ginger_url_enable"][0]) echo ' checked="checked"'; ?> >
                            | <small><?php _e("Asynchronous mode", "ginger"); ?>:</small> <input type="checkbox" name="ginger_url_async" value="1" <?php if(isset($option["ginger_url_async"][0]) && $option["ginger_url_async"][0]) echo ' checked="checked"'; ?> >
                            | <input data-repeater-delete type="button" value="Delete" class="button button-primary small" />
                        </div>

                    <?php
                    }
                }else{
                    ?>
                    <div data-repeater-item style="margin-top: 20px;">

                        <small><?php _e("URL", "ginger"); ?>:</small> <input type="text" name="ginger_url" id="ginger_url" value="" size="40"/>

                        | <small><?php _e("Enable", "ginger"); ?>:</small> <input type="checkbox" name="ginger_url_enable" value="1" checked="checked">
                        | <small><?php _e("Asynchronous mode", "ginger"); ?>:</small> <input type="checkbox" name="ginger_url_async" value="1" >
                        | <input data-repeater-delete type="button" value="Delete" class="button button-primary small" />
                    </div>
                <?php

                }
                ?>


            </div>
            <p style="margin-top: 20px"><input data-repeater-create type="button" class="button button-secondary" value=" + Add Url + "/></p>
            <input type="hidden" name="action" value="saveurl">
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e("Save Changes", "ginger"); ?>"></p>


        </form>



        <script src="../wp-content/plugins/ginger/admin/js/jquery.repeater-master/jquery.repeater.js"></script>
        <script>
            jQuery(document).ready(function () {
                'use strict';
                jQuery('.repeater').repeater({
                    defaultValues: {
                        //'textarea-input': 'foo',
                        'ginger_url': '',
                        //'select-input': 'B',
                        //'checkbox-input': ['A', 'B'],
                        'ginger_url_enable': '1'
                    },
                    show: function () {
                        jQuery(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if(confirm('Are you sure you want to delete this element?')) {
                            jQuery(this).slideUp(deleteElement);

                        }

                    }
                });
            });
        </script>


    </div>
