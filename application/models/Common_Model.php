<?php
	class Common_Model extends CI_Model {

		public function view_profile($uid){
        	return $this->db->get_where('user', ['user_id' => $uid])->result();
    	}

    	public function profile_update($uid,$data){
        	return $this->db->where(['user_id' => $uid])->update('user', $data);
    	}
    	
    	public function stock_low(){
    		$query = $this->db->query('SELECT * FROM stock,item where main<=50 AND stock.item_code=item.item_code');
            if($query->num_rows()<=5){
                return $query->result();
            }else{
                return false;
            }
    	}

        public function sup_bill_no(){
            $this->db->select('sbill_no');
            $this->db->from('request_sup_stock');
            $query = $this->db->get();
            $number = $query->num_rows();

            return $number+1;
        }

        public function mail_info_insert($mailinfo){

            $this->db->insert('request_sup_stock',$mailinfo);

        }

        public function mail_stock_insert($msgdata){
            foreach($msgdata as $msgarr){
            $this->db->insert('request_sup_data',$msgarr);
            }
        }
	}
?>