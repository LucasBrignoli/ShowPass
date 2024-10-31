<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Aseguramos la carga de la base de datos
    }

    public function addReserva($data) {
        $this->db->insert('reservas', $data);
    }

    public function get_reservas_by_id($id) {
        $query = $this->db->get_where('reservas', ['idReservas' => $id]);
        return $query->row();
    }

    public function getAllReserva() {
        return $this->db->get('reservas')->result(); // Devolvemos todas las ventas
    }
}