<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notifications
 *
 * @author Arces
 */
class Notifications extends CI_Controller {

    public function index() {
        $logged_user = $_SESSION['logged_user'];

        if ($logged_user) {
            $this->load->model("notification_model", "notifs");

            $this->notifs->update_user_notifs($logged_user);
        }
    }

    public function read() {
        $logged_user = $_SESSION['logged_user'];
        $this->load->model("notification_model", "notifs");
        $this->notifs->read_user_notifications($logged_user->user_id);
    }

}
