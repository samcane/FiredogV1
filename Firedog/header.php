<?php
global $template;
//echo basename($template);
	
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name = "viewport" content = "width = 1245">
<title><?php wp_title(''); ?></title>
<!--<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	wp_title( '|', true, 'right' );*/
	?></title>-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_enqueue_script('jquery');

	wp_head();
	echo '<script src="'.get_bloginfo( 'template_url' ).'/js/jquery.effects.core.js"></script>';
	echo '<script src="'.get_bloginfo( 'template_url' ).'/js/jquery.textshadow.js"></script>';
?>
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" />
        <style type="text/css">
                .testshadowa { filter: dropshadow(color=#000000,offX=1,offY=1); }
                #thinking-space .testshadowa { filter: dropshadow(color=#ffffff,offX=1,offY=1); }
        </style>
	<![endif]-->
    <!--[if lte IE 9]>
    <style type="text/css">
     div#prev_hover_arrowas, div#next_hover_arrowas { opacity:1 !important;  }
     </style>
   <![endif]-->
   <!--[if lte IE 7]>
    <style type="text/css">
     #footerSlideContainer .menu-item { padding:1px 0 0 0 !important ; margin:0 !important }
     </style>
   <![endif]-->
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.menu-header li').hover(function(){
		jQuery('.menu_rollover', this).show();
	}, function () {
		jQuery('.menu_rollover').hide();
	});
	
	if( jQuery.browser.msie && jQuery.browser.version.substr(0,1) < 8 ){
		jQuery('.menu-header li').each(function(){
			var link_width = jQuery(this).width();
			jQuery('.menu_rollover', this).width(link_width);
		});
	}
});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-334218-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<?php
	//global $template;
    //echo basename($template);
?>
<body 	<?php body_class(); ?> 
		<?php if (cat_is_ancestor_of(122, $cat) or is_category(122) or in_category(array( 122, 429, 432, 428)) or is_page(3038) OR thinking_space_id()) // if the category is Thinking Space or a Thinking Space SUBcategory,
			{echo "id='thinking-space'";} 
		?>>
		<?php if (is_category(122) or in_category(array( 122, 429, 432, 428)) OR thinking_space_id()) // Thinking Space or a Thinking Space subcategory,
			{echo '<div id="thinking-space-top"></div>';} 
		?>
        <?php if (is_page(14)) // Methodology
			{echo '<div id="illustration_method"></div>';} 
		?>
        <?php if (is_page(71)) // In a nutshell
			{echo '<div id="illustration_nutshell"></div>';} 
		?>
        <?php if (is_page(170)) // Our Approach
			{echo '<div id="illustration_approach"></div>';} 
		?>
        <?php if (is_page(173)) // Project Management
			{echo '<div id="illustration_pro_management"></div>';} 
		?>
        <?php if (is_page(12)) // Creative Capabilities
			{echo '<div id="illustration_capabilities"></div>';} 
		?>
        <?php if (is_page(17)) // Strategy & Planning
			{echo '<div id="illustration_strat"></div>';} 
		?>
        <?php if (is_page(18)) // Brand Creation
			{echo '<div id="illustration_brand"></div>';} 
		?>
        <?php if (is_page(19)) // Digital Branding
			{echo '<div id="illustration_digital"></div>';} 
		?>
        <?php if (is_page(4796)) // Digital Publishing
			{echo '<div id="illustration_digital"></div>';} 
		?>
        <?php if (is_page(22)) // Digital Media
			{echo '<div id="illustration_media"></div>';} 
		?>
        <?php if (is_page(44)) // Motion/Animation
			{echo '<div id="illustration_motion"></div>';} 
		?>
        <?php if (is_page(24)) // Design for Print
			{echo '<div id="illustration_print"></div>';} 
		?>
        <?php if (is_page(27)) // Campaigns
			{echo '<div id="illustration_campaign"></div>';} 
		?>
        
        <?php if (is_page(296)) // Campaigns
			{ ?>
            
            <a target="_blank" style="
                background: url(<?php bloginfo('template_directory'); ?>/images/ribbon.png); display: block;
                height: 143px;
                position: absolute;
                right: 0;
                top: 0;
                width: 143px;
                z-index: 10000;"
            href="http://bit.ly/RMu5hB"></a>
			
			
			<?php } 
		?>
    
    
	<div id="header" role="navigation" class="alignleft">
        <div id="logo" class="padding_LR first">
            <a name="top" href="<?php echo home_url( '/' ); ?>" rel="home">
            	<img src="<?php bloginfo('template_directory'); ?>/images/logo.png">
            </a>
        </div>
		<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
		<?php wp_nav_menu( array( 'container_class' => 'menu-header left testshadow', 'theme_location' => 'primary', 'after' => '<div class="menu_rollover"><div class="menu_middle"></div><div class="menu_left"></div><div class="menu_right"></div></div>' ) );?>
        
		<?php echo "
			<ul class='contact alignright padding_TR'>
				<li><span class='testshadow'>+ 44 (0) 20 7739 1112</span></li>
				<li><span class='testshadow'><a href='mailto:hello@firedog.co.uk'>hello@firedog.co.uk</a></span></li>
			</ul>";
		?>
        
	</div><!-- #access -->