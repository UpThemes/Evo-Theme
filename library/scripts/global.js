(function($){

	masonry_options = {
		animate: true,
		singleMode: true,
		itemSelector: '.hentry'
	};
	
	showImages = function(_this){
		
		$('.list')
		.removeClass('loading');
		
		$(_this)
		.find('img')
		.animate({
			opacity : '1.0'
		},800);

		$('h2')
		.find('img')
		.animate({
			opacity : '1.0'
		},800);
		
		
	}
	
	showImagesAndScroll = function(_this){
		
		$('.list')
		.removeClass('loading');
		
		$(_this)
		.find('img')
		.animate({
			opacity : '1.0'
		},800);

		if( $('h2 img').length ){
			$('h2 img').show('fast');
		}
		
		$.scrollTo(_this.parents('div.list'), 400);
		
	}
						
	$(document).ready(function(e){

		$firstList = $('.list:first');
		
		$('.aside .xoxo')
		.masonry({
			animate: true
		});
				
		if( $firstList.find('img').length ){

			$firstList
			.addClass('loading');
	
			$firstList
			.find('img')
			.css({
				opacity : '0' 
			});
	
			$firstList
			.find('.items')
			.masonry(masonry_options, function(){
			
				$(this).onImagesLoad({
					selectorCallback : showImages
				});
			
			});
				
			$('#more a')
			.live('click',function(e){
			
				e.preventDefault();
				
				$lastList = $('.list:last');
				
				$lastList
				.addClass('loading');
				
				href = $(this).attr('href');
				
				$(this)
				.parents("#more")
				.remove();
				
				$lastList
				.load(href+ " .list > *", function(){
				
					$(this)
					.find('img')
					.css({
						opacity : '0' 
					});
				
					$(this)
					.find('.items')
					.masonry(masonry_options,function(){
						
						$(this).onImagesLoad({
							selectorCallback : showImagesAndScroll
						});
											
						$('#content')
						.append('<div class="list"></div>');
						
					});			
				
				});
			
			});
		
		}
		
	});

})(jQuery);