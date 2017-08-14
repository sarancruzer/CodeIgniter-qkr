<?php
class License extends CI_model {

  public function __construct()
  {
    parent::__construct();
  }
  public function doFlow()
  {
      $data['controlled_functions'] = $this->db->query('SELECT id,name FROM controlled_functions')->result_array();      

      if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') 
      {
        $this->load->library('form_validation');
          
        $config = array(
                    array('field' => 'controlled_function', 'label' => 'Controlled function', 'rules' => 'required|numeric'),
	            array('field' => 'firm_name', 'label' => 'Firm name', 'rules' => 'required'),
	            array('field' => 'start_date', 'label' => 'Start date', 'rules' => 'required'),
	            array('field' => 'end_date', 'label' => 'End date', 'rules' => 'required'),
                  );
        $this->form_validation->set_rules($config);       
         		  
        $res = array('is_valid'=>false);
        if($this->form_validation->run() == TRUE)
        { 
          $user = $this->session->userdata('logged_in');
          if(is_numeric($this->input->post('id')))
          {
            $sql = 'SELECT * FROM fa_licenses WHERE id = ?';
            $license = $this->db->query($sql,array($this->input->post('id')))->row_array();
            $license = array('controlled_function'=>$this->input->post('controlled_function'), 'firm_name'=>$this->input->post('firm_name'), 'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))));
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('fa_licenses', $license);
          }
          else 
          {
            $license = array('user_id'=>$user['id'], 'controlled_function'=>$this->input->post('controlled_function'), 'firm_name'=>$this->input->post('firm_name'), 'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))), 'created_at' => date('Y-m-d H:i:s'));
            $this->db->insert('fa_licenses', $license);
          } 
          $sql = 'SELECT id,(SELECT name FROM controlled_functions WHERE id = fa_licenses.controlled_function) as controlled_function ,firm_name, start_date, end_date, created_at FROM fa_licenses WHERE user_id = ?';
          $data['licenses'] = $this->db->query($sql, array($user['id']))->result_array();
          $res['html'] = $this->load->view('license-table', $data, true);
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
            $sql = 'SELECT id,(SELECT name FROM controlled_functions WHERE id = fa_licenses.controlled_function) as controlled_function ,firm_name, start_date, end_date, created_at FROM fa_licenses WHERE id = ?';
            $data['license'] = $this->db->query($sql,array($this->uri->segment(4)))->row_array();                 
            $res['html'] = $this->load->view('license-edit',$data, true); 
            return $this->output->set_content_type('application/json')->set_output(json_encode($res));		              
         }
      }
      $res['html'] = $this->load->view('license-form',$data, true); 
      return $this->output->set_content_type('application/json')->set_output(json_encode($res));		      
  } 
}

