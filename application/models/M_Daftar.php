<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Daftar extends CI_Model
{
    private $t_books = 'books';
    private $t_kontributor = 'book_contributors';
    private $t_kontributor_role = 'book_contributors_role';
    private $t_order = 'order';
    private $t_user = 'users';


    public function cekIdOrder($id_order)
    {
        $this->db->select('id_order')
            ->from($this->t_order)
            ->where(['id_order' => $id_order]);
        return $this->db->get()->num_rows();
    }

    private function getIdRole($nama_role)
    {
        $this->db->select('*')
            ->from($this->t_kontributor_role)
            ->where(['role_name' => $nama_role]);
        return $this->db->get()->row_array();
    }

    // DAFTAR 
    public function postDaftar($param = null, $id_order = null)
    {
        $this->load->model('M_Auth', 'm_auth');

        $this->db->trans_start();

        //post book
        $book_id = $this->postBook($param);

        //post order
        $this->postOrder($id_order, $param, $book_id);

        //post kontributor
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

        //update users
        $this->putPointUser($param['point'], $param['user_id']);

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

    private function postBook($param)
    {
        $dataPendaftaranUtama = [
            'title' => $param['title'],
            'description' => $param['desc'],
            'reader_cover' => $param['pembaca'],
            'note_cover' => $param['catatCover'],
            'paket_harga_id' => $param['id_paket_harga'],
            'is_cover' => $param['is_cover'],
            'is_kdt' => $param['is_kdt'],
            'cover' => $param['url_cover'],
            'naskah' => $param['url_berkas'],
            'book_size_id' => $param['id_kertas'],
            'book_paper_id' => $param['id_jk'],
            'ref_provinsi_id' => $param['provinsi_id'],
            'ref_kota_id' => $param['kabupaten_id'],
            'alamat_kirim' => $param['alamat']

        ];
        $this->db->insert($this->t_books, $dataPendaftaranUtama);
        $last_id_book = $this->db->insert_id();
        return $last_id_book;
    }

    private function postOrder($id_order, $param, $book_id)
    {
        $dataOrder = [
            'id_order' => $id_order,
            'gross_amount' => $param['total'],
            'jenis' => $param['jenis'],
            'book_id' => $book_id,
            // 'user_id_pj' => $param['user_id']
        ];
        $this->db->insert($this->t_order, $dataOrder);
    }

    private function postKontributor($book_id, $user_id, $role_id)
    {
        $dataKontributor = [
            'book_id' => $book_id,
            'user_id' => $user_id,
            'contributor_role_id' => $role_id
        ];
        $this->db->insert($this->t_kontributor, $dataKontributor);
    }

    private function putPointUser($point, $id_user)
    {
        $dataPointUser = [
            'point' => $point,
        ];
        $this->db->where(['id' => $id_user]);
        $this->db->update($this->t_user, $dataPointUser);
    }
}
