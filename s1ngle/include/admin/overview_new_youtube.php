<div class="adm-panel">
    <div class="adm-title">Add YouTube video in the overview</div>
    <br>

    <form id="overview-load_form" enctype="multipart/form-data" encoding="multipart/form-data" method="post">

        <div class="form-group">
            <label for="title">YouTube Link:</label>
            <input type="text" class="load_form form-control" id="video_link" name="video_link">

            <label for="title">Title:</label>
            <input type="text" class="load_form form-control" id="title" name="title">

            <label for="description">Subtitle:</label>
            <textarea class="load_form form-control" rows="3" id="description" name="subtitle"></textarea>
        </div>

        <button type="submit" class="btn btn-default adm-btn_load">Upload</button>
        <div class="text-danger load-status"></div>
    </form>

</div>

<script>
initNewService("overviewAddYouTube");
</script>