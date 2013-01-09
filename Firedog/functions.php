<?php
// Excerpt content
function custom_get_the_excerpt( $content, $length = 15, $ellipsis = '...' ) {

	$content = strip_tags( strip_shortcodes( $content ) );
	
	$content = preg_replace( '/\s+/', ' ', $content );
	$words = explode( ' ', $content );
	if ( count( $words ) > $length ){
		$excerpt = implode( ' ', array_slice( $words, 0, $length ) ) . $ellipsis;
	}else
		$excerpt = $content;
    
    return $excerpt;
}

// Adds in support for additional menus.
function register_my_menus() {
  register_nav_menus(
    array( 'primary' => __( 'Primary Navigation' ), 'sitemap-one' => __( 'Footer Sitemap Column 1' ), 'sitemap-two' => __( 'Footer Sitemap Column 2' ), 'sitemap-three' => __( 'Footer Sitemap Column 3' ))
  );
}

add_action( 'init', 'register_my_menus' );

add_post_type_support( 'page', 'excerpt' );
add_post_type_support( 'case_studies', 'excerpt' );


/////////
//ENABLE POST-THUMBNAILS MOD
/////////
add_theme_support( 'post-thumbnails' );
//add_filter( 'jpeg_quality', 'jpeg_full_quality' );function jpeg_full_quality( $quality ) { return 100; }
// Adds in support for multi featured images

add_image_size('post-first-featured-image-thumbnail', 600, 390, true);
add_image_size('post-second-featured-image-thumbnail', 295, 390, true);
add_image_size('post-third-featured-image-thumbnail', 295, 190, true);
add_image_size('image_152x72', 152, 72, true);
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(array(
		'label' => 'Level One Image',
		'id' => 'first-featured-image',
		'post_type' => 'post'
		)
	);
}
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(array(
		'label' => 'Level Two Image',
		'id' => 'second-featured-image',
		'post_type' => 'post'
		)
	);
}
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(array(
		'label' => 'Level Three Image',
		'id' => 'third-featured-image',
		'post_type' => 'post'
		)
	);
}

//ADD 3 Cases studies images
// Level 2 thumb (295x190)
// Level 1 Alt Thumb (295x390)
// Level 1 Thumb (600x390)
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
		array(
			'label' => 'Level 2 thumb (295x190)',
			'id' => 'cs-image-small',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Level 1 Alt Thumb (295x390)',
			'id' => 'cs-image-middle',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Level 1 Thumb (600x390)',
			'id' => 'cs-image-large',
			'post_type' => 'case_studies'
		)
	);
};
//ADD 20 Fullscreen images for case studies post type
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 1',
			'id' => 'fullscreen-image-1',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 2',
			'id' => 'fullscreen-image-2',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 3',
			'id' => 'fullscreen-image-3',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 4',
			'id' => 'fullscreen-image-4',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 5',
			'id' => 'fullscreen-image-5',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 6',
			'id' => 'fullscreen-image-6',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 7',
			'id' => 'fullscreen-image-7',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 8',
			'id' => 'fullscreen-image-8',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 9',
			'id' => 'fullscreen-image-9',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 10',
			'id' => 'fullscreen-image-10',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 11',
			'id' => 'fullscreen-image-11',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 12',
			'id' => 'fullscreen-image-12',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 13',
			'id' => 'fullscreen-image-13',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 14',
			'id' => 'fullscreen-image-14',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 15',
			'id' => 'fullscreen-image-15',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 16',
			'id' => 'fullscreen-image-16',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 17',
			'id' => 'fullscreen-image-17',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 18',
			'id' => 'fullscreen-image-18',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 19',
			'id' => 'fullscreen-image-19',
			'post_type' => 'case_studies'
		)
	);
	new MultiPostThumbnails(
		array(
			'label' => 'Fullscreen 20',
			'id' => 'fullscreen-image-20',
			'post_type' => 'case_studies'
		)
	);
}


function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
 
  /* 
  Repeat with any other buttons you want to add, e.g.
	  $buttons[] = 'fontselect';
	  $buttons[] = 'sup';
  */
 
  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

/////////
// EXCERPT LENGTH LIMIT
/////////
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

