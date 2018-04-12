<?php
$connection = "../../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

if(intval($result['potere']) < 0) return;
?>

<div class="admin-left-menu closed-hor">
    <div class="menu-buttons left-menu">
        <ul>
            <li class="big-sec"><a class="adm-btn adm-link" href=""><i class="fa fa-tachometer"></i>Dashboard</a><br></li>            
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-welcome">Welcome</a></li>                             
            </div>

            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-picture-o"></i>Overview</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-overview">All Elements</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-overview_new_photo">New picture/gif</a></li>        
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-overview_new_video">New Video</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-overview_new_youtube">New YouTube</a></li>    
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-overview_new_vimeo">New Vimeo</a></li>                        
            </div>  

            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-file"></i>Stories</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-stories_all_posts">All Stories</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-stories_new_post">New Story</a></li>    
            </div>   
            
            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-book"></i>MoodBox</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">All</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">PDF</a></li>  
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">Pricing</a></li>    
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">PayPal</a></li>    
            </div>            

            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-map"></i>Maps</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">All Maps</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">New Map</a></li>    
            </div>

            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-envelope"></i>Mailchimp</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">All Mails</a></li>
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">New Mail</a></li>    
            </div>   

            <li class="big-sec "><a class="adm-btn adm-link" href=""><i class="fa fa-heart"></i>Analytics</a><br></li>    
            <div class="sub-selected">
                <li class="small-sec"><a class="adm-btn adm-link" href="adm-">Dashboard</a></li>                
            </div>   
        </ul>
    </div>
</div>

<script>    
$('.small-sec', '.admin-left-menu').bind('click', changeAdminPage);
$('.big-sec', '.admin-left-menu').bind('click', expandMenuSec);
</script>