<?php
if (!isset($cols))
	$cols = 3;
?>
<div class="tax-item has-padding w4 col-md-<?php echo $cols; ?>">
	<div class="item-box-container">
		<div class="item-box wow fadeInLab animated" style="visibility: visible; animation-name: fadeInLab;">
	    		<div class="thumb">
		    		<div class="hover-state padding hover-eff-fade-slide position-bottom-left hover-distanced hover-style-white opacity-yes">
		    			<div class="info">
						<?php 
							the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
							if ( $sub_caption = get_post_meta(get_the_ID(),'sub_title', true) ):
								echo '<p>'.esc_html( $sub_caption ).'</p>';
							endif;
						?>
			    		</div>
			   	 </div>
			    	
				<a href="<?php the_permalink(); ?>" class="item-link">
					<span class="image-placeholder img-loaded">
						<?php the_post_thumbnail( 'portfolio-img-3' ); ?>
					</span>
				</a>
			</div>
		</div>
	</div>
</div><!--.portfolio-item-->