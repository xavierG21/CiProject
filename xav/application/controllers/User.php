<?php

class User extends CI_Controller {

public function __construct(){

        parent::__construct();
  			$this->load->helper('url');
  	 		$this->load->model('user_model');
        $this->load->library('session');

         

}

public function index()
{
$this->load->view("register.php");
}

public function register_user(){

      $user=array(
      'username'=>$this->input->post('username'),
     // 'user_email'=>$this->input->post('user_email'),
      'password'=>md5($this->input->post('user_password'))
     // 'user_age'=>$this->input->post('user_age'),
     // 'user_mobile'=>$this->input->post('user_mobile')
        );
        print_r($user);

  $username_check=$this->user_model->username_check($user['username']);     
//$email_check=$this->user_model->email_check($user['user_email']);

if($username_check){
  $this->user_model->register_user($user);
  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
  redirect('user/login_view');

}
else{

  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  redirect('user');


}

}

public function login_view(){

$this->load->view("login.php");

}

function login_user(){
  $user_login=array(

  'username'=>$this->input->post('username'),
  'password'=>md5($this->input->post('password'))

    );

    $data=$this->user_model->login_user($user_login['username'],$user_login['password']);
      if($data)
      {

        //$this->session->sess_expiration = 1; 
        $this->session->set_userdata('id',$data['id'] );
        //$this->session->set_userdata('time_log',time());
        //$this->session->set_userdata('user_email',$data['user_email']);
        $this->session->set_userdata('username',$data['username']);
       // $this->session->set_userdata('user_age',$data['user_age']);
        //$this->session->set_userdata('user_mobile',$data['user_mobile']);

        $field = array();
        
        


        redirect("user/user_profile");

      }
      else{
        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
        $this->load->view("login.php");

      }


}

function user_profile(){
 $field['all_user'] = $this->user_model->get_datas($this->session->userdata('id'));

$this->load->view('user_profile.php',$field);

}
public function user_logout(){

  $this->session->sess_destroy();
  redirect('user/login_view', 'refresh');
}


function form_db(){

$this->load->view('form_db.php');

}

public function register_db(){

      $data=array(
      'database_name'=>$this->input->post('dbname'),
      'client_id'=>$this->input->post('id'),
     //'password'=>md5($this->input->post('user_password'))
     // 'user_age'=>$this->input->post('user_age'),
     // 'user_mobile'=>$this->input->post('user_mobile')
        );
        //print_r($data);

 // $dbname_check=$this->user_model->username_check($data['database_name']);     
//$email_check=$this->user_model->email_check($user['user_email']);
       $this->user_model->insert_db($data);
       //$this->load->view('user_profile', $data);v
      // $field = $this->user_model->update_user($data,$id);
    
    //$field2 = array();
    //$field2['all_user'] = $this->user_model->get_datas($this->session->userdata('id'));
        
        redirect('user/user_profile');
}

/*public function view_user()
  {
    $data = array();

    $data['all_user'] = $this->user_model->get_datas();

    $this->load->view('user_profile', $data);
  }*/
public function edit(){
    $id = $this->uri->segment(3);
    //$this->load->model('user_model');

    $data['user'] = $this->user_model->get_user($id);
    $this->load->view('edit_db', $data);
     //var_dump($data);
    //print_r($data);
  }

public function insert_edit(){
    
    //$this->load->user_model('Usermodel');

    $id = $this->input->post('id');

    $data = array(
      'database_name' => $this->input->post('dbname'),
      

    );
  

    $field = $this->user_model->update_user($data,$id);
    
    $field2 = array();
    $field2['all_user'] = $this->user_model->get_datas($this->session->userdata('id'));
        
        $this->load->view('user_profile.php',$field2);
    
  } 

  public function delete(){
    
    $id = $this->uri->segment(3);
    //$this->load->model('Usermodel');

    $field = $this->user_model->delete_user($id);

    $field2 = array();
    $field2['all_user'] = $this->user_model->get_datas($this->session->userdata('id'));
        
        $this->load->view('user_profile.php',$field2);
    
  }

}

?>
