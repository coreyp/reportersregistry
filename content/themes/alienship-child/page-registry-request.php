<?php
/**
 * The template is for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Alien Ship
 * @since Alien Ship 0.1
 */

/** if ( !is_user_logged_in() ) {
    wp_redirect( home_url('/register/') );
    exit;
} */

acf_form_head(); 
 
get_header(); ?>

<?php 
// form machine
$options = array(
    'post_id' => 'new', // post id to get field groups from and save data to
    'field_groups' => array(70), // this will find the field groups for this post (post ID's of the acf post objects)
    'form' => true, // set this to false to prevent the <form> tag from being created
    /* 'form_attributes' => array( // attributes will be added to the form element
        'id' => 'post',
        'class' => '',
        'action' => '',
        'method' => 'post',
    ),*/
    /* 'return' => add_query_arg( 'updated', 'true', get_permalink() ), // return url */
    // 'return' => '/thanks/', 
    'html_before_fields' => '', // html inside form before fields
    'html_after_fields' => '', // html inside form after fields
    'submit_value' => 'Submit request', // value for submit field
    'updated_message' => '<div class="alert alert-success"><strong>Request sent! </strong><br/>An editor will review it shortly. You may make another request below.</div>', // default updated message. Can be false to show no message
);
?>

	<div id="primary" class="<?php echo apply_filters( 'alienship_primary_container_class', 'content-area col-sm-8' ); ?>">

		<?php do_action( 'alienship_main_before' ); ?>
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				do_action( 'alienship_loop_before' );

				get_template_part( '/templates/parts/content', 'page' );

				if ( is_user_logged_in() ) {
					acf_form( $options );
				}
					else /* if ( !is_user_logged_in() ) */ {
						echo '<div class="alert alert-warning"><h4>You must be logged in to make a request</h4></div>';
						wp_login_form();
						echo '<p>No account? <a href="/register" class="btn btn-primary">Register</a></p>';
					}

				do_action( 'alienship_loop_after' );

				// comments_template( '', true );

			endwhile;
			?>

		</main><!-- #main -->
		<?php do_action( 'alienship_main_after' ); ?>

	</div><!-- #primary -->
<?php
get_sidebar();
get_footer(); ?>