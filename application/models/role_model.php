<?php

class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_roles() {
        $query = $this->db->order_by('role_id', 'desc')->get('tbl_roles');
        return $query->result();
    }
}
