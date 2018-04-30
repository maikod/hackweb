<?php 
//funzione che carica automaticamente le classi
function __autoload($nome_classe){
    require_once '../libs/' . $nome_classe . '.php';
}
//inizializzazione della classe ACCOUNT
$acc = new ADMIN;
?>


<div class="logincell" align="center">men&ugrave; principale</div>
<div id="menu_block">
	<ul id="main_menu">
		<li><a class="button-menu" href="include/home.php">home</a></li>
        <!-- <li><a class="button-menu" href="include/assistenza.php">richieste lavoro</a></li> -->
	</ul>
</div>
<br>
<div class="logincell" align="center">men&ugrave; utente</div>
<div id="menu_block">
	<ul id="main_menu">
        <?php        
        if(isset($_SESSION['username']) || isset($_COOKIE[md5('username')])){
        	echo('<li><a class="button-menu" href="./include/user/logout.php">logout</a></li></ul>');
			$arr = (isset($_COOKIE[md5('username')])) ? $_COOKIE : $_SESSION;	
			print_r($arr);		
			// if(isset($_COOKIE[md5('username')])) echo "aaa";
        	if($arr[$acc->proteggi("g","giovi","potere","dfg","115")] >= $acc->proteggi("d","erfsa",100,"afeg44","232")){
            	echo('
            		<br>
					<div class="logincell" align="center">men&ugrave; amministratore</div>
					<div id="menu_block">
					<ul id="main_menu">
					<li><a class="button-menu" href="admin/add_news.php" onclick="">aggiungi news</a></li>
					</ul></div>
					<br>
					<div class="logincell" align="center">hacker utility</div>
					<div id="menu_block">
						<ul id="main_menu">
							<li><a class="button-menu" href="./404.php">anon <span class="hack_menu">mail_sender</span></a></li>
						</ul>
					</div>
					');
			}
			
			if($arr[$acc->proteggi("g","giovi","potere","dfg","115")] >= $acc->proteggi("d","erfsa",80,"afeg44","232")){
            	echo('<br>
					<div class="logincell" align="center">CANCELLERIA privata</div>
					<div id="menu_block">
					<ul id="main_menu">
					<li><a class="button-menu" href="include/canc_priv/vis_pratiche.php">visualizza pratiche</a></li>
					<li><a class="button-menu" href="include/canc_priv/ins_pratiche.php">aggiungi pratica</a></li>
					<li><a class="button-menu" href="include/canc_priv/index.php">aggiungi controparti</a></li>
					<li><a class="button-menu" href="include/canc_priv/index.php">archivio pratiche</a></li>
					<li><a class="button-menu" href="include/canc_priv/index.php">allega documenti alle pratiche</a></li>
					<li><a class="button-menu" href="include/canc_priv/index.php">richiedi accesso agli atti di una pratica</a></li>
					</ul></div>');
			}
		}else{ 
			echo('<li><a class="button-menu" href="include/user/login.php" >login</a></li>
				<li><a class="button-menu" href="include/user/register.php" >register</a></li>');
        }
        ?>
	</ul>
</div>

<br>

<script>
//pulsanti menu
$('.button-menu').click(function(e) {
	e.preventDefault();	
    $('#content').load($(this).attr('href'));    
	return false;
});
</script>