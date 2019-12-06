<?php
// $topic = $_SESSION['current_topic'];
?>
<!--<script src="/intl/en/chrome/assets/common/js/chrome.min.js"></script>-->     
    <!--Voice Search Script-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Create Post Modal -->
<div id="view-notes-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Your guardian angel says: </strong></h4>
            </div>
            
            <div class=" col-md-12 col-sm-12 col-xs-12">
                <br> 

                <?php 
                    $CI =&get_instance();
                    $CI->load->model('user_model'); //load models
                    $notes = $CI->user_model->get_notes($logged_user->user_id); //get notes

                    foreach (array_reverse($notes) as $note): ?>

                    <li class = "list-item ">
                        <h3 class = "no-padding admin-list-name">"<?php echo utf8_decode($note->note) ?>"</h3>
                    </li>
                                                       
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<!-- END SCRIPTS -->