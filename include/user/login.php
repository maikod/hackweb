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
                <input name="ricordami" type="checkbox" id="ricordami" value="true" />
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

<script>		
	$('#form3').submit(function(e){
        e.preventDefault();
        var send_data = { action: "login", data: objectifyForm($(this).serializeArray()) };

        $.ajax({
            type: "POST",
            url: "libs/call_func.php",
            data: JSON.stringify(send_data),
            contentType: "application/json",
            async: true,
            success : function(data)
            {
                data = JSON.parse(data);  
                console.log(data);                
                if(data.success == 0){                                    
                    $('#barra-sopra').html('user/password error');
                }else if(data.success == 3){
                    $('#barra-sopra').html('this account is not veirfied');
                }else{
                    $('#barra-sopra').html('welcome back ' + data.utente);
                    $('#content').load('include/home.php');
                    $('#menu').load('include/menu.php');
                    utente = data.utente;
                } 
            }
        });
        return false;
	});
</script>