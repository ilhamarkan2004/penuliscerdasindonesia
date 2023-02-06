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
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->helper('c_helper');

        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }
    }

    public function index()
    {
        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);


        $data['url'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['sub_title'] = 'Selamat Datang';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end
        viewAdmin($this, 'admin/dashboard', $data);
    }
}
