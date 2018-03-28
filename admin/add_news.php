<form name="form4" id="form4" >
    add the news:
    <br>
<textarea name="testo" id="testo" rows="5" style="width: 90%;"></textarea>
<br><br>	<input type="submit" name="invia" id="invia" value="invia">	</form>

<script type="text/javascript">		
	$('#form4').submit(function(event){
	    var data = $(this).serialize();
	    $.post('../php/elabora_news.php', data)
	        .success(function(result){	        	
	        	if(result == 2){
		        	$('#barra-sopra').html('unknown error');
                    //alert(result);
	        	}else if(result == 1){
	        		$('#barra-sopra').html('news added');
	        		$('#fascia-news').html('loading news...');
	        		setTimeout(function() {
						$('#fascia-news').load('./include/news.php');
					}, 3000);
	        		
	        	}    	
	        })
	        .error(function(){
	            console.log('Error loading page');
	        })
	    return false;
	});
</script>