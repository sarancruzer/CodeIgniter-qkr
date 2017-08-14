<?php
class Search extends CI_Controller {

    public function __construct()
       {
            parent::__construct();
            $this->load->model('my_quickr_model');
            $this->load->model('topic_model');
            $this->load->model('search_model');
            $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';	
	        if($user['id'] != '')
	        {
	         $quests = array();
	       	 $saved_quest = $this->my_quickr_model->select_from('saved_questions','quest_id',array('client_id'=>$user['id']));
	         
	         $this->data = array('saved_quest' => count($saved_quest));
	        }

            
       }

    function index()
    {
     
    	if($_POST['search_submit'] || $_POST['topic_name'])
    	{
    		unset($_SESSION['search_by_topic']);
    		$search = array(
    			'topicname' => $_POST['topic_name'],
    			'location' => $_POST['city_county']);
    	  
        $this->session->set_userdata('search_by_topic', $search);
        }
       
        $topic_name = '';
        if($this->session->has_userdata('search_by_topic'))
        {
        	$search_session = $this->session->userdata('search_by_topic');
        	$topic_name = $search_session['topicname'];
        	$location = $search_session['location'];
        }
        if($topic_name == '')
        {
        	
           $this->session->set_flashdata('Failure','Please enter some text to search for');
           redirect('free-financial-advice');
        }
        $data['topics'] = $this->search_model->get_topics_related($topic_name);
        $tag_ids = (isset($_GET['tag']))?$_GET['tag']:'';
        $limit = '20';
	    $offset = ($this->uri->segment(2) != '')?$this->uri->segment(2):0;
	    
	    $config = array( 

	    	             'base_url' => site_url('search'),
	                     'per_page' => $limit,
	                     'total_rows' => $this->search_model->match_result_count($topic_name,$location,$tag_ids),
	                     'num_links' => 5,
	                     'uri_segment' => 2,
	                     'full_tag_open' => '<div class="pagination full-width">',
	                     'full_tag_close' => '</div>',
	                     'prev_link' => '<i class="fa fa-arrow-left"></i>',
	                     'next_link' => '<i class="fa fa-arrow-right"></i>',
	                     'cur_tag_open' => '<span class="current">',
	                     'cur_tag_close' => '</span>');
	    if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
	    $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
	      
	    $this->pagination->initialize($config);
        $search_result = array();
        
        $data['search_result'] = $search_result = $this->search_model->get_match_result($topic_name,$location,$tag_ids,$limit,$offset);
        $data['result_count'] = $this->search_model->match_result_count($topic_name,$location,$tag_ids);
        
        if($search_result[0] == 'empty')
        {$data['search_result'] = '';
           $this->session->set_flashdata('failure','Sorry, no results found on your search for “'.$topic_name.'”');
        }
        
        if($search_result[0] == 'notopicfound')
        {
        	
           $data['search_result'] = '';
           $this->session->set_flashdata('failure','Sorry, no results matched your search for “'.$topic_name.'”');
        }
       
          list($start_date, $end_date) = $this->topic_model->week_range(date('Y-m-d'));
	      $where = array('answerd_date >='=>$start_date,'answerd_date <='=>$end_date);
	      $data['answer_count'] = $this->topic_model->recent_answers_count($where);
	      $data['adviser_count'] = $this->my_quickr_model->get_count('users',array('is_fa'=>1));
        $this->load->view('search_result',$data);
    }

    
 }
 ?>