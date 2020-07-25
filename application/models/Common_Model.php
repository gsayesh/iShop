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

        public function stock_low_row(){
            $query = $this->db->query('SELECT * FROM stock where main<=50'); 
        }
	}
?>