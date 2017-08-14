<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	function __construct() {
        parent::__construct();
              
     }

 	function login_authenticate($username,$password)
    {   	
   	//$this->db->select('id,username,password');
   	$where = array('admin_username'=>$username,'admin_pass'=>md5($password));
   	//$this->db->where($where);
   	$query = $this->db->get_where('admin',$where);
      $count = $query->num_rows();
      $result = $query->result_array();
      $query2 = $this->db->get('basic_information');
	  $baseinfo=$query2->result_array();
	  $query3 = $this->db->get_where('users',array('adminuser'=>$result[0]['admin_id']));
	  $userstable=$query3->result_array();
				
      if($count)
      {
      	if(!empty($result[0]['permissionid']))
      	{
      		$permission=$result[0]['permissionid'];
      	}
      	else
      	{
      		$permission=0;
      	}
      	$user_details = array('username'=>$result[0]['admin_username'],'admin_id'=>$result[0]['admin_id'],'permissionid'=>$permission,'userid'=>@$userstable[0]['id'],'is_active'=>$result[0]['is_active'],'shortlogo'=>$baseinfo[0]['shortlogo'],'companyname'=>$baseinfo[0]['companyname']);
      	$this->session->set_userdata($user_details);
      	return $result;
      }
      else 
      {
      	return false;
      }
    }

    public function getAdmin($options  = array(),$count=NULL)
	{
		$query = 'select * from admin';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
					}
		//echo $query;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
   		if($count == 'counts')
   		{
   			return $response->num_rows();
   		}
       	else
      	{
      		return $response->result_array();
      	}
	   
      }
      else 
      {
      	return false;
      }
	}

	public function getCountry($options  = array(),$count=NULL)
	{
		$query = 'select * from constituent_countries';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
					}
		//echo $query;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
   		if($count == 'counts')
   		{
   			return $response->num_rows();
   		}
       	else
      	{
      		return $response->result_array();
      	}
	   
      }
      else 
      {
      	return false;
      }
	}

	public function addcountry($params = array(),$response=array())
	{
		 $data = array(
   					'country' => $params['country'],
   					'is_active' => '1',
				);
				
		 $this->db->insert('constituent_countries', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}

	public function editcountry($params = array(),$response = array())
	{
	$update = array(
		'country' => $params['countryname'],
		'is_active'=>$params['status']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('constituent_countries', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

	public function deletecountry($id = NULL)
	{
	 	$return = $this->db->delete('constituent_countries',array('id' => $id));
		return $return;
	}

	public function getmanagemails($options  = array(),$count=NULL)
	{
		$query = 'select * from manage_emails';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function editmanagemails($params = array(),$response = array())
	{
	    $responseval = $this->db->where('id',$params['mailtemp'])->update('manage_emails', array('content'=>htmlspecialchars($params['mail_content'],ENT_QUOTES),'subject'=>$params['mailsubject']));
		if($responseval)
		{
			$response = true;
		}
		else
		{
		 	$response = false;
		}
	    return  $response;
	 
	}

	public function getmanagepractice($options  = array(),$count=NULL)
	{
		$query = 'select * from practice_areas';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query; exit;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}

	public function addarea($params = array(),$response=array())
	{
		 $data = array(
   					'area' => $params['area'],
   					'description' => $params['description'],
   					'is_active' => $params['status'],
				);
				
		 $this->db->insert('practice_areas', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}

	public function editarea($params = array(),$response = array())
	{
	$update = array(
		'area' => $params['editarea'],
		'description' => $params['editdescription'],
		'is_active'=>$params['editstatus']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('practice_areas', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

    public function deletearea($id = NULL)
	{
	 	$return = $this->db->delete('practice_areas',array('id' => $id));
		return $return;
	}
	public function addlawyer($params = array(),$response=array())
	{
		 $data = array(
   					'firstname' => $params['firstname'],
   					'middlename' => $params['middlename'],
   					'lastname' => $params['lastname'],
   					'email' => $params['email'],
   					'company_name' => $params['companyname'],
   					'about_company' => $params['about_company'],
   					'phone_no_office' => $params['office_no'],
   					'phone_no_direct' => $params['direct_no'],
   					'website' => $params['website'],
   					'address1' => $params['address1'],
   					'address2' => $params['address2'],
   					'address3' => $params['address3'],
   					'FCA_company_no' => $params['companyfca'],
   					'free_consultation' => $params['consultation'],
   					'independent_or_restricted' => $params['independent'],
   					'disciplinary_history' => $params['disciplinary'],
   					'assets_under_advisory' => $params['assetsadvisory'],
   					'advisory_discretionary' => $params['discretionary'],
   					'city' => $params['city'],
   					'county' => $params['county'],
   					'postcode' => $params['postcode'],
   					'is_active' => $params['status'],
   					'created_at' => date('Y-m-d h:s:i')
				);
				
		 $this->db->insert('fa_master', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}
	public function editlawyer($params = array(),$response = array())
	{
	$update = array(
		'firstname' => $params['editfirstname'],
		'middlename' => $params['editmiddlename'],
		'lastname' => $params['editlastname'],
		'email' => $params['editemail'],
		'company_name' => $params['editcompanyname'],
		'about_company' => $params['editabout_company'],
		'phone_no_office' => $params['editoffice_no'],
		'phone_no_direct' => $params['editdirect_no'],
		'website' => $params['editwebsite'],
		'address1' => $params['editaddress1'],
		'address2' => $params['editaddress2'],
		'address3' => $params['editaddress3'],
		'FCA_company_no' => $params['editcompanyfca'],
		'free_consultation' => $params['editconsultation'],
		'independent_or_restricted' => $params['editindependent'],
		'disciplinary_history' => $params['editdisciplinary'],
		'assets_under_advisory' => $params['editassetsadvisory'],
		'advisory_discretionary' => $params['editdiscretionary'],
		'city' => $params['editcity'],
		'county' => $params['editcounty'],
		'postcode' => $params['editpostcode'],
		'is_active' => $params['editstatus'],
		'updated_at' => date('Y-m-d h:s:i')
	 );
	
	 $responseval = $this->db->where('id',$params['editid'])->update('fa_master', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
	public function getcounties($options  = array(),$count=NULL)
	{
		$query = 'select * from counties';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query; exit;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function getmasterlaw($options  = array(),$count=NULL)
	{
		$query = 'select * from fa_master';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query; exit;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function deletmasterlaw($id = NULL)
	{
	 	$return = $this->db->delete('fa_master',array('id' => $id));
		return $return;
	}
	public function getUsers($options  = array(),$count=NULL)
	{
		$query = 'select * from users';
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query; exit;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function getjoin($options  = array(),$count=NULL)
	{
		if(isset($options['query']))
		{
		$query =$options['query'];	
		}
		else
		{
		$query = 'select * from users';
        }
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query;  
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function getRecord($options  = array(),$count=NULL)
	{
		
		$query = 'select * from '.$options['table'];
        
		if(isset($options['key']))
		{
			$query .= $options['key'].' ';
		}
		if(isset($options['offset']))
		{
			$options['offset'] = !empty($options['offset']) ? $options['offset'] : 0;
			$query .= " limit ".$options['offset'].",".$options['limit'];
		}
		//echo $query; exit;
		$response = $this->db->query($query);
		if($response->num_rows() > 0)
   		{
	   		if($count == 'counts')
	   		{
	   			return $response->num_rows();
	   		}
	       	else
	      	{
	      		return $response->result_array();
	      	}
	   
      	}
	    else 
	    {
	    	return false;
	    }
	}
	public function editreguser($params = array(),$response = array())
	{
	$update = array(
		'is_fa' => $params['adviser'],
		'is_verified' => $params['editverification'],
		'is_blocked'=>$params['editstatus']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('users', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function deletereguser($id = NULL)
	{
	 	$return = $this->db->delete('users',array('id' => $id));
		return $return;
	}

    public function edituser($params = array(),$response = array())
	{
	$update = array(
		'is_fa' => $params['editadviser'],
		'is_verified' => $params['editverification'],
		'is_blocked'=>$params['editstatus']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('users', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    
    public function deleteuser($id = NULL)
	{
	 	$return = $this->db->delete('users',array('id' => $id));
		return $return;
	}

	public function addcounty($params = array(),$response=array())
	{
		 $data = array(
   					'name' => $params['countyname'],
   					'country' => $params['country'],
   					'latitude' => $params['latitude'],
   					'longitude' => $params['longitude'],
   					'description' => $params['description'],
   					'image' => $params['imagename'],
   					'is_active' => '1',
				);
				
		 $this->db->insert('counties', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}
	public function editcounty($params = array(),$response = array())
	{
	$update = array(
		'name' => $params['editname'],
		'country' => $params['editcountry'],
		'latitude' => $params['editlat'],
		'longitude' => $params['editlong'],
		'description' => $params['editdesc'],
		'image' => $params['imagename'],
		'is_active' => $params['editstatus'],
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('counties', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
	public function deletecounty($id = NULL)
	{
	 	$return = $this->db->delete('counties',array('id' => $id));
		return $return;
	}
	public function addcity($params = array(),$response=array())
	{
		 $data = array(
   					'name' => $params['cityname'],
   					'county_id' => $params['county'],
   					'country_id' => $params['country'],
   					'latitude' => $params['latitude'],
   					'longitude' => $params['longitude'],
   					'description' => $params['description'],
   					'image' => $params['imagename'],
   					'is_active' => '1',
				);
				
		 $this->db->insert('cities', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}
	public function editcity($params = array(),$response = array())
	{
	$update = array(
		'name' => $params['editcityname'],
		'country_id' => $params['editcountry'],
		'county_id' => $params['editcounty'],
		'latitude' => $params['editlat'],
		'longitude' => $params['editlong'],
		'description' => $params['editdesc'],
		'image' => $params['imagename'],
		'is_active' => $params['editstatus'],
	 );

	 $responseval = $this->db->where('id',$params['id'])->update('cities', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function deletecity($id = NULL)
	{
	 	$return = $this->db->delete('cities',array('id' => $id));
		return $return;
	}
	public function editbaseinfo($params = array(),$response = array())
	{
	$update = array(
		'adminmail' => $params['adminemail'],
		'companyname' => $params['companyname'],
		'shortlogo' => $params['shortlogo'],
		'loginlogo'=>$params['loginlogo']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('basic_information', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function addtopic($params = array(),$response=array())
	{
		 $data1 = array(
   					'name' => $params['name'],
   					'description' => htmlspecialchars($params['description'],ENT_QUOTES),
   					'is_parent'=> $params['parent'],
   					'is_active' => 1,
				);
		 /*if(!empty($params['relatedtopic']))
		 {
		 	$relatedtopics=implode(',',$params['relatedtopic']);
		 	$data1['relatedtopic']=$relatedtopics ;
		 }*/
		
		 
		 $this->db->insert('topics', $data1);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 	 if($params['parent']==0 && (!empty($response)))	
			 {
			 	$data2['parent']= $response;
			 	$data2['child']= $params['topic'];
			 	$this->db->insert('topics_mapping', $data2);
			 	//$response = $this->db->insert_id();
			 }
			 
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}
	public function edittopic($params = array(),$response = array())
	{
		if(!empty($params['editparent']))
		{
		if(!empty($params['mapid']))
		{
		$this->db->delete('topics_mapping',array('id' => $params['mapid']));	
	    }
		}
		else
		{
		if(!empty($params['mapid']))
		{
		$where = array('id'=>$params['mapid']);
   	 	$query = $this->db->get_where('topics_mapping',$where);
      	$count = $query->num_rows();
      	if(!empty($count))
      	{
      		$result = $query->result_array();
      		if($result[0]['child']!=$params['edittopic'])
      		{
      			$this->db->where('id',$params['mapid'])->update('topics_mapping', array('child'=>$params['edittopic']));
      		}
      	}
		}
		else
		{
		$data2['parent']= $params['id'];
	 	$data2['child']= $params['edittopic'];
	 	$this->db->insert('topics_mapping', $data2);	
		}
	    }
	$update = array(
		'is_parent' => $params['editparent'],
		'name' => $params['editname'],
		'description' => $params['editdescription'],
		'is_active' => $params['editstatus'],
	 );

	 $responseval = $this->db->where('id',$params['id'])->update('topics', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function deletetopic($id1 = NULL,$id2 = NULL)
	{	
		if(!empty($id2))
		{
		$this->db->delete('topics_mapping',array('id' => $id2));
	    }
	 	$return = $this->db->delete('topics',array('id' => $id1));
		return $return;
	}
	public function commonsetting($params = array(),$response = array())
	{
	if(!empty($params['topic']))
	{
	$topicim=implode(',', $params['topic']);
    }
    if(!empty($params['common_quest']))
    {
	if(!empty($params['commonquestid']))
	{
	if(!empty($topicim))
	{
	$update1 = array(
		'topics_tagged'=>@$topicim
	 );
	$responseval = $this->db->where('id',$params['commonquestid'])->update('common_questions', $update1);
	}
    }
    else
    {
    	$data1=array();
    	$data1 = array(
   					'quest_id' => $params['questid']
				);
    	if(!empty($topicim))
		{
			$data1['topics_tagged']=@$topicim;
		}
		 $this->db->insert('common_questions', $data1);
		 $responseval =$this->db->insert_id();
    }
	}
	else
	{
		$responseval = $this->db->delete('common_questions',array('id' => $params['commonquestid']));
	}
	 
	 if($responseval){
	 	$response = true;
	 }
	 else{
	 	$response = false;
	 }
	 return  $response;
    }
	public function editsetting($params = array(),$response = array())
	{
	 $update2 = array(
		'status'=>$params['status'],
	 );
	$responseval = $this->db->where('id',$params['qid'])->update('client_questions', $update2);
	 if($responseval){
	 	$response = true;
	 }
	 else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function published($params = array(),$response = array())
	{
	 $update = array(
		'status'=>$params['status'],
	 );
	$responseval = $this->db->where('id',$params['Aid'])->update('legal_answers', $update);
	 if($responseval){
	 	$response = true;
	 }
	 else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function addanswer($params = array(),$response=array())
	{
		 $data = array(
   					'quest_id' => $params['id'],
   					'adviser_id'=> @$this->session->userdata['userid'],
   					'answer' => $params['answer'],
   					'status' => 1,
				);
		 $this->db->insert('legal_answers', $data);

		 if($this->db->insert_id())
		 {
		 	$response = $this->db->insert_id();
		 }
		 else
		 {
		 	$response = false;
		 }
		 return  $response;
	}
	public function addtips($params = array(),$response=array())
	{
		 $data = array(
   					'title' => $params['title'],
   					'template_type' => $params['template'],
   					'video_url' => $params['videourl'],
   					'rating' => $params['rating'],
   					'user_id' => @$this->session->userdata['userid'],
   					'status' => 1,
				);
		 if(!empty($params['description']))
		 {
		 	$data['description'] =htmlspecialchars($params['description'],ENT_QUOTES);
		 }
		 else
		 {
		 	$data['description'] ='';
		 }
		 if(!empty($params['topic']))
		 {
		 	$data['topic']=implode(',', $params['topic']);
		 }
				
		 $this->db->insert('tips', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }
		 else
		 {
		 	$response = false;
		 }
		 return  $response;
		 }
	public function edittips($params = array(),$response = array())
	{

	if($params['edittemplate']==2)
	{
		$video=$params['editvideourl'];
	}
	else
	{
		$video='';
	}
	$update = array(
		'title' => $params['edittitle'],
		
		'template_type' => $params['edittemplate'],
		'video_url' => $video,
		'rating' => $params['editrating'],
		'user_id' => @$this->session->userdata['userid'],
		'status' => $params['editstatus'],
	 );
	if(!empty($params['editdescription']))
		 {
		 	$update['description'] =htmlspecialchars($params['editdescription'],ENT_QUOTES);
		 }
		 else
		 {
		 	$update['description'] ='';
		 }
	if(!empty($params['edittopic']))
		 {
		 	$update['topic']=implode(',', $params['edittopic']);
		 }
		 
	 $responseval = $this->db->where('id',$params['id'])->update('tips', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function deletetips($id = NULL)
	{
	 	$return = $this->db->delete('tips',array('id' => $id));
		return $return;
	}
	public function addlanguage($params = array(),$response=array())
	{
		 $data = array(
   					'language' => $params['language'],
   					'status' => '1',
				);
				
		 $this->db->insert('languages', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}

	public function editlanguage($params = array(),$response = array())
	{
	$update = array(
		'language' => $params['editlanguage'],
		'status'=>$params['status']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('languages', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

	public function deletelanguage($id = NULL)
	{
	 	$return = $this->db->delete('languages',array('id' => $id));
		return $return;
	}
	public function addfeetype($params = array(),$response=array())
	{
		 $data = array(
   					'type' => $params['feetype'],
   					'status' => '1',
				);
				
		 $this->db->insert('fee_types', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}

	public function editfeetype($params = array(),$response = array())
	{
	$update = array(
		'type' => $params['editfeetype'],
		'status'=>$params['status']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('fee_types', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

	public function deletefeetype($id = NULL)
	{
	 	$return = $this->db->delete('fee_types',array('id' => $id));
		return $return;
	}
	public function addpaytype($params = array(),$response=array())
	{
		 $data = array(
   					'type' => $params['paytype'],
   					'status' => '1',
				);
				
		 $this->db->insert('payment_types', $data);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}

	public function editpaytype($params = array(),$response = array())
	{
	$update = array(
		'type' => $params['editpaytype'],
		'status'=>$params['status']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('payment_types', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

	public function deletepaytype($id = NULL)
	{
	 	$return = $this->db->delete('payment_types',array('id' => $id));
		return $return;
	}
	public function editreview($params = array(),$response = array())
	{
	$update = array(
		'overall_rating' => $params['rating'],
		'status'=>$params['status']
	 );
	
	 $responseval = $this->db->where('id',$params['id'])->update('client_reviews', $update);
	  if($responseval){
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }

    public function deletereview($id = NULL)
	{
	 	$return = $this->db->delete('client_reviews',array('id' => $id));
		return $return;
	}
	public function addadminuser($params = array(),$response=array())
	{

		 $data1 = array(
   					'admin_username' => $params['username'],
   					'admin_pass' => md5($params['pass']),
   					'email' => $params['email'],
   					'is_active' => '1',
				);
		if(!empty($params['permission']))
		{
   			$data1['permissionid']=implode(',', $params['permission']);
		}	
		 $this->db->insert('admin', $data1);

		 if($this->db->insert_id()){
		 	$response = $this->db->insert_id();
		 	$data2 = array(
   					'email' => $params['email'],
   					'password' => md5($params['pass']),
   					'firstname' => $params['username'],
   					'displayname' => $params['username'],
   					'is_fa' => 2,
   					'adminuser' => $response,
				);
		 	$this->db->insert('users', $data2);
		 }else{
		 	$response = false;
		 }
		 return  $response;
	}
	public function editadminuser($params = array(),$response = array())
	{
	$update = array(
		'admin_username' => $params['editusername'],
		'email' => $params['editemail'],
		'is_active' => $params['editstatus'],
	 );
	if(!empty($params['editpass']))
		{
   			$update['admin_pass']=md5($params['editpass']);
		}
	if(!empty($params['editpermission']))
		{
   			$update['permissionid']=implode(',', $params['editpermission']);
		}
	 $responseval = $this->db->where('admin_id',$params['id'])->update('admin', $update);
	  if($responseval){
	  	$updateuser = array(
   					'email' => $params['editemail'],
   					'firstname' => $params['editusername'],
   					'displayname' => $params['editusername'],
				);
	  	if(!empty($params['editpass']))
		{
   			$updateuser['password']=md5($params['editpass']);
		}
		$this->db->where('adminuser',$params['id'])->update('users', $updateuser);
	 	$response = true;
	 }else{
	 	$response = false;
	 }
	 return  $response;
    }
    public function deleteadminuser($id = NULL)
	{
	 	$return = $this->db->delete('admin',array('admin_id' => $id));
	 	$this->db->delete('users',array('adminuser' => $id));
		return $return;
	}
	public function changepassword($params = array(),$response = array())
	{
	$where = array('admin_id'=>$params['id'],'admin_pass'=>md5($params['choldpass']));
	$query = $this->db->get_where('admin',$where);
  	$count = $query->num_rows();
  	if(!empty($count))
  	{
  		$update = array(
		'admin_pass' => md5($params['chpass']),
	     );
  		$responseval = $this->db->where('admin_id',$params['id'])->update('admin', $update);
  		if($responseval){
	  	$updateuser = array(
   					'password' => md5($params['chpass']),
				);
		$this->db->where('adminuser',$params['id'])->update('users', $updateuser);
		
  		}
  		$response = true;
  		}	
	 else{
	 	$response = false;
	 }
	 return  $response;
    }
   
	
}