<?php 

/**
 * 
 */
class Cashier_Model extends CI_Model
{

//Start the Item section

	//Start get shop1 stock
	function search_in_shop1($query)
	{

		$this->db->select("*");
	    $this->db->from("branch_1_store");
	    if($query != '')
	    {
		   $this->db->like('item_code', $query);
		   $this->db->or_like('item_name', $query);
		   $this->db->or_like('item_description', $query);
		   $this->db->or_like('whole_sale_price', $query);
		   $this->db->or_like('retail_price', $query);
	    }
	    $this->db->order_by('item_name', 'DESC');
	    return $this->db->get();

	}
	//End


	//Start get shop1 stock
	function search_in_shop2($query)
	{

		$this->db->select("*");
	    $this->db->from("branch_2_store");
	    if($query != '')
	    {
		   $this->db->like('item_code', $query);
		   $this->db->or_like('item_name', $query);
		   $this->db->or_like('item_description', $query);
		   $this->db->or_like('whole_sale_price', $query);
		   $this->db->or_like('retail_price', $query);
	    }
	    $this->db->order_by('item_name', 'DESC');
	    return $this->db->get();

	}
	//End


	//Start get main stock
	function search_in_main($query)
	{

		$this->db->select("*");
	    $this->db->from("main_store");
	    if($query != '')
	    {
		   $this->db->like('item_code', $query);
		   $this->db->or_like('item_name', $query);
		   $this->db->or_like('item_description', $query);
		   $this->db->or_like('whole_sale_price', $query);
		   $this->db->or_like('retail_price', $query);
	    }
	    $this->db->order_by('item_name', 'DESC');
	    return $this->db->get();

	}
	//End


	//Start get item table
	function search_in_items($query)
	{

		$this->db->select("*");
	    $this->db->from("item");
	    if($query != '')
	    {
		   $this->db->like('item_code', $query);
		   $this->db->or_like('item_name', $query);
		   $this->db->or_like('item_description', $query);
		   $this->db->or_like('cost', $query);
		   $this->db->or_like('whole_sale_price', $query);
		   $this->db->or_like('retail_price', $query);
	    }
	    $this->db->order_by('item_name', 'DESC');
	    return $this->db->get();

	}
	//End

	//Start get grn item table
	function get_grn_data($query)
	{

		return $this->db->get_where('item',['item_code'=>$query])->result();

	}
	//End

	//Start put grn in table
	function add_grn_table($value)
	{

		return $this->db->insert('temp_grn',$value);

	}
	//End

	//Start get data in grn table
	function get_grn_table()
	{

		return $this->db->get('temp_grn')->result();

	}
	//End

	//Start remove data in grn table
	function remove_from_gnr_table($id)
	{

		$this->db->where('id', $id);
		$this->db->delete('temp_grn');

	}
	//End

	//Start grn
	public function add_gnr_item($table_data, $basic_data)
	{


		$branch = $basic_data['branch'];
		$bill_no = $basic_data['bill_no'];
		$grn_no = $basic_data['grn_no'];
		$user = $basic_data['user'];

		$grn_details = array(
			'grn_no' => $grn_no,
			'bill_no' => $bill_no,
			'user_id' => $user,
			'branch' => $branch
		);


		for ($i=0; $i < count($table_data); $i++) { 
			$data[] = array(
				'code' => $table_data[$i]->item_code,
				'name' => $table_data[$i]->item_name,
				'description' => $table_data[$i]->item_description,
				'whole_sale' => $table_data[$i]->whole_sale_price,
				'retail' => $table_data[$i]->retail_price, 
				'qty' => $table_data[$i]->qty,
				'grn_no' => $grn_no,
				'branch_name' => $branch
			);
		}


		try{

			//Inser data to grn_item table
			for ($i=0; $i < count($table_data); $i++) { 
				$this->db->insert('grn_item',$data[$i]);

				$item_code = $data[$i]['code'];

				$this->db->select('*');
				$this->db->from('stock');
				$this->db->where('item_code',$item_code);
				$query = $this->db->get();
				$result = $query->row_array();

				if ($query->num_rows() > 0) {

					if($branch == "branch1"){

						$old_stock = $result['branch_1'];
						$new_stock = $old_stock+$data[$i]['qty'];

						$update = array(
							'branch_1'=>$new_stock
						);

						$equal = array(
							'item_code'=>$item_code
						);

						$this->db->update('stock', $update, $equal);
					}
					elseif($branch == "branch2"){

						$old_stock = $query->branch_2;
						$new_stock = $old_stock+$data[$i]['qty'];

						$update = array(
							'branch_2'=>$new_stock
						);

						$equal = array(
							'item_code'=>$item_code
						);

						$this->db->update('stock', $update, $equal);
					}
					
				}
				else{

					if($branch == "branch1"){

						$stock = $data[$i]['qty'];

						$addStock = array(
							'item_code' => $item_code ,
							'main' => 0,
							'branch_1' => $stock,
							'branch_2' => 0
						);

						$this->db->insert('stock',$addStock);

					}
					elseif($branch == "branch2"){

						$stock = $data[$i]['qty'];

						$addStock = array(
							'item_code' => $item_code ,
							'main' => 0,
							'branch_1' => $stock,
							'branch_2' => 0
						);

						$this->db->insert('stock',$addStock);

					}
					
				}

			}


			$this->db->insert('grn_data',$grn_details);

			$this->db->where('branch',$branch);
			$this->db->delete('temp_grn');

		return 'success';

		}
		catch(Exception $e){
			return 'failed';
		}

	}
	//End


