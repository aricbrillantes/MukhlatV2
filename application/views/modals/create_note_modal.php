<?php

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> -->


<!-- Create Note Modal -->
<div id="create-note-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Note</strong></h4>
            </div>
            <form enctype = "multipart/form-data" action = "<?php echo base_url('parents/note/').$id; ?>" id = "create-note-form" method = "POST">
                <div class="modal-body">

                    <div class="form-group" ><!-- check if description exceeds n words-->
                        <!--<label for = "content">Make the content of your post:</label>-->
                        <!--<p class="lead emoji-picker-container">-->
                        <textarea class = "form-control" style="height: 100px;" maxlength = "200" required name = "note_content" id = "note-content" placeholder = "Write your note here:" ></textarea>
                        <!-- <p id="charsRemaining4">Characters Left: 16000</p> -->
              
                    </div>
                  <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <button id = "create-note-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" >Share</button>
                  </div>
                </div>
            </form> 
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
