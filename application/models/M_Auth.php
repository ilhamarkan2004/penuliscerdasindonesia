<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    private $_table = "users";
    private $tableB = 'user_groups';
    const SESSION_KEY = 'id_user';


    public function getCurrentUser()
    {
        $this->db->select('*')
            ->from($this->_table)
            ->where(['id' => $this->session->userdata('id_user')]);
        return $this->db->get()->row_array();
    }

    public function cekUserAktif($id_user)
    {
        $this->db->select('is_active')
            ->from($this->_table)
            ->where(['id' => $id_user, 'is_active' => '1']);
        return $this->db->get()->num_rows();
    }

    // tools

    public function getIDRole($nama_role)
    {
        $this->db->select('*')
            ->from($this->tableB)
            ->where(['group' => $nama_role]);
        return $this->db->get()->row_array();
    }

    // REGISTRASI
    public function insertUsers($users)
    {
        $this->db->insert('users', $users);
    }

    public function insertUserReferral($user_referral)
    {
        $this->db->insert('user_referral', $user_referral);
    }

    public function logout()                                // buat unset session
    {
        $this->session->unset_userdata('id_user');
        return !$this->session->has_userdata('id_user');
    }

    public function login($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users');
    }

    public function cekEmail($email)
    {
        $this->db->select('email, id')
            ->from($this->_table)
            ->where(['email' => $email]);
        return $this->db->get()->num_rows();
    }

    public function cekTelp($no_hp)
    {
        $this->db->select('phone, id')
            ->from($this->_table)
            ->where(['phone' => $no_hp]);
        return $this->db->get()->num_rows();
    }

    public function getIdUserReferral($referral_code)
    {
        $this->db->select('referral_code, id')
            ->from($this->_table)
            ->where(['referral_code' => $referral_code]);
        return $this->db->get();
    }
}
