<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

@$online = $request->online;
@$name = $request->name;
@$lat = $request->lat;
@$lng = $request->lng;
@$long = $request->long;
@$action = $request->action;
@$user = $request->user;
@$pass = $request->pass;
@$email = $request->email;
@$age = $request->age;
@$gender = $request->gender;
@$id = $request->id;
@$value = $request->value;
@$limit = $request->limit;
@$search = $request->search;
@$filter = $request->filter;
@$day = $request->day;
@$day_value = $request->day_value;
@$descrizione = $request->descrizione;
@$indirizzo = $request->indirizzo;
@$foto = $request->foto;
@$tipo = $request->tipo;
@$feed_users = $request->feed_users;
@$city = $request->city;
@$tempo = $request->tempo;
@$rec_username = $request->rec_username;
@$rec_points = $request->rec_points;
@$my_lat = $request->my_lat;
@$my_lng = $request->my_lng;
@$distance = $request->distance;
@$fb_username = $request->fb_username;
@$my_id = $request->my_id;
@$user_id = $request->user_id;
@$place_id = $request->place_id;
@$prova = $request->prova;
@$send_id = $request->send_id;
@$var_data = $request->var_data;
@$locale = $request->locale;
@$range = $request->range;
@$marker_id = $request->marker_id;
@$private = $request->private;
@$accuracy = $request->accuracy;
@$audio = $request->audio;
@$num = $request->num;
@$order = $request->order;
@$order2 = $request->order2;
@$description = $request->description;
@$post_id = $request->post_id;
@$comment = $request->comment;
@$data = $request->data;


class Accounts{

    //variabili
    private $conn;

    //costruttori
    function __construct(){
        $this->conn = new mysqli("62.149.150.193", "Sql677570", "0aae578b", "Sql677570_5");
        $this->conn->autocommit(FALSE);
    }

    function __destruct(){
        $this->conn->close();
    }
    //fine costruttori

    //funzioni generiche
    function timeElapsed($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ' : 'just now';
    }

    function truncate($string,$length=100,$append="...") {
        $string = trim($string);
      
        if(strlen($string) > $length) {
          $string = wordwrap($string, $length);
          $string = explode("\n", $string, 2);
          $string = $string[0] . $append;
        }
      
        return $string;
      }
    //funzioni generiche -- END

    //add push token to user
    function addPushToken($user_id, $token){
        $db = $this->conn;
        $sql = 'UPDATE paw_account SET token = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $token, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    //remove push token from user
    function removePushToken($user_id){
        $db = $this->conn;
        $sql = 'UPDATE paw_account SET token = NULL WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->close();
    }

    function updateMe($name,$lat,$long,$online, $username){
        $db = $this->conn;
        //$sql = 'INSERT INTO paw_account (user) VALUES (?) ON DUPLICATE KEY UPDATE lat = ?, lng = ?, online = ?';
        //'UPDATE paw_account SET lat = ?, lng = ? WHERE nome = ?';
        $sql = 'UPDATE paw_account SET lat = ?, lng = ?, online = ? WHERE user = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', $lat,$long,$online,$username);
        $stmt->execute();
        $stmt->close();
        echo("completed. " . $username);
    }

    function updAddresses($id,$lat,$long){
        $db = $this->conn;
        $sql = 'UPDATE paw_places SET lat = ?, lng = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $lat,$long,$id);
        $stmt->execute();
        $stmt->close();
        echo("completed: " . $id . " lat: " . $lat . " lng: " . $long);
    }

