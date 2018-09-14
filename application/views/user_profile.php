<?php

$user_id=$this->session->userdata('id');
//$time_log=$this->session->userdata('time_log');
if(!$user_id){

  redirect('user/login_view');
/*}else if($user_id == true){
  $login_session_duration = 2; 

  if(isset($time_log) and isset($user_id))
    {  
      if(((time() - $time_log) > $login_session_duration))
      { 
        echo "eh";
        return true; 
      } 
    }
    //return false;
   //$user_id= $this->session->sess_expiration = 5; 
   //redirect('user/login_view');
  // echo time();*/

  }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile Dashboard-CodeIgniter Login Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>

<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <th colspan="2"><h4 class="text-center">User Info</h3></th>

        <div align="right">
        <a href="<?php echo base_url('user/user_logout');?>" > 
        <button type="button" class="btn-warning" alight="">Logout</button></a>
        </div>
      <table class="table table-bordered table-striped">
       <thead>
          <tr>
            <th>ID</th>
            <th>Database Name</th>
            <th>Action</th>
            
          </tr>
        </thead>
        <tbody>
          <?php if($all_user > 0){
          foreach($all_user as $row){
          ?>

          <tr>
            <td><?php echo $row->id;  ?></td>
            <td><?php echo $row->database_name; ?></td>
            <td>
            <a href="<?php echo base_url('index.php/user/edit/' .$row->id) ?>" >  <button type="button" class="btn-info">Edit</button></a>
            <a href="<?php echo base_url('index.php/user/delete/' .$row->id) ?>" >  <button type="button" class="btn-danger" OnClick="return confirm('Do you want to delete')">Delete</button></a>
            </td>
          </tr>
           <?php }} ?>
          </tbody>
      </table>
          
      <div align="left">
        <a href="<?php echo base_url('user/form_db');?>" > 
        <button type="button" class="btn-success" alight="">+ Add</button></a>
        </div>

    </div>
  </div>

</div>
  </body>
</html>
