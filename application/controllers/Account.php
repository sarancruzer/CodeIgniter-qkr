<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
  public function __construct()
       {
            parent::__construct();
            $this->load->model('my_quickr_model');
            
       }

  public function register()
  {   
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    if($this->session->has_userdata('logged_in'))
    redirect('/account/settings', 'location', 301);  

    $this->load->database();
    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('firstname', 'Firstname', 'trim|min_length[6]|max_length[250]|callback_check_regex', array('check_regex' => 'Only alphabets and single space are allowed.'));
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[1]|max_length[250]|is_unique[users.email]');    
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
      $this->form_validation->set_rules('confirm', 'Password Confirmation', 'trim|required|matches[password]');                                    

      if($this->form_validation->run() == TRUE)
      {
         /*
          * Storing user in database
          */
         date_default_timezone_set('Europe/Berlin');
         $user = array(
           'firstname' => trim($this->input->post('firstname')),
           'lastname' => trim($this->input->post('firstname')),
           'displayname' => trim($this->input->post('firstname')),
           'email' => trim($this->input->post('email')),
           'password' => md5(trim(($this->input->post('password')))),
           'created_at' => date('Y-m-d H:i:s')
         );
         $this->db->insert('users', $user);

         /*
          * set session values for user login
          */
         $this->session->set_userdata('logged_in', $user);	                   
         /*
          * redirect user
          */
         if($this->input->post('return_url'))
           redirect($this->input->post('return_url'));
         else
           redirect('/', 'location', 301);  
      }
    }    
    $this->load->view('register');
  }
  public function login()
  {
    if($this->session->has_userdata('logged_in'))
    {
      $user = $this->session->userdata('logged_in');
      if($user['is_fa'] == 1)
        redirect('/dashboard', 'location', 301);   
      else
        if($this->input->post('return_url'))
           redirect($this->input->post('return_url'));
        else    
        redirect('/account/settings', 'location', 301);   
    }
    

    $this->load->helper('form');
    $data['has_error'] = false;
    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
      $this->load->library('form_validation');
          
      $config = array(
                  array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
		  array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
                );
      $this->form_validation->set_rules($config);       
		  
      if($this->form_validation->run() == TRUE)
      { 
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $sql = 'SELECT * from users WHERE email = ? AND password = ?';
        
        // Run the query
        $users = $this->db->query($sql, array($email, md5($password)))->result_array();
        // Let's check if there are any results
        
        if(count($users) == 1)
        {
          $this->session->set_userdata('logged_in',$users[0]);
          if($users[0]['is_fa'] == 1)
            redirect('/dashboard');
          else
            if($this->input->post('return_url'))
              redirect($this->input->post('return_url'));
            else
              redirect('/');
        }
        else 
          $has_error = true;
      }
    }
    $this->load->view('login', $data);
  }
  public function logout()
  {
    $this->session->unset_userdata('logged_in');
    //$this->session->session_destroy();
    redirect('/');  
  }	
  public function check_regex($str)
  {    
    if($str == '') return TRUE;
    if(preg_match('/^(?:[a-zA-Z]+\s?)+$/', $str )) {
      return TRUE;
    } else {
      return FALSE;
    }	
  }

  public function forgot_password()
  {
    $data['referer_rul'] = $_SERVER['HTTP_REFERER'];

    if($this->input->post('submit'))
    {  
       if($this->input->post('return_url'))
          $data['referer_rul'] = $this->input->post('return_url');
       $exmail = $this->my_quickr_model->select_from('users','id',array('email' => $this->input->post('email')));
       if(empty($exmail))
           $this->session->set_flashdata('Failure' , 'Enter valid email id');
       else
       {    
           $new_password = $this->generatepassword();
           $data = array('password' => md5($new_password));
           $where = array('id' => $exmail[0]['id'], 'email' => $this->input->post('email'));
           $result = $this->my_quickr_model->update_data('users',$data,$where);
           if($result)
              $this->session->set_flashdata('Success' , 'New Password has been sent to your mail id');
           else
              $this->session->set_flashdata('Failure' , 'Enter valid email id');
            
            redirect($this->input->post('return_url'));
      }
       
    }

    $this->load->view('forgot_password',$data);
  }

  public function generatepassword() 
  {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }

  public function settings()
  {
     if(!$this->session->has_userdata('logged_in'))
      {
        redirect('/');  
      }
    $user = $this->session->userdata('logged_in');
    $user_id = $user['id'];
    $where = array('id' => $user_id);
    $data['user_detail'] = $this->my_quickr_model->select_from('users','*',$where);
    
    $this->load->view('settings',$data);
  }

  public function update_settings()
  {
  
    $value = $this->input->post('value');
    if($this->input->post('field') == 'password')
    {
       if(md5($this->input->post('old_password')) !== $this->input->post('db_password'))
       {
          echo '-1';
          exit;
       }
       $value = md5($this->input->post('value'));
    }
     
     $data = array(
        $this->input->post('field') => $value
      );
     $where = array(
      'id' => $this->input->post('user_id')
      );
     $result = $this->my_quickr_model->update_data('users',$data,$where);

     echo $result;
     exit;

  }

  public function notifications()
  {
    if(!$this->session->has_userdata('logged_in'))
      {
        redirect('/');  
      }
    $user = $this->session->userdata('logged_in'); 
    $user_id = $user['id'];
    $where = array('user_id' => $user_id);
    $data['sp_area']= $this->my_quickr_model->select_from('topics','*',array('is_parent'=>1));
    $data['notifications'] = $this->my_quickr_model->select_from('users_notification_setting','*',$where);
    $data['user_id'] = $user_id;
    $this->load->view('notifications',$data);
  }

  public function save_notifications()
  {
    
     $ndata = array(
      'user_id' => $this->input->post('user_id'),
      'activity_mail' => $this->input->post('activity_mail'),
      'announcement' => $this->input->post('announcement'),
      'feedback' => $this->input->post('feedback'),
      'survival' => implode(',', $this->input->post('survival')),
      'answer_nofitication' => $this->input->post('answer_notifi'),
      'comment_replies' => $this->input->post('comment_reply'),
      );
    
     if($this->input->post('n_id') == '')
       $id = $this->my_quickr_model->insert_data('users_notification_setting',$ndata);
     else
     {
        $where = array(
        'id' => $this->input->post('n_id')
        );
        $id = $this->my_quickr_model->update_data('users_notification_setting',$ndata,$where);
     }

     if($id)
     {
       $this->session->set_flashdata('Success', 'Email preferences saved successfully');
     }
     else
        $this->session->set_flashdata('Failure', 'Email preferences not saved successfully. Please Try Again!');
      redirect('account/notifications');
  }

  public function remove_notification($id)
  {
    $where = array('id' => intVal($id));
    $result = $this->my_quickr_model->delete_from('users_notification_setting',$where);
    if($id)
     {
       $this->session->set_flashdata('Success', 'Successfully unsubscribed email preferences');
     }
     else
        $this->session->set_flashdata('Failure', 'Unsubscribtion failed. Please Try Again!');
      redirect('account/notifications');
  }
}
