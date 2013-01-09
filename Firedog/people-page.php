<?php
/**
 * Template Name: Isotope People
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
				echo "<div class='column-row seven offset-by-one padding_LR'>";
				echo "<div id='wrapper'> 
						  <div id='regular'> 
							  <div class='isotope clickable clearfix'>";
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
		$container.find('.talent').find('.full').each(function(){
			var full_height = jQuery(this).outerHeight();
			jQuery(this).height(full_height*1 + 30);
		});
		
		$container.find('.people_links_holder br').remove();
		
		$container.find('.talent').click(function(){
		
			var talent_base = jQuery(this);
			talent_base.find('.people_links_holder br').remove();
			
			if(talent_base.hasClass('active')){
			
				talent_base.find('.people_links_holder').animate({
					'margin-top': '-120px'
				}, 700, 'easeInOutExpo', function() {
					
					talent_base.find('.full').fadeOut(350, function() {
						talent_base.find('.intro').fadeIn(350, function() {
							$container.isotope();
							talent_base.find('.bio .trigger').text('More');
						});
					});
				});

			}else{
				talent_base.find('.intro').fadeOut(350, function() {
					talent_base.find('.full').fadeIn(350, function() {
						talent_base.find('.bio .trigger').text('Less');
						
						$container.isotope();
						
						talent_base.find('.people_links_holder').animate({
							'margin-top': '5px'
						},{
							queue:false,
							duration:350,
							easing:'easeInOutExpo', 
							complete: function(){
								
							}
						});
					});
				});
			}
				
		
				
			
			talent_base.toggleClass('active');
			jQuery(this).toggleClass('large');
			jQuery(this).find('.person_bw').fadeToggle();
			jQuery(this).find('.person_col').fadeToggle();
			//jQuery(this).find('.people_links').toggleClass('alt');
			//jQuery(this).find('.people_links_holder').toggleClass('open');

			$container.isotope('reLayout');
		});
		$container.isotope({
			itemSelector: '.talent',
			masonry : {
				columnWidth : 446
			}
		});
    });
	</script>
			
<?php get_footer(); ?>