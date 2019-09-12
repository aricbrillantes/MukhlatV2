<?php
$topic = $_SESSION['current_topic'];
?>
<!-- Share Modal -->
<div id="share-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Invitation Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Share <?php echo utf8_decode($topic->topic_name); ?> to others!</h4>
            </div>
            <div class="modal-body">
                <h5 class ="text-muted text-right no-margin no-padding" style = "margin-bottom: 10px;">Users selected: 
                    <span id = "user-share-count">0</span>
                </h5>
                <form id = "share-form" action = "<?php echo base_url('invite/share'); ?>" method = "POST" style = "height: 400px; overflow-y: auto">
                    <ul class = "list-group">
                        <?php foreach ($topic->nonfollowers as $nonfollower): ?>
                            <li class = "list-group-item no-padding no-margin" style = "padding-left: 10px; font-size: 12px;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class = "name-share"  name = "share-checkbox[]" value="<?php echo $nonfollower->user_id ?>">
                                        <img src = "<?php echo $nonfollower->profile_url ? base_url($nonfollower->profile_url) : base_url('images/default.jpg') ?>" class = "img-circle" width = "25px"/>
                                        <?php echo $nonfollower->first_name . " " . $nonfollower->last_name ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </form>
                <button id = "share-btn" class = "btn btn-primary" value = "">Share to Users</button>
            </div>
        </div>
    </div>
</div>