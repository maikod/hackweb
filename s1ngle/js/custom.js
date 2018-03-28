/*
########################
{hw} framework by [frankie]
hackweb.it
v 1.0
2017
########################
*/

//variabili
var margine = 150;
var scrolling = false;
var start_scrolling = false;
var scroll_animation_duration = 1000;
var homepage_name = 'home';
var fade_duration = 200;
var yt_ready = false;
var player = new Array();
var loading_interval = null;
var frenkifeed_interval = null;
var initiated = [];
initiated['frenkifeed'] = false;
var $mason = null;
var $isot = null;
var increment = 20;
var loading = false;
var dots = 0;
var detail_data = { origin: 0 }
var send_data = { action: "requestPosts", data: detail_data };
var origin = 0;
var end = false;
var debug = false;
var $carousel = null;
//variabili admin
var upload_url = 'files/file_upload/UploadHandler.php';


//funzioni generiche
function parallax() {
	var scrollPosition=$(window).scrollTop();
	$('#backgr').css('top',(0 - (scrollPosition *.2)) +'px');
	//$('#immagini').css('top',(0 -(scrollPosition * .5)) + 'px');
}

//serialize data function
function objectifyForm(formArray) {
	var returnArray = {};
	for (var i = 0; i < formArray.length; i++){
	returnArray[formArray[i]['name']] = formArray[i]['value'];
	}
	return returnArray;
}

function activeMenu(){
	if (scrolling) return;
	var top = $(window).scrollTop();

	if (top >= 0){
		$('.nav-link').removeClass('active');
		$('.nav-link[href="#hw-'+homepage_name+'"]').addClass('active');
	}
	if (top >= $('#hw-stories').offset().top - margine){
		$('.nav-link').removeClass('active');
		$('.nav-link[href="#hw-stories"]').addClass('active');
	}
	if (top >= $('#hw-info').offset().top - margine){
		$('.nav-link').removeClass('active');
		$('.nav-link[href="#hw-info"]').addClass('active');
	}
	if (top >= $('#hw-press').offset().top - margine){
		$('.nav-link').removeClass('active');
		$('.nav-link[href="#hw-press"]').addClass('active');
	}

}

//getting GET variables
function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}

//primo caricamento
var firstLoad = function(){
	// andare alla sezione giusta
	var page_link = 'include/';
	$('.blog-footer').show();
	$('.pre-footer').removeClass('real_hide');
	$('.navbar').show();

	frenkifeedSize();

	if(sezione != ""){
		// $('.nav-link').each(function(){
		// 	$(this).removeClass('active')
		// })
		
		// scrolling = true;
		// $('html, body').stop().animate({
		// 	scrollTop: ($('#hw-'+sezione).offset().top - margine)
		// }, scroll_animation_duration, 'easeInOutExpo', function(){
		// 	scrolling = false;
		// });
	}else{
		// page_link += homepage_name+'.php';
		sezione = homepage_name;
	}	

	page_link += sezione+'.php';
	$('.nav-link').removeClass('active');
	$('.nav-link[href="#hw-'+sezione+'"]').addClass('active');

	$('#main_inner').load(page_link, null,function( response, status, xhr ) {
		return;
		$.ajax({ type: "GET",
			url: "include/stories.php",
			async: true,
			success : function(data)
			{
				$('#main_inner').append(data);
			}
		});
	});
}

//cambia pagina
var changePage = function (event){	
	var page_link = 'include/';

	event.preventDefault();
	event.stopImmediatePropagation();
	window.clearInterval(loading_interval);

	var $anchor = $(this);
	$('.nav-link').each(function(){
		if($(this)!=$anchor){
			$(this).removeClass('active')
		}
	})
	$anchor.addClass('active')
	// window.history.pushState(null, null, $anchor.attr('href'));

	var link = $anchor.attr('href').split('-');

	link = link[1];
	link = link.split('/');
	sezione = link[0];
	if(link[1] === undefined){
		link[1] = '';
	}
	sezione2 = link[1];
	window.history.pushState(null, null, lang+'/'+link[0]+'/'+link[1]);

	// sezione = link[1];
	// window.history.pushState(null, null, link[1]);

	$('#main_inner').fadeOut(fade_duration, function(){
		$('#main_inner').load(page_link+link[0]+'.php',null,function(){
			$('#main_inner').fadeIn(fade_duration);
			// if(link[1] == 'overview'){
				// loadMasonry();
			// };
		});
	});

	// scrolling = true;
	// $('html, body').stop().animate({
	// 	scrollTop: ($($anchor.attr('href')).offset().top - margine)
	// }, scroll_animation_duration, 'easeInOutExpo', function(){
	// 	scrolling = false;
	// });
}

