<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

$item_type = get_field( 'item_type' );

// Custom Item Link Redirect
if ( get_field( 'item_linking' ) == 'external' ) {
	
	$launch_link_href = get_field( 'launch_link_href' );
	
	if ( $launch_link_href ) {
		
		if ( $launch_link_href != '#' ) {
			wp_redirect( $launch_link_href );
		} else { 
			// Disabled item links, will redirect to closest next/previous post
			$include_categories  = get_data( 'portfolio_prev_next_category' ) ? true : false;
			
			$prev = get_next_post( $include_categories, '', 'portfolio_category' );
			$next = get_previous_post( $include_categories, '', 'portfolio_category' );
			
			if( ! empty( $next ) ) {
				wp_redirect( get_permalink( $next ) );
			} else if( ! empty( $prev ) ) {
				wp_redirect( get_permalink( $prev ) );
			}
		}
		
		die();
	}
}



get_header();
?>

<div class="container">

	<div class="page-container">
    	<div class="single-portfolio-holder portfolio-type-3">

			<div class="title section-title">
				<h1><?php the_title(); ?></h1>
				<div class="dash small"></div>
			</div>

    		<div class="details row">
    			<div class="col-sm-12">
	    			<div class="project-description">
	    				<div class="post-formatting">
							<?php the_content(); ?>
						</div>
	    			</div>
    			</div>
				
				<div class="col-sm-12">
		    		<?php include locate_template( 'tpls/portfolio-single-like-share.php' ); ?>
	    		</div>

    		</div>

			<?php include locate_template( 'tpls/client-gallery-slider.php' ); ?>

			<?php include locate_template( 'tpls/single-related.php' ); ?>

			<?php include locate_template( 'tpls/client-single-prevnext.php' ); ?>
    	</div>
	</div>

</div>
<?php
get_footer();