    function updOth($name, $username){
        $db = $this->conn;
        $sql = 'SELECT lat, lng, device, online FROM paw_account WHERE user <> ?';
        //'UPDATE paw_account SET lat = ?, lng = ? WHERE nome = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $device, $online);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"             => $lat,
                "lng"             => $lng,
                "device"          => utf8_encode($device),
                "online"          => $online
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento eventi
    function updEvents($tempo, $my_lat, $my_lng, $distance){
        $db = $this->conn;
        //ha bisogno dell'ordine DESC per la lista basata sulla data (time) dell'evento
        $sql = 'SELECT lat, lng, online, name, img, address, place, description, time, males, females, average, id, placename, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza, raggio FROM paw_events WHERE time > ? HAVING distanza < raggio ORDER BY distanza';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ddds', $my_lat, $my_lng, $my_lat, $tempo);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $online, $name, $img, $address, $place, $description, $time, $males, $females, $average, $id, $placename, $distanza, $raggio);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "online"            => $online,
                "img"               => $img,
                "address"           => utf8_encode($address),
                "place"             => $place,
                "description"       => utf8_encode($description),
                "time"              => $time,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "id"                => $id,
                "placename"         => $placename
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento locali
    function updPlaces($my_lat, $my_lng, $distance){
        $db = $this->conn;
        //funzione di ricerca con emisenoverso in mysql //thankyou google //distanza di 50 km
        $sql2 = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, feed_users, type, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza FROM paw_places HAVING distanza < ? ORDER BY distanza";
        //$sql = 'SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, feed_users, type, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set FROM paw_places ORDER BY id';
        $stmt = $db->prepare($sql2);
        $stmt->bind_param('ddds', $my_lat, $my_lng, $my_lat, $distance);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $feed_users, $type, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $distanza);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => utf8_encode($img),
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => utf8_encode($cover),
                "feedback"          => $feedback,
                "feed_users"        => $feed_users,
                "type"              => $type,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento singolo locale
    function updPlace($id, $user_id){
        $db = $this->conn;
        $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, feed_users, type, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places LEFT JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id GROUP BY name HAVING id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $user_id, $id);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $feed_users, $type, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $likedPlace);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => utf8_encode($img),
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => utf8_encode($cover),
                "feedback"          => $feedback,
                "feed_users"        => $feed_users,
                "type"              => $type,
                "likedPlace"        => $likedPlace,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento singolo evento
    function updEvent($id){
        $db = $this->conn;
        $sql = 'SELECT males, females, average, name, img, address, placename, time, description FROM paw_events WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($males, $females, $average, $name, $img, $address, $placename, $time, $description);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "males"            => $males,
                "females"          => $females,
                "average"          => $average,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "placename"         => $placename,
                "time"              => $time,
                "description"       => utf8_encode($description)
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento persone nel locale
    function updPeoplePlaces($id, $value, $gender, $age, $day, $day_value){
        if($age != 0){
            if($gender == "M"){
                $sql = 'UPDATE paw_places SET males = males + ?, average = (average + ?)/2, ' . $day . ' = ' . $day . ' + ? WHERE id = ?';
            }else if($gender == "F"){
                $sql = 'UPDATE paw_places SET females = females + ?, average = (average + ?)/2, ' . $day . ' = ' . $day . ' + ? WHERE id = ?';
            }
        }else{
            if($gender == "M"){
                $sql = 'UPDATE paw_places SET males = males + ?, average = IF((males + females) < 1, 0, (average + ?)), ' . $day . ' = ' . $day . ' + ? WHERE id = ?';
            }else if($gender == "F"){
                $sql = 'UPDATE paw_places SET females = females + ?, average = IF((males + females) < 1, 0, (average + ?)), ' . $day . ' = ' . $day . ' + ? WHERE id = ?';
            }
        }
        $db = $this->conn;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', $value, $age, $day_value, $id);
        $stmt->execute();
        $stmt->close();
        echo("completed");
    }

    //aggiornamento persone all'evento
    function updPeopleEvents($id, $value, $gender, $age){
        if($age != 0){
            if($gender == "M"){
                $sql = 'UPDATE paw_events SET males = males + ?, average = (average + ?)/2 WHERE id = ?';
            }else if($gender == "F"){
                $sql = 'UPDATE paw_events SET females = females + ?, average = (average + ?)/2 WHERE id = ?';
            }
        }else{
            if($gender == "M"){
                $sql = 'UPDATE paw_events SET males = males + ?, average = IF((males + females) < 1, 0, (average + ?)) WHERE id = ?';
            }else if($gender == "F"){
                $sql = 'UPDATE paw_events SET females = females + ?, average = IF((males + females) < 1, 0, (average + ?)) WHERE id = ?';
            }
        }
        $db = $this->conn;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $value, $age, $id);
        $stmt->execute();
        $stmt->close();
        echo("completed");
    }

    function login($name, $username, $password){
        $db = $this->conn;
        $sql = 'SELECT id, login, password, description FROM accounts WHERE login = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $user, $pass, $description);
        $resultArr = array();
        $resultArr[0] = array(
            "data"              => 0,
            "error"             => "error_userpass"
        );
        while($stmt->fetch()){
            if(md5($password) == $pass){
                $resultArr[0] = array(
                    "user_id"           => $id,
                    "user"              => $user,
                    "data"              => 1,
                    "description"       => $description
                );
            }
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    function register($user){
        $db = $this->conn;
        $registrato = 0;
        $sql = 'SELECT login FROM accounts WHERE login = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $user->username);
        $stmt->execute();
        $stmt->store_result();
        if( $stmt->num_rows == 0 ){
            $stmt->fetch();
            $stmt->close();
            //controllo mail
            $sql = 'SELECT mail FROM accounts WHERE mail = ?';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s', $user->mail);
            $stmt->execute();
            $stmt->store_result();
            if( $stmt->num_rows == 0 ){
                $stmt->fetch();
                $stmt->close();
                $sql = 'INSERT INTO accounts (login, password, mail) VALUES (?, ?, ?)';
                $stmt = $db->prepare($sql);
                $password = md5($user->password);
                $stmt->bind_param('sss', $user->username, $password, $user->mail);
                $stmt->execute();
                $result = array(
                    "data"              => 1,
                    "user_id"           => $stmt->insert_id,
                    "username"          => $user->username
                );
            }else{
                $result = array(
                    "data"              => 0,
                    "error"             => "error_mail"
                );
            }
        }else{
            $result = array(
                "data"              => 0,
                "error"             => "error_username"
            );
        }
        echo json_encode($result);
        $stmt->close();
    }

    function register2($username, $password, $email, $age, $gender, $city){
        $db = $this->conn;
        $registrato = 0;
        $sql = 'SELECT login FROM accounts WHERE login = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if( $stmt->num_rows == 0 ){
            $stmt->fetch();
            $stmt->close();
            //controllo mail
            $sql = 'SELECT mail FROM accounts WHERE mail = ?';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if( $stmt->num_rows == 0 ){
                $stmt->fetch();
                $stmt->close();
                $sql = 'INSERT INTO accounts (login, password, mail) VALUES (?, ?, ?)';
                $stmt = $db->prepare($sql);
                $password = md5($password);
                $stmt->bind_param('sss', $username, $password, $email);
                $stmt->execute();
                echo(1);
            }else{
                echo(2);
            }
        }else{
            echo(0);
        }
        $stmt->close();
    }

    function fbLogin($name, $username, $email, $age, $gender, $city, $foto, $fb_username){
        $i = 0;
        $db = $this->conn;
        $sql = 'SELECT id, user_fb FROM paw_account WHERE user_fb = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        //$stmt->store_result();
        $stmt->bind_result($id, $user_fb);
        while($stmt->fetch()){
            $i++;
            $resultArr[] = array(
                "user_id"           => $id,
                "num_rows"          => $i,
                "data"              => 2
            );
            echo json_encode($resultArr);
            $stmt->close();
            return 0;
        }

        if( $i == 0 ){
            $stmt->fetch();
            $stmt->close();
            $sql = 'INSERT INTO paw_account (user, user_fb, mail, age, gender, city, img) VALUES (?,?,?,?,?,?,?)';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sssssss', $fb_username, $username, $email, $age, $gender, $city, $foto);
            $stmt->execute();
            $resultArr[] = array(
                "user_id"           => $stmt->insert_id,
                "data"              => 1
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    function getAll($user){
        $db = $this->conn;
        $sql = 'SELECT img, city, gender, age, mood, status, points, COUNT(DISTINCT follower_id) AS followers, COUNT(DISTINCT event_id) AS eventi_creati
        FROM paw_account AS persone
        LEFT JOIN paw_following AS following ON following.user_id = persone.id
        LEFT JOIN paw_creatori_eventi AS eventi ON eventi.user_id = persone.id
        WHERE id = ?
        GROUP BY user';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->bind_result($img, $city, $gender, $age, $mood, $status, $points, $followers, $eventi_creati);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "face"              => $img,
                "age"               => $age,
                "city"              => $city,
                "gender"            => $gender,
                "mood"              => $mood,
                "status"            => $status,
                "points"            => $points,
                "followers"         => $followers,
                "pr"                => $eventi_creati
            );
        }
        $stmt->close();
        echo json_encode($resultArr);
    }

    //se hai fatto il login con facebook
    function getAllFb($user){
        $db = $this->conn;
        $sql = 'SELECT img, city, gender, age, mood, status, points FROM paw_account WHERE user_fb = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->bind_result($img, $city, $gender, $age, $mood, $status, $points);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "face"              => $img,
                "age"               => $age,
                "city"              => $city,
                "gender"            => $gender,
                "mood"              => $mood,
                "status"            => $status,
                "points"            => $points
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento persone
    function updPersone($my_id){
        $db = $this->conn;
        $sql = "SELECT user, COUNT(follower_id) AS followers, id, img, IF(SUM(follower_id = ?), '', '-g'), IF(SUM(user_id = ?), 'true', 'false') FROM paw_account AS persone INNER JOIN paw_following AS following ON following.user_id = persone.id GROUP BY user ORDER BY followers DESC LIMIT 0, 25";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $my_id, $my_id);
        $stmt->execute();
        $stmt->bind_result($username, $followers, $id, $img, $j_follow, $am_i);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "username"      => $username,
                "followers"     => $followers,
                "id"            => $id,
                "img"           => $img,
                "j_follow"      => $j_follow,
                "am_i"          => $am_i
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento locali wish
    //dev99 forse piu avanti bisognerebbe aggiungere il limite
    function updPlacesWish($user_id){
        $db = $this->conn;
        $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places INNER JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id WHERE paw_like_locali.user_id = ? GROUP BY name ORDER BY name";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $user_id, $user_id);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $type, $feed_users, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $likedPlace);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover,
                "feedback"          => $feedback,
                "type"              => $type,
                "feed_users"        => $feed_users,
                "likedPlace"        => $likedPlace,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiunta follower
    function addFollower($my_id, $id){
        $db = $this->conn;
        $sql = 'INSERT INTO paw_following (follower_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $my_id, $id);
        $stmt->execute();
        $stmt->close();
        echo("completed.");
    }

    function removeFollower($my_id, $id){
        $db = $this->conn;
        $sql = 'DELETE FROM paw_following WHERE follower_id = ? AND user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $my_id, $id);
        $stmt->execute();
        $stmt->close();
        echo("completed.");
    }

    //like ai locali
    function addLikePlace($place_id, $user_id){
        $db = $this->conn;
        $sql = 'INSERT INTO paw_like_locali (place_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $place_id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("completed.");
    }

    function removeLikePlace($place_id, $user_id){
        $db = $this->conn;
        $sql = 'DELETE FROM paw_like_locali WHERE place_id = ? AND user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $place_id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("completed.");
    }

    //aggiornamento locali limitato
    function updPlacesLimit($limit, $user_id){
        $db = $this->conn;
        $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places LEFT JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id GROUP BY name ORDER BY feedback DESC, name LIMIT ?,10";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $user_id, $limit);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $type, $feed_users, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $likedPlace);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover,
                "feedback"          => $feedback,
                "type"              => $type,
                "feed_users"        => $feed_users,
                "likedPlace"        => $likedPlace,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento eventi limitato
    function updEventsLimit($limit, $tempo, $my_lat, $my_lng, $distance){
        $db = $this->conn;
        //ha bisogno dell'ordine DESC per la lista basata sulla data (time) dell'evento
        $sql = 'SELECT lat, lng, online, name, img, address, place, description, time, males, females, average, id, placename, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza, raggio FROM paw_events WHERE time > ? HAVING distanza < raggio ORDER BY time, name LIMIT ?,10 ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dddss', $my_lat, $my_lng, $my_lat, $tempo, $limit);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $online, $name, $img, $address, $place, $description, $time, $males, $females, $average, $id, $placename, $distanza, $raggio);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "online"            => $online,
                "img"               => $img,
                "address"           => utf8_encode($address),
                "place"             => $place,
                "description"       => utf8_encode($description),
                "time"              => $time,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "id"                => $id,
                "placename"         => $placename
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento locali con ricerca
    function updPlacesSearch($search, $user_id){
        $db = $this->conn;
        $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, (males + females) AS people, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places LEFT JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id GROUP BY name HAVING name LIKE CONCAT('%',?,'%') OR address LIKE CONCAT('%',?,'%') ORDER BY people DESC LIMIT 0, 25";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $user_id, $search, $search);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $type, $feed_users, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $people, $likedPlace);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover,
                "feedback"          => $feedback,
                "type"              => $type,
                "feed_users"        => $feed_users,
                "likedPlace"        => $likedPlace,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento persone con ricerca
    function updPersoneSearch($search, $my_id){
        $db = $this->conn;
        $sql = "SELECT user, COUNT(follower_id) AS followers, id, img, IF(SUM(follower_id = ?), '', '-g'), IF(SUM(user_id = ?), 'true', 'false') FROM paw_account AS persone LEFT JOIN paw_following AS following ON following.user_id = persone.id WHERE (user LIKE CONCAT('%',?,'%') OR city LIKE CONCAT('%',?,'%')) GROUP BY user ORDER BY followers DESC LIMIT 0, 25";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', $my_id, $my_id, $search, $search);
        $stmt->execute();
        $stmt->bind_result($username, $followers, $id, $img, $j_follow, $am_i);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "username"      => $username,
                "followers"     => $followers,
                "id"            => $id,
                "img"           => $img,
                "j_follow"      => $j_follow,
                "am_i"          => $am_i
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento eventi con ricerca
    function updEventsSearch($search, $tempo, $my_lat, $my_lng){
        $db = $this->conn;
        $sql = "SELECT lat, lng, online, name, img, address, place, description, time, males, females, average, id, placename, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza, raggio FROM paw_events WHERE (time > ?) AND (name LIKE CONCAT('%',?,'%') OR address LIKE CONCAT('%',?,'%') OR place LIKE CONCAT('%',?,'%') OR placename LIKE CONCAT('%',?,'%')) HAVING distanza < raggio ORDER BY time, name LIMIT 0,25";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dddsssss', $my_lat, $my_lng, $my_lat, $tempo, $search, $search, $search, $search);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $online, $name, $img, $address, $place, $description, $time, $males, $females, $average, $id, $placename, $distanza, $raggio);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "time"              => $time,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento locali limitato con filtro
    function updPlacesLimitFilter($limit, $filter, $my_lat, $my_lng, $distance, $user_id){
        if($filter == 1){
            $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, (males + females) AS people, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places LEFT JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id GROUP BY name HAVING distanza < ? ORDER BY people DESC, name LIMIT ?,10";
        }else if($filter == 2){
            $sql = "SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, (males + females) AS people, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza, IF(SUM(user_id = ?), '#ef473a;', '') FROM paw_places LEFT JOIN paw_like_locali ON paw_like_locali.place_id = paw_places.id GROUP BY name HAVING distanza < ? ORDER BY feedback DESC, name LIMIT ?,10";
        }

        $db = $this->conn;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dddsss', $my_lat, $my_lng, $my_lat, $user_id, $distance, $limit);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $type, $people, $feed_users, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set, $distanza, $likedPlace);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover,
                "feedback"          => $feedback,
                "type"              => $type,
                "feed_users"        => $feed_users,
                "likedPlace"        => $likedPlace,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //aggiornamento locali con filtro - deprec?
    function updPlacesFilter($limit, $filter, $my_lat, $my_lng, $distance){

        //$sql = 'SELECT lat, lng, name, img, address, description, id, males, females, average, cover FROM paw_places ORDER BY name LIMIT ?,10';

        if($filter == 1){
            $sql = 'SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, (males + females) AS people, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza FROM paw_places HAVING distanza < ? ORDER BY people DESC, name';
        }else if($filter == 2){
            $sql = 'SELECT lat, lng, name, img, address, description, id, males, females, average, cover, feedback, type, (males + females) AS people, feed_users, lun, mar, mer, gio, ven, sab, dom, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec, lun_set, mar_set, mer_set, gio_set, ven_set, sab_set, dom_set, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distanza FROM paw_places HAVING distanza < ? ORDER BY feedback DESC, name';
        }

        $db = $this->conn;
        //sql
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ddds', $my_lat, $my_lng, $my_lat, $distance);
        $stmt->execute();
        $stmt->bind_result($lat, $lng, $name, $img, $address, $description, $id, $males, $females, $average, $cover, $feedback, $type, $people, $feed_users, $lun, $mar, $mer, $gio, $ven, $sab, $dom, $lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec, $lun_set, $mar_set, $mer_set, $gio_set, $ven_set, $sab_set, $dom_set);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "lat"               => $lat,
                "lng"               => $lng,
                "name"              => utf8_encode($name),
                "img"               => $img,
                "address"           => utf8_encode($address),
                "description"       => utf8_encode($description),
                "id"                => $id,
                "males"             => $males,
                "females"           => $females,
                "average"           => $average,
                "cover"             => $cover,
                "feedback"          => $feedback,
                "type"              => $type,
                "feed_users"        => $feed_users,

                "lun" => $lun,
                "mar" => $mar,
                "mer" => $mer,
                "gio" => $gio,
                "ven" => $ven,
                "sab" => $sab,
                "dom" => $dom,

                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec,

                "lun_set" => $lun_set,
                "mar_set" => $mar_set,
                "mer_set" => $mer_set,
                "gio_set" => $gio_set,
                "ven_set" => $ven_set,
                "sab_set" => $sab_set,
                "dom_set" => $dom_set
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    function creaLocale($name, $indirizzo, $descrizione, $tipo, $foto, $lat, $long){
        $db = $this->conn;
        $name = utf8_decode($name);
        $descrizione = utf8_decode($descrizione);
        $registrato = 0;
        $nomeFittizio = "jfalej";
        $sql = 'SELECT name FROM paw_places WHERE name = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $nomeFittizio);
        $stmt->execute();
        $stmt->store_result();
        if( $stmt->num_rows == 0 ){
            $stmt->fetch();
            $stmt->close();
            $sql = 'INSERT INTO paw_places (name, address, description, type, cover, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sssssss', $name, $indirizzo, $descrizione, $tipo, $foto, $lat, $long);
            $stmt->execute();
            echo(1);
        }else{
            echo 0;
        }
        $stmt->close();
    }

    //creazione di un evento
    function creaEvento($name, $indirizzo, $descrizione, $tipo, $foto, $lat, $long, $tempo, $locale, $range, $my_id){
        $db = $this->conn;
        $name = utf8_decode($name);
        $descrizione = utf8_decode($descrizione);
        $registrato = 0;
        $nomeFittizio = "jfalej";
        $sql = 'SELECT name FROM paw_events WHERE name = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $nomeFittizio);
        $stmt->execute();
        $stmt->store_result();
        if( $stmt->num_rows == 0 ){
            $stmt->fetch();
            $stmt->close();
            $sql = 'INSERT INTO paw_events (name, address, description, img, lat, lng, time, placename, raggio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sssssssss', $name, $indirizzo, $descrizione, $foto, $lat, $long, $tempo, $locale, $range);
            $stmt->execute();
            $id = mysqli_insert_id($db);
            $stmt->fetch();
            $stmt->close();
            $sql = 'INSERT INTO paw_creatori_eventi (event_id, user_id) VALUES (?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ss', $id, $my_id);
            $stmt->execute();
            echo(1);
        }else{
            echo 0;
        }
        $stmt->close();
    }

    //recupero di tutte le recensioni
    function prendiRecensioni($name){
        $db = $this->conn;
        $sql = 'SELECT name, feedback, feed_users, lun_rec, mar_rec, mer_rec, gio_rec, ven_rec, sab_rec, dom_rec FROM paw_places WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->bind_result($name, $feedback, $feed_users,$lun_rec, $mar_rec, $mer_rec, $gio_rec, $ven_rec, $sab_rec, $dom_rec);
        $resultArr = array();
        while($stmt->fetch()){
            $resultArr[] = array(
                "name"               => utf8_encode($name),
                "feedback"          => $feedback,
                "feed_users"        => $feed_users,
                "lun_rec" => $lun_rec,
                "mar_rec" => $mar_rec,
                "mer_rec" => $mer_rec,
                "gio_rec" => $gio_rec,
                "ven_rec" => $ven_rec,
                "sab_rec" => $sab_rec,
                "dom_rec" => $dom_rec
            );
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    //singola recensione
    function recensione($name, $value, $day, $day_value, $feed_users){
        $sql = 'UPDATE paw_places SET feedback = ?, feed_users = ?, ' . $day . ' = ? WHERE id = ?';
        $db = $this->conn;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', $value, $feed_users, $day_value, $name);
        $stmt->execute();
        $stmt->close();
        echo("completed");
    }

    //recensioni avanzato
    function recensioniAvanzato($rec_username, $rec_points){
        $sql = 'UPDATE paw_account SET points = ? WHERE user = ?';
        $db = $this->conn;
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $rec_points, $rec_username);
        $stmt->execute();
        $stmt->close();
        echo("completed");
    }

    //modifica profilo
    function modificaProfilo($city, $foto, $user, $age){
        if($foto == "0"){
            $sql = 'UPDATE paw_account SET city = ?, age = ? WHERE id = ?';
            $db = $this->conn;
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $city, $age, $user);
            $stmt->execute();
            $stmt->close();
            echo("1");
        }else{
            $sql = 'UPDATE paw_account SET city = ?, img = ?, age = ? WHERE id = ?';
            $db = $this->conn;
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssss', $city, $foto, $age, $user);
            $stmt->execute();
            $stmt->close();
            echo("1");
        }
    }

    //dev12 gestione locali
    function richiediGestione($user_id, $id){
        $db = $this->conn;
        $sql = 'INSERT INTO paw_gestori_locali (locale_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("completed.");
    }

    function saveMyPosition($id, $lat, $lng, $accuracy){
      $db = $this->conn;
      $sql = 'UPDATE accounts SET lat = ?, lng = ?, last_online = NOW(), accuracy = ? WHERE id = ?';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('ssss', $lat, $lng, $accuracy, $id);
      $stmt->execute();
      $stmt->close();
    }

    function saveMarkerPosition($user_id, $marker_id, $lat, $lng){
      $db = $this->conn;
      $sql = 'INSERT INTO ct_user_markers (id_user, lat, lng) VALUES (?,?,?)';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('sss', $user_id, $lat, $lng);
      $stmt->execute();
      echo($stmt->insert_id);
      $stmt->close();
    }

    function countMarkers(){
        $db = $this->conn;
        $sql = 'SELECT COUNT(id) FROM ct_user_markers';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id);
        echo($id);
        $stmt->close();
    }

    function getUserMarkers($user_id){
      $db = $this->conn;
      $sql = 'SELECT id, id_marker_user, name, description, lat, lng, deadline, private,audio FROM ct_user_markers WHERE id_user = ?';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('s', $user_id);
      $stmt->execute();
      $stmt->bind_result($id,$id_marker_user,$name,$description,$lat,$lng,$deadline,$private,$audio);
      $result = array();
      while($stmt->fetch()){
          $result[] = array(
              "id" => ($id),
              "id_marker_user" => ($id_marker_user),
              "name" => ($name),
              "description" => ($description),
              "lat" => ($lat),
              "lng" => ($lng),
              "deadline" => ($deadline),
              "private" => $private,
              "audio"=>$audio
          );
      }
      echo json_encode($result);
      $stmt->close();
    }

    function deleteMarker($id,$audio){
      if(unlink('uploads/music/'.$audio)) echo "eliminato";
      $db = $this->conn;
      $sql = 'DELETE FROM ct_user_markers WHERE id = ?';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $stmt->close();
    }

    function getPeople($id){
        $db = $this->conn;
        $sql = 'SELECT id, login, lat, lng, accuracy FROM accounts WHERE last_online > (now() - INTERVAL 5 MINUTE) AND id != ? AND private = 0';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($id,$login,$lat,$lng,$accuracy);
        $result = array();
        while($stmt->fetch()){
            $result[] = array(
                "id" => ($id),
                "login" => ($login),
                "lat" => ($lat),
                "lng" => ($lng),
                "accuracy" => $accuracy
            );
        }
        echo json_encode($result);
        $stmt->close();
    }

    function getPeopleMarker($id){
        $db = $this->conn;
        $sql = 'SELECT markers.id, id_marker_user, name, description, markers.lat, markers.lng, deadline, markers.private, people.login
        FROM ct_user_markers AS markers
        INNER JOIN accounts AS people ON people.id = markers.id_user
        WHERE (deadline > now() OR deadline IS NULL) AND id_user != ? AND markers.private = 0
        GROUP BY markers.id';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($id,$id_marker_user,$name,$description,$lat,$lng,$deadline,$private,$login);
        $result = array();
        while($stmt->fetch()){
            $result[] = array(
                "id" => ($id),
                "name" => ($name),
                "lat" => ($lat),
                "lng" => ($lng),
                "creator" => $login
            );
        }
        echo json_encode($result);
        $stmt->close();
    }

    function getComments($post_id, $starting_from = 0, $number = 10000, $order = 'time'){
        $db = $this->conn;
        $sql = 'SELECT comments.user_id, comments.comment, comments.time,
        people.login
        FROM hw_post_comments AS comments
        LEFT JOIN accounts AS people ON people.id = comments.user_id
        WHERE comments.post_id = ?
        GROUP BY comments.id
        ORDER BY
            CASE WHEN ? = "time" THEN comments.time END ASC
        LIMIT ?, ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssdd',$post_id,$order,$starting_from,$number);
        $stmt->execute();
        $stmt->bind_result($c_user_id,$c_text,$c_time,$c_user_name);
        $result = array();
        while($stmt->fetch()){
            $result[] = array(
                "c_user_id" => $c_user_id,
                'comment' => $c_text,
                'added' => $this->timeElapsed($c_time),
                'user_name' => $c_user_name
            );
        }
        echo json_encode($result);
        $stmt->close();        
    }    

    function editMarker($id, $name, $private){
        $db = $this->conn;
        $sql = 'UPDATE ct_user_markers SET name = ?, private = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sds', $name,$private,$id);
        $stmt->execute();
        $result = array(
            "status" => $name,
            "id" => $id,
            "request" => $request->name
        );
        echo json_encode($result);
        $stmt->close();
    }

    function makePrivate($id, $private){
        $db = $this->conn;
        $sql = 'UPDATE ct_user_markers SET private = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ds',$private,$id);
        $stmt->execute();
        $result = array(
            "id" => $id
        );
        echo json_encode($result);
        $stmt->close();
    }    

    //add comment
    function addCommentPost($post_id,$user_id,$comment){
        $db = $this->conn;
        $sql = 'INSERT INTO hw_post_comments (post_id,user_id,comment) VALUES (?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss',$post_id,$user_id,$comment);
        $stmt->execute();
        $new_id = $stmt->insert_id;
        $result = array(
            "new_id" => $new_id
        );
        echo json_encode($result);
        $stmt->close();
        // echo("added comment.");
    }

    //remove comment
    function removeCommentPost($post_id,$user_id){
        $db = $this->conn;
        $sql = 'DELETE FROM hw_post_comments WHERE post_id = ? AND user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $post_id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("removed comment.");
    }

    //like ai post
    function addLikePost($post_id, $user_id){
        $db = $this->conn;
        $sql = 'INSERT INTO hw_post_likes (post_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $post_id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("added like.");       
        $mittente = $this->getUserNameFromUserId($user_id);
        $destinatario_id = $this->getPostCreator($post_id);
        $data = new stdClass();
        $data->user_id = $user_id;
        $data->post_id = $post_id;
        $data->creator_id = $destinatario_id[0];
        $data->user_name = $mittente[0];    
        $data->notification_text = "liked your post.";
        $data->type = "like";
        $this->sendNotifications($data);         
    }

    //unlike ai post
    function removeLikePost($post_id, $user_id){
        $db = $this->conn;
        $sql = 'DELETE FROM hw_post_likes WHERE post_id = ? AND user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $post_id, $user_id);
        $stmt->execute();
        $stmt->close();
        echo("removed like.");
    }

    function getPosts($num = 0, $order = 'added', $order2 = 10, $lat = 0, $lng = 0, $user_id){
        $db = $this->conn;
        //dev10n
        $sql = 'SELECT markers.id, id_marker_user,
        IF(ISNULL(name),CONCAT("Post #",markers.id),name),
        markers.description, markers.lat, markers.lng, deadline, markers.private, people.login, markers.added,
        IF(? <> 0, ( 6371 * acos( cos( radians(?) ) * cos( radians( markers.lat ) ) * cos( radians( markers.lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( markers.lat ) ) ) ), "null") AS distanza,
        markers.audio,
        IF(ISNULL(audio),false,true),
        IF(? = markers.id_user,true,false),
        COUNT(DISTINCT post_likes.user_id),
        IF(SUM(post_likes.user_id = ?),true,false),
        COUNT(DISTINCT post_comments.id),
        IF(SUM(post_comments.user_id = ?),true,false),
        CONCAT(
            "[",
            GROUP_CONCAT(DISTINCT
                CONCAT(
                    "{\"comment\": \"",
                    IF(LENGTH(post_comments.comment) > 50, CONCAT(SUBSTRING(post_comments.comment,1, 50),"..."), post_comments.comment)
                    ,
                    "\", \"user_name\": \"",
                    IF(LENGTH(people2.login) > 50, CONCAT(SUBSTRING(people2.login,1, 50),"..."), people2.login)
                    ,
                    "\", \"added\": \"",
                    post_comments.time,
                    "\"}"
                )
            ORDER BY post_comments.time DESC SEPARATOR ",")
            , "]"
        ),
        people.notification_id, people.id,
        markers.todo_list, markers.duedate        
        FROM ct_user_markers AS markers
        INNER JOIN accounts AS people ON people.id = markers.id_user
        LEFT JOIN hw_post_likes AS post_likes ON post_likes.post_id = markers.id
        LEFT JOIN hw_post_comments AS post_comments ON post_comments.post_id = markers.id
        LEFT JOIN accounts AS people2 ON people2.id = post_comments.user_id
        WHERE (deadline > now() OR deadline IS NULL) AND markers.private = 0
        GROUP BY markers.id
        ORDER BY
            CASE WHEN ? = "rand" THEN distanza END ASC,
            CASE WHEN ? = "added" THEN added END DESC
        LIMIT ?, ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dddddddssdd',$lat,$lat,$lng,$lat,$user_id,$user_id,$user_id,$order,$order,$num,$order2);
        $stmt->execute();
        $stmt->bind_result($id,$id_marker_user,$name,$description,$lat,$lng,$deadline,$private,$login,$added,$distanza,$audio,$isaudio,$is_me,$likes,$liked_me,$comments_count,$commented_me,$comments,$notification_id,$creator_id, $todo_list, $duedate);
        $result = array();
        while($stmt->fetch()){
            // $comments = $this->getComments($id,0,2,'time');              
            //sistemazione dei commenti
            if(substr($comments, -2) != "}")
            {                
                $comments = substr($comments, 0, strrpos( $comments, '}')) . "}]";                        
            }            

            if($distanza!="null")
                $distanza = number_format($distanza,2);                

            $result[] = array(
                "id" => ($id),
                "name" => ($name),
                "lat" => ($lat),
                "lng" => ($lng),
                "creator" => $login,
                "added" => $this->timeElapsed($added),
                "distanza" => $distanza,
                "order" => $order,
                'audio' => $audio,
                'isaudio' => $isaudio,
                'description' => $description,
                'is_me' => $is_me,
                'likes' => $likes,
                'liked_me' => $liked_me,
                'comments_count' => $comments_count,
                'commented_me' => $commented_me,
                'comments' => json_decode($comments),
                'readonly' => true,
                'notification_id' => $notification_id,
                'creator_id' => $creator_id,
                "deadline" => $deadline,
                "todo_list" => $todo_list,
                "duedate" => $duedate
            );
        }
        echo json_encode($result);
        $stmt->close();
    }

    function getMyUser($user){
        $db = $this->conn;
        $sql = 'SELECT COUNT(DISTINCT posts.id),        
        SUM(if(post_likes.user_id <> ?, 1, 0)),
        COUNT(DISTINCT friends.friend_id)
        FROM ct_user_markers AS posts 
        LEFT JOIN hw_post_likes AS post_likes ON post_likes.post_id = posts.id
        LEFT JOIN hw_friends AS friends ON friends.user_id = posts.id_user
        WHERE id_user = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dd', $user,$user);
        $stmt->execute();
        $stmt->bind_result($num_posts,$num_likes,$num_friends);    
        while($stmt->fetch()){           
            if($num_likes == null) $num_likes = 0;
            $result = array(
                "num_posts"           => $num_posts,
                "num_likes"           => $num_likes,
                "num_friends"         => $num_friends,
            );        
        }
        echo json_encode($result);
        $stmt->close();
    }

    //add push id
    function addPushId($user_id, $notification_id){
        $db = $this->conn;
        // $sql = 'UPDATE accounts SET notification_id = ? WHERE id = ?';
        $sql = 'INSERT INTO accounts_access (notification_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $notification_id, $user_id);
        $stmt->execute();
        $result = array(
            "response"           => "200"            
        );            
        echo json_encode($result);
        $stmt->close();
    }

    //remove push id
    function removePushId($user_id, $notification_id){
        $db = $this->conn;
        // $sql = 'UPDATE accounts SET notification_id = NULL WHERE id = ?';
        $sql = 'DELETE FROM accounts_access WHERE notification_id = ? AND user_id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss',$notification_id, $user_id);
        $stmt->execute();
        $result = array(
            "response"           => "200"            
        );            
        echo json_encode($result);
        $stmt->close();
    }

    //get destinations for notifications
    function getDestinationsFromComments($post_id, $user_id){
        $db = $this->conn;        
        $sql = 'SELECT DISTINCT notif.notification_id
        FROM hw_post_comments AS comments
        INNER JOIN accounts_access AS notif ON notif.user_id = comments.user_id  
        INNER JOIN ct_user_markers AS posts ON posts.id = comments.post_id
        WHERE comments.post_id = ? AND comments.user_id <> posts.id_user AND comments.user_id <> ?
        GROUP BY notif.notification_id
        ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss',$post_id,$user_id);
        $stmt->execute();
        $stmt->bind_result($notification_id);
        $result = array();
        while($stmt->fetch()){
            $result[] = $notification_id;
        }                 
        $stmt->close();
        return $result;
    }

    function getDestinationsFromUser($user_id){
        $db = $this->conn;        
        $sql = 'SELECT notif.notification_id
        FROM accounts_access AS notif        
        WHERE notif.user_id = ?        
        ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $stmt->bind_result($notification_id);
        $result = array();
        while($stmt->fetch()){
            $result[] = $notification_id;
        }                 
        $stmt->close();
        return $result;
    }    

    function getDestinationsFromPost($post_id){
        $db = $this->conn;        
        $sql = 'SELECT notif.notification_id
        FROM accounts_access AS notif 
        INNER JOIN ct_user_markers AS posts ON posts.id = ?       
        WHERE notif.user_id = posts.id_user
        ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $stmt->bind_result($notification_id);
        $result = array();
        while($stmt->fetch()){
            $result[] = $notification_id;
        }                 
        $stmt->close();
        return $result;
    }

    function getUserNameFromUserId($user_id){
        $db = $this->conn;        
        $sql = 'SELECT login
        FROM accounts         
        WHERE id = ?
        ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$user_id);
        $stmt->execute();
        $stmt->bind_result($username);
        $result = array();
        while($stmt->fetch()){
            $result[] = $username;
        }                 
        $stmt->close();
        return $result;
    }

    function getPostCreator($post_id){
        $db = $this->conn;        
        $sql = 'SELECT id_user
        FROM ct_user_markers         
        WHERE id = ?
        ';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$post_id);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $result = array();
        while($stmt->fetch()){
            $result[] = $user_id;
        }                 
        $stmt->close();
        return $result;
    }

    // NUOVO POST
    function post($id, $name, $audio, $lat, $lng, $description){
        $db = $this->conn;
        $sql = 'INSERT INTO ct_user_markers (id_user, lat, lng, name, audio, private, description) VALUES (?,?,?,?,?,0,?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssss', $id,$lat,$lng,$name,$audio,$description);
        $stmt->execute();
        $new_id = $stmt->insert_id;
        $result = array(
            "name" => $name,
            "id" => $id,
            "request" => $request->audio,
            "new_id" => $new_id
        );        
        $stmt->close();
        echo json_encode($result);
        $mittente = $this->getUserNameFromUserId($id);        
        $data = new stdClass();
        $data->user_id = $id;
        $data->post_id = $new_id;
        $data->creator_id = $mittente[0];
        $data->user_name = $mittente[0];    
        $data->notification_text = "created a new post: " . $description;
        $data->type = "new_post";
        //dev10n rimuovere la linea seguente per abilitare la notifica alla creazione di un nuovo post
        //$this->sendNotifications($data);
    }    

    //sending notifications
    function sendNotifications($data){
        $response = "empty list";    
        $messaggio = $data->user_name . " " . $data->notification_text;
        $standard_fields = true;

        $content = array(
			"en" => $messaggio
        );        
        $heading = array(
            "en" => $data->user_name
        );
        
        $filters = array(
            array("field" => "tag", "key" => "UserId", "relation" => "!=", "value" => $data->user_id)
        );                	        
    

        $destinations = array();

        if($data->type == "comment"){
            $destinationsFromComments = $this->getDestinationsFromComments($data->post_id, $data->user_id);        
            $destinations = $destinationsFromComments;        
            if($data->creator_id != $data->user_id){
                $destinationsFromUser = $this->getDestinationsFromUser($data->creator_id);            
                $destinations = array_merge_recursive($destinationsFromUser, $destinationsFromComments);
            }
        }else if($data->type == "like"){
            if($data->creator_id != $data->user_id){
                $destinationsFromUser = $this->getDestinationsFromUser($data->creator_id);            
                $destinations = $destinationsFromUser;
            }
        }else if($data->type == "new_post"){
            $standard_fields = false;
        }else{
            //comment
            $destinationsFromComments = $this->getDestinationsFromComments($data->post_id, $data->user_id);        
            $destinations = $destinationsFromComments;        
            if($data->creator_id != $data->user_id){
                $destinationsFromUser = $this->getDestinationsFromUser($data->creator_id);            
                $destinations = array_merge_recursive($destinationsFromUser, $destinationsFromComments);
            }
        }


        //'included_segments' => array('All'),
        //'filters' => $filters,
        //'headings' => $heading,       
        if($standard_fields){
            if(count($destinations) == 0){
                $response = "nobody to notify...";
                return;
            }

            $fields = array(
                'app_id' => "31828451-4096-4355-8b1f-e54183b4a6c9",            
                'data' => array("post_id" => $data->post_id),
                'contents' => $content,            
                'include_player_ids' => $destinations
            );            
        }else{
            $fields = array(
                'app_id' => "31828451-4096-4355-8b1f-e54183b4a6c9",            
                'data' => array("post_id" => $data->post_id),
                'contents' => $content,            
                'filters' => $filters,
            );
        }


		$fields = json_encode($fields);                
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic OGQ4NTIwMzQtNmYxYi00YjA0LWFiODQtZjQxMGY4NWU0YWYy'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);        
        curl_close($ch);			

        // echo $response;
    }

    // NUOVO POST Activity
    function postActivity($data){
        $date = date('Y-m-d H:i:s',$data->duedate);
        $db = $this->conn;
        $sql = 'INSERT INTO ct_user_markers (id_user, lat, lng, name, audio, private, description, todo_list, duedate) VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('sssssdsss', $data->id_user,$data->lat,$data->lng,$data->name,$data->audio,$data->private,$data->description,$data->todo_list,$date);
        $stmt->execute();
        $new_id = $stmt->insert_id;
        $result = array(
            "duedate" => $date,
            "original_duedate" => $data->duedate,
            "request" => $request->audio,
            "new_id" => $new_id
        );        
        $stmt->close();
        echo json_encode($result);
        $mittente = $this->getUserNameFromUserId($id);        
        $data = new stdClass();
        $data->user_id = $id;
        $data->post_id = $new_id;
        $data->creator_id = $mittente[0];
        $data->user_name = $mittente[0];    
        $data->notification_text = "created a new post: " . $description;
        $data->type = "new_post";
        //dev10n rimuovere la linea seguente per abilitare la notifica alla creazione di un nuovo post
        //$this->sendNotifications($data);
    }   



}

$api = new Accounts;

if(isset($action)){
    if($action == "upd"){
        $api->updateMe($name, $lat, $long, $online, $user);
    }else if($action == "oth"){
        $api->updOth($name, $user);
    }else if($action == "login"){
        $api->login($name, $user, $pass);
    }else if($action == "register"){
        $api->register($user);
    }else if($action == "getAll"){
        $api->getAll($user);
    }else if($action == "updEvents"){
        $api->updEvents($tempo, $my_lat, $my_lng, $distance);
    }else if($action == "updPlaces"){
        $api->updPlaces($my_lat, $my_lng, $distance);
    }else if($action == "updPeoplePlaces"){
        $api->updPeoplePlaces($id, $value, $gender, $age, $day, $day_value);
    }else if($action == "updPlace"){
        $api->updPlace($id, $user_id);
    }else if($action == "updPeopleEvents"){
        $api->updPeopleEvents($id, $value, $gender, $age);
    }else if($action == "updEvent"){
        $api->updEvent($id);
    }else if($action == "updPlacesLimit"){
        $api->updPlacesLimit($limit, $user_id);
    }else if($action == "updEventsLimit"){
        $api->updEventsLimit($limit, $tempo, $my_lat, $my_lng, $distance);
    }else if($action == "updAddresses"){
        $api->updAddresses($id, $lat, $long);
    }else if($action == "updPlacesSearch"){
        $api->updPlacesSearch($search, $user_id);
    }else if($action == "updEventsSearch"){
        $api->updEventsSearch($search, $tempo, $my_lat, $my_lng);
    }else if($action == "updPlacesLimitFilter"){
        $api->updPlacesLimitFilter($limit, $filter, $my_lat, $my_lng, $distance, $user_id);
    }else if($action == "updPlacesFilter"){
        $api->updPlacesFilter($limit, $filter, $my_lat, $my_lng, $distance);
    }else if($action == "creaLocale"){
        $api->creaLocale($name, $indirizzo, $descrizione, $tipo, $foto, $lat, $long);
    }else if($action == "recensione"){
        $api->recensione($name, $value, $day, $day_value, $feed_users);
    }else if($action == "prendiRecensioni"){
        $api->prendiRecensioni($name);
    }else if($action == "creaEvento"){
        $api->creaEvento($name, $indirizzo, $descrizione, $tipo, $foto, $lat, $long, $tempo, $locale, $range, $my_id);
    }else if($action == "recensioniAvanzato"){
        $api->recensioniAvanzato($rec_username, $rec_points);
    }else if($action == "fbLogin"){
        $api->fbLogin($name, $user, $email, $age, $gender, $city, $foto, $fb_username);
    }else if($action == "getAllFb"){
        $api->getAllFb($user);
    }else if($action == "modificaProfilo"){
        $api->modificaProfilo($city, $foto, $user, $age);
    }else if($action == "updPersone"){
        $api->updPersone($my_id);
    }else if($action == "addFollower"){
        $api->addFollower($my_id, $id);
    }else if($action == "removeFollower"){
        $api->removeFollower($my_id, $id);
    }else if($action == "updPersoneSearch"){
        $api->updPersoneSearch($search, $my_id);
    }else if($action == "addLikePlace"){
        $api->addLikePlace($place_id, $user_id);
    }else if($action == "removeLikePlace"){
        $api->removeLikePlace($place_id, $user_id);
    }else if($action == "updPlacesWish"){
        $api->updPlacesWish($user_id);
    }else if($action == "addPushToken"){
        $api->addPushToken($user_id, $var_data);
    }else if($action == "removePushToken"){
        $api->removePushToken($user_id);
    }else if($action == "richiediGestione"){
        $api->richiediGestione($user_id, $id);
    }else if($action == "saveMyPosition"){
        $api->saveMyPosition($id, $lat, $lng, $accuracy);
    }else if($action == "saveMarkerPosition"){
        $api->saveMarkerPosition($user_id, $marker_id, $lat, $lng);
    }else if($action == "getUserMarkers"){
        $api->getUserMarkers($user_id);
    }else if($action == "deleteMarker"){
        $api->deleteMarker($id,$audio);
    }else if($action == "getPeople"){
        $api->getPeople($id);
    }else if($action == "editMarker"){
        $api->editMarker($id, $name, $private);
    }else if($action == "getPeopleMarker"){
        $api->getPeopleMarker($id);
    }else if($action == "post"){
        $api->post($id, $name, $audio, $lat, $lng, $description);
    }else if($action == "countMarkers"){
        $api->countMarkers();
    }else if($action == "getPosts"){
        $api->getPosts($num,$order,$order2,$lat,$lng,$user_id);
    }else if($action == "makePrivate"){
        $api->makePrivate($id,$private);
    }else if($action == "addLikePost"){
        $api->addLikePost($post_id,$user_id);
    }else if($action == "removeLikePost"){
        $api->removeLikePost($post_id,$user_id);
    }else if($action == "addCommentPost"){
        $api->addCommentPost($post_id,$user_id,$comment);
    }else if($action == "removeLikePost"){
        $api->removeCommentPost($post_id,$user_id);
    }else if($action == "getMyUser"){
        $api->getMyUser($user);
    }else if($action == "getComments"){
        $api->getComments($data->post_id);
    }else if($action == "addPushId"){
        $api->addPushId($data->user_id, $data->notification_id);
    }else if($action == "removePushId"){
        $api->removePushId($data->user_id, $data->notification_id);
    }else if($action == "sendNotifications"){
        $api->sendNotifications($data);
    }else if($action == "postActivity"){
        $api->postActivity($data);
    }

}

?>
