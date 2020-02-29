<div id="post-delete-confirm" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "post-confirm-topic" class="modal-title"><strong>Delete post?</strong></h4>
            </div>
            <div class="modal-body">

                <div id="save-settings" class = "col-md-12 col-xs-12 text-center" style="font-size:22px; margin-top: 10px; margin-bottom: 10px;">
                    This action cannot be undone.<br>
                    Are you sure?<br><br>
                </div>

                <form id = "delete-post-form" method = "POST">
                    <button id = "delete-post-proceed" type = "submit" class = "btn btn-danger">Proceed</button>
                    <button class = "btn" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>