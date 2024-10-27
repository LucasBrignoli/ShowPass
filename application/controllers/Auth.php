<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('user_model');
    }

    public function register_form()
    {
        $main_data =[
            'title' => 'Registro',
            'inner_view_path' => 'auth/register_form'
        ];

        $this->load->view('layouts/main', $main_data);
    }

    public function register()
    {
        $this->form_validation->set_rules('email', 'EMAIL', 'required');
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');
        $this->form_validation->set_rules('confirm-password', 'CONFIRM-PASSWORD', 'required|matches[password]');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');

        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            redirect('auth/register_form');
        }

        $user_data = [
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'customer'
        ];

        $this->user_model->add_new_user($user_data);

        $this->session->set_flashdata('success', 'El usuario ha sido registrado con éxito');
        redirect('auth/register_form');

    }
}