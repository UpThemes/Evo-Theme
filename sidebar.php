<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.4
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
		<div id="primary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-primary' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>