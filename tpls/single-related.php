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

$post_type = get_post_type();
//$services = get_the_terms( get_the_ID(), 'service' );


//print_r($client_cat[0]->name);

//$client = get_post_meta(get_the_ID(),'client', true);
//foreach($services as $service) {
	//wp_reset_query();

if ($post_type == 'portfolio'){
	if ( $client = get_field('client') ):
	$args = array(
		'post_type' 	=> $post_type,
		'meta_key' 	=> 'client',
		'meta_value'	=> $client->ID,
		'post__not_in' => array( get_the_ID() ), 
	);
	$related_title = 'Other services for '.$client->post_title;
	endif;

}
else if ($post_type == 'client'){
	if ( $client_cat = get_the_terms( get_the_ID(), 'client_cat' ) ):
	$args = array(
		'post_type' 	=> $post_type,
		'tax_query' => array(
			array(
				'taxonomy' => 'client_cat',
				'field'    => 'slug',
				'terms'    => $client_cat[0]->name,
			),
		),
		'post__not_in' => array( get_the_ID() ), 
	);
	$related_title = 'Other '.$client_cat[0]->name.' clients';
	endif;
}
 
// Related projects query.
if ( !empty( $args ) ) {
	$related_projects = new WP_Query( $args );
}


// Check that we have query results.
if ( !empty( $related_projects ) && $related_projects->have_posts() ) { ?>

	<div class="container">
		<div class="page-container">
			<div class="row"><h3><?php echo $related_title; ?></h3>
			</div>

			<div class="row grid-holder">
				<?php
 
				// Start looping over the query results.
				while ( $related_projects->have_posts() ) {
 
					$project = $related_projects->the_post(); 
					include locate_template( 'tpls/content.php' ); ?>

				<?php 
   				 } ?>
			</div>
		</div>
	</div>
<?php 
}

// Restore original post data.
wp_reset_postdata();