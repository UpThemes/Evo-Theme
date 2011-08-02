<?php


// Located in footer.php
// Just before the footer div
function evo_abovefooter() {
    do_action('evo_abovefooter');
} // end evo_abovefooter


// located in footer.php
// the footer text can now be filtered and controlled from your own functions.php
function evo_footertext($thm_footertext) {
    $thm_footertext = apply_filters('evo_footertext', $thm_footertext);
    return $thm_footertext;
} // end evo_footertext


// Located in footer.php
// Just after the footer div
function evo_belowfooter() {
    do_action('evo_belowfooter');
} // end evo_belowfooter


// Located in footer.php 
// Just before the closing body tag, after everything else.
function evo_after() {
    do_action('evo_after');
} // end evo_after