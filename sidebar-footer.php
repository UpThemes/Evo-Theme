<?php
/**
 * The sidebar containing the footer widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.4
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>