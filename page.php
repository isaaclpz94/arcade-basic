<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();
?>

	<div class="container">
		<div class="row">
			<div id="primary" <?php bavotasan_primary_attr(); ?>>
<?php 
$search = new WP_Advanced_Search('newpage'); 
?>
<div class="row search-section">
   <div id="sidebar" class="large-3 columns">
      <?php $search->the_form(); ?>
   </div>

   <div class="search-results large-9 columns">
         <?php 
         $temp = $wp_query;
         $wp_query = $search->query();
         ?>
         <h4 class="results-count">
           Displaying <?php echo $search->results_range(); ?> 
           of <?php echo $wp_query->found_posts; ?> results
         </h4> 
         <?php

         if ( have_posts() ) : 
            
            while ( have_posts() ) : the_post(); ?>
            <?php $post_type = get_post_type_object($post->post_type); ?>
               <article>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <p class="info"><strong>Post Type:</strong> <?php echo $post_type->labels->singular_name; ?> &nbsp;&nbsp;                   
                  <strong>Date added:</strong> <?php the_time('F j, Y'); ?></p>

                  <?php the_excerpt(); ?>
                  
               </article>

            <?php 
            endwhile; 

         else :
            echo '<p>Sorry, no results matched your search.</p>';
         endif; 

         $search->pagination();

         $wp_query = $temp;
         wp_reset_query();
         ?>

   </div>
</div>
			</div>
			<?php //get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>