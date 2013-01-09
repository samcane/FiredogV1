<?php
//Check if current page is active taxonomy, if true, set isotope filter activities by taxonomy slug and show case studies by taxonomy
$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

if($current_term->slug){
	$active_tax = $current_term;
}else{
	$active_tax = 'creative-results';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$show_clients_dropdown = FALSE;
/////////////////
//FILTER TREE ARRAY
/////////////////
$filter_tree = array(); //Base filter array for echo filter dropdownlists
$taxonomies_IDS = array(); //Base filter array for echo filter dropdownlists
query_posts('post_type=case_studies&posts_per_page=-1');
while ( have_posts() ) : the_post();

	// GET DISCIPLINES
	$disciplines = get_the_terms($post->id, 'discipline');
	if ( !empty( $disciplines ) ) :
		foreach ($disciplines as $discipline) {
			
			if($discipline->parent == 0){
				if(!isset($filter_tree['discipline'][$discipline->term_id.'_'.$discipline->count.'_'.$discipline->slug]))
					$filter_tree['discipline'][$discipline->term_id.'_'.$discipline->count.'_'.$discipline->slug] = array();
					
				if(!isset($taxonomies_IDS[$discipline->slug]))
					$taxonomies_IDS[$discipline->slug] = $discipline->slug;
					
			}elseif($discipline->parent > 0){
				$parent = get_term( $discipline->parent, 'discipline' );
				$parent_slug = $parent->slug;
				
				if(!isset($filter_tree['discipline'][$discipline->parent.'_'.$parent->count.'_'.$parent_slug][$discipline->term_id]))
					$filter_tree['discipline'][$discipline->parent.'_'.$parent->count.'_'.$parent_slug][$discipline->term_id.'_'.$discipline->count.'_'.$discipline->slug] = $discipline->slug;
					
				if(!isset($taxonomies_IDS[$discipline->slug]))
					$taxonomies_IDS[$discipline->slug] = $discipline->slug;
			}

			
		}
	endif;

	// GET SECTORS
	$sectors = get_the_terms($post->id, 'sector');
	if ( !empty( $sectors ) ) :
		foreach ($sectors as $sector) {
			
			if($sector->parent == 0){
				if(!isset($filter_tree['sector'][$sector->term_id.'_'.$sector->count.'_'.$sector->slug]))
					$filter_tree['sector'][$sector->term_id.'_'.$sector->count.'_'.$sector->slug] = array();
				
				if(!isset($taxonomies_IDS[$sector->slug]))
					$taxonomies_IDS[$sector->slug] = $sector->slug;
					
			}elseif($sector->parent > 0){
				$parent = get_term( $sector->parent, 'sector' );
				$parent_slug = $parent->slug;
				
				if(!isset($filter_tree['sector'][$sector->parent.'_'.$parent->count.'_'.$parent_slug][$sector->term_id]))
					$filter_tree['sector'][$sector->parent.'_'.$parent->count.'_'.$parent_slug][$sector->term_id.'_'.$sector->count.'_'.$sector->slug] = $sector->slug;
				
				if(!isset($taxonomies_IDS[$sector->slug]))
					$taxonomies_IDS[$sector->slug] = $sector->slug;
			}
		}
	endif;

	// GET THEMES
	$themes = get_the_terms($post->id, 'theme');
	if ( !empty( $themes ) ) :
		foreach ($themes as $theme) {
			
			if($theme->parent == 0){
				if(!isset($filter_tree['theme'][$theme->term_id.'_'.$theme->count.'_'.$theme->slug]))
					$filter_tree['theme'][$theme->term_id.'_'.$theme->count.'_'.$theme->slug] = array();
					
				if(!isset($taxonomies_IDS[$theme->slug]))
					$taxonomies_IDS[$theme->slug] = $theme->slug;
					
			}elseif($theme->parent > 0){
				$parent = get_term( $theme->parent, 'theme' );
				$parent_slug = $parent->slug;
				
				if(!isset($filter_tree['theme'][$theme->parent.'_'.$parent->count.'_'.$parent_slug][$theme->term_id]))
					$filter_tree['theme'][$theme->parent.'_'.$parent->count.'_'.$parent_slug][$theme->term_id.'_'.$theme->count.'_'.$theme->slug] = $theme->slug;
				
				if(!isset($taxonomies_IDS[$theme->slug]))
					$taxonomies_IDS[$theme->slug] = $theme->slug;
			}
		}
	endif;

	// GET CLIENTS
	$clients = get_the_terms($post->id, 'clients');
	if ( !empty( $clients ) ) :
		foreach ($clients as $client) {
			
			if( $client->parent == 0 AND $client->count >= 3 ){
				if(!isset($filter_tree['clients'][$client->term_id.'_'.$client->count.'_'.$client->slug]))
					$filter_tree['clients'][$client->term_id.'_'.$client->count.'_'.$client->slug] = $client->count;
					
				if(!isset($taxonomies_IDS[$client->slug]))
					$taxonomies_IDS[$client->slug] = $client->slug;
					
			}elseif( $client->parent > 0 AND $client->count >= 3 ){
				$parent = get_term( $client->parent, 'clients' );
				$parent_slug = $parent->slug;
				
				if(!isset($filter_tree['clients'][$client->parent.'_'.$parent->count.'_'.$parent_slug][$client->term_id]))
					$filter_tree['clients'][$client->parent.'_'.$parent->count.'_'.$parent_slug][$client->term_id.'_'.$client->count.'_'.$client->slug] = $client->count;
					
				if(!isset($taxonomies_IDS[$client->slug]))
					$taxonomies_IDS[$client->slug] = $client->slug;
					
			}
		}
	endif;
endwhile;


wp_reset_query();

if(0){
	echo '<pre>';
	print_r($clients_list);
	echo '</pre>';
}
if(0){
	echo '<pre>';
	print_r($filter_tree);
	echo '</pre>';
	///echo $show_clients_dropdown;
}

///////////////////// Filter tree order by count////////////////////////////
function compare_counts($a, $b){
	
	$a_array = explode("_",$a);
	$a_count = $a_array[1];
	
	$b_array = explode("_",$b);
	$b_count = $b_array[1];
	
	return strnatcmp($b_count, $a_count);
}

foreach($filter_tree as $key => $group){
	// Sort 1 level
	uksort($filter_tree[$key], 'compare_counts');
	// Sort 2 level
	if(count($group) > 1){
		foreach($filter_tree[$key] as $child_key => $child_cat){
		
			if(count($child_cat)>1)
				uksort($child_cat, 'compare_counts');
			$filter_tree[$key][$child_key] = $child_cat;
		}
	}
}


if(0){
echo '<pre>';
print_r($filter_tree);
echo '</pre>';
exit();
}


//////////////////////////////////////////////////
//// case studies position TO FEATURED, NORMAL or ARCHIVE section
//////////////////////////////////////////////////
$featured = array();
//$wrappers = array();
$case_studies = array();
$archive = array();
//$groups = array();
query_posts('posts_per_page=-1&post_type=case_studies');
while ( have_posts() ) : the_post();

	$levels_list = get_the_terms($post->ID, 'cs_type'); //Level
	$level = current($levels_list); //project exit in group
	$level = $level->slug;
	
	if($level == 'level_1'){
		$featured[] = $post->ID;
		$case_studies[] = $post->ID;
	}elseif($level == 'level_2')
		$case_studies[] = $post->ID;
	else
		$archive[] = $post->ID;
	
	

endwhile;
wp_reset_query();

//Set one level_1 case study
shuffle($featured);
$oneFeatured = current($featured);

shuffle($case_studies);
$case_studies = array_diff($case_studies, array($oneFeatured));
$case_studies = array_values($case_studies);
array_unshift($case_studies, $oneFeatured);

shuffle($archive);

/*
echo '<pre>';
print_r($featured);
echo '</pre>';

echo '<pre>';
print_r($archive);
echo '</pre>';

echo '<pre>';
print_r($wrappers);
echo '</pre>';

echo '<pre>';
print_r($groups);
echo '</pre>';
*/
?>


<?php get_header();?>

	<!----------------------------------------------------
	Content
	-----------------------------------------------------> 
	<div id="wrapper"> 
		<div id="regular"> 
			<div class="isotope clearfix">
				<div class="element black_filter"  style="">
					
					<h3>Refine your project view</h3>
					<span id="total_case_studies"></span><br/>
					
					<p>This is an overview of our best work. Filter work selecting tags from the buttons below.</p>
					
					<span class="orange">Jump straight in:</span><br/>
					
					<?php
					$counter = 0;
					
					
					echo '<input id="type_all" class="filter_button type_all" type="button" value="All projects">';
					$three_buttons = array('Brand' => 'brand', 'Comms' => 'communications', 'Digital' => 'digital' );
					foreach($three_buttons as $name => $type){
						
					
						
						echo '<input id="type_'.strtolower($type).'" class="filter_button type_'.strtolower($type).'" type="button" value="'.$name.'">';
						
					}
					
					echo '<span class="orange bg">Filter firedog projects further by selecting:</span>';
					
					foreach($filter_tree as $base => $cats){ //discipline, theme, sector....
												
						if( !count($cats) )
							continue;
							
						if($base == 'clients')
							$label = 'Client';
						else
							$label = ucfirst($base);
						echo '<label>'.$label.':</label>';
						echo '<select id="'.$base.'" name="'.$base.'">';
							
						echo '<option data-filter="--" value="--" selected>Choose '.ucfirst($base).'</option>';
						foreach($cats as $cat => $parents){
							$cat_data = explode('_', $cat);
							$element = get_term( $cat_data[0], $base );	
						
							echo '<option data-filter=".'.$element->slug.'" value="'.$element->slug.'">'.$element->name.' ('.$element->count.')</option>';
									
							if( is_array($parents) AND count($parents)>0 ){
								foreach($parents as $parent => $value){
									$parent_data = explode('_', $parent);
									$element = get_term( $parent_data[0], $base );
										
									echo '<option data-filter=".'.$element->slug.'" value="'.$element->slug.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$element->name.' ('.$element->count.')</option>';
								}
							}

						}
						echo '</select><br/>';
					
					}
				?>
				</div> <!-- black_filter -->
				
				<?php
					/*****
					<ul style="display:none" id="filters" class="option-set floated clearfix"><!--other options: :not(.brand) and .brand:not(.digital-branding)--> 
						<li><a href="#filter" data-filter="*:not(.ungroup)" >show all</a></li> 
						<li><a href="#filter" data-filter=".list, .level_1:not(.ungroup)" >Hero</a></li> 
						<li><a href="#filter" data-filter=".list, .level_2:not(.ungroup)" >Tall</a></li> 
						<li><a href="#filter" data-filter=".list, .level_3:not(.ungroup)" >Small</a></li> 
						<li><a href="#filter" data-filter=".list, .strategy:not(.group)">Strategy</a></li> 
						<li><a href="#filter" data-filter=".list, .brand:not(.group)">Brand</a></li> 
						<li><a href="#filter" data-filter=".list, .brand-creation:not(.group)">Brand Creation</a></li> 
						<li><a href="#filter" data-filter=".list, .digital-branding:not(.group)">Digital Branding</a></li> 
						<li><a href="#filter" data-filter=".list, .digital:not(.group)">Digital</a></li> 
						<li><a href="#filter" data-filter=".list, .website:not(.group)">Websites</a></li> 
						<li><a href="#filter" data-filter=".list, .interface-design:not(.group)">Interface Design</a></li> 
						<li><a href="#filter" data-filter=".list, .animation:not(.group)"  class="selected">Animation</a></li> 
						<li><a href="#filter" data-filter=".list, .print:not(.group)" >Design for Print</a></li> 
						<!--<li><a href="#filter" data-filter=".list, .integrated">Integrated</a></li>--> 
						<li><a href="#filter" data-filter=".list, .campaigns:not(.group)">Campaigns</a></li> 
					</ul>
					***/
					
					
					//$discipline = get_the_terms( $post->ID,'discipline' );
					//print_r($discipline);
					//$cats_for_class .= strip_tags(get_the_term_list( $post->ID,'sector','',' ','')).' ';
					//$cats_for_class .= strip_tags(get_the_term_list( $post->ID,'theme','',' ',''));
					?>
				
						
					
					
				
					<?php
					$case_studies_counter = 0;
					foreach ($case_studies as $id) {
						
						$post = get_post( $id );
						setup_postdata($post);
							
						//RUN 

						$cats_for_class = array();
						$types = get_the_terms($post->id, 'cs_type');
						if ( !empty( $types ) ) :
							foreach ($types as $type) {
								//$cats_for_class[] = $type->slug;
								$level = $type->slug;
								break;
							}
						endif;
						$disciplines = get_the_terms($post->id, 'discipline');
						if ( !empty( $disciplines ) ) :
							foreach ($disciplines as $discipline) {
								$cats_for_class[] = $discipline->slug;
								
								$all_taxonomies_permalinks[$discipline->slug] = $discipline;
							}
						endif;
						$sectors = get_the_terms($post->id, 'sector');
						if ( !empty( $sectors ) ) :
							foreach ($sectors as $sector) {
								$cats_for_class[] = $sector->slug;
								
								$all_taxonomies_permalinks[$sector->slug] = $sector;
							}
						endif;
						$themes = get_the_terms($post->id, 'theme');
						if ( !empty( $themes ) ) :
							foreach ($themes as $theme) {
								$cats_for_class[] = $theme->slug;
								
								$all_taxonomies_permalinks[$theme->slug] = $theme;
							}
						endif;
						$clients = get_the_terms($post->id, 'clients');
						if ( !empty( $clients ) ) :
							foreach ($clients as $client) {
								$cats_for_class[] = $client->slug;
								
								$all_taxonomies_permalinks[$client->slug] = $client;
							}
						endif;
						
						$cats_for_class = implode(' ',$cats_for_class);
			
				
						//GROUP
						/**
						$group_name = '';
						$group = get_the_terms($post->id, 'group');
						if ( !empty( $group ) ) :
							if(count($group)>0){
								$group_name = 'ungroup';
								$real_group_name = current($group);
								$real_group_name = $real_group_name->slug;
							}
						endif;
						**/
						
						if( $level == 'level_1' AND $case_studies_counter == 0){
							$image_size = 'cs-image-large';
						}elseif( $level == 'level_1' ){
							$level = 'level_2';
							$image_size = 'cs-image-middle';
						}elseif( $level == 'level_2' ){
							$image_size = 'cs-image-small';
							$level = 'level_3';
						}

						/************
						//PRINT GROUP when first case study is included to group
						if(in_array($post->ID, $wrappers) AND in_array($real_group_name, $groups) ):
						
							unset($groups[$real_group_name]); //remove group from array to prevent from double group print to isotope
							
							foreach($group as $groupitem){
							
								$wrapper_name = $groupitem->name;
								$wrapper_desc = $groupitem->description;
								$wrapper_id = $groupitem->term_taxonomy_id;
								
								global $taxonomy_images_plugin;
								$image_id = $taxonomy_images_plugin->settings[$wrapper_id];
								
								$wrapper_img = wp_get_attachment_image_src( $image_id, 'post-first-featured-image-thumbnail' );
								//print_r($wrapper_img);
								break;
							}
							
						?>
							<div class="element list level_1 group" style="background-image: url('<?php echo $wrapper_img[0];?>')"> 
							<div class="project" style="postion:fixed; bottom:0px">
							
								<div class="project_detail" >
									<a class="view" rel="viewinfo" href="#"><h2 class="info"><?php echo $wrapper_name;?>  GROUP</h2></a> 
								</div> 
								<div class="further_detail"> 
									<p class="intro"><?php echo strip_tags($wrapper_desc); ?></p> 
								</div> 
							</div> 
						</div>
						<?php endif; 
						
						***/
						?>
						
						
						<?php
						//IMG
						if ( MultiPostThumbnails::has_post_thumbnail('case_studies', $image_size) ) :
						
							$img = MultiPostThumbnails::get_post_thumbnail_id('case_studies', $image_size, $post->ID);
						
							$img_attachment = get_post( $img );
							if ($img_attachment) {
								$image_src = $img_attachment->guid;
								//."' alt='".$img_attachment->post_content."' title='".$img_attachment->post_excerpt."' >";
							}
						endif;
						
						?>
						
						<div id="case_study_<?php echo $post->ID;?>" class="element list <?php if($case_studies_counter==0){echo 'level_1';}else{echo $level;} echo ' '.strtolower($cats_for_class);?>">
							<a class="image_href" href="<?php the_permalink(); ?>">
								<img src="<?php echo $image_src;?>">
							</a>
							<div class="project" style="postion:fixed; bottom:0px">
							<?php
							$client = get_the_terms($post->id, 'clients');
							$client = current($client);
							?>
								<div class="project_detail" >
									<a href="<?php the_permalink(); ?>"><h2 class="info"><?php echo $client->name;?> <span class="pipe">&#124;</span> <?php the_title(); ?></h2></a><div class="red_arrow"></div>
								</div> 
								<div class="further_detail"> 
									<p class="intro"><?php echo strip_tags(get_the_excerpt()); ?></p> 
									<p class="categories"><span>Discipline:</span> <?php echo get_the_term_list( $post->ID, 'discipline', '', ', ', '' );?> <span>Sector:</span> <?php echo get_the_term_list( $post->ID, 'sector', '', ', ', '' );?> <span>Themes:</span> <?php echo get_the_term_list( $post->ID, 'theme', '', ', ', '' );?></p> 
								</div> 
							</div> 
						</div>						
					<?php
					$case_studies_counter++;
					}
					wp_reset_query();
					?>
				
				</div> <!-- .isotope -->
				<br/><br/><br/>
				<h3 class="archive">Archive projects for <span id="filteredOption">all projects</span></h3><h6 class="back_to_top"><a href="#top">back to top <img src="<?php bloginfo('template_directory'); ?>/images/arrow-up-grey.png" /></a></h6>
				<div class="isotope archive clearfix" style="margin-bottom:30px">
					<div class="element black_filter list level_4" style="display:none;padding:0;margin:0;width:1px;height:0px"> 
						<a class="view" rel="viewinfo" href="<?php the_permalink(); ?>"><h6 class="archive">red</h6></a> 
					</div>
						
					<?php
					foreach ($archive as $id) {
						
						$post = get_post( $id );
						setup_postdata($post);
						
						$cats_for_class = array();
								
						$disciplines = get_the_terms($post->id, 'discipline');
						if ( !empty( $disciplines ) ) :
							foreach ($disciplines as $discipline) {
							$cats_for_class[] = $discipline->slug;
							
							$all_taxonomies_permalinks[$discipline->slug] = $discipline;
							}
						endif;
						$sectors = get_the_terms($post->id, 'sector');
						if ( !empty( $sectors ) ) :
							foreach ($sectors as $sector) {
								$cats_for_class[] = $sector->slug;
								
								$all_taxonomies_permalinks[$sector->slug] = $sector;
							}
						endif;
						$themes = get_the_terms($post->id, 'theme');
						if ( !empty( $themes ) ) :
							foreach ($themes as $theme) {
								$cats_for_class[] = $theme->slug;
								
								$all_taxonomies_permalinks[$theme->slug] = $theme;
							}
						endif;
						$clients = get_the_terms($post->id, 'clients');
						if ( !empty( $clients ) ) :
							foreach ($clients as $client) {
								$cats_for_class[] = $client->slug;
								
								$all_taxonomies_permalinks[$client->slug] = $client;
							}
						endif;
						
						$cats_for_class = implode(' ',$cats_for_class);
					
						?>
							
						<div class="element list level_4 <?php echo ' '.strtolower($cats_for_class);?>"> 
							<a class="view" rel="viewinfo" href="<?php the_permalink(); ?>"><h6 class="archive"><?php echo $client->name;?> <span class="pipe">&#124;</span> <?php the_title(); ?></h6></a> 
						</div>
					
						<?php
						}
						wp_reset_query();
						?>
						
				</div>
		</div> <!-- #regular --> 
	</div><!-- #wrapper -->
			
	<script type="text/javascript" src="<?php bloginfo( 'template_url' )?>/js/jquery.cookie.js" ></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' )?>/js/jquery.hoverIntent.minified.js" ></script>
	<script type='text/javascript' src='<?php bloginfo( 'template_url' )?>/js/jquery.isotope.min.js'></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' )?>/jqtransform/jquery.jqtransform.modified.js" ></script>
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' )?>/jqtransform/jqtransform.css" type="text/css" media="all" />
	
	<script type="text/javascript">
	jQuery.noConflict();
	
	<?php
	//Create permalinks array for location.hash
	?>
	
	var taxonomies_permalinks = new Array();
	
	<?php
	$front_url = get_bloginfo('siteurl').'/creative-results/'; //need remove from permalink this string
	foreach($taxonomies_IDS as $slug){
		foreach($all_taxonomies_permalinks as $taxonomy){
			if($slug == $taxonomy->slug){
				echo "taxonomies_permalinks['".$slug."'] = '".str_replace($front_url,'',get_term_link($taxonomy, $slug))."';\n"; //$back_link = get_term_link($term, $term->taxonomy);
				break;
			}
		}
	}
			
	//print_r($taxonomies_IDS);
	
	?>
	
	function total_case_studies(){
	
		var elements_total = 0;
		jQuery(".isotope > .element:not(.black_filter)").each(function(){
		
			var opacity = jQuery(this).css('opacity');
			if (opacity != '0')
				elements_total = elements_total*1 +1;
		});
		
		jQuery('#total_case_studies').html(elements_total +' Projects displayed');
	}
	
	function style_filter_select(taxonomy, slug){
	
		jQuery('.jqTransformSelectWrapper.'+taxonomy+' div span').html(function() {
			var select_parent = jQuery(this).parent().parent();
			var first_value = jQuery(".jqTransformHidden option[value="+slug+"]", select_parent).html();
			return first_value;
		});
		jQuery('.jqTransformSelectWrapper div span, .jqTransformSelectOpen').addClass('active');
		jQuery('.jqTransformSelectWrapper div span:contains("Choose ")').removeClass('active');
		jQuery('.jqTransformSelectWrapper div span:contains("Choose ")').parent().find('.jqTransformSelectOpen').removeClass('active');
	
	}
	
	function cookie_lastFilter(slug){
		
		if(!slug){
			var active_tag = jQuery('.jqTransformSelectWrapper div span.active');
			var tag_html = active_tag.html();
			
			//var select_parent = active_tag.parent().parent();
			var first_value = jQuery(".jqTransformSelectWrapper ul li a[title="+tag_html+"]").attr('id');
		}else
			var first_value = slug;
			
		if(first_value == 'undefined')
			first_value = 'all';
			
		var date = new Date();
		date.setTime(date.getTime() + (30 * 60 * 1000));
		
		jQuery.cookie("filter_last_mode", first_value, {expires: date, path: "/"} );
		
		/**
		if(first_value!='all'){
			alert(first_value + ' ' + taxonomies_permalinks[first_value]);
			parent.location.pathname = '/' + taxonomies_permalinks[first_value];
			return false;
		}
		**/
		//Change archive for ....
		if(tag_html != null){
			var archive_text = tag_html.replace("&nbsp;&nbsp;&nbsp;&nbsp;","");
			var archive_text_array = archive_text.split(" (");
			archive_text = archive_text_array[0].toLowerCase();;
			jQuery('#filteredOption').html(archive_text);
		}else{
			jQuery('#filteredOption').html('all projects');
		}
	}
	
	function cookie_filter_cs_ids(){
		//Save to cookie filter results (case studies ID)
		var filter_cs_ids = new Array();
		var cs = 0;
		var isotope_block = jQuery(".isotope:not(.archive)");
		jQuery(".element:not(.black_filter)", isotope_block).each(function(){
		
			var opacity = jQuery(this).css('opacity');
			if (opacity != '0'){
				var cs_ID = jQuery(this).attr('id');
				filter_cs_ids[cs] = cs_ID.replace('case_study_','');
				cs++;
			}
		});
		//alert(filter_cs_ids.join(','));
		var date = new Date();
		date.setTime(date.getTime() + (30 * 60 * 1000));
		jQuery.cookie("filter_cs_ids", filter_cs_ids.join(','), { expires: date, path: "/"} );
	};
	
	jQuery(function(){
	
		//Transform .black_filter inputs	
		jQuery('.black_filter').jqTransform({
			imgPath:'<?php bloginfo( 'template_url' )?>/jqtransform/img/'
		});
      
		var $container = jQuery('.isotope');
      
		$container.isotope({
			itemSelector: '.element',
			transformsEnabled: false,
			hiddenClassString: 'hidden'
		});
	  
		<?php if($active_tax != 'creative-results'):?>
		jQuery('.isotope').isotope({ filter: '.black_filter, .<?php echo $active_tax->slug;?>' });
		
		style_filter_select('<?php echo $active_tax->taxonomy;?>', '<?php echo $active_tax->slug;?>');
		
		cookie_lastFilter('<?php echo $active_tax->slug;?>');
		
		<?php else:?>
		jQuery('.isotope').isotope({ filter: '.black_filter, .list' });
		<?php endif;?>
		setTimeout(total_case_studies, 1000);
		
    });
	
	//Reset filter selects
	var select = jQuery('.black_filter select');
	select.val(jQuery('options:first', select).val());
	
	jQuery(".filter_button").live('click',function() {
		var filter_class = jQuery(this).attr('id');
		
		jQuery(".filter_button").removeClass('active');
		jQuery(this).addClass('active');
		
		//select.val(jQuery('options:first', select).val());
		var selected_filter_block = filter_class.replace("type_","");
		
		if(selected_filter_block == 'all'){
			jQuery('.isotope').isotope({ filter: '.black_filter, .list' });
			
			jQuery(".jqTransformSelectWrapper div span").html(function() {
				var select_parent = jQuery(this).parent().parent();
				var first_value = jQuery(".jqTransformHidden option:eq(0)", select_parent).html();
				return first_value;
			});
			
		}else{
		
			jQuery('.isotope').isotope({ filter: '.black_filter, .' + selected_filter_block });
			
			style_filter_select('discipline', selected_filter_block);
			
		}
		
		
			
		jQuery(".jqTransformSelectWrapper:not(.discipline) div span").html(function() {
			var select_parent = jQuery(this).parent().parent();
			var first_value = jQuery(".jqTransformHidden option:eq(0)", select_parent).html();
			return first_value;
		});
		jQuery('.jqTransformSelectWrapper div span, .jqTransformSelectOpen').addClass('active');
		jQuery('.jqTransformSelectWrapper div span:contains("Choose ")').removeClass('active');
		jQuery('.jqTransformSelectWrapper div span:contains("Choose ")').parent().find('.jqTransformSelectOpen').removeClass('active');
		
		
		
		cookie_lastFilter();
		setTimeout(cookie_filter_cs_ids, 1000);
		
		setTimeout(total_case_studies, 1000);
		
		
	});				
				
	jQuery(function() {
		//jQuery('div.further_detail').hide();
		
		jQuery(".project").each(function(){
			jQuery(this).find('.further_detail').show();
			jQuery(this).css('bottom', '-' + jQuery(this).find('.further_detail').height() + 'px');
		});

		
		var hover_config = {    
			over: makeTall,
			interval: 100,			
			timeout: 300,   
			out: makeShort
		};
		jQuery(".project").hoverIntent( hover_config );
		
		function makeTall() {
			jQuery(this).find('.project_detail').addClass('active');
			jQuery(this).stop().animate({bottom:'0px'}, 1000, "easeInOutExpo");
		};
		function makeShort() {
			jQuery(this).stop().animate({bottom:'-' + jQuery(this).find('.further_detail').height() + 'px'},{queue:false,duration:700,easing:'easeInOutExpo'});
			jQuery(this).find('.project_detail').removeClass('active');
		};
		
	});
	</script> 

<?php
/***

	jQuery(function() {
		jQuery('div.further_detail').hide();
		jQuery(".project").hover(function(){
			jQuery(this).find('.further_detail').css({"display" :"block"}).animate({
				height: jQuery(this).find('.further_detail').height()
			}, 500);
		},
		function(){
		  jQuery(this).find('.further_detail').stop().css({"display" :"none"}).animate({
			  height: 0
		  }, 500);
	   });
**/
?>

			
<?php get_footer(); ?>