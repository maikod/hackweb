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

class ADMIN extends DB
{    

    // function __construct() {
    //     parent::__construct();        
    // }

    // function __destruct(){
    //     parent::__destruct();
    // }
    

    function login($data){
        $data->password = md5($data->password);        
        $sess_id = rand();  
        // $this->sql_open();      
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }             
        $sql = "SELECT potere FROM brah_accounts WHERE password = ? AND username = ?";
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
            $sql = 'UPDATE brah_accounts SET sess_id=? WHERE password=? AND username=?';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $sess_id,$data->password,$data->username);
            $stmt->execute();
            echo '1';
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
            $sql = "SELECT username FROM brah_accounts WHERE sess_id = ?";
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
        $data->upload_files = "files/file_upload/img/".$data->upload_files;
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->upload_files);
        $stmt->execute();                                
        echo '1';
        $stmt->close();        
    }

    function getTextGlobal($id,$char = 'utf8'){
        $db = $this->conn;        
        if($char != "utf8") $db->set_charset($char);
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }             
        $sql = "SELECT * FROM testi_sistema WHERE ID = ?";        
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('s' ,$id);        
        $stmt->execute();       

        // $stmt->bind_result($testo);              
        // $result = array();               
        // while($stmt->fetch()) {                                    
        //     $result[0] = html_entity_decode(htmlspecialchars_decode($testo));                                  
        // }

        // $res = $stmt->get_result(); 
        // $num_of_rows = $res->num_rows;

        // $result = array();
        // $temp = array();

        // while ($row = $res->fetch_assoc()) {
        //     foreach ($row as $key => $value) {
        //         $temp[$key] = html_entity_decode(htmlspecialchars_decode($value));               
        //     }
        //     $result[] = $temp;        
        // }

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
        
        $stmt->close();                
        return $result;
    }

    function overviewLoadVideo($data){        
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'INSERT INTO brah_posts (title,subtitle,image,cat) VALUES (?,?,?,3)';
        $stmt = $db->prepare($sql);
        $data->upload_files = "files/file_upload/img/".$data->upload_files;
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->upload_files);
        $stmt->execute();                                
        echo '1';
        $stmt->close();        
    }

    function overviewAddYouTube($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'INSERT INTO brah_posts (title,subtitle,video_link,cat) VALUES (?,?,?,2)';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->video_link);
        $stmt->execute();                                
        echo '1';
        $stmt->close();  
    }

    function overviewAddVimeo($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'INSERT INTO brah_posts (title,subtitle,video_link,cat) VALUES (?,?,?,4)';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->video_link);
        $stmt->execute();                                
        echo '1';
        $stmt->close();  
    }

    function overviewGetAllElements(){
        $db = $this->conn;                
        $sql = "SELECT image,id,title,subtitle,added,status FROM brah_posts ORDER BY added DESC";        
        $stmt = $db->prepare($sql);        
        // $stmt->bind_param('s' ,$id);        
        $stmt->execute();       

        // $stmt->bind_result($testo);              
        // $result = array();               
        // while($stmt->fetch()) {                                    
        //     $result[0] = html_entity_decode(htmlspecialchars_decode($testo));                                  
        // }

        // $res = $stmt->get_result();   
        
        $stmt->bind_result($image,$id,$title,$subtitle,$added,$status); 
        $i = 0;                     
        while($stmt->fetch()) {                                    
            $i++;
            echo '<tr>';  
            if(empty($image))
                echo '<td class="align-middle">video</td>';
            else
                echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$image.'" class="rounded float-left" alt="'.$image.'"></td>';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';                 
            echo '<td class="align-middle">'.$title.'</td>';
            echo '<td class="align-middle">'.$subtitle.'</td>';
            $status2 = ($status == 1) ? 0 : 1;
            echo ($status == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';        
            echo '<td class="table-200">'.$added.'</td>';                                            
            echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';
            echo '<td class="table-short table-activate align-middle" val="'.$status2.'">';
            echo ($status == 1) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';            
            //echo '<td class="table-short"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';            
            echo '</tr>';              
        }
        
        // $i = 0;
        // while ($row = $res->fetch_assoc()) {
        //     $i++; 
        //     echo '<tr>';                   
        //     foreach ($row as $key => $value) {
        //         switch ($key) {
        //             case 'image':
        //                 if(empty($value))
        //                     echo '<td class="align-middle">video</td>';
        //                 else
        //                     echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$value.'" class="rounded float-left" alt="'.$value.'"></td>';
        //                 break;
        //             case 'id':
        //                 echo '<td class="table-short table-id align-middle" val="'.$value.'">'.$i.'</td>';     
        //                 $id = $value;
        //                 break;
        //             case 'status':
        //                 $status = ($value == 1) ? 0 : 1;
        //                 echo ($value == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';
        //                 break;
        //             case 'added':
        //                 echo '<td class="table-200">'.$value.'</td>';
        //                 break;
        //             default:
        //             echo '<td class="align-middle">'.$value.'</td>';
        //                 break;
        //         }                
        //     }         
        //     echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';

        //     echo '<td class="table-short table-activate align-middle" val="'.$status.'">';
        //     echo ($status == 0) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';
            
        //     //echo '<td class="table-short"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';            
        //     echo '</tr>';              
        // }

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
                  
            $tags = explode(',', $tags);     
            $tags_length = count($tags);   
            foreach($tags as $key => $value){
                $key++;
                if($tags_length === $key){
                    echo '<a href="'.$value.'">'.$value.' </a>';
                }else{
                    echo '<a href="'.$value.'">'.$value.' / </a>';
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

    function loadStory($data){
        $db = $this->conn;                
        $sql = "SELECT title,tags,cat,content,added,gallery 
        FROM brah_stories 
        WHERE status = 1 AND id = ?
        ORDER BY added DESC";        
        $stmt = $db->prepare($sql);                      
        $stmt->bind_param('d', $data->story_id);
        $stmt->execute();       

        $stmt->bind_result($title,$tags,$cat,$content,$added,$gallery); 
        $i = 0;                     
        while($stmt->fetch()) {                                    
            $i++;        

            echo 
            '
                <div class="stories-cat">
            ';   

            $tags = explode(',', $tags);     
            $tags_length = count($tags);   
            foreach($tags as $key => $value){
                $key++;
                if($tags_length === $key){
                    echo '<a href="'.$value.'">'.$value.' </a>';
                }else{
                    echo '<a href="'.$value.'">'.$value.' / </a>';
                }
            }

            echo '
                </div>
                <div class="stories-title" style="font-size:34px;">
                    '.$title.'
                </div>
                <hr class="stories-hr">
                <div class="stories-detail">'.$added.'</div>

                <hr class="hr2" style="margin-top: 50px;">

                <div class="stories-content">
                '.html_entity_decode($content).'
                </div>

                <div class="stories-footer">
            ';

            if($gallery != null){
                $gallery = explode('/', $gallery);
                $gallery_length = count($gallery);
                echo '<hr class="hr2">';
                foreach($gallery as $key => $value){
                    $key++;
                    echo $value.'<br>';
                }
            }
                    
            echo'
                </div>
            ';   
        }                
        $stmt->close();                        
    }

    function addNewStory($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);            
            exit();
        }      
        $data->upload_files = "files/file_upload/img/".$data->upload_files;     
        $data->content_code = htmlentities($data->content_code);           
        $sql = 'INSERT INTO brah_stories (title, img, tags, content, gallery) VALUES (?, ?, ?, ?, ?)';
        $stmt = $db->prepare($sql);        
        if($data->masonry_gallery == '') $data->masonry_gallery = NULL;
        $stmt->bind_param('sssss', $data->title, $data->upload_files, $data->tags, $data->content_code, $data->masonry_gallery);
        $stmt->execute();                                
        echo '1';
        $stmt->close(); 
    }

    function storiesGetAllElements(){
        $db = $this->conn;                
        $sql = "SELECT img,id,title,tags,added,status,content FROM brah_stories ORDER BY added DESC";        
        $stmt = $db->prepare($sql);                
        $stmt->execute();               
        $stmt->bind_result($img,$id,$title,$tags,$added,$status,$content); 
        $i = 0;                     
        while($stmt->fetch()) {                                    
            $i++;
            echo '<tr>';  
            if(empty($img))
                echo '<td class="align-middle">video</td>';
            else
                echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$img.'" class="rounded float-left" alt="'.$img.'"></td>';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';                 
            echo '<td class="align-middle">'.$title.'</td>';
            echo '<td class="align-middle">'.$tags.'</td>';
            echo '<td style="display:none;">'.html_entity_decode($content).'</td>';
            $status2 = ($status == 1) ? 0 : 1;
            echo ($status == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';        
            echo '<td class="table-200">'.$added.'</td>';                                            
            echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';
            echo '<td class="table-short table-activate align-middle" val="'.$status2.'">';
            echo ($status == 1) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';            
            //echo '<td class="table-short"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';            
            echo '</tr>';              
        }
        $stmt->close();                        
    }

    function storiesChangeElementStatus($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'UPDATE brah_stories SET status=? WHERE id=?';
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

    function storiesEditElement($data){
        $db = $this->conn;
        $data->content_code = htmlentities($data->content_code);       
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);              
            exit();
        }             
        $sql = 'UPDATE brah_stories SET title=?, tags=?, content=? WHERE id=?';
        $stmt = $db->prepare($sql);        
        $stmt->bind_param('ssss', $data->title, $data->tags, $data->content_code, $data->id);
        $stmt->execute();         
                             
        $result = array(
            'success'       => 1                        
        );               
        echo json_encode($result);
        $stmt->close();  
    }

}
?>
