<table class="form-table striped">
    <thead>
    <tr>
        <td colspan="2">
            <h2><?php _e("Banner Setup", "ginger"); ?></h2>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Choose Banner Type", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Choose Banner Type", "ginger"); ?></span></legend>
                <p><label><input name="ginger_banner_type" type="radio" value="bar"
                                 class="tog" <?php if ($options["ginger_banner_type"] == "bar") echo ' checked="checked" '; ?>><?php _e("Bar", "ginger"); ?>
                    </label></p>

                <p><label><input name="ginger_banner_type" type="radio" value="dialog"
                                 class="tog" <?php if ($options["ginger_banner_type"] == "dialog") echo ' checked="checked" '; ?>><?php _e("Dialog", "ginger"); ?>
                    </label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Banner Position", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Banner Position", "ginger"); ?></span></legend>
                <p><label><input name="ginger_banner_position" type="radio" value="top"
                                 class="tog" <?php if ($options["ginger_banner_position"] == "top") echo ' checked="checked" '; ?>><?php _e("Top", "ginger"); ?>
                    </label></p>

                <p><label><input name="ginger_banner_position" type="radio" value="bottom"
                                 class="tog" <?php if ($options["ginger_banner_position"] == "bottom") echo ' checked="checked" '; ?>><?php _e("Bottom", "ginger"); ?>
                    </label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Banner Text", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Banner Text", "ginger"); ?></span></legend>
                <p><label><?php
                        if (function_exists("wp_editor"))
                            wp_editor(stripslashes($options["ginger_banner_text"]), "ginger_bar_text", array('textarea_name' => "ginger_banner_text", 'media_buttons' => false, 'textarea_rows' => 3, 'teeny' => true));
                        else
                            echo '<textarea name = "ginger_banner_text" >' . $options["ginger_banner_text"] . '</textarea>';
                        ?>
                        <br>
                        <small><?php _e('You can use syntax <code><input type="text" value="{{privacy_page}}" style="border:none; width: 160px; text-align:center;"></code> to link Privacy Police Page defined in <a href="admin.php?page=ginger-setup&tab=policy">Privacy Policy Tab</a>', "ginger"); ?></small>
                    </label>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Iframe Text", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Iframe Text", "ginger"); ?></span></legend>
                <p><label><?php
                        if (function_exists("wp_editor"))
                            wp_editor(stripslashes($options["ginger_Iframe_text"]), "ginger_Iframe_text", array('textarea_name' => "ginger_Iframe_text", 'media_buttons' => false, 'textarea_rows' => 3, 'teeny' => true));
                        else
                            echo '<textarea name = "ginger_Iframe_text" >' . $options["ginger_Iframe_text"] . '</textarea>';

                        ?></label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Customize your banner buttons", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Iframe Text", "ginger"); ?></span></legend>
                <p>
                    <label><b><?php _e("Accept cookie Button", "ginger"); ?></b></label>
                </p>

                <p>
                    <label><?php _e("Text", "ginger"); ?></label>
                    <input name="accept_cookie_button_text" id="accept_cookie_button_text" type="text"
                           value="<?php if ($options['accept_cookie_button_text'] != "") {
                               echo $options['accept_cookie_button_text'];
                           } else {
                               echo _e('Accept Cookie', 'ginger');
                           } ?>">
                </p>

                <p>
                    <label><b><?php _e("Disable cookie Button", "ginger"); ?></b></label>
                </p>

                <p>
                    <label><?php _e("Text", "ginger"); ?></label>
                    <input name="disable_cookie_button_text" id="disable_cookie_button_text" type="text"
                           value="<?php if (isset($options['disable_cookie_button_text']) && $options['disable_cookie_button_text'] != "") {
                               echo $options['disable_cookie_button_text'];
                           } else {
                               echo _e('Disable Cookie', 'ginger');
                           } ?>" <?php if (!(isset($options['disable_cookie_button_status']) && $options['disable_cookie_button_status'] == "1")) {
                        echo 'disabled=true';
                    } ?>>
                    <?php echo _e('Enable:', 'ginger') ?>&nbsp;
                    <input type="checkbox" id="disable_cookie_button_status" name="disable_cookie_button_status"
                           value="1" <?php if (isset($options['disable_cookie_button_status']) && $options['disable_cookie_button_status'] == "1") {
                        echo 'checked';
                    } ?>
                           onclick="en_dis_able_text_banner_button('disable_cookie_button_status','disable_cookie_button_text','img_disable_cookie_button_status');">


                    <img id="img_disable_cookie_button_status"
                         src="<?php if (isset($options['disable_cookie_button_status']) &&  $options['disable_cookie_button_status'] == "1") {
                             echo plugins_url('ginger/img/ok.png');
                         } else {
                             echo plugins_url('ginger/img/xx.png');
                         } ?>" style="max-width: 20px; max-height: 20px; vertical-align: middle">


                </p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Choose Ginger Theme", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Choose Ginger Theme", "ginger"); ?></span></legend>
                <p><label><input name="theme_ginger" type="radio" value="light"
                                 class="tog" <?php if ($options["theme_ginger"] == "light") echo ' checked="checked" '; ?>><?php _e("Light Theme", "ginger"); ?>
                    </label></p>

                <p><label><input name="theme_ginger" type="radio" value="dark"
                                 class="tog" <?php if ($options["theme_ginger"] == "dark") echo ' checked="checked" '; ?>><?php _e("Dark Theme", "ginger"); ?>
                    </label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php _e("Customize your Ginger theme", "ginger"); ?></h2>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Background", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Background", "ginger"); ?></span></legend>
                <p><label><input type="text" name="background_color" value="<?php echo $options["background_color"]; ?>"
                                 class="color-field"></label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Text", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Text", "ginger"); ?></span></legend>
                <p><label><input type="text" name="text_color" value="<?php echo $options["text_color"]; ?>"
                                 class="color-field"></label></p>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Button", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Button", "ginger"); ?></span></legend>
                <p><label><input type="text" name="button_color" value="<?php echo $options["button_color"]; ?>"
                                 class="color-field"></label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Button Text Color", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Button Text Color", "ginger"); ?></span></legend>
                <p><label><input type="text" name="button_text_color" value="<?php echo $options["button_text_color"]; ?>"
                                 class="color-field"></label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Link", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Link", "ginger"); ?></span></legend>
                <p><label><input type="text" name="link_color" value="<?php echo $options["link_color"]; ?>"
                                 class="color-field"></label></p>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2><?php _e("Custom CSS", "ginger"); ?></h2>
        </td>
    </tr>
    <tr>
        <th scope="row" style="padding-left:20px;"><?php _e("Insert here your banner custom CSS", "ginger"); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><span><?php _e("Insert here your banner custom CSS", "ginger"); ?></span></legend>
                <p>
                    <label>
                        <textarea name = "ginger_css" cols="100" rows="20" class="lined"><?php echo $options["ginger_css"];?></textarea>

                    </label>
                </p>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>

<script>
jQuery(function() {
    jQuery(".lined").linedtextarea(
        {selectedLine: 1}
    );
});
</script>