
    

<div id="hw-presets" class="spazio">
    <div class="inner">
              
        <!-- caricare da server -->
        <!-- <div class="preset-">

            <form id="pp-purchase" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:none;">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                ">
                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>

            <img src="img/preset/preset-1.png">
            <br>Brahmino Preset 1<br>
            50,00 €<br>
            <button style="margin-top:8px;" type="button" class="btn btn-success btn-sm pp-purchase-btn" item="Brahmino Preset 1" val="preset-1">
                Buy Now
            </button>
        </div> -->

        <div class="presets">
            
        </div>

    </div>
</div>

<script>

var loadPresets = function(){
	if(loading) return;
	loading = true;
	var deferred = $.Deferred();    
    var detail_data = { origin: origin, increment: increment }
    var send_data = { action: "loadPresets", data: detail_data };
    $.ajax({ type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {                       
            if(data.length <= 3){
                end = true;                
            }
			origin = origin + increment;
            
            loading = false;
            deferred.resolve(data);
                        
        }
	});
	return deferred.promise();
}

loadPresets().then(function(data) {
    $('.presets').append(data);
    $('.presets-hr2:last').hide();    
    window.setTimeout(function(){
        $('.carousel-inner').css('height', $('.carousel-item:first').css('height'));        
    }, 1000);    
});

$('body').on('click', '.pp-purchase-btn', function(e){ //$('.pp-purchase-btn').click(function(e){ 
    var $btn = $(this);
    var btn_id = $(this).attr('id');
    var code = $(this).attr('val');
    createCookie('pp', code, 7);        
    createCookie('pp_name', $(this).attr('item'), 7);
    createCookie('pp_image', $('.presets-element .presets-img').attr('src'), 7);        

    $btn.prop('disabled', true);

    var send_data = { 
        action: "registerPurchase", 
        data: {
            article: code            
        } 
    };

    //inserire qui la parte di inserimento acquisto nel db         
    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {        
            data = JSON.parse(data);                  
            //ricavare il purchase id
            createCookie('pp_id', data.pp_id, 7);         
            
            $('#pp-purchase-'+btn_id).submit();
            
            // console.log($('.presets-element .presets-img').attr('src'));
        }
    }); 
        
});

</script>
