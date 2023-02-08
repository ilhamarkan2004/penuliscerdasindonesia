<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Book extends CI_Model
{
    private $t_books = 'books';
    private $t_bc = 'book_contributors';
    private $t_op = 'order_progress';
    private $t_order = 'order';
    private $t_bs = 'book_sell';

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

    public function getStep($id_step = null)
    {
        $this->db->select('*')
            ->from($this->t_op);
        if ($id_step != null) {
            $this->db->where(['id' => $id_step]);
        }
        return $this->db->get();
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

    public function deleteBook($id_book, $ref_file)
    {
        $this->db->trans_start();

        if (file_exists('./' . $ref_file && $ref_file != '')) {
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
}
