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
		
		<?php if ( $paged < 2 ) : ?>
<div class="header">
			<h1 class="three">Our musings, thoughts, ideas and on Mondays, rants.</h1>
			<h2 class="five">Welcome to the Firedog thinking space. This is part blog (we've been nattering since 2003), part white paper and part engagement platform. Read up on our <a href="<?php echo home_url( '/thinking-space/news-opinions/' ); ?>">news and opinions</a>, find out if we are <a href="<?php echo home_url( '/thinking-space/work-with-firedog/' ); ?>">currently hiring</a> or grab a bit of free knowledge with our <a href="<?php echo home_url( '/thinking-space/goodies-downloads/' ); ?>">goodies and downloads</a>.</h2>
		</div>
		<div class="row two">
			<h3>The thinking space is also where we get to rant and rave about issues pertaining to the design, branding and creative industries both locally and abroad. Our aim is to develop a strong, balanced voice for the UK design industry. And probably most of all, to entertain you.</h3>
		</div>
		<div class="row two">
			<p>We have contributors across the board, not only from Cliff the Firedog Chief, but also from all the talented people who create and work in the Firedog studios. Therefore the views, opinions, comments and criticisms do not necessarily represent Firedog views, they're the independent and collective view of all staff, authored and presented independently without bias or censorship. Enjoy...</p>
		</div>
		<br class="clear">
		<br />
		<br />
		<br />
<?php endif; ?>
		
		
		
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