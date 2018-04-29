//admin.js


//variables
var tempEl;




var init_admin = function(){
    $('.blog-footer').hide();
    $('.pre-footer').addClass('real_hide');
    $('#admin-content').addClass("adm-margin_left");
    $('.navbar').hide();
    $('#admin-menu').load("include/admin/main_menu.php", null,function(){
        window.setTimeout(function(){
            $('#admin-menu .admin-menu').removeClass("closed-ver");
        }, 200);
        $('#admin-left-menu').load("include/admin/left_menu.php", null,function(){
            window.setTimeout(() => {
                $('#admin-left-menu .admin-left-menu').removeClass("closed-hor");
                adminFirstLoad();
            }, 200);
        });
    });
}

var initAdminLogin = function(){
    $('#admin-content').removeClass("adm-margin_left");
    $('#admin-content').load(admin_page_link, null,null);
}

var init_login = function(){
    $('#login .login').click(function(e){
        e.preventDefault();
        var send_data = { action: "login", data: objectifyForm($("#login").serializeArray()) };
        $.ajax({
            type: "POST",
            url: "libs/call_func.php",
            data: JSON.stringify(send_data),
            contentType: "application/json",
            async: true,
            success : function(data)
            {
                if(data == "1"){
                    $("#navbar .nav").append('<li><a class="nav-link" href="#hw-admin">admin</a></li>');
                    indexBinding();
                    init_admin();
                }else{
                    $('.login-status').html("wrong :(");
                }
            }
        });
        return false;
    });
}

//change admin page
var changeAdminPage = function (event){
	event.preventDefault();
    event.stopImmediatePropagation();
    var page_link = 'include/admin/';
    var $el = $(this);
	var $anchor = $('.adm-link', this);
	// $('.adm-link').each(function(){
	// 	if($(this)!=$anchor){
	// 		$(this).removeClass('active')
	// 	}
	// })
    // $anchor.addClass('active');

    $('.small-sec-active').removeClass('small-sec-active');
    $el.addClass('small-sec-active');

    var link = $anchor.attr('href').split('-');

    sezione2 = link[1];
    window.history.pushState(null, null, lang+'/'+'admin/'+link[1]);
	$('#admin-content').fadeOut(fade_duration, function(){
		$('#admin-content').load(page_link+link[1]+'.php',null,function(){
            $('#admin-content').fadeIn(fade_duration);
		});
	});
}

var adminFirstLoad = function(){
    var page_link = 'include/admin/';
    if(sezione2 == ""){
        sezione2 = "welcome";
    }
    $('#admin-content').load(page_link+sezione2+'.php',null,null);
    initMenuLinks();
}

var expandMenuSec = function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    $('.sub-selected-active').removeClass('sub-selected-active');
    $('.big-sec-selected').removeClass('big-sec-selected');
    $el = $(this);
    $sub_menu = $(this).next();
    $el.addClass('big-sec-selected');
    $sub_menu.addClass('sub-selected-active');
}

var initMenuLinks = function(){
    $el = $('a[href="adm-'+sezione2+'"]').parent();
    $el.addClass('small-sec-active')
    $el.parent().addClass('sub-selected-active');
    $el.parent().prev().addClass('big-sec-selected');
}

var checkFormField = function(el){    
    if (el.val().length > 0) {    
        if (!el.val().replace(/\s/g, '').length) {
            $(el).addClass('warning'); 
        }
    }else{                             
        $(el).addClass('warning');                                
    }
}

var checkForm = function(el){
    var form_data = el;
    var errors = 0;
    for (var i in form_data) {                                                                              
        if (form_data[i].length > 0) {    
            if (!form_data[i].replace(/\s/g, '').length) {                    
                $('.load_form[name="'+i+'"]').addClass('warning');                     
                errors++;
            }
        }else{                      
            errors++;   
            if(i==='upload_files') {
                $('.load_form[name="'+'files[]'+'"]').parent().addClass('warning');
                continue;
            };                
            $('.load_form[name="'+i+'"]').addClass('warning');                                
        }
    }            
    if(errors > 0) return false 
    else return true;    
}

