<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud_viewer {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function generate_viewer_link($fileurl, $filetype = 'auto', $quality = 'low-resolution')
    {
        $base_url = 'http://www.ofoct.com/viewer/viewer_url.php';
        $params = array(
            'fileurl' => $fileurl,
            'filetype' => $filetype,
            'quality' => $quality
        );

        $url = $base_url . '?' . http_build_query($params);
        return $url;
    }
}
