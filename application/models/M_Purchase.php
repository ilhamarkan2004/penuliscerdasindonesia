<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Purchase extends CI_Model
{
    private $t_bp = 'book_purchase';
    private $t_bs = 'book_sell';
    private $t_bc = 'book_contributors';
    private $t_books = 'books';

    public function getCountPurhase($id_book)
    {
        $this->db->select('id')
            ->from($this->t_bp)
            ->where(['book_id' => $id_book]);
        return $this->db->get()->num_rows();
    }

    public function getPublishBook($id_book)
    {
        $this->db->select('publish_at')
            ->from($this->t_bs)
            ->where(['book_id' => $id_book]);
        return $this->db->get()->row_array();
    }

    public function getBookPublish($user_id = null)
    {
        $this->db->select('*, books.id as id_b, book_sell.id as id_bs')
            ->from($this->t_bs)
            ->join($this->t_books, 'books.id = book_sell.book_id')
            ->join($this->t_bc, 'books.id = book_contributors.book_id');
        if ($user_id != null) {
            $this->db->where(['book_contributors.user_id' => $user_id]);
        }
        return $this->db->get();
    }
}
