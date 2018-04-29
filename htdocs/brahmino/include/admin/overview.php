<?php
$connection = "../../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

if(intval($result['potere']) < 0) return;
?>

<div class="adm-panel">
    <div class="adm-title">All Elements</div>
    <br>

    <div class="table-container table-responsive-sm">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>                    
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="sortable">
                <?php
                $acc->overviewGetAllElements();
                ?>
            </tbody>
        </table>    
    </div>

</div>

<script>
$('.adm-panel').on('click', '.table-activate .btn', overviewChangeElementStatus);
$('.adm-panel').on('click', '.btn-edit', overviewEditElement);
$('.adm-panel').on('click', '.btn-delete', overviewDeleteElement);

$(function(){

    //sort elements in db

    $( ".sortable" ).sortable({
        cursor: "auto",
        update: function( event, ui ) {
            $('.sortable').sortable('disable'); 
            $item = ui.item;
            $prev = $item.prev();           
            $next = $item.next();   
            var ord = 0;         
            var id = $item.attr('val');
            
            // if($prev.attr('val') === undefined){                                
            //     ord = $next.attr('ord');
            // }else{                
            //     ord = $prev.attr('ord');
            // }       

            ord = $next.attr('ord');            

            var send_data = { 
                action: 'overviewEditOrder', 
                data: { 
                    id: id,
                    ord: parseInt(ord)
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

                    console.log(data);
                    $('.sortable').sortable('enable'); 

                    var new_ord = parseInt(data);

                    $item.attr('ord', new_ord+1);

                    $('.sortable tr').each(function(){

                        var old_ord = parseInt($(this).attr('ord'));
                        
                        if($(this).attr('val') != id){

                            if(old_ord <= new_ord){
                                $(this).attr('ord', old_ord-1);
                            }else if(old_ord > new_ord){
                                $(this).attr('ord', old_ord+1);
                            }
                        }
                    });
                }
            });
        }
    });
    
    $( ".sortable" ).disableSelection();

});
</script>