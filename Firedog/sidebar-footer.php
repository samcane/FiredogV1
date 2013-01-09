<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Firedog
 * @since Firedog 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : // This widget contains the contact details ?>
					<ul class="footer_widget row first"> 
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>
<div class="row two">
<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : // This widget contains the social media details ?>
					<ul class="footer_widget">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : // This widget contains the MailChmip details ?>
					<ul class="footer_widget">
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>
</div>
<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
					<ul class="footer_widget row">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>