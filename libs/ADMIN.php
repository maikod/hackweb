<?php
/*******************************************************
* Copyright (C) 2005-2018 Francesco La Placa - hackweb
*
* This file is part of hwFramework.
*
* This Framework can not be copied and/or distributed without the express
* permission of author
******************************************************/

// require_once("DB.php");
require_once(dirname(__FILE__)."/DB.php");

class ADMIN extends DB
{
    var $test = "test";

    function __construct() {
        // parent::__construct();
    }

    function __destruct(){
        // parent::__destruct();
    }


    function login($data){
        $data->password = md5($data->password);
        $ric = $data->ric;
        $sess_id = rand();
        // $this->sql_open();
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = "SELECT potere FROM accounts WHERE password = ? AND username = ?";
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
            // if($db == null) echo 'wtf?';

            if ($db->connect_errno) {
                echo("Connect failed: " . $db->connect_error);
                exit();
            }            
            $sql = "SELECT username FROM accounts WHERE sess_id = ?";
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

    function overviewLoad($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'INSERT INTO brah_posts (title, subtitle, image, ord2) VALUES (?, ?, ?, NOW())';
        $stmt = $db->prepare($sql);
        $data->upload_files = "files/file_upload/img/overview/".$data->upload_files;
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->upload_files);
        $stmt->execute();
        echo '1';
        $stmt->close();
    }

