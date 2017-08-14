<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_quickr_model extends CI_Model {
	function __construct() {
        parent::__construct();
              
     }

    function insert_data($table,$data)
    {
    	$this->db->insert($table,$data);
    	return $this->db->insert_id(); 
    }

   function select_from($table='',$select = array(),$where =array(),$order_by = array(),$limit='')
   {
   	if(!empty($select))
   	  $this->db->select($select);
   	
   	if(!empty($where))
   	  $this->db->where($where);
    
   	if(!empty($order_by))
   	{
	   	foreach($order_by as $key=>$value)
	   	{
	   	  $this->db->order_by($key,$value);
	   	}
   	}

   	if($limit != '')
   		$this->db->limit($limit);
   	  
   	$result = $this->db->get($table);
   
   	return $result->result_array();
   }

   function update_data($table='',$values = array(),$where = array())
   {
   	if(!empty($where))
   	  $this->db->where($where);
   	  
   	$result = $this->db->update($table, $values); 
   	//debug_last_query();
   	if($result){
   		return true;
   	}else{
   		return false;
   	}
   }

   function delete_from($table='',$where=array())
   {
   	if(!empty($where))
   	  $this->db->where($where);
   	  
   	$result = $this->db->delete($table); 
   
   	if($result){
   		return true;
   	}else{
   		return false;
   	}
   }

   function get_saved_questions($table,$where=array())
   {
   	  $data= array();
   	  $this->db->select('q.*,s.id as sid');
   	  $this->db->join('client_questions q','q.id=s.quest_id');
   	  if(!empty($where))
   	  	$this->db->where($where);
   	  $this->db->where('q.status',1);
   	  $result = $this->db->get('saved_questions s');
   	  
   	  if($result->num_rows() > 0)
   	  {
   	  	foreach($result->result_array() as $row)
   	  	{
   	  		$data[] = $row;
   	  	}

   	  }
   	 
   	  return $data;

   }

   function get_by_id($table,$field,$id)
   {
   	 $this->db->select($field);
   	 $this->db->where('id',$id);
   	 $query = $this->db->get($table);
   	 $result = $query->result_array();
   	 return $result[0][$field];
   }

   function get_count($table,$where=array())
   {
   	  $this->db->select('id');

   	  if(!empty($where))
   	  	$this->db->where($where);

   	  $query = $this->db->get($table);
   	  return $query->num_rows();
   }

   function get_name_by_id($id)
   {
   	   $this->db->select('CONCAT(firstname," ",lastname) AS name', FALSE);
   	   $this->db->where('id',$id);
   	   $query = $this->db->get('users');
   	   $result = $query->result_array();
   	   return $result[0]['name'];
   	}

   	public function time_cal($time)
	{
	   
	   
	   $periods = array("sec", "min", "hr", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   		$now = time();
	       $difference     = $now - $time;
	       $tense         = "ago";
	       
	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] $tense";
	   
	}

	function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]);
      }
      return $text;
    }

  function select_city($city)
   {
      $data = array();
      $this->db->select('c.name as city,cu.name as county');
      $this->db->join('counties cu','cu.id=c.county_id');
      $this->db->where('LOWER(c.name) like  "'.strtolower($city).'%"', NULL, FALSE);
      $query = $this->db->get('cities c');
     //debug_last_query();
      if($query->num_rows()>0)
      {
        foreach($query->result_array() as $rows)
        {
          $data[] = $rows['city'].', '.$rows['county'];
          
        }
      }
      return $data;
   }
   function topic_ids($topic)
   {
     
      $id = array();
      $topics = $this->topic_model->get_topic_detail($topic,'id');
      if(!empty($topics))
      {
        $id[] = $topics['id'];
      }
      return $id;
   }

   function recent_question($topic,$location)
   {
    
      if($topic != '')
         {
              $topicids = $this->topic_ids($topic);
              
              $where = $orwhere = '';
              if(!empty($topicids))
              {
                 
                 foreach($topicids as $topicid)
                 {
                  
                     if($where == '')
                      $where = "FIND_IN_SET('".$topicid."', c.topic)";
                     else 
                      $where .= " and FIND_IN_SET('".$topicid."', c.topic)";
                    if($orwhere =='')
                      $orwhere = "FIND_IN_SET('".$topicid."', c.category)";
                     else 
                      $orwhere .= " and FIND_IN_SET('".$topicid."', c.category)";
                 }
              }
              
              if($where != '')
              $this->db->where($where);
              if($orwhere != '')
              $this->db->or_where($orwhere);
         }
      $data = array();
      $this->db->select('c.id,c.subject,c.location , count(la.id) AS total_answers');
      $this->db->join('legal_answers la','la.quest_id=c.id');
      if($location != '')
        $this->db->like('c.location', $location , 'after');
      $this->db->where('c.status',1);
      $this->db->group_by('la.quest_id');
      $this->db->order_by('c.submitted_date','desc');
      $this->db->limit(6);
      $query = $this->db->get('client_questions c');
      //debug_last_query();exit;
      if($query->num_rows() > 0)
      {
         return $query->result_array();
      }
      return $data;
    
   }

   function get_tips($topic,$limit)
    {
        $data = $where_array = array();
        $topicsplit = explode(',', $topic);
        foreach($topicsplit as $split)
        {
          $where_array[] = "FIND_IN_SET('".$split."', topic)";
        }
        $where = '';
        if(!empty($where_array))
        $where = implode(' and ',$where_array);
        $this->db->select('id,title');
        if($where != '')
        $this->db->where($where);
        $this->db->where('status',1);
        $this->db->order_by('rating', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get('tips');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        return $data;
    }
    function get_questions($topic,$quest_id,$limit)
    {
        $data = $where_array = array();
        $topicsplit = explode(',', $topic);
        foreach($topicsplit as $split)
        {
          $where_array[] = "FIND_IN_SET('".$split."', topic)";
        }
        $where = '';
        if(!empty($where_array))
        $where = implode(' and ',$where_array);
        $this->db->select('id,subject');
        if($where != '')
        $this->db->where($where);
        $this->db->where('id !=',$quest_id);
        $this->db->where('status',1);
        $this->db->order_by('submitted_date', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get('client_questions');
       
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        return $data;
    }
}
?>
