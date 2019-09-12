$(document).ready(function () {
    $(".upvote-btn").on("click", function () {
        vote($(this), 1);
    });

    $(".downvote-btn").on("click", function () {
        vote($(this), -1);
    });

    $(".edit-btn").on("click", function () {
        var post_id = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/topic/load_post/edit",
            type: "POST",
            dataType: "json",
            data: {post_id: post_id},
            success: function (data) {
                $("#post-title").val($('<textarea/>').html(data.edit_post.post_title).text());
                $("#post-content").val($('<textarea/>').html(data.edit_post.post_content).text());
                $("#edit-post-topic").html("<strong>Edit your post in " + data.edit_post.topic_name + "</strong>");
                $("#edit-confirm-topic").html("<strong>Save changes made to your post in " + data.edit_post.topic_name + "</strong>");
                $("#edit-post-form").attr("action", window.location.origin + "/GetTogetherBeta/topic/edit_post/" + data.edit_post.post_id);
                if (!(data.edit_post.attachments[0] == null)) {
                    $("#edit-attachment-message").remove();
                    $("#edit-attachment-details").remove();
                    $("#edit-attachment-preview").append('<div id = "edit-attachment-details" class = "form-group" style = "padding:3px">' +
                            '<label for="attachment-caption" class="col-sm-3 no-padding" style = "padding-top: 5px;">' +
                            'Add a caption!' +
                            '</label>' +
                            '<div class = "col-sm-8 no-padding">' +
                            '<input type="text" class="form-control" name = "edit_attachment_caption" id = "edit-attachment-caption" ' +
                            'placeholder = "Enter a caption" value = "' + data.edit_post.attachments[0].caption + '"/>' +
                            '</div>' +
                            '<div class ="col-sm-1">' +
                            '<button id = "edit-upload-remove" type = "button" class = "delete-btn btn btn-sm btn-danger" value = "' + data.edit_post.attachments[0].attachment_id + '">' +
                            '<i class = "fa fa-trash"></i>' +
                            '</button>' +
                            '<input type = "hidden" name = "current_attachment" value = "' + data.edit_post.attachments[0].attachment_id + '"/>' +
                            '</div>' +
                            '</div>');

                    switch (data.edit_post.attachments[0].attachment_type_id) {
                        case '1': //image        
                            $("#edit-image-text").html('<i class = "fa fa-file-image-o"></i> Change Image');
                            $("#edit-attach-audio").attr('disabled', 'true');
                            $("#edit-audio-label").addClass('disabled');
                            $("#edit-attach-video").attr('disabled', 'true');
                            $("#edit-video-label").addClass('disabled');
                            $("#edit-attach-file").attr('disabled', 'true');
                            $("#edit-file-label").addClass('disabled');
                            break;
                        case '2': //audio
                            $("#edit-audio-text").html('<i class = "fa fa-file-image-o"></i> Change Audio');
                            $("#edit-attach-image").attr('disabled', 'true');
                            $("#edit-image-label").addClass('disabled');
                            $("#edit-attach-video").attr('disabled', 'true');
                            $("#edit-video-label").addClass('disabled');
                            $("#edit-attach-file").attr('disabled', 'true');
                            $("#edit-file-label").addClass('disabled');
                            break;
                        case '3': //video
                            $("#edit-video-text").html('<i class = "fa fa-file-image-o"></i> Change Video');
                            $("#edit-attach-audio").attr('disabled', 'true');
                            $("#edit-audio-label").addClass('disabled');
                            $("#edit-attach-image").attr('disabled', 'true');
                            $("#edit-image-label").addClass('disabled');
                            $("#edit-attach-file").attr('disabled', 'true');
                            $("#edit-file-label").addClass('disabled');
                            break;
                        case '4': //file
                            $("#edit-file-text").html('<i class = "fa fa-file-image-o"></i> Change File');
                            $("#edit-attach-audio").attr('disabled', 'true');
                            $("#edit-audio-label").addClass('disabled');
                            $("#edit-attach-video").attr('disabled', 'true');
                            $("#edit-video-label").addClass('disabled');
                            $("#edit-attach-image").attr('disabled', 'true');
                            $("#edit-image-label").addClass('disabled');
                            break;
                    }
                }
                $("#edit-post-modal").modal("show");
            }
        });
    });

    $("#save-post-btn").on("click", function () {
        if ($("#post-title").val() && $("#post-content").val()) {
            $("#post-edit-confirm").modal('show');
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

    $("#edit-post-proceed").on("click", function () {
        $("#edit-post-form").submit();
    });

    $(".delete-btn").on("click", function () {
        var val = $(this).val();
        $("#delete-post-form").attr("action", window.location.origin + "/GetTogetherBeta/topic/delete_post/" + val);

        $("#post-delete-confirm").modal("show");
    });

    $(".attachment-btn").on("click", function () {
        var val = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/upload/load_post_attachments/" + val + "/1",
            type: "POST",
            success: function (html) {
                $("#attachment-modal-container").remove();
                $(".modal-backdrop").remove();
                $("#thread-page").append(html);
                $("#attachment-modal").modal("show");
            }
        });
    });

    $("#thread-attachment-btn").on("click", function () {
        var val = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/upload/load_post_attachments/" + val + "/0",
            type: "POST",
            success: function (html) {
                $("#attachment-modal-container").remove();
                $(".modal-backdrop").remove();
                $("#thread-page").append(html);
                $("#attachment-modal").modal("show");
            }
        });
    });

    $(document).on('click', ".image-attach-view", function () {
        var val = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/upload/get_attachment_url/" + val,
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#image-attachment").attr('src', window.location.origin + "/GetTogetherBeta/" + data.url);
                $("#image-modal").modal("show");
            }
        });
    });

    $(document).on('click', ".audio-attach-view", function () {
        var val = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/upload/get_attachment_url/" + val,
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#audio-attachment").attr('src', window.location.origin + "/GetTogetherBeta/" + data.url);
                $("#audio-modal").modal("show");
            }
        });
    });

    $(document).on('click', ".video-attach-view", function () {
        var val = $(this).val();

        $.ajax({
            url: window.location.origin + "/GetTogetherBeta/upload/get_attachment_url/" + val,
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#video-attachment").attr('src', window.location.origin + "/GetTogetherBeta/" + data.url);
                $("#video-modal").modal("show");
            }
        });
    });
});

