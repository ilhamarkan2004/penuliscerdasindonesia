<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Book extends CI_Model
{
    private $t_books = 'books';
    private $t_bc = 'book_contributors';
    private $t_bcr = 'book_contributors_role';
    private $t_op = 'order_progress';
    private $t_order = 'order';
    private $t_bs = 'book_sell';
    private $t_bsp = 'book_sell_publisher';
    private $t_cat = 'book_category';
    private $t_lang = 'book_language';
    private $t_br = 'book_rating';
    private $t_bp = 'book_purchase';
    private $t_bpi = 'book_purchase_item';

    public function getBooks($id_book = null, $id_user = null, $uuid = null)
    {
        $this->db->select('*, books.id as id_b, book_contributors.id as id_bc, order_progress.id as id_op, books.created_at as b_created_at, books.update_at as b_update_at')
            ->from($this->t_books)
            ->order_by("books.update_at", "desc")
            ->join($this->t_bc, 'books.id = book_contributors.book_id')
            ->join($this->t_order, 'books.id = order.book_id')
            ->join($this->t_op, 'order_progress.id = order.progress_id');
        if ($id_user != null) {
            $this->db->where(['book_contributors.user_id' => $id_user]);
        }
        if ($id_book != null) {
            $this->db->where(['books.id' => $id_book]);
        }
        if ($uuid != null) {
            $this->db->where(['books.uuid' => $uuid]);
        }
        $this->db->order_by("books.update_at", "desc");
        return $this->db->get();
    }

    public function getBookSellable()
    {
        $idPublish  = $this->getIDProgress('Publish')['id'];
        $this->db->select('*, books.id as id_b')
            ->from($this->t_order)
            ->join($this->t_books, 'books.id = order.book_id')
            ->where(['progress_id' => $idPublish]);
        return $this->db->get();
    }

    public function getBookCategory()
    {
        $this->db->select('*')
            ->from($this->t_cat);
        return $this->db->get()->result_array();
    }
    public function getBookLanguage()
    {
        $this->db->select('*')
            ->from($this->t_lang);
        return $this->db->get()->result_array();
    }

    public function getBookPublisher()
    {
        $this->db->select('*')
            ->from($this->t_bsp);
        return $this->db->get()->result_array();
    }

    public function getBooksUsingStatus($progress_id)
    {
        $this->db->select('*, books.id as ib_b')
            ->from($this->t_books)
            ->join($this->t_order, 'order.book_id = books.id')
            ->where(['order.progress_id >=' => $progress_id]);
        return $this->db->get();
    }

    public function getStep($id_step = null)
    {
        $this->db->select('*')
            ->from($this->t_op);
        if ($id_step != null) {
            $this->db->where(['id' => $id_step]);
        }
        return $this->db->get();
    }

    public function getProgressUseName($status_name)
    {
        $this->db->select('id')
            ->from($this->t_op)
            ->where(['status' => $status_name]);
        return $this->db->get()->row_array();
    }

    public function getSellBooks($id_book_sell = null)
    {
        $this->db->select('*, books.id as id_b, book_sell.id as id_bs, book_sell_publisher.id as id_bsp, book_sell.update_at as update_at_bs, books.update_at as update_at_b')
            ->from($this->t_bs)
            ->join($this->t_books, 'book_sell.book_id = books.id')
            ->join($this->t_bsp, 'book_sell.publisher_id = book_sell_publisher.id');

        if ($id_book_sell != null) {
            $this->db->where(['book_sell.id' => $id_book_sell]);
        }

        return $this->db->get();
    }

    public function postSell($param)
    {
        $this->db->trans_start();

        $data = [
            'book_id' => $param['book'],
            'publisher_id' => $param['pub'],
            'sell_price' => $param['price'],
        ];

        //set id column value as UUID
        $this->db->set('uuid', 'UUID()', FALSE);

        $this->db->insert($this->t_bs, $data);

        $data = [
            'category_id' => $param['category'],
            'language_id' => $param['lang'],
            'num_page' => $param['num_page'],
        ];
        $this->db->where(['id' => $param['book']]);
        $this->db->update($this->t_books, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function putSell($param)
    {
        $this->db->trans_start();

        $data = [
            'book_id' => $param['book'],
            'publisher_id' => $param['pub'],
            'sell_price' => $param['price'],
        ];
        $this->db->where(['id' => $param['iS']]);
        $this->db->update($this->t_bs, $data);

        $data = [
            'category_id' => $param['category'],
            'language_id' => $param['book'],
            'num_page' => $param['num_page'],
        ];
        $this->db->where(['id' => $param['book']]);
        $this->db->update($this->t_books, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function deleteSell($id_sell)
    {
        $this->db->trans_start();


        $this->db->delete($this->t_bs, ['id' => $id_sell]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function putBookProgress($param)
    {
        $this->db->trans_start();
        $data1 = [
            'note_admin' => $param['catatan'],
            'isbn' => $param['isbn'],
        ];
        $this->db->where('id', $param['iB']);
        $this->db->update('books', $data1);

        $data2 = [
            'progress_id' => $param['progress'],
            'status_progres' => $param['status_code'],
        ];
        $this->db->where('book_id', $param['iB']);
        $this->db->update('order', $data2);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function putBookCover($param)
    {
        $this->db->trans_start();
        $data1 = [
            'cover' => $param['url_cover']
        ];
        $this->db->where('id', $param['iB2']);
        $this->db->update('books', $data1);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function putBookNaskah($param)
    {
        $this->db->trans_start();
        $data1 = [
            'naskah' => $param['url_naskah']
        ];
        $this->db->where('id', $param['iB3']);
        $this->db->update('books', $data1);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function deleteBook($id_book, $ref_file)
    {
        $this->db->trans_start();

        if (file_exists('./' . $ref_file)  && $ref_file != '') {
            unlink(FCPATH . $ref_file);
        }
        $this->db->delete($this->t_bc, ['book_id' => $id_book]);
        $this->db->delete($this->t_order, ['book_id' => $id_book]);
        $this->db->delete($this->t_bs, ['book_id' => $id_book]);
        $this->db->delete($this->t_books, ['id' => $id_book]);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }




    //private
    public function getIDProgress($nama_progress)
    {
        $this->db->select('id')
            ->from('order_progress')
            ->where(['status' => $nama_progress]);
        return $this->db->get()->row_array();
    }

    // cek
    public function cekBookSell($book_id)
    {
        $this->db->select('id')
            ->from($this->t_bs)
            ->where(['book_id' => $book_id]);
        return $this->db->get()->num_rows();
    }

    public function cekContributor($book_id, $user_id, $role)
    {
        $this->db->select('id')
            ->from($this->t_bc)
            ->where(
                [
                    'book_id' => $book_id,
                    'user_id' => $user_id,
                    'contributor_role_id' => $role
                ]
            );
        return $this->db->get()->num_rows();
    }

    public function cekUUID($uuid, $progress_id = null)
    {
        $this->db->select('books.id')
            ->from($this->t_books)
            ->where(['uuid' => $uuid]);
        if ($progress_id != null) {
            $this->db->join($this->t_order, 'order.book_id = books.id')
                ->where(['order.progress_id >=' => $progress_id]);
        }
        return $this->db->get()->num_rows();
    }


    public function getContributor($jenis_kontributor = null)
    {
        $this->db->select('*')
            ->from('book_contributors_role');
        if ($jenis_kontributor != null) {
            $this->db->where(['role_name' => $jenis_kontributor]);
        }
        return $this->db->get();
    }

    public function getLastProgress()
    {
        $this->db->select('*')
            ->from($this->t_op)
            ->order_by('id', 'DESC');
        return $this->db->get()->row_array();
    }

    public function getISBN($book_id)
    {
        $this->db->select('isbn')
            ->from($this->t_books)
            ->where(['id' => $book_id]);
        return $this->db->get()->row_array();
    }


    //Update buku

    private function getIdRole($nama_role)
    {
        $this->db->select('*')
            ->from($this->t_bcr)
            ->where(['role_name' => $nama_role]);
        return $this->db->get()->row_array();
    }

    public function getContributorBook($id_buku, $id_role = null)
    {
        $this->db->select('*')
            ->from('book_contributors')
            ->join('users', 'users.id = book_contributors.user_id')
            ->where(['book_id' => $id_buku]);
        if ($id_role != null) {
            $this->db->where(['contributor_role_id' => $id_role]);
        }
        return $this->db->get()->result_array();
    }

    public function putBookAll($param = null)
    {
        $this->load->model('M_Auth', 'm_auth');

        $this->db->trans_start();

        //put book
        $this->putBook($param);

        //delete kontributor
        $this->db->delete($this->t_bc, ['book_id' => $param['id_book']]);

        //post kontributor
        $book_id = $param['id_book'];
        $this->postKontributor($book_id, $param['user_id'], $this->getIdRole('PJ')['id']);

        foreach ($param['writer'] as $e_writer) {
            $user_id = $this->m_auth->getIdFromEmail($e_writer)['id'];
            $this->postKontributor($book_id, $user_id, $this->getIdRole('Penulis')['id']);
        }

        foreach ($param['editor'] as $e_editor) {
            $user_id = $this->m_auth->getIdFromEmail($e_editor)['id'];
            $this->postKontributor($book_id, $user_id, $this->getIdRole('Editor')['id']);
        }

        foreach ($param['tata_letak'] as $e_tata_letak) {
            $user_id = $this->m_auth->getIdFromEmail($e_tata_letak)['id'];
            $this->postKontributor($book_id, $user_id, $this->getIdRole('Tata Letak')['id']);
        }

        foreach ($param['designer'] as $e_designer) {
            $user_id = $this->m_auth->getIdFromEmail($e_designer)['id'];
            $this->postKontributor($book_id, $user_id, $this->getIdRole('Desain Cover')['id']);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil menambahkan data'
            ];
        }
    }

    private function putBook($param)
    {
        $dataPendaftaranUtama = [
            'title' => $param['title'],
            'description' => $param['desc'],
            'reader_cover' => $param['pembaca'],
            'note_cover' => $param['catatCover'],
            'is_cover' => $param['is_cover'],
            'is_kdt' => $param['is_kdt'],
            'cover' => $param['url_cover'],
            'naskah' => $param['url_berkas'],
            'book_size_id' => $param['id_kertas']

        ];
        $this->db->where(['id' => $param['id_book']]);
        $this->db->update($this->t_books, $dataPendaftaranUtama);
    }

    private function postKontributor($book_id, $user_id, $role_id)
    {
        $dataKontributor = [
            'book_id' => $book_id,
            'user_id' => $user_id,
            'contributor_role_id' => $role_id
        ];
        $this->db->insert($this->t_bc, $dataKontributor);
    }




    ///////// BUAT API //////////

    public function getBookSell($uuid = null)
    {
        $this->db->select('*, book_sell.uuid as bs_uuid, books.uuid as b_uuid')
            ->from($this->t_bs)
            ->join($this->t_books, 'book_sell.book_id = books.id');
        if ($uuid != null) {
            $this->db->where(['book_sell.uuid' => $uuid]);
        }
        return $this->db->get();
    }

    public function getComment($bs_uuid)
    {
        $id_book = $this->getIDFromUUID($bs_uuid)->row_array()['book_id'];
        $this->db->select('*, users.created_at as u_created_at, book_rating.created_at as br_created_at')
            ->from($this->t_br)
            ->join('users', 'book_rating.user_id = users.id')
            ->where(['book_id' => $id_book]);
        return $this->db->get()->result_array();
    }

    public function postComment($param)
    {
        $id_book = $this->getIDFromUUID($param['uuid'])->row_array()['book_id'];

        $this->db->trans_start();

        $data = [
            'book_id' => $id_book,
            'user_id' => $param['user_id'],
            'comment' => $param['comment'],
            'rating' => $param['rating'],
        ];

        //set id column value as UUID
        $this->db->set('uuid', 'UUID()', FALSE);

        $this->db->insert($this->t_br, $data);

        $accumulate_rating = (float)array_sum(array_column($this->getComment($param['uuid']), 'rating'));

        $data = [
            'sum_rating' => $accumulate_rating,
        ];
        $this->db->where(['id' => $id_book]);
        $this->db->update($this->t_books, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal tambah comment'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil tambah comment'
            ];
        }
    }

    //ambil id buku dari tabel book_Sell
    public function getIDFromUUID($bs_uuid)
    {
        $this->db->select('book_id')
            ->from($this->t_bs)
            ->where(['uuid' => $bs_uuid]);
        return $this->db->get();
    }

    public function getListBookOrder($arr_id_book)
    {
        $this->db->select('*')
            ->from($this->t_books)
            ->where_in('id', $arr_id_book);
        return $this->db->get()->result_array();
    }

    public function getPriceListBookOrder($arr_uuid)
    {
        $this->db->select_sum('sell_price')
            ->from($this->t_bs)
            ->where_in('uuid', $arr_uuid);
        return $this->db->get()->row_array();
    }

    public function getPurchase($id_order = null, $id_user = null)
    {
        $this->db->select('*')
            ->from($this->t_bp);
        if ($id_order != null) {
            $this->db->where(['order_id' => $id_order]);
        }
        if ($id_user != null) {
            $this->db->where(['user_id' => $id_user]);
        }
        return $this->db->get();
    }

    public function getPurchaseBook($id_order)
    {
        $this->db->select('*')
            ->from($this->t_bpi)
            ->join('books', 'books.id = book_purchase_item.book_id')
            ->where(['bp_order_id' => $id_order]);
        return $this->db->get()->result_array();
    }

    public function postPurchase($dataPurchase, $listBookId)
    {
        $this->db->trans_start();

        //Masukin ke tabel book_purchase
        $this->db->insert($this->t_bp, $dataPurchase);

        //Masukkan data ke tabel book_purchase_item
        foreach ($listBookId as $book_id) {
            $data = [
                'bp_order_id' => $dataPurchase['order_id'],
                'book_id' => $book_id,
            ];
            $this->db->insert($this->t_bpi, $data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika menambahkan data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil menambahkan data'
            ];
        }
    }

    public function putPurchase($result)
    {
        $this->db->trans_start();
        $dataOrder = [
            'status_code' => $result['status_code'],
        ];
        $this->db->where(['id_order' => $result['order_id']])
            ->update($this->tableD, $dataOrder);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil'
            ];
        }
    }

    //param['id_order] && param['b_uuid]
    public function getListBuyBook($id_user, $param = null)
    {
        $this->db->select('*, books.uuid as b_uuid')
            ->from($this->t_bp)
            ->join($this->t_bpi, 'book_purchase_item.bp_order_id = book_purchase.order_id')
            ->join($this->t_books, 'book_purchase_item.book_id = books.id')
            ->where(['book_purchase.user_id' => $id_user]);

        if ($param != null) {
            $this->db->where([
                'book_purchase.order_id' => $param['id_order'],
                'books.uuid' => $param['b_uuid'],
                'book_purchase.status_code' => '200'
            ]);
        }
        return $this->db->get();
    }
}
