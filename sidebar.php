<?php 

global $up_options;

if((is_page() || is_search()) || ($up_options->showsidebar && (is_search() || is_page() || is_category() || is_archive || is_home() || is_front_page() || is_tag()))):

?>

<?php if (is_sidebar_active('primary-aside')) { ?>
	<div id="primary" class="aside main-aside">
		<ul class="xoxo">
	<?php dynamic_sidebar('primary-aside'); ?>
		</ul>
	</div><!-- #primary .aside -->
<?php } ?>

<?php endif; ?>