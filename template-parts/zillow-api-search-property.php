<?php
/**
 * Template Name: Zillow Api Search Property
 *
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
		
<div class="property_details">
	<div class="heading_propery col-md-12">
		<h3>Property Details</h3>
	</div>
	<div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
		<div class="img-wrpas_1">
			<img class="img-responsive" src="http://www.mountainguides.com/photos/everest-south/c2_2011b.jpg" alt="" >
		</div>
		<div class="content_part">
			<h4>Plot for Sale in Lorum</h4>
			<p><i class="fa fa-map-marker" aria-hidden="true"></i> #5 Building, Close to Holy Spirit, Los Angeles, USA</p>
			<span>$ 25,000</span>
		</div>
	</div>
	<div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 detil_map_img">
		<img src="https://i.stack.imgur.com/yEshb.gif" alt="" class="img-responsive">
	</div>
</div>
		
		
		

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>