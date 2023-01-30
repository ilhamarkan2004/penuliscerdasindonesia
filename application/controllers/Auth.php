<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        // $this->load->model('M_Pendaftaran', 'm_daftar');
        $this->load->helper('c_helper');

        // if ($this->session->has_userdata('id_user')) {
        //     redirect(base_url());
        // }
    }

    public function index()
    {
        $data['title'] = 'Login';
        viewUser($this, 'auth/login', $data);
    }

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
                    $this->session->set_userdata('id_user', $user['id']);
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

    public function registrasi()
    {
        $data['title'] = 'Registrasi';
        viewUser($this, 'auth/register', $data);
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
            $users = [

                // 'username' => "62" . $this->input->post('nohp'),
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                // 'gambar' => default_profil(),
                // 'user_group_id' => $this->m_auth->getIDRole('Pendaftar')['id'],
                'referral_code' =>  $referral_code
            ];

            $this->db->trans_begin();
            $this->m_auth->insertUsers($users);

            $id_users = $this->db->insert_id();

            $referral_from = $this->m_auth->getIdUserReferral($this->input->post('referral'))->row_array()['id'];

            $user_referral = [
                'referral_from' => $referral_from,
                'user_id' => $id_users,
            ];

            $this->m_auth->insertUserReferral($user_referral);

            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                // $text = "Anda telah terdaftar di AMD Academy\nBerikut adalah username dan password akun anda : \n *Username : 62" .  $this->input->post('nohp') . "* \n *Password : " . $this->input->post('password1') . "* \n";
                // $this->m_daftar->postWA("62" . $this->input->post('nohp'), $text);
                $result = [
                    'success' => true,
                    'message' => 'Selamat! Pendaftaran akun berhasil. Silahkan Login!'
                ];
                // return TRUE;
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

    public function forgot()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Kamu nanya? password kamu apa kamu nanya?');
        redirect('auth');
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
}
