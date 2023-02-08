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
            $view_page = 'admin/progressAdmin';
        } elseif ($currentUser['role_id'] == $this->m_auth->getIDRole('User')['id']) {
            $data['sub_title'] = 'Progress Buku Anda';
            $view_page = 'admin/progress';
        } else {
            redirect('dashboard');
        }

        $data['steps'] = $this->m_book->getStep()->result_array();


        viewAdmin($this, $view_page, $data);
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

    public function getAllBooks()
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_book->getBooks();
        // var_dump($tes);
        // die;
        $data = [];

        foreach (multi_unique_array($query->result_array(), 'book_id') as $r) {

            $data[] = array(
                'title' => $r['title'],
                'progress' => $r['status'],
                'naskah' => '<a href="' . base_url() . $r['naskah'] . '" type="button" target="_blank" class="btn btn-success btn-sm naskah">Naskah</a>',
                'cover' => '<button type="button" id="' . $r['id_b'] . '" class="btn btn-light btn-sm edtProgressCover"><i class="fa-solid fa-image"></i></button>',
                'action' => '
                <button type="button" id="' . $r['id_b'] . '" class="btn btn-info btn-sm detailBook"><i class="fa-solid fa-circle-info"></i></button>
                <button type="button" id="' . $r['id_b'] . '" class="btn btn-primary btn-sm edtProgress"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id_b'] . '" class="btn btn-danger btn-sm delBuku"><i class="fa-solid fa-trash"></i></button>'
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

    public function detailBook()
    {
        $id_book = $this->input->post()['id'];
        if ($id_book == null) {
            $result = [
                'success' => false,
                'message' => 'id buku tidak ada'
            ];
        } else {
            $proses = $this->m_book->getBooks($id_book)->row_array();
            $proses['prevCover'] = base_url() . $proses['cover'];
            $result = [
                'success' => true,
                'message' => $proses
            ];
        }
        echo json_encode($result);
    }

    public function detailBookAdmin()
    {
        $id_book = $this->input->post()['id'];
        if ($id_book == null) {
            $result = [
                'success' => false,
                'message' => 'id buku tidak ada'
            ];
        } else {
            $proses = $this->m_book->getBooks($id_book)->row_array();
            $result = [
                'success' => true,
                'message' => [
                    'id' => $proses['id_b'],
                    'catatan' => $proses['note_admin'],
                    'progress_id' => $proses['progress_id'],
                    'status_progres' => $proses['status_progres'],
                ]
            ];
        }
        echo json_encode($result);
    }

    public function aksiProgress()
    {
        $param = $this->input->post();
        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {
            $proses = $this->m_book->putBookProgress($param);
            if ($proses['success']) {
                $result = [
                    'success' => true,
                    'message' => 'Progres buku berhasil diubah'
                ];
            } else {
                $result = [
                    'success' => false,
                    'message' => 'Kesalahan database'
                ];
            }
        }
        echo json_encode($result);
    }

    public function aksiCover()
    {
        $param = $this->input->post();
        // print_r($param);
        // die;
        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {
            $ref_file = $this->m_book->getBooks($param['iB2'])->row_array()['cover'];
            if (!empty($_FILES['cover']['name'])) {

                $nama_file = $_FILES['cover']['name'];

                if (!in_array(substr($_FILES['cover']['name'], -4), [".jpg", "jpeg", ".png"])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'alert_type' => 'swal',
                            'message' => 'Tipe file yang dapat diupload adalah jpg, jpeg, png'
                        ]
                    ];
                    echo json_encode($array);
                    die;
                } else {
                    $root_folder = './public/uploads/cover';
                    // if (!file_exists('./' . $root_folder)) {
                    //     mkdir($root_folder, 775);
                    // }
                    $files = uploadImage2('cover', 'cover', 'cover_upload');
                    $param['url_cover'] = $files['file_name'];
                    // print_r($param);
                }
            } else {
                $param['url_cover'] = $ref_file;
            }
            // print_r($param);
            // die;

            $proses = $this->m_book->putBookCover($param);
            if ($proses['success']) {
                if (file_exists('./' . $ref_file) && !empty($_FILES['cover']['name']) && $ref_file != '') {
                    unlink(FCPATH . $ref_file);
                }
                $result = [
                    'success' => true,
                    'message' => 'Cover berhasil diubah'
                ];
            } else {
                $result = [
                    'success' => false,
                    'message' => 'Kesalahan database'
                ];
            }
        }
        echo json_encode($result);
    }

    public function deleteBuku()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $ref_file = $this->m_book->getBooks($this->input->post()['id'])->row_array()['cover'];
            $id_buku = $this->input->post()['id'];
            $proses = $this->m_book->deleteBook($id_buku, $ref_file);
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
