<div class="adm-panel">
    <div class="adm-title">Edit Info Page</div>
    <br>

    <form id="info-infoEdit" enctype="multipart/form-data" encoding="multipart/form-data" method="post">

        <div class="form-group form-large">                        

            <label>Content:</label>
            <div id="summernote" class="required"></div>
            <br>       
            
            <label>Map Address:</label>
            <input type="text" class="load_form form-control required" name="mapAddress">
            <br>

            <label>Marker Text:</label>
            <input type="text" class="load_form form-control required" name="mapText">
            <br>

            <input type="hidden" name="content_code">            

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

// variables
var upload_files_masonry = "";
var border = 'white';
var info_pos_text = '';
var address = '';


//summernote init
$('#summernote').summernote({
    placeholder: 'Write here...',
    tabsize: 2,
    height: 600,
    callbacks: {
        onImageUpload: function(files) {
            sendFile(files[0]).then(function(data){
                var image = $('<img class="summer-img">').attr('src', data);
                $('#summernote').summernote('insertNode', image[0]);
            });
        }
    },
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['fontname', 'fontsize']],
        ['color', ['color']],
        ['para', ['table', 'ol', 'hr', 'paragraph']],
        // ['height', ['height']],
        ['insert', ['link', 'picture', 'video']],
        ['other', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
    ],
    buttons: {
        masonry: SummernoteMasonryButton,
        map: SummernoteMapButton
    }
});

//get page html
$.get('include/content/infoBody.php', function( data ) {

    //split data to obtain map informations
    var dataArr = data.split("/script>");
    info_pos_text = dataArr[0].split('info_pos_text = "')[1];
    info_pos_text = info_pos_text.split('"')[0];
    address = dataArr[0].split('address = "')[1];
    address = address.split('"')[0];    
    //setting variables in input fields
    $('input[name=mapText]', '#info-infoEdit').val(info_pos_text);
    $('input[name=mapAddress]', '#info-infoEdit').val(address);

    $('#summernote').summernote('reset');                      
    $('#summernote').summernote('code', dataArr[1]);      
}, 'html');  // or 'text', 'xml', 'more'

//preview button
$('.adm-btn_preview').click(function(e){
    e.preventDefault();            
    var content = $('#summernote').summernote('code');      
    //write to session with serverside script
    var send_data = { 
        action: 'saveToSession', 
        data: { 
            name: 'PreviewContent',
            content: content + '<br><br><div class="map-container"><div id="map"></div></div><script>var info_pos_text="'+info_pos_text+'"; var address="'+address+'";<\/script>'           
        } 
    };  
    //session creation
    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {            
            //
        }
    });
    //create cookie
    createCookie('PreviewGallery', upload_files_masonry, 1);
    //create page
    var link = location.href.split('/'+HOST);     
    var url = link[0]+'/'+HOST+'/__/previewPage/generalPreview';
    window.open(url);
    return false;
});


//save page
$('.adm-btn_load').click(function(e){
    $('.loading-text').show();
    $('.adm-btn_load').prop('disabled', true).addClass('adm-btn_disabled');
    e.preventDefault();
    var contentCode = $('#summernote').summernote('code');
    info_pos_text = $('input[name=mapText]', '#info-infoEdit').val();
    address = $('input[name=mapAddress]', '#info-infoEdit').val();
    contentCode = '<script>info_pos_text = "'+info_pos_text+'"; var address = "'+address+'";<\/script>'+contentCode;      
    editPage('editPage', 'include/content/infoBody.php', contentCode).then(function(data){        
        $('.loading-text').hide();
        $('.adm-btn_load').prop('disabled', false).removeClass('adm-btn_disabled');
    });
    return false;
});

</script>