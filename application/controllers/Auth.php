<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Event', 'm_event');
        $this->load->helper('c_helper');
    }

    //Show View
    public function index()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect('dashboard');
        }
        $data['title'] = 'Login';
        $data['event'] = $this->m_event->getEventType();
        // viewUser($this, 'auth/login', $data);
        $this->load->view('user/templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('user/templates/footer', $data);
    }

    public function registrasi()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect('dashboard');
        }
        $data['title'] = 'Registrasi';
        $data['event'] = $this->m_event->getEventType();
        $this->load->view('user/templates/header', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('user/templates/footer', $data);
    }

    public function forgot()
    {
        $data['title'] = 'Lupa Password';
        $data['event'] = $this->m_event->getEventType();
        viewUser($this, 'auth/forgot', $data);
    }

    public function changepass($token = null)
    {
        if ($token == null) {
            redirect('custom404');
        } else {
            if ($this->m_auth->cekPassReset(null, $token, 1) == 0) {
                redirect('custom404');
            } else {
                $data['token'] = $token;
                $data['title'] = 'Ubah Password';
                $data['event'] = $this->m_event->getEventType();
                viewUser($this, 'auth/changePass', $data);
            }
        }
    }


    public function prosesForgot()
    {
        $param = $this->input->post();
        if ($this->m_auth->cekEmail($param['email']) == 0) {
            $result = [
                'success' => false,
                'message' => [
                    'icon' => 'error',
                    'title' => 'Tidak ditemukan',
                    'text' => 'Email tidak ditemukan. Pastikan email telah terdaftar sebelumnya'
                ]
            ];
        } else {
            if ($this->m_auth->cekUserAktifEmail($param['email']) == 0) {
                $result = [
                    'success' => false,
                    'message' => [
                        'icon' => 'error',
                        'title' => 'Tidak aktif',
                        'text' => 'Akun belum diaktifkan. Cek email dari kami mengenai aktivasi akun ketika pendaftaran'
                    ]
                ];
            } else {
                //generate simple random code
                $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = substr(time(), -3) . substr(str_shuffle($set), 2, 5);

                $data = [
                    'user_id' => $this->m_auth->getIdFromEmail($param['email'])['id'],
                    'token' => $token,
                    'is_active' => 1 // Mengaktifkan token
                ];

                if ($this->m_auth->cekPassReset($data['user_id']) == 0) {
                    $proses1 = $this->m_auth->postPassReset($data);
                } else {
                    $proses1 = $this->m_auth->putPassReset($data);
                }

                if ($proses1['success']) {
                    $subject = 'Lupa password';
                    $message = "
                        <html>
                        <head>
                            <title>Change Password</title>
                        </head>
                        <body>
                            <h2>Ubah Password.</h2>
                            <p>Klik link di bawah untuk mengganti password</p>

                            <h4><a href='" . base_url() . "auth/changePass/" .  $token . "'>Ubah password saya</a></h4>
                        </body>
                        </html>
                        ";

                    $proses = sendEmail($param['email'], $message, $subject, $this->m_auth->getDefaultValue('email')['value'], $this->m_auth->getDefaultValue('email_pass')['value']);
                    if ($proses['success']) {
                        $result = [
                            'success' => true,
                            'message' => 'Link untuk mengubah password telah terkirim. Silahkan cek email anda'
                        ];
                    } else {
                        $result = [
                            'success' => false,
                            'message' => [
                                'icon' => 'error',
                                'title' => 'Tidak terkirim',
                                'text' => $proses['message']
                            ]
                        ];
                    }
                } else {
                    $result = [
                        'success' => false,
                        'message' => [
                            'icon' => 'error',
                            'title' => 'Token gagal',
                            'text' => 'Token gagal dibuat. Coba ulangi beberapa saat lagi'
                        ]
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function prosesChange()
    {
        $param = $this->input->post();
        $token = $param['token'];

        if ($token == '') {
            $result = [
                'success' => false,
                'message' => [
                    'icon' => 'error',
                    'title' => 'Tidak ditemukan',
                    'text' => 'Token tidak ada'
                ]
            ];
        } else {
            if ($this->m_auth->cekPassReset(null, $token, 1) == 0) {
                $result = [
                    'success' => false,
                    'message' => [
                        'icon' => 'error',
                        'title' => 'Tidak ditemukan',
                        'text' => 'Token tidak ditemukan'
                    ]
                ];
            } else {

                if (trim($param['password']) == '') {
                    $result = [
                        'success' => false,
                        'message' => [
                            'icon' => 'error',
                            'title' => 'Tidak sesuai',
                            'text' => 'Terdapat kolom yang masih kosong'
                        ]
                    ];
                } elseif ($param['password'] != $param['passConf']) {
                    $result = [
                        'success' => false,
                        'message' => [
                            'icon' => 'error',
                            'title' => 'Tidak sesuai',
                            'text' => 'Konfirmasi password tidak sama'
                        ]
                    ];
                } else {
                    $user = $this->m_auth->getUserToken($token);
                    $data['newPass'] = $param['password'];
                    $data['user_id'] = $user['u_id'];
                    $proses = $this->m_auth->putPass($data);
                    if ($proses['success']) {
                        $result = [
                            'success' => true,
                            'message' => 'Ubah password berhasil!'
                        ];
                    }
                }
            }
        }
        echo json_encode($result);
    }
    //Proses
    public function login()
    {

        $userLogin = $this->input->post();
        $user = $this->m_auth->login($userLogin['email'])->row_array();

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $result = [
                'success' => false,
                'message' => [
                    'title' => 'Gagal login',
                    'text' => form_error('email') . ', ' . form_error('password'),
                    'icon' => 'error'
                ]
            ];
        } elseif ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($userLogin['password'], $user['password'])) {
                    $this->session->set_userdata('id_user', $user['uuid']);
                    $result = [
                        'success' => true,
                        'message' => [
                            'title' => 'Berhasil login',
                            'text' => '',
                            'icon' => 'success'
                        ]
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => [
                            'title' => 'Gagal login',
                            'text' => 'Pastikan email atau password anda benar',
                            'icon' => 'error'
                        ]
                    ];
                }
            } else {
                $result = [
                    'success' => false,
                    'message' => [
                        'title' => 'Gagal login',
                        'text' => 'Status pengguna belum aktif',
                        'icon' => 'error'
                    ]
                ];
            }
        } else {
            $result = [
                'success' => false,
                'message' => [
                    'title' => 'Gagal login',
                    'text' => 'Pastikan email atau password anda benar',
                    'icon' => 'error'
                ]
            ];
        }
        echo json_encode($result);
    }

    public function activate($uuid = null, $verify_code = null)
    {
        if ($uuid == null || $verify_code == null) {
            redirect('Custom404');
        } else {
            if ($this->m_auth->cekActivate($uuid, $verify_code) == 0) {
                redirect('Custom404');
            } else {
                $proses = $this->m_auth->activateAccount($uuid, $verify_code);
                if ($proses) {
                    $this->session->set_flashdata('message_success', 'Aktivasi akun berhasil');
                } else {
                    $this->session->set_flashdata('message_error', 'Aktivasi akun gagal');
                }
                redirect('auth');
            }
        }
    }


    public function prosesRegist()
    {
        // print_r($this->input->post());
        // die;

        $rules = [

            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|max_length[100]|min_length[3]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]|is_unique[users.email]'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]'
            ],
            [
                'field' => 'passConf',
                'label' => 'Konfirmasi password',
                'rules' => 'required|min_length[8]|matches[password]'
            ],
            [
                'field' => 'nohp',
                'label' => 'Nomor Telepon',
                'rules' => 'required|max_length[15]|min_length[10]'
            ],

        ];

        $this->form_validation->set_message('required', '{field} harus diisi!');
        $this->form_validation->set_message('matches', '{field} tidak valid!');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');
        $this->form_validation->set_message('valid_email', '{field} tidak valid!');
        $this->form_validation->set_message('min_length', '{field} terlalu pendek');
        $this->form_validation->set_message('max_length', '{field} terlalu panjang');
        // $this->form_validation->set_message('checkNumber', 'Gunakan format +628');

        $this->form_validation->set_rules($rules);

        $no_hp = '62' . $this->input->post('nohp');
        if ($this->form_validation->run() === FALSE) {
            $result = [
                'success' => false,
                'message' => [
                    'nama' => strip_tags(form_error('nama')),
                    'email' => strip_tags(form_error('email')),
                    'nohp' => strip_tags(form_error('nohp')),
                    'password' => strip_tags(form_error('password')),
                    'passConf' => strip_tags(form_error('passConf'))
                ]
            ];
        } elseif ($this->m_auth->cekTelp($no_hp)) {
            $result = [
                'success' => false,
                'message' => [
                    'nohp' => 'Nomor telepon telah digunakan',
                ]
            ];
        } elseif (strlen($no_hp) > 13 || strlen($no_hp) < 8) {
            $result = [
                'success' => false,
                'message' => [
                    'nohp' => 'Nomor HP maksimal 13 karakter dan minimal 8 karakter',
                ]
            ];
        } elseif (strlen($this->input->post('referral')) != 0 && $this->m_auth->getIdUserReferral($this->input->post('referral'))->num_rows() == 0) {
            $result = [
                'success' => false,
                'message' => [
                    'referral' => 'Kode referral tidak ditemukan',
                ]
            ];
        } else {
            $referral_code = substr($this->input->post('nama'), 0, 3) . $this->randomReferralCode(3);
            if ($this->m_auth->getIdUserReferral($referral_code)->num_rows() > 0) {
                $referral_code = substr($this->input->post('nama'), 0, 3) . $this->randomReferralCode(3);
            }

            //generate simple random code
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = time() . substr(str_shuffle($set), 2, 12) . substr($this->input->post('email'), 0, 3);

            $this->db->trans_begin();

            $users = [
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'phone' => $no_hp,
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->m_auth->getIDRole('User')['id'],
                'referral_code' =>  $referral_code,
                'verify_code' => $code
            ];
            //set id column value as UUID
            $this->db->set('uuid', 'UUID()', FALSE);

            $this->m_auth->insertUsers($users);

            $id_users = $this->db->insert_id();

            if (trim($this->input->post('referral')) != '') {
                $referral_from = $this->m_auth->getIdUserReferral($this->input->post('referral'))->row_array()['id'];
            } else {
                $referral_from = null;
            }

            $user_referral = [
                'referral_from' => $referral_from,
                'user_id' => $id_users,
            ];

            $this->m_auth->insertUserReferral($user_referral);

            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $user = $this->m_auth->getVerifyEmail($id_users);
                $subject = 'Signup Verification Email';
                $message =     "
						<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering.</h2>
							<p>Your Account:</p>
							<p>Email: " .  $this->input->post('email') . "</p>
							<p>Password: " . $this->input->post('password') . "</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='" . base_url() . "auth/activate/" .  $user['uuid'] . "/" . $user['verify_code'] . "'>Activate My Account</a></h4>
						</body>
						</html>
						";


                $proses = sendEmail($this->input->post('email'), $message, $subject, $this->m_auth->getDefaultValue('email')['value'], $this->m_auth->getDefaultValue('email_pass')['value']);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Selamat! Pendaftaran akun berhasil. Cek email anda untuk aktivasi akun'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => [
                            'icon' => 'error',
                            'title' => 'Tidak terkirim',
                            'text' => $proses['message']
                        ]
                    ];
                }
            } else {
                $this->db->trans_rollback();
                $result = [
                    'success' => false,
                    'message' => 'Gagal daftar'
                ];
            }
        }
        echo json_encode($result);
    }

    public function checkAlphaOnly($nama)
    {
        if (!preg_match('/^[a-zA-Z ]*$/', $nama)) return FALSE;
        else return TRUE;
    }

    public function checkNumber($no)
    {
        if (!preg_match('/((^(\+62)\d{12}))/', $no)) return FALSE;
        else return TRUE;
    }


    public function logout()
    {
        // if (!$this->session->has_userdata('id_user')) {
        //     $result = [
        //         'success' => false,
        //         'message' => 'Gagal logout'
        //     ];
        // }else{
        //     $hasil = $this->m_auth->logout();
        //     if ($hasil) {
        //         $result = [
        //             'success' => true,
        //             'message' => 'Berhasil logout'
        //         ];
        //     }else{
        //         $result = [
        //             'success' => false,
        //             'message' => 'Berhasil logout'
        //         ];
        //     }
        // }
        // echo json_encode($result);
        // $this->session->unset_userdata('id_user');
        $this->m_auth->logout();
        // json_encode($result);
        redirect("auth");
    }

    private function randomReferralCode($numChar)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i <= $numChar; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    // GET ALAMAT
    public function getKab()
    {
        $prov_id = $this->input->post('provinsi');
        // print_r($prov_id);
        // die;
        $kabupaten = $this->m_auth->kabupaten($prov_id);
        echo json_encode($kabupaten);
    }
    public function addkontributor() {
    // Mengambil daftar event dan buku
    $data['event'] = $this->m_event->getEventType();
    $data['buku'] = $this->db->get('katalogbuku')->result_array();

    // Mengambil data pengguna yang sedang login
    $userData = $this->m_auth->getCurrentUser();

    if ($userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        // User adalah admin, izinkan proses tambah kontributor baru

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('buku_id', 'Buku_id', 'required|trim');
        $this->form_validation->set_rules('kontributor', 'Kontributor', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Kontributor';
            viewUser($this, 'user/pages/createkontributor', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $buku_id = htmlspecialchars($this->input->post('buku_id', true));
            $kontributor = $this->input->post('kontributor');

            // Memutuskan tabel berdasarkan tipe kontributor
            $table = '';
            if ($kontributor === 'penulis') {
                $table = 'penulis';
            } elseif ($kontributor === 'editor') {
                $table = 'editor';
            } elseif ($kontributor === 'designcover') {
                $table = 'designcover';
            } elseif ($kontributor === 'layout') {
                $table = 'layout';
            }

            if ($table !== '') {
                // Menyiapkan data untuk disimpan
                $data = [
                    'nama' => $nama,
                    'buku_id' => $buku_id,
                ];

                // Menyimpan data ke tabel yang sesuai
                $this->db->insert($table, $data);

                $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Berhasil menambahkan kontributor baru </div>');
                redirect('daftarbuku');
            } else {
                // Tipe kontributor tidak valid, lakukan penanganan kesalahan
            }
        }
    } else {
        redirect('auth');
    }
}

public function editcontributor($id, $kategori) {
     $userData = $this->m_auth->getCurrentUser();

    if (!$userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        redirect('auth');
    }
    $data['event'] = $this->m_event->getEventType();

    // Mendapatkan tipe kontributor berdasarkan kategori
    $table = '';
    if ($kategori === 'penulis') {
        $table = 'penulis';
    } elseif ($kategori === 'editor') {
        $table = 'editor';
    } elseif ($kategori === 'designcover') {
        $table = 'designcover';
    } elseif ($kategori === 'layout') {
        $table = 'layout';
    }

    if ($table !== '') {
        $contributor = $this->db->get_where($table, ['id' => $id])->row_array();

        if ($contributor) {
            $data['contributor'] = $contributor;
            $data['kategori'] = $kategori;

            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Edit Kontributor';
                viewUser($this, 'user/pages/editcontributor', $data);
            } else {
                $nama = htmlspecialchars($this->input->post('nama', true));

                // Menyiapkan data untuk diperbarui, hanya nama yang ingin diupdate
                $dataToUpdate = [
                    'nama' => $nama,
                ];

                // Memperbarui data kontributor di tabel yang sesuai
                $this->db->where('id', $id);
                $this->db->update($table, $dataToUpdate);

                $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Berhasil memperbarui kontributor </div>');
                redirect('daftarbuku');
            }
        } else {
            redirect('daftarbuku');
        }
    } else {
        redirect('daftarbuku');
    }
}




