<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_Tickets()
    {
        $query = $this->db->get('ticket');
        return $query->result();
    }

    public function get_ticket_by_id($id)
    {
        $query = $this->db->get_where('ticket',['idTicket' => $id]);
        return $query->row();
    }

    public function add_new_ticket($ticket_data){
        $this->db->insert('ticket', $ticket_data);
    }
}