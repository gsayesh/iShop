<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login(){

		try {

            $userid = ($this->input->post('username')) ? $this->input->post('username') : '';
			$password = ($this->input->post('password')) ? $this->input->post('password') : '';
            $mac = ($this->input->post('mac')) ? $this->input->post('mac') : '';
            
            //Send & Receive Userinfo from the Model
            $result = $this->Auth_Model->login_user($userid, $password);

            //Send & Receive Bracnhinfo from the Model
            $branch_res = $this->Auth_Model->branch($mac);

            if ($result) {
                //Navigate User to Related View
                if($result['position'] == 'Admin'){
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['first_name']);

                    $this->load->view('admin/admin');

                }else if($result['position'] == 'Cashier'){
                    //Check the Login Device
                    if($branch_res){
                        $this->session->set_userdata('user_id', $result['user_id']);
                        $this->session->set_userdata('username', $result['first_name']);
                        $this->session->set_userdata('branch_id', $branch_res['branch_id']);
                        $this->session->set_userdata('branch_name', $branch_res['branch_name']);

                        $this->load->view('cashier/cashier');
                    }else{
                        $this->session->set_flashdata('branch_error','Invalid Device');
                        redirect('Welcome');
                    }
                }else if($result['position'] == 'Skeeper'){
                    if($branch_res){
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['first_name']);
                    $this->session->set_userdata('branch_id', $branch_res['branch_id']);
                    $this->session->set_userdata('branch_name', $branch_res['branch_name']);

                    $this->load->view('stock/s_main');
                    }else{
                        $this->session->set_flashdata('branch_error','Invalid Device');
                        redirect('Welcome');
                    }

                }
            } else {
                $this->session->set_flashdata('login_error','Invalid Username or Password');
                redirect('Welcome');
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