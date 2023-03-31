<?php

use chriskacerguis\RestServer\RestController;

require_once APPPATH . 'controllers/api/Auth.php';

class Transaksi extends Auth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Book', 'm_book');
        $this->load->helper('c_helper');
    }

    //Butuh : 
    // uuid => hrs login dulu biar dapet session berupa uuid user

    //Tujuan : Ambil data transaksi dari yg login
    public function index_get()
    {
        // $param = $this->get();
        if (!$this->session->has_userdata('id_user')) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Perlu login untuk akses data'
                ],
                'data' => []
            ];
            $this->response($result, RestController::HTTP_UNAUTHORIZED);
            die;
        } else {
            $uuid = $this->session->userdata('id_user');
            $id_user = $this->m_auth->getIdUserFromUUID($uuid);
            if ($id_user == []) {
                $result = [
                    'success' => false,
                    'message' => [
                        'text' => 'Identitas tidak ditemukan'
                    ],
                    'data' => []
                ];
                $this->response($result, RestController::HTTP_BAD_REQUEST);
                die;
            } else {
                $id_user = $id_user['id'];

                // if (!array_key_exists('id_order', $param)) {
                //     $param['id_order'] = null;
                // }

                // if ($param['id_order'] == null) {
                $raw = $this->m_book->getPurchase(null, $id_user)->result_array();
                // } else {
                //     $raw = $this->m_book->getPurchase($param['id_order'], $id_user)->result_array();
                // }

                $data = [];
                foreach ($raw as $r) {
                    $data[] = [
                        'order_id' => $r['order_id'],
                        'status_code' => $r['status_code'],
                        'price' => $r['gross_amount'],
                        'created_at' => $r['created_at'],
                    ];
                }

                $result = [
                    'success' => true,
                    'message' => [
                        'text' => 'Berhasil mendapatkan transaksi'
                    ],
                    'data' => $data
                ];
                $this->response($result, RestController::HTTP_OK);
                die;
            }
        }
    }

    //Butuh : 
    // uuid => hrs login dulu biar dapet session berupa uuid user
    // id_order => id order dari pembelian buku

    //Tujuan : Ambil list buku sesuai id_order
    public function buyBooks_get($id_order = null)
    {
        $param['id_order'] = $id_order;
        if (!$this->session->has_userdata('id_user')) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Perlu login untuk akses data'
                ],
                'data' => []
            ];
            $this->response($result, RestController::HTTP_UNAUTHORIZED);
            die;
        } else {
            $uuid = $this->session->userdata('id_user');
            $id_user = $this->m_auth->getIdUserFromUUID($uuid);
            if ($id_user == []) {
                $result = [
                    'success' => false,
                    'message' => [
                        'text' => 'Identitas tidak ditemukan'
                    ],
                    'data' => []
                ];
                $this->response($result, RestController::HTTP_BAD_REQUEST);
                die;
            } else {
                $id_user = $id_user['id'];

                if (!array_key_exists('order_id', $param)) {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'id order tidak didapatkan'
                        ],
                        'data' => []
                    ];
                    $this->response($result, RestController::HTTP_BAD_REQUEST);
                    die;
                } elseif (trim($param['order_id']) == null) {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'id order tidak didapatkan'
                        ],
                        'data' => []
                    ];
                    $this->response($result, RestController::HTTP_BAD_REQUEST);
                    die;
                } else {
                    $raw = $this->m_book->getPurchaseBook($param['order_id']);
                    $data = [];
                    foreach ($raw as $r) {
                        $data[] = [
                            'title' => $r['title'],
                            'cover' => base_url() . $r['cover'],
                            //     'price' => $r['gross_amount'],
                            //     'created_at' => $r['created_at'],
                        ];
                    }
                    $result = [
                        'success' => true,
                        'message' => [
                            'text' => 'Berhasil mendapatkan list buku'
                        ],
                        'data' => $data
                    ];
                    $this->response($result, RestController::HTTP_OK);
                    die;
                }
            }
        }
    }
}
