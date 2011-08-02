/* Copyright (c) 2008 Kean Loong Tan http://www.gimiti.com/kltan
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * jFlow
 * Version: 1.1 (May 22, 2008)
 * Requires: jQuery 1.2+
 */

//modified by LandRover 30th May 08

$ = jQuery;

(function($) {

	var global = {
		awesome : null	
	}

	$.fn.jFlow = function(options) {
		var opts = $.extend({}, $.fn.jFlow.defaults, options);
		var cur = 0;
		var timer;
		var selected_class = "jFlowSelected";
		var maxi = $(".jFlowControl").length;
		$(opts.slides+" img").each(function(i){
			var n = i+1;
			$("#myController").append("<span class='jFlowControl' id='click-"+n+"'>"+n+"</span>");
		});
		
		$(this).find(".jFlowControl").each(function(i){
		
			$(this).click(function(){
			
				dotimer();
				
				$(".jFlowControl").removeClass(selected_class);
				$(this).addClass(selected_class);
				//alert(cur);
				//alert(i);
				var dur = Math.abs(cur-i);
				cur = i;
				resizeWindow($(opts.slides).find("div").eq(cur));
				$(opts.slides).animate({
					marginLeft: "-" + (i * $(opts.slides).find(":first-child").width() + "px")
				}, opts.duration*(dur));
				
			});
			
		});
		
		$(opts.slides).before('<div id="jFlowSlide"></div>').appendTo("#jFlowSlide");

		//initialize the controller
		$(".jFlowControl").eq(cur).addClass(selected_class);

		var resizeWindow = function($selected){
		
			$selected = $selected || $(opts.slides).find(".jFlowSlideContainer:first");
		
			$el = $('#jFlowSlide,#mySlides');
					
			newHeight = $selected.find('img').height();
			oldHeight = $el.height();
			
			if(newHeight != oldHeight){
			
				$el.css({
					overflow : 'hidden',
					height : oldHeight
				});
				
				$el.animate({
					height : newHeight
				},180);
	
				$selected.animate({
					height : newHeight
				},180);
				
			}
		
		}

    	var href = $(opts.slides).find("div").eq(cur).find("a:first-child").attr('href');

		var resize = function(x){
						
			$("#jFlowSlide").css({
				position: "relative",
				width: opts.width,
				overflow: "hidden"
			});

			$(opts.slides).css({
				position:"relative",
				width: $("#jFlowSlide").width()*$(".jFlowControl").length+"px",
				overflow: "hidden"
			});

			$(opts.slides).children().css({
				position: "relative",
				width: $("#jFlowSlide").width()+"px",
				float :"left"
			});

			$(opts.slides).css({
				marginLeft: "-" + (cur * $(opts.slides).find(":first-child").width() + "px")
			});
		}
		
		$(document).ready(function(e){
			$('.jFlowSlide,#mySlides,jFlowSlideContainer').css( 'display', 'none' );
		});

		$(window).load(function(e){
			resize();
			$('.jFlowSlide,#mySlides,jFlowSlideContainer').css({
				height : $('#mySlides').find('img').eq(0).height()
			}).show('fast');
			resizeWindow();
		});

		$(window).resize(function(){
			resize();
		});

		$(".jFlowPrev").click(function(){
			dotimer();
			doprev();
      		return false;
		});

		var doprev = function (x){
			if (cur > 0)
				cur--;
			else
				cur = maxi -1;

			$(".jFlowControl").removeClass(selected_class);
			
			resizeWindow($(opts.slides).find("div").eq(cur));

			$(opts.slides).animate({
				marginLeft: "-" + (cur * $(opts.slides).find(":first-child").width() + "px")
			}, opts.duration);

      		var href = $(opts.slides).find("div").eq(cur).find("a:first-child").attr('href');
      
			$(".jFlowControl").eq(cur).addClass(selected_class);
	
		}

		$(".jFlowNext").click(function(){
			donext();
			dotimer();
      		return false;
		});

		var donext = function (x){
			if (cur < maxi - 1)
				cur++;
			else
				cur = 0;
			$(".jFlowControl").removeClass(selected_class);
			
			resizeWindow($(opts.slides).find("div").eq(cur));
			
			$(opts.slides).animate({
				marginLeft: "-" + (cur * $(opts.slides).find(":first-child").width() + "px")
			}, opts.duration);

     		var href = $(opts.slides).find("div").eq(cur).find("a:first-child").attr('href');

			$(".jFlowControl").eq(cur).addClass(selected_class);
						
		}

		var dotimer = function (x){
			if(timer != null) 
			    clearInterval(timer);
			    
        		timer = setInterval(function() {
	                	donext();
    	        	}, 9000);
    	        	
    	        }

		dotimer();
	};

	$.fn.jFlow.defaults = {
		easing: "swing",
		duration: 400,
		width: "100%"
	};

})(jQuery);