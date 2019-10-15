<!-- Modal -->
<div id="late-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Notification Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Warning!</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row">
                    <div class = "col-md-12 col-xs-12 text-center" style="font-size:24px; margin-top: 10px; margin-bottom: 10px">
                        Based on the times you selected, you will be allowing your child to use Mukhlat at a very late time!
                        Are you sure?
                    </div>

                    <div class = "active text-center"><button onclick="changeTimeSettings('time-table', 'td', 'cell');" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Yes, I'm sure!</button></div>

                    <div class = "active text-center"><button data-dismiss="modal" class = "btn" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">No, take me back.</button></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>