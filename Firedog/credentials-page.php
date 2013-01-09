<?php
/**
 * Template Name: Isotope Credentials
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php get_sidebar(); ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="column-row-alt offset-by-one six padding_LR">
        <?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
		<?php
			if ( function_exists( 'the_content_part' ) && has_content_parts() ) {
				the_content_part( 1, '<div>', '</div>' );
				echo "</div>";
				echo "<div class='column-row offset-by-one padding_LR'>";
				echo "<div id='wrapper'> 
						  <div id='regular'> 
							  <div class='isotope clearfix'>";
								  the_content_part( 2, '<div>', '</div>' );
				echo 			"</div>
						  </div>
					  </div>";
			} else {
				the_content();
			}
		?>
        </div>
        <br class="clear" />
        
    <?php endwhile; ?>
	<script type='text/javascript' src='<?php bloginfo( 'template_url' )?>/js/jquery.isotope.min.js'></script>
  <script>
  	jQuery.noConflict();
	
    jQuery(function(){
      var $container = jQuery('.isotope');
      // change size of clicked talent
      $container.find('.credentials').click(function(){
        jQuery(this).toggleClass('large');
		jQuery(this).find('.intro').toggle();
		jQuery(this).find('.full').toggle();
		jQuery(this).find('.people_links').toggleClass('alt');
		jQuery(this).find('.people_links_holder').toggleClass('open');

        $container.isotope('reLayout');
      });
      $container.isotope({
        itemSelector: '.credentials',
        masonry : {
          columnWidth : 152,
          columnHeight : 103
        }
      });
    });
  </script>
			
<?php get_footer(); ?>