/////////
// CUSTOM TAXONOMIES
/////////
add_action( 'init', 'build_customPOST_type_taxonomies', 0 );  
function build_customPOST_type_taxonomies() {
 
	//REGISTER CASE STUDIES POST TYPE
	register_post_type( 'case_studies',
		array(
			'labels' => array(
				'name' => ( 'Case studies' ), //this name will be used when will will call the investments in our theme
				'singular_name' => ( 'Case study' ),
				'add_new' => ('Add new case study'),
				'add_new_item' => ('Add new case study'), //custom name to show up instead of Add New Post. Same for the following
				'edit' => ('Edit'),
				'edit_item' => ('Edit case study'),
				'new_item' => ('New case study'),
				'view_item' => ('View case study'),
				'not_found' => ('Not found case studies'),
				'not_found_in_trash' => __( 'Not found case studies in trash' ),
			  ),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => false, //it means we cannot have parent and sub pages
			'capability_type' => 'post', //will act like a normal post
			'publicly_queryable' => true,
			'rewrite' => array( 'slug' => 'creative-results', 'with_front' => FALSE ), //this is used for rewriting the permalinks
			'taxonomies' => array( 'clients', 'sector', 'discipline', 'theme', 'award', 'group'),//'can_export' => true,
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'custom-fields', 'excerpt', 'thumbnail', 'page-attributes','sticky-posts'),
			'menu_icon' => get_stylesheet_directory_uri() . '/icon_case_studies.png',
		)
	);

	$case_studies_type_labels = array(
		'name' => ( 'Level' ),
		'singular_name' => ( 'Case study Level' ),
		'search_items' =>  ( 'Search Levels' ),
		'all_items' => ( 'All Levels' ),
		'edit_item' => ( 'Edit Level' ),
		'update_item' => ( 'Update Level' ),
		'add_new_item' => ( 'Add new Level' ),
		'new_item_name' => ( 'New Level name' ),
	);	
	$client_labels = array(
		'name' => ( 'Client' ),
		'singular_name' => ( 'Client' ),
		'search_items' =>  ( 'Search Clients' ),
		'all_items' => ( 'All Clients' ),
		'edit_item' => ( 'Edit Client' ),
		'update_item' => ( 'Update Client' ),
		'add_new_item' => ( 'Add new Client' ),
		'new_item_name' => ( 'New Client name' ),
	);
	$discipline_labels = array(
		'name' => ( 'Discipline' ),
		'singular_name' => ( 'Discipline' ),
		'search_items' =>  ( 'Search Discipline' ),
		'all_items' => ( 'All Disciplines' ),
		'edit_item' => ( 'Edit Discipline' ),
		'update_item' => ( 'Update Discipline' ),
		'add_new_item' => ( 'Add new Discipline' ),
		'new_item_name' => ( 'New Discipline name' ),
	);
	$sector_labels = array(
		'name' => ( 'Sector' ),
		'singular_name' => ( 'Sector' ),
		'search_items' =>  ( 'Search Sector' ),
		'all_items' => ( 'All Sectors' ),
		'edit_item' => ( 'Edit Sector' ),
		'update_item' => ( 'Update Sector' ),
		'add_new_item' => ( 'Add new Sector' ),
		'new_item_name' => ( 'New Sector name' ),
	);
	$theme_labels = array(
		'name' => ( 'Theme' ),
		'singular_name' => ( 'Theme' ),
		'search_items' =>  ( 'Search Theme' ),
		'all_items' => ( 'All Themes' ),
		'edit_item' => ( 'Edit Theme' ),
		'update_item' => ( 'Update Theme' ),
		'add_new_item' => ( 'Add new Theme' ),
		'new_item_name' => ( 'New Theme name' ),
	);
	$award_labels = array(
		'name' => ( 'Award' ),
		'singular_name' => ( 'Award' ),
		'search_items' =>  ( 'Search Award' ),
		'all_items' => ( 'All Awards' ),
		'edit_item' => ( 'Edit Award' ),
		'update_item' => ( 'Update Award' ),
		'add_new_item' => ( 'Add new Award' ),
		'new_item_name' => ( 'New Award name' ),
	);
	$group_labels = array(
		'name' => ( 'Group' ),
		'singular_name' => ( 'Group' ),
		'search_items' =>  ( 'Search Group' ),
		'all_items' => ( 'All Groups' ),
		'edit_item' => ( 'Edit Group' ),
		'update_item' => ( 'Update Group' ),
		'add_new_item' => ( 'Add new Group' ),
		'new_item_name' => ( 'New Group name' ),
	);
	
	register_taxonomy(
		'cs_type', array('case_studies'),
		array(
			'show_ui' => true,
			'labels' => $case_studies_type_labels,
			'query_var' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'type',
				'with_front' => false
			)
		)
	);
    register_taxonomy(
		'clients', array('case_studies'),
		array(
			'show_ui' => true,
			'labels' => $client_labels,
			'query_var' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'creative-results/clients',
				'with_front' => false,
				'hierarchical' => false
			)
		)
	);
    register_taxonomy(
		'discipline', array('case_studies'),
		array(
			'show_ui' => true,
			'labels' => $discipline_labels,
			'query_var' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'creative-results/discipline',
				'with_front' => false,
				'hierarchical' => true
			)
		)
	);
    register_taxonomy(
		'sector', array('case_studies'),
		array(
			'show_ui' => true,
			'labels' => $sector_labels,
			'query_var' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'creative-results/sector',
				'with_front' => false,
				'hierarchical' => true
			)
		) 
	);
    register_taxonomy(
		'theme', array('case_studies'),
		array(	
			'show_ui' => true,
			'labels' => $theme_labels,
			'query_var' => true,
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'creative-results/theme',
				'with_front' => false,
				'hierarchical' => false,
			)
		)
	);
    register_taxonomy(
		'award', array('case_studies'),
		array(	
			'show_ui' => true,
			'labels' => $award_labels,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'creative-results/award',
				'with_front' => false,
				'hierarchical' => true,
			)
		)
	);
	register_taxonomy(
		'group', array('case_studies'),
		array(	
			'show_ui' => true,
			'labels' => $group_labels,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'creative-results/group',
				'with_front' => false,
				'hierarchical' => true,
			)
		)
	);
	
	
}

