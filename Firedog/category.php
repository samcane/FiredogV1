<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<?php get_sidebar('blog'); ?>
	<div class="column-row old_blog offset-by-one seven">
		<?php
		/*$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '' . $category_description . '';*/

		/* Run the loop for the category page to output the posts.
		* If you want to overload this in a child theme then include a file
		* called loop-category.php and that will be used instead.
		*/
		get_template_part( 'loop', 'category' );
		?>
	</div>
<br class="clear">
<?php get_footer(); ?>