<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    private $table = 'users'; // Table name

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Authenticate user upon login
    public function authenticate($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get_where($this->table, ['email' => $email]);
        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
            return $user;
            }
        }
        return false;
    }

    // Create a new user
    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    // Read user(s)
    public function read($id = null) {
        if ($id === null) {
            return $this->db->get($this->table)->result_array(); // Get all users
        } else {
            return $this->db->get_where($this->table, ['id' => $id])->row_array(); // Get user by ID
        }
    }

    // Update user
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete user
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Check if email exists
    public function email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }
}