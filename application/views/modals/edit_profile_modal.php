<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Edit Profile Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "reply-user" class="modal-title"><strong>Edit Profile</strong></h4>
            </div>
            <?php echo form_open_multipart('user/update/', array('id' => 'edit-profile-form')); ?>
            <div class="modal-body">
                    <!-- profile picture -->
                    <div class = "col-sm-3 form-group no-padding text-center">
                        <img id = "user-pic-display" class = "img-circle" width = "120px" height = "120px" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>" style = "margin-bottom: 5px;">
                        <label class="btn btn-primary btn-sm">
                            <input id = "user-pic-input" accept = "image/*" type="file" name = "profile_picture" style = "display: none;">
                            Change Picture
                        </label>
                    </div>
                    <div class="col-sm-9 no-padding">
                        <div class = "col-xs-12 no-padding">
                            <span class = "text-muted"><strong>Name: </strong></span>
                        </div>
                        <div class = "col-sm-12 no-padding" style = "margin-bottom: 10px;">
                            <div class = "col-xs-6 no-padding">
                                <div class = "col-xs-12" style = "padding: 2px;">
                                    <input required type = "text" class = "form-control" maxlength = "25" name = "edit_first" placeholder = "First Name" value = "<?php echo $logged_user->first_name; ?>">
                                </div>
                            </div>
                            <div class = "col-xs-6 no-padding">
                                <div class = "col-xs-12" style = "padding: 2px;">
                                    <input required type = "text" class = "form-control" maxlength = "25" name = "edit_last" placeholder = "Last Name" value = "<?php echo $logged_user->last_name; ?>">
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-12 no-padding">
                            <span class = "text-muted"><strong>Password: </strong></span>
                        </div>
                        <div class = "col-sm-12 no-padding" style = "margin-bottom: 10px;">
                            <div class = "col-xs-6 no-padding">
                                <div class = "col-xs-12" style = "padding: 2px;">
                                    <input type = "password" name = "edit_pass" class = "form-control" placeholder = "Password">
                                </div>
                            </div>
                            <div class = "col-xs-6 no-padding">
                                <div class = "col-xs-12" style = "padding: 2px;">
                                    <input type = "Password" class = "form-control" placeholder = "Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class = "col-sm-12 no-padding" style = "margin-bottom: 10px;">
                            <div class = "col-xs-2 no-padding" style = "padding-top: 5px;">
                                <span class = "text-muted"><strong>Email: </strong></span>
                            </div>
                            <div class = "col-xs-10 no-padding">    
                                <input required type = "email" name = "edit_email" maxlength = "45" class = "form-control" placeholder = "Email Address" value = "<?php echo $logged_user->email; ?>">
                            </div>
                        </div>
                        <div class = "col-sm-12 no-padding" style = "margin-bottom: 10px;">
                            <div class = "col-xs-12 no-padding" style = "padding-top: 5px;">
                                <span class = "text-muted"><strong>Description: </strong></span>
                            </div>
                            <div class = "col-xs-12 no-padding" style = "padding-top: 5px;">
                                <textarea class = "text-muted form-control" name = "edit_description" maxlength = "75" placeholder = "Tell something about yourself"><?php echo $logged_user->description ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer" style = "padding: 5px; border-top: none; padding-bottom: 10px; padding-right: 10px;">
                    <button id = "save-profile-edit" class ="btn btn-primary" data-toggle = "modal">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="reply-confirmation-modal" tabindex="-1" class="modal fade" role="dialog" style = "margin-top: 50px; margin-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header modal-heading">
                <button type="button" class="close" style = "padding: 5px;" data-dismiss="modal">&times;</button>
                <h4 id = "send-reply-user" class="modal-title"><strong>Send reply to <?php echo $post->user->first_name; ?></strong></h4>
            </div>
            <div class="modal-body">
                <button id = "create-reply-proceed" type = "submit" class = "btn btn-success">Proceed</button>
                <button class = "btn btn-Danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo base_url("/js/topic.js"); ?>"></script>
<!-- END SCRIPTS -->