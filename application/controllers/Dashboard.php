<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Book', 'm_book');
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

        if ($currentUser['role_id'] == $data['idPeserta']) {
            $data['cards'] =
                [
                    [
                        'isi' => number_format($currentUser['point'], 0, '', '.') . ' point',
                        'titleCard' => 'Jumlah point anda',
                        'icon' => 'fa-solid fa-rupiah-sign',
                        'bg-color' => '#92D248'
                    ],
                    [
                        'isi' => $this->m_book->getBooks(null, $this->session->userdata('id_user'))->num_rows() . ' buku',
                        'titleCard' => 'Jumlah buku terupload',
                        'icon' => 'fa-solid fa-book',
                        'bg-color' => '#3F7856'
                    ]
                ];
        } elseif ($currentUser['role_id'] == $data['idAdmin']) {
            $data['cards'] =
                [
                    [
                        'isi' => $this->m_auth->getUsers()->num_rows() . ' orang',
                        'titleCard' => 'Jumlah User',
                        'icon' => 'fa-solid fa-users',
                        'bg-color' => '#92D248'
                    ],
                    [
                        'isi' => $this->m_book->getBooks()->num_rows() . ' buku',
                        'titleCard' => 'Jumlah buku',
                        'icon' => 'fa-solid fa-book',
                        'bg-color' => '#3F7856'
                    ]
                ];
        }

        // data sidebar & navbar || end
        // print_r($data['cards'][0]);
        // die;
        viewAdmin($this, 'admin/dashboard', $data);
    }
}