///////////////////
/// ADD CUSTOM META BOX FOR ORDER FULLSCREEN images
///////////////////
add_action( 'admin_init', 'add_fullscreen_order_metabox' );
add_action( 'save_post', 'save_fullscreen_ordering' );
function add_fullscreen_order_metabox() {
    add_meta_box('fullscreen_order', 'Fullscreen images order', 'fullscreen_ordering', 'case_studies', 'side', 'default');
}
function fullscreen_ordering() {
    global $post;
	$hided_fullscreens = array();
	$showed_fullscreens = array();
	
	$fullscreen_order_value = get_post_meta( $post->ID, 'fullscreen_order_value', true );
	$fullscreen_order_value = explode(',',$fullscreen_order_value);
	
	$home_page_featured_image = get_post_meta( $post->ID, 'home_page_featured_image', true );
	
	if(count($fullscreen_order_value)<2) 
		$fullscreen_order_value = range(1,20);
	else{
		//ADD to input all new images if not exist in fullscreen_order_value to end of array
		echo 'bingo';
		$twenty = range(1,20);
		$new_images = array_diff($twenty, $fullscreen_order_value);
		$fullscreen_order_value = array_merge($fullscreen_order_value,$new_images);
	}
	
	
    echo '<input type="hidden" name="fullscreen_order_value" id="fullscreen_order_value" value="'.implode(',',$fullscreen_order_value).'" />';
 
    // Get the location data if its already been entered
   
    // Echo out the field
    //echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';
	echo "<ul id='fullscreen_ordering'>";
	
	foreach( $fullscreen_order_value as $i){
		$img = '';
		if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'fullscreen-image-'.$i) ) {
			$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'fullscreen-image-'.$i, $post->ID, 'thumbnail');
			
			$showed_fullscreens[] = $i;
		}
		if($img){
			//title="Homepage featured image"
			$radio ='';
			if($home_page_featured_image == $i)
				$radio = 'checked="checked" title="This image is showing on homepage" ';
			else
				$radio = 'title="Select image for homepage" ';
			
			echo '<li id="'.$i.'"><input '.$radio.'type="radio" name="home_page_featured_image" value="'.$i.'" /> '.$img.' Fullscreen '.$i.'</li>';
		}else
			$hided_fullscreens[] = $i;
	}
		
	if(count($hided_fullscreens)>0){
		foreach($hided_fullscreens as $h){
			echo '<li class="hide_img" id="'.$h.'">Fullscreen '.$h.'</li>';
		}
	}

	
	
	echo '</ul>';
	
	if(count($hided_fullscreens)==20)
		echo 'no images for order';
}
function save_fullscreen_ordering( $post_id ) {
	global $post;	

	if( $_POST ) {
		update_post_meta( $post->ID, 'fullscreen_order_value', $_POST['fullscreen_order_value'] );
		update_post_meta( $post->ID, 'home_page_featured_image', $_POST['home_page_featured_image'] );
	}
}
function fullscreen_ordering_styles() {
	global $post;
	$pages = array('edit.php');
	if ($post->post_type == 'case_studies')
		wp_enqueue_style('casestudies_groups', get_bloginfo('template_url').'/library/groups-sort.css');
}
add_action( 'admin_print_styles', 'fullscreen_ordering_styles' );
function fullscreen_ordering_print_scripts() {
	global $post;
	$pages = array('edit.php');
	if ($post->post_type == 'case_studies'){
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('casestudies_groups', get_bloginfo('template_url').'/library/fullscreens-sort.js');
	}
}
add_action( 'admin_print_scripts', 'fullscreen_ordering_print_scripts' );
///////////////////
/// END OF 'ADD CUSTOM META BOX FOR ORDER FULLSCREEN images'
///////////////////



















