<?php
/**
 Template Name: Custom Login
 */

get_header(); 

?>

<div id="primary" class="content-area container">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>