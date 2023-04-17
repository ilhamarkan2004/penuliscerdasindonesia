<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/JWT.php';
require APPPATH . '/libraries/Key.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/BeforeValidException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';
require APPPATH . '/libraries/JWK.php';
require APPPATH . '/libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use \Firebase\JWT\ExpiredException;

class Auth extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth', 'm_auth');
    }

    private function configToken()
    {
        $cnf['exp'] = 3600; //milisecond
        $cnf['secretkey'] = 'penulisCerdasIndonesia';
        return $cnf;
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

    // Butuh Parameter: 
    // email => ambil dari inputan
    // password => ambil dari inputan
    public function login_post()
    {
        // $space = '0e!7l8S';
        $param = $this->post();
        if (!array_key_exists('email', $param) || !array_key_exists('password', $param)) {
            $email_err = '';
            $password_err = '';

            if (!array_key_exists('email', $param)) {
                $email_err = 'email tidak boleh kosong';
            }
            if (!array_key_exists('password', $param)) {
                $password_err = 'password tidak boleh kosong';
            }

            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Kesalahan inputan'
                ],
                'data' => [
                    'email' => $email_err,
                    'password' => $password_err,
                ]
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        } else {
            if (trim($param['email']) === '' || trim($param['password']) === '') {
                $this->response(
                    [
                        'success' => false,
                        'message' => [
                            'title' => 'Gagal login',
                            'text' => 'Kolom email atau password harap dilengkapi',
                        ],
                        'data' => []
                    ],
                    RestController::HTTP_BAD_REQUEST
                );
                die;
            } elseif ($this->m_auth->login($param['email'])->row_array()) {
                $user = $this->m_auth->login($param['email'])->row_array();
                if ($user['is_active'] == 1) {
                    if (password_verify($param['password'], $user['password'])) {

                        // $exp = time() + 360;
                        // $token = array(
                        //     "iss" => 'apprestservice',
                        //     "aud" => 'pengguna',
                        //     "iat" => time(),
                        //     "nbf" => time() + 10,
                        //     "exp" => $exp,
                        //     "data" => array(
                        //         'data' => $user['uuid'] . $space . $user['password']
                        //     )
                        // );

                        // $jwt = JWT::encode($token, $this->configToken()['secretkey'], 'HS256');


                        //set session
                        $this->session->set_userdata('id_user', $user['uuid']);
                        $output = [
                            'success' => true,
                            'message' => [
                                'title' => 'Berhasil login',
                                'text' => 'Berhasil login',
                            ],
                            'data' => []
                        ];
                        $this->response($output, 200);
                    } else {
                        $this->response([
                            'success' => false,
                            'message' => [
                                'title' => 'Gagal login',
                                'text' => 'Pastikan email atau password anda benar',
                            ],
                            'data' => []
                        ],  RestController::HTTP_BAD_REQUEST);
                        die;
                    }
                } else {
                    $this->response([
                        'success' => false,
                        'message' => [
                            'title' => 'Gagal login',
                            'text' => 'Status pengguna belum aktif',
                        ],
                        'data' => []
                    ],  RestController::HTTP_BAD_REQUEST);
                    die;
                }
            } else {
                $this->response([
                    'success' => false,
                    'message' => [
                        'title' => 'Gagal login',
                        'text' => 'Pastikan email atau password anda benar',
                    ],
                    'data' => []
                ],  RestController::HTTP_BAD_REQUEST);
                die;
            }
        }
    }

    // Butuh Parameter: 
    // nama => ambil dari inputan
    // email => ambil dari inputan
    // password => ambil dari inputan
    // passConf => ambil dari inputan
    // nohp => ambil dari inputan
    public function regist_post()
    {
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

        $no_hp = '62' . $this->post('nohp');
        if ($this->form_validation->run() === FALSE) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Kesalahan inputan'
                ],
                'data' => [
                    'nama' => strip_tags(form_error('nama')),
                    'email' => strip_tags(form_error('email')),
                    'nohp' => strip_tags(form_error('nohp')),
                    'password' => strip_tags(form_error('password')),
                    'passConf' => strip_tags(form_error('passConf'))
                ]
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        } elseif ($this->m_auth->cekTelp($no_hp)) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Kesalahan inputan'
                ],
                'data' => [
                    'nohp' => 'Nomor telepon telah digunakan',
                ]
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        } elseif (strlen($no_hp) > 13 || strlen($no_hp) < 8) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Kesalahan inputan'
                ],
                'data' => [
                    'nohp' => 'Nomor HP maksimal 12 karakter dan minimal 8 karakter',
                ]
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        }
        // elseif (strlen($this->post('referral')) != 0 && $this->m_auth->getIdUserReferral($this->post('referral'))->num_rows() == 0) {
        //     $result = [
        //         'success' => false,
        //         'message' => [
        //             'referral' => 'Kode referral tidak ditemukan',
        //         ]
        //     ];

        // }
        else {
            $referral_code = substr($this->post('nama'), 0, 3) . $this->randomReferralCode(3);
            if ($this->m_auth->getIdUserReferral($referral_code)->num_rows() > 0) {
                $referral_code = substr($this->post('nama'), 0, 3) . $this->randomReferralCode(3);
            }

            //generate simple random code
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = time() . substr(str_shuffle($set), 2, 12) . substr($this->post('email'), 0, 3);

            $this->db->trans_begin();

            $users = [
                'name' => $this->post('nama'),
                'email' => $this->post('email'),
                'phone' => $no_hp,
                'password' =>  password_hash($this->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->m_auth->getIDRole('User')['id'],
                'referral_code' =>  $referral_code,
                'verify_code' => $code
            ];
            //set id column value as UUID
            $this->db->set('uuid', 'UUID()', FALSE);

            //Insert in table user
            $this->m_auth->insertUsers($users);

            $id_users = $this->db->insert_id();

            if (trim($this->post('referral')) != '') {
                $referral_from = $this->m_auth->getIdUserReferral($this->post('referral'))->row_array()['id'];
            } else {
                $referral_from = null;
            }

            $user_referral = [
                'referral_from' => $referral_from,
                'user_id' => $id_users,
            ];

            //Insert in table referral
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
							<p>Email: " .  $this->post('email') . "</p>
							<p>Password: " . $this->post('password') . "</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='" . base_url() . "auth/activate/" .  $user['uuid'] . "/" . $user['verify_code'] . "'>Activate My Account</a></h4>
						</body>
						</html>
						";

                $prosesEmail = sendEmail($this, $this->post('email'), $message, $subject, $this->m_auth->getDefaultValue('email')['value'], $this->m_auth->getDefaultValue('email_pass')['value']);

                if ($prosesEmail['success']) {
                    $result = [
                        'success' => true,
                        'message' => [
                            'text' => 'Selamat! Pendaftaran akun berhasil. Silahkan Login!'
                        ],
                        'data' => []
                    ];
                    $this->response($result, 200);
                    die;
                } else {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'Terjadi kesalahan saat pengiriman email. Mohon hubungi admin untuk aktivasi akun'
                        ],
                        'data' => []
                    ];
                    $this->response($result, RestController::HTTP_INTERNAL_ERROR);
                    die;
                }
            } else {
                $this->db->trans_rollback();
                $result = [
                    'success' => false,
                    'message' => 'Pendaftaran gagal'
                ];
                $this->response($result, RestController::HTTP_INTERNAL_ERROR);
            }
        }
    }

    public function logout_post()
    {
        $proses = $this->m_auth->logout();
        if ($proses === true) {
            $result = [
                'success' => true,
                'message' => [
                    'text' => 'Berhasil logout'
                ],
                'data' => []
            ];
            $this->response($result, 200);
            die;
        } else {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Gagal logout'
                ],
                'data' => []
            ];
            $this->response($result, RestController::HTTP_INTERNAL_ERROR);
            die;
        }
    }

    // public function authtoken()
    // {
    //     if (array_key_exists('Authorization', $this->input->request_headers()) == false) {
    //         $this->response(
    //             [
    //                 'success' => false,
    //                 'message' => [
    //                     'title' => 'Gagal akses data',
    //                     'text' => 'Token belum ada',
    //                     'icon' => 'error'
    //                 ]
    //             ],
    //             RestController::HTTP_UNAUTHORIZED
    //         );
    //         die;
    //     }

    //     $secret_key = $this->configToken()['secretkey'];
    //     $token = null;
    //     $authHeader = $this->input->request_headers()['Authorization'];
    //     $arr = explode(" ", $authHeader);
    //     $token = $arr[1];
    //     if ($token) {
    //         try {
    //             $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
    //             if ($decoded) {
    //                 return true;
    //             }
    //         } catch (\Exception $e) {
    //             $result = array('pesan' => 'Kode Signature Tidak Sesuai');
    //             return false;
    //         }
    //     }
    // }
}
