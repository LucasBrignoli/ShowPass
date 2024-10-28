<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ticket_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        
        // Definir las rutas correctamente
        $this->upload_path = FCPATH . 'assets/uploads/shows/';  // Ruta física
        $this->upload_url = 'assets/uploads/shows/';  // Ruta URL
        
        // Crear los directorios necesarios si no existen
        if (!is_dir(FCPATH . 'assets')) {
            mkdir(FCPATH . 'assets', 0777, true);
        }
        if (!is_dir(FCPATH . 'assets/uploads')) {
            mkdir(FCPATH . 'assets/uploads', 0777, true);
        }
        if (!is_dir($this->upload_path)) {
            mkdir($this->upload_path, 0777, true);
        }
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
		if($this->session->userdata('role') != 'admin'){
			show_error('No estas autorizado.');
		}
		$main_data = [
			'title' => 'Crear show',
			'inner_view_path' => 'tickets/create'
		];

		$this->load->view('layouts/main', $main_data);
	}
	// store -> procesa los datos del nuevo ticket -> proceso
	public function store() {
        if($this->session->userdata('role') != 'admin'){
            show_error('No estás autorizado.');
        }
    
        // Configuración del upload
        $config = [
            'upload_path' => $this->upload_path,
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => 2048,
            'encrypt_name' => TRUE
        ];
    
        // Inicializar la librería de upload con la nueva configuración
        $this->upload->initialize($config);
    
        // Variable para la URL de la imagen - Ajustamos la ruta por defecto
        $url = 'assets/uploads/shows/default.jpg';  // Asegúrate de que este archivo exista
    
        // Intentar subir la imagen
        if (!empty($_FILES['url']['name'])) {
            if ($this->upload->do_upload('url')) {
                $upload_data = $this->upload->data();
                $url = $this->upload_url . $upload_data['file_name'];
            } else {
                // Log del error para debugging
                log_message('error', 'Error de subida: ' . $this->upload->display_errors());
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('tickets/create');
                return;
            }
        }
    
        // Preparar los datos del ticket
        $ticket_data = [
            'name' => $this->input->post('name'),      
            'price' => $this->input->post('price'),
            'state' => $this->input->post('state'),
            'amount_available' => $this->input->post('amount_available'),
            'date' => $this->input->post('date'),
            'url' => $url
        ];
    
        // Guardar el ticket
        $this->ticket_model->add_new_ticket($ticket_data);
        $this->session->set_flashdata('success', 'Show guardado correctamente');
        redirect('tickets');
    }

    public function update($id) {
		if($this->session->userdata('role') != 'admin'){
			show_error('No estás autorizado.');
		}
	
		// Datos básicos del ticket
		$ticket_data = [
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'state' => $this->input->post('state'),
			'amount_available' => $this->input->post('amount_available'),
			'date' => $this->input->post('date')
		];
	
		// Solo procesar la imagen si se subió una nueva
		if(!empty($_FILES['url']['name'])) {
			$config = [
				'upload_path' => $this->upload_path,
				'allowed_types' => 'gif|jpg|jpeg|png',
				'max_size' => 2048,
				'encrypt_name' => TRUE
			];
	
			$this->upload->initialize($config);
	
			if($this->upload->do_upload('url')) {
				$old_ticket = $this->ticket_model->get_ticket_by_id($id);
				
				// Eliminar la imagen anterior si existe y no es la default
				if($old_ticket && $old_ticket->url !== 'default.jpg') {
					$old_file = FCPATH . $old_ticket->url;
					if(file_exists($old_file)) {
						unlink($old_file);
					}
				}
	
				$upload_data = $this->upload->data();
				$ticket_data['url'] = $this->upload_url . $upload_data['file_name'];
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('tickets/edit/' . $id);
				return;
			}
		}
		// Si no se subió una nueva imagen, mantener la actual
        
		$this->ticket_model->update_ticket_by_id($id, $ticket_data);
		$this->session->set_flashdata('success', 'Show actualizado correctamente');
		redirect('tickets');
	}

    public function edit($id) {
        if($this->session->userdata('role') != 'admin'){
            show_error('No estás autorizado.');
        }
    
        $ticket = $this->ticket_model->get_ticket_by_id($id);
        
        if($ticket == null){
            show_404();
        }
    
        $main_data = [
            'title' => 'Editar show #' . $id,
            'inner_view_path' => 'tickets/edit',
            'ticket' => $ticket
        ];
    
        $this->load->view('layouts/main', $main_data);
    }

    public function delete($id) {
        if($this->session->userdata('role') != 'admin'){
            show_error('No estás autorizado.');
        }

        $ticket = $this->ticket_model->get_ticket_by_id($id);
        
        if($ticket) {
            if($ticket->url !== 'default.jpg') {
                $file_path = FCPATH . $ticket->url;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $this->ticket_model->delete_ticket_by_id($id);
            $this->session->set_flashdata('success', 'Show eliminado correctamente');
        } else {
            $this->session->set_flashdata('error', 'El show no existe');
        }

        redirect('tickets');
    }
}