    <table class="form-table striped">
        <thead>
            <tr>
                <td colspan="2">
                    <h2><?php _e("Ginger is currently", "ginger"); ?>: <b><?php if(is_array($options) && $options["enable_ginger"]) _e("enabled", "ginger"); else _e("disabled", "ginger");  ?></b> </h2>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Enable Ginger", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Enable Ginger", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input name="enable_ginger" type="radio" value="1" class="tog" <?php if(is_array($options) && $options["enable_ginger"] == "1") echo ' checked="checked" '; ?>><?php _e("Enabled", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="enable_ginger" type="radio" value="0" class="tog" <?php if(is_array($options) && $options["enable_ginger"] == "0") echo ' checked="checked" '; ?>><?php _e("Disabled", "ginger"); ?>
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Do you have a cache system?", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Do you have a cache system?", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input name="ginger_cache" type="radio" value="yes" class="tog" <?php if(is_array($options) && $options["ginger_cache"] == "yes") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_cache" type="radio" value="no" class="tog" <?php if(is_array($options) && $options["ginger_cache"] == "no") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <small style="padding-top: 20px">
                                <i>(<?php _e("If you have a caching system (W3TC, Varnish, WP Super Cash...) choose YES. Ginger will optimize websites performances", "ginger"); ?>)</i>
                            </small>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Cookie Confirmation Type", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Cookie Confirmation Type", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input name="ginger_opt" type="radio" value="in" class="tog" <?php if(is_array($options) && $options["ginger_opt"] == "in") echo ' checked="checked" '; ?>><?php _e("Opt-In", "ginger"); ?>
                            </label>
                            <small>
                                (<?php _e("Cookies are disabled until banner is accepted", "ginger"); ?>)
                            </small>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_opt" type="radio" value="out" class="tog" <?php if(is_array($options) && $options["ginger_opt"] == "out") echo ' checked="checked" '; ?>><?php _e("Opt-Out", "ginger"); ?>
                            </label>
                            <small>
                                (<?php _e("Cookies are disabled only if explicitly requested", "ginger"); ?>)
                            </small>
                        </p>
                        <p>
                            <small style="padding-top: 20px">
                                <i>(<?php _e("Choose OPT-IN if you're in Italy", "ginger"); ?>)</i>
                            </small>
                        </p>
                    </fieldset>

                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Let scroll to confirm", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Let scroll to confirm", "ginger"); ?></span>
                        </legend>
                        <p>
                            <label>
                                <input name="ginger_scroll" type="radio" value="1" class="tog" <?php if(is_array($options) && $options["ginger_scroll"] == "1") echo ' checked="checked" '; ?>><?php _e("Scroll to accept cookie", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_scroll" type="radio" value="0" class="tog" <?php if(is_array($options) && $options["ginger_scroll"] == "0") echo ' checked="checked" '; ?>><?php _e("Keep banner after scroll", "ginger"); ?>
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Click out of banner to accept cookie", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Click out of banner to accept cookie", "ginger"); ?></span>
                        </legend>
                        <p>
                            <label>
                                <input name="ginger_click_out" type="radio" value="1" class="tog" <?php if(is_array($options) && $options["ginger_click_out"] == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_click_out" type="radio" value="0" class="tog" <?php if(is_array($options) && $options["ginger_click_out"] == "0") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Force reload page", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Force reload page", "ginger"); ?></span>
                        </legend>
                        <p>
                            <label>
                                <input name="ginger_force_reload" type="radio" value="1" class="tog" <?php if(is_array($options) && $options["ginger_force_reload"] == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_force_reload" type="radio" value="0" class="tog" <?php if(is_array($options) && $options["ginger_force_reload"] == "0") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Stress Mode", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Keep banner until acceptance", "ginger"); ?></span>
                        </legend>
                        <p>
                            <label>
                                <input name="ginger_keep_banner" type="radio" value="1" class="tog" <?php if(is_array($options) && $options["ginger_keep_banner"] == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_keep_banner" type="radio" value="0" class="tog" <?php if(is_array($options) && $options["ginger_keep_banner"] == "0") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <small style="padding-top: 20px">
                                <i>(<?php _e("If cookies are not accepted the banner will continues to be shown minimized", "ginger"); ?>)</i>
                            </small>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Cookies Duration", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Select cookies duration", "ginger"); ?></span>
                        </legend>
                        <p>
                            <label><?php _e("Select cookies duration", "ginger"); ?></label>
                            <select name="ginger_cookie_duration">
                                <option value=""><?php _e('Select', 'ginger')?></option>
                                <option value="1" <?php if (is_array($options) && $options['ginger_cookie_duration']=='1'){echo 'selected';}?>><?php _e('1 Day', 'ginger')?></option>
                                <option value="30" <?php if (is_array($options) && $options['ginger_cookie_duration']=='30'){echo 'selected';}?>><?php _e('1 Month', 'ginger')?></option>
                                <option value="365" <?php if (is_array($options) && $options['ginger_cookie_duration']=='365'){echo 'selected';}?>><?php _e('1 Year', 'ginger')?></option>
                                <option value="365000" <?php if (is_array($options) && $options['ginger_cookie_duration']=='365000'){echo 'selected';}?>><?php _e('For ever', 'ginger')?></option>
                            </select>
                        </p>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Disable Ginger for logged users", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span><?php _e("Disable Ginger for logged users", "ginger"); ?></span>
                        </legend>
                            <label>
<input name="ginger_logged_users" type="radio" value="1" class="tog" <?php if(is_array($options) && isset($options["ginger_logged_users"]) && $options["ginger_logged_users"] == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="ginger_logged_users" type="radio" value="0" class="tog" <?php if(is_array($options) && (!isset($options["ginger_logged_users"]) || $options["ginger_logged_users"] == "0")) echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                            </label>
                        </p>
                        </p>

                    </fieldset>
                </td>
            </tr>

            <tr>
                <th class="escludi-pagine" scope="row" style="padding-left:20px;"><?php _e("Disable Ginger for those pages", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <div data-repeater-list="pagine_escluse">
                            <?php if (is_array($options) && !empty($options['pagine_escluse'])):?>


                        <?php foreach ($options['pagine_escluse'] as $array_pagine):?>

                            <?php $args = array(
                                                'sort_order' => 'asc',
                                                'sort_column' => 'post_title',
                                                'hierarchical' => 1,
                                                'exclude' => '',
                                                'include' => '',
                                                'meta_key' => '',
                                                'meta_value' => '',
                                                'authors' => '',
                                                'child_of' => 0,
                                                'parent' => -1,
                                                'exclude_tree' => '',
                                                'number' => '',
                                                'offset' => 0,
                                                'post_type' => 'page',
                                                'post_status' => 'publish'
                                                ); 
                                $pages = get_pages($args); 
                            ?>
                            <div data-repeater-item>
                                <select name="select-input" style="min-width:30%">
                                    <option value=""><?php _e( 'Select', 'ginger'); ?></option>

                            <?php
                                foreach ($pages as $page):
                            ?>
                                    <option value="<?php echo $page->ID;?>" <?php if ($array_pagine['select-input']==$page->ID): echo "selected"; endif;?>><?php echo $page->post_title;?></option>
                            <?php
                                endforeach;    
                            ?>
                                </select>
                                <input data-repeater-delete type="button" value="<?php _e('Cancella', 'ginger'); ?>" class="button button-primary"  style="background: #F1F1F1; border-color: #B3B3B3; box-shadow: 0 1px 0 #F1F1F1; color: #444; text-shadow: 0 0 0 !important "/>
                            </div>
                            <?php endforeach;?>

                    <?php else:?>



                            <?php $args = array(
                                                'sort_order' => 'asc',
                                                'sort_column' => 'post_title',
                                                'hierarchical' => 1,
                                                'exclude' => '',
                                                'include' => '',
                                                'meta_key' => '',
                                                'meta_value' => '',
                                                'authors' => '',
                                                'child_of' => 0,
                                                'parent' => -1,
                                                'exclude_tree' => '',
                                                'number' => '',
                                                'offset' => 0,
                                                'post_type' => 'page',
                                                'post_status' => 'publish'
                                                ); 
                                $pages = get_pages($args); 
                            ?>
                            <div data-repeater-item>
                                <select name="select-input" style="min-width:30%">
                                    <option value=""><?php _e( 'Select', 'ginger'); ?></option>

                            <?php
                                foreach ($pages as $page):
                            ?>
                                    <option value="<?php echo $page->ID;?>"><?php echo $page->post_title;?></option>
                            <?php
                                endforeach;    
                            ?>
                                </select>
                                <input data-repeater-delete type="button" value="<?php _e('Delete', 'ginger'); ?>" class="button button-primary"  style="background: #F1F1F1; border-color: #B3B3B3; box-shadow: 0 1px 0 #F1F1F1; color: #444; text-shadow: 0 0 0 !important "/>
                            </div>

                    <?php endif;?>

                                

                        </div>
                        <input data-repeater-create type="button" value="<?php _e('+', 'ginger'); ?>" class="button button-primary" style="margin-top: 8px; background: #F1F1F1; border-color: #B3B3B3; box-shadow: 0 1px 0 #F1F1F1; color: #444; text-shadow: 0 0 0 !important "/>
                        <p>
                            <small style="padding-top: 20px">
                                <i>(<?php _e("Select pages in which Ginger is disabled", "ginger"); ?>)</i>
                            </small>
                        </p>
                    </fieldset>
                </td>
            </tr>        
        </tbody>
    </table>



    <script>
    jQuery(document).ready(function () {
        'use strict';
        jQuery('.repeater').repeater({
            
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
