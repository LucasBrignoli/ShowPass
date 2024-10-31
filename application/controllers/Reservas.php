<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Reserva_model'); // Aseguramos que el modelo esté correctamente cargado
        // Verificar si el usuario está logueado y es admin
    }

    public function index() {
        // Traemos todas las reservas desde el modelo
        $reservas = $this->Reserva_model->getAllReserva();

        // Preparamos los datos para pasar a la vista
        $main_data = [
            'title' => 'Lista de reservas',
            'inner_view_path' => 'tickets/lista_reserva',
            'reservas' => $reservas
        ];

        // Cargamos la vista principal
        $this->load->view('layouts/main', $main_data);
    }
}