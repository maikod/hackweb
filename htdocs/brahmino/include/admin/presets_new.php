<div class="adm-panel">
    <div class="adm-title">Create a new presets</div>
    <br>

    <form id="presets-load_form" enctype="multipart/form-data" encoding="multipart/form-data" method="post">
        <div class="file_upload">            
            <span class="btn btn-info fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Upload Pictures</span>                
                <!-- <input id="fileupload" type="file" name="files[]" multiple> -->
                <input id="fileupload" class="load_form required" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>            
            <div id="progress" class="progress" style="">
                <div class="progress-bar progress-bar-success"></div>
                <div class="progress-percentage" style=""></div>
            </div>            
            <div id="files" class="files">pictures names:</div>
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="load_form form-control required" id="title" name="title">
            <br>

            <label for="subtitle">Subtitle:</label>
            <input type="text" class="load_form form-control required" id="subtitle" name="subtitle">
            <br>

            <label for="name">Name:</label>
            <input type="text" class="load_form form-control required" id="name" name="name">
            <br>
            
            <label for="description">Description:</label>
            <textarea class="load_form form-control required" rows="3" id="description" name="description"></textarea>
            <br>

            <label for="title">Preset Code (not shown to customer):</label>
            <input type="text" class="load_form form-control required" id="code" name="code">
            <br>

            <div class="dropdown">
                <button name="price" class="btn btn-secondary dropdown-toggle required" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Price
                </button>
                <div class="dropdown-menu presets-price" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-item" href="">50,00 €</div>
                </div>
                <label class="presets-price-label" style="margin-left:20px;"></label>
            </div>            
            
            <br>

            <input type="hidden" name="upload_files">
            <input class="" type="hidden" name="price">
        </div>

        <button type="submit" class="btn btn-default adm-btn_load">Upload</button>
        <div class="text-danger load-status"></div>
    </form>

</div>

<script>

$('.presets-price .dropdown-item').click(function(){
    var price = $(this).html();
    $('.presets-price-label').html(price);
    $('input[name="price"]').val(price);
    $(this).parent().prev().removeClass('warning');
});

var upload_files = "";

$('#fileupload').fileupload({
    url: upload_url,
    dataType: 'json',
    done: function (e, data) {                   
        $(this).parent().removeClass('warning');
        $.each(data.result.files, function (index, file) {
            $('<p/>').text(file.name).appendTo('#files');
            upload_files += file.name + ',';                               
        });
        $('input[name="upload_files"]').val(upload_files);            
        $("#fileupload").prop('disabled', true);
        $("#fileupload").parent().addClass('disabled');
        // $('.files').show();
    },
    progressall: function (e, data) {
        $('.progress').fadeTo( "fast" , 1);
        var progress = parseInt(data.loaded / data.total * 100, 10);
        if(progress > 0)
        {
            $('#progress .progress-percentage').html(progress + '%');
        }
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }
})
.prop('disabled', !$.support.fileInput)
.parent().addClass($.support.fileInput ? undefined : 'disabled');

$('.required').focusin(function(){
    $(this).removeClass('warning');
});

$('.required').focusout(function(){
    checkFormField($(this));
});

$('.adm-btn_load').click(function(e){
    e.preventDefault();    
    addNewPreset('addNewPreset');
    return false;
});

</script>