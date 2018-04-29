//overview functions
//load masonry
var initOverview = function(){
    $(window).off('scroll');
    end = false;
    loading = false;
    origin = 0;    
    increment = 20;    
    player = new Array();
    $mason = null;
    $mason = loadMasonry();
    loadingInterval();
    // gridFirstLoad();
    // overviewScrollBinding();            
}

var loadMasonry = function(){
	var $grid = $('.inner-grid').masonry({
		itemSelector: '.cell',
		columnWidth: '.cell-sizer',
		percentPosition: true
    });    
    $grid.masonry('layout');    
	return $grid;
}

function onPlayerReady(event) {
    event.target.mute();    
    var el = event.target;
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {                            
        playLater(el);            
    }else{
        el.playVideo();
    }
}

var playLater = function(el){    
    $('.cell-sizer').off('click');
    $('.nav-logo').off('click');
    $('.cell-sizer').click(function(){                        
        // player.forEach( function (playerItem)
        // {                                                          
        //     playerItem.playVideo();                
        // });   
        el.playVideo();                
    });
    $('.cell-sizer').click();
    $('.nav-logo').click(function(){
        $('.cell-sizer').click();
    })    
}

function onPlayerStateChange(event) {
    if(event.data == YT.PlayerState.ENDED){
        // event.target.seekTo(0);
        // event.target.stopVideo();
    }
}

var stopVideos = function(num){
    $('.video-player').each(function(){
        i = $(this).attr("video_num");
        if(typeof player[i] != 'undefined' && i != num)
        {
            try{
                player[i].stopVideo();
            }
            catch(err){ }
        }            
    })
}

var addYTVideos = function(num){   
    if(!yt_ready) return;
    if(num == null) {
        stopVideos(num);
        return
    };
    if(typeof player[num] === "undefined"){   
        stopVideos(num);          
        var player_instance = new YT.Player('player-'+(num), {        
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });    
        player[num] = player_instance;                      
    }else{        
        stopVideos(num);
    }    
}

var checkImages = function(){    
    // getAllImagesDonePromise().then(function() {
    //     $mason.masonry('layout');        
    // });
    $('.inner-grid').imagesLoaded( function() {
        $mason.masonry('layout');
        loading = false;
    });
}

var setLinks = function(data){
    $items = $(data);    
    var deferred = $.Deferred();

    if($mason == null){
        $mason = $('.inner-grid').append($items)
		.imagesLoaded(function(){			
            $mason
            // .fadeIn('fast')
			.masonry({
                itemSelector: '.cell',
                columnWidth: '.cell-sizer',
                percentPosition: true
            });    			
            var cur_video = null;
            $($(".video-player", $items).get().reverse()).each(function(){
                // addYTVideos($(this).attr("video_num"));
                cur_video = $(this).attr("video_num");
            })
            addYTVideos(cur_video);   
            deferred.resolve();
		});		   
    }else{
        $mason.append( $items ).imagesLoaded(function(){
            $mason.masonry( 'appended', $items ).masonry('layout');
            var cur_video = null;
            $($(".video-player", $items).get().reverse()).each(function(){
                // addYTVideos($(this).attr("video_num"));
                cur_video = $(this).attr("video_num");
            })
            addYTVideos(cur_video);   
			deferred.resolve();
		});
    }

    // $mason.masonry('once', 'layoutComplete', checkImages);
    // $mason.append($items).masonry('appended', $items);      
    // $mason.imagesLoaded().progress( function() {
    //     $mason.masonry('layout');
    // });         

    // checkImages();              

    // window.setTimeout(function(){
        
    // },1000);    

    // $('.cell-wrapper').off('click');
    // $('.cell-wrapper').click(function(){        
    //     var $el = $(this);       
    //     console.log("gino"); 
    // });    

    return deferred.promise();
}

var gridFirstLoad = function(){
    $.ajax({ type: "POST",
        url: "libs/loadServer.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {
            setLinks(data);
        }
    });
}

var gridLazyLoad = function(){
    if(loading) return;
    loading = true;
    var detail_data = { origin: origin, increment: increment }
    var send_data = { action: "requestPosts", data: detail_data };
    $.ajax({ type: "POST",
        url: "libs/loadServer.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {                       
            if(data.length <= 3){
                end = true;
                stopInterval();
            }
            origin = origin + increment;
            setLinks(data).then(function(){
                loading = false;                
            });            
        }
    });
}

var stopInterval = function(){
    $('.grid-loading div').css('opacity','0');
    // $('.grid-loading').hide();
    window.clearInterval(loading_interval);
}

var loadingInterval = function(){
	//three dots loading
	loading_interval = window.setInterval(function(){            
        if(!loading) checkHeight();  
		if(end){
			$('.grid-loading div').css('opacity','0');
			// $('.grid-loading').hide();
			window.clearInterval(loading_interval);
			return;
		}
		if(dots < 3){
			$('.grid-loading div').append('.');
			dots++;
		}else{
			$('.grid-loading div').html('Loading');
			dots = 0;
		}
	}, 1000);
}

var checkHeight = function(){
    // console.log('top: ' + ( Math.floor( $(this).scrollTop() + $(window).height() ) ) );
    // console.log('grid height: ' + Math.floor( $('.inner-grid').innerHeight() ));
    // console.log('top of loading: ' + Math.floor( $('.grid-loading').offset().top ) );
    
    if( ( Math.floor( $(this).scrollTop() + $(window).height() ) ) >= Math.floor(  $('.grid-loading').offset().top ) ) {        
        gridLazyLoad();   
    }
}

var overviewScrollBinding = function(){
	$(window).on('scroll', function() {                  
        if(end){
            $(window).off('scroll');
            return;
        }        
        if(!loading) checkHeight();
	})
}

