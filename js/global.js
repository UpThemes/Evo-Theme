(function($){

	masonry_options = {
		animate: true,
		singleMode: true,
		itemSelector: '.hentry'
	};

	showImages = function(_this){

		$('.list').removeClass('loading');

		$(_this).find('img').animate({
			opacity : '1.0'
		},800);

		$('h2').find('img').animate({
			opacity : '1.0'
		},800);

	}

	$(document).ready(function(e){

    $('img[data-retina]').retina({ checkIfImageExists: true });

		$firstList = $('.list:first');

		$('.items').masonry({
			animate: true
		});

		if( $firstList.find('img').length ){

			$firstList.addClass('loading');

			$firstList.find('img')
			.css({
				opacity : '0' 
			});

			$firstList.find('.items').masonry(masonry_options, function(){

				$(this).onImagesLoad({
					selectorCallback : showImages
				});

			});

			$('#more').find('a').live('click',function(e){

				e.preventDefault();

				$lastList = $('.list:last');

				$lastList.addClass('loading');

				href = $(this).attr('href');

				$(this).parents("#more").remove();

				$lastList.load(href+ " .list > *", function(){

					$(this).find('img').css({
						opacity : '0' 
					});

					$(this).find('.items').masonry(masonry_options,function(){

            if( $(this).find('img').length == 0 ){
              $lastList.removeClass('loading');
          		$.scrollTo($(this).parents('div.list'), 400);
            }

						$(this).onImagesLoad(function(e){
							$(this).find('img').retina();

						});

						$(this).find('img').animate({
							opacity : '1.0'
						},800);

						$('.list').removeClass('loading');

						$.scrollTo($(this).parents('div.list'), 400);

						$('#content').append('<div class="list"></div>');

					});			

				});

			});

		}

	});

})(jQuery);