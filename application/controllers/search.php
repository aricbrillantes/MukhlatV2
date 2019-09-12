<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search
 *
 * @author Arces
 */
class Search extends CI_Controller {
    public function index() {
        $this->load->model("user_model", "users");
        $this->load->model("topic_model", "topics");
        $keyword = utf8_encode(htmlspecialchars($this->input->get("search-key")));
        $data['keyword'] = $keyword;
        $data['users'] = $this->users->search_users($keyword, false);
        $data['topics'] = $this->topics->search_topics($keyword, 0);
        $this->load->view('pages/search_page', $data);
    }

    public function topic() {
        $keyword = $this->input->post("keyword");
        $this->load->model("topic_model", "topics");
        $sort_type = $_SESSION['sort_type'];
        $topics = $this->topics->search_topics(utf8_encode(htmlspecialchars($keyword)), $sort_type);
        $html = "";

        foreach ($topics as $topic) {
            $user = $topic->user;
            $html = $html . "<a class = \"list-group-item btn btn-link list-entry\" href = \"topic/view/" . $topic->topic_id . "\">\n"
                    . "<h4 class = \"text-info no-padding no-margin\" style = \"display: inline-block;\">" . $topic->topic_name . "</h4>\n"
                    . "<small><i>by " . $user->first_name . " " . $user->last_name . " </i></small>\n"
                    . "<div class = \"pull-right\">\n"
                    . "<span class = \"label label-info follower-label\"><i class = \"fa fa-group\"></i> " . ($topic->followers ? count($topic->followers) : '0') . " </span>\n"
                    . "</div>\n"
                    . "</a>\n";
        }
        echo $html;
    }

    public function user() {
        $keyword = $this->input->get("keyword");
        $this->load->model("user_model", "users");
        $logged_user = $_SESSION['logged_user'];
        $users = $this->users->search_users(utf8_encode(htmlspecialchars($keyword)), true);
        $html = "";

        foreach ($users as $user) {
            $html = $html . "<li class = 'list-group-item admin-list-item'>" .
                    "<img src = '";

            if ($user->profile_url) {
                $html = $html . base_url($user->profile_url);
            } else {
                $html = $html . base_url('images/default.jpg');
            }

            $html = $html . "' class = 'no-padding pull-left img-circle' width = '45px' height = '45px'/>" .
                    "<h4 class = 'no-padding admin-list-name'>" . $user->first_name . ' ' . $user->last_name;

            if ($user->role_id === '1') {
                $html = $html . "<i class = 'text-muted btn-sm no-padding'>Administrator ";
                if ($logged_user->user_id === $user->user_id) {
                    $html = $html . "(You)";
                }
                $html = $html . "</i>";
            } else {
                $html = $html . "<button value = '" . $user->user_id . "' class = 'record-view-btn btn btn-link btn-xs'>" .
                        "<i class = 'fa fa-question-circle-o'></i> <i>Record of " . $user->first_name . "</i></button>";
            }
            $html = $html . "</h4>";
            if ($logged_user->user_id !== $user->user_id) {
                if ($user->is_enabled) {
                    $html = $html . "<button type = 'button' value = '" . $user->user_id . "' "
                            . "class = 'toggle-account pull-right btn btn-danger admin-list-btn'>Disable</button>";
                } else {
                    $html = $html . "<button type = 'button' value = '" . $user->user_id . "' "
                            . "class = 'toggle-account pull-right btn btn-success admin-list-btn'>Enable</button>";
                }
            }
            $html = $html . "</li>";
        }
        echo $html;
    }
}
