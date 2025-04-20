<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members extends MX_Controller
{

    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('pages/User');
        $this->data['site_name']        = config_item('site_name');
        $this->data['css']              = config_item('css');
        $this->data['js']               = config_item('js');
    }

    // List all members
    public function index()
    {
        $this->data['members'] = $this->User->read();
        $this->data['page_name'] = 'Members';
        $this->data['page_content'] = $this->load->view('members/list', FALSE);
        $this->load->view('template', $this->data);
    }

    // Add a new member
    public function add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $password = $this->input->post('password');
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $userData = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => $hashedPassword,
                ];
                $this->User->create($userData);
                redirect('members');
            }
        }
        $this->load->view('members/add');
    }

    // Edit a member
    public function edit($id)
    {
        $this->data['member'] = $this->User->get_user_by_id($id);
        if (empty($this->data['member'])) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $userData = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                ];
                $this->User->update($id, $userData);
                redirect('members');
            }
        }
        $this->load->view('members/form', $this->data);
    }

    // Delete a member
    public function delete($id)
    {
        $this->User->delete($id);
        redirect('members');
    }
}
