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
        //inizio della sessione
		@session_start();
		
        require_once("../security/security.php");
        if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){
        	echo('<li><a class="button-menu" href="./include/user/logout.php">logout</a></li></ul>');
        	
        	if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] >= proteggi("d","erfsa",100,"afeg44","232")){
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
			
			if($_COOKIE[proteggi("g","giovi","potere","dfg","115")] >= proteggi("d","erfsa",80,"afeg44","232")){
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