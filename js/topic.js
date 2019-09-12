//from stackoverflow
$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});

$(document).ready(function () {
    $("#create-topic-btn").on("click", function () {
        if ($("#topic-title").val() && $("#topic-description").val()) {
            $("#create-confirmation-modal").modal('show');
            $("#topic-title").parent().removeClass("has-error");
            $("#topic-description").parent().removeClass("has-error");
        } else {
            if (!$("#topic-title").val())
                $("#topic-title").parent().addClass("has-error");
            else
                $("#topic-title").parent().removeClass("has-error");

            if (!$("#topic-description").val())
                $("#topic-description").parent().addClass("has-error");
            else
                $("#topic-description").parent().removeClass("has-error");
        }
    });

    $("#create-topic-proceed").on("click", function () {
        $("#create-topic-form").submit();
    });

    $("#create-post-btn").on("click", function () {
        if ($("#post-title").val() && $("#post-content").val()) {
            $("#create-post-form").submit();
            $("#post-title").parent().removeClass("has-error");
            $("#post-content").parent().removeClass("has-error");
        } else {
            if (!$("#post-title").val())
                $("#post-title").parent().addClass("has-error");
            else
                $("#post-title").parent().removeClass("has-error");

            if (!$("#post-content").val())
                $("#post-content").parent().addClass("has-error");
            else
                $("#post-content").parent().removeClass("has-error");
        }
    });

    $("#edit-post-btn").on("click", function () {
        if ($("#post-content").val()) {
            $("#post-edit-confirm").modal('show');
            $("#post-title").parent().removeClass("has-error");
            $("#post-content").parent().removeClass("has-error");
        } else {
            if (!$("#post-content").val())
                $("#post-content").parent().addClass("has-error");
            else
                $("#post-content").parent().removeClass("has-error");
        }
    });

    $("#edit-post-proceed").on("click", function () {
        $("#edit-post-form").submit();
    });


    $(".topic-post-entry").on("click", function () {
        var post_id = $(this).data("value")
        //remove div
        $("#post-preview").remove();

        $("#no-preview").hide('slow', function () {
            $(this).remove();
        });

        //get post preview
        $.post(window.location.origin + "/GetTogetherBeta/topic/preview/" + post_id,
                function (html) {
                    $(html).hide().prependTo("#preview-div").show("slow");
                }
        );

    });

    $("#topic-follow-btn").on("click", function () {
        var follow_btn = $(this);
        var topic_id = follow_btn.val();
        $(".follow-label").remove();
        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/topic/follow/" + topic_id,
            type: "POST",
            success: function () {
                if (follow_btn.hasClass("btn-primary")) {
                    //follow
                    follow_btn.removeClass("btn-primary");
                    follow_btn.addClass("btn-danger");
                    follow_btn.html("<i class = \"fa fa-minus-circle\"></i> Unfollow Topic");
                } else if (follow_btn.hasClass("btn-danger")) {
                    //unfollow
                    follow_btn.addClass("btn-primary");
                    follow_btn.removeClass("btn-danger");
                    follow_btn.html("<i class = \"fa fa-plus-circle\"></i> Follow Topic");
                }
            }
        });
    });


    $(".reply-btn").on("click", function () {
        var post_id = $(this).val();
        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/topic/load_post/reply",
            type: "POST",
            dataType: "json",
            data: {post_id: post_id},
            success: function (data) {
                $("#reply-user").html("<strong>Reply to " + data.first_name + "</strong>");
                $("#send-reply-user").html("<strong>Send reply to " + data.first_name + "</strong>");
                $("#create-reply-form").attr("action", window.location.origin + "/GetTogetherBeta/topic/reply/" + data.post_id);
                $("#create-reply-modal").modal("show");
            }
        });
    });

    $("#create-reply-btn").on("click", function () {
        if ($("#reply-content").val()) {
            $("#create-reply-form").submit();
            $("#reply-content").parent().removeClass("has-error");
        } else {
            if (!$("#reply-content").val())
                $("#reply-content").parent().addClass("has-error");
            else
                $("#reply-content").parent().removeClass("has-error");
        }
    });

    $("#topic-share-btn").on("click", function () {
        $("#share-modal").modal("show");
    });

    $("#topic-invite-btn").on("click", function () {
        $("#invitation-modal").modal("show");
    });

    $('.name-share').on('click', function () {
        $("#user-share-count").html($('.name-share:checked').length);
    });

    $('.name-invite').on('click', function () {
        $("#user-invite-count").html($('.name-invite:checked').length);
    });

    $('#share-btn').on('click', function () {
        $("#share-form").submit();
    });

    $('#invite-btn').on('click', function () {
        $("#invite-form").submit();
    })

    $('#edit-topic-btn').on('click', function () {
        $("#desc-edit").toggleClass("hidden");
        $("#desc-container").toggleClass("hidden");
        $("#desc-creator").toggleClass("hidden");
    });

    $('#edit-topic-cancel').on('click', function () {
        $("#desc-edit").addClass("hidden");
        $("#desc-container").removeClass("hidden");
        $("#desc-creator").removeClass("hidden");
    });

    $('#edit-topic-save').on('click', function () {
        var id = $(this).val();
        var desc = $("#edit-topic-text").val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/edit_topic/' + id,
            type: 'POST',
            data: {topic_description: desc},
            success: function (data) {
                $("#desc-edit").addClass("hidden");
                $("#desc-creator").removeClass("hidden");
                $("#desc-container").removeClass("hidden");
                $("#desc-container").html(data);
                $("#edit-topic-text").val(data);
            }
        });
    });

    $('#cancel-topic-btn').on('click', function () {
        $("#cancel-topic-modal").modal("show");
    });

    $("#topic-invite-btn").on("click", function () {
        $("#invitation-modal").modal("show");
    });

    $("#topic-apply-btn").on("click", function () {
        var apply_btn = $(this);

        if (apply_btn.hasClass("btn-primary")) {
            $.ajax({
                url: window.location.origin + '/GetTogetherBeta/topic/apply',
                success: function () {
                    apply_btn.removeClass("btn-primary");
                    apply_btn.addClass("btn-gray");
                    apply_btn.html("Pending Moderator Request");
                }
            });
        } else {
            $.ajax({
                url: window.location.origin + '/GetTogetherBeta/topic/apply',
                success: function () {
                    apply_btn.removeClass("btn-danger");
                    apply_btn.removeClass("btn-gray");
                    apply_btn.addClass("btn-primary");
                    apply_btn.html("Apply as a moderator!");
                }
            });
        }
    });

    $("#topic-apply-btn").on("mouseover", function () {
        if ($(this).hasClass("btn-gray")) {
            $(this).removeClass("btn-gray");
            $(this).html("Cancel Moderator Request");
            $(this).addClass("btn-danger");
        }
    });

    $("#topic-apply-btn").on("mouseout", function () {
        if ($(this).hasClass("btn-danger")) {
            $(this).removeClass("btn-danger");
            $(this).addClass("btn-gray");
            $(this).html("Pending Moderator Request");
        }
    });

    $(".remove-follower-btn").on("click", function () {
        var val = $(this).val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/load_remove/' + val + "/1",
            success: function (html) {
                $('#remove-member-confirm').remove();
                $('#topic-page').append(html);
                $('#remove-member-confirm').modal('show');
            }
        });
    });

    $(".remove-mod-btn").on("click", function () {
        var val = $(this).val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/load_remove/' + val + "/2",
            success: function (html) {
                $('#remove-member-confirm').remove();
                $('#topic-page').append(html);
                $('#remove-member-confirm').modal('show');
            }
        });
    });

    $(".remove-creator-btn").on("click", function () {
        var val = $(this).val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/load_remove/' + val + "/3",
            success: function (html) {
                $('#remove-member-confirm').remove();
                $('#topic-page').append(html);
                $('#remove-member-confirm').modal('show');
            }
        });
    });

    $(document).on('click', '#remove-follower-proceed', function () {
        var val = $('#remove-follower-proceed').val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/remove_member/' + val + "/1",
        });
    });

    $(document).on('click', '#remove-moderator-proceed', function () {
        var val = $('#remove-moderator-proceed').val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/remove_member/' + val + "/2",
        });
    });

    $(document).on('click', '#remove-creator-proceed', function () {
        var val = $('#remove-creator-proceed').val();
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/remove_member/' + val + "/3",
            success: function () {
                window.location = window.location.origin + '/GetTogetherBeta/topic/';
            }
        });
    });

    $(document).on('click', '#edit-upload-remove', function () {
        $("#edit-attachment-preview").append("<input id = 'remove_upload' type = 'hidden' name = 'upload_attachment' value = '" + $(this).val() + "'/>")
        editAttachmentRemove();
    });

    $(document).on('click', '#edit-attachment-remove', function () {
        editAttachmentRemove();
    });

    $(document).on('click', '#attachment-remove', function () {
        $("#attachment-details").remove();
        $("#attachment-preview").append('<h5 id = "attachment-message" class = "text-warning text-center">No attachment yet.</h5>');
        //reset all attachments
        $("#attach-img").wrap('<form>').closest('form').get(0).reset();
        $("#attach-img").unwrap();
        $("#attach-audio").wrap('<form>').closest('form').get(0).reset();
        $("#attach-audio").unwrap();
        $("#attach-video").wrap('<form>').closest('form').get(0).reset();
        $("#attach-video").unwrap();
        $("#attach-file").wrap('<form>').closest('form').get(0).reset();
        $("#attach-file").unwrap();

        //enable attachment buttons
        $("#attach-img").removeAttr('disabled');
        $("#img-label").removeClass('disabled');
        $("#image-text").html('<i class = "fa fa-file-image-o"></i> Add Image');

        $("#attach-audio").removeAttr('disabled');
        $("#audio-label").removeClass('disabled');
        $("#audio-text").html('<i class = "fa fa-file-audio-o"></i> Add Audio');

        $("#attach-video").removeAttr('disabled');
        $("#video-label").removeClass('disabled');
        $("#video-text").html('<i class = "fa fa-file-image-o"></i> Add Video');

        $("#attach-file").removeAttr('disabled');
        $("#file-label").removeClass('disabled');
        $("#file-text").html('<i class = "fa fa-file-o"></i> Add File');
    });

    $(document).on('change', '#edit-attach-img', function () {
        //disable attachment buttons
        $("#edit-attach-audio").attr('disabled', 'true');
        $("#edit-audio-label").addClass('disabled');
        $("#edit-attach-video").attr('disabled', 'true');
        $("#edit-video-label").addClass('disabled');
        $("#edit-attach-file").attr('disabled', 'true');
        $("#edit-file-label").addClass('disabled');
        $("#remove_upload").remove();
        $("#edit-attachment-preview").append("<input id = 'remove_upload' type = 'hidden' name = 'upload_post' value = '1'/>")

        changeEditAttachment();
    });

    $(document).on('change', '#edit-attach-audio', function () {
        //disable attachment buttons
        $("#edit-attach-img").attr('disabled', 'true');
        $("#edit-img-label").addClass('disabled');
        $("#edit-attach-video").attr('disabled', 'true');
        $("#edit-video-label").addClass('disabled');
        $("#edit-attach-file").attr('disabled', 'true');
        $("#edit-file-label").addClass('disabled');
        $("#remove_upload").remove();
        $("#edit-attachment-preview").append("<input id = 'remove_upload' type = 'hidden' name = 'upload_post' value = '1'/>")

        changeEditAttachment();
    });

    $(document).on('change', '#edit-attach-video', function () {
        //disable attachment buttons
        $("#edit-attach-img").attr('disabled', 'true');
        $("#edit-img-label").addClass('disabled');
        $("#edit-attach-audio").attr('disabled', 'true');
        $("#edit-audio-label").addClass('disabled');
        $("#edit-attach-file").attr('disabled', 'true');
        $("#edit-file-label").addClass('disabled');
        $("#remove_upload").remove();
        $("#edit-attachment-preview").append("<input id = 'remove_upload' type = 'hidden' name = 'upload_post' value = '1'/>")

        changeEditAttachment();
    });

    $(document).on('change', '#edit-attach-file', function () {
        //disable attachment buttons
        $("#edit-attach-img").attr('disabled', 'true');
        $("#edit-img-label").addClass('disabled');
        $("#edit-attach-audio").attr('disabled', 'true');
        $("#edit-audio-label").addClass('disabled');
        $("#edit-attach-video").attr('disabled', 'true');
        $("#edit-video-label").addClass('disabled');
        $("#remove_upload").remove();
        $("#edit-attachment-preview").append("<input id = 'remove_upload' type = 'hidden' name = 'upload_post' value = '1'/>")

        changeEditAttachment();
    });

    $(document).on('change', '#attach-img', function () {
        //disable attachment buttons
        $("#image-text").html('<i class = "fa fa-file-image-o"></i> Change Image');
        $("#attach-audio").attr('disabled', 'true');
        $("#audio-label").addClass('disabled');
        $("#attach-video").attr('disabled', 'true');
        $("#video-label").addClass('disabled');
        $("#attach-file").attr('disabled', 'true');
        $("#file-label").addClass('disabled');
        changeAttachment();
    });

    $(document).on('change', '#attach-audio', function () {
        //disable attachment buttons
        $("#audio-text").html('<i class = "fa fa-file-audio-o"></i> Change Audio');
        $("#attach-img").attr('disabled', 'true');
        $("#img-label").addClass('disabled');
        $("#attach-video").attr('disabled', 'true');
        $("#video-label").addClass('disabled');
        $("#attach-file").attr('disabled', 'true');
        $("#file-label").addClass('disabled');

        changeAttachment();
    });

    $(document).on('change', '#attach-video', function () {
        //disable attachment buttons
        $("#video-text").html('<i class = "fa fa-file-video-o"></i> Change Video');
        $("#attach-img").attr('disabled', 'true');
        $("#img-label").addClass('disabled');
        $("#attach-audio").attr('disabled', 'true');
        $("#audio-label").addClass('disabled');
        $("#attach-file").attr('disabled', 'true');
        $("#file-label").addClass('disabled');

        changeAttachment();
    });

    $(document).on('change', '#attach-file', function () {
        //disable attachment buttons
        $("#file-text").html('<i class = "fa fa-file-o"></i> Change File');
        $("#attach-img").attr('disabled', 'true');
        $("#img-label").addClass('disabled');
        $("#attach-audio").attr('disabled', 'true');
        $("#audio-label").addClass('disabled');
        $("#attach-video").attr('disabled', 'true');
        $("#video-label").addClass('disabled');

        changeAttachment();
    });

    $('#sort-dropdown li a').click(function () {
        var sort_type = $(this).data('value');
        $.ajax({
            url: window.location.origin + '/GetTogetherBeta/topic/sort',
            type: 'POST',
            data: {sort_type: sort_type, keyword: $('#search-topic-list').val()},
            success: function (html) {
                $("#topic-list").empty();
                $("#topic-list").append(html);

                switch (sort_type) {
                    case 1:
                        $("#chosen-sort").html('<strong><i class = "fa fa-clock-o"></i> Date Created </strong>' +
                                '<i class="caret"></i>');
                        break;
                    case 2:
                        $("#chosen-sort").html('<strong><i class = "fa fa-group"></i> Follower Count </strong>' +
                                '<i class="caret"></i>');
                        break;
                    case 3:
                        $("#chosen-sort").html('<strong><i class = "fa fa-comments"></i> Post Count </strong>' +
                                '<i class="caret"></i>');
                        break;
                }
            }
        });
    });
});