var checkFormRequired = function(el){
    var form_data = el;
    var errors = 0;
    for (var i in form_data) {                
        if (form_data[i].length > 0) {                            
            if (!form_data[i].replace(/\s/g, '').length) {                    
                $('.required[name="'+i+'"]').addClass('warning');                     
                errors++;
            }
        }else{   
            console.log(i);                          
            errors++;   
            if(i==='upload_files') {
                $('.required[name="'+'files[]'+'"]').parent().addClass('warning');
                continue;
            };                
            $('.required[name="'+i+'"]').addClass('warning');                                            
        }
    }            
    if(errors > 0) return false 
    else return true;    
}

var init_fileupload = function(){
    $('#fileupload').fileupload({
        url: upload_url,
        dataType: 'json',
        done: function (e, data) {                   
            $(this).parent().removeClass('warning');
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
                upload_files = file.name;                               
            });
            $('input[name="upload_files"]').val(upload_files);            
            $("#fileupload").prop('disabled', true);
            $("#fileupload").parent().addClass('disabled');
            $('#story-cover').append('<div class="img-container editable-img"><div class="img-delete"><i class="fa fa-trash-alt"></i></div><img src="files/file_upload/img/storiescover/'+upload_files+'" /></div>');
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
    }).prop('disabled', !$.support.fileInput)
    .parent().addClass($.support.fileInput ? undefined : 'disabled');
}

var initNewService = function(service){

    $('#overview-load_form .required').focusin(function(){
        $(this).removeClass('warning');
    })

    $('#overview-load_form .required').focusout(function(){
        checkFormField($(this));
    })

    $('#overview-load_form .adm-btn_load').click(function(e){
        e.preventDefault();
        var form_data = objectifyForm($("#overview-load_form").serializeArray());
        var send_data = { action: service, data: form_data };                                                              
        
        var check_data = jQuery.extend(true, {}, form_data);    
        check_data['title'] = 'NULL';
        check_data['subtitle'] = 'NULL';
        
        if(checkFormRequired(check_data)){
            $('.load-status').html("");                         
        }else{
            $('.load-status').html("Red fields are mandatory");                                    
            return false;
        }    

        $.ajax({
            type: "POST",
            url: "libs/call_func.php",
            data: JSON.stringify(send_data),
            contentType: "application/json",
            async: true,
            success : function(data)
            {
                if(data == "1"){
                    $('.adm-panel:eq(0)').html("DONE!")
                }else{
                    $('.load-status').html("there was an error :(");
                }
            }
        });
        return false;
    });
}

var overviewDeleteElement = function(e){
    var $el = $(this);
    var el_id = $el.parent().parent().find('.table-id').attr('val');

    var send_data = { 
        action: 'overviewDeleteElement', 
        data: { 
            id: el_id            
        } 
    };  

    $( "#modal" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
          "Delete": function() {

            $( this ).dialog( "close" );                       

            $.ajax({
                type: "POST",
                url: "libs/call_func.php",
                data: JSON.stringify(send_data),
                contentType: "application/json",
                async: true,
                success : function(data)
                {
                    $el.parent().parent().remove();            
                }
            });

          },
          Cancel: function() {
            $( this ).dialog( "close" );
          }
        }
    });       
}

var overviewChangeElementStatus = function(e){
    var $el = $(this);
    var new_status = $el.parent().attr('val');    
    var el_id = $el.parent().parent().find('.table-id').attr('val');
            
    var send_data = { 
        action: 'overviewChangeElementStatus', 
        data: { 
            id: el_id,
            status: new_status
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
            data = JSON.parse(data);                            
            $el.removeClass('btn-secondary');
            $el.removeClass('btn-success');
            $el.addClass('btn-'+data.class1);
            $el.html(data.text1);           
            $el.parent().parent().find('.table-status').removeClass('text-success');
            $el.parent().parent().find('.table-status').removeClass('text-danger');
            $el.parent().parent().find('.table-status').addClass('text-'+data.class2);
            $el.parent().parent().find('.table-status').html(data.text2);
            $el.parent().attr('val', data.status);

            if(data.success == "1"){
                console.log("ok!");
            }else{
                console.log("error");
            }
        }
    });
}

