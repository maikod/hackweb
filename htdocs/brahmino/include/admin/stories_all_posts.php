<?php
$connection = "../../libs/ADMIN.php";
require_once($connection);

$acc = new ADMIN;
$result = $acc->checkLogin();

if(intval($result['potere']) < 0) return;
?>

<div class="adm-panel">
    <div class="adm-title">All Stories</div>
    <br>

    <div class="table-container table-responsive-sm">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $acc->storiesGetAllElements();
                ?>
            </tbody>
        </table>    
    </div>

    <div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="modal-admin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gallery Border</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    What kind of border do you want?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-border" val="noborder" data-dismiss="modal">No Border</button>
                    <button type="button" class="btn btn-primary modal-border" val="white" data-dismiss="modal">White</button>
                </div>
            </div>
        </div>
    </div>    

</div>

<script>
$('.adm-panel').on('click', '.table-activate .btn', storiesChangeElementStatus);
$('.adm-panel').on('click', '.btn-edit', storiesEditElement);
$('.adm-panel').on('click', '.btn-delete', storiesDeleteElement);
</script>