function changeAttachment() {
    $("#attachment-message").remove();
    $("#attachment-details").remove();
    $("#attachment-preview").append('<div id = "attachment-details" class = "form-group" style = "padding:3px">' +
            '<label for="attachment-caption" class="col-sm-3 no-padding" style = "padding-top: 5px;">' +
            'Add a caption!' +
            '</label>' +
            '<div class = "col-sm-8 no-padding">' +
            '<input type="text" class="form-control" name = "attachment_caption" id = "attachment-caption" ' +
            'placeholder = "Enter a caption"/>' +
            '</div>' +
            '<div class ="col-sm-1">' +
            '<button id = "attachment-remove" type = "button" class = "delete-btn btn btn-sm btn-danger">' +
            '<i class = "fa fa-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>');
}

function changeEditAttachment() {
    $("#edit-attachment-message").remove();
    $("#edit-attachment-details").remove();
    $("#edit-attachment-preview").append('<div id = "edit-attachment-details" class = "form-group" style = "padding:3px">' +
            '<label for="edit-attachment-caption" class="col-sm-3 no-padding" style = "padding-top: 5px;">' +
            'Add a caption!' +
            '</label>' +
            '<div class = "col-sm-8 no-padding">' +
            '<input type="text" class="form-control" name = "edit_attachment_caption" id = "edit-attachment-caption" ' +
            'placeholder = "Enter a caption"/>' +
            '</div>' +
            '<div class ="col-sm-1">' +
            '<button id = "edit-attachment-remove" type = "button" class = "delete-btn btn btn-sm btn-danger">' +
            '<i class = "fa fa-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>');
}

