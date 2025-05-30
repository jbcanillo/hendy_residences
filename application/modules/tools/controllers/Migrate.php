<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "✅ Migration successful.\n";
        }
    }
}
