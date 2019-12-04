<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- schedule warning -->
<head>

</head>

<div id="schedule-warning-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- schedule warning Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center textoutliner"><strong><i class="glyphicon glyphicon-hourglass"></i>It's almost time!</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row"><center>
                    <span style="font-size: 32px">Mukhlat will be closing up soon.<br></span>
                    <br>
                    <button type="button" class="btn btn-primary buttonsbgcolor" data-dismiss="modal">Okay!</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>