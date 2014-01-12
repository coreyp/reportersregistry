<?php
/*
Plugin Name: Reporters' Registry plugin
Description: Custom functions for sites across NNN network
*/

// remove admin bar for all logged in users except admin
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('manage_network') && !is_admin()) {
  show_admin_bar(false);
}
}

// remove rich post editor 
add_filter('user_can_richedit' , create_function('' , 'return false;') , 50); 

?>