//images loaded
function getAllImagesDonePromise() {
    var d = $.Deferred();
    var imgs = $("img");
    imgs.one("load.allimages error.allimages", function() {
		imgs = imgs.not(this);
        if (imgs.length <= 1) {
            d.resolve();
        }
    });
	var complete = imgs.filter(function() { return this.complete; });
    complete.off(".allimages");
    imgs = imgs.not(complete);
	complete = undefined;
    if (imgs.length <= 1) {
        d.resolve();
    }
    return d.promise();
}

var indexBinding = function(){
	//cambio pagina cliccando sui link
	$('.nav-link').unbind('click', changePage);
	$('.nav-link').bind('click', changePage);
}

//youtube settings
var ytInit = function(){
	//youtube settings
	tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

function onYouTubeIframeAPIReady() {
	yt_ready = true;
	firstLoad();
}

var changeHistoryStateOld = function(){
	var search = HOST + '/';
	var str = window.location.pathname;
	var last = str.substring(str.indexOf(search) + search.length, str.length);

	if(last.indexOf('/')>=0){
		var count = (last.match(/\//g) || []).length;
		var first = last.substring(0, last.indexOf('/'));
		var second = last.substring(last.indexOf(first) + first.length + 1, last.length);
		sezione2 = second;
	}else{
		first = last;
	}

	if(sezione == first){
		switch (sezione) {
			case "admin":
				adminFirstLoad();
				break;
		}
	}else{
		sezione = first;
		firstLoad();
	}
}

//history binding
var changeHistoryState = function(){
	var search = HOST + '/' + lang + '';
	var str = window.location.pathname;
	var last = str.substring(str.indexOf(search) + search.length + 1, str.length);

	if(last.indexOf('/')>=0){
		var count = (last.match(/\//g) || []).length;
		var first = last.substring(0, last.indexOf('/'));
		var second = last.substring(last.indexOf(first) + first.length + 1, last.length);
		sezione2 = second;
	}else{
		first = last;
	}

	if(sezione == first){
		switch (sezione) {
			case "admin":
				sezione2 = second;
				adminFirstLoad();
				break;
		}
	}else{
		console.log("second : " + second);
		sezione = first;
	}
	firstLoad();
}

var history_init = function(){
	window.onpopstate = function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		changeHistoryState();
	}

	window.onpushstate = function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		changeHistoryState();
	}
}

var generalBinding = function(){
	$('body').on('click', '#my-button', function () {

	});

	$( window ).resize(function() {
		frenkifeedSize();
	});
}

function generateRandom(min, max, ex1, ex2) {
	ex1 = typeof ex1 !== 'undefined' ? ex1 : 999;
	ex2 = typeof ex2 !== 'undefined' ? ex2 : 999;
    var num = Math.floor(Math.random() * (max - min + 1)) + min;
    return (num === ex1 || num === ex2) ? generateRandom(min, max, ex1, ex2) : num;
}

var frenkifeedSize = function(){	
	if(!initiated['frenkifeed']) return;
	
	getAllImagesDonePromise().then(function() {
		$('.frenkifeed a div img').css('height', 'auto');		
		$('.frenkifeed a div').css('height', $('.frenkifeed a div img').eq(1)[0].height+'px');
		$('.frenkifeed a div img').css('height', $('.frenkifeed a div img').eq(1)[0].height+'px');		
	});
	
	window.clearInterval(frenkifeed_interval);
	$('.frenkifeed a div').show();
	var sliceval = ($(window).outerWidth() <= 700) ? 12 : 20;
	$('.frenkifeed a div').slice(sliceval).hide();
	var rem = $('.frenkifeed a div:visible').length-1 ;
	var rem2 = 	$('.frenkifeed a div:hidden').length-1 ;
	
	frenkifeed_interval = window.setInterval(function(){

		var random = generateRandom(0,rem);
		var random2 = generateRandom(0,rem2);

		$('.frenkifeed a div:hidden').eq(random2).children().eq(0).appendTo($('.frenkifeed a div:visible').eq(random));
		$('.frenkifeed a div:visible').eq(random).children().eq(0).addClass("hide_b");
		$('.frenkifeed a div:visible').eq(random).children().eq(1).addClass("hide");
		window.setTimeout(function(){
			$('.frenkifeed a div:visible').eq(random).children().eq(0).appendTo( $('.frenkifeed a div:hidden').eq(random2) ).removeClass('hide_b');
			$('.frenkifeed a div:visible').eq(random).children().eq(0).removeClass("hide");		
		},800);		

		var random_b = generateRandom(0,rem,random);
		var random2_b = generateRandom(0,rem2,random2);

		$('.frenkifeed a div:hidden').eq(random2_b).children().eq(0).appendTo($('.frenkifeed a div:visible').eq(random_b));
		$('.frenkifeed a div:visible').eq(random_b).children().eq(0).addClass("hide2_b");
		$('.frenkifeed a div:visible').eq(random_b).children().eq(1).addClass("hide2");
		window.setTimeout(function(){
			$('.frenkifeed a div:visible').eq(random_b).children().eq(0).appendTo( $('.frenkifeed a div:hidden').eq(random2_b) ).removeClass('hide2_b');;
			$('.frenkifeed a div:visible').eq(random_b).children().eq(0).removeClass("hide2");		
		},800);

		random_c = generateRandom(0,rem,random, random_b);
		random2_c = generateRandom(0,rem2,random2, random2_b);

		$('.frenkifeed a div:hidden').eq(random2_c).children().eq(0).appendTo($('.frenkifeed a div:visible').eq(random_c));
		$('.frenkifeed a div:visible').eq(random_c).children().eq(0).addClass("hide4_b");
		$('.frenkifeed a div:visible').eq(random_c).children().eq(1).addClass("hide4_c");
		window.setTimeout(function(){
			$('.frenkifeed a div:visible').eq(random_c).children().eq(0).appendTo( $('.frenkifeed a div:hidden').eq(random2_c) ).removeClass('hide4_b');;
			$('.frenkifeed a div:visible').eq(random_c).children().eq(0).addClass("hide4");
			window.setTimeout(function(){
				$('.frenkifeed a div:visible').eq(random_c).children().eq(0).removeClass("hide4").removeClass('hide4_c');		
			},400);		
		},400);

		// $('.frenkifeed a div:hidden').eq(random2_c).children().eq(0).appendTo($('.frenkifeed a div:visible').eq(random_c));
		// $('.frenkifeed a div:visible').eq(random_c).children().eq(0).addClass("hide3_b");
		// $('.frenkifeed a div:visible').eq(random_c).children().eq(1).addClass('hide3_c');
		// window.setTimeout(function(){
		// 	$('.frenkifeed a div:visible').eq(random_c).children().eq(0).appendTo( $('.frenkifeed a div:hidden').eq(random2_c) ).removeClass('hide3_b');;			
		// 	$('.frenkifeed a div:visible').eq(random_c).children().eq(0).addClass('hide3');
		// 	window.setTimeout(function(){
		// 		$('.frenkifeed a div:visible').eq(random_c).children().eq(0).removeClass("hide3").removeClass('hide3_c');		
		// 	},800);
		// },800);

	}, 3500);
}

var frenkifeedInit = function(){	
	var feed = new Instafeed({
        get: 'user',
        // tagName: 'scramblerducati',
        userId: 1918184,
        // clientId: 'ea201a57cf23403f80f25ce5b8a15caf',
		// accessToken: '1918184.3a81a9f.f47a63a7f4a74b0fbdd405cae51b3e98',
		// accessToken: '4211870052.3a81a9f.bbc4c3aec0c8433b8855c3f101a4cae1'
        accessToken: '44612423.3a81a9f.1ea9a822eb2c4dcfbd32b2d77b07b671',
        limit: 30,        
        // useHttp: "true"
        template: '<a class="animation" href="{{link}}"><div><img src="{{image}}" /></div></a>',
		resolution: 'low_resolution',
		after: function(){
			initiated['frenkifeed'] = true;
			frenkifeedSize();
		}
    });
	feed.run();	
}

var init = function(){
	generalBinding();
	indexBinding();
    ytInit();
	history_init();
	// frenkifeedInit();
}


// STORIES

var loadStories = function(){
	if(loading) return;
	loading = true;
	var deferred = $.Deferred();    
    var detail_data = { origin: origin, increment: increment }
    var send_data = { action: "loadStories", data: detail_data };
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
			populateGrid(data).then(function(){				
				loading = false;
				deferred.resolve('ok');   
			});						   
        }
	});
	return deferred.promise();
}

var populateGrid = function(data){
	$items = $(data);    
	var deferred = $.Deferred();
	
	if($isot == null){		
		$isot = $('.stories-grid').append($items)
		.imagesLoaded(function(){			
			$isot.fadeIn('fast')
			.isotope({
				itemSelector: '.stories-cell',
				// getSortData: {
				//     name: '.name',
				//     category: '[data-category]'
				// },        
				masonry: {
					columnWidth: '.stories-cell-sizer',
					gutter: '.stories-gutter-sizer',
					percentPosition: true
				}
			}); 
			deferred.resolve(); 						
		});		   
	}else{
		$isot.append( $items ).imagesLoaded(function(){
			$isot.isotope( 'appended', $items ).isotope('layout');
			deferred.resolve();
		});
	}       
	return deferred.promise();
}

var loadStory = function(story_id){
	if(loading) return;	
	var deferred = $.Deferred();    
    var detail_data = { origin: origin, increment: increment, story_id: story_id }
    var send_data = { action: "loadStory", data: detail_data };
    $.ajax({ type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {                                   			
			deferred.resolve(data);   	   
        }
	});
	return deferred.promise();
}