	//Start get new grn number
	function get_grn_no($branch)
	{

		$this->db->select('*');
		$this->db->from('grn_data');
		$this->db->where('branch',$branch);
		$query = $this->db->get();
		$number = $query->num_rows();

		return $number+1;

	}
	//End


	//Start put temp_request in table
	function get_temp_request_table()
	{

		return $this->db->get('temp_request')->result();

	}
	//End


	public function add_request_item($table_data, $basic_data)
	{

		$branch = $basic_data['branch'];
		$grn_no = $basic_data['grn_no'];
		$user = $basic_data['user'];

		$grn_details = array(
			'grn_no' => $grn_no,
			'user_id' => $user,
			'branch' => $branch
		);

		for ($i=0; $i < count($table_data); $i++) { 
			$data[] = array(
				'code' => $table_data[$i]['code'],
				'name' => $table_data[$i]['name'],
				'description' => $table_data[$i]['description'],
				'whole_sale' => $table_data[$i]['whole_sale'],
				'retail' => $table_data[$i]['retail'],
				'qty' => $table_data[$i]['qty'],
				'request_no' => $grn_no,
				'branch_name' => $branch
			);
		}


		try{

			//Inser data to grn_item table
			for ($i=0; $i < count($table_data); $i++) { 
				
				$this->db->insert('request_item',$data[$i]);

			}

			return 'success';

		}
		catch(Exception $e){
			return 'failed';
		}

	}
	//End


	//Start get grn item table
	function get_request_data($query)
	{

		return $this->db->get_where('item',['item_code'=>$query])->result();

	}
	//End


	//Start put grn in table
	function add_request_table($value)
	{

		return $this->db->insert('temp_request',$value);

	}
	//End



//End of the Item section



//Start the Bill section

	//Start get temp bill table
	function get_temp_bill_table()
	{

		return $this->db->get('temp_bill')->result();

	}
	//END

	//Start get new grn number
	function get_bill_no($branch)
	{

		$this->db->select('*');
		$this->db->from('bill_history');
		$this->db->where('branch',$branch);
		$query = $this->db->get();
		$number = $query->num_rows();

		return $number+1;

	}
	//End

	function add_to_tempBill($data)
	{
		//var_dump($data);
		$code = $data['item_code'];
		$qty = $data['qty'];
		$branch = $data['branch'];
		$name;
		$desc;
		$price;
		$total;
		$id = 0;

		$this->db->select('*');
		$this->db->from('item');
		$this->db->where('item_code',$code);
		$query = $this->db->get();
		$results = $query->result();

		foreach($results as $row){
			$name =  $row->item_name;
			$desc = $row->item_description;
			$price = $row->retail_price;
			$total = $price * $qty;
		}


		$bill_data = array(
			'id' => $id,
			'item_code' => $code,
			'name' => $name,
			'description' => $desc,
			'price' => $price,
			'qty' => $qty,
			'total' => $total,
			'branch' => $branch
		);

		$this->db->insert('temp_bill',$bill_data);	

	}


	function remove_from_temp_bill($id){
		$this->db->where('id', $id);
		$this->db->delete('temp_bill');
	}

	

//End of the Bill section



}

?>