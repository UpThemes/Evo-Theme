<?php


// Filter to create the sidebar
function evo_sidebar() {

  $show = TRUE;

	// Filters should return Boolean 
	$show = apply_filters('evo_sidebar', $show);
	
	if ($show) {
    get_sidebar();}
	
	return;
} // end evo_sidebar


// Main Aside Hooks


	// Located in sidebar.php 
	// Just before the main asides (commonly used as sidebars)
	function evo_abovemainasides() {
	    do_action('evo_abovemainasides');
	} // end evo_abovemainasides
	
	
	// Located in sidebar.php 
	// Between the main asides (commonly used as sidebars)
	function evo_betweenmainasides() {
	    do_action('evo_betweenmainasides');
	} // end evo_betweenmainasides
	
	
	// Located in sidebar.php 
	// after the main asides (commonly used as sidebars)
	function evo_belowmainasides() {
	    do_action('evo_belowmainasides');
	} // end evo_belowmainasides
	

// Index Aside Hooks

	
	// Located in sidebar-index-top.php
	function evo_aboveindextop() {
		do_action('evo_aboveindextop');
	} // end evo_aboveindextop
	
	
	// Located in sidebar-index-top.php
	function evo_belowindextop() {
		do_action('evo_belowindextop');
	} // end evo_belowindextop
	
	
	// Located in sidebar-index-insert.php
	function evo_aboveindexinsert() {
		do_action('evo_aboveindexinsert');
	} // end evo_aboveindexinsert
	
	
	// Located in sidebar-index-insert.php
	function evo_belowindexinsert() {
		do_action('evo_belowindexinsert');
	} // end evo_belowindexinsert	
	

	// Located in sidebar-index-bottom.php
	function evo_aboveindexbottom() {
		do_action('evo_aboveindexbottom');
	} // end evo_aboveindexbottom
	
	
	// Located in sidebar-index-bottom.php
	function evo_belowindexbottom() {
		do_action('evo_belowindexbottom');
	} // end evo_belowindexbottom	
	
	
// Single Post Asides


	// Located in sidebar-single-top.php
	function evo_abovesingletop() {
		do_action('evo_abovesingletop');
	} // end evo_abovesingletop
	
	
	// Located in sidebar-single-top.php
	function evo_belowsingletop() {
		do_action('evo_belowsingletop');
	} // end evo_belowsingletop
	
	
	// Located in sidebar-single-insert.php
	function evo_abovesingleinsert() {
		do_action('evo_abovesingleinsert');
	} // end evo_abovesingleinsert
	
	
	// Located in sidebar-single-insert.php
	function evo_belowsingleinsert() {
		do_action('evo_belowsingleinsert');
	} // end evo_belowsingleinsert	
	

	// Located in sidebar-single-bottom.php
	function evo_abovesinglebottom() {
		do_action('evo_abovesinglebottom');
	} // end evo_abovesinglebottom
	
	
	// Located in sidebar-single-bottom.php
	function evo_belowsinglebottom() {
		do_action('evo_belowsinglebottom');
	} // end evo_belowsinglebottom	
	


// Page Aside Hooks


	// Located in sidebar-page-top.php
	function evo_abovepagetop() {
		do_action('evo_abovepagetop');
	} // end evo_abovepagetop
	
	
	// Located in sidebar-page-top.php
	function evo_belowpagetop() {
		do_action('evo_belowpagetop');
	} // end evo_belowpagetop

	// Located in sidebar-page-bottom.php
	function evo_abovepagebottom() {
		do_action('evo_abovepagebottom');
	} // end evo_abovepagebottom
	
	
	// Located in sidebar-page-bottom.php
	function evo_belowpagebottom() {
		do_action('evo_belowpagebottom');
	} // end evo_belowpagebottom	



// Subsidiary Aside Hooks


	// Located in sidebar-subsidiary.php
	function evo_abovesubasides() {
		do_action('evo_abovesubasides');
	} // end evo_abovesubasides
	

	// Located in sidebar-subsidiary.php
	function evo_belowsubasides() {
		do_action('evo_belowsubasides');
	} // end evo_belowsubasides
	

	// Located in sidebar-subsidiary.php
	function evo_before_first_sub() {
		do_action('evo_before_first_sub');
	} // end evo_before_first_sub


	// Located in sidebar-subsidiary.php
	function evo_between_firstsecond_sub() {
		do_action('evo_between_firstsecond_sub');
	} // end evo_between_firstsecond_sub


	// Located in sidebar-subsidiary.php
	function evo_between_secondthird_sub() {
		do_action('evo_between_secondthird_sub');
	} // end evo_between_secondthird_sub
	
	
	// Located in sidebar-subsidiary.php
	function evo_after_third_sub() {
		do_action('evo_after_third_sub');
	} // end evo_after_third_sub	

