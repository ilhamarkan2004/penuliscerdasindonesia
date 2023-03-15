<?php

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c_helper');
        $this->load->model('M_Sidebar', 'm_sidebar');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Event', 'm_event');


        if ($this->session->has_userdata('id_user') == false) {
            redirect('auth');
        }

        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        if ($this->m_auth->cekUserAktif($idUserLogin) == 0) {
            $this->session->unset_userdata('id_user');
            redirect('auth');
        }

        $user = $this->m_auth->getCurrentUser();
        // print_r($user['user_group_id']);exit;
        if ($user['role_id'] != $this->m_auth->getIDRole('Admin')['id']) {
            redirect('dashboard');
        }
    }

    // HALAMAN
    public function index()
    {
        //data sidebar & navbar || start
        $currentUser = $this->m_auth->getCurrentUser();
        $menu = $this->m_sidebar->getSidebarMenu($currentUser['role_id']);
        $data['user_group_id'] = $currentUser['role_id'];


        $data['title'] = 'Event';
        $data['url'] = 'event';
        $data['sub_title'] = 'Daftar Event';
        $data['menu'] = $menu;
        $data['user'] = $currentUser;
        $data['idPeserta'] = $this->m_auth->getIDRole('User')['id'];
        $data['idAdmin'] = $this->m_auth->getIDRole('Admin')['id'];

        // data sidebar & navbar || end
        $data['event'] = $this->m_event->getEventType();
        viewAdmin($this, 'admin/event', $data);
    }

    // ========== DATATABLES ==========
    public function getEvent()
    {
        // $ip = $this->input->post()['id'];
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->m_event->getEvents();

        $data = [];

        foreach ($query->result_array() as $key => $r) {

            $data[] = array(
                'no' => $key + 1,
                'event_type' => $r['name_type'],
                'event_name' => '<a class="text-bold" href="' . base_url() . $r['link'] . '">' . $r['event_name'] . '</a>',
                'desc' => $this->textLimit($r['desc']),
                'date' => $r['start_regist'] . ' - ' . $r['end_regist'],
                'is_active' => $this->textStatus($r['status']),
                'action' => '
                <button type="button" id="' . $r['e_id'] . '" class="btn btn-primary btn-sm edtEvent"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" id="' . $r['e_id'] . '" class="btn btn-danger btn-sm delEvent"><i class="fa-solid fa-trash"></i></button>'
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


    public function detailEvent()
    {
        $param = $this->input->post();
        $id_event = $param['id'];
        if ($id_event == null) {
            $result = [
                'success' => false,
                'message' => 'id paket tidak ada'
            ];
        } else {
            $proses = $this->m_event->getEvents($id_event)->row_array();
            $result = [
                'success' => true,
                'message' => $proses
            ];
        }
        echo json_encode($result);
    }

    public function aksiEvent()
    {
        $param = $this->input->post();


        if ($param == []) {
            $result = [
                'success' => false,
                'message' => 'Data inputan tidak ada'
            ];
        } else {

            if (trim($param['event_name']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'name_err' => 'Nama tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['event_type']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'type_err' => 'Tipe acara belum dipilih'
                    ]
                ];
            } elseif (trim($param['desc']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'desc_err' => 'deskripsi tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['start_regist']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'start_err' => 'waktu awal pendaftaran tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['end_regist']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'end_err' => 'waktu akhir pendaftaran tidak boleh kosong'
                    ]
                ];
            } elseif (trim($param['link']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'link_err' => 'link tidak boleh kosong'
                    ]
                ];
            } elseif (!valid_url($param['link']) && trim($param['link']) != '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'link_err' => 'Link tidak valid'
                    ]
                ];
            } elseif (preg_match("/^http/i", $this->input->post('link')) == 0 && trim($param['link']) != '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'link_err' => 'Masukkan URL diawali dengan http:// atau https://'
                    ]
                ];
            } elseif (trim($param['status']) == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'name_err' => 'status tidak boleh kosong'
                    ]
                ];
            } elseif (strtotime($param['start_regist'] . '+ 1 days') < strtotime('now') && $param['iE'] == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'start_err' => 'Tidak dapat memberikan waktu awal sebelum hari ini!'
                    ]
                ];
            } elseif (strtotime($param['end_regist']) < strtotime('now') && $param['iE'] == '') {
                $result = [
                    'success' => false,
                    'message' => [
                        'end_err' => 'Tidak dapat memberikan waktu akhir sebelum hari ini!'
                    ]
                ];
            } elseif ($param['end_regist']  < $param['start_regist']) {
                $result = [
                    'success' => false,
                    'message' => [
                        'end_err' => 'Tidak dapat memberikan waktu akhir sebelum waktu mulai!'
                    ]
                ];
            } else {
                if ($param['iE'] == '') {
                    if (!empty($_FILES['img']['name'])) {

                        $nama_file = $_FILES['img']['name'];

                        if (!in_array(substr($_FILES['img']['name'], -4), [".jpg", "jpeg", ".png"])) {
                            $array = [
                                'success' => false,
                                'message' => [
                                    'alert_type' => 'swal',
                                    'message' => 'Tipe file yang dapat diupload adalah jpg, jpeg, png'
                                ]
                            ];
                            echo json_encode($array);
                            die;
                        } else {
                            $root_folder = './public/uploads/event';

                            $files = uploadImage2('img', 'event', 'event_upload');

                            $param['url_img'] = $files['file_name'];
                            // print_r($param);
                        }
                    } else {
                        $param['url_img'] = '';
                    }

                    // print_r($_FILES['img']['name']);
                    // die;

                    $proses = $this->m_event->postEvent($param);
                    if ($proses['success']) {
                        $result = [
                            'success' => true,
                            'message' => 'Event baru berhasil ditambahkan'
                        ];
                    } else {
                        $result = [
                            'success' => false,
                            'message' => 'Kesalahan database'
                        ];
                    }
                } else {
                    $ref_file = $this->m_event->getEvents($param['iE'])->row_array()['img'];
                    if (!empty($_FILES['img']['name'])) {

                        $nama_file = $_FILES['img']['name'];

                        if (!in_array(substr($_FILES['img']['name'], -4), [".jpg", "jpeg", ".png"])) {
                            $array = [
                                'success' => false,
                                'message' => [
                                    'alert_type' => 'swal',
                                    'message' => 'Tipe file yang dapat diupload adalah jpg, jpeg, png'
                                ]
                            ];
                            echo json_encode($array);
                            die;
                        } else {
                            $root_folder = './public/uploads/event';
                            // if (!file_exists('./' . $root_folder)) {
                            //     mkdir($root_folder, 775);
                            // }
                            $files = uploadImage2('img', 'event', 'event_upload');
                            $param['url_img'] = $files['file_name'];
                            // print_r($param);
                        }
                    } else {
                        $param['url_img'] = $ref_file;
                    }

                    $proses = $this->m_event->putEvent($param);
                    if ($proses['success']) {

                        if (file_exists('./' . $ref_file) && !empty($_FILES['img']['name']) && $ref_file != '') {
                            unlink(FCPATH . $ref_file);
                        }
                        $result = [
                            'success' => true,
                            'message' => 'Event berhasil diubah'
                        ];
                    } else {
                        $result = [
                            'success' => false,
                            'message' => 'Kesalahan database'
                        ];
                    }
                }
            }
        }
        echo json_encode($result);
    }

    public function deleteEvent()
    {
        if ($this->input->post() == null) {
            $array = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        } else {
            $ref_file = $this->m_event->getEvents($this->input->post()['id'])->row_array()['img'];

            $id_event = $this->input->post()['id'];
            $proses = $this->m_event->deleteEvent($id_event, $ref_file);
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

    private function textLimit($text)
    {
        if (strlen($text) > 30) {
            return substr($text, 0, 30) . '...';
        } else {
            return $text;
        }
    }
}
