<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author Arces
 */
class Upload extends CI_Controller {

    public function index() {
        //something
    }

    public function load_post_attachments() {
        $post_id = $this->uri->segment(3);
        $type = $this->uri->segment(4);

        $this->load->model('attachment_model', 'attachments');
        if ($type === '1') {
            $attachments = $this->attachments->get_post_attachments($post_id);
        } else if ($type === '0') {
            $attachments = $this->attachments->get_thread_attachments($post_id);
        }

        $data['attachments'] = $attachments;
        $this->load->view('modals/attachment_modal', $data);
    }

    public function get_attachment_url() {
        $attachment_id = $this->uri->segment(3);

        $this->load->model('attachment_model', 'attachments');
        $attachment = $this->attachments->get_attachment($attachment_id);

        $data = array('url' => $attachment->file_url);
        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

}
