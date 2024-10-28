<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('user_model');
    }

    public function register_form()
    {
        if($this->session->userdata('logged_in')){
            //echo "Ya iniciaste sesion";
            show_error('Ya iniciaste sesion');
        }

        $main_data =[
            'title' => 'Registro',
            'inner_view_path' => 'auth/register_form'
        ];

        $this->load->view('layouts/main', $main_data);
    }

    public function register()
{
    if($this->session->userdata('logged_in')){
        //echo "Ya iniciaste sesion";
        show_error('Ya iniciaste sesion');
    }

    $this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email');
    $this->form_validation->set_rules('password', 'PASSWORD', 'required');
    $this->form_validation->set_rules('confirm-password', 'CONFIRM-PASSWORD', 'required|matches[password]');

    $this->form_validation->set_message('required', 'El campo %s es obligatorio.');

    if ($this->form_validation->run() == false) {
        $this->session->set_flashdata('errors', $this->form_validation->error_array());
        redirect('auth/register_form');
    }

    // Verificar si el email ya existe en la base de datos
    $email = $this->input->post('email');
    if ($this->user_model->get_user_by_email($email)) {
        // Si el correo ya existe, establecer mensaje de error y redirigir
        $this->session->set_flashdata('errors', ['email_exists' => 'Ya existe una cuenta con ese correo electrónico.']);
        redirect('auth/register_form');
    }

    // Si el email no existe, proceder con el registro
    $user_data = [
        'email' => $email,
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role' => 'customer'
    ];

    $this->user_model->add_new_user($user_data);

    $this->session->set_flashdata('success', 'El usuario ha sido registrado con éxito');
    redirect('auth/register_form');
}


    public function login_form()
    {
        if($this->session->userdata('logged_in')){
            //echo "Ya iniciaste sesion";
            show_error('Ya iniciaste sesion');
        }

        $main_data =[
            'title' => 'Iniciar sesion',
            'inner_view_path' => 'auth/login_form'
        ];

        $this->load->view('layouts/main', $main_data);
    }
    public function login()
    {
        if($this->session->userdata('logged_in')){
            //echo "Ya iniciaste sesion";
            show_error('Ya iniciaste sesion');
        }

        $this->form_validation->set_rules('email', 'EMAIL', 'required');
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');

        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            redirect('auth/login_form');
        }
        $user = $this->user_model->get_user_by_email($this->input->post('email'));

        if($user != null && password_verify($this->input->post('password'), $user->password)){
            $this->session->set_userdata('email', $user->email);
            $this->session->set_userdata('role', $user->role);
            $this->session->set_userdata('logged_in', true);
            redirect('tickets');
        }else{
            $this->session->set_flashdata('errors', ['login_error' => 'Las credenciales son incorrectas.']);
            redirect('auth/login_form');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login_form');
    }
}