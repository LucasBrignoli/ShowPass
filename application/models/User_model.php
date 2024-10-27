<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add_new_user($user_data){
        $this->db->insert('users', $user_data);
    }
}