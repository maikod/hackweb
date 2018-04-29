<?php
@session_start();

if(!isset($_COOKIE['pp_id'])){
    require_once('../include/payment_hack.php');
    return;
}

if(isset($_SESSION['pp_id'])){
    $message = 'Hi!
    <br>
    Thank you for your payment.<br>        
    Your transaction has been completed, and a receipt for your purchase has been emailed to you. 
    <br>You may log into your account at <a href="www.paypal.com" target="_blank" style="color:#007bff;">www.paypal.com</a> to view details of this transaction.
    <br>
    <br>
    In a few seconds the digital product that you have purchased will appear below (don\'t close the page):';
}else{
    $message = 'Hi!<br>
    In a few seconds the digital product that you have purchased will appear below (don\'t close the page):';
}
?>

<div id="hw-presets" class="spazio">
    <div class="inner">

        <div class="payment-message" style="margin: 0 20%;">
            <?php echo $message; ?>
        </div>

        <div class="payment-information" style="display:none; margin:50px auto; max-width:500px; overflow-wrap: break-word; padding:20px; border-radius: 8px; background-color:#f5f5f5;">
        </div>

        <div style="display:none;">
            <form id="pp-payment" method=post action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                <input type="hidden" name="cmd" value="_notify-synch">
                <input type="hidden" name="tx" value="">
                <input type="hidden" name="url" value="https://www.sandbox.paypal.com/cgi-bin/webscr">
                <input type="hidden" name="at" value="">
                <input type="hidden" name="pp_id" value="">
                <input type="submit" value="PDT">
            </form>

            <form id="invisible_form" action="libs/download_file.php" method="post" target="_blank">
                <input name="data" type="hidden" value="">
            </form>            
        </div>
        

    </div>
</div>

<script>
var query = window.location.search;
var tx = query.split('tx=')[1];
$('input[name=tx]').val(tx);
$('input[name=pp_id]').val(getCookie('pp_id'));
var send_data = { action: "pp-pdt", data: objectifyForm($("#pp-payment").serializeArray()) };
$.ajax({
    type: "POST",
    url: "libs/call_curl.php",
    data: JSON.stringify(send_data),
    contentType: "application/json",
    async: true,
    success : function(data)
    {                
        console.log(data);
        var item = getCookie('pp');
        var pp_id = getCookie('pp_id');
        var pp_name = getCookie('pp_name');
        var pp_image = getCookie('pp_image');
        data = JSON.parse(data);      
        
        if(data.purchase_auth != null){
            $('.payment-information').html('<img src="'+pp_image+'" class="presets-img"><br>'+pp_name+'<br>')
            .append('<button id="pp-download" type="button" class="btn btn-primary btn-sm" ppid="'+pp_id+'" item="'+item+'" val="'+data.purchase_auth+'" style="margin-top:8px;">Download</button>').fadeIn('fast');
        }else{
            $('.payment-message').fadeOut('fast', function(){
                $(this).html('Hi!'+
                '<br>'+
                'It\'s seems that you didn\'t pay this object.'+
                '<br>If you have paid contact us at <a href="mailto:payments@brahmino.com" target="_blank" style="color:#007bff;">payments@brahmino.com</a> to retrive your download.'+
                '<br>'+
                '<br>').fadeIn('fast');                
            });            
        }        

        $('.payment-message').fadeIn('fast');
    }
});

$('body').on('click', '#pp-download', function(){
    var send_data = { 
        action: "downloadPreset", 
        data: {
            id: $(this).attr('ppid'),
            article: $(this).attr('item'),
            auth_code: $(this).attr('val')
        } 
    };       

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {                
        $('input[name="data"]').val(JSON.stringify(send_data));    
        $('#invisible_form').submit();
    }else{
        var xhr = new XMLHttpRequest();    
        xhr.open('POST', 'libs/call_func.php', true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.responseType = 'blob';    
        xhr.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){                                                 
                var blob = this.response;    

                if(blob.type == 'text/html'){
                    alert('You have no access on this file.');
                    return;
                }
                
                saveAs(blob, 'brahmino-file.zip');

                //old version

                // if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {                
                //     blobUrl = window.URL.createObjectURL(new Blob([blob], {type: blob.type}));                 
                //     window.open(blobUrl);                
                // }else{
                //     if ("download" in a) {
                //         var blobUrl = window.URL.createObjectURL(new Blob([blob], {type: blob.type})); 
                //         var a = document.createElement("a"); 
                //         document.body.appendChild(a);
                //         a.style = "display: none";
                //         a.href = blobUrl;
                //         a.download = 'brahmino-file.zip';
                //         a.click();   
                //     } else {                            
                //         console.log('browser: ie');
                //         var blobFile = new Blob([blob], {type: blob.type});                
                //         window.navigator.msSaveBlob(blobFile , 'brahmino-file.zip');
                //     } 
                // }   
                        
            }
        }        
        xhr.send(JSON.stringify(send_data));


        //jquery method, doesn't work on <= IE11

        // $.ajax({
        //     type: "POST",
        //     url: "libs/call_func.php",
        //     data: JSON.stringify(send_data),
        //     contentType: "application/json",        
        //     async: true,
        //     cache:false,
        //     xhr:function(){
        //         var xhr = new XMLHttpRequest();
        //         xhr.responseType = 'blob';                                    
        //         return xhr;
        //     },
        //     success : function(data)
        //     {                        
        //         var blob = data;                               
        //         var a = document.createElement("a");            
        //         var blobUrl = window.URL.createObjectURL(new Blob([blob], {type: blob.type}));
        //         document.body.appendChild(a);
        //         a.style = "display: none";
        //         a.href = blobUrl;
        //         a.download = 'brahmino-file.zip';
        //         a.click();
        //     },
        //     error: function(e) {
        //         console.log('Error: ' + JSON.stringify(e));
        //     }
        // });
    }

});

</script>