<?php
class User_model extends CI_model{



public function register_user($user){


$this->db->insert('client_login', $user);

}

public function login_user($username,$pass){

  $this->db->select('*');
  $this->db->from('client_login');
  $this->db->where('username',$username);
  $this->db->where('password',$pass);

  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }

}
public function username_check($username){

  $this->db->select('*');
  $this->db->from('client_login');
  $this->db->where('username',$username);
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}

public function insert_db($data){


$this->db->insert('client_database', $data);

}

public function get_datas($id){

          
        $this->db->select('*');
        $this->db->from('client_database');
        $this->db->where('client_id',$id);

        $data=$this->db->get();
        return $data->result();


  }

public function get_user($id){

          
        $this->db->select('*');
        $this->db->from('client_database');
        $this->db->where('id', $id);
        
        $data=$this->db->get();
        return $data->row_array();


    }

public function update_user($data,$id){

        
        $this->db->where('id', $id);
        $this->db->update('client_database' , $data);

        
        return true;


    }

    public function delete_user($id){

        
        $this->db->where('id', $id);
        $this->db->delete('client_database');

        
        return true;


    }

}


?>
