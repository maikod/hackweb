<?php
@session_start();

$title =  $_COOKIE['storyPreviewTitle'];
$cat = $_COOKIE['storyPreviewCat'];
$added = 'RIGHT NOW';
$content = $_SESSION['storyPreviewContent'];
$gallery = $_COOKIE['storyPreviewGallery'];
$tags = $_COOKIE['storyPreviewTags'];

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

    // replace the gallery in content
    $content = str_replace($replace_white, $mason_white, $content);
    $content = str_replace($replace_noborder, $mason_noborder, $content);

}

// map
// extracting map from content
$map = '<div class="map-container">
    <div id="map"></div>
</div>';

$replaceMap = '<img class="summernote-map" src="img/admin/map.png" style="width: 300px;">';

// replacing map
$content = str_replace($replaceMap, $map, $content);

// writing content
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

// tags
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
</div>
';
?>