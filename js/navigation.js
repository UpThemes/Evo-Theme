jQuery(document).ready(function(){ 
    jQuery("ul.sf-menu").supersubs({ 
        minWidth:    6,                                // minimum width of sub-menus in em units 
        maxWidth:    14,                                // maximum width of sub-menus in em units 
        extraWidth:  1                                  // extra width can ensure lines don't sometimes turn over 
                                                        // due to slight rounding differences and font-family 
    }).superfish({ 
        delay:       400,                               // delay on mouseout 
        animation:   {opacity:'show',height:'show'},    // fade-in and slide-down animation 
        speed:       'fast',                            // faster animation speed 
        autoArrows:  true,                             // disable generation of arrow mark-up 
        dropShadows: true                              // disable drop shadows 
    }); 
});
