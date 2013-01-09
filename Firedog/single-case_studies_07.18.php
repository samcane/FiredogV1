<?php
//If case study is archive redirect to archive page
$level = false;
$levels_list = get_the_terms($post->id, 'cs_type'); //Level
if ( !empty( $levels_list ) ) :
	$level = current($levels_list);
	$level = $level->slug;
endif;
		
if ($level=='level_3'){
	include (TEMPLATEPATH . '/single-archive.php');
	exit();
}


?>


<?php get_header(); ?>

	<script type="text/javascript" src="<?php bloginfo('template_url');?>/galleria/galleria-1.2.3.min.js"></script>

	<?php while ( have_posts() ) : the_post(); ?>

	
	<div style="display:block;position:fixed;bottom:5%;right:0;z-index:1000;margin:0;width:960px;" class="right">
		<div class="buttons left_rounded">
			<img id="info_window" src="http://dev.firedog-design.co.uk/wp-content/themes/Firedog/images/info_button.png"><br>
			<?php
			$filter_last_mode =  $_COOKIE['filter_last_mode'];
			$discipline = get_the_terms($post->id, 'discipline');	if ( is_wp_error($discipline) ) {$discipline = array();}
			$sector = get_the_terms($post->id, 'sector');			if ( is_wp_error($sector) ) {$sector = array();}
			$theme = get_the_terms($post->id, 'theme'); 			if ( is_wp_error($theme) ) {$theme = array();}
			$client = get_the_terms($post->id, 'clients');			if ( is_wp_error($client) ) {$client = array();}
			
			$all_taxs = array_merge($discipline, $sector, $theme, $client);
			foreach($all_taxs as $term){
				if($filter_last_mode == $term->slug){
					$back_link = get_term_link($term, $term->taxonomy);
					break;
				}
			}
			
			if(!$back_link){
				$back_link = get_bloginfo('siteurl').'/creative-results/';
			}
			?>
			<a id="back_to_filter" href="<?php echo $back_link;?>"><img src="http://dev.firedog-design.co.uk/wp-content/themes/Firedog/images/results.png"></a>
		</div>
		<div id="info_window_block" class="padding_full left_rounded" style="display:none;background:black;">
			<?php
			$client = current($client);
			?>
			<h1 class="port_header"><?php echo $client->name;?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_title(); ?></h1>
			<div class="row one">
				<h4>Tag Info</h4>
				<ul class="port_tag">
					<li class="port_item">Discipline:</li>
					<?php echo get_the_term_list( $post->ID, 'discipline', '',', ', '');?>
				</ul>
				<ul class="port_tag">
					<li class="port_item">Sector:</li>
					<?php echo get_the_term_list( $post->ID, 'sector', '',', ', '');?>                              
				</ul>
				<ul class="port_tag">
					<li class="port_item">Themes:</li>
					<?php echo get_the_term_list( $post->ID, 'theme', '',', ', '');?>    
				</ul>
				<?php if(get('download_pdf')):?>
				<div class="pdf_top">
					<p><a href="<?php echo get('download_pdf'); ?>" title="Download a PDF">Download a PDF case study to take away for later</a></p>
					<div class="pdf_bottom"></div>
				</div>
				<?php endif;?>
			</div>
			
			
			<div class="row two">	
				<h4>The client</h4>
				<?php
				// ????? MAYBE NEED TO CUT DESCRIPTION, LIMIT LETTERS COUNT
				?>
				<h3><?php echo $client->description;?></h3>
				<hr>
                 <?php //This adds the 1st and 2nd colum of content using content parts
				if ( function_exists( 'the_content_part' ) && has_content_parts() ) {
					the_content_part( 1, '', '</div>' );
					the_content_part( 2, '<div class="row two part2">', '' );
				} else {
					the_content();
				}
				?>
				<?php /**
				<h4>The work</h4>
				<?php echo get('the_work'); ?>
				<hr>
				<h4>The brief</h4>
				<?php echo get('the_brief'); ?>
				<hr>
				**/?> 
			</div>
			<?php /**
			<div class="row two"><h4>The Solution</h4>
				<?php echo get('the_solution'); ?>
				<hr>
				<h4>The results</h4>
				<?php echo get('the_results'); ?>
			</div>
			
			<div class="row two">
				<?php the_content();?>
			</div>***/ ?>
			<div class="row one">
				<h4>Similar Projects</h4>
				
				<?php
				$current_themes = get_the_terms($post->id, 'theme'); //Level
				if ( !empty( $current_themes ) ) :
					shuffle($current_themes);
					$theme = current($current_themes);
					$theme = $theme->slug;
				endif;
				
				$args = array(
					'post_type'	=> 'case_studies',
					'showposts'	=> 3,
					'posts_per_page' => 3,
					'offset'	=> 0,
					'orderby'	=> 'rand',
					'post__not_in'	=> array($post->ID),
					'theme'		=> $theme,
					'tax_query' => array(
						array(
							'taxonomy' => 'cs_type',
							'field' => 'slug',
							'terms' => array('level_1','level_2'),

					   ),
					)
				);
				$query = new WP_Query($args);
				//query_posts('post_type=case_studies&theme='.$theme.'&showposts=3&offset=0&orderby=rand'); 
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				
				<?php
					//Image
					$img='';
					if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'cs-image-small', $post->ID) ) :
						$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'cs-image-small', $post->ID, 'image_152x72');
					endif;
					
					//Client
					$clients = get_the_terms($post->id, 'clients');
					if ( !empty( $clients ) ) :
						foreach ($clients as $client) {
							$client = $client->slug;
							break;
						}
					endif;
				?>
				
				<a href="<?php the_permalink();?>">
				<?php echo $img;?>
				<h5 class="port_header_mini"><?php echo $client;?> &nbsp;&nbsp;|&nbsp;&nbsp;<?php the_title();?></h5>
				</a>
				
				<?php endwhile; endif; wp_reset_query();?>
			</div>
			<div class="clear"></div>
		</div><!-- end info_window_block -->
		<div class="clear"></div>
	</div>

	<?php if ( class_exists('MultiPostThumbnails') ) : ?>
	<div id="galleria">
		<?php
		$fullscreens_order = get_post_meta( $post->ID, 'fullscreen_order_value', true );
		$fullscreens_order = explode(',',$fullscreens_order);
		if(count($fullscreens_order)<2) $fullscreens_order = range(1,20);
		
		//print_r($fullscreens_order);
		
		$c=1;
	
		//ADD IMAGE AND LINK TO NAVIGATE TO NEXT OR PREV CASE STUDIES OR HOME FILTER PAGE
		function getItemRow($array, $value) {
			$myPosition=0;
			for ($i=0;$i<count($array);$i++) {
				if($array[$i]==$value) {
					$myPosition = $i;
					
					return $myPosition;
				}
			}
		}
		$cookie_filter_cs_ids = explode(',',$_COOKIE['filter_cs_ids']);
		$get_CS_position = getItemRow($cookie_filter_cs_ids, $post->ID);
		
		$prev_case_study_url = '';
		$next_case_study_url = '';
		$home_case_study_url = ($back_link)? $back_link : get_bloginfo('siteurl').'/creative-results/';
		
		//Prev link
		if($cookie_filter_cs_ids[$get_CS_position-1])
			$prev_case_study_url = get_permalink( $cookie_filter_cs_ids[$get_CS_position-1] );
		elseif(count($cookie_filter_cs_ids))
			$prev_case_study_url = $home_case_study_url;
		//Next link
		if($cookie_filter_cs_ids[$get_CS_position+1])
			$next_case_study_url = get_permalink( $cookie_filter_cs_ids[$get_CS_position+1] );
		elseif(count($cookie_filter_cs_ids))
			$next_case_study_url = $home_case_study_url;
		
		if($c==1 AND $prev_case_study_url AND count($cookie_filter_cs_ids))
			echo "<img src='http://dev.firedog-design.co.uk/wp-content/uploads/prev_case_link.jpg' alt='' title='' >\n";
		elseif($c==1 AND count($cookie_filter_cs_ids))
			echo "<img src='http://dev.firedog-design.co.uk/wp-content/uploads/home_case_link.jpg' alt='' title='' >\n";
	
		foreach( $fullscreens_order as $i ){
			if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'fullscreen-image-'.$i) ) :
				//$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'fullscreen-image-'.$i, null, 'full');
				//print_r($img);
				
				$img = MultiPostThumbnails::get_post_thumbnail_id('case_studies', 'fullscreen-image-'.$i, $post->ID);
				
				//echo wp_get_attachment_image( $img, 'full' );
				//$img_metadata = wp_get_attachment_metadata($img);
			
				$img_attachment = get_post( $img );
				if ($img_attachment) {
					
						//print_r($img_attachment);
						//echo "<br><br><br>";
						/*
						stdClass Object
						(
							[ID] => 276
							[post_author] => 1
							[post_date] => 2011-05-25 10:41:37
							[post_date_gmt] => 2011-05-25 10:41:37
							[post_content] => lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
							[post_title] => catalogue_cover_FA.indd
							[post_excerpt] => A look At the brief
							[post_status] => inherit
							[comment_status] => open
							[ping_status] => open
							[post_password] => 
							[post_name] => catalogue_cover_fa-indd
							[to_ping] => 
							[pinged] => 
							[post_modified] => 2011-05-25 10:41:37
							[post_modified_gmt] => 2011-05-25 10:41:37
							[post_content_filtered] => 
							[post_parent] => 275
							[guid] => http://dev.firedog-design.co.uk/wp-content/uploads/2011/05/aristocrat_2_600_390.jpg
							[menu_order] => 0
							[post_type] => attachment
							[post_mime_type] => image/jpeg
							[comment_count] => 0
							[ancestors] => Array
								(
									[0] => 275
								)
						 
							[filter] => raw
						)
						**/
						echo "<img src='".$img_attachment->guid."' alt='".$img_attachment->post_content."' title='".$img_attachment->post_excerpt."' >\n";
				}
			endif;
			
			$c++;
			if( $c==20 AND $next_case_study_url AND count($cookie_filter_cs_ids) )
				echo "<img src='http://dev.firedog-design.co.uk/wp-content/uploads/next_case_link.jpg' alt='' title='' >\n";
			elseif( $c==20  AND count($cookie_filter_cs_ids) )
				echo "<img src='http://dev.firedog-design.co.uk/wp-content/uploads/home_case_link.jpg' alt='' title='' >\n";
		}
		
		
		 ?>
	</div>
	<?php endif;?>

	<?php endwhile; ?>
	
	<script type="text/javascript" src="<?php bloginfo( 'template_url' )?>/js/jquery.cookie.js" ></script>
	<script>
	
	
	var interval;
	Galleria.loadTheme('<?php bloginfo('template_url');?>/galleria/fullscreen/galleria.fullscreen.min.js');	
	interval = setInterval('loadMyGalleria()',1000);

	function loadMyGalleria() {
		if ( jQuery('#galleria > div').size() == 0) { 
			jQuery("#galleria").galleria({
				<?php if($prev_case_study_url):?>
				show: 1
				<?php endif;?>
			}); 
			clearInterval(interval); 
		}
	}
	
	
	
	
	
	
	
	/***
	
	
	
    // Load the classic theme
    Galleria.loadTheme('<?php bloginfo('template_url');?>/galleria/fullscreen/galleria.fullscreen.min.js');
    
    // Initialize Galleria
    jQuery("#galleria").galleria({
		<?php if($prev_case_study_url):?>
		show: 1
		<?php endif;?>
    });
	
	
	**/
	
	
	
	
	var info_window_expand = '<?php bloginfo('template_url');?>/images/Menu.png';
	var info_window_collapse = '<?php bloginfo('template_url');?>/images/info_button.png';
	
	var prev_case_study_url = '<?php echo $prev_case_study_url;?>';
	var next_case_study_url = '<?php echo $next_case_study_url;?>';
	var home_case_study_url = '<?php echo $home_case_study_url;?>';
	
	//Mouse track and next/prev links
	//LEFT
	jQuery(".galleria-image-nav-left").live("mouseover click",function(event){
	
		var active_thumb_prev = jQuery(".galleria-thumbnails .galleria-image.active").prev();
		var prev_button = jQuery('img', active_thumb_prev).attr('src');
		
		if(prev_button != undefined){
			if( prev_button.indexOf('prev_case_link') != -1 || prev_button.indexOf('home_case_link') != -1){
				
				if(!jQuery(this).html())
					jQuery(this).html('<div id="arrow">Prev project</div>');
				else
					jQuery(this).find('#arrow').html('Prev project');
			}else{
				if(!jQuery(this).html())
					jQuery(this).html('<div id="arrow">Prev image</div>');
				else
					jQuery(this).find('#arrow').html('Prev image');
			}
			if(event.type == 'mouseover')
				jQuery(this).find('#arrow').stop().animate({opacity:'1'},800);
		}
    });
	jQuery(".galleria-image-nav-left").live("mousemove mouseout",function(event){
	
		var offsetX = 25;
		var offsetY = -35;
		
		if(event.type == 'mouseout'){
			jQuery(this).find('#arrow').stop().animate({opacity:'0'},800);
		}
		jQuery(this).find('#arrow').css({top:event.pageY + offsetY+ "px", left: event.pageX + offsetX +"px"});
		
    });
	//RIGHT
	jQuery(".galleria-image-nav-right").live("mouseover click",function(event){
	
		var active_thumb_next = jQuery(".galleria-thumbnails .galleria-image.active").next();
		var next_button = jQuery('img', active_thumb_next).attr('src');
		if(next_button != undefined){
		
			if( next_button.indexOf('next_case_link') != -1 || next_button.indexOf('home_case_link') != -1){
				if(!jQuery(this).html())
					jQuery(this).html('<div id="arrow">Next project</div>');
				else
					jQuery(this).find('#arrow').html('Next project');
			}else{
				if(!jQuery(this).html())
					jQuery(this).html('<div id="arrow">Next image</div>');
				else
					jQuery(this).find('#arrow').html('Next image');
			}
			if(event.type == 'mouseover')
				jQuery(this).find('#arrow').stop().animate({opacity:'1'},800);
				
		}
    });
	
	var window_width = jQuery(window).width();
	jQuery(window).bind('resize', function() {
		window_width = jQuery(window).width();
	});
	
	jQuery(".galleria-image-nav-right").live("mousemove mouseout",function(event){
	
		var offsetX = -50;
		var offsetY = -35;
		
		
		if(event.type == 'mouseout'){
			jQuery(this).find('#arrow').stop().animate({opacity:'0'},800);
		}
		jQuery(this).find('#arrow').css({top:event.pageY + offsetY+ "px", left: event.pageX - window_width + offsetX +"px"});
		
    });
	
	

	
	
	jQuery("#info_window").click(function () {
		if( jQuery(this).hasClass('active') ){
			jQuery(this).removeClass("active").addClass('inactive');
			jQuery("#info_window_block").stop().fadeOut("slow");
			
			jQuery(this).attr('src',info_window_collapse);
		}else{
			jQuery(this).removeClass("inactive").addClass('active');
			jQuery("#info_window_block").stop().fadeIn("slow");
			
			
			jQuery(this).attr('src',info_window_expand);
		}
	});
	
	jQuery(".galleria-image, .galleria-image-nav div").live('click', function () {
		
		var last_thumb = jQuery(".galleria-thumbnails .galleria-image.active");
		var next_img_src = jQuery('img[src*="next_case_link"]', last_thumb).attr('src');
		var prev_img_src = jQuery('img[src*="prev_case_link"]', last_thumb).attr('src');
		var home_img_src = jQuery('img[src*="home_case_link"]', last_thumb).attr('src');
		
		if(next_img_src){
			//alert('next');
			window.location.href = next_case_study_url;
		}else if(prev_img_src){
			//alert('prev');
			window.location.href = prev_case_study_url;
		}else if(home_img_src){
			//alert('home');
			window.location.href = home_case_study_url;
		}
	});
	</script>
			
<?php get_footer(); ?>