var overviewEditElement = function(e){
    $('.row-edit').remove();
    $('.btn-edit').prop('disabled', false);    

    var $el = $(this); 
    var el_id = $el.parent().parent().find('.table-id').attr('val');    
    var $row = $el.parent().parent();
    var $edit = $('<tr id="row-'+el_id+'" class="row-edit"></tr>').html('<td style="" colspan="9"><div></div></td>');

    $row.after($edit);
    $el.prop('disabled', true);    
    $('#row-'+el_id+' td div').load("include/admin/overview_edit_element.php", null,function(){
        $('#row-'+el_id).show('slow');

        $('#title', '#row-'+el_id).val( $(':nth-child(3)', $row).html() );
        $('#subtitle', '#row-'+el_id).val( $(':nth-child(4)', $row).html() );

        $('.required', '#row-'+el_id).focusin(function(){
            $(this).removeClass('warning');
        })
        $('.required', '#row-'+el_id).focusout(function(){
            checkFormField($(this));
        })

        $('.btn-cancel', '#row-'+el_id).click(function(){            
            $('#row-'+el_id).remove();
            $el.prop('disabled', false);
        });

        $('.btn-save', '#row-'+el_id).click(function(e){
            e.preventDefault();

            var form_data = objectifyForm($('form', '#row-'+el_id).serializeArray());
            form_data['id'] = el_id;
            var send_data = { action: "overviewEditElement", data: form_data };                                                                                                  

            var check_data = jQuery.extend(true, {}, form_data);    
            check_data['title'] = 'NULL';
            check_data['subtitle'] = 'NULL';
            
            if(checkFormRequired(check_data)){
                $('.load-status').html("");                         
            }else{
                $('.load-status').html("Red fields are mandatory");                                    
                return false;
            }    

            $.ajax({
                type: "POST",
                url: "libs/call_func.php",
                data: JSON.stringify(send_data),
                contentType: "application/json",
                async: true,
                success : function(data)
                {
                    data = JSON.parse(data);   

                    if(data.success == "1"){                                            

                        $(':nth-child(3)', $row).html( $('#title', '#row-'+el_id).val() );
                        $(':nth-child(4)', $row).html( $('#subtitle', '#row-'+el_id).val() );            

                        $('#row-'+el_id+' td div').addClass("text-success align-middle");
                        $('#row-'+el_id+' td div').html("ok!");
                        
                        setTimeout(function(){
                            $('#row-'+el_id).remove();    
                            $el.prop('disabled', false);                          
                        }, 1000);                        
                    }else{
                        $('.load-status').html("there was an error :(");
                    }
                }
            });

            return false;                      
        });
    });  
}

var addNewStory = function(service, content_code){      
    var deferred = $.Deferred();            
    //data to send
    var form_data = objectifyForm($("#stories-load_form").serializeArray());
    form_data['content_code'] = content_code;
    var send_data = { action: service, data: form_data };           

    // var check_data = jQuery.extend(true, {}, form_data);    
    var check_data = objectifyForm($("#stories-load_form .required").serializeArray());                                                  
    check_data['tags'] = 'NULL';
    check_data['content_code'] = 'NULL';
    check_data['masonry_gallery'] = 'NULL';
    
    if(checkFormRequired(check_data)){
        $('.load-status').html("");                         
    }else{
        $('.load-status').html("Red fields are mandatory");  
        deferred.resolve();                                   
        return deferred.promise();
    }    

    console.log(send_data);

    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {
            if(data == "1"){
                $('.adm-panel:eq(0)').html("DONE!")
            }else{
                $('.load-status').html("there was an error :(");
            }
            deferred.resolve(data); 
        }
    });      
    
    return deferred.promise();
}

