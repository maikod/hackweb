<section class=" mySlider">
        <div class="flexslider">
          <ul class="slides">
            <li data-thumb="js/FlexSlider/demo/images/kitchen_adventurer_cheesecake_brownie.jpg">
  	    	    <img src="js/FlexSlider/demo/images/kitchen_adventurer_cheesecake_brownie.jpg" />
  	    		</li>
  	    		<li data-thumb="js/FlexSlider/demo/images/kitchen_adventurer_lemon.jpg">
  	    	    <img src="js/FlexSlider/demo/images/kitchen_adventurer_lemon.jpg" />
  	    		</li>
  	    		<li data-thumb="js/FlexSlider/demo/images/kitchen_adventurer_donut.jpg">
  	    	    <img src="js/FlexSlider/demo/images/kitchen_adventurer_donut.jpg" />
  	    		</li>
  	    		<li data-thumb="js/FlexSlider/demo/images/kitchen_adventurer_caramel.jpg">
  	    	    <img src="js/FlexSlider/demo/images/kitchen_adventurer_caramel.jpg" />
  	    		</li>
          </ul>
        </div>
</section>

<!-- FlexSlider -->
<script type="text/javascript">

$(window).load(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});

</script>