<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Notification Modal -->
<div id="notif-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Notification Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Save Changes?</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row">
                    <div class = "col-md-12">
                        <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
                            <li class = "active text-center"><button onclick="getTimeCells('time-table', 'td', 'cell');" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Yes</button></li>
                            
                            <li class = "active text-center"><button data-dismiss="modal" class = "" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Cancel</button></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>