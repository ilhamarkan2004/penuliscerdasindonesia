<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cloud_viewer'); // Memuat library Cloud_viewer yang telah Anda buat
    }

    public function view_file()
    {
        $fileurl = 'http://localhost/penuliscerdas/public/uploads/buku/revisi%206%20asessment%20tuna%20grahita%20+cover.epub'; // Ganti dengan URL file Anda
        $filetype = 'epub'; // Opsi, bisa diganti dengan 'auto' atau format yang sesuai
        $quality = 'high-resolution'; // Opsi, bisa diganti dengan 'low-resolution'

        $viewer_link = $this->cloud_viewer->generate_viewer_link($fileurl, $filetype, $quality);

        var_dump($viewer_link);
    }
}
