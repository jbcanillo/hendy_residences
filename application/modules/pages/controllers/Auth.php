<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{

    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('pages/User');
        $this->data['site_name']        = config_item('site_name');       
        $this->data['css']              = config_item('css');
        $this->data['js']               = config_item('js');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('members');
        } else {
            redirect('log-in');
        }
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('members');
        }
       
        if ($this->input->method() !== 'post') {
            $this->data['page_name'] = 'Login';
            $this->data['page_content'] = $this->load->view('auth/login');
            $this->load->view('template', $this->data);
        } else {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('log-in');
            }

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User->authenticate($email, $password);
            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'role' => $user->role,
                    'logged_in' => TRUE
                ]);
                redirect('members');
            } else {
                $this->session->set_flashdata('error', 'Invalid email and/or password');
                redirect('log-in');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'email', 'name', 'role', 'logged_in']);
        $this->session->set_flashdata('success', 'You have been logged out!');
        redirect('log-in');
    }

    public function register()
    {

        if ($this->input->method() !== 'post') {
            $this->data['page_name'] = 'Registration';
            $this->data['page_content'] = $this->load->view('auth/registration');
            $this->load->view('template', $this->data);
        } else {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('register');
            }

            $email = $this->input->post('email');
            // Check if email already exists
            if ($this->User->email_exists($email)) {
                $this->session->set_flashdata('error', 'Email is already registered. Please use a different email.');
                redirect('register');
            }

            $user = [
                'email' => $email,
                'name' => $this->input->post('name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'phone' => $this->input->post('phone'),
                'role' => 'member'
            ];

            if ($this->User->create($user)) {
                $this->session->set_flashdata('success', 'Your registration has been successful. Please log-in now.');
                redirect('log-in');
            } else {
                $this->session->set_flashdata('error', 'Your registration was not successful. Please try again.');
                redirect('register');
            }
        }
    }
}
