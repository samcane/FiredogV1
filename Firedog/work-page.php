<?php
include('type-case_studies.php');
exit();

/**
 * Template Name: Work page
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.isotope.min.js"></script>

<div id="isotope" class="clearfix padding_full">
<li id="categories" class="two">
	<h2>Refine your project view</h2>
    <p></p>
    <p>This page represents an overview of our best work. You can find dditional relevant case studies by selecting tags from the dropdowns below.</p>
	<form action="<?php bloginfo('url'); ?>/" method="get">
	<div>
	<?php
		$select = wp_dropdown_categories('show_option_none=Select category&show_count=1&orderby=name&echo=0&hierarchical=1 ');
		$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
		echo $select;
    ?>
    
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
</li>
<br /><br /><br />
<li id="categories" class="two">
	<h2>Refine your project view</h2>
    <p></p>
    <p>Mindaugas - not sure if this dropdown is more useful to you, but i thought id include it, the code is slightly different and possibly more useful...Have a look at the code and see if its good.</p>
	<?php wp_dropdown_categories('show_option_none=Select category&&hierarchical=1'); ?>

<script type="text/javascript"><!--
    var dropdown = document.getElementById("cat");
    function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo get_option('home');
?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
    }
    dropdown.onchange = onCatChange;
--></script>
</li>


<?php 
 $querystr = "
    SELECT wposts.*
    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
    WHERE wposts.ID = wpostmeta.post_id
    AND wpostmeta.meta_key = 'Heirarchy'
    AND wpostmeta.meta_value = 'Level 1'
    AND wposts.post_status = 'publish'
    AND wposts.post_type = 'post'
    ORDER BY wposts.post_date DESC
 ";

 $pageposts = $wpdb->get_results($querystr, OBJECT);


if ($pageposts):
	foreach ($pageposts as $post):
		
				echo "<div class='element'>";
				//echo "<div class='project'><div class='project_detail'>";
				//echo "<p>";the_title();echo "<span class='pipe'> | </span>PROJECT INFO </p></div>"; 
				//echo "<div class='further_detail'><p class='intro'>"; the_excerpt(); echo "</p>";
				//echo "<p class='categories'>DISCIPLINE: ";the_category();echo "</p></div></div>";
				setup_postdata($post);
				echo "<a href='"; the_permalink(); echo"'>";the_post_thumbnail();
				
				if (class_exists('MultiPostThumbnails')
				&& MultiPostThumbnails::has_post_thumbnail('post', 'first-featured-image')) :
				MultiPostThumbnails::the_post_thumbnail('post', 'first-featured-image', NULL, 'post-first-featured-image-thumbnail');endif;
				
				if (class_exists('MultiPostThumbnails')
				&& MultiPostThumbnails::has_post_thumbnail('post', 'second-featured-image')) :
				MultiPostThumbnails::the_post_thumbnail('post', 'second-featured-image', NULL, 'post-second-featured-image-thumbnail');endif;
				
				if (class_exists('MultiPostThumbnails')
				&& MultiPostThumbnails::has_post_thumbnail('post', 'third-featured-image')) :
				MultiPostThumbnails::the_post_thumbnail('post', 'third-featured-image', NULL, 'post-third-featured-image-thumbnail');endif;
				
				
				
				//wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) );
				// Display your post info. For exemple: the_title();the_exerpt();
				echo "</div>";
			
  endforeach;
endif;

?>
</div>
<?php get_footer(); ?>