<hr>
inserisci nome utente e password:<br>
<hr>
<br>

<div class="formsDiv" align="center">
    
    <div align="left">
        <form class="forms" name="form3" id="form3">
            <label>username:<br>
            <input name="username" type="text"  id="username" />
            </label>
            <br>
            <label>password:<br>
            <input name="password" type="password" id="password" />
            <br>
            </label>
            <label>
            <div align="center">
                <input name="ricordami" type="checkbox" id="ricordami" value="ric" />
                ricordami</div>
            </label>
            <br>
            <label>
            <div align="center">
                <input name="Submit" type="submit" class="style1" value="login" />
            </div>
            </label>
        </form>
    </div>

</div>

<script type="text/javascript">		
	$('#form3').submit(function(event){
    var data = $(this).serialize();
    $.post('../php/elabora_login.php', data)
        .success(function(result){
        	//alert('welcome back ' + result);
        	if(result == 2){
	        	$('#barra-sopra').html('user/password error');
        	}else if(result == 3){
        		$('#barra-sopra').html('this account is not veirfied');
        	}else{
	        	$('#barra-sopra').html('welcome back ' + result);
				$('#content').load('include/home.php');
				$('#menu').load('include/menu.php');
				utente = result;
        	}        	
        })
        .error(function(){
            console.log('Error loading page');
        })
    return false;
	});
</script>