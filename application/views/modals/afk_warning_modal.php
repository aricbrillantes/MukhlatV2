<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- AFK Warning Modal -->
<head>

<style>

</style>

</head>

<div id="afkpopup" class="modal fade" role="dialog">
    <canvas style="position:fixed;" id="canvas5"></canvas>
    <div class="modal-dialog">
        <!-- AFK Warning Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Hey!</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row"><center>
                    <span style="font-size: 32px">Are you still there, <?php echo $logged_user->first_name; ?>?</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
