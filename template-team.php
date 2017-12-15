<?php
/*
	Template Name: Team Page
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

// Fetch the post
the_post();

// Show header
get_header();

// Check if is default container
$is_vc_content = preg_match( "/\[vc_row.*?\]/i", $post->post_content );

// Password protected page doesn't use vc container
if ( post_password_required() ) {
	$is_vc_content = false;
}

// Page title (show or hide)
$show_title = false == $is_vc_content && is_singular() && get_field( 'heading_title' );

// Container start
$container = array();

if ( $is_vc_content ) {
	$container[] = 'vc-container';
} else {
	$container[] = 'container';
	$container[] = 'default-margin';
	
	if ( ! is_shop_supported() || ! ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
		$container[] = 'post-formatting';
	}
}
?>
<div class="<?php echo esc_attr( implode( ' ', $container ) ); ?>">
<?php


// Show page title
if ( false == defined( 'HEADING_TITLE_DISPLAYED' ) && apply_filters( 'kalium_page_title', $show_title ) ) {
	?>
	<h1 class="wp-page-title"><?php the_title(); ?></h1>
	<?php
} 

// Page content		
the_content();
		

// Container end
?>

<?php 	
	//display list of subpages with featured images as thumb
	//get the list of child pages
	$mypages = get_pages( array( 'child_of' => get_the_ID(), 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );  

	//if the page has no children, get the parent's children
	if ( !$mypages) {
		$mypages = get_pages( array( 'child_of' => wp_get_post_parent_id( get_the_ID() ), 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );	
	}
	echo '<div class="team-holder"><div class="row">';
	foreach( $mypages as $page ) {
		if ( $page->ID != get_the_ID() ){ //don't display the member's thumbnail if it's the member's page	 		
			$content = $page->post_content; 		
			if ( ! $content ) // Check for empty page 			
				continue;  		
			$content = apply_filters( 'the_content', $content ); 	?> 
			
			<div class="col-md-4 col-sm-6">
				<div class="member layout-titles-inside wow fadeIn animated" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeIn;">
					<div class="thumb">
						<div class="hover-state padding with-spacing">
							<div class="member-details">
								<h2><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
								<p class="job-title"><?php echo get_post_meta( $page->ID, $key = 'job-title', $single = true ) ?></p>
							</div>
						</div> 
						<span> 
							<?php echo get_the_post_thumbnail( $page->ID, 'thumb-medium' ); ?>
						</span>
					</div>
				</div>
			</div>
			<?php 
		} //end if
	} //end foreach 
?>
	</div></div><!-- end .team-holder -->
</div>
<?php

// Show footer
get_footer();