///////////////////
// REWRITE CREATIVE-RESULTS and TAXONOMY permalinks
function do_rewrite_test() {
	add_rewrite_rule('creative-results/discipline/(.+?)/?$','index.php?post_type=case_studies&discipline=$matches[1]', 'top');
	add_rewrite_rule('creative-results/sector/([^/]*)/?','index.php?post_type=case_studies&sector=$matches[1]', 'top');
	add_rewrite_rule('creative-results/theme/([^/]*)/?','index.php?post_type=case_studies&theme=$matches[1]', 'top');
	add_rewrite_rule('creative-results/clients/([^/]*)/?','index.php?post_type=case_studies&clients=$matches[1]', 'top');
	add_rewrite_rule('creative-results/award/([^/]*)/?','index.php?post_type=case_studies&award=$matches[1]', 'top');
	add_rewrite_rule('creative-results/group/([^/]*)/?','index.php?post_type=case_studies&group=$matches[1]', 'top');
}
add_action('init', 'do_rewrite_test');




/**
add_filter('term_link', '_hierarchical_terms_hierarchical_links', 9, 3);
function _hierarchical_terms_hierarchical_links($termlink, $term, $taxonomy) {
    global $wp_rewrite;

    if ( 'discipline' != $taxonomy ) // Change 'state' to your required taxonomy
        return $termlink;

    $termstruct = $wp_rewrite->get_extra_permastruct($taxonomy);
    if ( empty($termstruct) ) // If rewrites are disabled, fall back to the current link
        return $termlink;

    if ( empty($term->parent) ) // Fall back to the current link for parent terms
        return $termlink;
    
    $nicename = $term->slug;
    while ( !empty($term->parent) ) {
        $term = get_term($term->parent, $taxonomy);
        $nicename = $term->slug . '/' . $nicename;
    }

    $termlink = str_replace("%$taxonomy%", $nicename, $termstruct);
    $termlink = home_url( user_trailingslashit($termlink, 'category') );

    return $termlink;
}
**/












