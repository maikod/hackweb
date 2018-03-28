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


//echo $filename;

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
    //dev10n
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
        $sql = 'SELECT id, login, password FROM accounts WHERE login = ?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $user, $pass);
        $resultArr = array();
        $resultArr[0] = array(
            "data"              => 0
        );
        while($stmt->fetch()){
            if(($password) == $pass){
                $resultArr[0] = array(
                    "user_id"           => $id,
                    "user"              => $user,
                    "data"              => 1
                );
            }
        }
        echo json_encode($resultArr);
        $stmt->close();
    }

    function register($username, $password, $email, $age, $gender, $city){
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
      $sql = 'INSERT INTO ct_user_markers (id_user, id_marker_user, lat, lng) VALUES (?,?,?,?)';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('ssss', $user_id, $marker_id, $lat, $lng);
      $stmt->execute();
      echo($stmt->insert_id);
      $stmt->close();
    }

    function getUserMarkers($user_id){
      $db = $this->conn;
      $sql = 'SELECT id, id_marker_user, name, description, lat, lng, deadline, private FROM ct_user_markers WHERE id_user = ?';
      $stmt = $db->prepare($sql);
      $stmt->bind_param('s', $user_id);
      $stmt->execute();
      $stmt->bind_result($id,$id_marker_user,$name,$description,$lat,$lng,$deadline,$private);
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
              "private" => $private
          );
      }
      echo json_encode($result);
      $stmt->close();
    }

    function deleteMarker($id){
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
        $api->register($user, $pass, $email, $age, $gender, $city);
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
        $api->deleteMarker($id);
    }else if($action == "getPeople"){
        $api->getPeople($id);
    }else if($action == "editMarker"){
        $api->editMarker($id, $name, $private);
    }else if($action == "getPeopleMarker"){
        $api->getPeopleMarker($id);
    }
}

?>