    function overviewLoadVideo($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'INSERT INTO brah_posts (title,subtitle,image,cat,ord2) VALUES (?,?,?,3,NOW())';
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
        $sql = 'INSERT INTO brah_posts (title,subtitle,video_link,cat,ord2) VALUES (?,?,?,2,NOW())';
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
        $sql = 'INSERT INTO brah_posts (title,subtitle,video_link,cat,ord2) VALUES (?,?,?,4,NOW())';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $data->title, $data->subtitle, $data->video_link);
        $stmt->execute();
        echo '1';
        $stmt->close();
    }

    function overviewEditOrder($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }

        //riduzione dei precedenti
        $sql = 'UPDATE brah_posts
        SET ord2=FROM_UNIXTIME(UNIX_TIMESTAMP(ord2)-1)
        WHERE id<>? AND UNIX_TIMESTAMP(ord2)<=?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $data->id, $data->ord);
        $stmt->execute();
        $stmt->close();

        //aumento dei successivi
        $sql = 'UPDATE brah_posts
        SET ord2=FROM_UNIXTIME(UNIX_TIMESTAMP(ord2)+1)
        WHERE id<>? AND UNIX_TIMESTAMP(ord2)>?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $data->id, $data->ord);
        $stmt->execute();
        $stmt->close();

        //settaggio del nuovo post ordinato
        $sql = 'UPDATE brah_posts SET ord2=FROM_UNIXTIME(?+1) WHERE id=?';
        $stmt = $db->prepare($sql);
        $timestamp = date('Y-m-d G:i:s', $data->ord);
        $stmt->bind_param('ss', $data->ord, $data->id);
        $stmt->execute();
        $stmt->close();
        echo $data->ord;
    }

    function overviewGetAllElements(){
        $db = $this->conn;
        $sql = "SELECT image,id,title,subtitle,added,status,UNIX_TIMESTAMP(posts.ord2) FROM brah_posts AS posts ORDER BY posts.ord2 DESC";
        $stmt = $db->prepare($sql);
        // $stmt->bind_param('s' ,$id);
        $stmt->execute();

        // $stmt->bind_result($testo);
        // $result = array();
        // while($stmt->fetch()) {
        //     $result[0] = html_entity_decode(htmlspecialchars_decode($testo));
        // }

        // $res = $stmt->get_result();

        $stmt->bind_result($image,$id,$title,$subtitle,$added,$status,$ord2);
        $i = 0;
        while($stmt->fetch()) {
            $i++;
            echo '<tr val="'.$id.'" ord="'.$ord2.'">';
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
            echo '<td class="table-short align-middle"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';
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

    function overviewDeleteElement($data){
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

    function loadStory($data){
        $db = $this->conn;
        $other_stories = '';
        $sql = "SELECT id,title,img,tags,cat,content,added
        FROM brah_stories
        WHERE status = 1
        ORDER BY RAND()
        LIMIT 3";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $stmt->bind_result($id,$title,$img,$tags,$cat,$content,$added);
        $suggested_stories = array();
        $i = 0;
        while($stmt->fetch()) {
            $suggested_stories[$i] = array(
                'id' => $id,
                'title' => $title,
                'img' => $img,
                'tags' => $tags,
                'cat' => $cat,
                'content' => $content,
                'added' => $added
            );
            $i++;
        }
        $stmt->close();

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

            $added = strtotime( $added );
            $added = date( 'Y-m-d', $added );

            echo '
                </div>
                <div class="stories-title" style="font-size:34px;">
                    '.$title.'
                </div>
                <hr class="stories-hr">
                <div class="stories-detail">
                    '.$added.'        
                    <br>          
                    <div data-width="124" style="width:124px!important; margin:0 auto; margin-top: 15px;" id="fb-like-btn" class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>                    
                </div>                

                <hr class="hr2" style="margin-top: 30px;">

                <div class="stories-content">
            ';

            $content = html_entity_decode($content);

            if($gallery != null){
                $gallery = explode(',', $gallery);
                $gallery_length = count($gallery);

                $mason_white =
                '
                    <div class="stories-gallery-grid">
                        <div class="stories-gallery-cell-sizer"></div>
                        <div class="stories-gallery-gutter-sizer"></div>
                ';
                $mason_noborder =
                '
                    <div class="stories-gallery-grid stories-gallery-grid-noborder">
                        <div class="stories-gallery-cell-sizer"></div>
                        <div class="stories-gallery-gutter-sizer"></div>
                ';

                foreach($gallery as $key => $value){
                    $key++;
                    if($gallery_length > $key){
                        $image = 'files/file_upload/img/overview/'.$value;
                        $mason_white .= '<div class="stories-gallery-cell">
                                <a data-fancybox="gallery" href="'.$image.'">
                                    <img class="stories-gallery-img" src="'.$image.'" />
                                </a>
                            </div>
                        ';
                        $mason_noborder .= '<div class="stories-gallery-cell">
                                <a data-fancybox="gallery" href="'.$image.'">
                                    <img class="stories-gallery-img" src="'.$image.'" />
                                </a>
                            </div>
                        ';
                    }
                }

                $mason_white .= '</div>';
                $mason_noborder .= '</div>';

                $replace_white = '<img class="summernote-masonry-gallery" border="white" src="img/admin/masonry.png" style="width: 300px;">';
                $replace_noborder = '<img class="summernote-masonry-gallery" border="noborder" src="img/admin/masonry.png" style="width: 300px;">';

                //replace the gallery in content
                $content = str_replace($replace_white, $mason_white, $content);
                $content = str_replace($replace_noborder, $mason_noborder, $content);

            }

            //map
            //extracting map from content
            $map = '<div class="map-container">
                <div id="map"></div>
            </div>';

            $replaceMap = '<img class="summernote-map" src="img/admin/map.png" style="width: 300px;">';

            //replacing map
            $content = str_replace($replaceMap, $map, $content);

            //writing content
            echo ''.$content.'
                </div>

                <div class="stories-footer">
                    <hr class="hr2">
                    <br>
                    <div class="social_share_wrapper shortcode"><h5 style="font-weight:300;letter-spacing: 1px;font-size:24px;">SHARE ON</h5>
                        <br>
                        <ul class="stories-social-list">
                            <li><a class="stories-social-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.brahmino.com"><i class="fab fa-facebook-f marginright"></i></a></li>
                            <li><a class="stories-social-tw" target="_blank" href="https://twitter.com/intent/tweet?original_referer=https://www.brahmino.com&amp;url=https://www.brahmino.com"><i class="fab fa-twitter marginright"></i></a></li>
                            <li><a class="stories-social-pi" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=https://www.brahmino.com"><i class="fab fa-pinterest-p marginright"></i></a></li>
                            <li><a class="stories-social-go" target="_blank" href="https://plus.google.com/share?url=https://www.brahmino.com"><i class="fab fa-google-plus-g marginright"></i></a></li>
                        </ul>
                    </div>
            ';

            //tags
            if($tags != null && $tags != ''){

                $tags = explode(',', $tags);
                $tags_length = count($tags);

                echo '<div class="post_excerpt post_tag">
                        <i class="fa fa-tags"></i>';

                foreach($tags as $key => $value){
                    if($tags_length > $key){
                        echo '<a rel="tag">'.$value.'</a>';
                    }
                }

                echo '
                        </div>
                ';
            }

            echo
            '
            <br><br>
            <hr class="hr2">
            <span style="letter-spacing:2px;">YOU MIGHT ALSO LIKE</span>
            <hr class="stories-hr">
            <div class="stories-suggested">
            ';

            //dev10n - get 3 stories
            foreach($suggested_stories as $key => $value){
                $value['added'] = strtotime( $value['added'] );
                $value['added'] = date( 'Y-m-d', $value['added'] );
                echo
                '
                <div id="'.$value['id'].'" class="stories-cell stories-suggested-cell" style="">
                    <div class="stories-img">
                        <a class="stories-link" href="'.$value['id'].'">
                            <img src="'.$value['img'].'" alt="'.$value['title'].'" class="">
                        </a>
                    </div>
                    <div class="stories-cat">
                ';

                $value['cat'] = explode(',', $value['cat']);
                $cat_length = count($value['cat']);
                foreach($value['cat'] as $key => $value2){
                    $key++;
                    if($cat_length === $key){
                        echo '<a >'.$value2.' </a>';
                    }else{
                        echo '<a >'.$value2.' / </a>';
                    }
                }

                echo '
                    </div>
                    <div class="stories-title">
                        <a class="stories-link" href="'.$value['id'].'" title="'.$value['title'].'">'.$value['title'].'</a>
                    </div>
                    <hr class="stories-hr">
                    <div class="stories-detail">'.$value['added'].'</div>
                </div>
                ';
            }

            echo'
            </div>
            ';

            echo
            '
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
        $data->upload_files = "files/file_upload/img/storiescover/".$data->upload_files;
        $data->content_code = htmlentities($data->content_code);
        $sql = 'INSERT INTO brah_stories (title, img, tags, content, gallery, cat) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $db->prepare($sql);
        if($data->masonry_gallery == '') $data->masonry_gallery = NULL;
        $stmt->bind_param('ssssss', $data->title, $data->upload_files, $data->tags, $data->content_code, $data->masonry_gallery, $data->cat);
        $stmt->execute();
        echo '1';
        $stmt->close();
    }

    function storiesGetAllElements(){
        $db = $this->conn;
        $sql = "SELECT img,id,title,tags,added,status,content,gallery,cat FROM brah_stories ORDER BY added DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($img,$id,$title,$tags,$added,$status,$content,$gallery,$cat);
        $i = 0;
        while($stmt->fetch()) {
            $i++;
            echo '<tr gallery="'.$gallery.'" cat="'.$cat.'" cover="'.$img.'">';
            if(empty($img))
                echo '<td class="align-middle">video</td>';
            else
                echo '<td class="table-short align-middle"><img style="max-height:50px;" src="'.$img.'" class="rounded float-left stories-cover" alt="'.$img.'"></td>';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';
            echo '<td class="align-middle row-story-title">'.$title.'</td>';
            echo '<td class="align-middle">'.$tags.'</td>';
            echo '<td style="display:none;">'.html_entity_decode($content).'</td>';
            $status2 = ($status == 1) ? 0 : 1;
            echo ($status == 1) ? '<td class="align-middle table-status text-success table-short">Online</td>' : '<td class="align-middle table-status text-danger table-short">Offline</td>';
            echo '<td class="table-200">'.$added.'</td>';
            echo '<td class="table-short align-middle"><button type="button" class="btn-edit btn btn-primary btn-sm">Edit</button></td>';
            echo '<td class="table-short table-activate align-middle" val="'.$status2.'">';
            echo ($status == 1) ? '<button type="button" class="btn btn-secondary btn-sm">Deactivate</button></td>' : '<button type="button" class="btn btn-success btn-sm">Activate</button></td>';
            echo '<td class="table-short align-middle"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';
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
        $sql = 'UPDATE brah_stories SET title=?,tags=?,content=?,gallery=?,cat=?,img=? WHERE id=?';
        $stmt = $db->prepare($sql);
        if($data->masonry_gallery == '') $data->masonry_gallery = NULL;
        // $data->upload_files = "files/file_upload/img/storiescover/".$data->upload_files;
        $stmt->bind_param('sssssss', $data->title, $data->tags, $data->content_code, $data->masonry_gallery, $data->cat,$data->upload_files, $data->id);
        $stmt->execute();

        $result = array(
            'success'       => 1
        );
        echo json_encode($result);
        $stmt->close();
    }

    function storiesDeleteElement($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'DELETE FROM brah_stories WHERE id=?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $data->id);
        $stmt->execute();
        $stmt->close();
    }


    //presets

    function registerPurchase($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'INSERT INTO brah_purchases (article) VALUES (?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $data->article);
        $stmt->execute();
        $result = array(
            'success'           => 1,
            'pp_id'             => $stmt->insert_id
        );
        $_SESSION['pp_id'] = $stmt->insert_id;
        echo json_encode($result);
        $stmt->close();
    }

    function completePurchase($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'SELECT auth_code, tx_id FROM brah_purchases WHERE id=?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $data->pp_id);
        $stmt->execute();
        $stmt->bind_result($auth_code, $tx_id);
        $i=0;
        $result = [];
        while($stmt->fetch()) {
            $i++;
            $result[0] = $auth_code;
            $result[1] = $tx_id;
        }
        $stmt->close();

        if($result[0] == NULL && $i > 0){
            $sql = 'UPDATE brah_purchases SET auth_code=?, response=?, tx_id=? WHERE id=?';
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssss', $data->auth_code, $data->response, $data->tx, $data->pp_id);
            $stmt->execute();
            $stmt->close();
            setcookie("auth_code", $data->auth_code, time()+(3600*24*7));
            $_SESSION['auth_code'] = $data->auth_code;
            $_COOKIE['auth_code'] = $data->auth_code;
            $result[0] = $data->auth_code;
        }else{
            if($result[1] != $data->tx){
                $result[0] = 'error';
            }
        }
        return $result[0];
    }

    function downloadPreset($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        //SELECT potere FROM brah_accounts WHERE password = ? AND username = ?";
        $sql = 'SELECT downloaded FROM brah_purchases WHERE id=? AND article=? AND auth_code=?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sss', $data->id, $data->article, $data->auth_code);
        $stmt->execute();
        $stmt->bind_result($downloaded);
        $i=0;
        while($stmt->fetch()) {
            $i++;
        }
        $stmt->close();

        if($i == 1){
            $file = '../files/preset/'.$data->article.'.zip';

            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                // header("Content-Type: application/zip");
                // header("Content-Transfer-Encoding: Binary");
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                // echo file_get_contents($file);
            }
        }else{
            echo 'You have no access on this file.';
        }
    }

    function addNewPreset($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        // $data->upload_files = "files/file_upload/img/".$data->upload_files;
        $data->code = str_replace(' ', '', $data->code);
        $sql = 'INSERT INTO brah_presets (title,img,code,price,name,subtitle,description) VALUES (?,?,?,?,?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sssssss', $data->title, $data->upload_files, $data->code, $data->price, $data->name, $data->subtitle, $data->description);
        $stmt->execute();
        echo '1';
        $stmt->close();
    }

    function loadPresets($data){
        $db = $this->conn;
        $sql = "SELECT id,title,img,code,price,added,name,subtitle,description
        FROM brah_presets
        ORDER BY added DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $stmt->bind_result($id,$title,$img,$code,$price,$added,$name,$subtitle,$description);
        $i = 0;
        while($stmt->fetch()) {
            $i++;
            $added = strtotime( $added );
            $added = date( 'Y-m-d', $added );
            echo
            '
            <div class="presets-element preset-'.$id.'">
            ';

            switch ($price) {
                case '50,00 €':
                    echo '
                    <form id="pp-purchase-'.$id.'" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:none;">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                        ">
                        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>';
                break;
            }

            echo '
                <div class="presets-title">'.$title.'</div>
                <hr class="presets-hr">
                <div class="presets-subtitle">'.$subtitle.'</div>

                <div id="carouselExampleIndicators'.$id.'" class="carousel slide presets-carousel" data-ride="carousel">
                    <ol class="carousel-indicators">
            ';

            //indicatori basati sul numero delle foto
            $img = explode(',', $img);
            $img_length = count($img);
            foreach($img as $key => $value){
                $key++;
                $slide = $key-1;
                if($img_length > $key){
                    if($key == 1){
                        echo '<li data-target="#carouselExampleIndicators'.$id.'" data-slide-to="'.$slide.'" class="active"></li>';
                    }else{
                        echo '<li data-target="#carouselExampleIndicators'.$id.'" data-slide-to="'.$slide.'"></li>';
                    }
                }
            }

            echo '
                </ol>
                <div class="carousel-inner">
            ';

            foreach($img as $key => $value){
                $key++;
                if($img_length > $key){
                    if($key == 1){
                        echo '
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="files/file_upload/img/'.$value.'" alt="Pic #'.$key.'">
                        </div>';
                    }else{
                        echo '
                        <div class="carousel-item">
                            <img class="d-block w-100" src="files/file_upload/img/'.$value.'" alt="Pic #'.$key.'">
                        </div>';
                    }
                }
            }


            echo '
                    <img class="presets-img" src="files/file_upload/img/'.$img[0].'" style="display:none;">
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators'.$id.'" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators'.$id.'" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>


                <div class="presets-name">'.$name.'</div>
                <div class="presets-description">'.$description.'</div>
                <div class="presets-price">'.$price.'</div>
                <button type="button" class="btn btn-sm pp-purchase-btn pp-purchase" item="'.$title.'" val="'.$code.'" id="'.$id.'">
                    <i class="fa fa-shopping-cart" style="margin-right:3px;"></i> Buy Now
                </button>
                <span class="pp-purchase">
                    <br><img src="img/preset/paypal.png" class="paypal-img"><br><img src="img/preset/credit-cards.png" style="max-width:150px; margin-top:10px; display:none;">
                </span>
            </div>

            <hr class="hr2 presets-hr2">
            ';
        }
        $stmt->close();
    }

    function presetsGetAllElements(){
        $db = $this->conn;
        $sql = "SELECT id,code,title,price,added
        FROM brah_presets
        ORDER BY added DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $stmt->bind_result($id,$code,$title,$price,$added);
        $i = 0;
        while($stmt->fetch()) {
            $i++;
            echo '<tr val="'.$id.'" ord="'.$added.'">';
            echo '<td class="table-short table-id align-middle" val="'.$id.'">'.$i.'</td>';
            echo '<td class="align-middle">'.$title.'</td>';
            echo '<td class="align-middle">'.$code.'</td>';
            echo '<td class="align-middle">'.$price.'</td>';
            echo '<td class="table-200">'.$added.'</td>';
            echo '<td class="table-short align-middle"><button type="button" class="btn-delete btn btn-danger btn-sm">Delete</button></td>';
            echo '</tr>';
        }

        $stmt->close();
    }

    function presetsDeleteElement($data){
        $db = $this->conn;
        if ($db->connect_errno) {
            echo("Connect failed: " . $db->connect_error);
            exit();
        }
        $sql = 'DELETE FROM brah_presets WHERE id=?';
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $data->id);
        $stmt->execute();
        $stmt->close();
    }

    function saveToSession($data){
        $_SESSION[$data->name] = $data->content;
        echo $data->name;
    }

    //delete files
    function deleteFiles($data){        
        $oldDir = getcwd();
        $dir = chdir('..');        
        @unlink('files/file_upload/img/'.$data->file);
        @unlink('files/file_upload/img/thumbnail/'.$data->file);
        @unlink('files/file_upload/img/storiescover/'.$data->file);
        @unlink('files/file_upload/img/stories/'.$data->file);
        @unlink('files/file_upload/img/square/'.$data->file);
        @unlink('files/file_upload/img/overviewcrop/'.$data->file);
        @unlink('files/file_upload/img/overview/'.$data->file);
        @unlink('files/file_upload/img/high/'.$data->file);
        @unlink('files/file_upload/img/good/'.$data->file);
        echo '1';
    }


    // edit html page
    function editPage($data){
        $file = $data->page;
        $code = $data->contentCode;
        $oldDir = getcwd();
        $dir = chdir('..');        
        if(!file_exists($file)) {
            echo 'error';
            return(0);
        }
        $fileHandle = fopen($file, 'w'); 
        if(fwrite($fileHandle, $code) != false) echo '1';
        fclose($fileHandle);
        return;
    }

}
?>
