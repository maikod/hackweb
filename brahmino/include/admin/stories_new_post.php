<div class="adm-panel">
    <div class="adm-title">Add a new Story</div>
    <br>

    <form id="stories-load_form" enctype="multipart/form-data" encoding="multipart/form-data" method="post">

        <div class="form-group form-large">
        
            <label for="title">Title:</label>
            <input type="text" class="load_form form-control required" id="title" name="title">
            <br>

            <label>Story cover:</label>
            <div class="story-cover" id="story-cover"></div>
            <br>

            <div class="file_upload">
                <span class="btn btn-info fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Cover Photo</span>
                    <!-- <input id="fileupload" type="file" name="files[]" multiple> -->
                    <input id="fileupload" class="load_form required" type="file" name="files[]" >
                </span>
                <br>
                <br>
                <div id="progress" class="progress" style="">
                    <div class="progress-bar progress-bar-success"></div>
                    <div class="progress-percentage" style=""></div>
                </div>
                <div id="files" class="files">picture name:</div>
            </div>
            <br>

            <label for="cat">Categories: (comma separated)</label>
            <textarea class="load_form form-control required" rows="3" id="cat" name="cat"></textarea>
            <br>

            <label for="tags">Tags: (comma separated)</label>
            <textarea class="load_form form-control" rows="3" id="tags" name="tags"></textarea>
            <br>

            <label>Content:</label>
            <div id="summernote" class="required"></div>
            <br>            

            <div class="file_upload file_upload_masonry" style="display:none;">
                <span class="btn btn-info fileinput-button" style="">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Edit Masonry Gallery</span>
                    <input id="fileupload_masonry" type="file" name="files[]" multiple >
                    <!-- <input id="fileupload_masonry" class="load_form required" type="file" name="files[]" > -->
                </span>
                <br>
                <br>
                <div id="progress_masonry" class="progress" style="">
                    <div class="progress-bar progress-bar-success"></div>
                    <div class="progress-percentage" style=""></div>
                </div>
                <div id="files_masonry" class="files sortable">pictures (move to change order):
                    <br>
                </div>
                <div style="float:none; clear:both;"></div>
                <div class="form-check form-check-inline" style="margin-top:20px;">
                    <input class="form-check-input" type="radio" name="radioBorder" id="inlineRadio1" value="white" checked>
                    <label class="form-check-label" for="inlineRadio1">White border</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioBorder" id="inlineRadio2" value="noborder">
                    <label class="form-check-label" for="inlineRadio2">No border</label>
                </div>                                
            </div>            

            <div class="map-edit" style="display:none;">
                <h2>Map Options</h2>
                <label>Map Address:</label>
                <input type="text" class="load_form form-control" name="mapAddress">
                <br>

                <label>Marker Text:</label>
                <input type="text" class="load_form form-control" name="mapText">
                <br>
                </div>       

                <input type="hidden" name="content_code">
                <input type="hidden" name="upload_files" class="required">
                <input type="hidden" name="masonry_gallery">
            </div>
        
        <button type="submit" class="btn btn-default adm-btn_load">Post</button>
        <button type="submit" class="btn btn-default adm-btn_preview" style="background-color:#ccc;">Preview</button>        
        <span class="loading-text" style="margin-left:20px; display:none;">Loading...</span>
        <div class="text-danger load-status"></div>       

    </form>

    <!-- modals -->
    <?php include_once('modals/GalleryBorder.php'); ?>
    <?php include_once('modals/summer_map.php'); ?>

</div>

<script>
var upload_files = "";
var upload_files_masonry = "";
var map = false;
var border = 'white';
var markerAddress = "Bologna, Italy";
var markerMessage = "Today's working here.";
var coverPic = '';
var galleryPic = '';
var markerAddress = '';
var markerMessage = '';

//cover file upload
init_fileupload();

$('.required').focusin(function(){
    $(this).removeClass('warning');
});

$('.required').focusout(function(){
    checkFormField($(this));
});

//save data
$('.adm-btn_load').click(function(e){
    e.preventDefault();    
    $('.loading-text').show();
    $('.adm-btn_load').prop('disabled', true).addClass('adm-btn_disabled');    
    //editing the map
    editMapSave();     
    //adding the final code
    var content_code = $('#summernote').summernote('code');   
    //creating the story
    addNewStory('addNewStory', content_code).then(function(){
        $('.loading-text').hide();
        $('.adm-btn_load').prop('disabled', false).removeClass('adm-btn_disabled');
    });
    return false;
});

