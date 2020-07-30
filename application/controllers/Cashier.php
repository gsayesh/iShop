<?php 

class Cashier extends CI_Controller
{

//First load pages

		//At the first time open the page search_product
		function first_load_search_product(){
			$this->load->view('cashier/Item/search_product');
		}

		//At the first time open the page insert_product
		function first_load_insert_product(){

			$branch = "branch1";

			$grnValue = $this->Cashier_Model->get_grn_table();
			$current_grn_no = $this->Cashier_Model->get_grn_no($branch);

			$new_grn_no = array();
			array_push($new_grn_no, $current_grn_no);

			$this->load->view('cashier/Item/insert_product',[ 'data'=>$grnValue , 'new_grn_no'=>$new_grn_no ]);
		}


		//At the first time open the page bill-item
		function first_load_bill(){
			$branch = "branch1";

			$billValue = $this->Cashier_Model->get_temp_bill_table();
			$current_bill_no = $this->Cashier_Model->get_bill_no($branch);

			$new_bill_no = array();
			array_push($new_bill_no, $current_bill_no);

			$this->load->view('cashier/Bill/create_bill',[ 'data'=>$billValue , 'new_bill_no'=>$new_bill_no ]);
		}


		//At the first time open the page srn
		function first_load_srn(){
			$this->load->view('cashier/Bill/return_sale');
		}


		//At the first time open the page request
		function first_load_request(){
			$this->load->view('cashier/Item/request_product');
		}


		//At the first time open the page customer
		function first_load_customer(){
			$this->load->view('cashier/Customer/customer');
		}


		//At the first time open the page debitor
		function first_load_debitor(){
			$this->load->view('cashier/Customer/debitor');
		}



// Start the Item Section

	//Start Stock Handling

