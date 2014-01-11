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

get_header(); ?>

<script type="text/javascript">
function toggle_visibility(id) {
    var list = document.getElementsByClassName("alist");
    for (var i = 0; i < list.length; i++) {
        list[i].style.display = 'none';
    }
    var e = document.getElementById(id);
    if(e.style.display == 'block') {
        e.style.display = 'none';
    } else {
        e.style.display = 'block';
    }
}
</script>

	<div id="primary" class="<?php echo apply_filters( 'alienship_primary_container_class', 'content-area col-sm-8' ); ?>">

		<?php do_action( 'alienship_main_before' ); ?>
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				do_action( 'alienship_loop_before' );

				get_template_part( '/templates/parts/content', 'page' );

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