

<!-- Session Warning Modal -->

<div id="session-popup" class="modal fade" role="dialog">
    <canvas style="position:fixed;" id="canvas5"></canvas>
    <div class="modal-dialog">
        <!-- Session Warning Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center textoutliner"><strong>Hey!</strong></h4>
            </div>
            <div class="modal-body">
                <div class = " "><center>
                    <span style="font-size: 32px">
                        Hey there <?php echo $logged_user->first_name;?>, it looks like you've been <br>
                        using Mukhlat for too long now! <br>
                        It might be time to take a break! 😊</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
