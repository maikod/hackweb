<div class="adm-panel">
    <div class="adm-title">Upload a new video in the overview</div>
    <br>

    <form id="overview-load_form" enctype="multipart/form-data" encoding="multipart/form-data" method="post">
        <div class="file_upload">            
            <span class="btn btn-info fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Select a video</span>                
                <!-- <input id="fileupload" type="file" name="files[]" multiple> -->
                <input id="fileupload" class="load_form" type="file" name="files[]" >
            </span>
            <br>
            <br>            
            <div id="progress" class="progress" style="">
                <div class="progress-bar progress-bar-success"></div>
                <div class="progress-percentage" style=""></div>
            </div>            
            <div id="files" class="files">Video name:</div>
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="load_form form-control" id="title" name="title">

            <label for="description">Subtitle:</label>
            <textarea class="load_form form-control" rows="3" id="description" name="subtitle"></textarea>

            <input type="hidden" name="upload_files">
        </div>

        <button type="submit" class="btn btn-default adm-btn_load">Upload</button>
        <div class="text-danger load-status"></div>
    </form>

</div>

<script>
    var upload_files = "";
    init_fileupload();
    // initNewVideo();
    initNewService('overviewLoadVideo');
</script>