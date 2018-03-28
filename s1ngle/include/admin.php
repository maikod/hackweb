
<?php
$connection = "../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

echo '
<script>
    var username = "'.$result['username'].'";    
    var admin_page_link = "include/admin/'.$result['admin_page_link'].'";
</script>
';
?>

<div class="spazio" id="hw-admin">
    <div class="inner">        
        <div id="admin-menu">
        
        </div>       
        <div id="admin-left-menu">

        </div>
        <div id="admin-content">
            
        </div>
    </div>
</div>

<script>    
if(username!="0"){
    init_admin();
}else{
    initAdminLogin();
}
</script>