/////////
//ADD CUSTOM POST TYPE TO DEFAULT LOOP|QUERY
/////////
add_filter( 'pre_get_posts' , 'ucc_include_custom_post_types' );
function ucc_include_custom_post_types( $query ) {
	global $wp_query;

	/* Don't break admin or preview pages. This is also a good place to exclude feed with !is_feed() if desired. */
	if ( !is_preview() && !is_admin() && !is_singular() ) {
		$args = array(
			'public' => true ,
			'_builtin' => false
		);
		$output = 'names';
		$operator = 'and';

		$post_types = get_post_types( $args , $output , $operator );

		/* Add 'link' and/or 'page' to array() if you want these included:
		 * array( 'post' , 'link' , 'page' ), etc.
		 */
		$post_types = array_merge( $post_types , array( 'post' ) );

		if ($query->is_feed) {
		  /* Do feed processing here if you did not exclude it previously. This if/else 
		   * is not necessary if you want custom post types included in your feed.
		   */
		} else {
			$my_post_type = get_query_var( 'post_type' );
			if ( empty( $my_post_type ) )
				$query->set( 'post_type' , $post_types );
		}
	}
	return $query;
}
/////////
// ADD CASE STUDIES FILTER BY TAXONOMY IN BACKEND
/////////
add_action( 'restrict_manage_posts', 'add_filter_elements_restrict_manage_posts' );
function add_filter_elements_restrict_manage_posts() {
	global $typenow;
	
	if( $typenow == "case_studies" ){
		//echo "<input type='hidden' name='meta_key' value='extra_parameter_show_on_homepage'>";
		$show_on_homepage = $_GET['extra_parameter_show_on_homepage'];
		$yes = 'true';
		$no = 'false';
		echo "<select name='extra_parameter_show_on_homepage' id='extra_parameter_show_on_homepage' class='postform'>";
			echo "<option value=''>Show on Home</option>";
			echo '<option value='. $yes, $show_on_homepage == 'true' ? ' selected="selected"' : '','>Yes</option>';
			echo '<option value='. $no, $show_on_homepage == 'false' ? ' selected="selected"' : '','>No</option>';
		echo "</select>";
	
		$filters = array('cs_type', 'clients', 'sector', 'discipline', 'theme', 'award', 'group');
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}
add_action( 'parse_query', 'status_filter' );
function status_filter() {

	global $pagenow, $post_type;
	if( $pagenow == 'edit.php' AND $post_type == 'case_studies' AND isset( $_GET['extra_parameter_show_on_homepage'] ) AND  $_GET['extra_parameter_show_on_homepage'] != ''){
		
		$meta_group = array(
			'key' => 'extra_parameter_show_on_homepage',
			'value' => $_GET['extra_parameter_show_on_homepage']
		);
		set_query_var( 'meta_query', array( $meta_group ) );
	}
}
/////////
// ADD EXTRA COLLUMNS IN POSTS LIST OF ADMIN CASE_STUDIES -->   title | client | sector | discipline | theme | group | date
/////////
add_filter( 'manage_case_studies_posts_columns', 'ilc_cpt_columns' );
add_action('manage_case_studies_posts_custom_column', 'ilc_cpt_custom_column', 10, 2);
function ilc_cpt_columns($defaults) {

	unset($defaults['date']); //Move date to end of array
	unset($defaults['title']); //Move date to end of array
	
	$defaults['thumbnail'] = 'Thumb';
	$defaults['title'] = 'Title';
	$defaults['extra_parameter_show_on_homepage'] = 'Show on Home';
    $defaults['cs_type'] = 'Level';
    $defaults['clients'] = 'Client';
    $defaults['sector'] = 'Sector';
    $defaults['discipline'] = 'Discipline';
    $defaults['theme'] = 'Theme';
    $defaults['group'] = 'GROUP';
    $defaults['date'] = 'Date';
    return $defaults;
}
function ilc_cpt_custom_column($column_name, $post_id) {

	if($column_name == 'thumbnail'){
		$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'cs-image-small', $post_id);
		if($img)
			echo $img;
		
	}elseif($column_name == 'extra_parameter_show_on_homepage'){
		$status = (get('extra_parameter_show_on_homepage',1,1,1,$post_id))? 'Yes' : 'No';
		echo $status;
	}else{
		$taxonomy = $column_name;
		$post_type = get_post_type($post_id);
		$terms = get_the_terms($post_id, $taxonomy);
	 
		if ( !empty($terms) ) {
			foreach ( $terms as $term )
				$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
			echo join( ', ', $post_terms );
		}
		else echo '<i>None</i>';
	}
}












function casestudies_enable_group_sort() {
    add_submenu_page('edit.php?post_type=case_studies', 'Sort Groups', 'Sort Groups', 'edit_posts', basename(__FILE__), 'casestudies_sort_groups');
}
add_action('admin_menu' , 'casestudies_enable_group_sort'); 
 
/**
 * Display Sort admin
 **/
function casestudies_sort_groups() {


	$groups = new WP_Query('post_type=case_studies&taxonomy=group&posts_per_page=-1&orderby=menu_order&order=ASC');
?>
	<div class="wrap">
	<h3>Sort Groups <img src="<?php bloginfo('url'); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h3>
	<ul id="groups-list">
	<?php while ( $groups->have_posts() ) : $groups->the_post(); 
	$group_array = get_the_terms ($post->id, 'group');
	
	if (!empty($group_array)) :
	$group = strip_tags(get_the_term_list( $post->ID, 'group', '|| ', ', ', '' ));
	?>
		<li id="<?php the_id(); ?>"><?php the_title(); ?> <span style="font-weight:normal"><?php echo $group;?></span></li>			
	<?php
	endif;
	endwhile; ?>
	</ul>
	</div><!-- End div#wrap //-->
 
<?php
}
 
