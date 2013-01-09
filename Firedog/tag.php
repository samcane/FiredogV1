<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<?php get_sidebar('blog'); ?>
	<div class="column-row old_blog offset-by-one seven">
				<!--<h1><?php
					printf( __( 'Posts tagged: %s', 'twentyten' ), '' . single_tag_title( '', false ) . '' );
				?></h1>-->
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
	</div>
<br class="clear">
<?php get_footer(); ?>