function vote(vote_btn, vote_type) {
    var data = {vote_type: vote_type};
    var post_id = vote_btn.val();
    var count = vote_btn.siblings(".vote-count");
    var trophy = "<i class = \"fa fa-trophy\"></i>";
    $.ajax({
        url: window.location.origin + "/GetTogetherBeta/topic/vote/" + post_id,
        type: "POST",
        data: data,
        success: function (data) {
            //optimize
            if (vote_type === 1) {
                count.html(data);
                if (vote_btn.find('span').hasClass('upvote-text')) {
                    vote_btn.find('span').removeClass('upvote-text');
                } else {
                    vote_btn.siblings('.downvote-btn').find('span').removeClass("downvote-text");
                    vote_btn.find('span').addClass("upvote-text");
                    $(".topic-post-entry").each(function () {
                        if (post_id.toString() === $(this).data("value").toString()) {
                            $(this).find(".vote-count").html(data + " " + trophy);
                            $(this).find(".vote-count").removeClass("text-success");
                            $(this).find(".vote-count").removeClass("text-danger");
                            if (parseInt(data) > 0) {
                                $(this).find(".vote-count").addClass("text-success");
                            } else if (parseInt(data) < 0) {
                                $(this).find(".vote-count").addClass("text-danger");
                            }
                            return false;
                        }
                    });
                }
            } else if (vote_type === -1) {
                count.html(data);
                if (vote_btn.find('span').hasClass('downvote-text')) {
                    vote_btn.find('span').removeClass('downvote-text');
                } else {
                    vote_btn.siblings('.upvote-btn').find('span').removeClass("upvote-text");
                    vote_btn.find('span').addClass("downvote-text");
                    $(".topic-post-entry").each(function () {
                        if (post_id.toString() === $(this).data("value").toString()) {
                            $(this).find(".vote-count").html(data + " " + trophy);
                            $(this).find(".vote-count").removeClass("text-success");
                            $(this).find(".vote-count").removeClass("text-danger");
                            if (parseInt(data) < 0) {
                                $(this).find(".vote-count").addClass("text-danger");
                            } else if (parseInt(data) > 0) {
                                $(this).find(".vote-count").addClass("text-success");
                            }
                            return false;
                        }
                    });
                }
            }
        }
    });
}