//preview button
$('.adm-btn_preview').click(function(e){
    e.preventDefault();    
    //implement apertura nuova pagina con la preview della storia attuale
    var content = $('#summernote').summernote('code');  
    // localStorage.storyPreviewContent = content;  
    // createCookie('storyPreviewContent', content, 1);
    
    //write to session with serverside script
    var send_data = { 
        action: 'saveToSession', 
        data: { 
            name: 'storyPreviewContent',
            content: content            
        } 
    };  
    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {
            console.log(data);
        }
    });

    createCookie('storyPreviewTitle', $('input[name="title"]').val(), 1);
    createCookie('storyPreviewCat', $('#cat').val(), 1);
    createCookie('storyPreviewTags', $('#tags').val(), 1);
    createCookie('storyPreviewGallery', upload_files_masonry, 1);
    var link = location.href.split('/'+HOST);     
    var url = link[0]+'/'+HOST+'/__/previewPage/storyPreview';
    window.open(url);
    return false;
});

//masonry gallery fileupload
$('#fileupload_masonry').fileupload({
    url: upload_url,
    dataType: 'json',
    done: function (e, data) {
        $('.file_upload').show();        
        $(this).parent().removeClass('warning');

        $.each(data.result.files, function (index, file) {
            //modifica img                        
            $('<div class="img-container-gallery editable-img" />')
            .append('<div class="img-delete-gallery"><i class="fa fa-trash-alt"></i></div><img src="files/file_upload/img/overview/'+file.name+'" val="'+file.name+'" />')
            .appendTo('#files_masonry');

            upload_files_masonry += file.name + ',';

            //aggiunta gallery a summernote
            // var node = $('<div class="summernote-masonry">').html(''+
            //     '<div class="stories-gallery-grid">'+
            //         '<div class="stories-gallery-cell-sizer"></div>'+
            //         '<div class="stories-gallery-gutter-sizer"></div>'+
            //         '<div class="stories-gallery-cell">'+
            //             '<a data-fancybox="gallery" href="files/file_upload/img/'+file.name+'">'+
            //                 '<img class="stories-gallery-img" src="files/file_upload/img/'+file.name+'" />'+
            //             '</a>'+
            //         '</div>'+
            //     '</div>'+
            // '');
            // $('#summernote').summernote('insertNode', node[0]);

            //aggiunta gallery a summernote
            if($('#summernote').summernote('code').indexOf('class="summernote-masonry-gallery"') < 0){
                $('#summernote').summernote('restoreRange');
                var node = $('<div><img class="summernote-masonry-gallery" border="'+border+'" src="img/admin/masonry.png" style="width: 300px;"></div>');
                $('#summernote').summernote('insertNode', node[0]);                      
            }
            
        });        

        $('input[name="masonry_gallery"]').val(upload_files_masonry);
        
        //settin del radio relativo al border
        $('input[name=radioBorder][value='+border+']', '#stories-load_form').prop('checked',true);                

        // $("#fileupload_masonry").prop('disabled', true);
        // $("#fileupload_masonry").parent().addClass('disabled');
        $('#files_masonry').show();
    },
    progressall: function (e, data) {
        $('#progress_masonry').fadeTo( "fast" , 1);
        var progress = parseInt(data.loaded / data.total * 100, 10);
        if(progress > 0)
        {
            $('#progress_masonry .progress-percentage').html(progress + '%');
        }
        $('#progress_masonry .progress-bar').css(
            'width',
            progress + '%'
        );
    }
})
.prop('disabled', !$.support.fileInput)
.parent().addClass($.support.fileInput ? undefined : 'disabled');



//sortable foto masonry
$( ".sortable" ).sortable({
    cursor: "auto",
    update: function( event, ui ) {
        $item = ui.item;
        var itemName = $item.attr('val');
        $prev = $item.prev();
        $next = $item.next();
        var ord = 0;
        var filesArr = upload_files_masonry.split(',');

        for (var k in filesArr){
            if (filesArr.hasOwnProperty(k)) {
                //console.log("Key is " + k + ", value is" + filesArr[k]);
            }
        }

        upload_files_masonry = '';

        $('#files_masonry img').each(function(){
            //console.log($(this).attr('val'));
            var fileName = $(this).attr('val');
            upload_files_masonry += fileName + ',';
        });

        $('input[name="masonry_gallery"]').val(upload_files_masonry);
        console.log(upload_files_masonry);
    }
});
$( ".sortable" ).disableSelection();


