<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	public function profile_cas()
	{
		$uid = $this->session->userdata('user_id');
		$results = $this->Common_Model->view_profile($uid);
		$this->load->view('cashier/cas_profile',['result'=>$results]);
	}

	public function cas_edited_profile($uid)
	{

		$pass = $this->input->post('pass');
		$cpass = $this->input->post('cpass');
		if($pass == '' && $cpass == ''){
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'));
			
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_cas');
		//$this->one_item($id);
		}else if($pass == $cpass){
		$enccpass = md5($cpass);
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'),
			'password' => $enccpass);
	
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('password_success','Password matched ..!');
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_cas');	
		}else if($pass != $cpass){
		$this->session->set_flashdata('password_fail','Password does not matched ..!');
		redirect('Common/profile_cas');	
		}
	}


	public function profile_adn()
	{
		$uid = $this->session->userdata('user_id');
		$results = $this->Common_Model->view_profile($uid);
		$this->load->view('admin/adn_profile',['result'=>$results]);
	}

	public function adn_edited_profile($uid)
	{

		$pass = $this->input->post('pass');
		$cpass = $this->input->post('cpass');
		if($pass == '' && $cpass == ''){
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'));
			
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_adn');
		//$this->one_item($id);
		}else if($pass == $cpass){
		$enccpass = md5($cpass);
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'),
			'password' => $enccpass);
	
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('password_success','Password matched ..!');
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_adn');	
		}else if($pass != $cpass){
		$this->session->set_flashdata('password_fail','Password does not matched ..!');
		redirect('Common/profile_adn');	
		}
	}

	public function profile_stk()
	{
		$uid = $this->session->userdata('user_id');
		$results = $this->Common_Model->view_profile($uid);
		$this->load->view('stock/stk_profile',['result'=>$results]);
	}

	public function edited_profile($uid)
	{

		$pass = $this->input->post('pass');
		$cpass = $this->input->post('cpass');
		if($pass == '' && $cpass == ''){
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'));
			
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_stk');
		//$this->one_item($id);
		}else if($pass == $cpass){
		$enccpass = md5($cpass);
		$data = array(
			'first_name' => $this->input->post('userfname'),
			'last_name' => $this->input->post('userlname'),
			'nic' => $this->input->post('usernic'),
			'address' => $this->input->post('address'), 
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'contact_no' => $this->input->post('telno'),
			'password' => $enccpass);
	
		$this->Common_Model->profile_update($uid,$data);
		$this->session->set_flashdata('password_success','Password matched ..!');
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Common/profile_stk');	
		}else if($pass != $cpass){
		$this->session->set_flashdata('password_fail','Password does not matched ..!');
		redirect('Common/profile_stk');	
		}
	}

}
?>