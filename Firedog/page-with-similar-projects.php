<?php
/**
 * Template Name: Page with similar projects
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="column-row offset-by-one padding_LR">
    	<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
		<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
	</div>
	<br class="clear" />
	<div class="row offset-by-one six padding_LR">
        <hr />
        <br />
        <div class="row six">
            <h4 class="six">Example Projects</h4>
			<?php
			$projects_nr = 5;
			$disciplines = explode('|',get_post_meta($post->ID, 'similar_projects_discipline', true));
			
			/**
			Strategy&Planning = Strategy
			Brand Creation = Brand (Integrated Branding + Digital Branding)
			Digital Branding = Digital branding
			Digital Media = Digital (Interface design + websites)
			Motion/Animation = animation
			Design for Print = design for print
			Campaigns = campaigns
			**/
			
			$args = array(
				'post_type' => 'case_studies',
				'showposts' => $projects_nr,
				'posts_per_page' => $projects_nr,
				'offset' => 0,
				'orderby' => 'rand',
				//'post__not_in'	=> array($post->ID),
				//'theme' => $theme
				'tax_query' => array(
					array(
						'taxonomy' => 'cs_type',
						'field' => 'slug',
						'terms' => array('level_1'),
					),
					array(
						'taxonomy' => 'discipline',
						'field' => 'slug',
						'terms' => $disciplines,
						'operator' => 'IN'
					)
				)
			);
			$query = new WP_Query($args);
			$level_1_total = $query->post_count;
			//query_posts('post_type=case_studies&theme='.$theme.'&showposts=3&offset=0&orderby=rand'); 
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
			
			<?php
				//Image
				$img ='';
				if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'cs-image-small', $post->ID) ) :
					$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'cs-image-small', $post->ID, 'image_152x72',  array('class'=>'similar_projects'));
				endif;
				
				//Client
				$clients = get_the_terms($post->id, 'clients');
				if ( !empty( $clients ) ) :
					foreach ($clients as $client) {
						$client = $client->name;
						break;
					}
				endif;
			?>
			
            <div class="left ">
				<a href="<?php the_permalink();?>">
				<?php echo $img ;?>
                    <h6 class="port_header_mini"><?php echo $client;?></a> <span class="pipe">&#124;</span> <a href="<?php the_permalink();?>"><?php the_title(); ?></h6></a>
				
            </div>
			<?php endwhile; endif; wp_reset_query();?>
			
			<?php
			//Show level2 similar cases studies
			if($level_1_total < $projects_nr){
				$missing = $projects_nr - $level_1_total;
				$args = array(
				'post_type' => 'case_studies',
				'showposts' => $missing,
				'posts_per_page' => $missing,
				'offset' => 0,
				'orderby' => 'rand',
				//'post__not_in'	=> array($post->ID),
				//'theme' => $theme
				'tax_query' => array(
						array(
							'taxonomy' => 'cs_type',
							'field' => 'slug',
							'terms' => array('level_2'),
					   ),
					   array(
							'taxonomy' => 'discipline',
							'field' => 'slug',
							'terms' => $disciplines,
							'operator' => 'IN'
					   )
					)
				);
				
				$query = new WP_Query($args);
				//query_posts('post_type=case_studies&theme='.$theme.'&showposts=3&offset=0&orderby=rand'); 
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
			
					//Image
					$img ='';
					if ( MultiPostThumbnails::has_post_thumbnail('case_studies', 'cs-image-small', $post->ID) ) :
						$img = MultiPostThumbnails::get_the_post_thumbnail('case_studies', 'cs-image-small', $post->ID, 'image_152x72',  array('class'=>'similar_projects'));
					endif;
					
					//Client
					$clients = get_the_terms($post->id, 'clients');
					if ( !empty( $clients ) ) :
						foreach ($clients as $client) {
							$client = $client->name;
							break;
						}
					endif;
					
				?>
				<div class="left ">
					<a href="<?php the_permalink();?>">
					<?php echo $img ;?></a>
                    <h6 class="port_header_mini"><a href="<?php the_permalink();?>"><?php echo $client;?></a> <span class="pipe">&#124;</span> <a href="<?php the_permalink();?>"><?php the_title(); ?></a></h6>
					</a>
				</div>
				<?php endwhile; endif; wp_reset_query();	
			}	
			?>
			
			
        </div>
        <br />
        
        </div>
<?php endwhile; ?>
<?php get_footer(); ?>