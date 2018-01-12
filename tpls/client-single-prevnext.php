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

if ( ! get_data( 'portfolio_prev_next' ) ) {
	return;
}

$client_tax = get_the_terms( get_the_ID(), 'client_cat' );
if ( !empty( $client_tax) ) {
	$portfolio_archive_link = get_term_link( reset( $client_tax ) );
}
$include_categories = false;
$prev_next_show_titles = false;
$prev_next_type = 'simple';
$image_spacing = 'nospacing';

$prev = apply_filters( 'kalium_portfolio_prev_link', get_next_post( $include_categories, '', 'client_cat' ), $include_categories );
$next = apply_filters( 'kalium_portfolio_next_link', get_previous_post( $include_categories, '', 'client_cat' ), $include_categories );
	

// Next and Previous Title
$previous_title = __( 'Previous client', 'kalium' );
$next_title     = __( 'Next client', 'kalium' );


if ( $prev_next_show_titles ) {
	$previous_title    = '';
	$next_title        = '';

	if ( $prev ) {
		$previous_title = get_the_title( $prev );
	}
	
	if ( $next ) {
		$next_title = get_the_title( $next );
	}
}

if ( 'simple' == $prev_next_type ) :

	$prev_link = get_permalink( $prev );
	$next_link = get_permalink( $next );

	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="portfolio-big-navigation portfolio-navigation-type-simple wow fadeIn<?php echo $image_spacing == 'nospacing' ? ' with-margin' : ''; ?>">
				<div class="row">
		    		<div class="col-xs-5">
			    		<?php if ( $previous_title ) : ?>
			    		<a class="previous pc-only<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $prev_link ); ?>"><?php echo apply_filters( 'portfolio_previous_item_title', $previous_title ); ?></a>
			    		<a class="previous mobile-only<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $prev_link ); ?>"><i class="fa flaticon-arrow427"></i></a>
			    		<?php endif; ?>
		    		</div>

		    		<div class="col-xs-2 text-on-center">
			    		<a class="back-to-portfolio" href="<?php echo esc_url( $portfolio_archive_link ); ?>">
							<i class="fa flaticon-four60"></i>
						</a>
		    		</div>

		    		<div class="col-xs-5">
			    		<?php if ( $next_title ) : ?>
			    		<a class="next pc-only<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $next_link ); ?>"><?php echo apply_filters( 'portfolio_next_item_title', $next_title ); ?></a>
			    		<a class="next mobile-only<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo esc_url( $next_link ); ?>"><i class="fa flaticon-arrow427"></i></a>
			    		<?php endif; ?>
		    		</div>
				</div>
			</div>
		</div>
	</div>
	<?php

endif;


if ( 'fixed' == $prev_next_type ) :

	?>
	<div class="portfolio-navigation portfolio-navigation-type-fixed <?php echo esc_attr( $navigation_position ); ?> wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.9s">

		<a class="previous<?php echo ! $prev ? ' not-clickable' : ''; ?>" href="<?php echo get_permalink( $prev ); ?>" title="<?php echo esc_attr( $prev_title ); ?>">
			<i class="fa flaticon-arrow413"></i>
		</a>

		<a class="back-to-portfolio" href="<?php echo esc_url( $portfolio_archive_link ); ?>" title="<?php _e( 'Go to portfolio archive', 'kalium' ); ?>">
			<i class="fa flaticon-four60"></i>
		</a>

		<a class="next<?php echo ! $next ? ' not-clickable' : ''; ?>" href="<?php echo get_permalink( $next ); ?>" title="<?php echo esc_attr( $next_title ); ?>">
			<i class="fa flaticon-arrow413"></i>
		</a>
	</div>
	<?php

endif;
