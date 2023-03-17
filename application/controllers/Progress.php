<?php

class Progress extends CI_Controller
{
    private $success = '2';
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Book', 'm_book');
        $this->load->model('M_Paket', 'm_paket');


        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        if ($this->m_auth->cekUserAktif($idUserLogin) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        // $user = $this->m_auth->getCurrentUser();
        // // print_r($user['user_group_id']);exit;
        // // if ($user['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
        // //     redirect('dashboard');
        // // }
    }

    // Halaman
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
            $data['idPJ'] = $this->m_book->getContributor('PJ')->row_array()['id'];
            $data['lastProgress'] = $this->m_book->getLastProgress()['id'];
            $data['success'] = $this->success;
            $view_page = 'admin/progress';
        } else {
            redirect('dashboard');
        }

        $data['steps'] = $this->m_book->getStep()->result_array();


        viewAdmin($this, $view_page, $data);
    }

    public function EditBuku()
    {
        $user = $this->m_auth->getCurrentUser();
        if ($user['role_id'] != $this->m_auth->getIDRole('User')['id']) {
            redirect('progress');
        }
        $param = $this->input->post();
        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];


        if ($param = array()) {
            redirect('progress');
        } elseif ($this->m_book->cekContributor($this->input->post()['id'], $idUserLogin, $this->m_book->getContributor('PJ')->row_array()['id']) == 0) {
            // $this->session->set_flashdata('error', 'Role anda tidak boleh akses');
            redirect('progress');
        } else {
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
            $data['sub_title'] = 'List Progress Buku';
            $data['jk'] = $this->m_paket->getJenisKertas()->result_array();

            // data sidebar & navbar || end

            $id_buku = $this->input->post()['id'];
            $data['id_buku'] = $id_buku;
            $data['buku'] = $this->m_book->getBooks($id_buku)->row_array();
            $id_paket = $this->m_paket->getPaketUsePaketHarga($data['buku']['paket_harga_id'])['paket_id'];
            $data['harga_paket'] = $this->m_paket->getHargaPaket($id_paket)->result_array();
            $data['kertas'] = $this->m_paket->getUkuranKertas()->result_array();

            $contributor = $this->m_book->getContributor()->result_array();
            foreach ($contributor as $c) {
                $data[str_replace(' ', '', $c['role_name'])] = $this->m_book->getContributorBook($id_buku, $c['id']);
            }

            viewAdmin($this, 'admin/editBuku', $data);
            // $this->load->view('admin/editBuku', $data);
        }
    }

    // CRUD
    public function getBooks()
    {
        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        $proses = $this->m_book->getBooks(null, $idUserLogin)->result_array();

        $result = multi_unique_array($proses, 'book_id');
        $result = [
            'success' => true,
            'message' => $result
        ];
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

        // <a href="' . base_url() . $r['naskah'] . '" type="button" target="_blank" class="btn btn-success btn-sm naskah">Naskah</a>

        foreach (multi_unique_array($query->result_array(), 'book_id') as $r) {

            $data[] = array(
                'title' => $r['title'],
                'progress' => $r['status'],
                'butuh' => $this->statusColorButuh($r['is_cover'], $r['is_kdt']),
                'upload_at' => date('j M Y', strtotime($r['b_created_at'])),
                'update_at' => ($r['update_at'] != null) ? date('j M Y', strtotime($r['b_update_at'])) : '-',
                'naskah' => '<button type="button" id="' . $r['id_b'] . '" class="btn btn-success btn-sm edtProgressNaskah">Naskah</button>',
                'cover' => '<button type="button" id="' . $r['id_b'] . '" class="btn btn-light btn-sm edtProgressCover"><i class="fa-solid fa-image"></i></button>',
                'action' => '
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
            $proses['prevNaskah'] = base_url() . $proses['naskah'];
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
                    'isbn' => $proses['isbn'],
                ]
            ];
        }
        echo json_encode($result);
    }

    public function aksiEditBuku()
    {
        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        $param = $this->input->post();


        $param['user_id'] = $idUserLogin;

        $rules = [
            [
                'field' => 'title',
                'label' => 'Judul',
                'rules' => 'required|max_length[100]|min_length[1]'
            ],
            [
                'field' => 'desc',
                'label' => 'Deskripsi',
                'rules' => 'required|min_length[50]'
            ],


        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'title_error' => strip_tags(form_error('title')),
                    'desc_error' => strip_tags(form_error('desc')),
                ]
            ];
        } elseif (trim($param['id_kertas']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'kertas_error' => 'Ukuran kertas belum dipilih'

                ]
            ];
        } elseif (trim($param['id_jk']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'jk_error' => 'Jenis kertas belum dipilih'

                ]
            ];
        } elseif (trim($param['is_cover']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'is_cover_error' => 'Mohon memilih salah satu'

                ]
            ];
        } elseif ($param['is_cover'] == '1' && trim($param['pembaca']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'pembaca_error' => 'Segmen pembaca tidak boleh kosong'

                ]
            ];
        } elseif ($param['is_cover'] == '1' && trim($param['catatCover']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'catat_cover_error' => 'Catatan permintaan cover tidak boleh kosong'
                ]
            ];
        } elseif ($this->cekEmailAll($param['writer'], $param['editor'], $param['designer'], $param['tata_letak']) == false) {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'swal',
                    'message' => 'Terdapat email penulis atau kontributor yang tidak diketahui'
                ]
            ];
        } elseif (trim($param['is_kdt']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'is_kdt_error' => 'Kebutuhan KDT belum dipilih'

                ]
            ];
        } else {
            $ref_file = $this->m_book->getBooks($param['id_book'])->row_array();
            // Upload cover
            if (!empty($_FILES['cover']['name'])) {

                $nama_file = $_FILES['cover']['name'];

                if (!in_array(substr($_FILES['cover']['name'], -4), [".jpg", "jpeg", ".png"])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'upload_cover_error' => 'Tipe file yang dapat diupload adalah jpg, jpeg, png'
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
                $param['url_cover'] = $ref_file['cover'];
            }

            // Upload berkas
            if (!empty($_FILES['berkas']['name'])) {

                $nama_file = $_FILES['berkas']['name'];

                if (!in_array(substr($_FILES['berkas']['name'], -4), [".pdf", ".doc", "docx", '.ppt', 'pptx'])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'alert_type' => 'classic',
                            'berkas_error' => 'Tipe file yang dapat diupload adalah pdf, doc, docx, ppt, pptx'
                        ]
                    ];
                    echo json_encode($array);
                    die;
                } else {
                    $root_folder = './public/uploads/berkas';
                    // if (!file_exists('./' . $root_folder)) {
                    //     mkdir($root_folder, 775);
                    // }
                    $files = uploadBerkas('berkas', 'berkas', 'berkas_upload', null, 'pdf|doc|docx|ppt|pptx');
                    $param['url_berkas'] = $files['file_name'];
                    // print_r($param);
                }
            } else {
                $param['url_berkas'] = $ref_file['naskah'];
            }

            // print_r($param);
            // die;
            $proses =  $this->m_book->putBookAll($param);
            if ($proses['success']) {
                $message = [
                    'success' => true,
                    'message' => [
                        'icon' => 'success',
                        'title' => 'Update buku berhasil',
                        'text' => 'Pantau terus pemrosesan buku anda'
                    ],

                ];
            } else {
                $message = [
                    'success' => false,
                    'message' => [
                        'alert_type' => 'swal',
                        'message' => 'Proses gagal, ulangi dalam beberapa saat kemudian'
                    ]
                ];
            }
        }
        echo json_encode($message);
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

    public function aksiNaskah()
    {
        $param = $this->input->post();
        // print_r($_FILES);
        // die;
        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {
            $ref_file = $this->m_book->getBooks($param['iB3'])->row_array()['naskah'];
            if (!empty($_FILES['naskah']['name'])) {

                $nama_file = $_FILES['naskah']['name'];

                if (!in_array(substr($_FILES['naskah']['name'], -4), [".pdf", ".doc", "docx", '.ppt', 'pptx'])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'alert_type' => 'swal',
                            'message' => 'Tipe file yang dapat diupload adalah pdf, doc, docx, ppt, pptx'
                        ]
                    ];
                    echo json_encode($array);
                    die;
                } else {
                    $root_folder = './public/uploads/berkas';
                    // if (!file_exists('./' . $root_folder)) {
                    //     mkdir($root_folder, 775);
                    // }
                    $files = uploadBerkas('naskah', 'berkas', 'berkas_upload', null, 'pdf|doc|docx|ppt|pptx');
                    $param['url_naskah'] = $files['file_name'];
                    // print_r($param);
                }
            } else {
                $param['url_naskah'] = $ref_file;
            }

            $proses = $this->m_book->putBookNaskah($param);
            if ($proses['success']) {
                if (file_exists('./' . $ref_file) && !empty($_FILES['naskah']['name']) && $ref_file != '') {
                    unlink(FCPATH . $ref_file);
                }
                $result = [
                    'success' => true,
                    'message' => 'Naskah berhasil diubah'
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

    private function statusColorButuh($status_cover, $status_kdt)
    {
        if ($status_cover == 0) {
            $badge_cover = '';
        } else {
            $badge_cover = '<span class="badge bg-danger m-1">Cover</span>';
        }

        if ($status_kdt == 0) {
            $badge_kdt = '';
        } else {
            $badge_kdt = '<span class="badge bg-danger m-1">KDT</span>';
        }

        return $badge_cover . $badge_kdt;
    }

    private function cekEmailAll($arrPenulis, $arrEditor, $arrDesigner, $arrLayout)
    {
        $result = true;
        foreach ($arrPenulis as $penulis) {
            $proses = $this->m_auth->cekEmail($penulis);
            if ($proses == 0) {
                $result = false;
            }
        }
        foreach ($arrEditor as $editor) {
            $proses = $this->m_auth->cekEmail($editor);
            if ($proses == 0) {
                $result = false;
            }
        }
        foreach ($arrDesigner as $designer) {
            $proses = $this->m_auth->cekEmail($designer);
            if ($proses == 0) {
                $result = false;
            }
        }
        foreach ($arrLayout as $layout) {
            $proses = $this->m_auth->cekEmail($layout);
            if ($proses == 0) {
                $result = false;
            }
        }

        return $result;
    }
}
