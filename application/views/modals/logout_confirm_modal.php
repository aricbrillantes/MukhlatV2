<div id="logout-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "" class="modal-title"><strong>Log Out</strong></h4>
            </div>
            <div class="modal-body">
                <span class = "text-warning"><i class = "fa fa-warning"></i> <strong style="font-size: 24px;">Are you sure you want to log out?</strong></span>
                
                <br><br>
                <button class="btn" style="background-color: red; color: white; font-size: 24px; margin-bottom: 10px" onclick="location.href='<?php echo base_url('signin/logout');?>'">Yes, I'm sure!</button>
                
                <br><br><button class = "btn" data-dismiss="modal" style="background-color: orange; color: black; font-size: 24px">No, take me back!</button>
            </div>
        </div>
    </div>
</div>