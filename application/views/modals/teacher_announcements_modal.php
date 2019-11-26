<?php
// $topic = $_SESSION['current_topic'];
?>
<!--<script src="/intl/en/chrome/assets/common/js/chrome.min.js"></script>-->     
    <!--Voice Search Script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Create Post Modal -->
<div id="view-announcements-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Create Topic Modal Content-->
        <div class="modal-content" id="text">
            <div class="modal-header modal-heading modalbg notetextfix" id="margin">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title textoutliner"><strong id="modaltitle">Teacher's announcements </strong></h4>
            </div>
            
            <div class=" col-md-12 col-sm-12 col-xs-12">
                <br>
 
                <?php 
                    //load models
                    $CI =&get_instance();
                    $CI->load->model('topic_model');
                    $CI->load->model('user_model');

                    //get announcements
                    $announcements = $CI->topic_model->get_announcements();

                    //get teacher's details for each announcement
                    foreach ($announcements as $announcement):

                        $details = $CI->user_model->view_adult($announcement->user_id);

                        foreach ($details->result() as $teacher): //store teacher's details in array
                            $data['user'] = $CI->user_model->get_details(true, true, array('user_id' => $announcement->user_id));
                        
                ?>

                    <li class = "">
                        <h4 class = "no-padding admin-list-name">Teacher <?php echo $teacher->first_name?> says: </h4> 
                        <h3 class = "no-padding admin-list-name">"<?php echo $announcement->announcement ?>"</h3>
                    </li>
                    <br>                                    
               
                        <?php  endforeach; endforeach; ?>
            </div>

        </div>
    </div>
</div>

    
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
