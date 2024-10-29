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

    public function update_ticket_by_id($id,$ticket_data){
        $this->db->update('ticket', $ticket_data, ['idTicket' => $id]);
    } 

    public function delete_ticket_by_id($id){
        $this->db->delete('ticket', ['idTicket' => $id]);
    }

    public function updateTicketAmount($idTicket, $newAmount) {
        $this->db->where('idTicket', $idTicket);
        $this->db->update('ticket', ['amount_available' => $newAmount]);
    }

}