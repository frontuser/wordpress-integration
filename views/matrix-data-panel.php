<form method="post" action="<?php echo admin_url("admin.php?page=matrixdata"); ?>">
    <div id="product_attributes" class="panel matrixdata-wrapper">
        <div class="fu-metaboxes">
            <table width="100%">
                <tr>
                    <td width="70%" valign="top">
                        <h2>
                            <span>User Data:</span>
                            <button type="button" class="button add_attribute" data-type="userattribute">
                                <?php _e('Add User Attribute','frontuser'); ?>
                            </button>
                            <div class="clear"></div>
                        </h2>
                        <div class="metabox-content user_attributes">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td width="30%">Key</td>
                                        <td width="50%">Value</td>
                                        <td align="left"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hidden">
                                        <td width="30%"><input type="text" class="attribute_name" name="user_attribute_name[]" value="" /></td>
                                        <td width="50%">
	                                        <?php $attributes = array('ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url', 'user_registered', 'user_activation_key', 'user_status', 'display_name'); ?>
                                            <select class="attribute_values" name="user_attribute_values[]" >
		                                        <?php foreach ($attributes as $val) { ?>
                                                    <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
		                                        <?php } ?>
                                            </select>
                                        </td>
                                        <td align="left">
                                            <div class="actions">
                                                <button type="button" class="button remove_attribute"><span class="dashicons-trash"></span></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                        if(!empty( $user_attributes)) {
                                            foreach ($user_attributes as $key => $value) {
                                                ?>
                                    <tr>
                                        <td width="30%"><input type="text" class="attribute_name" name="user_attribute_name[]" value="<?php echo $key; ?>" /></td>
                                        <td width="50%">
	                                        <?php $attributes = array('ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url', 'user_registered', 'user_activation_key', 'user_status', 'display_name'); ?>
                                            <select class="attribute_values" name="user_attribute_values[]" >
		                                        <?php foreach ($attributes as $val) { ?>
                                                    <option value="<?php echo $val; ?>" <?php if($val == $value) { echo 'selected="selected"'; } ?> ><?php echo $val; ?></option>
		                                        <?php } ?>
                                            </select>
                                        </td>
                                        <td align="left">
                                            <div class="actions">
                                                <button type="button" class="button remove_attribute"><span class="dashicons-trash"></span></button>
                                            </div>
                                        </td>
                                    </tr>
	                                            <?php
                                            }
                                        } else {
	                                        ?>
                                            <tr class="nodata">
                                                <td colspan="3"><p>No custom attribute added yet</p></td>
                                            </tr>
	                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="toolbar no-border">
            <?php submit_button('Save attributes'); ?>
        </div>
    </div>
</form>