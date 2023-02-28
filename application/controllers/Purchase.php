<?php

class Purchase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Book', 'm_book');
        $this->load->model('M_Purchase', 'm_purchase');


        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }
    }

    // Halaman
    public function index()
    {
        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Penjualan Buku';
        $data['url'] = 'purchase';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end

        if ($currentUser['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
            $data['sub_title'] = 'Seluruh penjualan buku';
        } elseif ($currentUser['role_id'] == $this->m_auth->getIDRole('User')['id']) {
            $data['sub_title'] = 'Penjualan buku anda';
        } else {
            redirect('dashboard');
        }

        viewAdmin($this, 'admin/purchase', $data);
    }

    public function coba()
    {
        print_r($this->m_purchase->getBookPublish('5')->result_array());
        die;
    }

    public function getPurchase()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $currentUser = $this->m_auth->getCurrentUser();
        // $query = $this->m_book->getBooks();
        if ($currentUser['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
            $query = $this->m_purchase->getBookPublish();
        } else {
            $query = $this->m_purchase->getBookPublish($this->session->userdata('id_user'));
        }
        $data = [];

        foreach (multi_unique_array($query->result_array(), 'book_id') as $key => $r) {

            $pubish_at = $this->m_purchase->getPublishBook($r['id_b'])['publish_at'];
            $terjual = $this->m_purchase->getCountPurhase($r['id_b']);

            $data[] = array(
                'no' => $key + 1,
                'judul' => $r['title'],
                'publish_at' => $pubish_at,
                'terjual' => $terjual,
                'action' => '<button type="button" id="' . $r['id_b'] . '" class="btn btn-secondary btn-sm showGraph"><i class="fa-solid fa-chart-simple"></i></button>'
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
    }
}