var sendFile = function(file) {    
    var deferred = $.Deferred();  
    data = new FormData();
    // data.append("file", file);
    data.append("files", file);
    $.ajax({
        data: data,
        type: "POST",
        // url: 'files/file_upload/SummerUpload.php',
        url: 'files/file_upload/UploadHandler.php',
        cache: false,
        // async: true,
        // contentType: "application/json",
        contentType: false,
        processData: false,
        success: function(data) {                
            deferred.resolve(data); 
        }
    });
    return deferred.promise();
}

var storiesChangeElementStatus = function(e){
    var $el = $(this);
    var new_status = $el.parent().attr('val');
    var el_id = $el.parent().parent().find('.table-id').attr('val');
            
    var send_data = { 
        action: 'storiesChangeElementStatus', 
        data: { 
            id: el_id,
            status: new_status
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
            data = JSON.parse(data);                
            
            $el.removeClass('btn-secondary');
            $el.removeClass('btn-success');
            $el.addClass('btn-'+data.class1);
            $el.html(data.text1);           
            $el.parent().parent().find('.table-status').removeClass('text-success');
            $el.parent().parent().find('.table-status').removeClass('text-danger');
            $el.parent().parent().find('.table-status').addClass('text-'+data.class2);
            $el.parent().parent().find('.table-status').html(data.text2);
            $el.parent().attr('val', data.status);

            if(data.success == "1"){
                console.log("ok!");
            }else{
                console.log("error");
            }
        }
    });
}

