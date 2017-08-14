<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->has_userdata('logged_in'))
      redirect('/', 'location', 301);  
    else
    {
       $user = $this->session->userdata('logged_in');
       if($user['is_fa'] != 1)
         redirect('/', 'location', 301);
    }      
    $this->load->helper('form');
  } 
  public function index()
  {   
    $user = $this->session->userdata('logged_in');

    if($this->input->server('REQUEST_METHOD') == 'POST' && isset($_POST['photo']))
    {
      $config['upload_path']          = './uploads/photos';
      $config['allowed_types']        = 'jpg|png|gif';
      $config['max_size']             = 5 * 1024;
      $config['max_width']            = 768;
      $config['max_height']           = 1024;
      $config['file_ext_tolower']     = true;
      $config['file_name']            = time();

      $this->load->library('upload', $config);

      if($this->upload->do_upload('profile_photo'))
      {
        $fa_user = $this->db->query('SELECT * FROM fa_users WHERE user_id = '.$user['id'])->row_array();
       
        if(count($fa_user) && $fa_user['profile_photo'] != '')
        {
          if(file_exists($this->config->item('upload_dir').'profiles/'.$fa_user['profile_photo']))
            unlink($this->config->item('upload_dir').'profiles/'.$fa_user['profile_photo']);
        }
   
        $f_data = $this->upload->data();
        $this->db->where('user_id', $user['id']);
        $this->db->update('fa_users', array('profile_photo' => $f_data['file_name']));
        redirect('profile/edit'); 
      }
      else
      {

      } 
    }
    else if($this->input->server('REQUEST_METHOD') == 'POST' && isset($_POST['web']))
    {
       echo 'web'; exit;
    }
    else if($this->input->server('REQUEST_METHOD') == 'POST' && isset($_POST['video']))
    {
       echo 'video'; exit;
    }
    return $this->load->view('aboutme-media');
  }
}
