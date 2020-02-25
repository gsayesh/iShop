<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_Actions extends CI_Controller {

	public function new_item()
	{
		$results = $this->Stock_Model->item_last_id();
		$this->load->view('stock/add_new_item',['result'=>$results]);
	}

	public function new_item_add(){
		$data = array(
			'item_code' => $this->input->post('itemcode'),
			'item_name' => $this->input->post('itemname'),
			'item_description' => $this->input->post('itemdesc'),
			'cost' => $this->input->post('itemcost'),
			'whole_sale_price' => $this->input->post('itemwsprice'), 
			'retail_price' => $this->input->post('itemrprice'), 
			'status' => 'active');

		$this->form_validation->set_rules('itemcode','Item Code','trim|required|xss_clean');
		$this->form_validation->set_rules('itemname','Item Name','trim|required|xss_clean');
		$this->form_validation->set_rules('itemdesc','Description','trim|required|xss_clean');
		$this->form_validation->set_rules('itemcost','Cost','trim|required|xss_clean');
		$this->form_validation->set_rules('itemwsprice','Whole Sale Price','trim|required|xss_clean');
		$this->form_validation->set_rules('itemrprice','Retail Price','trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			$this->new_item();
		}else{
			$this->Stock_Model->new_item_in($data);
			$this->session->set_flashdata('submit_success','Data Inserted Successfully..!');
			redirect('Stock_Actions/new_item');
		}
	}

	function item_search()
	{
		$output = '';
		$query = '';
		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		$data = $this->Stock_Model->search_data($query);
		$output .= '
		<div class="table-responsive">
					<table class="table">
						<tr class="thead-light">
							<th class="col">#</th>
							<th class="col">Item Code</th>
							<th class="col">Item Name</th>
							<th class="col">Description</th>
							<th class="col">Cost</th>
							<th class="col">Whole Sale Price</th>
							<th class="col">Retail Price</th>
							<th class="col">Actions</th>
						</tr>
		';
		if($data->num_rows() > 0)
		{
			$i=1;
			foreach($data->result() as $row)
			{
				$output .= '
						<tr>
							<td>'.$i++.'</td>
							<td>'.$row->item_code.'</td>
							<td>'.$row->item_name.'</td>
							<td>'.$row->item_description.'</td>
							<td>'.$row->cost.'</td>
							<td>'.$row->whole_sale_price.'</td>
							<td>'.$row->retail_price.'</td>
							<td>
							<a href="one_item/'.$row->item_code.'" class="btn btn-primary ">Edit</a>
                  			<a href="del_item/'.$row->item_code.'" class="btn btn-danger ">Delete</a>
                  			</td>
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							<td colspan="5">No Data Found</td>
						</tr>';
		}
		$output .= '</table></div>';
		echo $output;
	}

	public function all_item_view()
	{
		//$results = $this->Stock_Model->viewAll_items();
		$this->load->view('stock/view_all_item');
	}

	public function one_item($id)
	{
		$results = $this->Stock_Model->view_item($id);
		$this->load->view('stock/update_item',['result'=>$results]);
	}

	public function edited_item($id)
	{
		$data = array(
			'item_name' => $this->input->post('itemname'),
			'item_description' => $this->input->post('itemdesc'),
			'cost' => $this->input->post('itemcost'),
			'whole_sale_price' => $this->input->post('itemwsprice'), 
			'retail_price' => $this->input->post('itemrprice'));
		
		$this->Stock_Model->item_update($id,$data);
		$this->session->set_flashdata('update_success','Item Updated Successfully..!');
		redirect('Stock_Actions/one_item/'.$id);
		//$this->one_item($id);
	}

	public function del_item($id)
	{
		$this->Stock_Model->item_delete($id);
		$this->session->set_flashdata('delete_success','Item Deleted Successfully..!');
		redirect('Stock_Actions/all_item_view');
		//$this->one_item($id);
	}

	public function profile_stk()
	{
		$uid = $this->session->userdata('user_id');
		$results = $this->Stock_Model->view_profile($uid);
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
			
		$this->Stock_Model->profile_update($uid,$data);
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Stock_Actions/profile_stk');
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
	
		$this->Stock_Model->profile_update($uid,$data);
		$this->session->set_flashdata('password_success','Password matched ..!');
		$this->session->set_flashdata('update_success','Profile Updated Successfully..!');
		redirect('Stock_Actions/profile_stk');	
		}else if($pass != $cpass){
		$this->session->set_flashdata('password_fail','Password does not matched ..!');
		redirect('Stock_Actions/profile_stk');	
		}
	}


	function stock_search()
	{
		$output = '';
		$query = '';
		$branch = '';
		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		if($this->input->post('branch'))
		{
			$branch = $this->input->post('branch');
		}

		if($branch == 'main'){
			$data = $this->Stock_Model->stock_data1($query);
		}else if($branch == 'branch_1'){
			$data = $this->Stock_Model->stock_data2($query);
		}else if($branch == 'branch_2'){
			$data = $this->Stock_Model->stock_data3($query);
		}

		$output .= '
		<div class="table-responsive">
					<table class="table">
						<tr class="thead-light">
							<th class="col">#</th>
							<th class="col">Item Code</th>
							<th class="col">Item Name</th>
							<th class="col">Description</th>
							<th class="col">Whole Sale Price</th>
							<th class="col">Retail Price</th>
							<th class="col">Quantity</th>
						</tr>
		';
		if($data->num_rows() > 0)
		{
			$i=1;
			foreach($data->result() as $row)
			{
				$output .= '
						<tr>
							<td>'.$i++.'</td>
							<td>'.$row->item_code.'</td>
							<td>'.$row->item_name.'</td>
							<td>'.$row->item_description.'</td>
							<td>'.$row->whole_sale_price.'</td>
							<td>'.$row->retail_price.'</td>
							<td>'.$row->stock.'</td>
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							<td colspan="5">No Data Found</td>
						</tr>';
		}
		$output .= '</table></div>';
		echo $output;
	}

	public function all_stock_view()
	{
		$this->load->view('stock/view_all_stock');
	}

	function item_search_stock()
	{
		$output = '';
		$query = '';
		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		$data = $this->Stock_Model->search_data($query);
		$output .= '
		<div class="table-responsive">
					<table class="table">
						<tr class="thead-light">
							<th class="col">#</th>
							<th class="col">Item Code</th>
							<th class="col">Item Name</th>
							<th class="col">Description</th>
							<th class="col">Whole Sale Price</th>
							<th class="col">Retail Price</th>
							<th class="col">Actions</th>
						</tr>
		';
		if($data->num_rows() > 0)
		{
			$i=1;
			foreach($data->result() as $row)
			{
				$output .= '
						<tr>
							<td>'.$i++.'</td>
							<td>'.$row->item_code.'</td>
							<td>'.$row->item_name.'</td>
							<td>'.$row->item_description.'</td>
							<td>'.$row->whole_sale_price.'</td>
							<td>'.$row->retail_price.'</td>
							<td>
							<a href="temp_main_add/'.$row->item_code.'" class="btn btn-primary ">Add</a>
                  			</td>
                  			
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							<td colspan="5">No Data Found</td>
						</tr>';
		}
		$output .= '</table></div>';
		echo $output;
	}

	public function item_stock_add()
	{
		//$results = $this->Stock_Model->new_items_view() view_item($id);
		$this->load->view('stock/add_item_stock');
	}

	public function temp_main_view()
	{
		$results = $this->Stock_Model->temp_items_view();
		$res_grn = $this->Stock_Model->grn_no();
		$new_grn_no = array();
		array_push($new_grn_no, $res_grn);

		$this->load->view('stock/update_stock',['result'=>$results,'res'=>$new_grn_no]);
	}

	public function temp_main_add($id)
	{
		$data = array(
			'item_code' => $id);
		$this->Stock_Model->temp_items_in($data);
		$this->session->set_flashdata('add_success','Item Added Successfully..!');
		$results = $this->Stock_Model->temp_items_view();
		$this->load->view('stock/update_stock',['result'=>$results]);
	}

	public function temp_main_del($id)
	{
		$this->Stock_Model->temp_item_remove($id);
		$this->session->set_flashdata('remove_success','Item Remove Successfully..!');
		$results = $this->Stock_Model->temp_items_view();
		$this->load->view('stock/update_stock',['result'=>$results]);
	}

	public function update_main_stock()
	{
		$temp_data = $this->input->post('temp_table');
		$basic_data = $this->input->post('basic_data');

		$status = $this->Stock_Model->add_main_items($temp_data, $basic_data);

		$this->output->set_content_type('application/json');
		echo json_encode(array('status' => $status));
	}
}
?>