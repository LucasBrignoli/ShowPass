<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    public function addVenta($data) {
        $this->db->insert('ventas', $data);
    }

    public function getAllVentas() {
        return $this->db->get('ventas')->result();
    }
}
