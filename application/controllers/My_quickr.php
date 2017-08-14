<?php
class My_quickr extends CI_Controller {

    public function __construct()
       {
            parent::__construct();
            $this->load->model('my_quickr_model');
            $this->load->model('topic_model');
            $this->data = array();
            $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';	
	        if($user['id'] != '')
	        {
	         $quests = array();
	       	 $saved_quest = $this->my_quickr_model->select_from('saved_questions','quest_id',array('client_id'=>$user['id']));
	         
	         $this->data = array('saved_quest' => count($saved_quest));
	        }

            
       }

    public function ask_question()
    {
    	//print_r($this->session->userdata);exit;
    	// if(!$this->session->has_userdata('logged_in'))
     //    {
     //    	redirect('/', 'location', 301);
     //    }
        $data= array();
        if($this->input->post('commit'))
        {
            $status = '-1';
                $user = $this->session->userdata('logged_in');
        	$insert_data = array(
        		'client_id' => $user['id'],
        		'subject' => $this->input->post('quest'),
        		'detail' => $this->input->post('quest_detail'),
        		'location' => $this->input->post('city_state'),
        		'status' =>$status
        		);
            if($this->input->post('quest_id') == '')    
        	$id = $this->my_quickr_model->insert_data('client_questions',$insert_data);
            else
            {
            	$where = array('id' => $this->input->post('quest_id'));
            	$res = $this->my_quickr_model->update_data('client_questions',$insert_data,$where);	
                $id = $this->input->post('quest_id');
            }
        	if($id)
        		redirect('legal-question-preview/'.$id);
        }
        if($this->input->post('update'))
        {
        	$table = 'client_questions';
	    	$field = '*';
	    	$where = array('id' => $this->input->post('q_id'));
	        $data['question'] = $this->my_quickr_model->select_from($table,$field,$where);
        }
        $data['topics'] = $this->topic_model->fetch_topics();
        $this->load->view('questions',$data);
    }

    function question_preview($id)
    {
    	
    	$table = 'client_questions';
    	$field = '*';
    	$where = array('id' => $id);
        $data['question'] = $this->my_quickr_model->select_from($table,$field,$where);
        $data['sp_area']= $this->my_quickr_model->select_from('topics','*',array('is_parent'=>1));
        if($this->input->post('publish'))
        {
        	$where = array('id' => $this->input->post('quest_id'));
        	$update_data = array('status' => '1','topic' => implode(',', $this->input->post('category')));
            $id = $this->my_quickr_model->update_data('client_questions',$update_data,$where);
            $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';	
            
            if($user['id'] != '')
            {
	            $datas = array(
	            	'quest_id' => $this->input->post('quest_id'),
	            	'client_id' =>$user['id'],
	            	'status' => '1');
	            $result = $this->my_quickr_model->insert_data('saved_questions',$datas);
            }
            $msg = 'Your question has been published and save to you <a href="'.site_url('my_quickr/questions').'"> My Questions </a> tab. <br/>
                     To recive answers by email as they are posted, <a href="'.site_url('account/notifications').'"> Click Here </a> to change you Q&A Forum notification preferences';
            $this->session->set_flashdata('Success', $msg );
            redirect('legal-answer/'.$this->input->post('quest_id'));
        }

        $this->load->view('question_preview',$data);
    }

    function add_additional_info()
    {
    	$table='client_questions';
    	$data= array('add_info' => $this->input->post('info'));
    	$where = array('id' => $this->input->post('id'));
    	$id = $this->my_quickr_model->update_data($table,$data,$where);
    	echo $id;
    	exit;	
    }

    function questions($id='')
    {
        $table = 'client_questions';
	    $field = '*';
	    $where = array('status' => '1');
	    if($id != '')
	    $where = array('client_id' => $id,'status' => '1');
	    $order_by = array('id' => 'desc');
        
	    $data['questions'] = $this->my_quickr_model->select_from($table,$field,$where,$order_by);
       
        if($this->session->has_userdata('logged_in'))
          $data = $data + $this->data;
        
        $search_topic = $search_location = '';
        if($this->session->has_userdata('search_by_topic'))
        {
            $search = $this->session->userdata('search_by_topic');
            $search_topic = $search['topicname'];
            $search_location = $search['location'];
        }
        
        $data['recent_questions'] = $this->my_quickr_model->recent_question($search_topic,$search_location);
        
        $this->load->view('questions_list',$data);
    }

