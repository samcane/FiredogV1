<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<?php get_sidebar('blog'); ?>
	<?php
	
	global $wp_query;
	
	$custom_array = array( 
		'post_type' => 'post'
	);
	
	$args = array_merge( $wp_query->query, $custom_array );
	query_posts( $args );
	
	?>
	<div class="column-row old_blog offset-by-one seven">
		<?php
		/*$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '' . $category_description . '';*/

		/* Run the loop for the category page to output the posts.
		* If you want to overload this in a child theme then include a file
		* called loop-category.php and that will be used instead.
		*/
		get_template_part( 'loop', 'author' );
		?>
	</div>
<br class="clear">
<?php get_footer(); ?>