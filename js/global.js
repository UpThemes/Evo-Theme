(function($){

	masonry_options = {
		columWidth : 300,
		gutterWidth : 20,
		isFitWidth: true,
		isAnimatedFromBottom: true,
		itemSelector: '.hentry'
	};

	$(document).ready(function(e){

    $('img[data-retina]').retina({ checkIfImageExists: true });

    $container = $("#masonry");

    $container.imagesLoaded(function(){
      $container.masonry(masonry_options);
    });

    $container.infinitescroll({
      navSelector  : '#more',    // selector for the paged navigation 
      nextSelector : '#more a',  // selector for the NEXT link (to page 2)
      itemSelector : '.post',     // selector for all items you'll retrieve
		  loading : {
        finishedMsg: 'No more pages to load.',
        img: global.loading
      }
    },
    // trigger Masonry as a callback
    function( newElements ) {
      // hide new items while they are loading
      var $newElems = $( newElements ).css({ opacity: 0 });
      // ensure that images load before adding to masonry layout
      $newElems.imagesLoaded(function(){
        // show elems now they're ready
        $newElems.animate({ opacity: 1 });
        $container.masonry( 'appended', $newElems, true ); 
      });
    });
	});
})(jQuery);