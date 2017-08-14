<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_model extends CI_Model {
	function __construct() {
        parent::__construct();
              
     }

    function fetch_topics()
    {
    	$data = array();
    	$sql = "SELECT t.id,t.name 
    	        FROM topics as t
    	        JOIN topics as c ON c.id = t.id
    	        LEFT OUTER JOIN topics_mapping as tp ON tp.child = c.id 
    	        WHERE t.is_active = 1 LIMIT 10";
    	$result = $this->db->query($sql);
    	if($result->num_rows()>0)
    	{
    		foreach($result->result_array() as $row)
    		{
    			$data[] = $row;
    		}
    	}
    	return $data;
    }

    function fetch_recent_answers($limit='',$offset='')
    {
    	$data= array();
    	$this->db->select('la.quest_id,cq.subject,cq.location,la.adviser_id,la.answered_date');
    	$this->db->join('client_questions cq','cq.id=la.quest_id');
    	$this->db->where('la.status','1');
        $this->db->order_by('answered_date','desc');
    	if($limit == '' && $offset == '')
    		$this->db->limit(6);
    	else
    		$this->db->limit($limit,$offset);
    	$query = $this->db->get('legal_answers la');
        if($query->num_rows() > 0)
    	{
    		foreach($query->result_array() as $row)
    		{
    			$data[] = $row;
    		}
    	}
    	return $data;

    }
    function recent_answers_count($where ='')
    {
        $this->db->select('id');
        $this->db->where('status',1);
        $query = $this->db->get('legal_answers');
        return $query->num_rows();

    }

    function get_topic_detail($name,$select='*')
    {
    	$data = array();
    	$this->db->select($select);
    	$this->db->where('name',$name);
        $query = $this->db->get('topics');
        if($query->num_rows() > 0)
    	{
    		foreach($query->result_array() as $row)
    		{
    			$data = $row;
    		}
    	}
    	return $data;
    }

    function get_parent($id)
    {
    	$this->db->select('parent');
    	$this->db->where('child',$id);
    	$qur = $this->db->get('topics_mapping');
    	$row = $qur->result_array();
    	return $row[0]['parent'];
    }

    function get_related_topic($is_parent,$id)
    {
        $data = array();
    	if(!$is_parent)
    		$parent = $this->get_parent($id);

        $this->db->select('t.id,t.name');
        $this->db->join('topics_mapping tm','tm.child=t.id');
        if($is_parent){
        	 $this->db->where('tm.parent',$id);
        }
        else
        {
           $this->db->where('tm.parent',$parent);
	       $this->db->where('tm.child !=',$id);
        }
        $this->db->where('is_active',1);
        $query = $this->db->get('topics t');
        
        if($query->num_rows() > 0)
    	{
    		foreach($query->result_array() as $row)
    		{
    			$data[] = $row;
    		}
    	}
    	return $data;

    }

    function get_recent_questions($id)
    {
        $data = array();
    	$where = "FIND_IN_SET('".$id."', topic)";
    	$orwhere = "FIND_IN_SET('".$id."', category)";
    	$this->db->select('*');
    	$this->db->where($where);
    	$this->db->or_where($orwhere);
        $this->db->where('status',1);
    	$this->db->limit(6);
    	$query = $this->db->get('client_questions');
    	if($query->num_rows() > 0)
    	{
    		foreach($query->result_array() as $row)
    		{
    			$data[] = $row;
    		}
    	}
    	return $data;
    }

    function get_common_questions($topicid)
    {
        $data = array();
        $where = "FIND_IN_SET('".$topicid."', topics_tagged)";
        $this->db->select('cq.id,cq.subject');
        $this->db->join('client_questions cq','cq.id=co.quest_id');
        $this->db->where($where);
        $this->db->where('cq.status',1);
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(6);
        $query = $this->db->get('common_questions co');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        return $data;
    }

    function get_top_tips($topicid,$limit)
    {
        $data = array();
        $where = "FIND_IN_SET('".$topicid."', topic)";
        $this->db->select('id,title');
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

    function get_tip_detail($title)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('title',$title);
        $query = $this->db->get('tips');
        if($query->num_rows() > 0)
        {
            foreach($query->result_array() as $row)
            {
                $data = $row;
            }
        }
        return $data;
    }

    function get_topic_by_letter($letter)
    {
        $this->db->select('*');
        $this->db->like('name', $letter , 'after'); 
        $this->db->where('is_active','1');
        $this->db->order_by('name','asc');
        $query = $this->db->get('topics');
        if($query->num_rows()>0)
            return $query->result_array();
        else
            return array();
    }

    function week_range($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    return array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start)));
    }

    function get_tips($topicid,$limit='',$offset='')
    {
        $data = array();
        $where = "FIND_IN_SET('".$topicid."', topic)";
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('status',1);
        $this->db->order_by('posted_date', 'desc');
        if($limit !== '' && $offset !== '')
            $this->db->limit($limit,$offset);
        $query = $this->db->get('tips');
        if($query->num_rows()>0)
        {
            foreach($query->result_array() as $row)
            {
                $data[] = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'posted_in' => $row['user_id'],
                    'type' => 'tips',
                    'sdate' =>$row['posted_date'] );
            }
         }
        return $data;
    }
    function get_tips_count($topicid)
    {
        
        $where = "FIND_IN_SET('".$topicid."', topic)";
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('status',1);
        $this->db->order_by('posted_date', 'desc');
        
        $query = $this->db->get('tips');
        return $query->num_rows();
    }
    function get_questions($id,$limit,$offset)
    {
        $data = array();
        $where = "FIND_IN_SET('".$id."', c.topic)";
        $orwhere = "FIND_IN_SET('".$id."', c.category)";
        $this->db->select('c.*,count(la.id) AS total_answers');
        $this->db->join('legal_answers la','la.quest_id=c.id','left');
        $this->db->where($where);
        $this->db->or_where($orwhere);
        $this->db->where('c.status',1); 
        $this->db->group_by('la.quest_id');
        $this->db->order_by('c.submitted_date','desc');
        if($limit !== '' && $offset !== '')
            $this->db->limit($limit,$offset);
        $query = $this->db->get('client_questions c');
       
        if($query->num_rows() > 0)
        {
            foreach($query->result_array() as $row)
            {
                $data[] = array(
                    'id' => $row['id'],
                    'title' => $row['subject'],
                    'posted_in' => $row['location'],
                    'type' => 'question',
                    'total_answer' => $row['total_answers'],
                    'sdate' =>$row['submitted_date'] );
                
            }
        }
        return $data;
    }

    function get_question_count($id)
    {
        $data = array();
        $where = "FIND_IN_SET('".$id."', c.topic)";
        $orwhere = "FIND_IN_SET('".$id."', c.category)";
        $this->db->select('c.*,count(la.id) AS total_answers');
        $this->db->join('legal_answers la','la.quest_id=c.id','left');
        $this->db->where($where);
        $this->db->or_where($orwhere);
        $this->db->where('c.status',1); 
        $this->db->group_by('la.quest_id');
        $this->db->order_by('c.submitted_date','desc');
        if($limit !== '' && $offset !== '')
            $this->db->limit($limit,$offset);
        $query = $this->db->get('client_questions c');
        
        return $query->num_rows();
    }

    function get_tips_questions($topicid)
    {
       $all = array();
       $tips = $this->get_tips($topicid);
       $questions = $this->get_questions($topicid);
       foreach($questions as $quest)
       {
        array_push($all,$quest);
       }
       foreach($tips as $tip)
       {
        array_push($all,$tip);
       }
       return $all;
    }
 }
?>