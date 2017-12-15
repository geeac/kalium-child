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

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );


$gallery_items = get_field('slider-gallery');
$size = 'portfolio-single-img-1'; // (thumbnail, medium, large, full or custom size)

?>

<div class="full-width-container">
	<div class="gallery-slider wow fadeInLab gallery carousel-center-mode" data-infinite="0" data-autoplay="7000">
	<?php
	if ($gallery_items):
	foreach ( $gallery_items as $i => $gallery_item ) :

		//$main_thumbnail_size = apply_filters( 'kalium_single_portfolio_gallery_image', 'portfolio-single-img-1' );
		//print_r($gallery_item['id']);	
		//echo wp_get_attachment_image( $gallery_item['id'], $size ); 		
			?>
			<div class="gallery-item photo hidden gallery-item-<?php echo $i; ?>">

					<?php echo wp_get_attachment_image( $gallery_item['id'], $size ); ?>

				<?php if ( $gallery_item['caption'] ) : ?>
				<div class="caption">
					<?php echo laborator_esc_script( $gallery_item['caption'] ); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php

	endforeach;
	endif;
	?>
	</div>
</div>