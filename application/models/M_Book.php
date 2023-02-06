<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Book extends CI_Model
{
    private $t_books = 'books';
    private $t_bc = 'book_contributors';
    private $t_op = 'order_progress';
    private $t_order = 'order';

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
}
