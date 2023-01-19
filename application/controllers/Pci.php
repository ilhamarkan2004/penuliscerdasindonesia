<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pci extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        // $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->helper('c_helper');
    }

    public function index(){
        $data = '';
        viewUser($this, 'user/pages/home', $data);
    }
}