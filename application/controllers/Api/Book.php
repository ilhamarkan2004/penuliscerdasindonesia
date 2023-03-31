<?php

use chriskacerguis\RestServer\RestController;

// require APPPATH . '/libraries/RestController.php';
// require APPPATH . 'libraries/Format.php';
require_once APPPATH . 'controllers/api/Auth.php';

class Book extends Auth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Book', 'm_book');
        $this->load->helper('c_helper');
    }

    //Catatan: 
    // Kalo mau ambil detail buku perlu nambahin uuid 
    public function index_get($id = null)
    {
        //ini uuid dari table book_sell
        $uuid = $id;
        if ($uuid == null) {
            $raw = $this->m_book->getBookSell()->result_array();
        } else {
            $raw = $this->m_book->getBookSell($uuid)->result_array();
        }

        $data = [];

        $listCategory = $this->m_book->getBookCategory();
        $listLanguage = $this->m_book->getBookLanguage();
        $listPublisher = $this->m_book->getBookPublisher();
        foreach ($raw as $r) {
            $category = $listCategory[array_search($r['category_id'], array_column($listCategory, "id"))]['title'];
            $language = $listLanguage[array_search($r['language_id'], array_column($listLanguage, "id"))]['language'];
            $publisher = $listPublisher[array_search($r['publisher_id'], array_column($listPublisher, "id"))]['publisher'];

            //disini datanya pake dari tabel book_sell
            $data[] = [
                'uuid' => $r['bs_uuid'],
                'title' => $r['title'],
                'description' => $r['description'],
                'category' => $category,
                'language' => $language,
                'publisher' => $publisher,
                'num_page' => $r['num_page'],
                'cover' => base_url() . $r['cover'],
                'isbn' => $r['isbn'],
                'rating' => $r['sum_rating'],
                'publish_at' => $r['publish_at'],
                'price' => $r['sell_price']

            ];
            if ($uuid != null) {
                $id_book  = $r['book_id'];
                // $
                // $contributors = $this->m_book->getContributorBook($id_book);
                $contributor = $this->m_book->getContributor()->result_array();
                foreach ($contributor as $c) {
                    $raw_contributor = $this->m_book->getContributorBook($id_book, $c['id']);
                    if ($raw_contributor != []) {

                        $list_ct = array();
                        foreach ($raw_contributor as $rc) {
                            $list_ct[] = [
                                'name' => $rc['name'],
                                'uuid' => $rc['uuid'],
                            ];
                        }

                        $data['contributors'][strtolower(str_replace(' ', '', $c['role_name']))] = $list_ct;
                    } else {
                        $data['contributors'][strtolower(str_replace(' ', '', $c['role_name']))] = [];
                    }
                }
            }
        }

        if ($data) {
            $this->response(
                [
                    'success' => true,
                    'message' => [
                        'text' => 'Data buku berhasil didapatkan'
                    ],
                    'data' => $data
                ],
                RestController::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'success' => false,
                    'message' => [
                        'text' => 'Data tidak ditemukan'
                    ],
                    'data' => $data
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }


    //Butuh parameter : 
    // comment => Ambil dari inputan
    // rating => Ambil dari inputan 
    // uuid => Ambil dari url/ inputan

    // Butuh session, jadi hrs login dulu
    public function postcomment_post()
    {
        // Note : 
        // $param['uuid'] ==> UUID Penjualan Buku
        $param = $this->post();
        if (!$this->session->has_userdata('id_user')) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Perlu login untuk akses data'
                ],
                'data' => [$this->session->userdata('id_user')]
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
                if (array_key_exists('comment', $param) || array_key_exists('rating', $param) || array_key_exists('uuid', $param)) {
                    $comment_err = '';
                    $rating_err = '';
                    $uuid_err = '';
                    if (array_key_exists('comment', $param)) {
                        $comment_err = 'Komentar tidak boleh kosong';
                    }
                    if (array_key_exists('rating', $param)) {
                        $comment_err = 'Rating tidak boleh kosong';
                    }
                    if (array_key_exists('uuid', $param)) {
                        $uuid_err = 'UUID penjualan buku kosong';
                    }

                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'Kesalahan inputan'
                        ],
                        'data' => [
                            'comment' => $comment_err,
                            'rating' => $rating_err,
                            'uuid' => $uuid_err
                        ]
                    ];
                    $this->response($result, RestController::HTTP_BAD_REQUEST);
                    die;
                } elseif (trim($param['comment']) == '' || $param['rating'] == '' || $param['uuid'] == '') {
                    $comment_err = '';
                    $rating_err = '';
                    $uuid_err = '';
                    if (trim($param['comment']) == '') {
                        $comment_err = 'Komentar tidak boleh kosong';
                    }
                    if (trim($param['rating']) == '') {
                        $comment_err = 'Rating tidak boleh kosong';
                    }
                    if (trim($param['uuid']) == '') {
                        $uuid_err = 'UUID penjualan buku kosong';
                    }

                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'Kesalahan inputan'
                        ],
                        'data' => [
                            'comment' => $comment_err,
                            'rating' => $rating_err,
                            'uuid' => $uuid_err
                        ]
                    ];
                    $this->response($result, RestController::HTTP_BAD_REQUEST);
                    die;
                } elseif ($this->m_book->getIDFromUUID($param['uuid'])->num_rows() == 0) {
                    $result = [
                        'success' => false,
                        'message' => [
                            'text' => 'Kesalahan inputan',
                        ],
                        'data' => [
                            'uuid' => 'UUID tidak ditemukan'
                        ]
                    ];
                    $this->response($result, RestController::HTTP_BAD_REQUEST);
                    die;
                } else {
                    $param['user_id'] = $id_user;
                    $proses = $this->m_book->postComment($param);
                    if ($proses['success']) {
                        $result = [
                            'success' => false,
                            'message' => [
                                'text' => 'Komentar berhasil ditambahkan'
                            ],
                            'data' => []
                        ];
                        $this->response($result, RestController::HTTP_OK);
                        die;
                    } else {
                        $result = [
                            'success' => false,
                            'message' => [
                                'text' => 'Komentar gagal ditambahkan'
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

    public function getcomment_get($uuid = null)
    {
        //pake uuid book_sell
        $param['uuid'] = $uuid;
        // $param['uuid'] = 'fea9d68f-b3fc-11ed-b26d-f469d5ccb232';
        if (!array_key_exists("uuid", $param)) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Identitas buku tidak ditemukan'
                ],
                'data' => []
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        } elseif ($param['uuid'] == null) {
            $result = [
                'success' => false,
                'message' => [
                    'text' => 'Identitas buku tidak ditemukan'
                ],
                'data' => []
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        } else {
            $bs_uuid = $param['uuid'];
            $comment = $this->m_book->getComment($bs_uuid);
            $data = array();
            foreach ($comment as $c) {
                $data[] = [
                    'name' => $c['name'],
                    'comment' => $c['comment'],
                    'rating' => $c['rating'],
                    'created_at' => $c['br_created_at'],
                ];
            }
            $result = [
                'success' => true,
                'message' => [
                    'text' => 'Berhasil'
                ],
                'data' => $data
            ];
            $this->response($result, RestController::HTTP_BAD_REQUEST);
            die;
        }
    }
}
