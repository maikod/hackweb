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
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Code</th>
                    <th scope="col">Price</th> 
                    <th scope="col">Date</th>                     
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                $acc->presetsGetAllElements();
                ?>
            </tbody>
        </table>    
    </div>

</div>

<script>
$('.adm-panel').on('click', '.btn-delete', presetsDeleteElement);

$(function(){

    

});
</script>