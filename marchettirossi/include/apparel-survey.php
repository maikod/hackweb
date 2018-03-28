<?php
// ip filter 213.255.45.14
if($_SERVER['REMOTE_ADDR'] != '213.255.45.14'){
	//  header('Location:'.HOST.$root->lang);
}

//cambiamento forzato in lingua inglese
if($root->lang != 'it' && $root->lang != 'en'){
	//header( "Location: http://scramblerducati.com/en/days-of-joy" );
}

//trasformazione delle variabili php in js
echo '
<script>
var HOST = "'.HOST.'";
var tr = new Array();
tr[160] = "'.$_SESSION['Trad'][160].'";
tr[159] = "'.$_SESSION['Trad'][159].'";
</script>
';
?>

<style>
.cont_option_sub{
	margin-top: 5px;
}
.affianca{
	width: 33.0% !important;
}
.form_keepme label {
    font-family: "Arial",sans-serif;
    text-transform: uppercase;
}
.metaField{
	width:60%;
	padding:10px;
	/*font-family: "akzidenz-grotesk-extended",sans-serif;*/
}
.metaField img {
    max-width: 90%;
    margin-bottom: 10px;
}
.form_keepme input, .form_keepme select {
    /*font-family: "akzidenz-grotesk-extended",sans-serif;*/
		font-family: "Roboto condensed",sans-serif;
}
#sfondo{
	background: url(../immagini/days-of-joy/sf_form.jpg);
	background-size: auto;
	min-height: 100%;
}
.cont_thanks{
	font-family: "akzidenz-grotesk-extended",sans-serif;
	margin-top: 250px;
	text-align: center;
	font-size: 24px;
}
td img{
	max-width: 150px !important;
}
td{
	min-width: 50px;
}
</style>
<div id="sfondo">
<form id="iscrizione" class="form_def form_keepme" enctype="multipart/form-data" encoding="multipart/form-data" method="post" style="padding-bottom: 100px; text-transform: uppercase; ">
<input type="hidden" name="form_name" value="apparel_survey"/>
<!-- <div class="center fascia" >
	<img src="<?php echo HOST; ?>immagini/days-of-joy/Scrambler_Ducati.png" alt="Scrambler Ducati Logo" style="max-width: 50%;"/>
