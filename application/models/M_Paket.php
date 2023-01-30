<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Paket extends CI_Model
{
    private $t_paket = 'pakets';
    private $t_paket_harga = 'paket_harga';
    private $t_book_sizes = 'book_sizes';

    public function getPaket($id_paket = null)
    {
        $this->db->select('*')
            ->from($this->t_paket);
        if ($id_paket !== null) {
            $this->db->where(['id' => $id_paket]);
        }
        return $this->db->get()->result_array();
    }

    public function getHargaPaket($id_paket = null, $id_paket_harga = null)
    {
        $this->db->select('*, book_sizes.title as book_sizes_title, pakets.id as id_pakets, paket_harga.id as id_paket_harga')
            ->from($this->t_paket_harga)
            ->order_by('harga', 'ASC')
            ->join($this->t_book_sizes, 'book_sizes.id = paket_harga.book_size_id')
            ->join($this->t_paket, 'pakets.id = paket_harga.paket_id');
        if ($id_paket !== null) {
            $this->db->where(['paket_id' => $id_paket]);
        }
        if ($id_paket_harga !== null) {
            $this->db->where(['paket_harga.id' => $id_paket_harga]);
        }

        return $this->db->get()->result_array();
    }
}