    function legal_answers($quest_id)
    {
    	
    	$table = 'client_questions';
	    $field = '*';
	    $where = array('id' => $quest_id);
	    $data['questions'] = $this->my_quickr_model->select_from($table,$field,$where);
        $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';	
        
        if($user['id'] != '')
        {
         $quests = array();
         $saved_quest = $this->my_quickr_model->select_from('saved_questions','quest_id',array('client_id'=>$user['id']));
         foreach($saved_quest as $sav){
         	$quests[]= $sav['quest_id'];
         }
         $data['saved_quest'] = $quests;
         
        }
        $data['answers'] = $this->my_quickr_model->select_from('legal_answers','*',array('quest_id' =>$quest_id ),array('id'=>'desc'),'5');
        $datetime1 = new DateTime($data['questions'][0]['submitted_date']);
        $datetime2 = new DateTime("now");
		$data['remaining_time'] = $datetime1->diff($datetime2);
        $related_topics = array();
        if($data['questions'][0]['topic'] != '')
           {
             $topics = explode(',',$data['questions'][0]['topic']);
             foreach($topics as $topic){
             $related_topics[] = $this->topic_model->get_related_topic(1,$topic);
             }
           }
        $data['related_topic'] = array();
           if(!empty($related_topics))
           {
             foreach($related_topics as $topics){
              foreach($topics as $topic){
                 array_push($data['related_topic'], $topic);
             }
            }
           }
       
        $data['related_tips'] = $this->my_quickr_model->get_tips($data['questions'][0]['topic'],10);
        $data['others_asking'] = $this->my_quickr_model->get_questions($data['questions'][0]['topic'],$data['questions'][0]['id'],10);
		$data['alltopics'] = $this->topic_model->fetch_topics();
		
		list($start_date, $end_date) = $this->topic_model->week_range(date('Y-m-d'));
	    $where = array('answerd_date >='=>$start_date,'answerd_date <='=>$end_date);
	    $data['answer_count'] = $this->topic_model->recent_answers_count($where);
	    $data['adviser_count'] = $this->my_quickr_model->get_count('users',array('is_fa'=>1));
        
        
        $this->load->view('quest_answer',$data);
    }

    function save_advice($id,$client_id)
    {

    	$table = 'saved_questions';
    	$datas = array('quest_id' => $id,'client_id'=>$client_id,'status'=>'1');
    	$result = $this->my_quickr_model->insert_data('saved_questions',$datas);
    	if($result)
    	{
    		$this->session->set_flashdata('Success',"Selected Question has been saved in advice list");
    		redirect('legal-answer/'.$id);
    	}

    }

    function advice()
    {
        $table = 'saved_questions';
	    $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
        $user_id = $user['id'];
	    $where = array('s.client_id' => intVal($user_id));
	    $data['questions'] = $this->my_quickr_model->get_saved_questions($table,$where);
        $search_topic = $search_location = '';
        if($this->session->has_userdata('search_by_topic'))
        {
            $search = $this->session->userdata('search_by_topic');
            $search_topic = $search['topicname'];
            $search_location = $search['location'];
        }
        $data['recent_questions'] = $this->my_quickr_model->recent_question($search_topic,$search_location);
        $data = $data + $this->data;
        $this->load->view('saved_advice',$data);
    }

    function remove_advice($id)
    {
    	$table = 'saved_questions';
    	$where = array('id' => intVal($id));
    	$result = $this->my_quickr_model->delete_from($table,$where);
    	if($result)
    	{
    		$this->session->set_flashdata('Success','Selected Advice removed from saved list');
    		redirect('My_quickr/advice');
    	}
    	else
    	{
    		$this->session->set_flashdata('Failure','Remove process failed. Please Try Again');
    		redirect('My_quickr/advice');
    	}
    }

