<div class="adm-panel">
    <div class="adm-title">Add a new Story</div>
    <br>

    <form id="stories-load_form" enctype="multipart/form-data" encoding="multipart/form-data" method="post">        

        <div class="form-group form-large">
            <label for="title">Title:</label>
            <input type="text" class="load_form form-control required" id="title" name="title">
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

            <label>Content:</label>
            <div id="summernote" class="required"></div>
            <br>

            <label for="tags">Tags: (comma separated)</label>
            <textarea class="load_form form-control required" rows="3" id="tags" name="tags"></textarea>
            <br><br>

            <div class="file_upload">            
                <span class="btn btn-info fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add Masonry Gallery (optional)</span>                
                    <input id="fileupload_masonry" type="file" name="files[]" multiple>
                    <!-- <input id="fileupload_masonry" class="load_form required" type="file" name="files[]" > -->
                </span>
                <br>
                <br>            
                <div id="progress_masonry" class="progress" style="">
                    <div class="progress-bar progress-bar-success"></div>
                    <div class="progress-percentage" style=""></div>
                </div>            
                <div id="files_masonry" class="files">pictures:</div>
            </div>            
            <br>

            <input type="hidden" name="content_code">
            <input type="hidden" name="upload_files">
            <input type="hidden" name="masonry_gallery">
        </div>

        <button type="submit" class="btn btn-default adm-btn_load">Post</button>
        <div class="text-danger load-status"></div>
    </form>

    
    
</div>

<script>
var upload_files = "";
var upload_files_masonry = "";
init_fileupload();

$(window).on('load', function () {
    
});

$(function(){
    // init_fileupload();  
});

$('.required').focusin(function(){
    $(this).removeClass('warning');
})

$('.required').focusout(function(){
    checkFormField($(this));
})

$('.adm-btn_load').click(function(e){
    e.preventDefault();
    var content_code = $('#summernote').summernote('code');
    addNewStory('addNewStory', content_code);
    return false;
});

$('#summernote').summernote({
    placeholder: 'Write here...',
    tabsize: 2,
    height: 300,
    callbacks: {
        onImageUpload: function(files) {                                    
            sendFile(files[0]).then(function(data){
                var image = $('<img class="summer-img">').attr('src', data);
                $('#summernote').summernote('insertNode', image[0]);                                
            });        
        }
    }
});

//masonry
$('#fileupload_masonry').fileupload({
    url: upload_url,
    dataType: 'json',
    done: function (e, data) {                   
        $(this).parent().removeClass('warning');
        $.each(data.result.files, function (index, file) {
            $('<p/>').text(file.name).appendTo('#files_masonry');
            upload_files_masonry += file.name + '/';                               
        });
        $('input[name="masonry_gallery"]').val(upload_files_masonry);            
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

</script>