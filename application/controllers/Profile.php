<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
    $this->load->view('profile');
  }
  public function edit()
  {
    $user = $this->session->userdata('logged_in');
    $edu_sql = 'SELECT id, university, major, degree, year FROM fa_educations WHERE user_id = ?';
    $educations = $this->db->query($edu_sql, array($user['id']))->result_array();
    $data['educations'] = $educations;

    $license_sql = 'SELECT id, (SELECT name FROM controlled_functions WHERE id = fa_licenses.controlled_function) as controlled_function, firm_name, start_date, end_date FROM fa_licenses WHERE user_id = ?';
    $licenses = $this->db->query($license_sql, array($user['id']))->result_array();
    $data['licenses'] = $licenses;

    $data['controlled_functions'] = $this->db->query('SELECT id,name FROM controlled_functions')->result_array(); 
    $data['languages'] = $this->db->query('SELECT id,language FROM languages')->result_array();      

    $experience_sql = 'SELECT e.id, e.title, e.company, e.from, e.to, e.present FROM fa_work_experiences e WHERE e.user_id = ?';
    $experiences = $this->db->query($experience_sql, array($user['id']))->result_array();
    $data['experiences'] = $experiences;

    $award_sql = 'SELECT a.id, a.award_name, a.grantor, a.date_granted FROM fa_awards a WHERE a.user_id = ?';
    $awards = $this->db->query($award_sql, array($user['id']))->result_array();
    $data['awards'] = $awards;


    $data['languages_spoken'] = $this->db->query('SELECT sp.id,(SELECT language FROM languages WHERE sp.language_id = id) as language FROM fa_languages_spoken sp')->result_array();

    $data['fee_types'] = $this->db->query('SELECT * FROM fee_types')->result_array();
    $data['payment_types'] = $this->db->query('SELECT * FROM payment_types')->result_array();
    $data['fa_info'] = $this->db->query('SELECT * FROM fa_users WHERE user_id = '.$user['id'])->result_array();
       
    $this->load->view('profile-edit', $data);
  }
  public function alternate_names()
  {
    $user = $this->session->userdata('logged_in');
    if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST')
    {
      $this->load->library('form_validation');
          
      $config = array(
                    array('field' => 'name1', 'label' => 'Alternate name', 'rules' => 'required|callback_check_name'),
	            array('field' => 'name2', 'label' => 'Alternate name 2', 'rules' => 'callback_check_name')
                  );
      $this->form_validation->set_rules($config);
      $this->form_validation->set_message('check_name','Only alphabets and single space is allowed.');
         		  
      $res = array('is_valid'=>false);
      if($this->form_validation->run() == TRUE)
      { 
        //$data['fa_alternate_names'] = $this->db->query('SELECT * FROM fa_alternate_names WHERE user_id = '.$user['id'].' LIMIT 2')->result_array();
        $alter_names = array('alternate_name1' => $this->input->post('name1'), 'alternate_name2' => $this->input->post('name2'));
        $this->db->where('user_id', $user['id']);
        $this->db->update('fa_users', $alter_names);
        $res['names']['name1'] = $this->input->post('name1');
        $res['names']['name2'] = $this->input->post('name2');
        $res['is_valid'] = true;
        return $this->output->set_content_type('application/json')->set_output(json_encode($res));
      }
      else 
      {
        $res['errors'] = $this->form_validation->error_array();
        return $this->output->set_content_type('application/json')->set_output(json_encode($res));
      } 
    }
  }
  public function headshot()
  {
    $user = $this->session->userdata('logged_in');
    $config['upload_path']          = './uploads/profiles';
    $config['allowed_types']        = 'jpg|png';
    $config['max_size']             = 5 * 1024;
    $config['max_width']            = 768;
    $config['max_height']           = 1024;
    $config['file_ext_tolower']     = true;
    $config['file_name']            = time();

    $this->load->library('upload', $config);
    
    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
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
    $this->load->view('headshot');     
  }
  public function aboutme()
  {       
    $this->load->view('aboutme-edit');
  }
  public function practice_areas()
  {
    $sql = 'SELECT * FROM practice_areas ORDER BY area';
    $data['practice_areas'] = $this->db->query($sql)->result_array();
    $this->load->view('practice-areas', $data);
  }
  public function payment()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function fees()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function languages()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function request_endorsement()
  {       

  }
  public function licenses()
  {       
    $this->load->model('license');
    $this->license->doFlow();
  }
  public function companies()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function educations()
  {    
    $this->load->model('education');
    $this->education->doFlow();         
  }
  public function experiences()
  {    
    $this->load->model('experience');
    $this->experience->doFlow();         
  }
  public function awards()
  {       
    $this->load->model('award');
    $this->award->doFlow();         
  }
  public function associations()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function legal_cases()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function publications()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function speaking_engagements()
  {       
    if (!$this->input->is_ajax_request()) {
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		  
    }
  }
  public function request_reviews()
  {       
    $this->load->view('request-reviews');
  }
  public function check_is_present($to, $present)
  {
    if(!in_array($to, range(1900, date('Y'))) && $present == null) 
    {      
      return false;
    }
    else if(!isset($present) && $to == 0)
    {
      return false;
    }
    else if(!isset($present) && !is_numeric($to))
    {
      return false;
    }
    else
      return true;
  } 
  public function check_name($name)
  {
    if($name == '') return true;
    return (bool) preg_match('/^[a-z0-9\' ]+$/i', $name);
  }
}
