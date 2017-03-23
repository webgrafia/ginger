<?php

?>
    <table class="form-table striped">
        <thead>
            <tr>
                <td colspan="2">
                    <h2><?php _e("Banner Dialog Setup", "ginger"); ?></h2>
                </td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Dialog Text", "ginger"); ?></th>
                <td>
                    <fieldset><legend class="screen-reader-text"><span><?php _e("DialogText", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <?php wp_editor( $options["ginger_dialog_text"], "ginger_dialog_text", array( 'textarea_name' => "ginger_dialog_text" , 'media_buttons' => false, 'textarea_rows' => 3, 'teeny' => true ) );

                                ?>

                                <br><small><?php _e('You can use syntax <code>{{privacy_page}}</code> to link Privacy Police Page defined in <a href="admin.php?page=ginger-setup&tab=policy">Privacy Policy Tab</a>', "ginger"); ?></small>
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2><?php _e("Colors", "ginger"); ?></h2>
                </td>
            </tr>

            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Background", "ginger"); ?></th>
                <td>
                    <fieldset><legend class="screen-reader-text"><span><?php _e("Background", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input type="text" name="background_color" value="<?php echo $options["background_color"]; ?>" class="color-field" >

                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Text", "ginger"); ?></th>
                <td>
                    <fieldset><legend class="screen-reader-text"><span><?php _e("Text", "ginger"); ?></span></legend>
                        <p>
                            <label>
                                <input type="text" name="text_color" value="<?php echo $options["text_color"]; ?>" class="color-field" >
                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row" style="padding-left:20px;"><?php _e("Link", "ginger"); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e("Link", "ginger"); ?></span></legend>
                        <p><label>
                                <input type="text" name="link_color" value="<?php echo $options["link_color"]; ?>" class="color-field" >

                            </label>
                        </p>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>


