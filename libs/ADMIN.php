<?php
/*******************************************************
* Copyright (C) 2005-2016 Francesco La Placa - hackweb
*
* This file is part of hwFramework.
*
* This Framework can not be copied and/or distributed without the express
* permission of author
******************************************************/

require_once("DB.php");
require_once('Encoding.php');   

use \ForceUTF8\Encoding;

class ADMIN extends DB
{    

    // function __construct() {
    //     parent::__construct();        
    // }

    // function __destruct(){
    //     parent::__destruct();
    // }     
    
    public $enc;

    function login($data){
        $data->password = md5($data->password);        
        $sess_id = rand();  
        // $this->sql_open();      
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }             
        $sql = "SELECT potere FROM scr_accounts WHERE password = ? AND username = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $data->password, $data->username);
        $stmt->execute();
        //$stmt->store_result();
        $stmt->bind_result($potere);
        $i=0;
        while($stmt->fetch()) {
            $_SESSION['username'] = $data->username;
            $_SESSION['potere'] = $potere;
            $i++;
        }
        if($i==1){
            $_SESSION['sess_id'] = $sess_id;
            $sql = 'UPDATE scr_accounts SET sess_id=? WHERE password=? AND username=?';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $sess_id,$data->password,$data->username);
            $stmt->execute();
            $result = array(
                'success'       => 1                            
            );                
            echo json_encode($result);            
        }else{
            echo '0';
        }
        $stmt->close();
        // $this->sql_close();
    }


    function checkLogin(){              
        $result = array();
        $result['username'] = '0';
        $result['potere'] = '-1';
        $result['admin_page_link'] = 'log_in.php';
        if(isset($_SESSION['username'])){                    
            $db = $this->conn;
            $sql = "SELECT username FROM scr_accounts WHERE sess_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s', $_SESSION['sess_id']);
            $stmt->execute();
            $stmt->bind_result($username);
            $i=0;
            while ($stmt->fetch()) {
                $i++;
            }
            if($i==1){
                $result['username'] = $_SESSION['username'];
                $result['potere'] = $_SESSION['potere'];
                $result['admin_page_link'] = 'welcome.php';
            }
            $stmt->close();            
        }
        return $result;
    }

    function overviewLoad($data){        
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);            
            exit();
        }             
        $sql = 'INSERT INTO brah_posts (title, subtitle, image) VALUES (?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $data->title, $data->subtitle, "files/file_upload/img/".$data->upload_files);
        $stmt->execute();                                
        echo '1';
        $stmt->close();        
    }

    function getTextSection($sez,$txt,$char = 'utf8'){                       
        $db = $this->conn;
        // echo $db->character_set_name();   
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }             
        $sql = "SELECT Titolo, Descr FROM testi WHERE Lang = ? AND Sezione = ? AND ContTxt = ?";        
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $_SESSION['lang'],$sez,$txt);        
        $stmt->execute();        
        $stmt->bind_result($titolo, $descr);       
        $result = array();               
        while($stmt->fetch()) {                                    
            $result[0] = html_entity_decode(htmlspecialchars_decode($titolo));            
            $result[1] = html_entity_decode(htmlspecialchars_decode($descr));                 
        }
        $stmt->close();                
        return $result;
    }

    function getTextGlobal($id,$char = 'utf8'){
        $db = $this->conn;        
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }                     
        $sql = "SELECT Nome_it, Nome_en, Nome_de, Nome_fr, Nome_es, Nome_jp, Nome_pt FROM testi_sistema WHERE ID = ?";        
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('s' ,$id);        
        $stmt->execute();               

        $stmt->bind_result($Nome_it,$Nome_en,$Nome_de,$Nome_fr,$Nome_es,$Nome_jp,$Nome_pt);              
        $result = array();               
        while($stmt->fetch()) {                                    
            $result['Nome_it'] = html_entity_decode(htmlspecialchars_decode($Nome_it));
            $result['Nome_en'] = html_entity_decode(htmlspecialchars_decode($Nome_en));       
            $result['Nome_de'] = html_entity_decode(htmlspecialchars_decode($Nome_de));       
            $result['Nome_fr'] = html_entity_decode(htmlspecialchars_decode($Nome_fr));       
            $result['Nome_es'] = html_entity_decode(htmlspecialchars_decode($Nome_es));       
            $result['Nome_jp'] = html_entity_decode(htmlspecialchars_decode($Nome_jp));       
            $result['Nome_pt'] = html_entity_decode(htmlspecialchars_decode($Nome_pt));                                         
        }

        // $res = $stmt->get_result(); 
        // $num_of_rows = $res->num_rows;

        // $result;
        // $temp = array();

        // while ($row = $res->fetch_assoc()) {
        //     foreach ($row as $key => $value) {
        //         $temp[$key] = html_entity_decode(htmlspecialchars_decode($value));               
        //     }
        //     $result = $temp;        
        // }
        
        $stmt->close();                
        return $result['Nome_'.$_SESSION['lang']];
    }

    function wrs($var){
        echo $_SESSION[$var];
    }

    function getPrezzo($categ, $char = 'utf8'){
        $prezzo = '';
        $country = $_SESSION['countryCode'];                

        $pre_text_prezzo=array(
        'it'=>'Prezzo: Da ',
        'us'=>'Price: From ',
        'ca'=>'Price: From ',
        'de'=>'Preis: Ab ',
        'es'=>'Precio: Desde ',
        'fr'=>'Prix: A partir de ',
        'gb'=>'Price: From ',
        'jp'=>'メーカー希望小売価格(消費税込）: ',
        'mx'=>'Precio: Desde ',
        'ch'=>'Preis: Ab ',
        'in'=>'Price: From '


        );
        $text_prezzo=array('it'=>' </br><small>Prezzo franco concessionario inclusa IVA 22%</small>',
        'us'=>' </br><small>Prices listed are the Manufacturer\'s Suggested Retail Prices. Prices exclude dealer setup, taxes, freight, title and licensing and are subject to change. Dealer prices may vary. Pricing and specifications are subject to change. Please contact your Authorized Ducati Dealership for the most current information.</small>',
        'ca'=>' </br><small>Prices listed are the Manufacturer\'s Suggested Retail Prices. Prices exclude dealer setup, taxes, title and licensing are subject to change. Dealer prices may vary. Pricing and specifications are subject to change. Please contact your Authorized Ducati Dealership for the most current information.</small>',
        'de'=>' </br><small>Listenpreis inkl. MwSt. zzgl. Liefernebenkosten (LNK i.H.v. 305 €). Ducati behält sich vor, die Preise jederzeit ohne vorherige Ankündigung zu ändern. Für Druckfehler übernimmt der Verfasser keine Haftung.</small>',
        'es'=>' </br><small>Precio de Venta al Público (P.V.P.) estimado. No incluye gastos de gestoría ni tasas de tráfico. Más información en tu Vendedor Autorizado Ducati.</small>',
        'fr'=>' </br><small>Toutes taxes comprises. Prix public conseillé clés en main, comprenant la préparation de la moto. Frais d\'immatriculation non inclus.</small>',
        'gb'=>' </br><small>Prices quoted are SRP\'s including 20% VAT and the cost of Pre Delivery Inspection. Registration fee, number plates and road fund licence are not included.</small>',
        'jp'=>' </br><small></small>',
        'mx'=>' </br><small>Precio de venta al público, IVA y transporte incluidos. Más información en tu concesionario autorizado Ducati. Precios y especificaciones estan sujetas a cambio. Por favor contacte con su Distribuidor Autorizado Ducati para una informacion actualizada.</small>',
        'ch'=>' <br><small>Listenpreis inkl. MwSt zzgl. 195.- CHF Transportpauschale inkl. LSVA. Ducati behält sich vor, die Preise jederzeit ohne vorherige Ankündigung zu ändern. Für Druckfehler übernimmt der Verfasser keine Haftung.</small>',
        'in'=>' </br><small>Prices listed are the Manufacturer\'s Suggested Retail Prices. Prices exclude dealer setup, taxes, freight, title and licensing and are subject to change. Dealer prices may vary. Pricing and specifications are subject to change. Please contact your Authorized Ducati Dealership for the most current information.</small>',
        );
        $moneta_prezzo=array('it'=>' €','us'=>' $','ca'=>' C$','de'=>' €','es'=>' €','fr'=>' €','gb'=>' £','jp'=>' ¥', 'mx'=>' MXN', 'ch'=>' CHF', 'in'=>' INR');

        if(isset($_SESSION['countryCode']) and $_SESSION['countryCode']!='' and array_key_exists($_SESSION['countryCode'], $pre_text_prezzo)){          
            if($categ == '1100'){
                $prezzo = '<table class="prices" style="display:none;">';
            }            

            $db = $this->conn;        
            $db->set_charset($char);
            if ($db->connect_errno) {
                echo("Connect failed: " . $db->connect_error);
                exit();
            }                                 
            $sql = 'SELECT ID, Moto, Colore, Prezzo_'.$country.' FROM moto WHERE Moto = ?';        
            $stmt = $db->prepare($sql);        
            $stmt->bind_param('s' ,$categ);        
            $stmt->execute();                   
            $stmt->bind_result($id,$moto,$colore,$prezzo_loc);              
            $result = array();    
            $i=0;           
            while($stmt->fetch()) {    
                if($categ == '1100'){
                    $i++;
                    $prezzo.='<tr class="riga-prezzo prezzo-'.$i.'">
                        <td>'.$colore.'</td><td>'.$pre_text_prezzo[$country].$prezzo_loc.$moneta_prezzo[$country].'</td>
                    </tr>';
                }else{
                    if($colore!=''){                                        
                        echo '<input class="hidden" colore="'.$colore.'" '.$colore.'="'.$prezzo_loc.'">';
                        $prezzo.='</br></br><span class="nome_prezzo">'.''.'</span> '.$colore.'</br></br>'.$pre_text_prezzo[$country].$prezzo_loc.$moneta_prezzo[$country].'</span>';
                    }else{
                        $prezzo='</br></br>'.$pre_text_prezzo[$country].$prezzo_loc.$moneta_prezzo[$country].'</span>';
                    }
                }                                                                                         
            }            

            if($categ == '1100'){  
                $prezzo .= '<tr><td colspan="2" style="background-color:#fff;" class="nota-peso">' . $text_prezzo[$country] . '</td></tr>';
            }else{
                $prezzo.=$text_prezzo[$country];
            }  
            if($categ == '1100'){  
                $prezzo .= '</table>';
            }
        }

        return $prezzo;
    }

    function getAccessories($data = '', $char = 'utf8'){
        $lang = $_SESSION['lang'];
        $country = $_SESSION['countryCode'];   
        if($country == '') $country = 'it';
        if($lang == 'jp') $char = 'latin1';
        $db = $this->conn;        
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }                     
        $countryNotListed = false;        
        if($country != 'it' && $country != 'us' && $country != 'ca' && $country != 'de' && $country != 'be' && $country != 'lu' && $country != 'es' && $country != 'nl' && $country != 'fr' && $country != 'jp' && $country != 'gb' && $country != 'mx'){
            $country = 'it';
            $countryNotListed = true;
        }
        $sql = 'SELECT ID, Code, appl, Type, Ord, Shop, Donna, IsNew, Home, Inv_Over, Nome_'.$lang.', Descr_'.$lang.', Prezzo_'.$country.', Nome_it AS nome2 FROM accessori
        WHERE Type = 2
        ORDER BY Ord';                
        $stmt = $db->prepare($sql);        
        // $stmt->bind_param('s' ,$id);
        $stmt->execute();               

        $stmt->bind_result($id,$code,$appl,$type,$ord,$shop,$donna,$isnew,$home,$inv_over,$nome,$descr,$prezzo,$nome2);              
        $result = array();               
        while($stmt->fetch()) {                             
            if(file_exists('../immagini/accessori/accessori/mosaico/'.$code.'.png')){                                                                                     
                $nome = html_entity_decode($nome);
                $nome2 = html_entity_decode($nome2);
                $descr = html_entity_decode($descr);
                if($countryNotListed) $prezzo = "";
                echo 
                '
                <li>
                    <a role="button" item_id="'.$id.'" code="'.$code.'" nome="'.$nome2.'" href="'.$code.'"></a><img src="immagini/accessori/accessori/mosaico/'.$code.'.png" alt="'.$nome.'">
                    <div class="over">
                ';
                if($isnew == 1){
                    echo 
                    '
                        <div class="new_img">
                            <img src="immagini/new_icon.png" alt="">
                        </div>
                    ';
                }
                echo 
                '                        
                        <div class="cont_txt">
                            <span>
                                '.$nome.'
                            </span>
                            <hr>
                        </div>
                    </div>
                </li>
                ';    
            }        
        }
        $stmt->close();                
    }

    function getAccessory($data = '', $char = 'utf8',$text_prezzo2,$text_prezzo,$pre_prezzo){
        // $lang = $_SESSION['lang'];
        // $country = $_SESSION['countryCode'];
        $lang = $data->lang;
        $country = $data->country;    
        if($country == '') $country = 'it';
        if($lang == '') $lang = 'it';
        if($lang == 'jp') $char = 'latin1';
        $db = $this->conn;        
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }                
        $countryNotListed = false;        
        if($country != 'it' && $country != 'us' && $country != 'ca' && $country != 'de' && $country != 'be' && $country != 'lu' && $country != 'es' && $country != 'nl' && $country != 'fr' && $country != 'jp' && $country != 'gb' && $country != 'mx'){
            $country = 'it';
            $countryNotListed = true;
        }     
        $sql = 'SELECT ID, Code, appl, Type, Ord, Shop, Donna, IsNew, Home, Inv_Over, Nome_'.$lang.', Descr_'.$lang.', Prezzo_'.$country.', Nome_it AS nome2 FROM accessori 
        WHERE Type = 2 AND ID = ?';                        
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('s',$data->id);
        $stmt->execute();               

        $stmt->bind_result($id,$code,$appl,$type,$ord,$shop,$donna,$isnew,$home,$inv_over,$nome,$descr,$prezzo,$nome2);              
        $result = array();               
        while($stmt->fetch()) {                             
            if(file_exists('../immagini/accessori/accessori/mosaico/'.$code.'.png')){                                                                                     
                $nome = html_entity_decode($nome);
                $nome2 = html_entity_decode($nome2);
                $descr = html_entity_decode($descr);
                if($countryNotListed) $prezzo = "";
                if(file_exists('../immagini/accessori/accessori/'.$code.'.png')){
                    $ext='.png';
                }else{
                    $ext='.jpg';
                }
                if (isset($prezzo) and $prezzo!='' and $prezzo!='0.00' and $prezzo!=',00' and $prezzo!='.00'){
                    $prezzo='</br></br>'.$text_prezzo2.': '.$pre_prezzo.$prezzo.$text_prezzo[$type][strtolower($country)];                    
                }else{
                    $prezzo = '';
                }

                echo '
                <div class="cont_txt">
                    <div class="cont_descr">
                        <h1>'.$nome.'</h1>
                        <hr>
                        '.$descr.(($appl) ? '<br><br>'.$appl : '').$prezzo.'                      
                    </div>
                ';

                echo '
                </div>
                <img src="immagini/accessori/accessori/'.$code.$ext.'" alt="'.$nome2.'">
                ';              
            }        
        }
        $stmt->close();   
    }


    function getApparels($data = '', $char = 'utf8'){        
        $lang = $_SESSION['lang'];        
        $country = $_SESSION['countryCode'];   
        if($country == '') $country = 'it';
        if($lang == 'jp') $char = 'latin1';

        $db = $this->conn;        
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }       
        $countryNotListed = false;        
        if($country != 'it' && $country != 'us' && $country != 'ca' && $country != 'de' && $country != 'be' && $country != 'lu' && $country != 'es' && $country != 'nl' && $country != 'fr' && $country != 'jp' && $country != 'gb' && $country != 'mx'){
            $country = 'it';
            $countryNotListed = true;
        }
        $sql = 'SELECT ID, Code, appl, Type, Ord, Shop, Donna, IsNew, Home, Inv_Over, Nome_'.$lang.', Descr_'.$lang.', Prezzo_'.$country.', Nome_it AS nome2 FROM accessori
        WHERE Type = 1
        ORDER BY Ord';                
        $stmt = $db->prepare($sql);        
        // $stmt->bind_param('s' ,$id);
        $stmt->execute();               

        $stmt->bind_result($id,$code,$appl,$type,$ord,$shop,$donna,$isnew,$home,$inv_over,$nome,$descr,$prezzo,$nome2);              
        $result = array();               
        while($stmt->fetch()) {                             
            if(file_exists('../immagini/accessori/accessori/mosaico/'.$code.'.png')){    
                if($countryNotListed) $prezzo = '';                                                                                 
                $nome = html_entity_decode($nome);
                $nome2 = html_entity_decode($nome2);
                $descr = html_entity_decode($descr);
                echo 
                '
                <li>
                    <a role="button" item_id="'.$id.'" code="'.$code.'" nome="'.$nome2.'" href="'.$code.'"></a><img src="immagini/accessori/accessori/mosaico/'.$code.'.png" alt="'.$nome.'">
                    <div class="over">
                ';
                if($isnew == 1){
                    echo 
                    '
                        <div class="new_img">
                            <img src="immagini/new_icon.png" alt="">
                        </div>
                    ';
                }
                echo 
                '                        
                        <div class="cont_txt">
                            <span>
                                '.$nome.'
                            </span>
                            <hr>
                        </div>
                    </div>
                </li>
                ';    
            }        
        }
        $stmt->close();                
    }


    function getApparel($data = '', $char = 'utf8',$text_prezzo2,$text_prezzo,$pre_prezzo){
                
        $lang = $data->lang;
        $country = $data->country;         
        
        $buy_text = $this->getTextGlobal(25);
        if($country == '') $country = 'it';
        if($lang == '') $lang = 'it';
        if($lang == 'jp') $char = 'latin1';
        $db = $this->conn;        
        $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }          
        
        $countryNotListed = false;        
        if($country != 'it' && $country != 'us' && $country != 'ca' && $country != 'de' && $country != 'be' && $country != 'lu' && $country != 'es' && $country != 'nl' && $country != 'fr' && $country != 'jp' && $country != 'gb' && $country != 'mx'){
            $country = 'it';
            $countryNotListed = true;
        }
        
        $sql = 'SELECT ID, Code, appl, Type, Ord, Shop, Donna, IsNew, Home, Inv_Over, Nome_'.$lang.', Descr_'.$lang.', Prezzo_'.$country.', Nome_it AS nome2 FROM accessori 
        WHERE Type = 1 AND ID = ?';                        
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('s',$data->id);
        $stmt->execute();               

        $stmt->bind_result($id,$code,$appl,$type,$ord,$shop,$donna,$isnew,$home,$inv_over,$nome,$descr,$prezzo,$nome2);              
        $result = array();               
        while($stmt->fetch()) {                             
            if(file_exists('../immagini/accessori/accessori/mosaico/'.$code.'.png')){                                                                                     
                $nome = html_entity_decode($nome);
                $nome2 = html_entity_decode($nome2);
                $descr = html_entity_decode($descr);
                if(file_exists('../immagini/accessori/accessori/'.$code.'.png')){
                    $ext='.png';
                }else{
                    $ext='.jpg';
                }
                if (isset($prezzo) and $prezzo!='' and $prezzo!='0.00' and $prezzo!=',00' and $prezzo!='.00'){
                    $prezzo='</br></br>'.$text_prezzo2.': '.$pre_prezzo.$prezzo.$text_prezzo[$type][strtolower($country)];                    
                }else{
                    $prezzo = '';
                }

                if($countryNotListed) $prezzo = '';   

                echo '
                <div class="cont_txt">
                    <div class="cont_descr">
                        <h1>'.$nome.'</h1>
                        <hr>
                        '.$descr.$prezzo.'                           
                    </div>
                    <div id="lang" style="display:none;">'.$_SESSION['lang'].'</div>
                ';

                echo(($donna) ? '<img src="immagini/woman.png" alt="Donna">' : '') .
			    (($shop!='' and $lang!='jp') ? '<a class="btn flLeft clLeft" rel="nofollow" target="_blank" href="'.$shop.'">'.$buy_text.'</a>' : '');

                echo '
                </div>
                <img src="immagini/accessori/accessori/'.$code.$ext.'" alt="'.$nome2.'">
                ';              
            }        
        }
        $stmt->close();   
    }

    //hashtag

    function hashtagTeasingFormRegister($data){
        $db = $this->conn;
        $db->set_charset('latin1');
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);            
            exit();
        }             
        $sql = 'INSERT INTO scr_hash (Contact, Country) VALUES (?, ?)';
        // $sql = 'SELECT email FROM hashtag_teasing';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $data->email, $data->country);
        $stmt->execute();
        echo '1';
        // $stmt->bind_result($email);  
        // while($stmt->fetch()) {
        //     echo $email;
        // }        
        $stmt->close(); 
    }

    function hashtagGetTotal(){
        $db = $this->conn;
        $sql = "SELECT
        COUNT(*) AS Tot, 
        ( (SELECT COUNT(*) FROM scr_hash WHERE Country='Germany') * 100 ) / COUNT(*) AS dePerc,
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Germany') AS deTot,
        ( (SELECT COUNT(*) FROM scr_hash WHERE Country='Italy') * 100 ) / COUNT(*) AS itPerc,
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Italy') AS itTot,
        ( (SELECT COUNT(*) FROM scr_hash WHERE Country='France') * 100 ) / COUNT(*) AS frPerc,
        (SELECT COUNT(*) FROM scr_hash WHERE Country='France') AS frTot,
        ( (SELECT COUNT(*) FROM scr_hash WHERE Country='Spain') * 100 ) / COUNT(*) AS esPerc,
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Spain') AS esTot,
        ( (SELECT COUNT(*) FROM scr_hash WHERE Country='Portugal') * 100 ) / COUNT(*) AS ptPerc,
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Portugal') AS ptTot,

        ( (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE '%ducati.%') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE '%ducati.%'),

        (SELECT COUNT(*) FROM scr_hash WHERE added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00'),
        (SELECT COUNT(*) FROM scr_hash WHERE added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16'),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Italy' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Germany' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='France' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Spain' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Portugal' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Italy' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Germany' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='France' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Spain' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Portugal' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE added LIKE '%2018-02-09%'),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Italy' AND (added LIKE '%2018-02-09%')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Germany' AND (added LIKE '%2018-02-09%')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='France' AND (added LIKE '%2018-02-09%')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Spain' AND (added LIKE '%2018-02-09%')),
        (SELECT COUNT(*) FROM scr_hash WHERE Country='Portugal' AND (added LIKE '%2018-02-09%')),

        (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE '%ducati.%' AND (added='2018-02-08 10:56:16' OR added='0000-00-00 00:00:00')),
        (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE '%ducati.%' AND (added LIKE '%2018-02-08%' AND added!='2018-02-08 10:56:16')),
        (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE '%ducati.%' AND (added LIKE '%2018-02-09%'))

        FROM scr_hash";        
        $stmt = $db->prepare($sql);              
        $stmt->execute();
        $stmt->bind_result($total,$dePerc,$deTot,$itPerc,$itTot,$frPerc,$frTot,$esPerc,$esTot,$ptPerc,$ptTot,$duPerc,$duTot,$day1,$day2,$day1It,$day1De,$day1Fr,$day1Es,$day1Pt,
        $day2It,$day2De,$day2Fr,$day2Es,$day2Pt,
        $day3,$day3It,$day3De,$day3Fr,$day3Es,$day3Pt,
        $day7Du,$day8Du,$day9Du);                               
        while($stmt->fetch()) {
            $result = array(
                'total' => $total,
                'it' => $itTot.' ( '.round($itPerc).'% )',
                'de' => $deTot.' ( '.round($dePerc).'% )',
                'fr' => $frTot.' ( '.round($frPerc).'% )',
                'es' => $esTot.' ( '.round($esPerc).'% )',
                'pt' => $ptTot.' ( '.round($ptPerc).'% )',
                'du' => $duTot.' ( '.round($duPerc).'% )',
                'day7' => $day1,                                
                'day8' => $day2,
                'day7_it' => $day1It,
                'day7_de' => $day1De,
                'day7_fr' => $day1Fr,
                'day7_es' => $day1Es,
                'day7_pt' => $day1Pt,
                'day8_it' => $day2It,
                'day8_de' => $day2De,
                'day8_fr' => $day2Fr,
                'day8_es' => $day2Es,
                'day8_pt' => $day2Pt,
                'day9' => $day3,
                'day9_it' => $day3It,
                'day9_de' => $day3De,
                'day9_fr' => $day3Fr,
                'day9_es' => $day3Es,
                'day9_pt' => $day3Pt,
                'day7_du' => $day7Du,
                'day8_du' => $day8Du,
                'day9_du' => $day9Du
            );
        }

        $days = 6;
        for($i=0; $i<$days; $i++){
            $day = $i+10;
            $sql = 'SELECT
            (SELECT COUNT(*) FROM scr_hash WHERE added LIKE "%2018-02-'.$day.'%"),
            (SELECT COUNT(*) FROM scr_hash WHERE Country="Italy" AND (added LIKE "%2018-02-'.$day.'%")),
            (SELECT COUNT(*) FROM scr_hash WHERE Country="Germany" AND (added LIKE "%2018-02-'.$day.'%")),
            (SELECT COUNT(*) FROM scr_hash WHERE Country="France" AND (added LIKE "%2018-02-'.$day.'%")),
            (SELECT COUNT(*) FROM scr_hash WHERE Country="Spain" AND (added LIKE "%2018-02-'.$day.'%")),
            (SELECT COUNT(*) FROM scr_hash WHERE Country="Portugal" AND (added LIKE "%2018-02-'.$day.'%")),
            (SELECT COUNT(*) FROM scr_hash WHERE Contact LIKE "%ducati.%" AND (added LIKE "%2018-02-'.$day.'%"))
            FROM scr_hash';  
            $stmt = $db->prepare($sql);              
            $stmt->execute();
            $stmt->bind_result($dayTot,$dayIt,$dayDe,$dayFr,$dayEs,$dayPt,$dayDu);
            while($stmt->fetch()) {
                $result['day'.$day] = $dayTot;
                $result['day'.$day.'_it'] = $dayIt;
                $result['day'.$day.'_de'] = $dayDe;
                $result['day'.$day.'_fr'] = $dayFr;
                $result['day'.$day.'_es'] = $dayEs;
                $result['day'.$day.'_pt'] = $dayPt;
                $result['day'.$day.'_du'] = $dayDu;
            }
        }
        // print_r($result);
        // echo json_encode($result);
        return $result;
    }

    function hashtagGetAllElements(){
        $db = $this->conn;                
        $sql = "SELECT ID,Contact,Country,added FROM scr_hash ORDER BY added DESC";        
        $stmt = $db->prepare($sql);              
        $stmt->execute();       
        
        $stmt->bind_result($id,$contact,$country,$added); 
        $i = 0;                             
        while($stmt->fetch()) {                                    
            $i++;
            if($added == '2018-02-08 10:56:16' || $added == '0000-00-00 00:00:00'){
                $added = '2018-02-07';
            }else{
                $added = str_split($added, 10)[0]; 
            }
            echo '<tr val="'.$id.'" ord="'.$id.'">';  
            // if(empty($image))
            //     echo '<td class="align-middle">video</td>';
            // else
            //     echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$image.'" class="rounded float-left" alt="'.$image.'"></td>';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';                 
            echo '<td class="align-middle">'.$contact.'</td>';
            echo '<td class="align-middle">'.$country.'</td>';
            // $status2 = ($status == 1) ? 0 : 1;
            // echo ($status == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';        
            echo '<td class="table-200">'.$added.'</td>';                                            
            // echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';
            // echo '<td class="table-short table-activate align-middle" val="'.$status2.'">';
            // echo ($status == 1) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';            
            // echo '<td class="table-short align-middle"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';            
            echo '</tr>';              
        }

        $stmt->close();                        
    }



    function hashtagDeleteElement($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'DELETE FROM brah_posts WHERE id=?';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('s', $data->id);
        $stmt->execute(); 
        $stmt->close();
    }

    function overviewChangeElementStatus($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'UPDATE brah_posts SET status=? WHERE id=?';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('ss', $data->status, $data->id);
        $stmt->execute();         

        $status = ($data->status == 1) ? 0 : 1;                        
        $result = array(
            'success'       => 1,
            'status'        => $status            
        );        
        if($status == 1){
            $result['text1'] = "Activate";
            $result['text2'] = "Offline";
            $result['class1'] = "success";  
            $result['class2'] = "danger";            
        }else{
            $result['text1'] = "Deactivate";
            $result['text2'] = "Online";
            $result['class1'] = "secondary";
            $result['class2'] = "success";
        }       
        echo json_encode($result);
        $stmt->close();  
    }

    function overviewEditElement($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'UPDATE brah_posts SET title=?, subtitle=? WHERE id=?';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->id);
        $stmt->execute();         
                                    
        $result = array(
            'success'       => 1                        
        );               
        echo json_encode($result);
        $stmt->close();  
    }

    function loadStories($data){
        $db = $this->conn;                
        $sql = "SELECT id,title,img,tags,cat,content,added 
        FROM brah_stories 
        WHERE status = 1 
        ORDER BY added DESC";        
        $stmt = $db->prepare($sql);                      
        $stmt->execute();       

        $stmt->bind_result($id,$title,$img,$tags,$cat,$content,$added); 
        $i = 0;                     
        while($stmt->fetch()) {                                    
            $i++;
            $added = strtotime( $added );
            $added = date( 'Y-m-d', $added );
            echo 
            '
            <div id="'.$id.'" class="stories-cell">
                <div class="stories-img">
                    <a class="stories-link" href="'.$id.'">
                        <img src="'.$img.'" alt="'.$title.'" class="">
                    </a>
                </div>
                <div class="stories-cat">';

            $cat = explode(',', $cat);     
            $cat_length = count($cat);   
            foreach($cat as $key => $value){
                $key++;
                if($cat_length === $key){
                    echo '<a >'.$value.' </a>';
                }else{
                    echo '<a >'.$value.' / </a>';
                }
            }

            echo '
                </div>
                <div class="stories-title">
                    <a class="stories-link" href="'.$id.'" title="'.$title.'">'.$title.'</a>
                </div>
                <hr class="stories-hr">
                <div class="stories-detail">'.$added.'</div>
            </div>
            ';   
        }                
        $stmt->close();                        
    }

    function daysGetAllElements(){
        $db = $this->conn;                
        $sql = "SELECT id,Nome,Cognome,EMail,Birthdate,Nazione,Cap,Cell,Type,Evento,Patente,NPatente,Noleggio,Nolo_moto,Noleggio_abb,Nolo_giacca,Nolo_stivali,Nolo_guanti,
        Extra, Accompagnatori, Conoscenza,AltraMoto, Modello,Immatricolazione,Prezzo,Privacy,Privacy1,Insert_Date,Disattivato,codice_fiscale,residenza,luogo_nascita FROM days_of_joy ORDER BY Insert_Date DESC";        
        $stmt = $db->prepare($sql);              
        $stmt->execute();       
        
        $stmt->bind_result($id,$nome,$cognome,$email,$birthdate,$nazione,$cap,$cell,$type,$evento,$patente,$npatente,$noleggio,$nolomoto,$noleggioabb,$nologiacca,$nolostivali,
        $nologuanti,$extra,$accompagnatori,$conoscenza,$altramoto,$modello,$immatricolazione,$prezzo,$privacy,$privacy1,$added,$disattivato,$codice_fiscale,$residenza,$luogo_nascita); 
        $i = 0;                             
        while($stmt->fetch()) {                                    
            $i++;

            $prezzo = str_replace('.00', '', $prezzo);
            // if($added == '2018-02-08 10:56:16' || $added == '0000-00-00 00:00:00'){
            //     $added = '2018-02-07';
            // }else{
            //     $added = str_split($added, 10)[0]; 
            // }
            echo '<tr val="'.$id.'" ord="'.$id.'">';  
            // if(empty($image))
            //     echo '<td class="align-middle">video</td>';
            // else
            //     echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$image.'" class="rounded float-left" alt="'.$image.'"></td>';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';                 
            echo '<td class="align-middle">'.$nome.'</td>';
            echo '<td class="align-middle">'.$cognome.'</td>';
            echo '<td class="align-middle">'.$email.'</td>';
            echo '<td class="align-middle">'.$birthdate.'</td>';
            echo '<td class="align-middle">'.$luogo_nascita.'</td>';
            echo '<td class="align-middle">'.$codice_fiscale.'</td>';      
            echo '<td class="align-middle">'.$residenza.'</td>';      
            echo '<td class="align-middle">'.$nazione.'</td>';
            echo '<td class="align-middle">'.$cap.'</td>';
            echo '<td class="align-middle">'.$cell.'</td>';
            echo '<td class="align-middle">'.$type.'</td>';
            echo '<td class="align-middle">'.$evento.'</td>';
            echo '<td class="align-middle">'.(($patente == '2') ? 'si' : 'no').'</td>';
            echo '<td class="align-middle">'.$npatente.'</td>';
            echo '<td class="align-middle">'.(($noleggio == '2') ? 'si' : 'no').'</td>';
            //echo '<td class="align-middle">'.$nolomoto.'</td>';
            echo '<td class="align-middle">'.(($noleggioabb == '2') ? 'si' : 'no').'</td>';
            echo '<td class="align-middle">'.(($nologiacca == '0') ? '-' : $nologiacca).'</td>';
            echo '<td class="align-middle">'.(($nolostivali == '0') ? '-' : $nolostivali).'</td>';
            echo '<td class="align-middle">'.(($nologuanti == '0') ? '-' : $nologuanti).'</td>';
            echo '<td class="align-middle">'.(($extra == '2') ? 'si' : 'no').'</td>';
            echo '<td class="align-middle">'.$accompagnatori.'</td>';
            echo '<td class="align-middle">'.$conoscenza.'</td>';
            echo '<td class="align-middle">'.(($altramoto == '2') ? 'si' : 'no').'</td>';
            echo '<td class="align-middle">'.$modello.'</td>';
            echo '<td class="align-middle">'.$immatricolazione.'</td>';
            echo '<td class="align-middle">'.$prezzo.'</td>';
            //echo '<td class="align-middle">'.$privacy.'</td>';
            echo '<td class="align-middle">'.(($privacy1 == '0') ? 'no' : 'si').'</td>';
            //echo '<td class="align-middle">'.$disattivato.'</td>';            
            echo '<td class="table-200">'.$added.'</td>';             
            // $status2 = ($status == 1) ? 0 : 1;
            // echo ($status == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';                                                             
            // echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';
            // echo '<td class="table-short table-activate align-middle" val="'.$status2.'">';
            // echo ($status == 1) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';            
            // echo '<td class="table-short align-middle"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';            
            echo '</tr>';              
        }

        $stmt->close();                        
    }


    function daysGetAnalytics(){
        $db = $this->conn;
        $sql = "SELECT
        COUNT(*) AS Tot, 
        (SELECT COUNT(*) FROM days_of_joy WHERE Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='DESERT SLED SCHOOL' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK SCHOOL' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='FLAT TRACK PRO SCHOOL' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='GIRLS DRIVING SCHOOL' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='ATTIVITA EXTRA' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='TEST RIDE' AND Evento='16-09-2018'),

        ( (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO') * 100 ) / COUNT(*),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO' AND Evento='06-05-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO' AND Evento='10-06-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO' AND Evento='15-07-2018'),
        (SELECT COUNT(*) FROM days_of_joy WHERE Type='PRANZO' AND Evento='16-09-2018')
         
        FROM days_of_joy";        
        $stmt = $db->prepare($sql);              
        $stmt->execute();
        $stmt->bind_result($total,$totalMay,$totalJune,$totalJuly,$totalSep,
        $offPerc,$offTot,$offMay,$offJune,$offJuly,$offSep,
        $flatPerc,$flatTot,$flatMay,$flatJune,$flatJuly,$flatSep,
        $flatProPerc,$flatProTot,$flatProMay,$flatProJune,$flatProJuly,$flatProSep,
        $basePerc,$baseTot,$baseMay,$baseJune,$baseJuly,$baseSep,
        $extraPerc,$extraTot,$extraMay,$extraJune,$extraJuly,$extraSep,
        $testPerc,$testTot,$testMay,$testJune,$testJuly,$testSep,
        $pranzoPerc,$pranzoTot,$pranzoMay,$pranzoJune,$pranzoJuly,$pranzoSep
        );                               
        while($stmt->fetch()) {
            $result = array(
                'total' => $total,
                'totalMay' => $totalMay,
                'totalJune' => $totalJune,
                'totalJuly' => $totalJuly,
                'totalSep' => $totalSep,

                'offTot' => $offTot.' ( '.round($offPerc).'% )',
                'offMay' => $offMay,
                'offJune' => $offJune,
                'offJuly' => $offJuly,
                'offSep' => $offSep,
                
                'flatTot' => $flatTot.' ( '.round($flatPerc).'% )',
                'flatMay' => $flatMay,
                'flatJune' => $flatJune,
                'flatJuly' => $flatJuly,
                'flatSep' => $flatSep,

                'flatProTot' => $flatProTot.' ( '.round($flatProPerc).'% )',
                'flatProMay' => $flatProMay,
                'flatProJune' => $flatProJune,
                'flatProJuly' => $flatProJuly,
                'flatProSep' => $flatProSep,

                'baseTot' => $baseTot.' ( '.round($basePerc).'% )',
                'baseMay' => $baseMay,
                'baseJune' => $baseJune,
                'baseJuly' => $baseJuly,
                'baseSep' => $baseSep,

                'extraTot' => $extraTot.' ( '.round($extraPerc).'% )',
                'extraMay' => $extraMay,
                'extraJune' => $extraJune,
                'extraJuly' => $extraJuly,
                'extraSep' => $extraSep,

                'testTot' => $testTot.' ( '.round($testPerc).'% )',
                'testMay' => $testMay,
                'testJune' => $testJune,
                'testJuly' => $testJuly,
                'testSep' => $testSep,

                'pranzoTot' => $pranzoTot.' ( '.round($pranzoPerc).'% )',
                'pranzoMay' => $pranzoMay,
                'pranzoJune' => $pranzoJune,
                'pranzoJuly' => $pranzoJuly,
                'pranzoSep' => $pranzoSep
            );
        }        
        return $result;
    }

}

?>