public function view($id = null){
    $userData = $this->m_auth->getCurrentUser();

    if (!$userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        redirect('auth');
    }
   if (!$id) {
        redirect('tabel'); // Redirect ke halaman tabel jika ID tidak diberikan
    }
        $data['event'] = $this->m_event->getEventType();
        $data['title'] = 'Baca';

        $buku = $this->db->get_where('katalogbuku', ['id' => $id])->row_array();
        $penulis = $this->db->get_where('penulis', ['buku_id' => $id])->result_array();
        $editor = $this->db->get_where('editor', ['buku_id' => $id])->result_array();
        $designcover = $this->db->get_where('designcover', ['buku_id' => $id])->result_array();
        $layout = $this->db->get_where('layout', ['buku_id' => $id])->result_array();

        if ($buku) {
            $data['buku'] = $buku;
            $data['penulis'] = $penulis;
            $data['editor'] = $editor;
            $data['designcover'] = $designcover;
            $data['layout'] = $layout;
            viewUser($this, 'user/pages/listcontributor', $data);
        } else {
            redirect('tabel'); // Redirect ke halaman katalog jika ID buku tidak ditemukan
        }
}

public function daftarbuku() {
    $userData = $this->m_auth->getCurrentUser();

    if ($userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        // User adalah admin, izinkan akses ke fungsi tabel
        $data['event'] = $this->m_event->getEventType();
        $data['title'] = 'Daftar Buku';
        $this->db->order_by('tanggal_terbit', 'desc');
        $data['buku'] = $this->db->get('katalogbuku')->result_array();
        viewUser($this, 'user/pages/listbook', $data);
    } else {
        // User bukan admin, tampilkan pesan akses ditolak atau lakukan aksi lainnya
        // Contoh: redirect('home');
        redirect('auth');
    }
}


