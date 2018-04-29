function parallax() {
	var scrollPosition=$(window).scrollTop();
	$('#backgr').css('top',(0 - (scrollPosition *.2)) +'px');
	//$('#immagini').css('top',(0 -(scrollPosition * .5)) + 'px');
}

$(function() {
	
	//collegamento allo scorrimento della pagina
	$(window).bind('scroll', function(e) {	
		parallax();
	});

});