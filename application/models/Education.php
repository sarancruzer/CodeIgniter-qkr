<?php
class Education extends CI_model {

  public function __construct()
  {
    parent::__construct();
  }
  public function doFlow()
  {
      $user = $this->session->userdata('logged_in');
      if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
      {
        $this->load->library('form_validation');
          
        $config = array(
                    array('field' => 'university', 'label' => 'University', 'rules' => 'required'),
	            array('field' => 'major', 'label' => 'Major', 'rules' => 'required'),
	            array('field' => 'degree', 'label' => 'Degree', 'rules' => 'required'),
	            array('field' => 'year', 'label' => 'Year', 'rules' => 'required|numeric'),
                  );
        $this->form_validation->set_rules($config);       
         		  
        $res = array('is_valid'=>false);
        if($this->form_validation->run() == TRUE)
        { 
          if(is_numeric($this->input->post('id')))
          {
            $sql = 'SELECT * FROM fa_educations WHERE id = ?';
            $education = $this->db->query($sql,array($this->input->post('id')))->row_array();
            $education = array('university'=>$this->input->post('university'), 'major'=>$this->input->post('major'), 'degree' => $this->input->post('degree'), 'year' => $this->input->post('year'));
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('fa_educations', $education);
          }
          else 
          {
            $education = array('user_id'=>$user['id'], 'university'=>$this->input->post('university'), 'major'=>$this->input->post('major'), 'degree' => $this->input->post('degree'), 'year' => $this->input->post('year'), 'created_at' => date('Y-m-d H:i:s'));
            $this->db->insert('fa_educations', $education);
          } 
          $sql = 'SELECT * FROM fa_educations WHERE user_id = ?';
          $data['educations'] = $this->db->query($sql, array($user['id']))->result_array();
          $res['html'] = $this->load->view('education-table', $data, true);
          $res['is_valid'] = true;
          
          return $this->output->set_content_type('application/json')->set_output(json_encode($res));		     
        }  
        else
        {
          $res['errors'] = $this->form_validation->error_array();
          return $this->output->set_content_type('application/json')->set_output(json_encode($res));	
        }
      }

      if($this->input->is_ajax_request() && $this->uri->segment(3) == 'edit')
      {
         if(is_numeric($this->uri->segment(4)))
         {
            $sql = 'SELECT * FROM fa_educations WHERE id = ?';
            $data['education'] = $this->db->query($sql,array($this->uri->segment(4)))->row_array();
            $res['html'] = $this->load->view('education-edit',$data, true); 
            return $this->output->set_content_type('application/json')->set_output(json_encode($res));		              
         }
      }
      $sql = 'SELECT * FROM fa_educations WHERE user_id = ?';
      $data['educations'] = $this->db->query($sql, array($user['id']))->result_array();

      $res['html'] = $this->load->view('education-form',$data, true); 
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		      
  } 
}

