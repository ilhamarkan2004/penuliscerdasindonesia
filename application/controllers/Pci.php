<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pci extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->model('M_Auth', 'm_auth');
        $this->load->model('M_Paket', 'm_paket');
        $this->load->model('M_Daftar', 'm_daftar');
        $this->load->model('M_Event', 'm_event');
        $this->load->helper('c_helper');
    }

    public function index()
    {
        $pakets = array_slice(multi_unique_array($this->m_paket->getHargaPaket(null, null, 1)->result_array(), 'paket_id'), 0, 2);
        $data['event'] = $this->m_event->getEventType();
        $data['title'] = 'Home';
        $data['paket'] = $pakets;
        $data['cs'] = $this->m_auth->getDefaultValue('no_hp')['value'];
        viewUser($this, 'user/pages/home', $data);
    }

    public function terbit()
    {

        $data['paket'] = multi_unique_array($this->m_paket->getHargaPaket(null, null, '1')->result_array(), 'paket_id');
        $data['event'] = $this->m_event->getEventType();
        $data['title'] = 'Pilihan Paket';
        $data['cs'] = $this->m_auth->getDefaultValue('no_hp')['value'];

        viewUser($this, 'user/pages/terbit_buku', $data);
    }

    public function form()
    {
        if (!array_key_exists('id_paket', $this->input->post())) {
            redirect(base_url());
        } else {
            $id_paket = $this->input->post()['id_paket'];

            $data['currentUser'] = $this->m_auth->getCurrentUser();
            $data['paket'] = $this->m_paket->getPaket($id_paket)->result_array()[0];
            $data['harga_paket'] = $this->m_paket->getHargaPaket($data['paket']['id'])->result_array();
            $data['kertas'] = $this->m_paket->getUkuranKertas()->result_array();
            $data['jk'] = $this->m_paket->getJenisKertas()->result_array();
            $data['title'] = $data['paket']['paket_name'];
            $data['fasilitas'] = json_decode($data['paket']['service']);
            $data['event'] = $this->m_event->getEventType();
            $data['provinsi'] = $this->m_auth->provinsi();
            $data['kabupaten'] = $this->m_auth->kabupaten();

            viewUser($this, 'user/pages/form', $data);
        }
    }

    public function submit_form()
    {

        $param = $this->input->post();
        // print_r($param);
        // die;
        $idUserLogin = $this->m_auth->getIdUserFromUUID($this->session->userdata('id_user'))['id'];
        $param['user_id'] = $idUserLogin;
        $admin = $this->m_auth->getAdmin()->row_array();
        $emailAdmin = array(0 => $admin['email']);

        $rules = [
            [
                'field' => 'title',
                'label' => 'Judul',
                'rules' => 'required|max_length[100]|min_length[1]'
            ],
            [
                'field' => 'desc',
                'label' => 'Deskripsi',
                'rules' => 'required|min_length[50]'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required|max_length[255]'
            ],

        ];

        $this->form_validation->set_rules($rules);

        if (count($param['editor']) == 1 && trim($param['editor'][0]) == '') {
            $param['editor'] = array_replace($param['editor'], $emailAdmin);
        }
        if (count($param['designer']) == 1 && trim($param['designer'][0]) == '') {
            $param['designer'] = array_replace($param['designer'], $emailAdmin);
        }
        if (count($param['tata_letak']) == 1 && trim($param['tata_letak'][0]) == '') {
            $param['tata_letak'] = array_replace($param['designer'], $emailAdmin);
        }

        // var_dump($param['editor']);
        // var_dump($emailAdmin);
        // die;
        if ($this->form_validation->run() == false) {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'title_error' => strip_tags(form_error('title')),
                    'desc_error' => strip_tags(form_error('desc')),
                    'alamat_error' => strip_tags(form_error('alamat')),
                ]
            ];
        } elseif (trim($param['id_paket_harga']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'paket_harga_error' => 'Jumlah ekemplar belum dipilih'

                ]
            ];
        } elseif (trim($param['id_kertas']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'kertas_error' => 'Ukuran kertas belum dipilih'

                ]
            ];
        } elseif (trim($param['id_jk']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'jk_error' => 'Jenis kertas belum dipilih'

                ]
            ];
        } elseif (trim($param['is_cover']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'is_cover_error' => 'Mohon memilih salah satu'

                ]
            ];
        } elseif ($param['is_cover'] == '1' && trim($param['pembaca']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'pembaca_error' => 'Segmen pembaca tidak boleh kosong'

                ]
            ];
        } elseif ($param['is_cover'] == '1' && trim($param['catatCover']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'catat_cover_error' => 'Catatan permintaan cover tidak boleh kosong'
                ]
            ];
        } elseif ($this->cekEmailAll($param['writer'], $param['editor'], $param['designer'], $param['tata_letak']) == false) {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'swal',
                    'message' => 'Terdapat email penulis atau kontributor yang tidak diketahui'
                ]
            ];
        } elseif (trim($param['is_kdt']) == '') {
            $message = [
                'success' => false,
                'message' => [

                    'alert_type' => 'classic',
                    'is_kdt_error' => 'Kebutuhan KDT belum dipilih'

                ]
            ];
        } elseif (trim($param['provinsi_id']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'alamat_error' => 'Alamat belum lengkap'

                ]
            ];
        } elseif (trim($param['kabupaten_id']) == '') {
            $message = [
                'success' => false,
                'message' => [
                    'alert_type' => 'classic',
                    'alamat_error' => 'Alamat belum lengkap'

                ]
            ];
        } else {
            // Upload cover
            if (!empty($_FILES['cover']['name'])) {

                $nama_file = $_FILES['cover']['name'];

                if (!in_array(substr($_FILES['cover']['name'], -4), [".jpg", "jpeg", ".png"])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'upload_cover_error' => 'Tipe file yang dapat diupload adalah jpg, jpeg, png'
                        ]
                    ];
                    echo json_encode($array);
                    die;
                } else {
                    $root_folder = './public/uploads/cover';
                    // if (!file_exists('./' . $root_folder)) {
                    //     mkdir($root_folder, 775);
                    // }
                    $files = uploadImage2('cover', 'cover', 'cover_upload');
                    $param['url_cover'] = $files['file_name'];
                    // print_r($param);
                }
            } else {
                if ($param['is_cover'] == '0') {
                    $message = [
                        'success' => false,
                        'message' => [
                            'alert_type' => 'classic',
                            'upload_cover_error' => 'cover belum diupload'

                        ]
                    ];
                    echo json_encode($message);
                    die;
                } else {
                    $param['url_cover'] = '';
                }
            }

            // Upload berkas
            if (!empty($_FILES['berkas']['name'])) {

                $nama_file = $_FILES['berkas']['name'];

                if (!in_array(substr($_FILES['berkas']['name'], -4), [".pdf", ".doc", "docx", '.ppt', 'pptx'])) {
                    $array = [
                        'success' => false,
                        'message' => [
                            'alert_type' => 'classic',
                            'berkas_error' => 'Tipe file yang dapat diupload adalah pdf, doc, docx, ppt, pptx'
                        ]
                    ];
                    echo json_encode($array);
                    die;
                } else {
                    $root_folder = './public/uploads/berkas';
                    // if (!file_exists('./' . $root_folder)) {
                    //     mkdir($root_folder, 775);
                    // }
                    $files = uploadBerkas('berkas', 'berkas', 'berkas_upload', null, 'pdf|doc|docx|ppt|pptx');
                    $param['url_berkas'] = $files['file_name'];
                    // print_r($param);
                }
            } else {
                $message = [
                    'success' => false,
                    'message' => [
                        'alert_type' => 'classic',
                        'berkas_error' => 'Berkas naskah belum diupload'

                    ]
                ];
                echo json_encode($message);
                die;
            }



            $param['total'] = $this->m_paket->getHargaPaket(null, $param['id_paket_harga'])->result_array()[0]['harga'] - $this->m_auth->getCurrentUser()['point'];
            $param['jenis'] = 'Manual';
            //setting id order
            $id_order = time() + rand(4, 7);
            if ($this->m_daftar->cekIdOrder($id_order) != 0) {
                $id_order = $id_order + rand(2, 10);
            }
            // print_r($param);
            // die;
            if ($param['total'] < 0) {
                $param['point'] = abs($param['total']);
                $param['total'] = 0;
            } else {
                $param['point'] = '0';
            }



            $proses =  $this->m_daftar->postDaftar($param, $id_order);
            if ($proses['success']) {
                $message = [
                    'success' => true,
                    'message' => [
                        'icon' => 'success',
                        'title' => 'Pendaftaran buku berhasil',
                        'text' => 'Kirimkan bukti pembayaran kepada Customer Service. Anda akan diarahkan secara otomatis setelah menekan tombol "OK"'
                    ],
                    'id' => $id_order
                ];
            } else {
                $message = [
                    'success' => false,
                    'message' => [
                        'alert_type' => 'swal',
                        'message' => 'Proses gagal, ulangi dalam beberapa saat kemudian'
                    ]
                ];
            }
        }
        echo json_encode($message);
    }

    public function event($inisial = null)
    {
        if ($this->m_event->cekInisial($inisial) == 0 || $inisial == null) {
            redirect(base_url());
        } else {
            $data['title'] = 'Event';
            $data['event'] = $this->m_event->getEventType();
            $data['eventDetail'] = $this->m_event->getEventTypeDetail($inisial);
            $data['by_type'] = $this->m_event->getEvents(null, $inisial, 1)->result_array();
            viewUser($this, 'user/pages/event', $data);
        }
    }

    public function daftarISBN($uuid = null)
    {
        $this->load->model('M_Book', 'm_book');
        $statusisbn = $this->m_book->getProgressUseName('isbn')['id'];
        if ($this->m_book->cekUUID($uuid, $statusisbn) == 0 || $uuid == null) {
            redirect('Custom404');
        } else {
            $contributor = $this->m_book->getContributor()->result_array();
            $data['title'] = 'Daftar ISBN';
            $data['event'] = $this->m_event->getEventType();
            $data['bookDetail'] = $this->m_book->getBooks(null, null, $uuid)->row_array();
            $data['contributor'] = $contributor;
            foreach ($contributor as $c) {
                $data[strtolower(str_replace(' ', '', $c['role_name']))] = $this->m_book->getContributorBook($data['bookDetail']['id_b'], $c['id']);
            }
            // $data['by_type'] = $this->m_event->getEvents(null, $inisial, 1)->result_array();
            viewUser($this, 'user/pages/forisbn', $data);
        }
    }



    // Validasi

    public function getHargaPaket()
    {
        $param = $this->input->post();
        if ($param == []) {
            redirect('');
        } else {
            $id_harga = $param['id'];
            $proses = $this->m_paket->getHargaPaket(null, $id_harga)->result_array()[0];
            $result = [
                'harga' => $proses['harga'],
                'eksemplar' => $proses['copy_num'] . ' eksemplar'
            ];

            echo json_encode($result);
        }
    }

    public function cekEmail()
    {
        $param = $this->input->post();
        if ($param == []) {
            redirect('');
        } else {
            $email = $param['email'];
            // print_r($param);
            // die;
            $proses = $this->m_auth->cekEmail($email);
            if ($proses == 0) {
                $result = [
                    'success' => false,
                    'message' => 'Email tidak ditemukan'
                ];
            } else {
                $result = [
                    'success' => true,
                    'message' => 'Email ditemukan'
                ];
            }

            echo json_encode($result);
        }
    }

    private function cekEmailAll($arrPenulis, $arrEditor, $arrDesigner, $arrLayout)
    {
        $result = true;
        foreach ($arrPenulis as $penulis) {
            $proses = $this->m_auth->cekEmail($penulis);
            if ($proses == 0) {
                $result = false;
            }
        }

        foreach ($arrEditor as $editor) {
            $proses = $this->m_auth->cekEmail($editor);
            if ($proses == 0) {
                $result = false;
            }
        }
        foreach ($arrDesigner as $designer) {
            $proses = $this->m_auth->cekEmail($designer);
            if ($proses == 0) {
                $result = false;
            }
        }
        foreach ($arrLayout as $layout) {
            $proses = $this->m_auth->cekEmail($layout);
            if ($proses == 0) {
                $result = false;
            }
        }

        return $result;
    }
}
