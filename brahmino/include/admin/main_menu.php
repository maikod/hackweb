<?php
$connection = "../../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

if(intval($result['potere']) < 0) return;
?>

<div class="admin-menu closed-ver">
    <div class="menu-buttons">
        <a class="adm-btn adm-link" href="overview"><i class="fa fa-home"></i> <strong><?php echo $_SERVER['SERVER_NAME']; ?></strong></a> 
        <!-- <span class="adm-separator">//</span> -->
        <!-- <a class="adm-btn adm-link" href="#"><i class="fa fa-plus"></i>New</a> -->
        <div class="right-menu">
            <a class="adm-btn adm-link" href="admin"><strong><?php echo $_SESSION['username']; ?> </strong><i style="margin-left:5px;" class="fa fa-user"></i> </a> 
        </div>                        
    </div>
</div>

<script>    
$('.adm-link', '.admin-menu').bind('click', function(event){
    event.preventDefault();
	event.stopImmediatePropagation();				
    sezione = $(this).attr('href');
    sezione = "";
    window.history.pushState(null, null, lang+'/'+sezione);	
    firstLoad();	
});
</script>