    function add_answer()
    {
    	 $table ="legal_answers";
    	 $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
         $user_id = $user['id'];
    	 $data = array(
    	 	'quest_id' => $this->input->post('id'),
    	 	'adviser_id' => $user_id,
    	 	'answer' => $this->input->post('answer'));
    	 $result = $this->my_quickr_model->insert_data($table,$data);
    	 if($result)
    	 {
    	 	$this->session->set_flashdata('Success','Answer has been posted successfully');
    	 	echo '1';
    	 }
    	 else
    	 {
    	 	$this->session->set_flashdata('Failure','Answer was not posted properly. Please Try Again!');
    	 	echo '0';
    	 }
    	 exit;
    }

    function flag_question()
    {
    	$user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
        $user_id = $user['id'];
        $data = array(
        	'quest_id' => $this->input->post('quest_id'),
        	'user_id' => $user_id,
        	'flag' => 1
        	);
        $result = $this->my_quickr_model->insert_data('question_flag',$data);
    	echo $result;exit;
    }

    function quest_additional_process()
    {
    	
    	$user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
        $user_id = $user['id'];
    	if($this->input->post('operation') == 'insert')
    	{

    		$data = array(
               $this->input->post('field') => $this->input->post('value'),
               'quest_id' => $this->input->post('quest_id'),
               'answer_id' => $this->input->post('answer_id'),
               'status' => 1,
               'input_by' => $user_id
    			);
    		$result = $this->my_quickr_model->insert_data('quset_additional_process',$data);
    		echo $result;exit;
    	}
    	if($this->input->post('operation') == 'delete')
    	{
    		$where = array(
              $this->input->post('field') => $this->input->post('value')
    			);
    		$result = $this->my_quickr_model->delete_from('quset_additional_process',$where);
            echo $result;exit;
    	}
    }

    function comment_list()
    {
    	$cwhere = array(
            'quest_id' => $this->input->post('quest_id'),
            'answer_id' => $this->input->post('answer_id'),
            'comment IS NOT NULL' => null,
            'status' => 1,
            );
        $order_by = array(
            'submitted_date' => 'desc'
            );
        $comment = $this->my_quickr_model->select_from('quset_additional_process','*',$cwhere,$order_by);
        $out = '';
        foreach($comment as $comm) { 
        	
       	 $out .= '<div class="rlb-activity">                   
                    <div class="rlba-lft">
                        <img src="http://local.quickr.com/quickr/src/images/rdba-pic.jpg">
                    </div>
                    <div class="rlba-rgt">
                    <p> '.$comm['comment'].'</p>
                    <p> Commented '.$this->my_quickr_model->time_cal(strtotime($comm['submitted_date'])) .'
                    by <span> '.$this->my_quickr_model->get_name_by_id($comm['input_by']).'</span> </p>
                    </div>
                </div>';
         }
         echo $out;
         exit;

    }

    function add_tags()
    {
    	$data = array(
    		'category' => implode(',',$this->input->post('tags')));
    	$where = array('id' => $this->input->post('quest_id'));

    	$update = $this->my_quickr_model->update_data('client_questions',$data,$where);
    	if($update)
    	{
    		$out['status'] = 1;
    		$tags = $this->input->post('tags');
    		$html = '';
    		foreach($tags as $tag)
                {
                    $tag_name =  $this->my_quickr_model->get_by_id('topics','name',$tag);
                    $html .= "<span class='btn-tag btn-blue' >".$tag_name."<span class='badge'><a class='delete_tag' data-id='".$tag."'>X</a></span></span>";
                }
            
            $out['content'] = $html.' - <a class="add_category btn-link">Edit</a>';
            echo json_encode($out);
            exit;
    	}
    	else
    	{
    		$out['status'] = 0;
    		echo json_encode($out);
            exit;
    	}
    }

    function delete_tags()
    {
    	
    	$category = $this->my_quickr_model->get_by_id('client_questions','category',$this->input->post('quest_id'));
        
        $cat_array = explode(',', $category);
        $pos = array_search($this->input->post('id'), $cat_array);
        
        if($pos !== FALSE)
        {
        	unset($cat_array[$pos]);
        	$data = array('category'=>implode(',',$cat_array));
        	$where = array('id'=>$this->input->post('quest_id'));
        	$update = $this->my_quickr_model->update_data('client_questions',$data,$where);
            echo $update;
            exit;
        }
        echo '0';
        exit;

    }

