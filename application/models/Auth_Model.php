<?php
	class Auth_Model extends CI_Model {

        //Retrieve Userinfo from the Database
		public function login_user($userid, $password){
    		//$sql = "SELECT * FROM admin a_id='".$userid."' AND a_pwd='".$password."'";
    		//$query = $this->db->query($sql);
    		//return $query->result();
    		$this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id', $userid);
            $this->db->where('password', $password);

            if ($query = $this->db->get()) {
                return $query->row_array();
            } else {
                return false;
            }

    	}

        //Retrieve Branchinfo from the Database
        public function branch($mac){
            $this->db->select('*');
            $this->db->from('branch');
            $this->db->where('mac', $mac);

            if ($query = $this->db->get()) {
                return $query->row_array();
            } else {
                return false;
            }

        }
	}
?>