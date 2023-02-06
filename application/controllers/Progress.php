<?php

class Progress extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Book', 'm_book');


        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        // $user = $this->m_auth->getCurrentUser();
        // // print_r($user['user_group_id']);exit;
        // // if ($user['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
        // //     redirect('dashboard');
        // // }
    }

    public function index()
    {

        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Progress Buku';
        $data['url'] = 'progress';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end

        if ($currentUser['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
            $data['sub_title'] = 'List Progress Buku';
        } elseif ($currentUser['role_id'] == $this->m_auth->getIDRole('User')['id']) {
            $data['sub_title'] = 'Progress Buku Anda';
        } else {
            redirect('dashboard');
        }

        $data['steps'] = $this->m_book->getStep()->result_array();

        viewAdmin($this, 'admin/progress', $data);
    }

    public function getBooks()
    {
        $proses = $this->m_book->getBooks(null, $this->session->userdata('id_user'))->result_array();

        $result = multi_unique_array($proses, 'book_id');
        $result = [
            'success' => true,
            'message' => $result
        ];
        // print_r($result);
        // die;
        echo json_encode($result);
    }
}
