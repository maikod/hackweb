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
                </tr>
            </thead>
            <tbody>
                <?php
                $acc->storiesGetAllElements();
                ?>
            </tbody>
        </table>    
    </div>

</div>

<script>
$('.adm-panel').on('click', '.table-activate .btn', storiesChangeElementStatus);
$('.adm-panel').on('click', '.btn-edit', storiesEditElement);
</script>