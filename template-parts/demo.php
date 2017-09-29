<?php
/**
 * Template Name: Email Verification
 *
 */

get_header(); 

global $wpdb;

?>
	<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			$id = get_the_ID();
			$profileImgid = get_post_thumbnail_id($id);
			$profileImg = wp_get_attachment_url($profileImgid);
	?>
<section id="activationPage">	
	<div class="backgroundimage" style="background-image:url(<?php echo $profileImg; ?>);">
		<h1><?php the_title(); ?></h1>
	</div>
	<article class="container">	
	
	</article>	
</section>	
	<?php	endwhile; ?>
		
	
	

<?php 

get_footer(); ?>