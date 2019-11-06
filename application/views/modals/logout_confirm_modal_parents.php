<div id="logout-modal-parents" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h3 id = "" class="modal-title"><strong>Are you sure you want to log out?</strong></h3>
            </div>
            <div class="modal-body">
                <!-- <span class = "text-warning"><i class = "fa fa-warning"></i> <strong style="font-size: 24px;">Log out?</strong></span> -->

                <button class = "btn container col-xs-5 " data-dismiss="modal" style="background-color: grey; color: #fff; font-size: 24px">Cancel</button>

                <button class="btn container col-xs-5 col-xs-offset-2" style="background-color: #c73838; color: white; font-size: 24px; " onclick="location.href='<?php echo base_url('signin/logout');?>'">Log Out</button>
                <br><br><br><br>
            </div>
        </div>
    </div>
</div>