<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Venta_model');
        // Verificar si el usuario está logueado y es admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login_form');
        }
    }

    public function index() {
        $data['ventas'] = $this->Venta_model->getAllVentas();
        $this->load->view('templates/header');
        $this->load->view('ventas/index', $data);
        $this->load->view('templates/footer');
    }

    // Nuevo método para cargar la vista historial
    public function historial() {
        $data['ventas'] = $this->Venta_model->getAllVentas(); // Obtenemos todas las ventas
        $this->load->view('templates/header');
        $this->load->view('tickets/historial', $data); // Cargamos la vista historial
        $this->load->view('templates/footer');
    }

    public function create() {
        $data = array(
            'ticket_id' => $this->input->post('ticket_id'),
            'user_id' => $this->session->userdata('user_id'),
            'cantidad' => $this->input->post('cantidad'),
            'total' => $this->input->post('total'),
            'fecha' => date('Y-m-d H:i:s')
        );

        $this->Venta_model->addVenta($data);
        redirect('ventas');
    }
}
