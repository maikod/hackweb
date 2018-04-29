 completa il form:

<br>
<div align="center" class="formsDiv">

    <div align="left">
        <br>
        <div>* = facoltativo</div>
        
        <form class="forms" name="form2" id="form2">
            <label for="textfield">username:<br>
            </label>
            <input name="nick" type="text" class="style1" id="textfield" />
            <br>
            <label></label>
            <label for="label2">password:<br>
            </label>
            <input name="pwd" type="password" class="style1" id="label2" />
            <br>
            <label for="label3">confirm:</label>
            <br>
            <input name="pwd2" type="password" class="style1" id="label3" />
            <br>
            <label for="label"> mail:</label>
            <br>
            <input name="mail" type="text" class="style1" id="label" />
            <br>
            <label></label>
            <label>*lascia un messaggio:
            <textarea name="object" class="style1"></textarea>
            </label>
            <br>
            <input name="send" type="submit" class="style1" value="send" />
            <input name="clear" type="reset" class="style1" value="clear" />
            <br>
        </form>
    </div>

</div>    
       
<script type="text/javascript">		
	$('#form2').submit(function(event){
    	var data = $(this).serialize();
	    $.post('../php/elabora_register.php', data)
	        .success(function(result){
	        	//alert(result);
	        	if(result == 1){
		        	$('#barra-sopra').html('you registered correctly, now check your email to complete registration');
		        	$('#content').load('include/home.php');
	        	}else if(result == 2){
	        		$('#barra-sopra').html('username not available');
	        	}else if(result == 3){
	        		$('#barra-sopra').html('mail already registered');
	        	}else if(result == 4){
	        		$('#barra-sopra').html('fill all fields');
	        	}else if(result == 5){
	        		$('#barra-sopra').html('passwords are not the same');
	        	}else{
		        	$('#barra-sopra').html(result);
	        	}       	
	        })
	        .error(function(){
	            console.log('Error loading page');
	        })
	    return false;
	});
</script>