</div> -->
<div class="metaField cont_hide" style="sans-serif;margin: 0 auto;" >
	<!-- dev10n -->
	<div style="text-align: center;">
		<img src="<?php echo HOST; ?>immagini/scr_inclinato_nero.png" style="margin: 0 auto; margin-bottom: 30px; max-width: 600px; width: 100%; margin-top:20px;">
	</div>

	<!-- genere -->
	<div><?php echo $_SESSION['Trad'][151]; ?></div>
	<select name="genere" class="required">
		<option value="" selected="selected" id="" class="option_field" >--</option>
		<option value="M">M</option>
		<option value="F">F</option>
	</select>

	<label ><?php echo $_SESSION['Trad'][127]; ?></label>
	<br>
	<!-- <input type="date" name="data_nascita" class="required" placeholder="dd/mm/yyyy"/> -->
	<select name="b-dd" class="required date-f" id="b-dd">
		<option value="" selected="selected" class="option_field" >DD</option>
		<?php include('include/day_list.php'); ?>
	</select>
	<select name="b-mm" class="required date-f" id="b-mm">
		<option value="" selected="selected" class="option_field" >MM</option>
		<?php include('include/month_list.php'); ?>
	</select>
	<select name="b-yy" class="required date-f" id="b-yy">
		<option value="" selected="selected" class="option_field" >YYYY</option>
		<?php include('include/year_list.php'); ?>
	</select>

	<input type="hidden" name="data_nascita" id="data_nascita"/>

	<br>
	<?php echo $_SESSION['Trad'][126]; ?>
  <select name="nazione" class="required">
      <option value="" id="country-list" class="option_field" selected>--</option>
      <?php include('include/country_list.php'); ?>
  </select>

	<br>
	<br>

	<!-- TUO SCR -->
	<div><?php echo $_SESSION['Trad'][218]; ?></div>
	<select name="tuo_scr" class="required">
		<option value="" selected="selected" id="" class="option_field" >--</option>
		<option value="sixty2">sixty2</option>
		<option value="icon">icon</option>
		<option value="classic">classic</option>
		<option value="full throttle">full throttle</option>
		<option value="urban enduro">urban enduro</option>
		<option value="flat track">flat track pro</option>
		<option value="cafe racer">café racer</option>
		<option value="desert sled">desert sled</option>
		<option value="italia independent">italia independent</option>
	</select>

	<br>
	<br>

	<!-- TUO SCRAMBLER -->
	<div><?php echo $_SESSION['Trad'][152]; ?></div>
	<select name="tuo_scrambler" class="required">
		<option value="" selected="selected" id="" class="option_field" >--</option>
		<option value="La mia prima moto"><?php echo $_SESSION['Trad'][153]; ?></option>
		<option id="sel_altra_moto" value="Si è aggiunto ad altre moto"><?php echo $_SESSION['Trad'][154]; ?></option>
		<option id="sel_altra_moto" value="Ha sostituito un'altra moto"><?php echo $_SESSION['Trad'][155]; ?></option>
		<option id="sel_altra_moto" value="Acquistata dopo anni che non guidavo"><?php echo $_SESSION['Trad'][156]; ?></option>
	</select>

	<br>
	<br>

	<div id="altra_moto1" style="display: none;">
		<div id="altra_moto1_sost" style="font-weight: bold;"><?php echo $_SESSION['Trad'][159]; ?></div>
		<br>
		<div><?php echo $_SESSION['Trad'][157]; ?></div>
		<select name="altra_moto_marca_1" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/brand_list.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<div><?php echo $_SESSION['Trad'][65]; ?></div>
		<select name="altra_moto_modello_1" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
		</select>
		<div><?php echo $_SESSION['Trad'][158]; ?></div>
		<select name="altra_moto_anno_1" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/year_list.php'); ?>
		</select>
		<button id="new_bike">&nbsp;+&nbsp;</button>
	</div>

	<div id="altra_moto2" style="display: none;">
		<br>
		<div><?php echo $_SESSION['Trad'][157]; ?></div>
		<select name="altra_moto_marca_2" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/brand_list.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<div><?php echo $_SESSION['Trad'][65]; ?></div>
		<select name="altra_moto_modello_2" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
		</select>
		<div><?php echo $_SESSION['Trad'][158]; ?></div>
		<select name="altra_moto_anno_2" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/year_list.php'); ?>
		</select>
		<button id="new_bike2">&nbsp;+&nbsp;</button>
	</div>

	<div id="altra_moto3" style="display: none;">
		<br>
		<div><?php echo $_SESSION['Trad'][157]; ?></div>
		<select name="altra_moto_marca_3" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/brand_list.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<div><?php echo $_SESSION['Trad'][65]; ?></div>
		<select name="altra_moto_modello_3" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
		</select>
		<div><?php echo $_SESSION['Trad'][158]; ?></div>
		<select name="altra_moto_anno_3" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/year_list.php'); ?>
		</select>
	</div>

	<br>
	<br>

	<!-- sei a conoscenza dell'abbigliamento scrambler -->
	<div><?php echo $_SESSION['Trad'][161]; ?></div>
	<select name="abbigliamento" class="required">
		<option value="" selected="selected" id="" class="option_field" >--</option>
		<option value="Si, anche se non tutti"><?php echo $_SESSION['Trad'][162]; ?></option>
		<option value="Si, tutti"><?php echo $_SESSION['Trad'][163]; ?></option>
		<option value="No"><?php echo $_SESSION['Trad'][164]; ?></option>
	</select>

	<br>
	<br>
	<br>
	<br>

	<!-- il venditore ti ha proposto accessori scr -->
	<div><?php echo $_SESSION['Trad'][165]; ?></div>
	<br>
	<div class="" style="">
		<div class="radio_indiv" style="">
			<label><?php echo $_SESSION['Trad'][166]; ?></label>
			<div class="cont_option">
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="vend_accessori" value="si">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][56]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="vend_accessori" value="no">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][164]; ?></label>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>


	<!-- il venditore ti ha proposto abbigliamento scr -->
	<div class="" style="">
		<div class="radio_indiv" style="">
			<label><?php echo $_SESSION['Trad'][167]; ?> </label>
			<div class="cont_option">
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="vend_abbigliamento" value="si">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][56]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="vend_abbigliamento" value="no">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][164]; ?></label>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>

	<!-- hai comprato abbigliamento -->
	<div class="" style="">
		<div class="radio_indiv" style="">
			<label><?php echo $_SESSION['Trad'][168]; ?> </label>
			<div class="cont_option">
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="comprato" value="si">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][56]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="radio" name="comprato" value="no">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][164]; ?></label>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>

	<!-- se hai comprato -->
	<!-- quando comprato -->
	<div id="quando_comprato" style="display: none;">
		<div><?php echo $_SESSION['Trad'][169]; ?></div>
		<select name="quando_comprato" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<option value="Al momento acquisto"><?php echo $_SESSION['Trad'][170]; ?></option>
			<option value="Entro 3 mesi"><?php echo $_SESSION['Trad'][171]; ?></option>
			<option value="Oltre 3 mesi"><?php echo $_SESSION['Trad'][172]; ?></option>
		</select>
		<br>
		<br>
	</div>

	<!-- cosa comprato -->
	<div class="" style="display: none;" id="cosa_comprato">
		<div class="radio_indiv" style="">
			<label><?php echo $_SESSION['Trad'][173]; ?> </label>
			<div class="cont_option">
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="giacca pelle">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][174]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="giacca tessuto">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][175]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="casco jet">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][176]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="casco integrale">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][177]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="guanti">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][178]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="abbigliamento lifestyle">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][179]; ?></label>
				</div>
				<div class="cont_option_sub">
					<input class=" optionbox" type="checkbox" name="cosa_comprato" value="altro">
					<label class=" optionbox"><?php echo $_SESSION['Trad'][180]; ?></label>
				</div>
			</div>
		</div>
		<input placeholder="OTHER" name="cosa_comprato_altro" style="padding: 5px; font-size: 12px; display: none;"></input>
		<br>
		<br>
		<div style="clear: both;"></div>
		<br>
		<br>
	</div>

	<!-- SE NON HAI COMPRATO, PERCHE? -->
	<div id="no_comprato" style="display: none;">
		<div><?php echo $_SESSION['Trad'][199]; ?></div>
		<select name="no_comprato" class="">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<option value="non mi piace design"><?php echo $_SESSION['Trad'][200]; ?></option>
			<option value="avevo già abbigliamento moto"><?php echo $_SESSION['Trad'][201]; ?></option>
			<option value="prezzo"><?php echo $_SESSION['Trad'][184]; ?></option>
			<option value="non c e articolo che interessa"><?php echo $_SESSION['Trad'][202]; ?></option>
			<option value="altro"><?php echo $_SESSION['Trad'][180]; ?></option>
		</select>
		<div id="no_comprato_mancanza" style="display: none;">
			<input placeholder="<?php echo $_SESSION['Trad'][203]; ?>" name="no_comprato_mancanza" style=""></input>
		</div>
		<div id="no_comprato_altro" style="display: none;">
			<input placeholder="Altro" name="no_comprato_altro" style=""></input>
		</div>
	</div>

	<br>
	<br>
	<br>

	<!-- VALUTAZIONE DA 0 a 10 -->
	<div>
		<div><?php echo $_SESSION['Trad'][181]; ?></div>
		<br>
		<br>
		<table style="text-transform:uppercase;">
			<tr>
				<td>
				</td>
				<td style="width: 150px;">
				</td>
				<td style="width: 150px;">

				</td>
				<td style="width: 150px;">

				</td>
				<td style="width: 150px;">

				</td>
			</tr>
			<tr>
				<td>
					<?php echo $_SESSION['Trad'][185]; ?><br>(IT 479 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98104008-.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1a" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2a" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3a" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][186]; ?><br>(IT 399 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98104011-.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1b" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2b" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3b" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][187]; ?><br>(IT 479 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98103330.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1c" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2c" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3c" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][188]; ?><br>(IT 219 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98103350.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1d" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2d" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3d" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][189]; ?><br>(IT 219 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98103084.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1e" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2e" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3e" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][190]; ?><br>(IT 29-35 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="https://media.giphy.com/media/I2PBfBMPXIWru/giphy.gif"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1f" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2f" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3f" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][191]; ?><br>(IT 449 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/9810402-.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1g" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2g" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3g" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][192]; ?><br>(IT 529 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/9810312.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1h" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2h" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3h" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][193]; ?><br>(IT 399 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98104014-.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1i" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2i" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3i" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][194]; ?><br>(IT 349 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="http://scramblerducati.com/immagini/accessori/accessori/mosaico/98103076.png"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1j" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2j" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3j" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo $_SESSION['Trad'][205]; ?><br>(IT 79-99 €)
				</td>
				<td>
					&nbsp;
					&nbsp;
					&nbsp;
					<img src="https://media.giphy.com/media/HlG7lDyW26bO8/giphy.gif"/>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][182]; ?>
					<select name="soddisfazione_1k" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][183]; ?>
					<select name="soddisfazione_2k" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
				<td>
					<?php echo $_SESSION['Trad'][184]; ?>
					<select name="soddisfazione_3k" class="required" >
						<option value="" selected="selected" id="" class="option_field" >--</option>
						<?php include('include/vote_list.php'); ?>
					</select>
				</td>
			</tr>

		</table>
	</div>

	<br>
	<br>

	<!-- BELL -->
	<div><?php echo $_SESSION['Trad'][195]; ?></div>
	<select name="bell" class="required">
		<option value="" selected="selected" id="" class="option_field" >--</option>
		<option value="Si, brand"><?php echo $_SESSION['Trad'][196]; ?></option>
		<option value="Si, brand e prodotti"><?php echo $_SESSION['Trad'][197]; ?></option>
		<option value="No"><?php echo $_SESSION['Trad'][198]; ?></option>
	</select>

	<br>
	<br>

	<!-- PREFERENZA BRAND ABBIGLIAMENTO -->
	<div id="">
		<div style="font-weight: bold;"><?php echo $_SESSION['Trad'][204]; ?></div>
		<br>
		<div><?php echo $_SESSION['Trad'][206]; ?></div>
		<select name="pref_casco" class="required">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/caschi.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<input id="casco_other" placeholder="OTHER" name="pref_casco_altro" style="display: none;"></input>

		<div><?php echo $_SESSION['Trad'][207]; ?></div>
		<select name="pref_giacca" class="required">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/giacche.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<input id="giacca_other" placeholder="OTHER" name="pref_giacca_altro" style="display: none;"></input>

		<div><?php echo $_SESSION['Trad'][208]; ?></div>
		<select name="pref_guanti" class="required">
			<option value="" selected="selected" id="" class="option_field" >--</option>
			<?php include('include/guanti.php'); ?>
			<option value="OTHER" >OTHER</option>
		</select>
		<input id="guanti_other" placeholder="OTHER" name="pref_guanti_altro" style="display: none;"></input>
	</div>

	<br>
	<br>

	<label><?php echo $_SESSION['Trad'][209]; ?></label>
	<br>
	<br>
	<br>
	<label><?php echo $_SESSION['Trad'][210]; ?></label>
  <select name="affermazione_1" class="required">
      <option value="" id="" selected>--</option>
      <?php include('include/vote_list.php'); ?>
  </select>
	<br>
	<label><?php echo $_SESSION['Trad'][211]; ?></label>
  <select name="affermazione_2" class="required">
      <option value="" id="" selected>--</option>
      <?php include('include/vote_list.php'); ?>
  </select>
	<br>
	<label><?php echo $_SESSION['Trad'][212]; ?></label>
  <select name="affermazione_3" class="required">
      <option value="" id="" selected>--</option>
      <?php include('include/vote_list.php'); ?>
  </select>

	<br>
	<br>

	<div><?php echo $_SESSION['Trad'][213]; ?></div>
	<input id="altro_articolo" class="" placeholder="--" name="altro_articolo" style=""></input>



