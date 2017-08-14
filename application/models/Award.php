<?php
class Award extends CI_model {

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
                    array('field' => 'award_name', 'label' => 'Award name', 'rules' => 'required'),
	            array('field' => 'grantor', 'label' => 'Grantor', 'rules' => 'required'),
	            array('field' => 'date_granted', 'label' => 'Date granted', 'rules' => 'required')
                  );
        $this->form_validation->set_rules($config);       
         		  
        $res = array('is_valid'=>false);
        if($this->form_validation->run() == TRUE)
        { 
          if(is_numeric($this->input->post('id')))
          {
            $sql = 'SELECT * FROM fa_awards WHERE id = ?';
            $award = $this->db->query($sql,array($this->input->post('id')))->row_array();
            $award = array('award_name'=>$this->input->post('award_name'), 'grantor'=>$this->input->post('grantor'), 'date_granted' => date('Y-m-d',strtotime($this->input->post('date_granted'))));
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('fa_awards', $award);
          }
          else 
          {
            $award = array('user_id'=>$user['id'], 'award_name'=>$this->input->post('award_name'), 'grantor'=>$this->input->post('grantor'), 'date_granted' => date('Y-m-d',strtotime($this->input->post('date_granted'))), 'created_at' => date('Y-m-d H:i:s'));
            $this->db->insert('fa_awards', $award);
          } 
          $sql = 'SELECT * FROM fa_awards WHERE user_id = ?';
          $data['awards'] = $this->db->query($sql, array($user['id']))->result_array();
          $res['html'] = $this->load->view('award-table', $data, true);
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
            $sql = 'SELECT * FROM fa_awards WHERE id = ?';
            $data['award'] = $this->db->query($sql,array($this->uri->segment(4)))->row_array();
            $res['html'] = $this->load->view('award-edit',$data, true); 
            return $this->output->set_content_type('application/json')->set_output(json_encode($res));		              
         }
      }
      $sql = 'SELECT * FROM fa_awards WHERE user_id = ?';
      $data['awards'] = $this->db->query($sql, array($user['id']))->result_array();

      $res['html'] = $this->load->view('award-form',$data, true); 
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		      
  } 
}