function casestudies_groups_print_styles() {
	global $pagenow;
 
	$pages = array('edit.php');
	if (in_array($pagenow, $pages))
		wp_enqueue_style('casestudies_groups', get_bloginfo('template_url').'/library/groups-sort.css');
}
add_action( 'admin_print_styles', 'casestudies_groups_print_styles' );
function casestudies_groups_print_scripts() {
	global $pagenow;
 
	$pages = array('edit.php');
	if (in_array($pagenow, $pages)) {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('casestudies_groups', get_bloginfo('template_url').'/library/groups-sort.js');
	}
}
add_action( 'admin_print_scripts', 'casestudies_groups_print_scripts' );

/*Save group items order*/
function casestudies_save_groups_order() {
	global $wpdb; // WordPress database class
 
	$order = explode(',', $_POST['order']);
	$counter = 0;
 
	foreach ($order as $video_id) {
		$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $video_id) );
		$counter++;
	}
	die(1);
}
add_action('wp_ajax_groups_sort', 'casestudies_save_groups_order');

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );




////////////////
// ADD browser class to body
////////////////
add_filter('body_class','browser_body_class');
function browser_body_class($classes = '') {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	return $classes;
}

function thinking_space_id(){

	//////////////////////////////////////////////////////////////////
	//ADD thinking-space to BLOG pages/subpages/archives/cats/posts
	$category = get_the_category();
    $parent = $category[0]->category_parent;
    while($parent > 0) {
        $idlevel = &get_category($parent);
        $cat = $idlevel->cat_ID;
        $parent = $idlevel->parent;
    }
	
	$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$taxonomy = $current_term->taxonomy;
	
	$not_allow = array('sector', 'discipline', 'theme', 'clients');

	
	
	if(( $cat == 122 OR is_archive() ) AND ( !is_page_template( 'work-page.php' ) AND !in_array($taxonomy,$not_allow) ) ){
		return true;
	}else
		return false;
	//////////////////////////////////////////////////////////////////

}
////////////////
// END browser class to body
////////////////












/////////
//ADD TEMPLATE FOR CUSTOM POST TYPE
/////////
function my_template_redirect() {
	if ( is_robots() || is_feed() || is_trackback() || is_single() ) {
		return; // run the default action
	}
	global $wp;
	$template = locate_template(array('type-'.$wp->query_vars['post_type'].'.php'), true);
	if ($template) {
		exit();
	}
}
add_action('template_redirect', 'my_template_redirect');


/////////
//ENABLE MENUS MODULE
/////////
add_theme_support( 'menus' );

/////////
//REMOVE UNUSET ADMIN MENU ITEMS
/////////
function remove_menu_items(){
	global $menu;
	//print_r($menu);
	//Remove Case studies custom write panel menu
	unset($menu[6]);
}
add_action('admin_menu', 'remove_menu_items');

/////////
//DISABLE WORDPRESS VERSION CHECK
/////////
if (!current_user_can('edit_users')) {
  add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
  add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

//ADD custom style to improving the UI for Hierarchical Taxonomies 
function custom_wp_tab_panel_style() {
   echo '<style type="text/css">
           .wp-tab-panel, .categorydiv div.tabs-panel, .customlinkdiv div.tabs-panel, .posttypediv div.tabs-panel, .taxonomydiv div.tabs-panel, #linkcategorydiv div.tabs-panel {height:auto}
		    #postexcerpt {display:block !important;}
			#row_25_1_1_5_fullscreen_images_order label,
			#collapse_5Duplicate_5_1  {display:none !important}
         </style>';
}

add_action('admin_footer', 'custom_wp_tab_panel_style');



function feed_request($result) {
	if ( $result['feed'] == 'rss' && $result['pagename'] == 'creative-results' ){
		unset($result['pagename']);
		$results['feed'] = 'rss';
		$result['post_type'] = array('case_studies');
	}
	return $result;
}
add_filter('request', 'feed_request');





?>

<?php //if ( in_category( 'thinking-space' ) || post_is_in_descendant_category( 122 ) ) { Post is assigned to "thinking-space" category or any descendant of "thinking-space" category?
	// These are all descentants of thinking space…
//}
?>