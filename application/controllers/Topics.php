<?php
class Topics extends CI_Controller {

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

    public function index()
    {
     
    	$data['topics'] = $this->topic_model->fetch_topics();
    	$data['recent_answers'] = $this->topic_model->fetch_recent_answers();
        $this->load->view('research_advice',$data);
    }

    public function topic($name)
    {
       $name = str_replace('-',' ',$name);
       $data['topic'] = $this->topic_model->get_topic_detail($name);
       $data['related_topic'] = $this->topic_model->get_related_topic($data['topic']['is_parent'],$data['topic']['id']);
       $data['recent_questions'] = $this->topic_model->get_recent_questions($data['topic']['id']);
       $data['common_questions'] = $this->topic_model->get_common_questions($data['topic']['id']);
       $data['tips'] = $this->topic_model->get_top_tips($data['topic']['id'],6);
       $this->load->view('topic_page',$data);
    }

    public function tips($name)
    {
       $name = str_replace('-',' ',$name);
       $data['tips'] = $this->topic_model->get_tip_detail($name);
       $related_tips = array();
       if($data['tips']['topic'] != '')
       {
         $topics = explode(',',$data['tips']['topic']);
         foreach($topics as $topic){
         $related_tips[] = $this->topic_model->get_top_tips($topic,8);
         }
       }
       $data['related_tips'] = array();
       if(!empty($related_tips))
       {
         foreach($related_tips as $tips){
          foreach($tips as $tip){
            
            if($tip['id'] != $data['tips']['id'])
              array_push($data['related_tips'], $tip);
         }
        }
       }
       if($this->session->has_userdata('logged_in'))
        {
          $user = $this->session->userdata('logged_in');
          $user_id = $user['id'];
          $data['vote'] = $this->my_quickr_model->select_from('tips_vote','id',array('user_id'=>$user_id,'tips_id'=>$data['tips']['id']));
        }
       $this->load->view('tips_page',$data);
    }

    function vote_tips()
    {
      if($this->session->has_userdata('logged_in'))
      {
          $user = $this->session->userdata('logged_in');
          $user_id = $user['id'];
          $data = array(
            'tips_id' => $this->input->post('id'),
            'vote' => $this->input->post('value'),
            'user_id' => $user_id
            );
          $result = $this->my_quickr_model->insert_data('tips_vote',$data);
          if($result)
           {
              echo '1';
           }
          else
           {
            
            echo '0';
           }
           exit;
      }
      else
        redirect('account/login');
     
    }

    function all_topics($letter='a')
    {
       $data['topics'] = $this->topic_model->get_topic_by_letter($letter);

       $this->load->view('topic_search',$data);
    }

    function recent_answers()
    {
      $limit = '20';
      $offset = ($this->uri->segment(3) != '')?$this->uri->segment(3):0;
      $config = array( 'base_url' => site_url('free-financial-advice/recent'),
                         'per_page' => $limit,
                         'total_rows' => $this->topic_model->recent_answers_count(),
                         'num_links' => 5,
                         'uri_segment' => 3,
                         'full_tag_open' => '<div class="pagination full-width">',
                         'full_tag_close' => '</div>',
                         'prev_link' => '<i class="fa fa-arrow-left"></i>',
                         'next_link' => '<i class="fa fa-arrow-right"></i>',
                         'cur_tag_open' => '<span class="current">',
                         'cur_tag_close' => '</span>');
      
      $this->pagination->initialize($config);

      list($start_date, $end_date) = $this->topic_model->week_range(date('Y-m-d'));
      $where = array('answerd_date >='=>$start_date,'answerd_date <='=>$end_date);
      $data['answer_count'] = $this->topic_model->recent_answers_count($where);
      $data['adviser_count'] = $this->my_quickr_model->get_count('users',array('is_fa'=>1));



      $data['recent_answers'] = $this->topic_model->fetch_recent_answers($limit,$offset);
      $this->load->view('all_recent_answer',$data);
    }

    function advice($arg){
      $data['arg_topic'] = $arg;

       $name = str_replace('-',' ',$arg);
       $data['topic'] = $this->topic_model->get_topic_detail($name);
       $data['related_topic'] = $this->topic_model->get_related_topic($data['topic']['is_parent'],$data['topic']['id']);
       
       $type = (isset($_GET['type']) && $_GET['type'] != '')?$_GET['type']:'';
       $total =20;
       switch($type)
       {
          case 'guide':
            {
              $total = $this->topic_model->get_tips_count($data['topic']['id']);
              break;
            }
          case 'question':
          {
            $total = $this->topic_model->get_question_count($data['topic']['id']);
            break;
          }
       }

      $limit = '10';
      $offset = ($this->uri->segment(4) != '')?$this->uri->segment(4):0;

      if($type == ''){
        $all_data = $this->topic_model->get_tips_questions($data['topic']['id']);
        $total = count($all_data);
        $data['list_data'] = array_slice($all_data,$offset,$limit); 
      }
      

      
     
      $config = array( 

                       'base_url' => site_url('topic/'.$arg.'/advice'),
                       'per_page' => $limit,
                       'total_rows' => $total,
                       'num_links' => 2,
                       'uri_segment' => 4,
                       'full_tag_open' => '<div class="pagination full-width">',
                       'full_tag_close' => '</div>',
                       'prev_link' => '<i class="fa fa-arrow-left"></i>',
                       'next_link' => '<i class="fa fa-arrow-right"></i>',
                       'cur_tag_open' => '<span class="current">',
                       'cur_tag_close' => '</span>');
      if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
      $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
      $config['last_link'] = $config['first_link'] = false; 
      $this->pagination->initialize($config);

       if($type == 'guide')
        $data['list_data'] = $this->topic_model->get_tips($data['topic']['id'],$limit,$offset);
       else if($type == 'question')
        $data['list_data'] = $this->topic_model->get_questions($data['topic']['id'],$limit,$offset);
      
      list($start_date, $end_date) = $this->topic_model->week_range(date('Y-m-d'));
      $where = array('answerd_date >='=>$start_date,'answerd_date <='=>$end_date);
      $data['answer_count'] = $this->topic_model->recent_answers_count($where);
      $data['adviser_count'] = $this->my_quickr_model->get_count('users',array('is_fa'=>1));
      
      $this->load->view('all_advice',$data);
    }

    
  }
?>
