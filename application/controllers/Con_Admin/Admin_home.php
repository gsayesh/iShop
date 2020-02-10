<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        $this->user_id = $this->session->userdata('user_id');
        if (!$this->user_id) {
            redirect('auth');
        }

        $this->data['user_id'] = $this->session->userdata('user_id');
        $this->data['username'] = $this->session->userdata('username');
    }
    
    public function index() { 

        $this->load->view('index',$this->data);
    }
}