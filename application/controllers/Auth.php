<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
		$this->load->model('Auth_Model');
    }

	public function login(){

		try {
			$response = array('success' => false);

            $userid = ($this->input->post('username')) ? $this->input->post('username') : '';
			$password = ($this->input->post('password')) ? $this->input->post('password') : '';

            $result = $this->Auth_Model->login_user($userid, $password);
            //Load Userinfo from the Model
            if ($result) {
                //Navigate User to Related View
                if($result['position'] == 'Admin'){
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['first_name']);

                    $this->load->view('includes/header');
                    $this->load->view('admin/a_main');

                }else if($result['position'] == 'Cashier'){
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['first_name']);

                    $this->load->view('includes/header');
                    $this->load->view('cashier/c_main');

                }else if($result['position'] == 'Skeeper'){
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['first_name']);

                    $this->load->view('includes/header');
                    $this->load->view('stock/s_main');
                }
            } else {
                $response['message'] = 'Incorrect user id or password';
                redirect('Welcome', 'refresh');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}

    public function logout(){
        $this->session->unset_userdata('user_id');
        redirect(base_url().'Welcome');
    }

}
?>