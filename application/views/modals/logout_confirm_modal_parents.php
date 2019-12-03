<div id="logout-modal-parents" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h3 id = "" class="modal-title"><strong>Are you sure you want to log out?</strong></h3>
            </div>

            <div class="modal-body  container-fluid row">
                <div class="col-md-10 col-xs-10 col-sm-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
                    <br><br>
                    <button class = "btn container col-xs-4 col-sm-4 col-md-4" data-dismiss="modal" style="background-color: grey; color: #fff; font-size: 22px"><center>Cancel</center></button>

                    <button class="btn container col-xs-7 col-sm-7 col-md-7 col-xs-offset-1 col-sm-offset-1 col-md-offset-1" style="background-color: #c73838; color: white; font-size: 22px; " onclick="location.href='<?php echo base_url('signin/logout');?>'"><center>Yes, log out</center></button>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>