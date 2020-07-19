<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login(){

		try {

			$userid = $this->input->post('username');
			$password = $this->input->post('password');
			$mac = ($this->input->post('em')) ? $this->input->post('em') : '';
			$encPassowrd = md5($password);

			//echo $encPassowrd;
			//$this->load->view('log');

			$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
			$this->form_validation->set_rules('password','Password','trim|required|xss_clean');

			if($this->form_validation->run() == FALSE){
				$this->load->view('log');
			}else{
			   //Send & Receive Userinfo from the Model
				$result = $this->Auth_Model->login_user($userid, $encPassowrd);

				//Send & Receive Bracnhinfo from the Model
				$branch_res = $this->Auth_Model->branch();
				$cbranch_res = $this->Auth_Model->cbranch();


				if ($result) {
				//Navigate User to Related View
					if($result['position'] == 'Admin'){
						$this->session->set_userdata('user_id', $result['user_id']);
						$this->session->set_userdata('username', $result['first_name']);
						$this->session->set_userdata('usertype', $result['position']);

						//remember me
						if ($this->input->post("remember"))
						{
							$this->input->set_cookie('uid', $userid, 86500); /* Create cookie for store userid */
							//$this->input->set_cookie('upass', $password, 86500); /* Create cookie for password */
							//echo "<script>alert('Login Success, Cookies Enabled..!');</script>";
						}
						else
						{
							delete_cookie('uid'); /* Delete email cookie */
							//delete_cookie('upass'); /* Delete password cookie */
							//echo "<script>alert('Login Success..!');</script>";
						}

					//echo $encPassowrd;
						// $this->load->view('admin/admin');
						$this->load->view('admin/adminDashboard');

					}else if($result['position'] == 'Cashier'){
					//Check the Login Device
						if($branch_res['mac'] == $cbranch_res['s_mac']){
							$this->session->set_userdata('user_id', $result['user_id']);
							$this->session->set_userdata('username', $result['first_name']);
							$this->session->set_userdata('branch_id', $branch_res['branch_id']);
							$this->session->set_userdata('branch_name', $branch_res['branch_name']);
							$this->session->set_userdata('usertype', $result['position']);
							//remember me
							if ($this->input->post("remember"))
							{
								$this->input->set_cookie('uid', $userid, 86500); /* Create cookie for store userid */
								//$this->input->set_cookie('upass', $password, 86500); /* Create cookie for password */
							//echo "<script>alert('Login Success, Cookies Enabled..!');</script>";
							}
							else
							{
								delete_cookie('uid'); /* Delete email cookie */
								//delete_cookie('upass'); /* Delete password cookie */
							//echo "<script>alert('Login Success..!');</script>";
							}
						//echo $encPassowrd;
							$this->load->view('cashier/CashUi');
						}else{
							$this->session->set_flashdata('branch_error','Invalid Device');
							redirect('Welcome');
						}
					}else if($result['position'] == 'SManager'){
						if($branch_res['mac'] == $cbranch_res['s_mac']){
							$this->session->set_userdata('user_id', $result['user_id']);
							$this->session->set_userdata('username', $result['first_name']);
							$this->session->set_userdata('branch_id', $branch_res['branch_id']);
							$this->session->set_userdata('branch_name', $branch_res['branch_name']);
							$this->session->set_userdata('usertype', $result['position']);
							//remember me
							if ($this->input->post("remember"))
							{
								$this->input->set_cookie('uid', $userid, 86500); /* Create cookie for store userid */
								//$this->input->set_cookie('upass', $password, 86500); /* Create cookie for password */
							//echo "<script>alert('Login Success, Cookies Enabled..!');</script>";
							}
							else
							{
								delete_cookie('uid'); /* Delete email cookie */
								//delete_cookie('upass'); /* Delete password cookie */
							//echo "<script>alert('Login Success..!');</script>";
							}
					//echo $encPassowrd;
							//$this->load->view('stock/add_new_item');
							redirect('Stock_Actions/item_stock_add');
						}else{
							$this->session->set_flashdata('branch_error','Invalid Device');
							redirect('Welcome');
						}

					}
				} else {
					$this->session->set_flashdata('login_error','Invalid Username or Password');
					redirect('Welcome');
				}
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