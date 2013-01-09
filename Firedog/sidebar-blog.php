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
	<ul class="sub_nav">
    	<li class="section"><a href="<?php echo home_url( '/thinking-space' ); ?>">Thinking Space</a></li>
        <!--<hr />-->
        <?php wp_list_cats('orderby=name&title_li=&child_of=122'); ?>
	</ul>
	<br>
	<br>
	<ul class="sub_nav authors-list">
    	<li class="section">The Authors</li>
<!--        <hr />
-->        <?php wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
	</ul>
</div>