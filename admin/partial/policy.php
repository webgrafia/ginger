<table class="form-table striped">
    <thead>
    <tr>
        <td colspan="2">
            <h2><?php _e("Privacy Policy Setup", "ginger"); ?></h2>
        </td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th scope="row" style="padding-left:20px;" colspan="2">
            <label>
                <input name="choice" type="radio" value="page" onclick="javascript:select_privacy_page();" <?php if ($options != "") echo ' checked="checked" '; ?>> <?php _e("Select your privacy policy page", "ginger"); ?>
            </label>
        </th>
    </tr>
    <tr>
        <td colspan="2">
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e("DialogText", "ginger"); ?></span>
                </legend>
                    <?php

                    $args = array(
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
                        'post_status' => 'publish',
                        'suppress_filters' => false
                    );
                    $pages = get_pages($args);




                    ?>
                <p>
                    <label>
                        <?php _e('Privacy Policy page', 'ginger'); ?>
                    </label>
                    <select name="ginger_privacy_page" id="privacy_page_select" <?php if ($options == "") echo ' disabled="true"'; ?>>
                            <option value=""><?php _e('Select page', 'ginger'); ?></option>
                        <?php foreach ($pages as $page) { ?>
                            <option value="<?php echo $page->ID;?>" <?php if ($options == $page->ID) echo ' selected="selected" '; ?>><?php echo $page->post_title; ?></option>
                        <?php } ?>
                    </select>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;" colspan="2">
            <label>
                <input name="choice" type="radio" value="new_page" onclick="javascript:new_privacy_page();"><?php _e("or create your privacy policy page", "ginger"); ?>
            </label>
        </th>
    </tr>
    <tr>
        <td colspan="2">
            <fieldset>
                <div id="new_page_privacy" style="display: none">
                    <p>
                        <label>
                            <?php _e("Title", "ginger"); ?><input name="privacy_page_title" id="privacy_page_title"
                                                                  type="text" value="Privacy Policy">
                        </label>
                    </p>
                    <p id="p_exist_title" style="color: #ff0000; visibility: hidden"><?php _e('Attention ! There is already a page with this title', 'ginger');?></p>
                    <p>
                        <label>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e("DialogText", "ginger"); ?></span>
                                </legend>
                                <?php
                                if (function_exists("wp_editor"))
                                    wp_editor('', "ginger_dialog_text", array('textarea_name' => "privacy_page_content", 'media_buttons' => false, 'textarea_rows' => 10, 'teeny' => true));
                                else
                                    echo "<textarea name='privacy_page_content' ></textarea>";
                                ?>
                            </fieldset>
                        </label>
                    </p>
                    <p>
                        <small style="padding-top: 20px">
                            <b>(<?php _e("If you create a new page this will be setted as Privacy Policy Page", "ginger"); ?>)</b>
                        </small>
                    </p>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Disable Click-out and Scroll to accept cookies in Privacy Policy page", "ginger"); ?></th>
        <td>
            <fieldset>
                <p>
                    <label>
                            <input name="ginger_privacy_click_scroll" type="radio" value="1" class="tog" <?php if($options2 == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="ginger_privacy_click_scroll" type="radio" value="0" class="tog" <?php if($options2 == "0") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                    </label>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Disable logging of activities and IPs", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e("Disable logging of activities and IPs", "ginger"); ?></span>
                </legend>
                <p>
                    <label>
                        <input name="ginger_disable_logger" type="radio" value="1" class="tog" <?php if($options_disable_logger == "1") echo ' checked="checked" '; ?>><?php _e("Yes", "ginger"); ?>
                    </label>
                </p>
                <p>
                    <label>
                        <input name="ginger_disable_logger" type="radio" value="0" class="tog" <?php if($options_disable_logger == "0") echo ' checked="checked" '; ?>><?php _e("No", "ginger"); ?>
                    </label>
                </p>
            </fieldset>
        </td>
    </tr>    
    </tbody>
</table>

