<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @since 1.0.0
 */
get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12 hfeed" <?php //bavotasan_primary_attr(); ?>>
    			<article id="post-0" class="post error404 not-found">
    				<i class="fa fa-frown-o"></i>
    		    	<header>
    		    	   	<h1 class="entry-title"><?php _e( '404 Error', 'arcade-basic' ); ?></h1>
    		        </header>
    		        <div class="entry-content description">
    		            <p><?php _e( "La página que buscas no existe.", 'arcade-basic' ); ?></p>
    		        </div>
    		    </article>
			</div>
			<?php //get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>