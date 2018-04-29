/* FRANKIE & ROKKO copyright 2017 */
//The background position of .large will be changed according to the position
//of the mouse over the .small image. So we will get the ratio of the pixel
//under the mouse pointer with respect to the image and use that to position the
//large image inside the magnifying glass

//Now the glass moves with the mouse
//The logic is to deduct half of the glass's width and height from the
//mouse coordinates to place it with its center at the mouse coordinates

(function ($) {
  $.fn.frokstar = function (options) {

    var defaults = {
      lensSize: 100,
      borderSize: 4,
      borderColor: "#888",
      img: ''
    };

    var options = $.extend(defaults, options);

    return this.each(function () {

      var native_width = 0;
      var native_height = 0;
      var enabled = false;
      var mobile_w = 1200;
      var mobile_screen = 700;

      obj = $(this);

      obj.css({
        'cursor': 'zoom-in',
        '-webkit-user-select': 'none',
        '-moz-user-select': 'none',
        '-ms-user-select': 'none',
        'user-select': 'none',
      });
      obj.addClass('small');
      obj.wrap('<div class="magnify" style="position:relative;"></div>');
      obj.parent().append('<div class="large" style="display: none"></div>');
      obj.parent().find('.large').css({
        "background-image": "url("+String(options.img)+")",
        'width': '450px',
        'height': '450px',
        'position': 'absolute',
      	'border-radius': '100%',
        'cursor': 'zoom-out',
        'box-shadow': '0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25)',
        'z-index': '10',
        // 'background-size': '2000px',
      });

      if($(window).width() < mobile_screen){
        obj.parent().find('.large').css({
          'box-shadow': 'none',
          'border-radius': '0',
          'width': '1000px',
          'height': '1000px',
          'background-size': mobile_w+'px',
          // 'background-repeat': 'no-repeat'
        });
      }

      obj.parent().click(function(e){
        enabled = !enabled;
        if(!enabled){
          $(this).find('.large').fadeOut(100);
          obj.css({
            'cursor': 'zoom-in'
          });
        }else{
          $(this).find('.large').fadeIn(100);
          obj.css({
            'cursor': 'zoom-out'
          });
        }
        if(!enabled){
          return 0;
        }
        if(!native_width && !native_height){
          var image_object = new Image();
          image_object.src = obj.attr("src");
          native_width = image_object.width;
          native_height = image_object.height;
        }else{
          var magnify_offset = $(this).offset();
          var mx = e.pageX - magnify_offset.left;
          var my = e.pageY - magnify_offset.top;
          if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
          {
            if(enabled){
              $(this).find('.large').fadeIn(100);
            }
          }
          else
          {
            $(this).find('.large').fadeOut(100);
          }
          if($(this).find('.large').is(":visible"))
          {
            var base_img_w = $(".small", this).width();
            var base_img_h = $(".small", this).height();
            var large_img_w = $(".large", this).width();
            var large_img_h = $(".large", this).height();
            var base_img_left = $(".small", this).offset().left;

            if($(window).width() < mobile_screen){
              native_height = (native_height * mobile_w)/native_width
              native_width = mobile_w;
            }

            var rx = Math.round((mx/base_img_w*native_width)+(magnify_offset.left*2) - large_img_w/2)*-1 + (base_img_left*2);
            var ry = Math.round(my/base_img_h*native_height - large_img_h/2)*-1;
            var bgp = rx + "px " + ry + "px";

            var px = mx - large_img_w/2;
            var py = my - large_img_h/2;

            $(".large", this).css({left: px, top: py, backgroundPosition: bgp});
          }
        }
      });

      $(obj).parent().mousemove(function(e){

        if(!native_width && !native_height){

          var image_object = new Image();
          image_object.src = obj.attr("src");

          native_width = image_object.width;
          native_height = image_object.height;
        }else{

          var magnify_offset = $(this).offset();
          var mx = e.pageX - magnify_offset.left;
          var my = e.pageY - magnify_offset.top;

          if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
          {
            if(enabled){
              $(this).find('.large').fadeIn(100);
            }
          }
          else
          {
            $(this).find('.large').fadeOut(100);
          }
          if($(this).find('.large').is(":visible"))
          {
            var base_img_w = $(".small", this).width();
            var base_img_h = $(".small", this).height();
            var large_img_w = $(".large", this).width();
            var large_img_h = $(".large", this).height();
            var base_img_left = $(".small", this).offset().left;

            var rx = Math.round((mx/base_img_w*native_width)+(magnify_offset.left*2) - large_img_w/2)*-1 + (base_img_left*2);
            var ry = Math.round(my/base_img_h*native_height - large_img_h/2)*-1;
            var bgp = rx + "px " + ry + "px";

            var px = mx - large_img_w/2;
            var py = my - large_img_h/2;

            $(".large", this).css({left: px, top: py, backgroundPosition: bgp});

            // console.log(
            //   "mx*2:"+(mx*2)
            //   +" \nmy*2:"+(my*2)
            //   +" \n\nmx/base_img_w*native_width:"+((mx/base_img_w*native_width)+(magnify_offset.left*2))
            //   +" \nmy/base_img_h*native_height:"+(my/base_img_h*native_height)
            //   +" \n\nmagnify.left:"+magnify_offset.left
            //   +" \nmagnify.top:"+magnify_offset.top
            //   +" \n\nbase_img_w:"+base_img_w
            //   +" \nbase_img_h:"+base_img_h
            //   +" \n\nnative_width:"+native_width
            //   +" \nnative_height:"+native_height
            //   +" \n\nlarge_img_w: "+large_img_w
            //   +" \nlarge_img_h: "+large_img_h
            //   +" \nfunz:"+((mx/base_img_w)*native_width - large_img_w/2) // original function y (my/base_img_h*native_height - large_img_h/2)
            //   +" \nfunz2:"+(mx/base_img_w*2000)
            //   +" \nbase_img_left:"+(base_img_left)
            // );
          }
        }
      })

      obj.parent().on('touchmove', function (e) {
        if(!enabled){
          return 0;
        }
        e.preventDefault();

        if(!native_width && !native_height){

          var image_object = new Image();
          image_object.src = obj.attr("src");

          native_width = image_object.width;
          native_height = image_object.height;
        }else{

          var magnify_offset = $(this).offset();
          var mx = e.originalEvent.touches[0].pageX - magnify_offset.left;
          var my = e.originalEvent.touches[0].pageY - magnify_offset.top;

          if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
          {
            if(enabled){
              $(this).find('.large').fadeIn(100);
            }
          }
          else
          {
            $(this).find('.large').fadeOut(100);
          }
          if($(this).find('.large').is(":visible"))
          {
            var base_img_w = $(".small", this).width();
            var base_img_h = $(".small", this).height();
            var large_img_w = $(".large", this).width();
            var large_img_h = $(".large", this).height();
            var base_img_left = $(".small", this).offset().left;

            if($(window).width() < mobile_screen){
              native_height = (native_height * mobile_w)/native_width
              native_width = mobile_w;
            }

            var rx = Math.round((mx/base_img_w*native_width)+(magnify_offset.left*2) - large_img_w/2)*-1 + (base_img_left*2);
            var ry = Math.round(my/base_img_h*native_height - large_img_h/2)*-1;
            var bgp = rx + "px " + ry + "px";

            var px = mx - large_img_w/2;
            var py = my - large_img_h/2;

            $(".large", this).css({left: px, top: py, backgroundPosition: bgp});
          }
        }
      });

    });
  };
})(jQuery);
