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
        $list['members'] = $this->User->read();
        $this->data['page_name'] = 'Members';
        $this->data['page_content'] = $this->load->view('members/list', $list, FALSE);
        $this->load->view('template', $this->data);
    }

    // Add a new member
    public function add()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('members/add');
            } else {
                $email = $this->input->post('email');
                // Check if email already exists
                if ($this->User->email_exists($email)) {
                    $this->session->set_flashdata('error', 'Email is already registered. Please use a different email.');
                    redirect('members/add');
                }
                $user = [
                    'email' => $email,
                    'name' => $this->input->post('name'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'phone' => $this->input->post('phone'),
                    'role' => 'member'
                ];

                if ($this->User->create($user)) {
                    $this->session->set_flashdata('success', 'Member successfully registered.');
                } else {
                    $this->session->set_flashdata('error', 'Member registration failed. Please try again.');
                }
                redirect('members');
            }
        } else {
            $this->data['page_name'] = 'Add Member';
            $this->data['page_content'] = $this->load->view('members/form');
            $this->load->view('template', $this->data);
        }
    }

    // Edit a member
    public function edit($id)
    {
        $this->data['member'] = $this->User->read($id);
        if (empty($this->data['member'])) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'regex_match[/^[0-9]{10}$/]');
            
            // Password is optional, only validate if provided
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
            }
           
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('members/' . $id);
            } else {
                $email = $this->input->post('email');
                // Check if email already exists but not for the current user
                if ($this->data['member']['email'] != $email && $this->User->email_exists($email)) {
                    $this->session->set_flashdata('error', 'Email is already registered. Please use a different email.');
                    redirect('members/' . $id);
                }
                $user = [
                    'email' => $email,
                    'name' => $this->input->post('name'),
                    'password' => $this->input->post('password') ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->data['member']['password'], // Keep old password if not changed
                    'role' => $this->data['member']['role'],
                    'phone' => $this->input->post('phone')
                ];
                if ($this->User->update($id, $user)) {
                    $this->session->set_flashdata('success', 'Member successfully updated.');
                } else {
                    $this->session->set_flashdata('error', 'Member update failed. Please try again.');
                }
                redirect('members');
            }
        }
        $this->data['page_name'] = 'Edit Member';
        $this->data['page_content'] = $this->load->view('members/form', $this->data);
        $this->load->view('template', $this->data);
    }

    // Delete a member
    public function delete($id)
    {
        if (!is_numeric($id)) {
            show_404();
        }
        if ($this->User->delete($id)) {
            $this->session->set_flashdata('success', 'Member successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'Member deletion failed. Please try again.');
        }
        redirect('members');
    }
}
