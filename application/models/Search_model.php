<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
	function __construct() {
        parent::__construct();
              
     }
      
     function find_is_parent($topic_name)
     {
     	$this->db->select('id,is_parent');
     	$this->db->where('LOWER(name) like  "'.strtolower($topic_name).'"', NULL, FALSE);
     	$query = $this->db->get('topics');
     	if($query->num_rows()>0)
     	{
     		$row = $query->result_array();
     		$record['id'] = $row[0]['id'];
     		$record['is_parent'] = $row[0]['is_parent'];
     		return $record;
     	}
     	else 
     		return NULL;
        
     }
     function get_topics_related($topic_name)
     {
        $is_parent = $this->find_is_parent($topic_name);

        if(!empty($is_parent))
        {
          $topic = $this->topic_model->get_related_topic($is_parent['is_parent'],$is_parent['id']);
          return $topic;
        }
        return NULL;
  
     }

     
     function get_match_result($topic_name,$location,$tag_ids,$limit='',$offset='')
     {
       
         $topic_ids = $this->find_is_parent($topic_name);
         if(!empty($topic_ids)){
         	$where = '';
         	if($topic_ids['is_parent'])
         	{
         		$where = "FIND_IN_SET('".$topic_ids['id']."', c.topic)";
         	}
         	else
         	{
         		$where = "FIND_IN_SET('".$topic_ids['id']."', c.category)";
         	}
         	$this->db->select('c.id,c.subject,c.location ,c.submitted_date,c.topic,c.category,count(la.id) AS total_answers');
		    $this->db->join('legal_answers la','la.quest_id=c.id','left');
		    if($location != '')
		        $this->db->like('LOWER(c.location)', strtolower($location) , 'after');
		    if($where != '' && $tag_ids =='')
		    $this->db->where($where);

            if($tag_ids != '')
            {   $array_where = array();
                $tags = explode(',', $tag_ids);
                foreach ($tags as $tag) {
                    $array_where[] = "FIND_IN_SET('".$tag."',c.category)";
                   
                }
                if(!empty($array_where))
                {

                    if(count($array_where)>1)
                     $tag_where = implode(' and ',$array_where);
                    else
                     $tag_where = "FIND_IN_SET('".$tag_ids."',c.category) != 0";

                    $this->db->where($tag_where);
                }
            }
		    $this->db->where('c.status',1); 
		    $this->db->group_by('la.quest_id');
		    $this->db->order_by('c.submitted_date','desc');
		    if($limit == '' && $offset == '')
            $this->db->limit(10);
            else
            $this->db->limit($limit,$offset);

		    $query = $this->db->get('client_questions c');
		    
		    if($query->num_rows() > 0)
	    	{
	    		return $query->result_array();
	    	}
	    	return array('empty');
         	
         }
         return array('notopicfound');
     }

     function match_result_count($topic_name,$location,$tag_ids)
     {
     	$topic_ids = $this->find_is_parent($topic_name);
         if(!empty($topic_ids)){
            $where = '';
            if($topic_ids['is_parent'])
            {
                $where = "FIND_IN_SET('".$topic_ids['id']."', c.topic)";
            }
            else
            {
                $where = "FIND_IN_SET('".$topic_ids['id']."', c.category)";
            }
            $this->db->select('c.id,c.subject,c.location ,c.submitted_date,c.topic,c.category,count(la.id) AS total_answers');
            $this->db->join('legal_answers la','la.quest_id=c.id','left');
            if($location != '')
                $this->db->like('LOWER(c.location)', strtolower($location) , 'after');
            if($where != '' && $tag_ids =='')
            $this->db->where($where);

            if($tag_ids != '')
            {   $array_where = array();
                $tags = explode(',', $tag_ids);
                foreach ($tags as $tag) {
                    $array_where[] = "FIND_IN_SET('".$tag."',c.category)";
                   
                }
                if(!empty($array_where))
                {

                    if(count($array_where)>1)
                     $tag_where = implode(' and ',$array_where);
                    else
                     $tag_where = "FIND_IN_SET('".$tag_ids."',c.category) != 0";

                    $this->db->where($tag_where);
                }
            }
            $this->db->where('c.status',1); 
            $this->db->group_by('la.quest_id');
            $this->db->order_by('c.submitted_date','desc');
            if($limit == '' && $offset == '')
            $this->db->limit(10);
            else
            $this->db->limit($limit,$offset);

            $query = $this->db->get('client_questions c');
            return $query->num_rows();
     }
     else
        return 0;
 }


 }
 ?>