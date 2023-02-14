<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Book extends CI_Model
{
    private $t_books = 'books';
    private $t_bc = 'book_contributors';
    private $t_op = 'order_progress';
    private $t_order = 'order';
    private $t_bs = 'book_sell';
    private $t_bsp = 'book_sell_publisher';
    private $t_cat = 'book_category';
    private $t_lang = 'book_language';

    public function getBooks($id_book = null, $id_user = null)
    {
        $this->db->select('*, books.id as id_b, book_contributors.id as id_bc, order_progress.id as id_op')
            ->from($this->t_bc)
            ->join($this->t_books, 'books.id = book_contributors.book_id')
            ->join($this->t_order, 'books.id = order.book_id')
            ->join($this->t_op, 'order_progress.id = order.progress_id');
        if ($id_user != null) {
            $this->db->where(['book_contributors.user_id' => $id_user]);
        }
        if ($id_book != null) {
            $this->db->where(['books.id' => $id_book]);
        }
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

    public function getBookSell()
    {
        $this->db->select('*')
            ->from($this->t_bs);
        return $this->db->get()->result_array();
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
        $this->db->insert($this->t_bs, $data);

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

    private function getIDProgress($nama_progress)
    {
        $this->db->select('id')
            ->from('order_progress')
            ->where(['status' => $nama_progress]);
        return $this->db->get()->row_array();
    }

    public function cekBookSell($book_id)
    {
        $this->db->select('id')
            ->from($this->t_bs)
            ->where(['book_id' => $book_id]);
        return $this->db->get()->num_rows();
    }
}
