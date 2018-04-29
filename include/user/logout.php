<script>
function logout(){
	utente = "";
	$('#content').load('include/assistenza.php');
    $('#barra-sopra').load('include/admin.php');
    $('#menu').load('include/menu.php');
}
</script>
<?php
//per ora senza cookie
require_once('../../lib/acc_class.php');
$acc = new ACCOUNT;
$result = $acc->logout();

if($result == 1){
	echo('<script> logout(); </script>');
}
?>