<script type="text/javascript" src="/js/chat.js"></script>
<?php
$utente = $_GET['user'];
?>

<table width="600" border="0">
  <tr>
    <td>&nbsp;--->  &nbsp;c h <span style="font-size:11px; color:#00FF00; padding-bottom:5px">@</span> t&nbsp;  <--- <br />
      <table width="0" height="196" border="0">
        <tr>
          <td colspan="3" valign="center" height="157"><br />
          <div align="left" style="font-size:9px;color:#00FF00;" id="risultato"></div><br />
            <?php if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){}else{ ?>
            <span style="font-size:10px; color:#999">(solo gli utenti registrati possono scrivere nella chat)</span>
            <?php } ?></td>
        </tr>
        <tr>
          <form method="get" action="" onsubmit="return saveChat('name', 'msg', 'risultato');">
            <?php if(isset($_SESSION['user']) || isset($_COOKIE[md5('user')])){ ?>
            <td width="0" height="28"><div align="left">
                <input name="message" type="text" id="msg" value="" size="50" />
                <input name="name" type="hidden" value="<?php echo("$utente"); ?>" id="name"/>
              </div></td>
            <td width="257" align="right"><div align="right" style="padding:1px">
                <div  style="font-size:10px; line-height:30px" align="left">
                  <!--<input name="textfield" type="text" maxlength="15" id="name">-->
                  <input style="font-size:10px" name="send" type="submit" value="send" id="send">
                </div>
              </div></td>
            <?php } ?>
          </form>
        </tr>
      </table></td>
  </tr>
</table>
<br />
<script type="text/javascript">
getChat('risultato');
setInterval("getChat('risultato');", 5000);
</script>
