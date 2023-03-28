<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
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
}
