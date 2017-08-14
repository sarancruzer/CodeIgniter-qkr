<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
            
            $this->load->model('topic_model');
        }
	public function index()
	   { 
		  	$data['topics'] = $this->topic_model->fetch_topics();
		    $this->load->view('home',$data);
	   }
}
