<div class="file_upload">
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>        
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress" style="">  
        <div class="progress-percentage" style=""></div>
        <div class="progress-bar progress-bar-success" ></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>
</div>

<script>
    $(window).on('load', function () {
        
    });
    $(function(){
        
    });
    init_fileupload();
</script>