var storiesEditElement = function(e){
    $('.row-edit').remove();
    $('.btn-edit').prop('disabled', false);    

    var $el = $(this); 
    var el_id = $el.parent().parent().find('.table-id').attr('val');    
    var $row = $el.parent().parent();
    
    //creazione della riga edit
    var $edit = $('<tr id="row-'+el_id+'" class="row-edit"></tr>').html('<td style="" colspan="9"><div></div></td>');
    //aggiunta della riga/sezione edit dopo la riga attuale
    $row.after($edit);
    $el.prop('disabled', true);    
    $('#row-'+el_id+' td div').load("include/admin/stories_edit_element.php", null,function(){             

        //show the edit section
        $('#row-'+el_id).show('slow');

        //setting previous values in variables
        upload_files_masonry = $row.attr('gallery');
        currentRow = '#row-'+el_id;        
    
        //setting previous values in fields        
        $('#story-cover', '#row-'+el_id).append('<div class="img-container editable-img"><div class="img-delete"><i class="fa fa-trash-alt"></i></div><img src="'+$row.attr('cover')+'" /></div>');
        $('#title', '#row-'+el_id).val( $('.row-story-title', $row).text() );
        $('#tags', '#row-'+el_id).val( $(':nth-child(4)', $row).html() );  
        $('#cat', '#row-'+el_id).val( $($row).attr('cat') );        
        $("#summernote").summernote("code", $(':nth-child(5)', $row).html());        
        if(upload_files_masonry){            
            var upload_files_masonry_strArr = upload_files_masonry.split(',');
            $('#files_masonry', '#row-'+el_id).append('<br>');
            upload_files_masonry_strArr.forEach( function (item)
            {                                                                                 
                // if(item) $('<img />').attr('val',item)
                // .attr('src','files/file_upload/img/overview/'+item).appendTo($('#files_masonry', '#row-'+el_id));
                                
                if(item) $('<div class="img-container-gallery editable-img" />')
                    .append('<div class="img-delete-gallery"><i class="fa fa-trash-alt"></i></div><img src="files/file_upload/img/overview/'+item+'" val="'+item+'" />')
                    .appendTo($('#files_masonry', '#row-'+el_id));
                    
            });  
            $('input[name="masonry_gallery"]', '#row-'+el_id).val(upload_files_masonry);     
            $('.file_upload', '#row-'+el_id).show();
            $('#files_masonry', '#row-'+el_id).show();
        }        

        //check del content
        $('.required', '#row-'+el_id).focusin(function(){
            $(this).removeClass('warning');
        })
        $('.required', '#row-'+el_id).focusout(function(){
            checkFormField($(this));
        })

        //cancel button callback
        $('.btn-cancel', '#row-'+el_id).click(function(){            
            $('#row-'+el_id).remove();
            $el.prop('disabled', false);
        });

        //send data callback
        $('.btn-save', '#row-'+el_id).click(function(e){
            e.preventDefault();

            //edit map save
            editMapSave();            

            //text loading
            $('.loading-text').show();
            $(this).prop('disabled', true).addClass('adm-btn_disabled');

            //taking data
            var form_data = objectifyForm($('form', '#row-'+el_id).serializeArray());
            form_data['id'] = el_id;
            form_data['content_code'] = $('#summernote').summernote('code');                    

            //checking data
            // var check_data = jQuery.extend(true, {}, form_data);              
            var check_data = objectifyForm($('form .required', '#row-'+el_id).serializeArray());                                                  
            check_data['tags'] = 'NULL';
            check_data['content_code'] = 'NULL';
            check_data['masonry_gallery'] = 'NULL';
            if(coverPic == '') check_data['upload_files'] = 'NULL';            
            if(checkFormRequired(check_data)){
                $('.load-status').html("");                         
            }else{
                $('.load-status').html("all fields are mandatory");   
                $('.loading-text').hide();
                $('.btn-save').prop('disabled', false).removeClass('adm-btn_disabled');                                 
                return false;
            }

            //create data to send
            form_data['upload_files'] = 'files/file_upload/img/storiescover/'+ form_data['upload_files'];
            var send_data = { action: "storiesEditElement", data: form_data }; 
            console.log(send_data);

            //sending to server
            $.ajax({
                type: "POST",
                url: "libs/call_func.php",
                data: JSON.stringify(send_data),
                contentType: "application/json",
                async: true,
                success : function(data)
                {
                    data = JSON.parse(data);   

                    if(data.success == "1"){       
                                            
                        //delete old coverPIC
                        if(coverPic != ''){
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
                                        // el.remove();
                                        // $('.file_upload_cover').show();
                                    }
                                }
                            });
                        }
                        
                        //update current row
                        if(coverPic != ''){
                            $('.stories-cover', $row).attr('src', form_data['upload_files']); //cover foto cambia se è veramente cambiata
                            $row.attr('cover', form_data['upload_files']);
                        }                                                 
                        $(':nth-child(3)', $row).html( $('#title', '#row-'+el_id).val() );
                        $(':nth-child(4)', $row).html( $('#tags', '#row-'+el_id).val() );
                        $($row).attr('cat', $('#cat', '#row-'+el_id).val() );
                        $(':nth-child(5)', $row).html( $('#summernote').summernote('code') );                          
                        $row.attr('gallery', send_data['data']['masonry_gallery']);          

                        $('#row-'+el_id+' td div').addClass("text-success align-middle");
                        $('#row-'+el_id+' td div').html("ok!");
                        
                        setTimeout(function(){
                            $('#row-'+el_id).remove();    
                            $el.prop('disabled', false);                          
                        }, 1000);                        
                    }else{
                        $('.load-status').html("there was an error :(");
                    }

                    $('.loading-text').hide();
                    $('.btn-save').prop('disabled', false).removeClass('adm-btn_disabled');      
                }
            });

            return false;                      
        });
    });  
}

var storiesDeleteElement = function(e){
    var $el = $(this); 
    var el_id = $el.parent().parent().find('.table-id').attr('val');    
    var $row = $el.parent().parent();

    var send_data = { 
        action: 'storiesDeleteElement', 
        data: { 
            id: el_id            
        } 
    };  

    $( "#modal" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
          "Delete": function() {

            $( this ).dialog( "close" );
           
            console.log(send_data);

            $.ajax({
                type: "POST",
                url: "libs/call_func.php",
                data: JSON.stringify(send_data),
                contentType: "application/json",
                async: true,
                success : function(data)
                {
                    $el.parent().parent().remove();            
                }
            });

          },
          Cancel: function() {
            $( this ).dialog( "close" );
          }
        }
    });
       
}