public function edit($id = null) {
    $data['event'] = $this->m_event->getEventType();
    $userData = $this->m_auth->getCurrentUser();

    if ($userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        // User adalah admin, izinkan proses edit buku

        // Load existing data
       $buku = $this->db->get_where('katalogbuku', ['id' => $id])->row_array();

        if(!$buku){
            redirect('daftarbuku');
        }

        $data['existing_buku'] = $buku;

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('halaman', 'Halaman', 'required|trim|numeric');
        $this->form_validation->set_rules('tanggal_terbit', 'Tanggal Terbit', 'required');
        $this->form_validation->set_rules('bahasa', 'Bahasa', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('flipbook', 'ISBN', 'trim');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim|numeric');
        $this->form_validation->set_rules('lebar', 'Lebar', 'required|trim|numeric');
        $this->form_validation->set_rules('panjang', 'Panjang', 'required|trim|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Buku';
            viewUser($this, 'user/pages/editbook', $data);
        } else {
            // Proses edit buku
            $data = [
                'judul' => htmlspecialchars($this->input->post('judul', true)),
                'halaman' => htmlspecialchars($this->input->post('halaman', true)),
                'tanggal_terbit' => htmlspecialchars($this->input->post('tanggal_terbit', true)),
                'bahasa' => htmlspecialchars($this->input->post('bahasa', true)),
                'penerbit' => htmlspecialchars($this->input->post('penerbit', true)),
                'flipbook' => htmlspecialchars($this->input->post('flipbook', true)),
                'isbn' => htmlspecialchars($this->input->post('isbn', true)),
                'berat' => htmlspecialchars($this->input->post('berat', true)),
                'lebar' => htmlspecialchars($this->input->post('lebar', true)),
                'panjang' => htmlspecialchars($this->input->post('panjang', true)),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true))
            ];

            // Check if a new image is uploaded
            $buku = $_FILES['fotobuku'];
            if (!empty($buku['name'])) {
                $upload_path = './public/uploads/buku'; // Ganti dengan jalur folder penyimpanan yang sesuai
                $uploaded_file = $this->upload_image($buku, $upload_path);

                if ($uploaded_file) {
                    // Delete the old image from storage and database
                    $old_image_path = $upload_path . '/' . $data['existing_buku']['fotobuku'];
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                    $data['fotobuku'] = $uploaded_file['file_name'];
                } else {
                    $data['upload_error'] = 'Terjadi kesalahan saat mengunggah foto buku.';
                    viewUser($this, 'user/pages/editbook', $data);
                    return;
                }
            }

            $this->db->where('id', $id);
            $this->db->update('katalogbuku', $data);
            $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Berhasil mengedit buku </div>');
            redirect('daftarbuku');
        }
    } else {
        // User bukan admin, redirect atau lakukan aksi lainnya sesuai kebutuhan
        // Misalnya, tampilkan pesan akses ditolak atau redirect ke halaman lain
        redirect('daftarbuku'); // Ganti dengan URL atau route yang sesuai
    }
}
 public function deleteContributor()
    {
        $userData = $this->m_auth->getCurrentUser();
        $kategori =  $this->input->post('kategori');

    if (!$userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        redirect('auth');
    }
    if (empty($kategori)) {
        redirect('daftarbuku'); // Ganti 'halaman_lain' dengan URL tujuan
    }

        $contributor_id = $this->input->post('buku_id');

        // Lakukan proses penghapusan kontributor berdasarkan ID dan kategori
        $table = '';
        if ($kategori === 'penulis') {
            $table = 'penulis';
        } elseif ($kategori === 'designcover') {
            $table = 'designcover';
        } elseif ($kategori === 'editor') {
            $table = 'editor';
        } elseif ($kategori === 'layout') {
            $table = 'layout';
        }

        if ($table !== '') {
            // Lakukan proses penghapusan berdasarkan ID di tabel yang sesuai
            $this->db->where('id', $contributor_id);
            $this->db->delete($table);

            $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Kontributor berhasil dihapus </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 role="alert"> Terjadi kesalahan saat menghapus kontributor </div>');
        }

        redirect('daftarbuku');
    }
 public function delete() {
        $id = $this->input->post('buku_id');

        // Perform deletion logic
        // Get the image file name from the database
        $query = $this->db->select('fotobuku')->get_where('katalogbuku', ['id' => $id]);
        $result = $query->row_array();
        $imageFileName = $result['fotobuku'];

        // Delete the image file from storage
        $imagePath = FCPATH . 'public/uploads/buku/' . $imageFileName;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the entry from the database
        $this->db->where('id', $id);
        $this->db->delete('katalogbuku');

        $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Berhasil menghapus buku </div>');

        // Redirect to index or any appropriate page after deletion
        redirect('daftarbuku');
    }

