<?php
$connection = "../../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

if(intval($result['potere']) < 0) return;
?>

<strong>hw framework <br>by frankie <br>(v2.4)</strong>
<br>
<br>

<div class="adm-panel">
    Ciao <strong><?php echo $_SESSION['username']; ?></strong>,
    <br>
    benvenuto nel pannello di amministrazione !
    <br>
    Usa il menu a sinistra per accedere alle varie impostazioni.<br><br>
    Per tornare al tuo sito clicca su <i class="fa fa-home"></i>.
    <br><br>
    <strong>Nota Bene</strong>
    <br>
    Le funzionalità non sono ancora complete. Se hai necessità contatta l'amministratore.
</div>
