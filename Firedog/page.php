<?php
/**
 * Template Name: Standard page
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="column-row offset-by-one padding_LR">
                <?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				} ?>
					<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						
				</div>
                <br class="clear" />
<?php endwhile; ?>
<?php get_footer(); ?>