public function create()
{
      $data['event'] = $this->m_event->getEventType();
    $userData = $this->m_auth->getCurrentUser();

    if ($userData['role_id'] == $this->m_auth->getIDRole('Admin')['id']) {
        // User adalah admin, izinkan proses tambah buku baru

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('halaman', 'Halaman', 'required|trim|numeric');
        $this->form_validation->set_rules('tanggal_terbit', 'Tanggal Terbit', 'required');
        $this->form_validation->set_rules('bahasa', 'Bahasa', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('flipbook', 'Flipbook', 'trim');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim|numeric');
        $this->form_validation->set_rules('lebar', 'Lebar', 'required|trim|numeric');
        $this->form_validation->set_rules('panjang', 'Panjang', 'required|trim|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('fotobuku', 'Foto Buku', 'callback_upload_check');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Buku';
            viewUser($this, 'user/pages/createbook', $data);
        } else {
            // Proses tambah buku baru
            $buku = $_FILES['fotobuku'];
            $upload_path = './public/uploads/buku'; // Ganti dengan jalur folder penyimpanan yang sesuai
            $uploaded_file = $this->upload_image($buku, $upload_path);

            if ($uploaded_file) {
                $data = [
                    'judul' => htmlspecialchars($this->input->post('judul', true)),
                    'halaman' => htmlspecialchars($this->input->post('halaman', true)),
                    'tanggal_terbit' => htmlspecialchars($this->input->post('tanggal_terbit', true)),
                    'bahasa' => htmlspecialchars($this->input->post('bahasa', true)),
                    'penerbit' => htmlspecialchars($this->input->post('penerbit', true)),
                    'flipbook' => htmlspecialchars($this->input->post('flipbook', true)),
                    'isbn' => htmlspecialchars($this->input->post('isbn', true)),
                    'berat' => htmlspecialchars($this->input->post('berat', true)),
                    'lebar' => htmlspecialchars($this->input->post('lebar', true)),
                    'panjang' => htmlspecialchars($this->input->post('panjang', true)),
                    'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                    'fotobuku' => $uploaded_file['file_name']
                ];
                $this->db->insert('katalogbuku', $data);
                $this->session->set_flashdata('message', '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 role="alert"> Berhasil menambahkan buku baru </div>');
                redirect('addkontributor');
            } else {
                $data['title'] = 'Tambah Buku';
                $data['upload_error'] = 'Terjadi kesalahan saat mengunggah foto buku.';
                viewUser($this, 'user/pages/createbook', $data);
            }
        }
    } else {
        // User bukan admin, redirect atau lakukan aksi lainnya sesuai kebutuhan
        // Misalnya, tampilkan pesan akses ditolak atau redirect ke halaman lain
        redirect('daftarbuku'); 
    }
}

// Add this callback function to your controller
public function upload_check($str)
{
    if (!empty($_FILES['fotobuku']['name'])) {
        $config['upload_path'] = './public/uploads/buku/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 4096; // Maximum file size in KB
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fotobuku')) {
            $this->form_validation->set_message('upload_check', $this->upload->display_errors());
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}

// Add this function to your controller
private function upload_image($file, $upload_path)
{
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = 2048; // Maximum file size in KB
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('fotobuku')) {
        return $this->upload->data();
    } else {
        return false;
    }
}

}