    function city_suggest()
    {
        $city = $this->input->post('city');
        $result = $this->my_quickr_model->select_city($city);
        //print_r($result);
        $out = '<ul>';
        foreach($result as$value)
        {
           $out .= '<li onclick="fill(\''.$value.'\')">'.$value.'</li>';
        }
        $out .= '</ul>';
        echo $out;exit;
    }

    function adviser_valid_check()
    {
        $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
        $user_id = $user['id'];
        $valid = $this->my_quickr_model->select_from('users','is_verified,is_blocked',array('id'=>$user_id));
        if($valid[0]['is_verified'] && !$valid[0]['is_blocked'])
        {
            echo '1';
        }
        else if(!$valid[0]['is_verified']){
            $this->session->set_flashdata('Failure','Unverified Advisers cannot answer questions');
            echo '-1';
        }
        else if($valid[0]['is_blocked']){
            $this->session->set_flashdata('Failure','Account has been blocked. Contact Admin to answer questions.');
            echo '0';
        }
        exit;
    }

    function write_review($id)
    {
        if($id != '')
        {
            $fa_user = $this->my_quickr_model->select_from('users','is_fa',array('id'=>$id));
            if($fa_user[0]['is_fa'])
            {
                $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
                $user_id = $user['id'];
                if(!$user['is_fa']){
               
                $display_name = $this->my_quickr_model->select_from('users','email,firstname,displayname',array('id'=>$user_id));
                if($display_name[0]['firstname'] != NULL)
                    $name = $display_name[0]['firstname'];
                elseif($display_name[0]['displayname'] != NULL)
                    $name = $display_name[0]['displayname'];
                else
                {
                    $email_split = explode('@', $display_name[0]['email']);
                    $name = $email_split[0];
                }
                $data['display_name'] = $name;
                $data['adviser_id'] = $id;
                $data['user_id'] = $user_id;
                $data['user_email'] = $display_name[0]['email'];
                $this->load->view('review_form',$data);
                
                }
            }
            else
                redirect('home');

        }
        else
            redirect('home');
    }

    function save_review()
    {
        
        $displayname = ($this->input->post('review_anonymous') == 0)?$this->input->post('review_display_name'):'';
        $insert_data = array(
            'fa_id' => $this->input->post('adviser_id'),
            'user_id' => $this->input->post('client_id'),
            'title' => $this->input->post('review_title'),
            'review' => $this->input->post('review_body'),
            'overall_rating' => $this->input->post('overall_rating'),
            'trustworthy' => $this->input->post('trust_rating'),
            'responsive' => $this->input->post('response_rating'),
            'knowledgeable' => $this->input->post('knowledge_rating'),
            'kept_informed' => $this->input->post('informed_rating'),
            'has_recommend' => $this->input->post('review_recommended'),
            'firstname' => $displayname,
            'can_show_name' => $this->input->post('review_anonymous'),
            'email' => $this->input->post('client_email'),
            );
        $result = $this->my_quickr_model->insert_data('client_reviews',$insert_data);
        if($result)
        {
             $name = $this->my_quickr_model->get_name_by_id($this->input->post('adviser_id'));
             $this->session->set_flashdata('Success','Your review of '.$name.' has been submitted for approval.
                                                       Reviews are typically approved in 1-3 days.');
             redirect('review_confirmation/'.$result);
        }
        else
        {
            $this->session->set_flashdata('Failure','Your review of '.$name.' was not successfull. Please try again!');
        }
        
    }

    function review_confirmation($review_id)
    {
        echo $review_id;
        $this->load->view('review_confirm',$data);
    
    }

    function reviews()
    {
        $user = ($this->session->has_userdata('logged_in'))?$this->session->userdata('logged_in'):'';
        $user_id = $user['id'];
        $data['reviews'] = $this->my_quickr_model->select_from('client_reviews','*',array('user_id'=>$user_id));
        $this->load->view('my_reviews',$data);
    }
    	
}
?>