// presets

var addNewPreset = function(service){                

    var form_data = objectifyForm($("#presets-load_form").serializeArray());    
    var send_data = { action: service, data: form_data };           

    var check_data = jQuery.extend(true, {}, form_data);     
    
    if(checkFormRequired(check_data)){
        $('.load-status').html("");                         
    }else{
        $('.load-status').html("Red fields are mandatory");                                    
        return false;
    }    

    console.log(send_data);

    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {
            if(data == "1"){
                $('.adm-panel:eq(0)').html("DONE!")
            }else{
                $('.load-status').html("there was an error :(");
            }
        }
    });            
}

var presetsDeleteElement = function(e){
    var $el = $(this);
    var el_id = $el.parent().parent().find('.table-id').attr('val');

    var send_data = { 
        action: 'presetsDeleteElement', 
        data: { 
            id: el_id            
        } 
    };  

    $( "#modal" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
          "Delete": function() {

            $( this ).dialog( "close" );                       
            
            $.ajax({
                type: "POST",
                url: "libs/call_func.php",
                data: JSON.stringify(send_data),
                contentType: "application/json",
                async: true,
                success : function(data)
                {
                    $el.parent().parent().remove();            
                }
            });

          },
          Cancel: function() {
            $( this ).dialog( "close" );
          }
        }
    });       
}



// # SUMMERNOTE CUSTOM #

//custom summernote button for masonry gallery
var SummernoteMasonryButton = function (context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
    contents: '<i class="fa fa-bars"/>',
    tooltip: 'Masonry Gallery',
    click: function () {     
        //apertura del modal 
        $('#modal-admin').modal('toggle');        
    }
    });
    return button.render(); 
}

//custom summernote button for google maps
var SummernoteMapButton = function (context) {
  var ui = $.summernote.ui;
  // create button
  var button = ui.button({
    contents: '<i class="fa fa-map"/>',
    tooltip: 'Map',
    click: function () {
        $('#summernote').summernote('saveRange');
        //modal opening to choose options
        $('#modal-admin-summer-map').modal('toggle');
    }
  });
  return button.render(); // return button as jquery object
}

//custom summernote button for resizing image with margin
var SummernoteImgHalfLeft = function (context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
      contents: '<span class="note-fontsize-10">half page white border</span>',
      tooltip: 'Resize image half of page with white border',
      click: function (e) {                                
            var layoutInfo = context.layoutInfo;
            var $editor = layoutInfo.editor;
            var $editable = layoutInfo.editable;
            var $toolbar = layoutInfo.toolbar;
            var $img = $($editable.data('target'));
            $img.css({
                width: 'calc(50% - 20px)',
                margin: '0 10px'
            });
      }
    });
    return button.render(); // return button as jquery object
  }

