<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $s_login = $this->session->userdata('s_login');
        if (isset($s_login['login_status'])) {
            if ($s_login['login_status'] != '1')
                redirect('login/logout');
        }else {
            redirect('register');
        }
    }

}