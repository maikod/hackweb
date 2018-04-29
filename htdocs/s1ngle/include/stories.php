
<div class="spazio" id="hw-stories" style="">
    <div class="inner stories">

        <div class="stories-list">
            <div id="" class="page-header">			
                <div class="page_title_wrapper">
                    <div class="page_title_inner">
                        <h2>Stories</h2>
                        <div class="page-subtitle">
                            The journal about my photo &amp; video productions.
                            People, places, travels, projects. 		    	
                        </div>
                    </div>
                </div>
            </div>

            <hr class="hr2">

            <!-- sezione stories -->
            <div class="stories-grid" style="display:none;">
                <div class="stories-cell-sizer"></div>  
                <div class="stories-gutter-sizer"></div>    
            </div>

            <div class="grid-loading">
                <!-- <div style="text-align:left; margin: 0 auto; max-width:100px;">Loading
                </div> -->
            </div>
        </div>

        <!-- contenitore della singola storia -->
        <div class="stories-item">

        </div>
    </div>
</div>

<script>
//config setup
origin = 0;
increment = 20;
loading = false;
end = false;
$isot = null;
$stories_gallery = null;

if(sezione2 == ''){
    $('.stories-item').hide();
    loadStories().then(function(data) {
        //
    });           
}else{
    $('.stories-list').hide();
    loadStory(sezione2).then(function(data){
        $('.stories-item').html(data);
        $stories_gallery = $('.stories-gallery-grid').fadeTo(0,0).imagesLoaded(function(){        
            $stories_gallery.masonry({
                itemSelector: '.stories-gallery-cell',
                columnWidth: '.stories-gallery-cell-sizer',
                gutter: '.stories-gallery-gutter-sizer',
                percentPosition: true
            }).fadeTo(400,1);            
        });
    });
}    

// $mason = $('.stories-grid').masonry({
//     itemSelector: '.stories-cell',
//     columnWidth: '.stories-cell-sizer',
//     gutter: '.stories-gutter-sizer',
//     percentPosition: true
// });    
// $mason.masonry('layout');    

$('#hw-stories').on('click', '.stories-cell .stories-cat a', function(e){
    e.preventDefault();
    return false;
});

$('#hw-stories').on('click', '.stories-cell .stories-link', function(e){
    e.preventDefault();
    var $el = $(this);    
    sezione2 = $el.attr('href');  
    section[2] = sezione2;  
    
    $('.stories-list').fadeOut('fast', function(){                
        loadStory(sezione2).then(function(data){
            window.history.pushState(null, null, lang+'/'+sezione+'/'+section[2]);
            $('.stories-item').html(data);
            $('.stories-gallery-grid').fadeTo(0,0);
            $('.stories-item').fadeIn('fast',function(){
                $stories_gallery = $('.stories-gallery-grid').fadeTo(0,0).imagesLoaded(function(){        
                    $stories_gallery.masonry({
                        itemSelector: '.stories-gallery-cell',
                        columnWidth: '.stories-gallery-cell-sizer',
                        gutter: '.stories-gallery-gutter-sizer',
                        percentPosition: true
                    }).fadeTo(400,1);            
                });
            });
        });
    });
    
    return false;
});

</script>