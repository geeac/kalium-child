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

get_header(); ?>

<div class="container">

	<?php if ( have_posts() ) : ?>
		<div class="">
			<div class="pt-column pt-column-title">
				<div class="section-title no-bottom-margin">
				<?php
					echo '<h1>'.get_the_archive_title().'</h1>';
					echo '<p>'.term_description().'</p>';
				?>
				</div>
			</div>
		</div><!-- .portfolio-title-holder -->
	<?php endif; ?>

	<div class="page-container">
		<div class="row">
			<div class="grid-holder">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				$cols = 4;
				include locate_template( 'tpls/content.php' );

			endwhile;

		endif; ?>
			</div><!-- ..portfolio-holder -->
		</div><!-- .row -->
	</div><!-- .page-container -->
</div><!-- .container -->


<?
get_footer();