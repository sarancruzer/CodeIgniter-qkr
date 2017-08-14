<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function index()
  {
    if(!$this->session->has_userdata('logged_in'))
    {
      redirect('/account/login','refresh');
    }
    $user = $this->session->userdata('logged_in');
    if($user['is_fa'] == 0)
      redirect('/');

    $this->load->view('dashboard');   
  }
}