//summernote init
$('#summernote').summernote(summerStoryOptions);


$(function(){

    //modal masonry click
    $('#modal-admin .modal-border').click(function(){
        border = $(this).attr('val');
        setTimeout(function(){
            $('#fileupload_masonry').click();
        }, 300);
    });


    //modal map click
    $('#modal-admin-summer-map .modal-map').click(function(){
        markerAddress = $('#marker-address').val();
        markerMessage = $('#marker-message').val();
        setTimeout(function(){

            //aggiunta mappa per l'invio
            map = true;

            // aggiunta mappa a summernote
            if($('#summernote').summernote('code').indexOf('class="summernote-map"') < 0){                                
                $('#summernote').summernote('restoreRange');
                var node = $('<div><div class="summernote-map-content" message="'+markerMessage+'" address="'+markerAddress+'" style="display:none;"></div><img class="summernote-map" src="img/admin/map.png" style="width: 300px;"></div>');                
                $('#summernote').summernote('insertNode', node[0]);          
                //init map check
                editMapInit();
            }

        }, 300);
    });


    //delete cover photo
    $('body').off('click', '.img-delete');
    $('body').on('click', '.img-delete', function(){
        var el = $(this).parent();
        var picArr = $('img', el).attr('src').split('/');
        coverPic = picArr[picArr.length - 1];

        console.log(coverPic);

        var send_data2 = { 
            action: 'deleteFiles', 
            data: { 
                file: coverPic
            } 
        };  
        $.ajax({
            type: "POST",
            url: "libs/call_func.php",
            data: JSON.stringify(send_data2),
            contentType: "application/json",
            async: true,
            success : function(data)
            {
                if(data == 1){
                    el.remove();
                    upload_files = '';
                    $('input[name="upload_files"]').val(upload_files);            
                    $("#fileupload").prop('disabled', false);
                    $("#fileupload").parent().removeClass('disabled');
                    //reset progress bar
                    var progress = 0;
                    $('#progress .progress-percentage').html(progress + '%');                    
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }
        });                
    });


    //delete gallery photos
    $('body').off('click', '.img-delete-gallery');
    $('body').on('click', '.img-delete-gallery', function(){
        var el = $(this).parent();
        var picArr = $('img', el).attr('src').split('/');
        galleryPic = picArr[picArr.length - 1];

        var send_data3 = { 
            action: 'deleteFiles', 
            data: { 
                file: galleryPic
            } 
        };  
        $.ajax({
            type: "POST",
            url: "libs/call_func.php",
            data: JSON.stringify(send_data3),
            contentType: "application/json",
            async: true,
            success : function(data)
            {
                if(data == 1){
                    el.remove();
                    upload_files_masonry = upload_files_masonry.replace(galleryPic+',', '');
                    $('input[name="masonry_gallery"]').val(upload_files_masonry); 
                    // $("#fileupload").prop('disabled', false);
                    // $("#fileupload").parent().removeClass('disabled');
                    //reset progress bar
                    var progress = 0;
                    $('#progress_masonry .progress-percentage').html(progress + '%');                    
                    $('#progress_masonry .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                    
                    //remove gallery from summernote
                    if(upload_files_masonry == ''){                
                        var node = '<img class="summernote-masonry-gallery" border="'+border+'" src="img/admin/masonry.png" style="width: 300px;">';
                        var newCode = $('#summernote').summernote('code');
                        newCode = newCode.replace(node,'<br>');      
                        $('#summernote').summernote('reset');                  
                        $('#summernote').summernote('code', newCode);                                                                   
                        $('.file_upload_masonry').hide();
                    }                    
                }
            }
        });                
    });

    
    //radio button changing border between pictures    
    $('input[name=radioBorder]').change(function() {                         
        //modifica del border dentro summernote
        if($('#summernote').summernote('code').indexOf('class="summernote-masonry-gallery"') > 0){            
            var node = '<img class="summernote-masonry-gallery" border="'+border+'" src="img/admin/masonry.png" style="width: 300px;">';   
            var newCode = $('#summernote').summernote('code'); 
            border = this.value; //assigning the new value to border
            var newNode = '<img class="summernote-masonry-gallery" border="'+border+'" src="img/admin/masonry.png" style="width: 300px;">';            
            newCode = newCode.replace(node,newNode);      
            $('#summernote').summernote('reset');                  
            $('#summernote').summernote('code', newCode);                  
        }        
    }); 

});

</script>