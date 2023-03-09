<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
    private $_table = "users";
    private $tableB = 'user_groups';
    const SESSION_KEY = 'id_user';


    public function provinsi()
    {
        $query = $this->db->query("SELECT * FROM ref_provinsi ORDER BY nama_provinsi ASC");
        return $query->result_array();
    }
    public function kabupaten($id_prov = null)
    {
        $this->db->select("*")
            ->from('ref_kabupaten_kota');
        if ($id_prov != null) {
            $this->db->where(['ref_provinsi_id' => $id_prov]);
        }
        return $this->db->get()->result_array();
    }

    public function getCurrentUser()
    {
        $this->db->select('*')
            ->from($this->_table)
            ->where(['id' => $this->session->userdata('id_user')]);
        return $this->db->get()->row_array();
    }

    public function getUsers()
    {
        $id_role_user = $this->getIDRole('User')['id'];
        $this->db->select('*')
            ->from($this->_table)
            ->where(['role_id' => $id_role_user]);
        return $this->db->get();
    }

    public function cekUserAktif($id_user)
    {
        $this->db->select('is_active')
            ->from($this->_table)
            ->where(['id' => $id_user, 'is_active' => '1']);
        return $this->db->get()->num_rows();
    }

    public function cekUserAktifEmail($email)
    {
        $this->db->select('is_active')
            ->from($this->_table)
            ->where(['email' => $email]);
        return $this->db->get()->row_array();
    }

    public function getIdFromEmail($email)
    {
        $this->db->select('id')
            ->from($this->_table)
            ->where(['email' => $email]);
        return $this->db->get()->row_array();
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

    public function putProfile($param)
    {
        $this->db->trans_start();
        $data = [
            'name' => $param['name'],
            'description' => $param['desc'],
            'img_profile' => $param['url_img'],
            'phone' => $param['telp']
        ];
        $this->db->where('id', $this->session->userdata('id_user'));
        $this->db->update('users', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika update data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function putPass($param)
    {
        $this->db->trans_start();
        $data = [
            'password' => password_hash($param['newPass'], PASSWORD_DEFAULT)
        ];
        $this->db->where('id', $param['user_id']);
        $this->db->update('users', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika update data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function getVerifyEmail($id_user)
    {
        $this->db->select('uuid, verify_code')
            ->from($this->_table)
            ->where(['id' => $id_user]);
        return $this->db->get()->row_array();
    }

    public function getDefaultValue($key)
    {
        $this->db->select('value')
            ->from('default_value')
            ->where(['key' => $key]);
        return $this->db->get()->row_array();
    }

    public function cekActivate($uuid, $verify_code)
    {
        $this->db->select('uuid')
            ->from('users')
            ->where(
                [
                    'uuid' => $uuid,
                    'verify_code' => $verify_code
                ]
            );
        return $this->db->get()->num_rows();
    }

    public function activateAccount($uuid, $verify_code)
    {
        // set default timezone
        date_default_timezone_set('Asia/Jakarta'); // CDT
        $this->db->trans_start();
        $data = [
            'is_active' => '1',
            'email_verified_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where(['users.uuid' => $uuid, 'users.verify_code' => $verify_code]);
        $this->db->update('users', $data);
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

    public function postPassReset($data)
    {
        $this->db->trans_start();
        $this->db->insert('password_resets', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal '
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil'
            ];
        }
    }

    public function putPassReset($data)
    {
        $this->db->trans_start();
        $arr = [
            'token' => $data['token']
        ];
        $this->db->where(['user_id' => $data['user_id']]);
        $this->db->update('password_resets', $arr);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal '
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil'
            ];
        }
    }

    public function cekPassReset($user_id = null, $token = null)
    {
        $this->db->select('id')
            ->from('password_resets');
        if ($user_id != null) {
            $this->db->where(['user_id' => $user_id]);
        }
        if ($token != null) {
            $this->db->where(['token' => $token]);
        }
        return $this->db->get()->num_rows();
    }

    public function getUserToken($token)
    {
        $this->db->select('users.id as u_id, users.password, password_resets.token')
            ->from('password_resets')
            ->join($this->_table, 'password_resets.user_id = users.id')
            ->where(['password_resets.token' => $token]);
        return $this->db->get()->row_array();
    }
}
