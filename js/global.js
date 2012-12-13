(function($){

	masonry_options = {
		columWidth : 232,
		gutterWidth : 20,
		isFitWidth: true,
    isAnimated: true,
		isAnimatedFromBottom: true,
		itemSelector: '.hentry'
	};

	$(document).ready(function(e){

    $container = $("#masonry");

    new View( $("a[href$='.jpg'],a[href$='.png'],a[href$='.jpeg'],a[href$='.gif']") );

    $(".hentry").fitVids(); // Resize videos to be responsive

    // Add padding to the top of the page
    header_height = $('#header').height();
    $('body').css('padding-top',header_height+40);

    $(".flexslider").flexslider({
      controlNav: false,
      smoothHeight: true,
      animationSpeed: 200,
      prevText: "<i class='icon-left-open'></i>",
      nextText: "<i class='icon-right-open'></i>",
      after : function(){
        $("#masonry").masonry( 'reload' );
      }
    });

    $("#content").fitVids();

    $('img[data-retina]').retina({ checkIfImageExists: true });

    $container.imagesLoaded(function(){
      if( !$('.no-results').length )
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
      $newElems.fitVids();
      // ensure that images load before adding to masonry layout
      $newElems.imagesLoaded(function(){
        // show elems now they're ready
        $newElems.animate({ opacity: 1 });
        $container.masonry( 'appended', $newElems, true ); 
      });
    });

    /* HiDPI Gravatar Loader © 2012 by Robert Chapin, license: GPL */
    if (window.devicePixelRatio > 1.4) {
     avatars = document.getElementsByClassName('avatar');
     for (var i = 0; i < avatars.length; i++) {
      if (avatars[i].tagName != 'IMG') continue;
      lodpi = avatars[i].src;
      if (lodpi.indexOf('.gravatar.com') < 1) continue;
      temp = lodpi.indexOf('&s=');
      if (temp < 9) temp = lodpi.indexOf('?s=');
      if (temp < 9) continue;
      temp += 3;
      size = parseInt(lodpi.substr(temp));
      hidpi = lodpi.substr(0, temp) + size * 2 + lodpi.substr(temp + String(size).length);
      temp = hidpi.indexOf('%3Fs%3D');
      if (temp < 9) temp = hidpi.indexOf('%26s%3D');
      if (temp > 9) {
       temp += 7;
       size = parseInt(hidpi.substr(temp));
       hidpi = hidpi.substr(0, temp) + size * 2 + hidpi.substr(temp + String(size).length);
      }
      avatars[i].src = hidpi;
     }
     document.cookie = 'miqro_hidpi=yes';
    }

	});
})(jQuery);