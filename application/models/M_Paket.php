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
        return $this->db->get();
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

        return $this->db->get();
    }

    public function getUkuranBuku($id_size = null)
    {
        $this->db->select('*')
            ->from($this->t_book_sizes);
        if ($id_size != null) {
            $this->db->where(['book_size_id' => $id_size]);
        }
        return $this->db->get()->result_array();
    }

    public function postPaket($param)
    {
        $data = [
            'paket_name' => $param['name'],
            'copy_num' => $param['copy'],
            'is_active' => $param['status'],
            'service' => '[{"fasilitas": ""}]'
        ];
        $this->db->insert('pakets', $data);
        return [
            'success' => true
        ];
    }

    public function postHargaPaket($param)
    {
        $data = [
            'paket_id' => $param['iP'],
            'harga' => $param['price'],
            'book_size_id' => $param['jenis_kertas']
        ];
        $this->db->insert('paket_harga', $data);
        return [
            'success' => true
        ];
    }

    public function deletePaket($id_paket)
    {
        $this->db->where('id', $id_paket);
        $this->db->delete('pakets');
        return [
            'success' => true
        ];
    }

    public function deleteHargaPaket($id_harga_paket)
    {
        $this->db->where('id', $id_harga_paket);
        $this->db->delete('paket_harga');
        return [
            'success' => true
        ];
    }

    public function putPaket($param)
    {
        $data = [
            'paket_name' => $param['name'],
            'copy_num' => $param['copy'],
            'is_active' => $param['status']
        ];
        $this->db->where('id', $param['iP']);
        $this->db->update('pakets', $data);
        return [
            'success' => true
        ];
    }

    public function putHargaPaket($param)
    {
        $data = [
            'paket_id' => $param['iP'],
            'harga' => $param['price'],
            'book_size_id' => $param['jenis_kertas']
        ];
        $this->db->where('id', $param['iK']);
        $this->db->update('paket_harga', $data);
        return [
            'success' => true
        ];
    }

    public function putService($param)
    {
        $data = [
            'service' => $param['fasilitas']
        ];
        $this->db->where('id', $param['id']);
        $this->db->update('pakets', $data);
        return [
            'success' => true
        ];
    }
}