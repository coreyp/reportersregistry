<?php

/* different menus for registered users… not working :( see http://codex.wordpress.org/Function_Reference/wp_nav_menu#Different_menus_for_logged-in_users

if ( is_user_logged_in() ) {
     wp_nav_menu( array( 'top' => 'logged-in-menu' ) );
} else {
     wp_nav_menu( array( 'top' => 'logged-out-menu' ) );
} */

// advanced search library

    // require_once('wp-advanced-search/wpas.php');

// get name of current template file

add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
} 

// deregister styles for new registry request page, per http://www.advancedcustomfields.com/resources/tutorials/creating-a-front-end-form/

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
 
function my_deregister_styles() {
	wp_deregister_style( 'wp-admin' );
}

// create hooks for new post form, modified, per http://www.advancedcustomfields.com/resources/tutorials/using-acf_form-to-create-a-new-post/

function my_pre_save_post( $post_id )
{
    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }
 
 	// set title for new post
 	// $newtitle = the_field('requester');

    // Create a new post
    $post = array(
        'post_status' => 'draft',
        'post_title' => 'New Request',
        'post_type' => 'request',
        // 'post_type' => 'post',
        'post_content' => '[label type="default"]Est. cost: $[acf field="est_cost"][/label] [label type="default"]Est. time commitment: [acf field="est_time"] hour(s)[/label]<p>[well] [acf field="request_description"] [/well] </p><p><a href="#" class="stripe-connect light-blue"><span>Volunteer</span></a> [ssd amount="500"]</p>'
    );  
 
    // insert the post
    $post_id = wp_insert_post( $post ); 
 
    // update $_POST['return']
    // $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );    
 
    // return the new ID
    return $post_id;

}

add_filter('acf/pre_save_post' , 'my_pre_save_post' );

// remove rich post editor 
add_filter('user_can_richedit' , create_function('' , 'return false;') , 50); 

?>