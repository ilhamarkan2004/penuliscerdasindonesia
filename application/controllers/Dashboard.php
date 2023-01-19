<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        // $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->helper('c_helper');

        if (!$this->session->has_userdata('id_user')) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        viewAdmin($this, 'admin/dashboard', $data);
    }
}