		//Show search item
	function search_product()
	{
		  $output = '';
		  $query = '';
		  $store = '';
		  $data = '';

		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		   if($this->input->post('store'))
		  {
		   $store = $this->input->post('store');
		  }


		  if ($store == "My_Shop") {
		  	$data = $this->Cashier_Model->search_in_shop1($query);
		  }
		  elseif ($store == "Main_Store") {
		  	$data = $this->Cashier_Model->search_in_main($query);
		  }
		  elseif ($store == "Other_Branch") {
		  	$data = $this->Cashier_Model->search_in_shop2($query);
		  }

		  $output .= '
		  <div class="table-responsive">
		     <table class="table table-bordered table-striped">
		      <tr>
		       <th>#</th>
		       <th>Product Code</th>
		       <th>Name</th>
		       <th>Description</th>
		       <th>Whole Sale Price</th>
		       <th>Retail Price</th>
		       <th>Quentity</th>
		      </tr>

		  ';
		  if($data->num_rows() > 0)
		  {

		  	$counter = 1;

		   foreach($data->result() as $row)
		   {
		    $output .= '
		      <tr>
		       <td>'.$counter++.'</td>
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
		  $output .= '</table>';
		  echo $output;
	}


	function search_product_insert()
	{
		  $output = '';
		  $query = '';
		  $data = '';

		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  

		  $data = $this->Cashier_Model->search_in_items($query);

		  $output .= '
		  <div class="table-responsive">
		     <table class="table table-bordered table-striped">
		      <tr>
		       <th>#</th>
		       <th>Product Code</th>
		       <th>Name</th>
		       <th>Description</th>
		       <th>Whole Sale Price</th>
		       <th>Retail Price</th>
		       <th>Option</th>
		      </tr>
		  ';
		  if($data->num_rows() > 0)
		  {

		  	$counter = 1;

		   foreach($data->result() as $row)
		   {
		    $output .= '
		      <tr>
		       <td>'.$counter++.'</td>
		       <td>'.$row->item_code.'</td>
		       <td>'.$row->item_name.'</td>
		       <td>'.$row->item_description.'</td>
		       <td>'.$row->whole_sale_price.'</td>
		       <td>'.$row->retail_price.'</td>
		       <td><a href="add_gnr_table?code='.$row->item_code.'" class="btn btn-info">ADD</a></td>
		      </tr>
		    ';
		   }
		  }
		  else
		  {
		   $output .= '<tr>
		       <td colspan="8">No Data Found</td>
		      </tr>';
		  }
		  $output .= '</table> ';
		  echo $output;
	}

	//End


	function add_gnr_table()
	{

		$branch = "branch1";
		$code = $_GET['code'];
		$datas = $this->Cashier_Model->get_grn_data($code);

		foreach ($datas as $data) {
			$value = array (
			'item_code'=>$data->item_code,
			'item_name'=>$data->item_name,
			'item_description'=>$data->item_description,
			'whole_sale_price'=>$data->whole_sale_price,
			'retail_price'=>$data->retail_price,
			'branch'=>$branch
			);
		}

		$this->Cashier_Model->add_grn_table($value);

		redirect('Cashier/first_load_insert_product');
				
	}


	function remove_from_gnr_table($id)
	{

		$this->Cashier_Model->remove_from_gnr_table($id);

		redirect('Cashier/first_load_insert_product');
				
	}

	public function grn_item()
	{
		
		$grnValue = $this->Cashier_Model->get_grn_table();
		$dump = array();
		foreach($grnValue as $val) {
			$dump[$val->item_code] = $_POST['qty_' . $val->item_code];
		}
		
		$bill_no = $this->input->post('bill_no');
		$user = $this->input->post('user');
		$branch = $this->input->post('branch');
		$grn_no = $this->input->post('grn_no');

		$extra = array(
			'bill_no' => $bill_no,
			'user' => $user,
			'branch' => $branch,
			'grn_no' => $grn_no,
		);

	
		for ($i=0; $i<sizeof($grnValue); $i++) {
			foreach ($dump as $key => $value) {
				if ($grnValue[$i]->item_code == $key) {
					$grnValue[$i]->qty = $value;
				}
			}
			
		}

		// $this->output->set_content_type('application/json');
		// echo json_encode(array('status' => $status));
		// $this->load->library('PDF');

		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage('L');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->BillTable($grnValue, $dump, $extra);

		$pdf->Output();

		$this->Cashier_Model->add_gnr_item($grnValue, $extra);
						
	}

	

// End of the Item section



// Start the Bill section

	//Start Bill Handling
		


		//add the item to the temp bill table
		function add_to_tempBill(){

			$item = $this->input->post('item_code');
			$qty = $this->input->post('qty');
			$branch = "branch1";

			$data = array(
				'item_code'=> $item,
				'qty'=> $qty,
				'branch'=> $branch
			);

			$this->Cashier_Model->add_to_tempBill($data);

			redirect('Cashier/first_load_bill');

		}


		function remove_from_temp_bill($id){

			$this->Cashier_Model->remove_from_temp_bill($id);

			redirect('Cashier/first_load_bill');

		}


		function create_bill(){
			
			$bill_type = $this->input->post('bill_type');
			$customer = $this->input->post('customer');
			$user = $this->input->post('user');
			$branch = $this->input->post('branch');
			$bill_no = $this->input->post('bill_no');
			$totalAmount = $this->input->post('totalAmount');

			$billData = array(
				'bill_type'=> $bill_type,
				'customer'=>$customer ,
				'user'=>$user ,
				'branch'=>$branch ,
				'bill_no'=>$bill_no,
				'totalAmount'=>$totalAmount  
			);

			$billValue = $this->Cashier_Model->get_temp_bill_table();
		
			$this->Cashier_Model->create_bill($billValue, $billData);

			$this->Cashier_Model->clear_temp_bill_table($branch);

			//generate the pdf
			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage('L');
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->InvoiceTable($billData, $billValue);
	
			$pdf->Output();
			//redirect('Cashier/first_load_bill');
		}

		

// End of the Bill section

// Start the hanle customer section 

	function search_customer(){
		
		$output = '';
		$query = '';
		$data = '';

		
		$query = $this->input->post('query');
	
		$data = $this->Cashier_Model->search_customer($query);
		

		$output .= '
		<div class="table-responsive">
		   <table class="table table-bordered table-striped">
			<tr>
			 <th>#</th>
			 <th>NIC Number</th>
			 <th>Title</th>
			 <th>Full Name</th>
			 <th>Nic Name</th>
			 <th>Address</th>
			 <th>DOB</th>
			 <th>Gender</th>
			 <th>Contact 1</th>
			 <th>Contact 2</th>
			</tr>

		';
		if($data->num_rows() > 0)
		{

			$counter = 1;

		 foreach($data->result() as $row)
		 {
		  $output .= '
			<tr>
			 <td>'.$counter++.'</td>
			 <td>'.$row->nic.'</td>
			 <td>'.$row->title.'</td>
			 <td>'.$row->full_name.'</td>
			 <td>'.$row->nick_name.'</td>
			 <td>'.$row->address.'</td>
			 <td>'.$row->dob.'</td>
			 <td>'.$row->gender.'</td>
			 <td>'.$row->contact_no.'</td>
			 <td>'.$row->contact_no_2.'</td>
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
		$output .= '</table>';
		echo $output;

	}


// End the hanle customer section


}

?>