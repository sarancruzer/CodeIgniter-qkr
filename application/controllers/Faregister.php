<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faregister extends CI_Controller {
  public function index()
  {   
    date_default_timezone_set('Europe/Berlin');
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    $this->load->database();
    $data['counties'] = $this->db->query('SELECT id, name FROM counties')->result_array();
    $data['sltd_frm'] = '0';
    $data['has_error'] = false;

    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
      $this->load->library('form_validation');

      $this->form_validation->set_message('check_regex','Only alphabets and single space are allowed.'); 
      
      $error_array = array();
      $this->load->model('user');

      if($this->session->has_userdata('logged_in') && !isset($_POST['have_acc']))
      {
        if($this->form_validation->run('fa_signedin') == TRUE)
        {          
          $user = $this->session->userdata('logged_in');
          $fa = $this->getFA($user['id']);
          $this->user->insertFA($fa);
          $this->storeLicense();     
          redirect('/dashboard');
        }
      }
      else if(isset($_POST['have_acc']) && $this->input->post('have_acc') == 0)
      {
        if($this->form_validation->run('fa_register') == TRUE)
        {
          $user = array(
                         'email'=>$this->input->post('register[email]'),
                         'password'=>md5($this->input->post('register[password]')),
                         'firstname'=>$this->input->post('fa[firstname]'),
                         'lastname'=>$this->input->post('fa[lastname]'),
                         'middlename'=>$this->input->post('fa[middlename]'),
                         'displayname'=>'',                          
                         'is_fa'=> 1,
                         'created_at'=>date('Y-m-d H:i:s')
                       );           
          $user_id = $this->user->insertUser($user); 
          $fa = $this->getFA($user_id);
          $this->user->insertFA($fa);
          $this->storeLicense();

          $this->session->set_userdata('logged_in',$user);
          redirect('/dashboard');
        }
        $data['sltd_frm'] = '0';
      }
      else if(isset($_POST['have_acc']) && $this->input->post('have_acc') == 1)
      {    
        if($this->form_validation->run('fa_signin') == TRUE)
        {  
          $email = $this->security->xss_clean($this->input->post('signin[email]'));
          $password = $this->security->xss_clean($this->input->post('signin[password]'));
        
          $sql = 'SELECT * from users WHERE email = ? AND password = ?';
        
          $users = $this->db->query($sql, array($email, md5($password)))->result_array();

          if(count($users) == 1)
          {
            $fa = $this->getFA($users[0]['id']);
            $this->user->insertFA($fa);
            $this->storeLicense();
            $this->signIn();

            $this->session->set_userdata('logged_in',$users[0]);
            redirect('/dashboard');
          }
          else 
            $has_error = true;
        }
        $data['sltd_frm'] = '1';
      }
      else        
        redirect('/');      
    }

    if($this->session->has_userdata('logged_in')) 
      $this->load->view('faregister-form-signedin', $data);
    else    
      $this->load->view('faregister-form', $data);
  }
  public function login()
  {
    $this->load->view('login');
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
  private function storeUser()
  {

  }
  private function storeFA()
  {

  }
  private function storeLicense()
  {

  }
  private function signIn()
  {

  }
  private function getFA($user_id)
  {
          $fa = array(
                       'user_id' => $user_id,
                       'address1' => $this->input->post('fa[address1]'),
                       'address2' => $this->input->post('fa[address2]'),
                       'address3' => $this->input->post('fa[address3]'),
                       'disciplinary_history' => $this->input->post('fa[disciplinary]'),
                       'city' => $this->input->post('fa[city]'),
                       'county' => $this->input->post('fa[county]'),
                       'postcode' => $this->input->post('fa[postcode]'),
                       'phone_number' => $this->input->post('fa[phonenumber]'),
                       'created_at' => date('Y-m-d H:i:s'),
                       'updated_at' => date('Y-m-d H:i:s')
                     );
    return $fa;
  }
}
