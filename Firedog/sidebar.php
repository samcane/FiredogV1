<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */
?>
<div class="row one padding_LR">
			<?php if ( is_page('16')) 
				{
					$workurl = get_bloginfo(url)."/thinking-space/work-with-firedog/";
					echo 	"<ul class='sub_nav'>
								<li class='section'>In this section</li>
								<li class='page_item'><a href='{$workurl}'>Work with Firedog</a></li>
							</ul>
							<li>";
							
				} 
			?>
			<?php
        		$children = ($post->post_parent) 
				? wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0') 
				: wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
				
        		if($children) { echo('<ul class="sub_nav"><li class="section">In this section</li>'.$children.'</ul></li>'); }
     		?>
            
			<ul class="none">
<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

			<ul class="sub_nav">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
            <br /><br />

<?php endif; ?>
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
		<?php endif; // end primary widget area ?>
			</ul>


</div>