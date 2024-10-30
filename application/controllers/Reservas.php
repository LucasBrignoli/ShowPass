<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reserva_model'); // Aseguramos que el modelo esté correctamente cargado
        // Verificar si el usuario está logueado y es admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login_form');
        }
    }

    public function index() {
        // Traemos todas las ventas desde el modelo
        $ventas = $this->Venta_model->getAllVentas();

        // Preparamos los datos para pasar a la vista
        $main_data = [
            'title' => 'Lista de ventas',
            'inner_view_path' => 'tickets/historial',
            'ventas' => $ventas
        ];

        // Cargamos la vista principal
        $this->load->view('layouts/main', $main_data);
    }

    public function create() {
        // Preparamos los datos para la nueva venta
        $data = array(
            'ticket_id' => $this->input->post('ticket_id'),
            'user_id' => $this->session->userdata('user_id'),
            'cantidad' => $this->input->post('cantidad'),
            'total' => $this->input->post('total'),
            'fecha' => date('Y-m-d H:i:s')
        );

        // Agregamos la venta a la base de datos
        $this->Reserva_model->addReserva($data);
        redirect('reservas');
    }
}