function editAttachmentRemove() {
    $("#edit-attachment-details").remove();
    $("#edit-attachment-preview").append('<h5 id = "edit-attachment-message" class = "text-warning text-center">No attachment yet.</h5>');
    //reset all attachments
    $("#edit-attach-img").wrap('<form>').closest('form').get(0).reset();
    $("#edit-attach-img").unwrap();
    $("#edit-attach-audio").wrap('<form>').closest('form').get(0).reset();
    $("#edit-attach-audio").unwrap();
    $("#edit-attach-video").wrap('<form>').closest('form').get(0).reset();
    $("#edit-attach-video").unwrap();
    $("#edit-attach-file").wrap('<form>').closest('form').get(0).reset();
    $("#edit-attach-file").unwrap();

    //enable attachment buttons
    $("#edit-attach-img").removeAttr('disabled');
    $("#edit-img-label").removeClass('disabled');
    $("#edit-image-text").html('<i class = "fa fa-file-image-o"></i> Add Image');

    $("#edit-attach-audio").removeAttr('disabled');
    $("#edit-audio-label").removeClass('disabled');
    $("#edit-audio-text").html('<i class = "fa fa-file-audio-o"></i> Add Audio');

    $("#edit-attach-video").removeAttr('disabled');
    $("#edit-video-label").removeClass('disabled');
    $("#edit-video-text").html('<i class = "fa fa-file-image-o"></i> Add Video');

    $("#edit-attach-file").removeAttr('disabled');
    $("#edit-file-label").removeClass('disabled');
    $("#edit-file-text").html('<i class = "fa fa-file-o"></i> Add File');
}