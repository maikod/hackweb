
//variabili globali
var timeout = 0;
var pagina = '';
var utente = '';
var potere = 0;
var avatar = 'avatar_base.png';
var informazioni = 'Version 5.0<br>© hackweb, Riccione / Bologna 2002 - 2018';
var clockInterval;
var clock;

//funzioni
function clock($el){	
	// console.log("tic");
	var data = new Date();	
	var h = data.getHours();
	var m = data.getMinutes();
	var s = data.getSeconds();

	if(h <= 9){
		h = "0"+h;
	}
	if(s <= 9){
		s = "0"+s;
	}
	if(m <= 9){
		m = "0"+m;
	}	
	$el.html(data.getDate()+"/"+(data.getMonth()+1)+"/"+data.getFullYear()+" - "+h+":"+m+":"+s);	
}

function parallax() {
	var scrollPosition=$(window).scrollTop();
	$('#backgr').css('top',(0 - (scrollPosition *.2)) +'px');
	$('#immagini').css('top',(0 -(scrollPosition * .5)) + 'px');
}

function startVideo(){
	var posizione = $('#fascia4').offset().top - 100;
	var top = $(window).scrollTop();

	if (top >= posizione){
		player.play();
	}
	
}



// JavaScript Document
$(function() {
	
	//collegamento allo scorrimento della pagina
	$(window).bind('scroll', function(e) {	
		//parallax();	
	});
	
	//collegamento alla navbar
	// $('.nav-link').bind('click', function(event) {
    //     var $anchor = $(this);
    //     //console.log($anchor);
    //     $('html, body').stop().animate({
    //         scrollTop: $($anchor.attr('href')).offset().top -46
    //     }, 1500, 'easeInOutExpo');
    //     event.preventDefault();
    //     event.stopImmediatePropagation();
    // });	

});