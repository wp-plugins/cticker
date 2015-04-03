<?php

function tinymce_cticker_custom_class( $init_array ) {
    $init_array['body_class'] = 'cticker_tinymce';
    return $init_array;
}
add_filter('tiny_mce_before_init', 'tinymce_cticker_custom_class');

function cticker_mce_button_add() {
    global $typenow;

    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
    }

    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;

    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "cticker_mcejs_add");
        add_filter('mce_buttons', 'cticker_register_mcebutton');
    }
}

add_action('admin_head', 'cticker_mce_button_add');

function cticker_mcejs_add($plugin_array) {
    $plugin_array['cticker_mcebutton'] = plugins_url( '../mce/js/ctickermce.js', __FILE__ );
    return $plugin_array;
}

function cticker_register_mcebutton($buttons) {
   array_push($buttons, "cticker_mcebutton");
   return $buttons;
}