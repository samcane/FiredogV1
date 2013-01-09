<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>


<div class="column-row offset-by-one padding_LR">
	<div class="header">
		<h1><?php _e( 'Page dog-gone (404, not found, AWOL)', 'twentyten' ); ?></h1>
		<h2 class="five">Mmm, why am I here? It seems the page you were looking for has met it's digital maker. However, don't worry, there's loads of other fine pages for you to get stuck into. Start at the beginning, the <a href="<?php echo home_url( '/' ); ?>">Firedog home page.</a></h2>
	</div>
	<h3 class="four">Alternatively, you may have seen reference to a piece of work on a search engine, in which case, see if you can locate it in our <a href="<?php echo home_url( '/creative-results/' ); ?>">creative results section.</a> Also, while you are here, you may wish to find out <a href="<?php echo home_url( '/about-firedog/#Origins' ); ?>">what the bleeding 'ell is a Firedog</a> anyway?</h3>
</div>
<br class="clear" />
<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_footer(); ?>