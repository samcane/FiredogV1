<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<?php get_sidebar('blog'); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="column-row old_blog offset-by-one seven">
		<div class="row five post_item">
			<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<br />
			<?php the_content('Read the rest of this entry &raquo;'); ?>
			<?php comments_template( '', true ); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
	</div>
	<div class="right-blog-mod row one">	
		<p class="author-name"><?php the_author_posts_link(); ?></p>
        <p><?php the_author_description(); ?> </p>
	<hr>
				<?php $arc_year = get_the_time('Y'); ?>
				<?php $arc_month = get_the_time('m'); ?>
				<div class="icon_date"><?php the_time('j') ?></div><a href="<?php echo get_month_link($arc_year, $arc_month); ?>"><p><?php the_time('F Y') ?></a></p>
				<?php if ( count( get_the_category() ) ) : ?>
					<?php //printf( __( 'Posted in %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					<ul class="furniture icon-cat"><li><?php the_category('</li><li>'); ?></li></ul>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<?php the_tags('<ul class="furniture icon-tag"><li>','</li><li>','</li></ul>'); ?>
					<?php //printf( __( 'Tagged %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				<?php endif; ?>
				<ul class="furniture icon-comments"><li><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?><li></ul>
				<?php //comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></p>
	</div>
	<br style="clear">
	<div class="clear" style="display: inline-block;"></div>





















    </div>
<?php endwhile; ?>
<?php get_footer(); ?>