<?php

?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> -->


<!-- Create Note Modal -->
<div id="create-note-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Say something to <?php echo $child->first_name; ?></strong></h4>
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
                        <button id = "create-note-btn" class ="btn btn-primary buttonsbgcolor" data-toggle = "modal" >Send</button>
                    </div>

                    <strong class = "" style = "display: inline-block; margin-right: 20px"><h4>Notes to <?php echo $child->first_name;?>: </h4></strong> <h2 class = "" style = "display: inline-block;"></h2>
                        <?php 
                            
                            $CI->load->model('user_model'); //load models       
                            $notes = $CI->user_model->get_notes($id); //get notes

                            foreach ($notes as $note): ?>

                            <li class = "list-group-item admin-list-item">
                                <h3 class = "no-padding admin-list-name">"<?php echo $note->note ?>"</h3>
                            </li>
                                                               
                        <?php endforeach; ?>
                    
                </div>
            </form> 
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
