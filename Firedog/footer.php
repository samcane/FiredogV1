<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog v1
 */
?>
    <?php if (is_category(122)) 
		// if the category is Thinking Space or a Thinking Space subcategory,
		{echo '<div id="thinking-space-bottom"></div>';} 
	?>
    <div id="footerSlideContainer">
        <div title="Click to open/close footer" id="footerSlideButton" class="top_rounded first">
            <h5 class="footer left">Follow Me?</h5><img src="<?php bloginfo('template_directory'); ?>/images/arrow_white_top.png" />
        </div>
        <div id="footerSlideContent">
			<div class="padding_full">
                <?php get_sidebar( 'footer' );	?>
                <div class="row first">
                    <h6 class="widget-title">Sitemap</h6>
                    <?php wp_nav_menu( array('container_class' => 'row one', 'theme_location' => 'sitemap-one' ) ); ?>
                </div>
                <div class="row one footer_space">
                    <?php wp_nav_menu( array('container_class' => 'row one', 'theme_location' => 'sitemap-two' ) ); ?>
                    <a href="<?php echo wp_login_url(); ?>" title="Login" class="login">Client Login</a>
                </div>
                <div class="alignright" style="position: relative; bottom: 0">
                    <img class="bottom_rounded" src="<?php bloginfo('template_directory'); ?>/images/bdi.png">
                </div>
            </div>
        </div>
    </div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
<script>
	jQuery(function() {
		jQuery("#mc_signup .mc_merge_var br").remove();
	
		var footerSlideButton_active = '<?php bloginfo('template_directory'); ?>/images/arrow_white_bott.png';
		var footerSlideButton_inactive = '<?php bloginfo('template_directory'); ?>/images/arrow_white_top.png';
	
		jQuery('#footerSlideContent').hide();
		jQuery('#footerSlideButton').click(function () {
			
			jQuery('#footerSlideContent').slideToggle(1000, 'easeInOutExpo', function () {
				// Animation complete.
			});
			
			if( jQuery(this).hasClass('active')){
				jQuery(this).find('img').attr('src', footerSlideButton_inactive);
				jQuery(this).removeClass('active');
			}else{
				jQuery(this).find('img').attr('src', footerSlideButton_active );
				jQuery(this).addClass('active');
			}
		});
	});
</script>

<script>

jQuery(document).ready(function() {

	//When page loads...
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content

	//On Click Event
	jQuery("ul.tabs li").click(function() {

		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content

		var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	
	if( jQuery.browser.msie ){
		jQuery('.testshadow').textShadow({
			color:   "#000",
			xoffset: "1px",
			yoffset: "1px",
			radius:  "1",
			opacity: "7"
		});
	}

});

</script>

</body>
</html>



 