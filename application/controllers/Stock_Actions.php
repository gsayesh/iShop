<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_Actions extends CI_Controller {

	public function dashboard()
	{
		
		$record = $this->Stock_Model->chart_data();
      	$data = [];
 
      	foreach($record as $row) {
            $data['label'][] = 'Main_Stock';
            $data['label2'][] = 'Branch_1';
            $data['label3'][] = 'Branch_2';
            $data['data'][] = (int) $row->main;
            $data['data2'][] = (int) $row->branch1;
            $data['data3'][] = (int) $row->branch2;
      	}
      	$data['chart_data'] = json_encode($data);
      	$_SESSION['results']=$record;
      	$this->load->view('stock/stk_dash',$data);
	}

	public function new_item()
	{

		$type = "";

		if ($this->input->get('type')) {
			$type = $this->input->get('type');
		}

		$retrive_data = $this->Stock_Model->item_last_id($type);

		$new_item_no = array();

		$new_item_no['type'] = $type;
		$new_item_no['code'] = $retrive_data;

		$this->load->view('stock/add_new_item',['results'=>$new_item_no]);
	}


	
	// public function new_item_number(){

		

	// 	$results = $this->Stock_Model->item_last_id("mobile");

	// 	$new_item_no = array();
	// 	array_push($new_item_no, $results);

	// 	redirect('stock/add_new_item');
	// }

	public function new_item_add(){
		//to genetrate qrcode
			$data['img_url']="";
			$params['savename']="";
			if($this->input->post('action') && $this->input->post('action') == "generate_qrcode")
			{
				$this->load->library('ciqrcode');
				$qr_image=rand().'.png';
				$params['data'] = $this->input->post('itemcode');
				$params['level'] = 'H';
				$params['size'] = 8;
				$params['savename'] ="public/assets/qr_image/".$qr_image;
				if($this->ciqrcode->generate($params))
				{
					$data['img_url']=$qr_image;	
				}
			}
		//save item to database	
		$data = array(
			'item_code' => $this->input->post('itemcode'),
			'item_name' => $this->input->post('itemname'),
			'item_description' => $this->input->post('itemdesc'),
			'cost' => $this->input->post('itemcost'),
			'whole_sale_price' => $this->input->post('itemwsprice'), 
			'retail_price' => $this->input->post('itemrprice'),
			'category' => $this->input->post('cat'),  
			'status' => 'active',
			'qr_code' => $params['savename']);

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
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Item Code</th>
								<th scope="col">Item Name</th>
								<th scope="col">Description</th>
								<th scope="col">Cost</th>
								<th scope="col">Whole Sale Price</th>
								<th scope="col">Retail Price</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
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
							<a href="one_item/'.$row->item_code.'" ><i class="fa fa-edit fa-lg"></i></a>
                  			<a href="del_item/'.$row->item_code.'" ><i class="fa fa-remove fa-lg" style="color:red;"></i></a>
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
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Item Code</th>
								<th scope="col">Item Name</th>
								<th scope="col">Description</th>
								<th scope="col">Whole Sale Price</th>
								<th scope="col">Retail Price</th>
								<th scope="col">Quantity</th>
							</tr>
						</thead>
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
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Item Code</th>
								<th scope="col">Item Name</th>
								<th scope="col">Description</th>
								<th scope="col">Whole Sale Price</th>
								<th scope="col">Retail Price</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
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
		//$this->load->view('stock/add_item_stock');
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
		$data = array('item_code' => $id);
		$this->Stock_Model->temp_items_in($data);
		$this->session->set_flashdata('add_success','Item Added Successfully..!');
		$results = $this->Stock_Model->temp_items_view();
		$res_grn = $this->Stock_Model->grn_no();
		$new_grn_no = array();
		array_push($new_grn_no, $res_grn);
		$this->load->view('stock/update_stock',['result'=>$results,'res'=>$new_grn_no]);
	}

	public function temp_main_del($id)
	{
		$this->Stock_Model->temp_item_remove($id);
		$this->session->set_flashdata('remove_success','Item Remove Successfully..!');
		$results = $this->Stock_Model->temp_items_view();
		$res_grn = $this->Stock_Model->grn_no();
		$new_grn_no = array();
		array_push($new_grn_no, $res_grn);
		$this->load->view('stock/update_stock',['result'=>$results,'res'=>$new_grn_no]);
	}

	public function update_main_stock()
	{
		$temp_data = $this->input->post('temp_table');
		$basic_data = $this->input->post('basic_data');

		$status = $this->Stock_Model->add_main_items($temp_data, $basic_data);

		$this->output->set_content_type('application/json');
		echo json_encode(array('status' => $status));
	}

	public function orders_pending()
	{
		$results = $this->Stock_Model->orders_pending_data();
		$this->load->view('stock/pending_orders',['res'=>$results]);
	}

	public function stock_request()
	{
		$results = $this->Common_Model->stock_low();
		$billno = $this->Stock_Model->sup_bill_no();
		
		$this->load->view('stock/request_stock',['res'=>$results,'bill'=>$billno]);
	}


	public function stock_request_send()
	{
		$userName = $this->session->userdata('username');
		$userTyp = $this->session->userdata('usertype');

		$billno = $this->input->post('billno');
		$recname = $this->input->post('recname');
		$recmail = $this->input->post('recmail');
		$comname = $this->input->post('comname');
		$sdate = $this->input->post('sdate');
		$itemch = $this->input->post('itemch[]');


		$mailinfo = array('sbill_no' => $billno,
						'recipient_name' => $recname,
						'recipient_mail' => $recmail,
						'company_name' => $comname,
						'deliver_date' => $sdate );

		$this->Stock_Model->mail_info_insert($mailinfo);

		//$msgdata = array('sbill_no' => $billno);
		$sub = "Request to Place an Order"; 
		$msg = "";
		$msg .= "Dear Sir/Madam,\n\n \tHope that this e-mail finds you well.I would like to place an order for some of your products. We are using your products till today. We have not received any complaints from our clients regarding the products that your company manufactures.\n\tKeeping that in mind, we would like to make sure that our relationship keeps getting stronger. I would like to place an order of following products.\n\n\tItem_Code\tItem_Name\tQuantity\n";
		foreach($itemch as $itemc){
			$itemname = $this->input->post('itemname_'.$itemc);
			$newqty = $this->input->post('qty_'.$itemc);

			$msg .= "\t".$itemc."\t".$itemname."\t".$newqty."\n";
			
			$msgdata[] = array('sbill_no' => $billno,
							'item_code' => $itemc,
							'item_name' => $itemname, 
							'new_qty' => $newqty);
		}
		$msg.="\nI wish to receive them in about 1 week time.Thank you for your generous behavior.\n\nThank You,\n".$userName."\n".$userTyp."\nThis is a system generated request mail.Please contact us for futher information .";
		$this->Stock_Model->mail_stock_insert($msgdata);

		$this->load->config('email');
		$from = $this->config->item('smtp_user');
		$this->email->from($from);
		$this->email->to($recmail);
		$this->email->subject($sub);
		$this->email->message($msg.".");
		if($this->email->send()){
            $this->session->set_flashdata("email_done","Congratulation...! Email Send Successfully.");
            redirect('Stock_Actions/stock_request');
		}else{
         	 /*$this->session->set_flashdata("email_fail","You have encountered an error");
        	 redirect('Stock_Actions/stock_request');*/
            show_error($this->email->print_debugger());
        }

	}

	public function qr_print_view(){
		$results = $this->Stock_Model->qr_print_data();
		$this->load->view('stock/print_qr',['result'=>$results]);
	}

	public function qr_print_search(){

		$output = '';
		$query = '';
		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		$data = $this->Stock_Model->qr_search_data($query);
		$output .= '
		<form id="frm-send" action="'.base_url("Stock_Actions/qr_print_pdf").'" method="POST">
		<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col"></th>
			  					<th scope="col">#</th>
			  					<th scope="col">Item Code</th>
			  					<th scope="col">Item Name</th>
			  					<th scope="col">QR Code</th>
			  					<th scope="col">Quantity</th>
							</tr>
						</thead>
		';
		if($data->num_rows() > 0)
		{
			$i=1;
			foreach($data->result() as $row)
			{
				$output .= '
						<tr>
							<tr>
								<td><input name="itemch[]" value="'.$row->item_code.'" id="itemch[]" type="checkbox" /></td>
			  					<td>'.$i++.'</td>
			  					<td>'.$row->item_code.'</td>
			  					<td>'.$row->item_name.'
			  						<input type="hidden" name="itemname_'.$row->item_code.'" id="qtynew" value="'.$row->item_name.'">
			  					</td>
			  					<td>
			  						<img src="'.base_url($row->qr_code).'" alt="QR Code" width="100" height="100"/>
			  						<input type="hidden" name="qrcode_'.$row->item_code.'" value="'.$row->qr_code.'" />
			  					</td>
			  					<td><input type="Number" name="qty_'.$row->item_code.'" id="qtynew" min="0" max="21"></td>
							</tr>
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
		$output .= '</table></div><button class="btn btn-warning">Print</button>';
		echo $output;

	}

	public function qr_print_pdf(){
		$itemch = $this->input->post('itemch[]');
		//$pdfdata = "";
		$datapdf = array();
		foreach($itemch as $itemc){
			$itemname = $this->input->post('itemname_'.$itemc);
			$newqty = $this->input->post('qty_'.$itemc);
			$itemcode = $this->input->post('qrcode_'.$itemc);
			//$pdfdata .= "\t".$itemc."\t".$itemname."\t".$itemcode."\t".$newqty."\n";
			


			$datapd = array('item_code' => $itemc,
							'item_name' => $itemname,
							'qrpath' => $itemcode,
							'new_qty' => $newqty);
			array_push($datapdf, $datapd);
		}
		// echo $pdfdata;
		//var_dump($datapdf);

		$pdf = new QRPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage('L');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->QRTable($datapdf);
		$pdf->SetAutoPageBreak(true);
		$pdf->Output();
	}

	
	public function orders_approve(){



    }

}
?>