<!--
	<br><br>
	<div ><?php echo $_SESSION['Trad'][44]; ?><br><br></div>
	<input class=" checkbox"   type="checkbox" name="Privacy" value="1" /><label class=" checkbox" ><?php echo $_SESSION['Trad'][45]; ?> *</label>
  <input class=" checkbox"   type="checkbox" name="Privacy1" value="1" /><label class=" checkbox" ><?php echo $_SESSION['Trad'][46]; ?> *</label>
  <div style="clear: both; font-size: 15px; font-weight: bold; padding-top: 15px;">* <?php echo $_SESSION['Trad'][130]; ?></div>
	<br> -->
	<div class="validation" style="display: none; color: red; margin-top: 20px;"><?php echo $_SESSION['Trad'][142]; ?></div>
	<div id="cont_prezzo" ><span class="fa"></span><span id=""></span></div><input type="hidden" name="Prezzo" value=""  />

	<br>
	<br>
	<br>
	<br>

	<div class="frm_cont_btn" style="margin:0; width:100%; text-align: right;">
		<button class="salva_iscrizione"><?php echo $_SESSION['Trad'][137]; ?></button>
	</div>

	</div>

	<!-- GRAFICA -->
	<!-- <div class="metaField flRight center cont_hide" >
		<div >
			<img src="<?php echo HOST; ?>immagini/days-of-joy/casco_rk.png" alt=""/>
			<a href="#" role="button" class="chiudi close_modal"></a>
		</div>
	</div> -->
	<div class="cont_thanks" ></div>
	<input type="hidden" value="mod" name="op"/>
	<input type="hidden" value="<?php echo $root->lang; ?>" name="lang"/>
