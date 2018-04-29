<div class="login_form adm-panel">    
    <strong>ADMIN AREA</strong>
    <br>
    Esegui l'accesso:
    <br>
    <form id="login" enctype="multipart/form-data" encoding="multipart/form-data" method="post">
        <input placeholder="username" id="codice" type="text" name="username" value="" /><br>
        <input placeholder="password"  type="password" name="password" value="" /><br>
        <input type="hidden" name="form" value="login" />
        <button type="submit" class="btn btn-default login" style="margin-top:10px;">LOG IN</button>
    </form>
    <div class="text-danger login-status"></div>
</div>

<script>
    init_login();
</script>