//admin.js
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

    $('#overview-load_form .load_form').focusin(function(){
        $(this).removeClass('warning');
    })

    $('#overview-load_form .load_form').focusout(function(){
        checkFormField($(this));
    })

    $('#overview-load_form .adm-btn_load').click(function(e){
        e.preventDefault();
        var form_data = objectifyForm($("#overview-load_form").serializeArray());
        var send_data = { action: service, data: form_data };                                                              
        
        if(checkForm(form_data)){
            $('.load-status').html("");                         
        }else{
            $('.load-status').html("All fields are mandatory");                                    
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
    var $edit = $('<tr id="row-'+el_id+'" class="row-edit"></tr>').html('<td style="" colspan="7"><div></div></td>');

    $row.after($edit);
    $el.prop('disabled', true);    
    $('#row-'+el_id+' td div').load("include/admin/overview_edit_element.php", null,function(){
        $('#row-'+el_id).show('slow');

        $('#title', '#row-'+el_id).val( $(':nth-child(3)', $row).html() );
        $('#subtitle', '#row-'+el_id).val( $(':nth-child(4)', $row).html() );

        $('.load_form', '#row-'+el_id).focusin(function(){
            $(this).removeClass('warning');
        })
        $('.load_form', '#row-'+el_id).focusout(function(){
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

            if(checkForm(form_data)){
                $('.load-status').html("");                         
            }else{
                $('.load-status').html("all fields are mandatory");                                    
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

    var form_data = objectifyForm($("#stories-load_form").serializeArray());
    form_data['content_code'] = content_code;
    var send_data = { action: service, data: form_data };           

    var check_data = jQuery.extend(true, {}, form_data);    
    check_data['tags'] = 'NULL';
    check_data['content_code'] = 'NULL';
    check_data['masonry_gallery'] = 'NULL';
    
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

var sendFile = function(file) {
    var deferred = $.Deferred();  
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: 'files/file_upload/SummerUpload.php',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {            
            deferred.resolve(url); 
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
    var $edit = $('<tr id="row-'+el_id+'" class="row-edit"></tr>').html('<td style="" colspan="7"><div></div></td>');

    $row.after($edit);
    $el.prop('disabled', true);    
    $('#row-'+el_id+' td div').load("include/admin/stories_edit_element.php", null,function(){
        //summernote edit content
        $('#summernote').summernote({
            placeholder: '',
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

        //show the edit section
        $('#row-'+el_id).show('slow');

        //setting previous values in fields
        $('#title', '#row-'+el_id).val( $(':nth-child(3)', $row).html() );
        $('#tags', '#row-'+el_id).val( $(':nth-child(4)', $row).html() );        
        $("#summernote").summernote("code", $(':nth-child(5)', $row).html());

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

            //taking data
            var form_data = objectifyForm($('form', '#row-'+el_id).serializeArray());
            form_data['id'] = el_id;
            form_data['content_code'] = $('#summernote').summernote('code');
            var send_data = { action: "storiesEditElement", data: form_data };                 

            //checking data
            var check_data = jQuery.extend(true, {}, form_data);    
            check_data['tags'] = 'NULL';
            check_data['content_code'] = 'NULL';
            if(checkForm(check_data)){
                $('.load-status').html("");                         
            }else{
                $('.load-status').html("all fields are mandatory");                                    
                return false;
            }

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

                        $(':nth-child(3)', $row).html( $('#title', '#row-'+el_id).val() );
                        $(':nth-child(4)', $row).html( $('#subtitle', '#row-'+el_id).val() );
                        $(':nth-child(5)', $row).html( $('#summernote').summernote('code') );            

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