</div>
</form>
</div>

<script>
	//operazioni sulle select
	$('select[name="tuo_scrambler"]').change(function(event) {
		$('#altra_moto1 select').val("");
		$('#altra_moto1_sost').html(tr[159]);
		$('#new_bike').show();
		$('#new_bike2').show();
		$('#altra_moto2 select').val("");
		$('#altra_moto3 select').val("");
		$('#altra_moto2').hide();
		$('#altra_moto3').hide();
		switch($(this).val()){
			case "La mia prima moto":
				$('#altra_moto1').hide();
  		break;
  		case "Si è aggiunto ad altre moto":
				$('#altra_moto1').show();
  		break;
			case "Ha sostituito un'altra moto":
				$('#altra_moto1').show();
				$('#new_bike').hide();
  		break;
			case "Acquistata dopo anni che non guidavo":
				$('#altra_moto1').show();
				$('#new_bike').hide();
				$('#altra_moto1_sost').html(tr[160]);
  		break;
  	}
	});

	$('select[name="altra_moto_marca_1"]').change(function(event){
		$('select[name="altra_moto_modello_1"]').html('<option value="" selected="selected" id="" class="option_field" >--</option>');
		$.get("<?php echo HOST ?>template/include/model_list/"+$(this).val().toLowerCase()+".php", function(data){
			$('select[name="altra_moto_modello_1"]').append(data);
			$('select[name="altra_moto_modello_1"]').append('<option value="OTHER" >OTHER</option>');
		});
	});

	$('select[name="altra_moto_marca_2"]').change(function(event){
		$('select[name="altra_moto_modello_2"]').html('<option value="" selected="selected" id="" class="option_field" >--</option>');
		$.get("<?php echo HOST ?>template/include/model_list/"+$(this).val().toLowerCase()+".php", function(data){
			$('select[name="altra_moto_modello_2"]').append(data);
			$('select[name="altra_moto_modello_2"]').append('<option value="OTHER" >OTHER</option>');
		});
	});

	$('select[name="altra_moto_marca_3"]').change(function(event){
		$('select[name="altra_moto_modello_3"]').html('<option value="" selected="selected" id="" class="option_field" >--</option>');
		$.get("<?php echo HOST ?>template/include/model_list/"+$(this).val().toLowerCase()+".php", function(data){
			$('select[name="altra_moto_modello_3"]').append(data);
			$('select[name="altra_moto_modello_3"]').append('<option value="OTHER" >OTHER</option>');
		});
	});

	$('#new_bike').click(function(e){
		$(this).hide();
		$('#altra_moto2').show();
		e.preventDefault();
		return false;
	});

	$('#new_bike2').click(function(e){
		$(this).hide();
		$('#altra_moto3').show();
		e.preventDefault();
		return false;
	});

	$('input[name="comprato"]').click(function(e){
		if($(this).val() == "si"){
			$('#quando_comprato').show();
			$('#cosa_comprato').show();
			$('#no_comprato').hide();
			$('#no_comprato select').val('');
			$('#no_comprato_altro').hide();
			$('#no_comprato_mancanza').hide();
			$('#no_comprato_altro').val('');
			$('#no_comprato_mancanza').val('');
		}else{
			$('#quando_comprato').hide();
			$('#quando_comprato select').val('');
			$('#cosa_comprato').hide();
			$('#cosa_comprato input').attr('checked', false);
			$('input[name="cosa_comprato_altro"]').hide();
			$('input[name="cosa_comprato_altro"]').val('');
			//no comprato
			$('#no_comprato').show();
		}
	});

	$('input[name="cosa_comprato"]').click(function(e){
		if($(this).val() == "altro"){
			if($('input[name="cosa_comprato_altro"]').is(':visible')){
				$('input[name="cosa_comprato_altro"]').hide();
			}else{
				$('input[name="cosa_comprato_altro"]').show();
			}
		}
	});

	$('select[name="no_comprato"]').change(function(event){
		$('#no_comprato_altro').hide();
		$('#no_comprato_mancanza').hide();
		$('#no_comprato_altro').val('');
		$('#no_comprato_mancanza').val('');
		switch($(this).val()){
  		case "non c e articolo che interessa":
				$('#no_comprato_mancanza').show();
  		break;
			case "altro":
				$('#no_comprato_altro').show();
  		break;
  	}
	});

	$('select[name="pref_casco"]').change(function(event){
		$('#casco_other').hide();
		switch($(this).val()){
  		case "OTHER":
				$('#casco_other').show();
  		break;
  	}
	});

	$('select[name="pref_giacca"]').change(function(event){
		$('#giacca_other').hide();
		switch($(this).val()){
			case "OTHER":
				$('#giacca_other').show();
			break;
		}
	});

	$('select[name="pref_guanti"]').change(function(event){
		$('#guanti_other').hide();
		switch($(this).val()){
			case "OTHER":
				$('#guanti_other').show();
			break;
		}
	});

  $('select[name="Type"]').change(function(event) {
  	switch($(this).val()){
  		case "FLAT TRACK SCHOOL":
				$('input[name="Noleggio_abb"]', $('.noleggio_abbigliamento')).addClass("check_required")
  		break;
  	}

		$('select[name="Evento"]').parent().html('<select name="Evento" class="required">'+
			'<option value="" selected="selected" class="option_field" ><?php echo $_SESSION["Trad"][52]; ?> *</option>'+
			'<option id="data1" value="14-05-2017">14-05-2017</option>'+
			'<option id="data2" value="18-06-2017">18-06-2017</option>'+
			'<option id="data3" value="23-07-2017">23-07-2017</option>'+
			'<option id="data4" value="10-09-2017">10-09-2017</option>'+
		'</select>');

		$.ajax({
			type: "POST",
			url: "<?php echo HOST ?>template/hwlib/actions/days_ver.php",
			dataType:"json",
			data: {
				'Type':$(this).val()
			},
			success: function(msg){
				console.log(JSON.stringify(msg));
			},
			error : function(XMLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown)
			}
		});
  });

  $(document).on('change','select[name="Evento"]',function(event) {
		$.ajax({
			type: "POST",
			url: "<?php echo HOST ?>template/hwlib/actions/days_ver.php",
			dataType:"json",
			data: {
				'Type':$('[name="Type"]').val(),
				'Evento':$(this).val()
			},
			success: function(msg){
				console.log(JSON.stringify(msg));
			},
			error : function(XMLHttpRequest, textStatus, errorThrown){
			}
		});
  })

  $('.cont_option_sub label').click(function(){
  	if(!$(this).parent().hasClass('disabled')){
    	if($('input',$(this).parent()).val()==2){
    		$('.opt_si',$(this).parents('.option_field:first')).slideDown('fast')
    		$('.opt_no',$(this).parents('.option_field:first')).slideUp('fast')
    	}else if($('input',$(this).parent()).val()==1){
			$('.opt_si',$(this).parents('.option_field:first')).slideUp('fast')
			$('.opt_no',$(this).parents('.option_field:first')).slideDown('fast')
    	}
    	$('input',$(this).parent()).trigger('click')
    }
  })
