<?php
class Custom404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['inisial'] = '-';
        $this->output->set_status_header('404');
        $this->load->view('errorsCustom/404', $data);
    }
}
