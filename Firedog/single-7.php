<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="row one-and-half left">
        <div class="trans padding_TRBL top_right_rounded">
            <h4 class="caption">Our thinking</h4>
        </div>
        <div class="trans_dark padding_TRBL bot_right_rounded">
            <p class="caption">With what he charity was geared to achieve, we designed a clean and chrisp identity, designed to be highly memorable and adaptable.</p>
        </div>
        <div class="thumbs left">
            <div class="white_thumb rounded"></div>
            <div class="white_thumb rounded"></div>
            <div class="white_thumb rounded"></div>
            <div class="white_thumb rounded"></div>
            <div class="red_thumb rounded"></div>
            <div class="white_thumb rounded"></div>
            <div class="white_thumb rounded"></div>
        </div>
    </div>
	<div class="row padding_full right left_rounded" style="background-color:black; position:relative">
		<div class="buttons">
            <img src="<?php bloginfo('template_directory'); ?>/images/menu.png"><br />
            <a href="<?php echo home_url( '/' ); ?>?page_id=7"><img src="<?php bloginfo('template_directory'); ?>/images/results.png"></a>
		</div>
        <h1 class="port_header"><?php the_title(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;Brand Identity and Communications</h1>
        <div class="row one">
            <h4>Tag Info</h4>
            <ul class="port_tag">
                <li class="port_item">Discipline:</li>
                <li>Brand Identity</li>                                
            </ul>
            <ul class="port_tag">
                <li class="port_item">Sector:</li>
                <li>Financial</li>                                
            </ul>
            <ul class="port_tag">
                <li class="port_item">Themes:</li>
                <li>Conservative, Corporate, African, Private Equity</li>                               
            </ul>
            <div class="pdf_top">
            <p>Download a PDF case study to take away for later</p>
            <div class="pdf_bottom"></div>
            </div>
        </div>
        <?php
        if ( function_exists( 'the_content_part' ) && has_content_parts() ) {
            the_content_part( 1, '<div class="row two">', '</div>' );
            the_content_part( 2, '<div class="row two">', '</div>' );
        } else {
            the_content();
        }
        ?>
        <div class="row one">
            <h4>Similar Projects</h4>
            <img src="<?php bloginfo('template_directory'); ?>/images/mini_thumbs_03.jpg">
            <h5 class="port_header_mini">Client &nbsp;&nbsp;|&nbsp;&nbsp;Project</h5>
            <img src="<?php bloginfo('template_directory'); ?>/images/mini_thumbs_06.jpg">
            <h5 class="port_header_mini">Client &nbsp;&nbsp;|&nbsp;&nbsp;Project</h5>
            <img src="<?php bloginfo('template_directory'); ?>/images/mini_thumbs_08.jpg">
            <h5 class="port_header_mini">Client &nbsp;&nbsp;|&nbsp;&nbsp;Project</h5>
        </div>
        <br />
        <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</div>
<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>