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

    // HALAMAN
    public function index()
    {
        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];


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
                        'titleCard' => 'Jumlah point',
                        'icon' => 'fa-solid fa-rupiah-sign',
                        'bg-color' => '#92D248'
                    ],
                    [
                        'isi' => count(multi_unique_array($this->m_book->getBooks(null, $idUserLogin)->result_array(), 'book_id')) . ' buku',
                        'titleCard' => 'Jumlah buku terupload',
                        'icon' => 'fa-solid fa-book',
                        'bg-color' => '#3F7856'
                    ],
                    [
                        'isi' => $currentUser['referral_code'],
                        'titleCard' => 'Kode referral',
                        'icon' => 'fa-solid fa-id-badge',
                        'bg-color' => '#6AA5A9'
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
                        'isi' => count(multi_unique_array($this->m_book->getBooks()->result_array(), 'book_id')) . ' buku',
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

    public function linkisbn()
    {
        $currentUser = $this->m_auth->getCurrentUser();
        if ($currentUser['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
            redirect('dashboard');
        }
        //data sidebar & navbar || start
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Buku ISBN';
        $data['sub_title'] = 'List link deskripsi buku siap pengajuan ISBN';
        $data['url'] = 'dashboard/linkisbn';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end
        viewAdmin($this, 'admin/linkisbn', $data);
    }

    //halaman end

    public function aksiProfile()
    {
        $param = $this->input->post();
        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {
            $no_hp = '62' . $param['telp'];

            if (trim($param['name']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'name_err' => 'Nama tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['desc']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'desc_err' => 'Deskripsi tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['telp']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'telp_err' => 'Nomor telepon tidak boleh kosong'
                    ]
                ];
            } elseif ($this->m_auth->cekTelp($no_hp) && $this->m_auth->getCurrentUser()['phone'] != $no_hp) {
                $result = [
                    'success' => false,
                    'message' => [
                        'telp_err' => 'Nomor telepon telah digunakan',
                    ]
                ];
            } elseif (strlen($no_hp) > 13 || strlen($no_hp) < 8) {
                $result = [
                    'success' => false,
                    'message' => [
                        'telp_err' => 'Nomor telepon maksimal 13 karakter dan minimal 8 karakter',
                    ]
                ];
            } else {

                $ref_file = $this->m_auth->getCurrentUser()['img_profile'];
                if (!empty($_FILES['img_profile']['name'])) {

                    $nama_file = $_FILES['img_profile']['name'];

                    if (!in_array(substr($_FILES['img_profile']['name'], -4), [".jpg", "jpeg", ".png"])) {
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
                        $root_folder = './public/uploads/profile';
                        // if (!file_exists('./' . $root_folder)) {
                        //     mkdir($root_folder, 775);
                        // }
                        $files = uploadImage2('img_profile', 'profile', 'profile_upload');
                        $param['url_img'] = $files['file_name'];
                        // print_r($param);
                    }
                } else {
                    $param['url_img'] = $ref_file;
                }

                $param['telp'] = $no_hp;

                $proses = $this->m_auth->putProfile($param);
                if ($proses['success']) {
                    if (file_exists('./' . $ref_file) && !empty($_FILES['img_profile']['name']) && $ref_file != '') {
                        unlink(FCPATH . $ref_file);
                    }
                    $result = [
                        'success' => true,
                        'message' => 'Profil anda berhasil diubah'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => 'Kesalahan database'
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function aksiPass()
    {
        $param = $this->input->post();
        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {

            if (trim($param['oldPass']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'oldPass_err' => 'Password lama tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['newPass']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'newPass_err' => 'Password baru tidak boleh kosong'
                    ]
                ];
            } elseif (!password_verify($param['oldPass'], $this->m_auth->getCurrentUser()['password'])) {
                $result = [
                    'success' => false,
                    'message' => [
                        'oldPass_err' => 'Password salah',
                    ]
                ];
            } elseif (strlen($param['newPass']) < 8) {
                $result = [
                    'success' => false,
                    'message' => [
                        'newPass_err' => 'Password minimal 8 karakter',
                    ]
                ];
            } elseif ($param['verif'] !== $param['newPass']) {
                $result = [
                    'success' => false,
                    'message' => [
                        'verif_err' => 'Verifikasi password berbeda',
                    ]
                ];
            } else {
                $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
                $param['user_id'] = $idUserLogin;
                $proses = $this->m_auth->putPass($param);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Password anda berhasil diubah'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => $proses['message']
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function getISBN()
    {
        $statusisbn = $this->m_book->getProgressUseName('isbn')['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->m_book->getBooksUsingStatus($statusisbn);

        $data = [];

        $array = multi_unique_array($query->result_array(), 'book_id');
        foreach ($array as $key => $r) {

            $link = base_url() . 'pci/daftarISBN/' . $r['uuid'];
            $data[] = array(
                'no' => $key + 1,
                'judul' => $r['title'],
                'link' => '<a target="_blank" href="' . $link . '">' . $link . '</a>',

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
