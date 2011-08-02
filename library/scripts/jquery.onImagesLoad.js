/*
 * jQuery 'onImagesLoaded' plugin v1.1.1 (Updated January 27, 2010)
 * Fires callback functions when images have loaded within a particular selector.
 *
 * Copyright (c) Cirkuit Networks, Inc. (http://www.cirkuit.net), 2008-2010.
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * For documentation and usage, visit "http://includes.cirkuit.net/includes/js/jquery/plugins/onImagesLoad/1.1.1/documentation/"
 */
(function($){
    $.fn.onImagesLoad = function(options){
        var self = this;
        self.opts = $.extend({}, $.fn.onImagesLoad.defaults, options);

        self.bindEvents = function($imgs, container, callback){
            if ($imgs.length === 0){ //no images were in selection. callback based on options
                if (self.opts.callbackIfNoImagesExist && callback){ callback(container); }
            }
            else {
                var loadedImages = [];
                if (!$imgs.jquery){ $imgs = $($imgs); }
                $imgs.each(function(i){
                    //webkit fix inspiration thanks to bmsterling: http://plugins.jquery.com/node/10312
                    var orgSrc = this.src;
                    if (!$.browser.msie) {
                        this.src = ""; //ie will do funky things if this is here (show the image as an X, only show half of the image, etc)
                    }
                    $(this).bind('load', function(){
                        if (jQuery.inArray(i, loadedImages) < 0){ //don't double count images
                            loadedImages.push(i); //keep a record of images we've seen
                            if (loadedImages.length == $imgs.length){
                                if (callback){ callback.call(container, container); }
                            }
                        }
                    });
                    if (!$.browser.msie) {
                        this.src = orgSrc; //needed for potential cached images
                    }
                    else if (this.complete || this.complete === undefined){ this.src = orgSrc; }
                });
            }
        };

        var imgAry = []; //only used if self.opts.selectorCallback exists
        self.each(function(){
            if (self.opts.itemCallback){
                var $imgs;
                if (this.tagName == "IMG"){ $imgs = this; } //is an image
                else { $imgs = $('img', this); } //contains image(s)
                self.bindEvents($imgs, this, self.opts.itemCallback);
            }
            if (self.opts.selectorCallback){
                if (this.tagName == "IMG"){ imgAry.push(this); } //is an image
                else { //contains image(s)
                    $('img', this).each(function(){ imgAry.push(this); });
                }
            }
        });
        if (self.opts.selectorCallback){ self.bindEvents(imgAry, this, self.opts.selectorCallback); }

        return self.each(function(){}); //dont break the chain
    };

    //DEFAULT OPTOINS
    $.fn.onImagesLoad.defaults = {
        selectorCallback: null,        //the function to invoke when all images that $(yourSelector) encapsultaes have loaded (invoked only once per selector. see documentation)
        itemCallback: null,            //the function to invoke when each item that $(yourSelector) encapsultaes has loaded (invoked one or more times depending on selector. see documentation)
        callbackIfNoImagesExist: false //if true, the callbacks will be invoked even if no images exist within $(yourSelector).
                                       //if false, the callbacks will not be invoked if no images exist within $(yourSelector).
    };
})(jQuery);