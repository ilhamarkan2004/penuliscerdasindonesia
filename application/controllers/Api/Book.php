<?php

use chriskacerguis\RestServer\RestController;

require_once APPPATH . 'controllers/api/Auth.php';

class Book extends Auth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Book', 'm_book');
        $this->load->helper('c_helper');
    }

    public function index_get()
    {
        $uuid = $this->get('id');
        if ($uuid === null) {
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

            $data[] = array(
                'uuid' => $r['bs_uuid'],
                'title' => $r['title'],
                'description' => $r['description'],
                'category' => $category,
                'language' => $language,
                'publisher' => $publisher,
                'num_page' => $r['num_page'],
                'cover' => base_url() . $r['cover'],
                'isbn' => $r['isbn'],

            );
        }
        if ($data) {
            $this->response(
                [
                    'success' => true,
                    'message' => 'Data buku berhasil didapatkan',
                    'data' => $data
                ],
                RestController::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'success' => false,
                    'message' => 'Data tidak ditemukan',
                    'data' => $data
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }
}
