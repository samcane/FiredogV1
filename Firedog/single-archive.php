<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>
<div class="row one padding_LR">
			<ul class="sub_nav">
            	<li class="section">Case study</li>
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
                <li class="page_item page-item-15"><a href="<?php echo $back_link ?>">Return to overview</a></li>
            </ul>
</div>
	<?php
		$client = get_the_terms($post->id, 'clients');
		$client = current($client);
    ?>
<div class="row six single_archive">
	<?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    	<div class="header">
        	<h1><?php echo $client->name;?></h1>
        	<h4>Who was the client</h4>
        	<h3 class="four"><?php echo $client->description;?></h3>
        </div>
        <div class="archive_large">
        <?php if (class_exists('MultiPostThumbnails')
    		&& MultiPostThumbnails::has_post_thumbnail('case_studies', 'fullscreen-image-1')) :
        	MultiPostThumbnails::the_post_thumbnail('case_studies', 'fullscreen-image-1'); endif; ?>
        </div>
        <?php //This adds the 1st and 2nd colum of content using content parts
				if ( function_exists( 'the_content_part' ) && has_content_parts() ) {
					the_content_part( 1, '<div class="row two">', '</div>' );
					the_content_part( 2, '<div class="row two">', '</div>' );
					the_content_part( 3, '<div class="row two">', '' );
				} else {
					the_content();
				}
		?>
        	<hr />
            <h4>Project Tags</h4>
            <ul class="archive_tag">
                <li class="port_item">Discipline:&nbsp;</li>
                <li><?php echo get_the_term_list( $post->ID, 'discipline', '',', ' , '');?></li>            
            </ul><br />
            <ul class="archive_tag">
                <li class="port_item">Sector:&nbsp;</li>
                <li><?php echo get_the_term_list( $post->ID, 'sector', '',', ', '');?></li>                            
            </ul><br />
            <ul class="archive_tag">
                <li class="port_item">Themes:&nbsp;</li>
                <li><?php echo get_the_term_list( $post->ID, 'theme', '',', ', '');?></li>                              
            </ul>
        </div>
        </div><br />
        </div>
 		<div class="row offset-by-one six padding_LR">
        <hr />
        <br />
        <div class="row six">
            <h4 class="six">Similar Projects</h4>
			<?php
			$current_themes = get_the_terms($post->id, 'theme'); //Level
			if ( !empty( $current_themes ) ) :
				shuffle($current_themes);
				$theme = current($current_themes);
				$theme = $theme->slug;
			endif;
			
			$args = array(
				'post_type' => 'case_studies',
				'showposts' => 50,
				'posts_per_page' => 50,
				'offset' => 0,
				'orderby' => 'rand',
				'post__not_in'	=> array($post->ID),
				'theme' => $theme,
				
			);
			
			$count_posts = 0;
			$query = new WP_Query($args);
			//query_posts('post_type=case_studies&theme='.$theme.'&showposts=3&offset=0&orderby=rand'); 
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
			
			<?php
				//Image
				$img ='';
				if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'cs-image-small', $post->ID) ) :
					$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'cs-image-small', $post->ID, 'image_152x72',  array('class'=>'similar_projects'));
					
					$count_posts++;
				endif;
				
				//Client
				$clients = get_the_terms($post->id, 'clients');
				if ( !empty( $clients ) ) :
					foreach ($clients as $client) {
						$client = $client->name;
						break;
					}
				endif;
				
			if($count_posts <= 5 AND $img):	
			?>
			
            <div class="left ">
				<a href="<?php the_permalink();?>">
				<?php echo $img; /*<img style="margin-right:10px" src="<?php bloginfo('template_directory'); ?>/images/mini_thumbs_03.jpg">*/ ?>
                <h6 class="port_header_mini"><?php echo $client;?></a> <span class="pipe">&#124;</span> <a href="<?php the_permalink();?>"><?php the_title(); ?></h6></a>
				
            </div>
			<?php endif; ?>
			<?php endwhile; endif; wp_reset_query();?>
        </div>
        <br />
        
        </div>
        
        <?php //edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</div>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>