//custom summernote button for adding native video
var SummernoteNativeVideo = function (context) {
    var ui = $.summernote.ui;
    // create button
    var button = ui.button({
    contents: '<i class="far fa-file-video"/>',
    tooltip: 'Add video directly to server',
    click: function (e) {                 
        
        $('#summernote').summernote('saveRange'); //save range of before

        var layoutInfo = context.layoutInfo;
        var $editor = layoutInfo.editor;
        var $editable = layoutInfo.editable;
        var $toolbar = layoutInfo.toolbar;

        var el = $('<input id="nativevideo" class="" type="file" name="files[]" >'); // add "multiple" at the end of input tag
        
        //creating video
        el.fileupload({
            url: upload_url,
            dataType: 'json',   
            add: function (e, data) {                                    
                var goUpload = true;
                var uploadFile = data.files[0];                    
                if (!(/\.(mp4)$/i).test(uploadFile.name)) {
                    alert('You must select a .mp4 file only');
                    goUpload = false;
                }
                if (uploadFile.size > 200000000) { // 200mb
                    alert('Please upload a smaller image, max size is 200 MB');
                    goUpload = false;
                }
                if (goUpload == true) {
                    data.submit();
                    tempEl = $('<div class="loader" style="position:fixed; top:40px; right:40px;"></div>');
                    $('#main_page').append(tempEl);
                }
            },
            done: function (e, data) {                                                  
                $.each(data.result.files, function (index, file) {
                    // add video to summernote edit - '<div class="video-container">'+
                    $('#summernote').summernote('restoreRange');
                    var node = $('<div class="video-container"><video controlslist="nodownload" loop="1" preload="auto" style="width: 100%; height: 100%; position:absolute;" src="files/file_upload/img/'+file.name+'" controls=""><source type="video/mp4" src="files/file_upload/img/'+file.name+'"><a href="">Click to see the video.</a></video></div>');                                
                    $('#summernote').summernote('insertNode', node[0]);
                });                
                tempEl.remove(); //remove the spinner
            },
            progressall: function (e, data) {
                // progress
                // console.log(data);                                  
            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

        el.click();            
    }
    });
    return button.render(); // return button as jquery object
}

//summernote options after buttons creation
var summerStoryOptions = {
    placeholder: 'Write here...',
    tabsize: 2,
    height: 300,
    callbacks: {
        onImageUpload: function(files) {
            sendFile(files[0]).then(function(data){
                data = JSON.parse(data);                          
                var url = data.files[0].storiesUrl;
                var image = $('<img class="summer-img">').attr('src', url);
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
        ['insert', ['link', 'picture', 'video', 'nativevideo', 'masonry', 'map']],
        ['other', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
    ],
    popover: {
        image: [
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25', 'imgHalfLeft']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']]
        ]
    },
    buttons: {
        masonry: SummernoteMasonryButton,
        map: SummernoteMapButton,
        imgHalfLeft: SummernoteImgHalfLeft,
        nativevideo: SummernoteNativeVideo
    }
};




// # EDIT HTML PAGES #


var editPage = function(service, page, contentCode){      
    var deferred = $.Deferred();            
    var form_data = { page: page, contentCode: contentCode }
    var send_data = { action: service, data: form_data };               

    $.ajax({
        type: "POST",
        url: "libs/call_func.php",
        data: JSON.stringify(send_data),
        contentType: "application/json",
        async: true,
        success : function(data)
        {
            if(data == "1"){
                $('.adm-panel:eq(0)').html("DONE!")
            }else{
                $('.load-status').html("there was an error :(");
            }
            deferred.resolve(data); 
        }
    });      
    
    return deferred.promise();
}


//start map edit on summernote
var editMapInit = function(){
    $('.map-edit').show();    
    if($('#summernote').summernote('code').indexOf('class="summernote-map"') > 0){   
        var data = $('#summernote').summernote('code');
        var dataArr = data.split('class="summernote-map-content" message="');
        markerMessage = dataArr[1].split('"')[0];
        markerAddress = dataArr[1].split('address="')[1];
        markerAddress = markerAddress.split('"')[0];
        $('input[name=mapAddress]').val(markerAddress);
        $('input[name=mapText]').val(markerMessage);           
    }    
}


//save edits to map on summernote
var editMapSave = function(){
    if($('#summernote').summernote('code').indexOf('class="summernote-map"') > 0){   
        var data = $('#summernote').summernote('code');        
        var node = data.split('<div class="summernote-map-content"')[1];
        node = '<div class="summernote-map-content"' + node.split('</div')[0] + '</div>';
        markerAddress = $('input[name=mapAddress]').val();
        markerMessage = $('input[name=mapText]').val();
        var newNode = '<div class="summernote-map-content" message="'+markerMessage+'" address="'+markerAddress+'" style="display:none;"></div>';        
        data = data.replace(node, newNode);      
        $('#summernote').summernote('reset');                  
        $('#summernote').summernote('code', data);            
    }  
}