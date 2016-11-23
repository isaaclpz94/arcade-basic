<?php
/**
 * The Template for displaying all single posts.
 *
 * @since 1.0.0
 */
get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12 hfeed"<?php //bavotasan_primary_attr(); ?>>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'content', get_post_format() ); ?>
					<?php the_content(); ?>

					<div id="posts-pagination" class="clearfix">
						<h3 class="sr-only"><?php _e( 'Post navigation', 'arcade-basic' ); ?></h3>
						<div class="previous pull-left"><?php previous_post_link( '%link', __( '&larr; %title', 'arcade-basic' ) ); ?></div>
						<div class="next pull-right"><?php next_post_link( '%link', __( '%title &rarr;', 'arcade-basic' ) ); ?></div>
					</div><!-- #posts-pagination -->
							<?php
$search = new WP_Advanced_Search('newpage');
?>
<div class="row search-section">

      <?php $search->the_form(); ?>

</div>
					
					<?php //comments_template( '', true ); ?>
						

				<?php endwhile; // end of the loop. ?>
				
				
			</div>
			<?php //get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
