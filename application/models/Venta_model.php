<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Aseguramos la carga de la base de datos
    }

    public function addVenta($data) {
        $this->db->insert('ventas', $data);
    }

    public function get_ventas_by_id($id) {
        $query = $this->db->get_where('ventas', ['idVentas' => $id]);
        return $query->row();
    }

    public function getAllVentas() {
        return $this->db->get('ventas')->result(); // Devolvemos todas las ventas
    }
}