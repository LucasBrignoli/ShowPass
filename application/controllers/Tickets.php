<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('ticket_model');
	}


	// index -> muestra la lista de tickets -> vista
	public function index(){
		$main_data = [
			'title' => 'Lista de shows',
			'inner_view_path' => 'tickets/index',
			'tickets' => $this->ticket_model->get_all_Tickets()
		];

		$this->load->view('layouts/main', $main_data);
	}
	// show -> muestra un solo ticket -> vista
	// products/show/$id
	public function show($id){

		$ticket = $this->ticket_model->get_ticket_by_id($id);

		if($ticket == null){
			show_404();
		}

		$main_data = [
			'title' => 'Show #'. $id,
			'inner_view_path' => 'tickets/show',
			'ticket' => $ticket
		];

		$this->load->view('layouts/main', $main_data);
	}

	// create -> entrada de datos para un nuevo ticket (form) -> vista
	public function create(){
		$main_data = [
			'title' => 'Crear show',
			'inner_view_path' => 'tickets/create'
		];

		$this->load->view('layouts/main', $main_data);
	}
	// store -> procesa los datos del nuevo ticket -> proceso
	public function store(){
		$ticket_data = [
			'name' => $this->input->post('name'),      
			'price' => $this->input->post('price'),
			'state' => $this->input->post('state'),
			'amount_available' => $this->input->post('amount_available'),
			'date' => $this->input->post('date')
		];
	
		$this->ticket_model->add_new_ticket($ticket_data);
		redirect('tickets');
	}
	
	// edit -> entrada de datos para actualizar un ticket existente (form) -> vista
	public function edit($id){
		
		$ticket = $this->ticket_model->get_ticket_by_id($id);

		if($ticket == null){
			show_404();
		}

		$main_data = [
			'title' => 'Editar show #'. $id,
			'inner_view_path' => 'tickets/edit',
			'ticket' => $ticket
		];

		$this->load->view('layouts/main', $main_data);
	}
	// update -> procesa los nuevos datos del ticket editado -> proceso
	public function update($id){
		$ticket_data = [
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'state' => $this->input->post('state'),
			'amount_available' => $this->input->post('amount_available'),
			'date' => $this->input->post('date'),
			'url' => $this->input->post('url')
		];
			$this->ticket_model->update_ticket_by_id($id,$ticket_data);
			redirect('tickets');
	}
	// delete -> borra un ticket -> proceso
	public function delete($id){
	}
}
