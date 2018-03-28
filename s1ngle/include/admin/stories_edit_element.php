<form id="" enctype="multipart/form-data" encoding="multipart/form-data" method="post">    
    <div class="form-group form-large">
        <label for="title">Title:</label>
        <input type="text" class="load_form form-control required" id="title" name="title">
        <br>
        <label>Content:</label>
        <div id="summernote" class="required"></div>
        <br>
        <label for="tags">Tags: (comma separated)</label>
        <textarea class="load_form form-control required" rows="3" id="tags" name="tags"></textarea> 
        
        <input type="hidden" name="content_code">
    </div>

    <button type="submit" class="btn-save btn btn-primary">Save</button>
    <button type="button" class="btn-cancel btn btn-secondary">Cancel</button>
    <div class="text-danger load-status"></div>
</form>

<script>

</script>