<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of topic
 *
 * @author Arces
 */
class Topic extends CI_Controller {

    public function index() {

        if(isset($_SESSION['logged_user']))
        {
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];
            if (!empty($logged_user)) 
            {
                $this->load->model('topic_model', 'topics');
                $_SESSION['sort_type'] = 1;
                $data['topics'] = $this->topics->search_topics('', 1);
                $this->load->view('pages/topic_list_page', $data);
            }
        }

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
         
    }

    public function view() {
        
        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }

        $topic_id = $this->uri->segment(3);

        if ($topic_id) {
            $this->load->model('topic_model', 'topics');
            $this->load->model('notification_model', 'notifs');
            $topic = $this->topics->get_topic(true, $topic_id);

            if ($topic) {
                //change to redirect later
                $_SESSION['current_topic'] = $topic;

                //check if user is following topic then pass
                $data['is_followed'] = $this->topics->check_follow($topic->topic_id, $logged_user->user_id);
                $data['is_moderated'] = $this->topics->check_moderated($topic->topic_id, $logged_user->user_id);
                $data['has_requested'] = $this->notifs->check_request($logged_user->user_id, $topic->topic_id);

                //check if user is a moderator or the creator

                $this->load->view('pages/topic_page', $data);
            } 

            else 
            {
                // $this->load->view('errors/error_404');
                $homeURL = base_url('home');
                header("Location: $homeURL");
            }

        } 

        else 
        {
            // $this->load->view('errors/error_404');
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
    }

    public function thread() {
        $post_id = $this->uri->segment(3);
        if ($post_id) {
            $this->load->model('post_model', 'posts');
            $post = $this->posts->get_post(true, true, true, $post_id);

            if ($post) {
                //check if user is following topic then pass
                $data['post'] = $post;
                $data['is_moderated'] = $this->topics->check_moderated($post->topic->topic_id, $_SESSION['logged_user']->user_id);

                if ($post->replies) {
                    $data['replies'] = $this->load->view('post_replies', $data, TRUE);
                }
                $_SESSION['current_topic'] = $post->topic;

                $this->load->view('pages/thread_page', $data);
            } else {
                $this->load->view('errors/error_404');
            }
        } else {
            $this->load->view('errors/error_404');
        }
    }
    
    
    public function create() {
        $input = $this->input;

        if(isset($_SESSION['logged_user']))
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];
        

        $data = array(
            'creator_id' => $logged_user->user_id,
            'topic_name' => utf8_encode(htmlspecialchars($input->post('topic_name'))),
            'topic_description' => utf8_encode(htmlspecialchars($input->post('topic_description'))),
            'theme' => utf8_encode(htmlspecialchars($input->post('topic_theme')))
        );

        $this->db->set('date_created', 'NOW()', FALSE);
        $this->db->insert('tbl_topics', $data);
        $topic_id = $this->db->insert_id();
        
        
        // ATTACHMENTS
        if (!file_exists('./uploads1/_' . $topic_id . '/')) {
            mkdir('./uploads1/_' . $topic_id . '/', 0777, true);
        }
        $config['upload_path'] = './uploads1/_' . $topic_id . '/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';
        $config['maxsize'] = '0';

        $this->load->library('upload', $config);

        //image
        if (isset($_FILES['topic_image']['name'])) {
            mkdir('./uploads1/_good/', 0777, true);
            if (!$this->upload->do_upload('topic_image')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads1/_' . $topic_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');
                
                $this->attachments->insert_cover($topic_id, $path);
            }
        }
        
        //follow topic
        $follow_data = array(
            'user_id' => $logged_user->user_id,
            'topic_id' => $topic_id
        );

        $this->db->insert("tbl_topic_follower", $follow_data);

        //moderate topic
        $this->db->insert("tbl_topic_moderator", $follow_data);

        //return topic
        $this->load->model("topic_model", "topics");
        $topic = $this->topics->get_topic(true, $topic_id);

        //add topic to topics of logged user
        $logged_user->topics[] = $topic;

        //add topic to followed topics of logged user
        $logged_user->followed_topics[] = $topic;

        //add topic to moderated topics of logged user
        $logged_user->moderated_topics[] = $topic;
        redirect('topic/view/' . $topic_id);
    }

    public function follow() {
        if(isset($_SESSION['logged_user']))
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        if ($logged_user) {
            $topic_id = $this->uri->segment(3);
            $this->load->model("topic_model", "topics");

            //check if user is already following
            $is_followed = $this->topics->check_follow($topic_id, $logged_user->user_id);
            $data = array(
                'user_id' => $logged_user->user_id,
                'topic_id' => $topic_id
            );

            if (!$is_followed) {
                //if user is not yet following the topic, insert to db
                $this->db->insert("tbl_topic_follower", $data);
            } else {
                //if user is following the topic, delete from db
                $this->db->delete("tbl_topic_follower", $data);
            }

            //return topic
            $topic = $this->topics->get_topic(true, $topic_id);

            if (!$is_followed) {
                //add topic to followed topics of logged user
                $logged_user->followed_topics[] = $topic;

                //notify user if owner is not logged user
                if ($logged_user->user_id !== $topic->creator_id) {
                    $this->load->model("notification_model", "notifs");
                    $this->notifs->notify_user($topic->creator_id, $topic->topic_id, 2);
                }
            } else {
                //if user is following the topic, remove from list
                foreach ($logged_user->followed_topics as $key => $topic) {
                    if ($topic->topic_id == $topic_id) {
                        unset($logged_user->followed_topics[$key]);
                    }
                }
            }
        } else {
            echo 'error';
        }
    }

    /* FUNCTIONS FOR POSTS */

    public function post() {

        // echo '<script type="text/javascript">alert("post")</script>'; 

        $input = $this->input;

        if(isset($_SESSION['logged_user']))
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        if(isset($_SESSION['current_topic']))
            $topic = $_SESSION['current_topic'];

        $data = array
        (
            'parent_id' => 0,
            'user_id' => $logged_user->user_id,
            'root_id' => 0,
            'topic_id' => $topic->topic_id,
            'post_title' => utf8_encode(htmlspecialchars($input->post('post_title'))),
            'post_content' => utf8_encode(htmlspecialchars($input->post('post_content'))),
            'reply' => utf8_encode(htmlspecialchars($input->post('reply'))),
            'shout' => utf8_encode(htmlspecialchars($input->post('shout'))),
        );

        $caption = utf8_encode(htmlspecialchars($input->post('attachment_caption')));
        $this->db->set('date_posted', 'NOW()', FALSE);
        $this->db->insert('tbl_posts', $data);

        $post_id = $this->db->insert_id();

        date_default_timezone_set('Asia/Manila');

        //update swear infractions in database
        $swears = 
        substr_count($input->post('post_content'), 'fuck') +
        substr_count($input->post('post_content'), 'shit') +
        substr_count($input->post('post_content'), 'ass'); 

        $this->db->select('*');
        $this->db->from('tbl_infractions');
        $this->db->where(array('tbl_infractions.user_id' => $logged_user->user_id));

        $infractions = $this->db->get();

        if(!empty($infractions->result()))
        {
            $currentWeekInfractions = $infractions->row()->current_total;
            $overallInfractions = $infractions->row()->overall_total;

            // $lastDate=date_create($child->updated);
            // date_sub($lastDate,date_interval_create_from_date_string("7 days"));
            // echo date_format($lastDate,"Y-m-d");

            
            // $subDate=date_create(date('Y-m-d'));
            // date_sub($subDate,date_interval_create_from_date_string("1 day"));

            $lastDate=date_create($infractions->row()->updated);
            $curDate=date_create(date('Y-m-d'));

            $FirstDay = date_create(date("Y-m-d", strtotime('sunday last week')));  
            $LastDay = date_create(date("Y-m-d", strtotime('sunday this week')));               

            // echo $lastDate->format('Y-m-d') . "<br>";
            // echo $subDate->format('Y-m-d') . "<br>";
            // echo $curDate->format('Y-m-d') . "<br>";

            // echo date('D', strtotime($curDate->format('Y-m-d')));

            //if table was updated within the week, update for this week
            if($lastDate > $FirstDay && $lastDate < $LastDay)
            {
                $data = array
                (
                    'user_id' => $logged_user->user_id,
                    'current_total' => $swears+$currentWeekInfractions,
                    'overall_total' => $swears+$overallInfractions,
                    'current_avg' => ($swears+$currentWeekInfractions)/7,
                    'updated' => date('Y-m-d')
                );

            }

            //if table was updated last week, update for both stats for this week and last week
            else
            {
                $data = array
                (
                    'user_id' => $logged_user->user_id,
                    'current_total' => $swears,
                    'last_total' => ($infractions->row()->current_total),
                    'overall_total' => $swears+$overallInfractions,
                    'current_avg' => $swears/7,
                    'last_avg' => ($infractions->row()->current_total)/7,
                    'updated' => date('Y-m-d')
                );
            }
            

            // $this->db->delete('tbl_infractions', array('user_id' => $logged_user->user_id));
            // $this->db->insert('tbl_infractions', $data);

            $this->db->select('*');
            $this->db->from('tbl_infractions');
            $this->db->where('user_id', $logged_user->user_id);
            $this->db->update('tbl_infractions', $data); 
        } 

        else
        {
            $data = array
            (
                'user_id' => $logged_user->user_id,
                'current_total' => $swears,
                'overall_total' => $swears,
                'current_avg' => ($swears+$currentWeekInfractions)/7,
                'updated' => date('Y-m-d')
            );

            $this->db->insert('tbl_infractions', $data);
        }


        // ATTACHMENTS
        if (!file_exists('./uploads/_' . $post_id . '/')) {
            mkdir('./uploads/_' . $post_id . '/', 0777, true);
        }
        $config['upload_path'] = './uploads/_' . $post_id . '/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';
        $config['maxsize'] = '0';

        $this->load->library('upload', $config);

        //image
        if (isset($_FILES['post_image']['name'])) {
            if (!$this->upload->do_upload('post_image')) {
                // echo '<script type="text/javascript">alert("fail");</script>'; 
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post_id . '/' . $upload_data['file_name'];
    
                // echo '<script type="text/javascript">alert("' . $upload_data['file_name'] . '");</script>';

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 1);
            }
        }

        //audio
        if (isset($_FILES['post_audio']['name'])) {
            if (!$this->upload->do_upload('post_audio')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 2);
            }
        }

        //video
        if (isset($_FILES['post_video']['name'])) {

            if (!$this->upload->do_upload('post_video')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 3);
            }
        }

        //file
        if (isset($_FILES['post_file']['name'])) {
            if (!$this->upload->do_upload('post_file')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 4);
            }
        }

        //set post id as root id of post
        $this->db->set("root_id", $post_id);
        $this->db->where("post_id", $post_id);
        $this->db->update("tbl_posts");

        if ($logged_user->user_id !== $topic->user->user_id) {
            //notify owner of topic if logged user != owner
            $this->load->model("notification_model", "notifs");
            $this->notifs->notify_user($topic->user->user_id, $post_id, 5);
        }
        redirect(base_url('topic/view/' . $topic->topic_id));
    }

    public function preview() {
        $this->load->model('post_model', 'posts');

        //check referer
        $post_id = $this->uri->segment(3);
        $data['post'] = $this->posts->get_post(false, true, false, $post_id);

        $this->load->view('post_preview', $data);
    }

    public function vote() {
        if(isset($_SESSION['logged_user']))
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        $post_id = $this->uri->segment(3);
        $vote_type = $this->input->post("vote_type");
        $this->load->model("post_model", "posts");

        //if upvote
        $has_vote = $this->posts->get_vote_type($post_id, $logged_user->user_id);
        $this->posts->vote_post($logged_user->user_id, $post_id, $vote_type);

        $post = $this->posts->get_post(false, true, false, $post_id);
        if ($vote_type === '1' && $has_vote !== "1") {
            $this->load->model("notification_model", "notifs");
            $this->notifs->notify_user($post->user->user_id, $post_id, 3);
        }
        if ($vote_type == '1' && $has_vote == '1' || $vote_type == '-1' && $has_vote == '-1') {
            $this->posts->remove_vote($post_id, $logged_user->user_id);
        }

        echo ($this->posts->get_vote_count($post_id) ? $this->posts->get_vote_count($post_id) : '0' );
    }

    public function load_post() {
        $type = $this->uri->segment(3);
        $post_id = $this->input->post("post_id");
        $this->load->model("post_model", "posts");

        if ($type === "reply") {
            $post = $this->posts->get_post(false, true, false, $post_id);
            $data = array("first_name" => $post->user->first_name, "post_id" => $post_id);
        } else if ($type === "edit") {
            $post = $this->posts->get_post(false, true, true, $post_id);

            $data = array("edit_post" => $post);
        }

        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

    public function reply() {
        $id = $this->uri->segment(3);
        $input = $this->input;
        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];
        $topic = $_SESSION['current_topic'];

        $caption = $input->post(utf8_encode(htmlspecialchars('attachment_caption')));
        //get parent then reply
        $this->load->model("post_model", "posts");
        $parent_post = $this->posts->get_post(false, false, false, $id);
        $data = array(
            'parent_id' => $parent_post->post_id,
            'user_id' => $logged_user->user_id,
            'root_id' => $parent_post->root_id,
            'topic_id' => $topic->topic_id,
            'post_title' => utf8_encode(htmlspecialchars($input->post('reply_title'))),
            'post_content' => utf8_encode(htmlspecialchars($input->post('reply_content'))),
        );
        $this->db->set('date_posted', 'NOW()', FALSE);
        $this->db->insert('tbl_posts', $data);

        $post_id = $this->db->insert_id();

        // ATTACHMENTS
        if (!file_exists('./uploads/_' . $parent_post->root_id . '/')) {
            mkdir('./uploads/_' . $parent_post->root_id . '/', 0777, true);
        }

        $config['upload_path'] = './uploads/_' . $parent_post->root_id . '/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';
        $config['maxsize'] = '0';

        $this->load->library('upload', $config);

        //image
        if ($_FILES['reply_image']['name']) {
            if (!$this->upload->do_upload('reply_image')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $parent_post->root_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 1);
            }
        }

        //audio
        if ($_FILES AND $_FILES['reply_audio']['name']) {

            if (!$this->upload->do_upload('reply_audio')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $parent_post->root_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 2);
            }
        }

        //video
        if ($_FILES AND $_FILES['reply_video']['name']) {

            if (!$this->upload->do_upload('reply_video')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $parent_post->root_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 3);
            }
        }

        //file
        if ($_FILES AND $_FILES['reply_file']['name']) {
            if (!$this->upload->do_upload('reply_file')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $parent_post->root_id . '/' . $upload_data['file_name'];

                $this->load->model('attachment_model', 'attachments');

                $this->attachments->insert_attachment($post_id, $path, $caption, 4);
            }
        }

        //insert to notifs
        $this->load->model("notification_model", "notifs");
        $this->notifs->notify_user($parent_post->user_id, $parent_post->post_id, 1);
        redirect(base_url('topic/thread/' . $parent_post->root_id));
    }

    public function edit_post() {
        $post_id = $this->uri->segment(3);
        $input = $this->input;

        //get parent then reply
        $this->load->model("post_model", "posts");
        $this->load->model('attachment_model', 'attachments');

        $data = array(
            'post_title' => utf8_encode(htmlspecialchars($input->post('post_title'))),
            'post_content' => utf8_encode(htmlspecialchars($input->post('post_content'))),
        );

        $this->posts->update_post($post_id, $data);

        $post = $this->posts->get_post(false, false, false, $post_id);

        // ATTACHMENTS
        if (!file_exists('./uploads/_' . $post->root_id . '/')) {
            mkdir('./uploads/_' . $post->root_id . '/', 0777, true);
        }
        $config['upload_path'] = './uploads/_' . $post->root_id . '/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';
        $config['maxsize'] = '0';

        $this->load->library('upload', $config);

        //remove existing attachment if set
        if (isset($_POST['upload_attachment'])) {
            $this->attachments->remove_attachment(array('attachment_id' => $input->post('upload_attachment')));
        } elseif (isset($_POST['upload_post'])) {
            $this->attachments->remove_attachment(array('post_id' => $post_id));
        }

        if (isset($_POST['current_attachment'])) {
            $this->attachments->change_caption($input->post('current_attachment'), $input->post('edit_attachment_caption'));
        }

        $caption = utf8_encode(htmlspecialchars($input->post('edit_attachment_caption')));
        //image
        if ($_FILES['post_image']['name']) {
            if (!$this->upload->do_upload('post_image')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post->root_id . '/' . $upload_data['file_name'];

                $this->attachments->insert_attachment($post_id, $path, $caption, 1);
            }
        }

        //audio
        if ($_FILES AND $_FILES['post_audio']['name']) {

            if (!$this->upload->do_upload('post_audio')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post->root_id . '/' . $upload_data['file_name'];

                $this->attachments->insert_attachment($post_id, $path, $caption, 2);
            }
        }

        //video
        if ($_FILES AND $_FILES['post_video']['name']) {
            if (!$this->upload->do_upload('post_video')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post->root_id . '/' . $upload_data['file_name'];

                $this->attachments->insert_attachment($post_id, $path, $caption, 3);
            }
        }

        //file
        if ($_FILES AND $_FILES['post_file']['name']) {
            if (!$this->upload->do_upload('post_file')) {
                echo $this->upload->display_errors();
            } else {
                //upload success
                $upload_data = $this->upload->data();
                $path = './uploads/_' . $post->root_id . '/' . $upload_data['file_name'];

                $this->attachments->insert_attachment($post_id, $path, $caption, 4);
            }
        }

        redirect(base_url('topic/thread/' . $post->root_id));
    }

    public function delete_post() {
        $post_id = $this->uri->segment(3);

        $this->load->model("post_model", "posts");

        $data = array(
            'is_deleted' => 1
        );

        $this->posts->update_post($post_id, $data);
        $post = $this->posts->get_post(false, false, false, $post_id);
        redirect(base_url('topic/thread/' . $post->root_id));
    }

    public function edit_topic() {
        $topic_id = $this->uri->segment(3);
        $theme = $this->input->post('change_topic_theme', TRUE);
        // $description = $this->input->post('topic_description', TRUE);

        $this->load->model("topic_model", "topics");

        $data = array('theme' => $theme);
        // $data = array('topic_description' => utf8_encode(htmlspecialchars($description)));

        $this->topics->update_topic($topic_id, $data);

        // $redirect = base_url('topic/view/'.$topic_id);

        // echo '<script type="text/javascript">alert("'.base_url('topic/view/'.$topic_id).'")</script>';
        // header("Location: $redirect");
    }

    public function cancel_topic() {
        $topic_id = $this->uri->segment(3);

        $this->load->model("topic_model", "topics");

        $data = array('is_cancelled' => 1);

        $this->topics->update_topic($topic_id, $data);

        //remove topic from logged user
        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        $topic_index = -1;
        foreach ($logged_user->topics as $key => $topic) {
            if ($topic->topic_id === $topic_id) {
                $topic_index = $key;
            }
        }
        unset($logged_user->topics[$topic_index]);

        //remove also from followed topics
        foreach ($logged_user->followed_topics as $key => $topic) {
            if ($topic->topic_id === $topic_id) {
                $topic_index = $key;
            }
        }
        unset($logged_user->followed_topics[$topic_index]);

        //remove also from moderated topics
        foreach ($logged_user->moderated_topics as $key => $topic) {
            if ($topic->topic_id === $topic_id) {
                $topic_index = $key;
            }
        }
        unset($logged_user->moderated_topics[$topic_index]);
        redirect(base_url('topic'));
    }

    public function apply() {
        $user = $_SESSION['logged_user'];
        $topic = $_SESSION['current_topic'];

        $this->load->model("notification_model", "notifs");

        $this->notifs->apply_moderator($user->user_id, $topic->topic_id);
    }

    public function load_remove() {
        $user_id = $this->uri->segment(3);
        $type = $this->uri->segment(4);

        $this->load->model('user_model', 'users');
        $data['user'] = $this->users->get_user(false, false, array('user_id' => $user_id));
        $data['type'] = $type;

        $this->load->view('modals/remove_member_modal', $data);
    }

    public function remove_member() {
        $user_id = $this->uri->segment(3);
        $topic = $_SESSION['current_topic'];
        $type = $this->uri->segment(4);
        $this->load->model('topic_model', 'topics');

        if ($type === '1') { //1 => follower
            $this->topics->remove_member($user_id, $topic->topic_id, 1);
        } else if ($type === '2') { //2 => moderator
            $this->topics->remove_member($user_id, $topic->topic_id, 2);
        } else if ($type === '3') { //3 => creator
            $this->topics->remove_member($user_id, $topic->topic_id, 3);
        }
    }

    //refreshes the user's list of topics
    public function refresh() {
        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        if ($logged_user) {
            $this->load->model("topic_model", "topics");

            $this->topics->update_user_topics($logged_user);
        }
    }

    public function sort() {
        $this->load->model("topic_model", "topics");
        $sort_type = $this->input->post('sort_type');
        $keyword = $this->input->post('keyword');

        $_SESSION['sort_type'] = $sort_type;

        $topics = $this->topics->search_topics(utf8_encode(htmlspecialchars($keyword)), $sort_type);
        $html = "";
        foreach ($topics as $topic) {
            $user = $topic->user;
            $html = $html . "<a class = \"topic-grid1\" href = \"topic/view/" . $topic->topic_id . "\">\n"
                    . "<h4 class = \"text-info no-padding no-margin text1color topicheader\" style = \"display: inline-block;\">" . $topic->topic_name . "</h4><br>\n"
                    . "<small class=\"topicheader2\"><i>by " . $user->first_name . " " . $user->last_name . " </i></small>\n"
                    . "<div class = \"topic-grid-icons\">\n"
                    . "<div class = \"label label-info follower-label\"><i class = \"fa fa-group\"></i> " . ($topic->followers ? count($topic->followers) : '0')
                    . " <i class = \"fa fa-comments\"></i> " . $topic->post_count . "</div>\n"
                    . "</div>\n"
                    . "</a>\n";
        }

        echo $html;
    }


    // ANNOUNCEMENT FUNCTION
   
    public function announcement() 
    {

       $input = $this->input;

        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        date_default_timezone_set('Asia/Manila');

        $data = array
        (
            'user_id' => $logged_user->user_id,
            'announcement' => utf8_encode(htmlspecialchars($input->post('announcement_content'))),
            'date' => date('Y-m-d H:i:s')
        );

        $this->db->insert("tbl_announcements", $data);

        redirect(base_url('home'));
    }
    



}
