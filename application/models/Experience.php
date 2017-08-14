<?php
class Experience extends CI_model {

  public function __construct()
  {
    parent::__construct();
  }
  public function doFlow()
  {
      if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
      {
        $this->load->library('form_validation');
          
        $config = array(
                    array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
	            array('field' => 'company', 'label' => 'Company', 'rules' => 'required'),
	            array('field' => 'from', 'label' => 'From', 'rules' => 'required|is_natural_no_zero'),
	            array('field' => 'to', 'label' => 'To', 'rules' => 'callback_check_is_present['.$this->input->post('present').']')
                  );
        $this->form_validation->set_rules($config);       
        $this->form_validation->set_message('check_is_present','select work experience end year or present');
         		  
        $res = array('is_valid'=>false);
        if($this->form_validation->run() == TRUE)
        { 
          $user = $this->session->userdata('logged_in');
          if($this->input->post('present')) { $to = ''; $present = 1; }  
          else { $to = $this->input->post('to'); $present = 0; }
          if(is_numeric($this->input->post('id')))
          {
            $sql = 'SELECT * FROM fa_work_experiences WHERE id = ?';
            $experience = $this->db->query($sql,array($this->input->post('id')))->row_array();            
            $experience = array('title'=>$this->input->post('title'), 'company'=>$this->input->post('company'), 'from' => $this->input->post('from'), 'to' => $to, 'present' => $present);
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('fa_work_experiences', $experience);
          }
          else 
          {
            $experience = array('user_id'=>$user['id'], 'title'=>$this->input->post('title'), 'company'=>$this->input->post('company'),'from' => $this->input->post('from'), 'to' => $to, 'present' => $present, 'created_at' => date('Y-m-d H:i:s'));
            $this->db->insert('fa_work_experiences', $experience);
          }
          $sql = 'SELECT * FROM fa_work_experiences WHERE user_id = ?';
          $data['experiences'] = $this->db->query($sql, array($user['id']))->result_array();
          $res['html'] = $this->load->view('experience-table', $data, true);
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
            $sql = 'SELECT * FROM fa_work_experiences WHERE id = ?';
            $data['experience'] = $this->db->query($sql,array($this->uri->segment(4)))->row_array();
            $res['html'] = $this->load->view('experience-edit',$data, true); 
            return $this->output->set_content_type('application/json')->set_output(json_encode($res));		              
         }
      }
      $res['html'] = $this->load->view('experience-form',null, true); 
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		      
  }
}