</script>


<script>
//invio della form
function hideThx(){
  $('.chiudi').click();
  $("#thanks_box").hide("slow");
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function validateForm(){
  var result = true;

  var values = {};
  $.each($('#iscrizione').serializeArray(), function(i, field) {
      values[field.name] = field.value;
  });


/*
	if(values['Accompagnatori'] > 0){
		$('input', $('.accompagnatori')).slice(3).each(function(){
			$(this).addClass('required')
		})
	}

	if($('[name="Noleggio"]:checked',$('.noleggio_moto')).val()==1){
		$('[name="Nolo_moto"]').addClass("required")
	}

  if (values['Privacy']!=1) {
		result = false
	}
 	if (values['Privacy1']!=1) {
		result = false
	};
	*/

	$('.required', $('#iscrizione')).each(function(){
		// console.log($(this).val())
		var val = $(this).val()
		if(val == null || val == "" || val == " "){
			//console.log($(this))
			result = false;
		}
	})


  return result;
}

$('.salva_iscrizione').click(function(){
	$('.validation').html("<?php echo $_SESSION["Trad"][217]; ?>");
	$('#data_nascita').val($('#b-dd').val()+$('#b-mm').val()+$('#b-yy').val());
	// console.log($('#data_nascita').val());
	if(validateForm()){
		$('.validation').hide();
		$('.salva_iscrizione').attr("disabled", true);
		$('#iscrizione').append('<input type="hidden" name="host" value="'+HOST+'">');
		 //console.log($( "#iscrizione" ).serialize());
		$.post( HOST+'template/hwlib/ApparelSurvey.php', $( "#iscrizione" ).serialize(), function(){}, 'json' ).done(function(data){
			console.log(JSON.stringify(data));
			if(data.res == 'ok'){
				$("#thanks_box").show("slow");
				$(".form_keepme .frm_cont_btn").hide();
				$(".form_keepme .cont_hide").hide();
				$(".form_keepme .cont_thanks").html("<?php echo $_SESSION["Trad"][216]; ?>");
				$('#iscrizione')[0].reset();
				// $.post( HOST+'template/hwlib/actions/invio_mail.php', {EMail: data.mail, msg: data.mail_msg}, function(){}, 'json' ).done(function(data){
				// 	console.log('email inviata');
				// });
			}else{
				console.log("# THERE WAS AN ERROR: " + data);
			}
		});
	}else{
		$('.validation').show();
	}
	return false;
});

$(function(){
	$('#lang_Español').hide();
	$('#lang_日本語').hide();
	$('#lang_Português').hide();
});

</script>
