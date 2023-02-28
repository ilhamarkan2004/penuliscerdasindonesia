<?php

class Paket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Paket', 'm_paket');


        if ($this->session->userdata('id_user') == null) {
            redirect('auth');
        }

        if ($this->m_auth->cekUserAktif($this->session->userdata('id_user')) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        // print_r($user['user_group_id']);exit;
        if ($user['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
            redirect('dashboard');
        }
    }

    // ========== HALAMAN ==========
    public function index()
    {

        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Paket';
        $data['url'] = 'paket';
        $data['sub_title'] = 'Daftar Paket yang Tersedia';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end
        viewAdmin($this, 'admin/paket', $data);
    }

    public function hargaKertas($id = null)
    {

        // print_r($this->m_paket->getPaket($id)->num_rows());
        // exit;
        //nanti cek kalo id nya gk ada
        if ($id === null) {
            redirect('paket');
        } elseif ($this->m_paket->getPaket($id)->num_rows() == 0) {
            redirect('paket');
        } else {
            $paket = $this->m_paket->getPaket($id)->row_array();

            //data sidebar & navbar || start
            $currentUser = $this->m_auth->getCurrentUser();
            $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
            $data['user_group_id'] = $currentUser['role_id'];


            $data['title'] = 'Harga';
            $data['url'] = 'paket';
            $data['sub_title'] = 'Harga Paket : ' . $paket['paket_name'];
            $data['menu'] = $menu;
            $data['user'] = $currentUser;
            $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
            $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

            // data sidebar & navbar || end

            $data['jenis_ukuran'] = $this->m_paket->getUkuranBuku();
            $data['nama_paket'] = $paket['paket_name'];
            $data['id_paket'] = $paket['id'];
            // print_r($data['jenis_buku'][0]);
            // die;


            // //Data Statis
            // $data['jenisDaftar'] = ["Personal", "Rombongan"];
            // $data['jenisPelatihan'] = ['Offline', 'Online'];
            viewAdmin($this, 'admin/paketHarga', $data);
        }
    }
    // ========== END ==========


    // ========== DATATABLES ==========
    public function getPaket()
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_paket->getPaket();
        // var_dump($tes);
        // die;
        $data = [];

        foreach ($query->result_array() as $key => $r) {

            $data[] = array(
                'no' => $key + 1,
                'name' => $r['paket_name'],
                // 'copy_num' => $r['copy_num'],
                'is_active' => $this->textStatus($r['is_active']),
                'service' => '<button type="button" id="' . $r['id'] . '" class="btn btn-success btn-sm fasilitas">Layanan</button>',
                'action' => '
                <a target="_blank" href="' . base_url() . 'paket/hargaKertas/' . $r['id'] . '" class="btn btn-info btn-sm detailPaket"><i class="fa-solid fa-circle-info"></i></a>
                <button type="button" id="' . $r['id'] . '" class="btn btn-primary btn-sm edtPaket"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id'] . '" class="btn btn-danger btn-sm delPaket"><i class="fa-solid fa-trash"></i></button>'
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
    }
    public function getHargaPaket()
    {
        $param = $this->input->post();
        // print_r($param);
        // die;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_paket->getHargaPaket($param['id']);

        $data = [];

        foreach ($query->result_array() as $key => $r) {

            $data[] = array(
                'no' => $key + 1,
                'name' => $r['paket_name'],
                'copy' => $r['copy_num'],
                'harga' => "Rp." . number_format($r['harga'], 0, '', '.'),
                'action' => '
                <button type="button" id="' . $r['id_paket_harga'] . '" class="btn btn-primary btn-sm edtHargaPaket"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['id_paket_harga'] . '" class="btn btn-danger btn-sm delHargaPaket"><i class="fa-solid fa-trash"></i></button>'
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
    }
    // ========== END ==========


    // ========== CRUD ===========

    public function detailPaket()
    {
        $param = $this->input->post();
        $id_paket = $param['id'];
        if ($id_paket == null) {
            $result = [
                'success' => false,
                'message' => 'id paket tidak ada'
            ];
        } else {
            $proses = $this->m_paket->getPaket($id_paket)->row_array();
            $result = [
                'success' => true,
                'message' => $proses
            ];
        }
        echo json_encode($result);
    }

    public function detailHargaPaket()
    {
        $param = $this->input->post();
        $id_harga_paket = $param['id'];
        if ($id_harga_paket == null) {
            $result = [
                'success' => false,
                'message' => 'id paket tidak ada'
            ];
        } else {
            $proses = $this->m_paket->getHargaPaket(null, $id_harga_paket)->row_array();
            $result = [
                'success' => true,
                'message' => [
                    'id' => $proses['id_paket_harga'],
                    'copy' => $proses['copy_num'],
                    'harga' => $proses['harga']
                ]
            ];
        }
        echo json_encode($result);
    }

    public function aksiPaket()
    {
        $rules = [
            [
                'field' => 'name',
                'label' => 'nama paket',
                'rules' => 'required|max_length[100]'
            ],

        ];
        $this->form_validation->set_rules($rules);

        $param = $this->input->post();

        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } elseif ($this->form_validation->run() == false) {
            $result = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'name_error' => strip_tags(form_error('name')),
                    // 'copy_error' => strip_tags(form_error('copy')),
                ]
            ];
        }
        // elseif ($param['copy'] <= 0) {
        //     $result = [
        //         'success' => false,
        //         'message' => [
        //             'alert_type' => 'classic',
        //             'copy_error' => 'Jumlah eksemplar tidak boleh kurang dari 1 eksemplar',
        //         ]
        //     ];
        // } 
        else {
            if ($param['iP'] == '') {
                $proses = $this->m_paket->postPaket($param);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Jenis paket baru berhasil ditambahkan'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => 'Kesalahan database'
                    ];
                }
            } else {
                $proses = $this->m_paket->putPaket($param);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Paket "' . $param['name'] . '" berhasil diubah'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => 'Kesalahan database'
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function aksiHargaPaket()
    {

        $param = $this->input->post();

        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } elseif (trim($param['copy']) == '') {
            $result = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'copy_error' => 'Jumlah eksemplar belum diisi',
                ]
            ];
        } elseif (trim($param['price']) == '') {
            $result = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'price_error' => 'Harga belum terisi',
                ]
            ];
        } elseif (trim($param['price']) < 0) {
            $result = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'price_error' => 'Harga tidak boleh kurang dari 0 rupiah',
                ]
            ];
        } else {
            if ($param['iK'] == '') {
                $proses = $this->m_paket->postHargaPaket($param);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Jenis harga berhasil ditambahkan'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => 'Kesalahan database'
                    ];
                }
            } else {
                $proses = $this->m_paket->putHargaPaket($param);
                if ($proses['success']) {
                    $result = [
                        'success' => true,
                        'message' => 'Berhasil diubah'
                    ];
                } else {
                    $result = [
                        'success' => false,
                        'message' => 'Kesalahan database'
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function deletePaket()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $id_paket = $this->input->post()['id'];
            $proses = $this->m_paket->deletePaket($id_paket);
            if ($proses['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil hapus data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        echo json_encode($array);
    }

    public function deleteHargaPaket()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $id_harga_paket = $this->input->post()['id'];
            $proses = $this->m_paket->deleteHargaPaket($id_harga_paket);
            if ($proses['success']) {
                $array = [
                    'success' => true,
                    'message' => 'Berhasil hapus data'
                ];
            } else {
                $array = [
                    'success' => false,
                    'message' => 'Gagal hapus data'
                ];
            }
        }
        echo json_encode($array);
    }

    public function putService()
    {
        $param = $this->input->post();
        // print_r(json_decode($param['data']));
        // die;
        if ($param == null) {
            redirect(base_url('custom404'));
        } else {
            $arrMateri = array_column($param['data'], 'value');
            // $arrMateriName = array_column($param['data'], 'name');
            $myarray = array();
            $fslt = [];
            foreach ($arrMateri as $am) {
                if (strlen(trim($am, " ")) == 0) {
                    $array = [
                        'success' => false,
                        'message' => 'Tidak dapat diisi hanya dengan spasi'
                    ];
                    echo json_encode($array);
                    die;
                } elseif (strlen($am) < 5 || strlen($am) > 255) {
                    $array = [
                        'success' => false,
                        'message' => 'List materi setidaknya terdapat 5 karakter dan paling banyak 255 karakter'
                    ];
                    echo json_encode($array);
                    die;
                }
                $myarray['fasilitas'] = $am;
                $fslt[] = $myarray;
            };

            $data = [
                'id' => $param['id'],
                'fasilitas' => json_encode($fslt),
            ];


            $result = $this->m_paket->putService($data);
            if ($result['success']) {
                $array = [
                    'success' => true,
                    'icon' => 'success',
                    'message' => 'Berhasil mengubah fasilitas'
                ];
            } else {
                $array = [
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Gagal mengubah fasilitas'
                ];
            }

            echo json_encode($array);
        }
    }
    // ========== END ===========

    private function textStatus($status_code)
    {
        switch ($status_code) {
            case 1:
                return '<p>Aktif</p>';
                break;
            case 0:
                return '<p>Tidak Aktif</p>';
                break;
        }
    }
}
