<?php

use chriskacerguis\RestServer\RestController;

// require APPPATH . '/libraries/RestController.php';
// require APPPATH . 'libraries/Format.php';
require_once APPPATH . 'controllers/api/Auth.php';

class Buy extends Auth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('c_helper');
        $this->load->model('M_Book', ' m_book');
        $this->load->model('M_Auth', ' m_auth');
    }

    //Butuh parameter : 
    // order_id
    // list UUID jual buku 

    // Butuh session, jadi hrs login dulu
    public function index_post()
    {

        $param = $this->post();
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
            } elseif (array_key_exists('order_id', $param) || array_key_exists('arrId', $param)) {
                $order_id_err = '';
                $arrId_err = '';

                if (array_key_exists('order_id', $param)) {
                    $order_id_err = 'Komentar tidak boleh kosong';
                }
                if (array_key_exists('arrId', $param)) {
                    $arrId_err = 'Komentar tidak boleh kosong';
                }

                $result = [
                    'success' => false,
                    'message' => [
                        'text' => 'Kesalahan inputan'
                    ],
                    'data' => [
                        'order_id' => $order_id_err,
                        'arrId' => $arrId_err,
                    ]
                ];
                $this->response($result, RestController::HTTP_BAD_REQUEST);
                die;
            } else {
                $id_u = $id_user['id'];
                $listBuku = json_decode($param['arrId'], true); //isinya uuid dari tabel book_sell

                //itung total biaya
                $total = $this->m_book->getPriceListBookOrder($listBuku)['sell_price'];
                $param['total'] = $total;
                $param['jenis'] = 'Midtrans';

                foreach ($listBuku as $lb) {
                    $details = $this->m_book->getBookSell($lb);
                    $listBookId[] = $details['book_id'];
                }

                $dataPurchase = [
                    'order_id' => $param['order_id'],
                    'user_id' => $id_u,
                    'gross_amount' => $total
                ];

                $proses = $this->m_book->postPurchase($dataPurchase, $listBookId);
                if ($proses['success']) {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'data berhasil ditambahkan'
                        ],
                        'data' => []
                    ];
                    $this->response($result, RestController::HTTP_OK);
                    die;
                } else {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'data gagal ditambahkan'
                        ],
                        'data' => []
                    ];
                    $this->response($result, RestController::HTTP_INTERNAL_ERROR);
                    die;
                }
            }
        }
    }
}
