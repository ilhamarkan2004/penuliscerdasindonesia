<?php

class Sell extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Book', 'm_book');


        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        if ($this->m_auth->cekUserAktif($idUserLogin) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        // print_r($user['user_group_id']);exit;
        if ($user['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
            redirect('dashboard');
        }
    }

    // HALAMAN
    public function index()
    {
        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Jual buku';
        $data['url'] = 'sell';
        $data['sub_title'] = 'Daftar Buku yang Dipublikasi';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end

        $data['buku'] = $this->m_book->getBookSellable()->result_array();
        $data['category'] = $this->m_book->getBookCategory();
        $data['language'] = $this->m_book->getBookLanguage();
        $data['publisher'] = $this->m_book->getBookPublisher();

        viewAdmin($this, 'admin/sellAdmin', $data);
    }

    //Datatables
    public function getAllSell()
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_book->getSellBooks();
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $key => $r) {

            $data[] = array(
                'no' => $key + 1,
                'title' => $r['title'],
                'publisher' => $r['publisher'],
                'price' => 'Rp ' . number_format($r['sell_price'], 0, '', '.'),
                'publish_at' => $r['publish_at'],
                'update_at' => $r['update_at_bs'],
                'action' => '
                <button type="button" id="' . $r['id_bs'] . '" class="btn btn-primary btn-sm edtSell"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id_bs'] . '" class="btn btn-danger btn-sm delSell"><i class="fa-solid fa-trash"></i></button>'
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

    public function detailSell()
    {
        $param = $this->input->post();
        $id_sell = $param['id'];
        if ($id_sell == null) {
            $result = [
                'success' => false,
                'message' => 'id tidak ada'
            ];
        } else {
            $proses = $this->m_book->getSellBooks($id_sell)->row_array();
            // print_r($proses);
            // die;
            $result = [
                'success' => true,
                'message' => $proses
            ];
        }
        echo json_encode($result);
    }

    public function aksiSell()
    {
        $param = $this->input->post();


        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {

            if (trim($param['book']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'book_err' => 'Pilihan buku belum dipilih'
                    ]
                ];
            } elseif ($this->m_book->cekBookSell($param['book']) != 0 && $param['iS'] == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'book_err' => 'Buku sudah pernah dipublish'
                    ]
                ];
            } elseif (trim($param['category']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'category_err' => 'Pilihan kategori belum dipilih'
                    ]
                ];
            } elseif (trim($param['lang']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'lang_err' => 'Pilihan bahasa belum dipilih'
                    ]
                ];
            } elseif (trim($param['pub']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'pub_err' => 'Pilihan publisher belum dipilih'
                    ]
                ];
            } elseif (trim($param['num_page']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'num_page_err' => 'Jumlah halaman tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['price']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'price_err' => 'Jumlah halaman tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['num_page']) < 1) {
                $result = [
                    'success' => false,
                    'message' => [
                        'num_page_err' => 'Jumlah halaman minimal 1 halaman'
                    ]
                ];
            } elseif (trim($param['price']) < 0) {
                $result = [
                    'success' => false,
                    'message' => [
                        'price_err' => 'Harga tidak boleh dibawah 0 rupiah'
                    ]
                ];
            } elseif (trim($this->m_book->getISBN($param['book'])['isbn']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'book_err' => 'Buku masih belum punya ISBN'
                    ]
                ];
            } else {
                if ($param['iS'] == '') {

                    $proses = $this->m_book->postSell($param);
                    if ($proses['success']) {
                        $result = [
                            'success' => true,
                            'message' => 'Buku yang dijual bertambah !'
                        ];
                    } else {
                        $result = [
                            'success' => false,
                            'message' => 'Kesalahan database'
                        ];
                    }
                } else {
                    $proses = $this->m_book->putSell($param);
                    if ($proses['success']) {
                        $result = [
                            'success' => true,
                            'message' => 'Data buku dijual berhasil diubah'
                        ];
                    } else {
                        $result = [
                            'success' => false,
                            'message' => 'Kesalahan database'
                        ];
                    }
                }
            }
        }
        echo json_encode($result);
    }

    public function deleteSell()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {

            $id_sell = $this->input->post()['id'];
            $proses = $this->m_book->deleteSell($id_sell);
            if ($proses['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil hapus data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        echo json_encode($array);
    }
}
