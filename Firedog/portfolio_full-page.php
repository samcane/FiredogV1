<?php
/**
 * Template Name: Portfolio Page (Full Screen)
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div class="column-row offset-by-one padding_LR">
					<?php
						if ( function_exists( 'the_content_part' ) && has_content_parts() ) {
							the_content_part( 1, '<div class="header">', '</div>' );
							the_content_part( 2, '<div class="five">', '</div>' );
							the_content_parts( array(
								'before' => '<div class="row two">',
								'after' => '</div>',
								'start' => 3,
								'limit' => 3
							) );
							echo "<br>";
							the_content_part( 6, '<div class="row six">', '</div>' );
							the_content_part( 7, '<div class="row two">', '</div>' );
							the_content_parts( array(
								'before' => '<div class="row six">',
								'after' => '</div>',
								'start' => 8
							) );
						} else {
							the_content();
						}
					?>
                    <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
                    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
				</div>
				

<?php endwhile; ?>

<?php get_footer(); ?>