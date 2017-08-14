<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $data = array();
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin_model');
		$this->data = array(
             //'template' => 'common/admintemplate',
            // 'controller' => $this->router->fetch_class(),
             //'method' => $this->router->fetch_method(),
             'access' => isset($this->session->userdata['admin_id']) ? $this->session->userdata['admin_id'] : 0,
             'acctitle' => isset($this->session->userdata['companyname']) ? $this->session->userdata['companyname'] : "New"
			   );
    }
	public function index()
	{
		if(isset($this->session->userdata['admin_id']) && !empty($this->session->userdata['admin_id']))
		{
			if(isset($this->session->userdata['is_active']) && !empty($this->session->userdata['is_active']))
			{
			redirect('admin/dashboard');
		    }
			
		}
		$data = array('title' => 'Login', 'page' => 'admin/login',  'errorCls' => NULL,'page_params' => NULL);
		//$t=$this->admin_model->test();
		 @$options['table']='basic_information';
		 $data['baseinfo']=$this->admin_model->getRecord($options);

		$data = $data + $this->data;
		$this->load->view('admin/login',$data);
	}
	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		 	
		$result = $this->admin_model->login_authenticate($username,$password);
		//var_dump($result);exit;
		if(!empty($result))
		{
			if($result[0]['is_active']=='1')
			{
				$this->session->set_flashdata('success','Logged in successfully');
				redirect('admin/dashboard');
			}
			else
			{
				$this->session->set_flashdata('failure','Your account is inactive');
				redirect('admin');
			}
	    }
	    else
	    {
	    	$this->session->set_flashdata('failure','Username/password is incorrect');
			redirect('admin');
	    }
	}
	public function dashboard()
	{
	 if($this->data['access'] == 0) 
	 {
     redirect('admin');
	 }
	 else
	 {
		$data = array('title' => $this->data['acctitle'].' | Dashboard', 'page' => 'admin/dashboard',  'errorCls' => NULL,'page_params' => NULL);
		//$t=$this->admin_model->test();
		@$options1['query'] ="select COUNT(*) as regusers from users where is_fa=1";
		$data['regusers']=$this->admin_model->getJoin($options1);
		@$options2['query'] ="select COUNT(*) as users from users where is_fa=0";
		$data['users']=$this->admin_model->getJoin($options2);
        @$options3['query'] ="select COUNT(*) as reviews from client_reviews";
		$data['reviews']=$this->admin_model->getJoin($options3);
		@$options4['query'] ="SELECT count(*) as unans FROM client_questions where id not in(select quest_id from legal_answers group by quest_id)";
		$data['unans']=$this->admin_model->getJoin($options4);
		@$options5['query'] ="SELECT count(*) as tips FROM tips";
		$data['tips']=$this->admin_model->getJoin($options5);
		$data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	 }
	}
	public function baseinfo()
	{
	 if($this->data['access'] == 0 || (!in_array("1",explode(",",$this->session->userdata['permissionid']))))  
	 {
     redirect('admin');
	 }
	 else
	 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Baseinformation', 'page' => 'admin/baseinfo',  'errorCls' => NULL,'page_params' => NULL);

		// @$options['key'] .=' order by mail_template asc';
		 @$options['table']='basic_information';
		 $data['baseinfo']=$this->admin_model->getRecord($options);

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	 }
	}
	public function editbaseinfo()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }   
	    if($_FILES['shortlogo']['name']!='' && $_FILES['shortlogo']['error']==0)
	    {
	    $options['path']='baseinfo/';
		$options['filename']='shortlogo';
		$upload=$this->do_upload($options);
		
		$_POST['shortlogo']=$upload["upload_data"]["file_name"];
	    }
	    else
	    {
	    	$_POST['shortlogo']=$_POST['old_shortlogo'];
	    }
	     if($_FILES['loginlogo']['name']!='' && $_FILES['loginlogo']['error']==0)
	    {
	    $options['path']='baseinfo/';
		$options['filename']='loginlogo';
		$upload=$this->do_upload($options);
		
		$_POST['loginlogo']=$upload["upload_data"]["file_name"];
	    }
	    else
	    {
	    	$_POST['loginlogo']=$_POST['old_loginlogo'];
	    }

		 $editval=$this->admin_model->editbaseinfo($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Basic information has been updated successfully!');
				redirect('admin/baseinfo'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Basic information has not been updated');
				redirect('admin/baseinfo'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function managemails()
	{
	 if($this->data['access'] == 0 || (!in_array("7",explode(",",$this->session->userdata['permissionid'])))) 
	 {
     redirect('admin');
	 }
	 else
	 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Mails', 'page' => 'admin/managemails',  'errorCls' => NULL,'page_params' => NULL);

		 if(isset($_POST['submit']) && !empty($_POST['submit']))
		 {

		 	$result=$this->admin_model->editmanagemails($_POST);
		 	if(!empty($result))
			{
				$this->session->set_flashdata('success','Email details has beed updated successfully');
				redirect('admin/managemails');
			}
			else
			{
				$this->session->set_flashdata('failure','Email details has not been updated ');
				redirect('admin/managemails');
			}
		 }
		 @$options['key'] .=' order by template asc';
		 $data['managemails']=$this->admin_model->getmanagemails($options);

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	 }
	}
	public function changecontent()
	{	
	//$data = array('title' => 'ZENRG Finance | Manage Mails', 'page' => 'admin/changecontent',  'errorCls' => NULL,'page_params' => NULL);
	 
		if(!empty($_POST['mailid']))
		   {
		   	$options=array();
		   	$retdata=array();
			@$options['key'] = " where id=".$_POST['mailid']; 
			$data=$this->admin_model->getmanagemails($options);
			$retdata['mailcontent']=htmlspecialchars_decode($data[0]['content'],ENT_QUOTES);
			$retdata['mailsubject']=$data[0]['subject']; 
			header('Content-type: application/json');
			echo json_encode($retdata);
			//echo $retdata;
		   	}
		   	else
		   	{
		   	$retdata['mailcontent']=''; 
			$retdata['mailsubject']=''; 
			header('Content-type: application/json');
			echo json_encode($retdata);
		   	}
	//	$data = $data + $this->data;

		//echo $this->load->view('admin/template/admin_temp',$data);
	  
	}
	public function managecountry()
	{
		if($this->data['access'] == 0 || (!in_array("2",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Country', 'page' => 'admin/managecountry',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && $_GET['q']!=''){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "country LIKE '$q'"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managecountry";
	     $config['first_url'] = base_url()."admin/managecountry?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 4;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getCountry($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['countries']=$this->admin_model->getCountry($options);

		 if(empty($data['countries']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managecountry/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
 		}
	}
	public function addcountry()
	{
		 $regno=$this->admin_model->addcountry($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Country has been added successfully!');
				redirect('admin/managecountry');
			}
			else
			{
				$this->session->set_flashdata('failure','Country has not been added');
				redirect('admin/managecountry');
			}
	}
	public function editcountry()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editcountry($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Country has been updated successfully!');
				redirect('admin/managecountry'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Country has not been updated');
				redirect('admin/managecountry'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletecountry()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletecountry($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Country has been deleted successfully!');
				redirect('admin/managecountry'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Country has not been deleted');
				redirect('admin/managecountry'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifycountry() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['country']))
    {
      $value=$_POST['country'];
    }
    elseif(!empty($_POST['countryname']))
    {
       $value=$_POST['countryname'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where country='".$value."'"; 
    }
     $data = $this->admin_model->getCountry($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function managecounties()
	{
		if($this->data['access'] == 0 || (!in_array("3",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Counties', 'page' => 'admin/managecounties',  'errorCls' => NULL,'page_params' => NULL);
		  @$options['query']="select A.*,B.*,A.id as countyid,A.is_active as isactive, B.id as countryid from counties A left join constituent_countries B on A.country=B.id";
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
				$num = $_GET['q'];
			   $optionsets[] = "(A.name LIKE '$q' or B.country LIKE '$q' or A.latitude LIKE '$num' or A.longitude LIKE '$num' or A.description LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "A.is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by A.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managecounties";
	     $config['first_url'] = base_url()."admin/managecounties?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['managecounties']=$this->admin_model->getjoin($options);
		// exit;
		 @$countryop['key'] =' where is_active=1 order by country asc';
		 $data['countries']=$this->admin_model->getCountry($countryop);

		 if(empty($data['managecounties']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managecounties/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addcounty()
	{
		$this->load->library('upload');
		$options=array();
		
		$options['path']='county/';
		$options['filename']='countyimage';
		$upload=$this->do_upload($options);
		
		if(!empty($upload["upload_data"]["is_image"]))
		{
		$_POST['imagename']=$upload["upload_data"]["file_name"];
		 $regno=$this->admin_model->addcounty($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','County has been added successfully!');
				redirect('admin/managecounties');
			}
			else
			{
				$this->session->set_flashdata('failure','County has not been added');
				redirect('admin/managecounties');
			}
		}
		else
			{
				//$error=$upload;
				$this->session->set_flashdata('failure',$upload);
				redirect('admin/managecounties');
			}
	}
	public function editcounty()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }   
	    if($_FILES['editcountyimage']['name']!='' && $_FILES['editcountyimage']['error']==0)
	    {
	    $options['path']='county/';
		$options['filename']='editcountyimage';
		$upload=$this->do_upload($options);
		
		$_POST['imagename']=$upload["upload_data"]["file_name"];
	    }
	    else
	    {
	    	$_POST['imagename']=$_POST['old_image'];
	    }
	    
		 $editval=$this->admin_model->editcounty($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','County has been updated successfully!');
				redirect('admin/managecounties'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','County has not been updated');
				redirect('admin/managecounties'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletecounty()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletecounty($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','County has been deleted successfully!');
				redirect('admin/managecounties'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','County has not been deleted');
				redirect('admin/managecounties'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifycounty() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['countyname']))
    {
      $value=$_POST['countyname'];
    }
    elseif(!empty($_POST['editarea']))
    {
       $value=$_POST['editarea'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where name='".$value."'"; 
    }
     $data = $this->admin_model->getcounties($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	 }
	public function managepractice()
	{
		if($this->data['access'] == 0 || (!in_array("8",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Practice', 'page' => 'admin/managepractice',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(area LIKE '$q' or description LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managepractice";
	     $config['first_url'] = base_url()."admin/managepractice?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getmanagepractice($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['managepractice']=$this->admin_model->getmanagepractice($options);

		 if(empty($data['managepractice']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managepractice/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addarea()
	{
		if($this->data['access'] == 0) 
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $regno=$this->admin_model->addarea($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Practice area has been added successfully!');
				redirect('admin/managepractice');
			}
			else
			{
				$this->session->set_flashdata('failure','Practice area has not been added');
				redirect('admin/managepractice');
			}
		}
	}

	public function editarea()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editarea($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Practice area has been updated successfully!');
				redirect('admin/managepractice'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Practice area has not been updated');
				redirect('admin/managepractice'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}

	public function deletearea()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletearea($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Practice area has been deleted successfully!');
				redirect('admin/managepractice'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Practice area has not been deleted');
				redirect('admin/managepractice'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}

	public function verifyarea() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['area']))
    {
      $value=$_POST['area'];
    }
    elseif(!empty($_POST['editarea']))
    {
       $value=$_POST['editarea'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where area='".$value."'"; 
    }
     $data = $this->admin_model->getmanagepractice($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	 }
	 public function masterlawyers()
	{
		if($this->data['access'] == 0 || (!in_array("11",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Master Financial Advisor', 'page' => 'admin/masterlawyers',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
				$num = $_GET['q'];
			   $optionsets[] = "(concat(firstname,' ',lastname) LIKE '$q' or firstname LIKE '$q' or lastname LIKE '$q' or email LIKE '$q' or phone_no_office LIKE '$num' or company_name LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/masterlawyers";
	     $config['first_url'] = base_url()."admin/masterlawyers?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getmasterlaw($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['masterlawyers']=$this->admin_model->getmasterlaw($options);

		 if(empty($data['masterlawyers']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/masterlawyers/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	   }
	}
	public function addlawyer()
	{
		if($this->data['access'] == 0 || (!in_array("10",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		$data = array('title' => $this->data['acctitle'].' | Add Financial Advisor', 'page' => 'admin/addlawyer',  'errorCls' => NULL,'page_params' => NULL);
		if(isset($_POST['submit'])&&!empty($_POST['submit']))
		{
			if(!empty($_GET['paginate']))
		    {
		      $paginate='/'.$_GET['paginate'];
		    }
			$regno=$this->admin_model->addlawyer($_POST);
		 	if(!empty($regno))
			{
				$this->session->set_flashdata('success','Financial adviser has been added successfully!');
				redirect('admin/masterlawyers');
			}
			else
			{
				$this->session->set_flashdata('failure','Financial adviser has not been added');
				redirect('admin/masterlawyers');
			}
		}
		$options['key']=" order by name asc";
		$data['getcounties']=$this->admin_model->getcounties($options);
		$data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	    }
	}
	public function editlawyer()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		$data = array('title' => $this->data['acctitle'].' | Edit Financial Advisor', 'page' => 'admin/editlawyer',  'errorCls' => NULL,'page_params' => NULL);
		if(isset($_POST['submit'])&&!empty($_POST['submit']))
		{

			$regno=$this->admin_model->editlawyer($_POST);
		 	if(!empty($regno))
			{
				$this->session->set_flashdata('success','Financial adviser has been updated successfully!');
				redirect('admin/masterlawyers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Financial adviser has not been updated');
				redirect('admin/masterlawyers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
		}
		$options1['key']=" order by name asc";
		$data['getcounties']=$this->admin_model->getcounties($options1);
		$options2['key']=" where id=".$_GET['edit'];
		$data['lawyers']=$this->admin_model->getmasterlaw($options2);
		$data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	}
	public function deletmasterlaw()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletmasterlaw($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Financial adviser has been deleted successfully!');
				redirect('admin/masterlawyers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Financial adviser has not been deleted');
				redirect('admin/masterlawyers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifylawemail() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['email']))
    {
      $value=$_POST['email'];
    }
    elseif(!empty($_POST['editemail']))
    {
       $value=$_POST['editemail'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where email='".$value."'"; 
    }
     $data = $this->admin_model->getmasterlaw($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	 }
	public function manageregusers()
	{
		if($this->data['access'] == 0 || (!in_array("12",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Users', 'page' => 'admin/regusers',  'errorCls' => NULL,'page_params' => NULL);
		 @$options['query'] ="select A.*,B.*,D.*, A.id as userid from users A left join fa_registered_users B on A.id=B.user_id left join counties D on B.county=D.id ";
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(A.email LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "A.is_blocked='$stat'"; 
		 } 
		 if(isset($_GET['verf']) && ($_GET['verf']!='')){
		 $verf = $_GET['verf'];
		 $optionsets[] = "A.is_verified='$verf'"; 
		 }
		 /*if(isset($_GET['advis']) && ($_GET['advis']!='')){
		 $advis = $_GET['advis'];
		 $optionsets[] = "A.is_fa='$advis'"; 
		 }*/
		  $optionsets[] = "A.is_fa=1";
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by A.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/manageregusers";
	     $config['first_url'] = base_url()."admin/manageregusers?q=".@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf'];
	     $config["suffix"] ='?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf'];
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['verf']=@$_GET['verf'];
		 $data['advis']=@$_GET['advis'];
		 $data['users']=$this->admin_model->getjoin($options);

		 if(empty($data['users']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/manageregusers/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	    }
	}
	public function editreguser()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editreguser($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Registered user details has been updated successfully!');
				redirect('admin/manageregusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','Registered user details has not been updated');
				redirect('admin/manageregusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
	}
	public function deletereguser()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletereguser($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Registered user details has been deleted successfully!');
				redirect('admin/manageregusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','Registered user details has not been deleted');
				redirect('admin/manageusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
	}
	public function manageusers()
	{
		if($this->data['access'] == 0 || (!in_array("13",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Users', 'page' => 'admin/users',  'errorCls' => NULL,'page_params' => NULL);
		 @$options['query'] ="select A.* from users A";
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(A.email LIKE '$q' or concat(firstname,' ',lastname) LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "A.is_blocked='$stat'"; 
		 } 
		 if(isset($_GET['verf']) && ($_GET['verf']!='')){
		 $verf = $_GET['verf'];
		 $optionsets[] = "A.is_verified='$verf'"; 
		 }
		 $optionsets[] = "A.is_fa=0";
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by A.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/manageusers";
	     $config['first_url'] = base_url()."admin/manageusers?q=".@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf'];
	     $config["suffix"] ='?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf'];
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['verf']=@$_GET['verf'];
		 $data['users']=$this->admin_model->getjoin($options);

		 if(empty($data['users']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/manageusers/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
	    }
	}
	public function edituser()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->edituser($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','User details has been updated successfully!');
				redirect('admin/manageusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','User details has not been updated');
				redirect('admin/manageusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
	}
	public function deleteuser()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deleteuser($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','User details has been deleted successfully!');
				redirect('admin/manageusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','User details has not been deleted');
				redirect('admin/manageusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
	}
	public function managecities()
	{
		if($this->data['access'] == 0 || (!in_array("4",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Cities', 'page' => 'admin/managecities',  'errorCls' => NULL,'page_params' => NULL);
		  @$options['query']="select S.*,A.*,B.*,S.id as cityid,S.name as city,S.latitude as city_latitude,S.longitude as city_longitude,S.image as city_image,S.description as city_description,S.is_active as city_active,A.name as countyname ,A.id as countyid, B.id as countryid from cities S left join counties A on S.county_id=A.id left join constituent_countries B on S.country_id=B.id";
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
				$num = $_GET['q'];
			   $optionsets[] = "(S.name LIKE '$q' or A.name LIKE '$q' or B.country LIKE '$q' or S.latitude LIKE '$num' or S.longitude LIKE '$num' or S.description LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "S.is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by S.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managecities";
	     $config['first_url'] = base_url()."admin/managecities?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['managecities']=$this->admin_model->getjoin($options);
		 @$countryop1['key'] =' where is_active=1 order by country asc';
		 $data['countries']=$this->admin_model->getCountry($countryop1);
		 @$countryop2['key'] =' where is_active=1 order by name asc';
		 $countryop2['table']='counties'; 
		 $data['counties']=$this->admin_model->getRecord($countryop2);

		 if(empty($data['managecities']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managecities/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function onloadgetcounty()
	{
		if(!empty($_POST) && !empty($_POST['county']))
		{
				$namespace=$_POST['name'];
				$id=$_POST['county'];
				if(!empty($_POST['eselect']))
				{
				$select=$_POST['eselect'];
				}
				else
				{
					$select='';
				}
		 if(!empty($id))
		 {
		@$countryop['key'] =' where country='.$id.' order by name asc';
		 $countryop['table']='counties'; 
		 $data=$this->admin_model->getRecord($countryop);
		}
		}
		
		$block='<select class="form-control" name="'.$namespace.'" id="'.$namespace.'">
                    <option value="">--Select--</option>';
                   
        if(!empty($data))
        {
        	foreach ($data as $value) {
        		if($value['id']==$select)
        		{
        			$selected="selected='selected'";
        		}
        		$block.='<option value="'.$value['id'].'"'.@$selected.'>'.$value["name"].'</option>';
        	}
        }
        $block.='</select>';
        echo $block;
        //var_dump($_POST);
	}
	public function addcity()
	{
		$this->load->library('upload');
		$options=array();

		$options['path']='city/';
		$options['filename']='cityimage';
		$upload=$this->do_upload($options);
		
		if(!empty($upload["upload_data"]["is_image"]))
		{
		$_POST['imagename']=$upload["upload_data"]["file_name"];
		 $regno=$this->admin_model->addcity($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','City has been added successfully!');
				redirect('admin/managecities');
			}
			else
			{
				$this->session->set_flashdata('failure','City has not been added');
				redirect('admin/managecities');
			}
		}
		else
			{
				//$error=$upload;
				$this->session->set_flashdata('failure',$upload);
				redirect('admin/managecities');
			}
	}
	public function editcity()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }   
	    if($_FILES['editcityimage']['name']!='' && $_FILES['editcityimage']['error']==0)
	    {
	    $options['path']='city/';
		$options['filename']='editcityimage';
		$upload=$this->do_upload($options);
		
		$_POST['imagename']=$upload["upload_data"]["file_name"];
	    }
	    else
	    {
	    	$_POST['imagename']=$_POST['old_image'];
	    }

		 $editval=$this->admin_model->editcity($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','City has been updated successfully!');
				redirect('admin/managecities'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','City has not been updated');
				redirect('admin/managecities'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletecity()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletecity($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','City has been deleted successfully!');
				redirect('admin/managecities'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','City has not been deleted');
				redirect('admin/managecities'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
	}
	public function verifycity() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['cityname']))
    {
      $value=$_POST['cityname'];
    }
    elseif(!empty($_POST['editcityname']))
    {
       $value=$_POST['editcityname'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where name='".$value."'"; 
    }
    $options['table']='cities'; 
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	 }
	public function clientquestions()
	{
		if($this->data['access'] == 0 || (!in_array("15",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Client Questions', 'page' => 'admin/clientquestion',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $options['query'] ='select A.id as questid,A.*,B.*,B.id as commid from client_questions as A left join common_questions as B on A.id=B.quest_id';

		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(A.subject LIKE '$q' or A.detail LIKE '$q')"; 
			} 
		if(isset($_GET['unrd']) && ($_GET['unrd']==2))
		 {
		 $optionsets[] ="A.id not in(select quest_id from legal_answers group by quest_id)";
		 }
		 if(isset($_GET['unrd']) && ($_GET['unrd']==1))
		 {
		 $optionsets[] ="A.id in(select quest_id from legal_answers group by quest_id)";
		 }
		 if(isset($_GET['comm']) && ($_GET['comm']!='')){
				$comm = $_GET['comm'];
				if($comm==1)
				{
			     $optionsets[] = "(A.id=B.quest_id)"; 
			    }
			    if($comm==0)
			    {
			    	$options['query'] ='select A.id as questid,A.*,B.*,B.id as commid from client_questions as A inner join common_questions as B on A.id!=B.quest_id';
			    }
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "A.status='$stat'"; 
		 } 
		 else
		 {
		 $optionsets[] = "A.status in(0,1)"; 
		}
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by A.id desc';
		// @$options['table'] .='client_questions';
		 $config = array();
	     $config["base_url"] = base_url()."admin/clientquestions";
	     $config['first_url'] = base_url()."admin/clientquestions?q=".@$_GET['q']."&stat=".@$_GET['stat']."&comm=".@$_GET['comm']."&unrd=".@$_GET['unrd']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."&comm=".@$_GET['comm']."&unrd=".@$_GET['unrd']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getJoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['comm']=@$_GET['comm'];
		 $data['unrd']=@$_GET['unrd'];
		 $data['clientquest']=$this->admin_model->getJoin($options);

		 if(empty($data['clientquest']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/clientquestions/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function setting($questid=null)
	{
		if(empty($questid))
		{
			redirect('admin/clientquestions/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
		}
		$data = array('title' => $this->data['acctitle'].' | Setting', 'page' => 'admin/setting',  'errorCls' => NULL,'page_params' => NULL);
		@$options1['table'] .='topics';
		$data['topics']=$this->admin_model->getRecord($options1);
		@$options2['query'] .='select A.*,A.id as questid, B.*,B.id as commonquestid,C.id as usersid,C.* from client_questions as A left join common_questions as B on A.id=B.quest_id left join users C on A.client_id=C.id';
		@$options2['key'] =" where A.id=".$questid;
		$data['clientquest']=$this->admin_model->getJoin($options2);
		@$options3['table'] .='question_flag';
		$data['flag']=$this->admin_model->getRecord($options3);
		@$options4['table'] .='legal_answers';
		$data['answer']=$this->admin_model->getRecord($options4);
		@$options5['query'] .='select A.*,A.id as ansid,A.status as Astatus,B.*,B.id as adviceid,answer_id as answerid,helpmark,bestmark,agree,comment,flag from legal_answers as A left join users as B on A.adviser_id=B.id left join (select answer_id,sum(helpful_mark) as helpmark,sum(best_mark) as bestmark,sum(agree) as agree,count(comment) as comment,sum(flag) as flag from quset_additional_process group by answer_id) as C on A.id=C.answer_id';
		@$options5['key'] =" where A.quest_id=".$questid;
		$data['questans']=$this->admin_model->getJoin($options5);
		//exit;
		$data['questid']=$questid;
		$data['paginate'] = @$_GET['paginate']; 
		$data['q'] = @$_GET['q'];
		$data['stat'] = @$_GET['stat'];
		$data['comm']=@$_GET['comm'];
		$data['unrd']=@$_GET['unrd'];
		$data = $data + $this->data;
		$this->load->view('admin/common/template',$data);

	}
	public function commonsetting()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
	    
		 $editval=$this->admin_model->commonsetting($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Common question setting has been updated successfully!');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
			}
			else
			{
				$this->session->set_flashdata('failure','Common question setting has not been updated');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
			}
	}
	public function editsetting()
	{
		//var_dump($_POST);exit;
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
	    
		 $editval=$this->admin_model->editsetting($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Setting has been updated successfully!');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
			}
			else
			{
				$this->session->set_flashdata('failure','Setting has not been updated');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&comm='.@$_GET['comm'].'&unrd='.@$_GET['unrd']);
			}
	}
	public function published()
	{
	    
		 $editval=$this->admin_model->published($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Setting has been updated successfully!');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Setting has not been updated');
				redirect('admin/clientquestions'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}

	public function answers()
	{
		 if($this->data['access'] == 0 || (!in_array("16",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Answers', 'page' => 'admin/answers',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(subject LIKE '$q' or detail LIKE '$q')"; 
			} 
		if(isset($_GET['unrd']) && ($_GET['unrd']==2))
		 {
		 $optionsets[] ="id not in(select quest_id from legal_answers group by quest_id)";
		 }
		 if(isset($_GET['unrd']) && ($_GET['unrd']==1))
		 {
		 $optionsets[] ="id in(select quest_id from legal_answers group by quest_id)";
		 }
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "status='$stat'"; 
		 } 
		 else
		 {
		 $optionsets[] = "status in(0,1)"; 
		}
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by id desc';
		 @$options['table'] .='client_questions';
		 $config = array();
	     $config["base_url"] = base_url()."admin/answers";
	     $config['first_url'] = base_url()."admin/answers?q=".@$_GET['q']."&stat=".@$_GET['stat']."&unrd=".@$_GET['unrd']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."&unrd=".@$_GET['unrd']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['unrd']=@$_GET['unrd'];
		 $data['clientquest']=$this->admin_model->getRecord($options);
		 //var_dump($data['clientquest']);
		 $questid=array();
		 if(!empty($data['clientquest']))
		 {
		 foreach ($data['clientquest'] as $quest) {
		 $questid[]=$quest['id'];
		 }
		 }
		 if(!empty($questid))
		 {
		 	$imquestion=implode(',',$questid);
		 }
		 else
		 {
		 	$imquestion=0;
		 }
		// var_dump($questid); exit;
		 @$options5['query'] .='select A.*,A.id as ansid,A.status as Astatus,B.*,B.id as adviceid,answer_id as answerid,helpmark,bestmark,agree,comment,flag from legal_answers as A left join users as B on A.adviser_id=B.id left join (select answer_id,sum(helpful_mark) as helpmark,sum(best_mark) as bestmark,sum(agree) as agree,count(comment) as comment,sum(flag) as flag from quset_additional_process group by answer_id) as C on A.id=C.answer_id';
		 @$options5['key'] =" where A.quest_id in(".$imquestion.")";
		 $data['questans']=$this->admin_model->getJoin($options5);
		 //exit;
		 if(empty($data['clientquest']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/answers/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&unrd='.@$_GET['unrd']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addanswer()
	{
		//var_dump($_POST);exit;
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
	    
		 $editval=$this->admin_model->addanswer($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Answer has been updated successfully!');
				redirect('admin/answers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&unrd='.@$_GET['unrd']);
			}
			else
			{
				$this->session->set_flashdata('failure','Answer has not been updated');
				redirect('admin/answers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&unrd='.@$_GET['unrd']);
			}
	}
	public function managetopics()
	{
		if($this->data['access'] == 0 || (!in_array("9",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $this->load->helper('text');
		 $data = array('title' => $this->data['acctitle'].' | Manage Practice', 'page' => 'admin/managetopics',  'errorCls' => NULL,'page_params' => NULL);
		 $options['query'] ='select A.*,A.id as topicid,B.child as mappingid,B.id as mapid,B.* from topics as A left join topics_mapping as B on A.is_parent=0 and A.id=B.parent';
		
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(A.name LIKE '$q' or A.description LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 //$options['table'] ='topics';
		 @$options['key'] .=' order by A.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managetopics";
	     $config['first_url'] = base_url()."admin/managetopics?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['managetopics']=$this->admin_model->getjoin($options);

		 if(empty($data['managetopics']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managetopics/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addtopic()
	{
		
		 $regno=$this->admin_model->addtopic($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Topic has been added successfully!');
				redirect('admin/managetopics');
			}
			else
			{
				$this->session->set_flashdata('failure','Topic has not been added');
				redirect('admin/managetopics');
			}
		
	}
	public function edittopic()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
	    
		 $editval=$this->admin_model->edittopic($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Topic has been updated successfully!');
				redirect('admin/managetopics'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','Topic has not been updated');
				redirect('admin/managetopics'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&verf='.@$_GET['verf']);
			}
	}
	public function deletetopic()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletetopic($_POST['deleteid'],$_POST['deletemapid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Topic has been deleted successfully!');
				redirect('admin/managetopics'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
			else
			{
				$this->session->set_flashdata('failure','Topic has not been deleted');
				redirect('admin/managetopics'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&advis='.@$_GET['advis'].'&verf='.@$_GET['verf']);
			}
	}
	public function verifytopic() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['name']))
    {
      $value=$_POST['name'];
    }
    elseif(!empty($_POST['editname']))
    {
       $value=$_POST['editname'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where name='".$value."'"; 
    }
    $options['table']='topics'; 
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	 }
	 public function comments($id=null)
	{
		$options['table']='quset_additional_process';
		$options['key']=' where answer_id='.$id;
		 $data = $this->admin_model->getRecord($options);
		 return $data;
	}
    function htmlchars()
	{
		echo htmlspecialchars_decode($_POST['htmlchars'],ENT_QUOTES);
	}
	function do_upload($params=array())
	{
		$config['upload_path'] = './uploads/'.$params['path'];
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '50725';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload');
		$filename=$params['filename'];
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($filename))
		{
			 $result = $this->upload->display_errors();
         // echo $this->upload->display_errors();
		//	$this->load->view('upload_form', $error);
		}
		else
		{
			 $result = array('upload_data' => $this->upload->data());
           
		//	$this->load->view('upload_success', $data);
		}
		return $result;
	}
	public function managetips()
	{
		 if($this->data['access'] == 0 || (!in_array("17",explode(",",$this->session->userdata['permissionid']))))   
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Tips', 'page' => 'admin/tips',  'errorCls' => NULL,'page_params' => NULL);
		  @$options['query']="select A.*, B.*,A.id as tipsid from tips as A left join (SELECT id,tips_id,COUNT(CASE WHEN vote = 1 THEN 1 END),COUNT(CASE WHEN vote = 0 THEN 1 END) FROM tips_vote GROUP BY tips_id)B on A.id=B.tips_id";
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
				$num = $_GET['q'];
			   $optionsets[] = "(A.title LIKE '$q' or A.rating LIKE '$q' or A.description LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "A.status='$stat'"; 
		 } 
		 if(isset($_GET['temp']) && ($_GET['temp']!='')){
		 $temp = $_GET['temp'];
		 $optionsets[] = "A.template_type='$temp'"; 
		 }
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['key'] .=' order by A.id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/managetips";
	     $config['first_url'] = base_url()."admin/managetips?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getjoin($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['temp']=@$_GET['temp'];
		 $data['managetips']=$this->admin_model->getjoin($options);
		 
		 @$countryop1['table'] ='topics';
		 $data['topics']=$this->admin_model->getRecord($countryop1);

		 if(empty($data['managetips']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/managetips/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&temp='.@$_GET['temp']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addtips()
	{
		 $regno=$this->admin_model->addtips($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Tips has been added successfully!');
				redirect('admin/managetips');
			}
			else
			{
				$this->session->set_flashdata('failure','Tips has not been added');
				redirect('admin/managetips');
			}
		
	}
	public function edittips()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
	    
		 $editval=$this->admin_model->edittips($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Tips has been updated successfully!');
				redirect('admin/managetips'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&temp='.@$_GET['temp']);
			}
			else
			{
				$this->session->set_flashdata('failure','Tips has not been updated');
				redirect('admin/managetips'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&temp='.@$_GET['temp']);
			}
	}
	public function deletetips()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletetips($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Tips has been deleted successfully!');
				redirect('admin/managetips'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&temp='.@$_GET['temp']);
			}
			else
			{
				$this->session->set_flashdata('failure','Tips has not been deleted');
				redirect('admin/managetips'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat'].'&temp='.@$_GET['temp']);
			}
	}
	public function languages()
	{
		 if($this->data['access'] == 0 || (!in_array("5",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Language', 'page' => 'admin/language',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && $_GET['q']!=''){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "language LIKE '$q'"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "status='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['table'] ='languages';
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/languages";
	     $config['first_url'] = base_url()."admin/languages?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['language']=$this->admin_model->getRecord($options);

		 if(empty($data['language']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/languages/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
 		}
	}
	public function addlanguage()
	{
		 $regno=$this->admin_model->addlanguage($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Language has been added successfully!');
				redirect('admin/languages');
			}
			else
			{
				$this->session->set_flashdata('failure','Language has not been added');
				redirect('admin/languages');
			}
	}
	public function editlanguage()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editlanguage($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Language has been updated successfully!');
				redirect('admin/languages'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Language has not been updated');
				redirect('admin/languages'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletelanguage()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletelanguage($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Language has been deleted successfully!');
				redirect('admin/languages'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Language has not been deleted');
				redirect('admin/languages'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifylanguage() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['language']))
    {
      $value=$_POST['language'];
    }
    elseif(!empty($_POST['editlanguage']))
    {
       $value=$_POST['editlanguage'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where language='".$value."'"; 
    }
    $options['table'] ='languages';
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function feetypes()
	{
		 if($this->data['access'] == 0 || (!in_array("6",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Fee Types', 'page' => 'admin/feetype',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && $_GET['q']!=''){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "type LIKE '$q'"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "status='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['table'] ='fee_types';
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/feetypes";
	     $config['first_url'] = base_url()."admin/feetypes?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['feetypes']=$this->admin_model->getRecord($options);

		 if(empty($data['feetypes']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/feetypes/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
 		}
	}
	public function addfeetype()
	{
		 $regno=$this->admin_model->addfeetype($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Fee type has been added successfully!');
				redirect('admin/feetypes');
			}
			else
			{
				$this->session->set_flashdata('failure','Fee type has not been added');
				redirect('admin/feetypes');
			}
	}
	public function editfeetype()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editfeetype($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Fee type has been updated successfully!');
				redirect('admin/feetypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Fee type has not been updated');
				redirect('admin/feetypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletefeetype()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletefeetype($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Fee type has been deleted successfully!');
				redirect('admin/feetypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Fee type has not been deleted');
				redirect('admin/feetypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifyfeetype() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['feetype']))
    {
      $value=$_POST['feetype'];
    }
    elseif(!empty($_POST['editfeetype']))
    {
       $value=$_POST['editfeetype'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where type='".$value."'"; 
    }
    $options['table'] ='fee_types';
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function paymenttypes()
	{
		 if($this->data['access'] == 0 || (!in_array("19",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Payment Types', 'page' => 'admin/paymenttypes',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && $_GET['q']!=''){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "type LIKE '$q'"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "status='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 @$options['table'] ='payment_types';
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/paymenttypes";
	     $config['first_url'] = base_url()."admin/paymenttypes?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['paytypes']=$this->admin_model->getRecord($options);

		 if(empty($data['paytypes']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/paymenttypes/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
 		}
	}
	public function addpaytype()
	{
		 $regno=$this->admin_model->addpaytype($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Payment type has been added successfully!');
				redirect('admin/paymenttypes');
			}
			else
			{
				$this->session->set_flashdata('failure','Payment type has not been added');
				redirect('admin/paymenttypes');
			}
	}
	public function editpaytype()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editpaytype($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Payment type has been updated successfully!');
				redirect('admin/paymenttypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Payment type has not been updated');
				redirect('admin/paymenttypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletepaytype()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletepaytype($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Payment type has been deleted successfully!');
				redirect('admin/paymenttypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Payment type has not been deleted');
				redirect('admin/paymenttypes'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifypaytype() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['paytype']))
    {
      $value=$_POST['paytype'];
    }
    elseif(!empty($_POST['editpaytype']))
    {
       $value=$_POST['editpaytype'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where type='".$value."'"; 
    }
    $options['table'] ='payment_types';
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function reviews()
	{
		if($this->data['access'] == 0 || (!in_array("14",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Reviews', 'page' => 'admin/reviews',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && $_GET['q']!=''){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(title LIKE '$q' or review LIKE '$q' or overall_rating LIKE '$q' or email LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "status='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 $options['table'] ='client_reviews';
		 @$options['key'] .=' order by id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/reviews";
	     $config['first_url'] = base_url()."admin/reviews?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 4;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['clientreviews']=$this->admin_model->getRecord($options);

		 if(empty($data['clientreviews']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/reviews/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
 		}
	}
	
	public function editreview()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editreview($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Review has been updated successfully!');
				redirect('admin/reviews'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Review has not been updated');
				redirect('admin/reviews'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function deletereview()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deletereview($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Review has been deleted successfully!');
				redirect('admin/reviews'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Review has not been deleted');
				redirect('admin/reviews'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function adminusers()
	{
		 if($this->data['access'] == 0 || (!in_array("18",explode(",",$this->session->userdata['permissionid']))))  
		 {
	     redirect('admin');
		 }
		 else
		 {
		 $data = array('title' => $this->data['acctitle'].' | Manage Admin Users', 'page' => 'admin/adminusers',  'errorCls' => NULL,'page_params' => NULL);
		 
		 $optionsets=array();
		 if(isset($_GET['q']) && ($_GET['q']!='')){
				$q = '%'.$_GET['q'].'%';
			   $optionsets[] = "(admin_username LIKE '$q' or email LIKE '$q')"; 
			} 
		 if(isset($_GET['stat']) && ($_GET['stat']!='')){
		 $stat = $_GET['stat'];
		 $optionsets[] = "is_active='$stat'"; 
		 } 
		 if(!empty($optionsets))
		 {
		 	$options['key']=' where '.implode(' and ',$optionsets);
		 }
		 $options['table'] ='admin';
		 @$options['key'] .=' order by admin_id desc';
		 $config = array();
	     $config["base_url"] = base_url()."admin/adminusers";
	     $config['first_url'] = base_url()."admin/adminusers?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
	     $config["suffix"] ="?q=".@$_GET['q']."&stat=".@$_GET['stat']."";
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $config["per_page"] = 10;
	     $config["uri_segment"] = 3;
		 $config["total_rows"] = $this->admin_model->getRecord($options,'counts');
		 $options['limit'] = $config["per_page"]; 

		 $options['offset'] = $page; 
		 $data['offset'] = $page; 

		 $data['paginate'] = @$page; 
		 $data['q']=@$_GET['q'];
		 $data['stat']=@$_GET['stat'];
		 $data['adminusers']=$this->admin_model->getRecord($options);
         $permi['table']='permissions';
         $permi['key'] =' order by name asc';
         $data['permissions']=$this->admin_model->getRecord($permi);
		 if(empty($data['adminusers']) && !empty($page))
		 {
		 	$paginate=$page-$config["per_page"];
		 	redirect('admin/adminusers/'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
		 }
		 $this->pagination->initialize($config);
	     $data["links"] = $this->pagination->create_links(); 

		 $data = $data + $this->data;
		$this->load->view('admin/common/template',$data);
		}
	}
	public function addadminuser()
	{
		 $regno=$this->admin_model->addadminuser($_POST);
		 if(!empty($regno))
			{
				$this->session->set_flashdata('success','Admin user has been added successfully!');
				redirect('admin/adminusers');
			}
			else
			{
				$this->session->set_flashdata('failure','Admin user has not been added');
				redirect('admin/adminusers');
			}
	}

	public function editadminuser()
	{
		//var_dump($_POST); exist;
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $editval=$this->admin_model->editadminuser($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Admin user has been updated successfully!');
				redirect('admin/adminusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Admin user has not been updated');
				redirect('admin/adminusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}

	public function deleteadminuser()
	{
		if(!empty($_GET['paginate']))
	    {
	      $paginate='/'.$_GET['paginate'];
	    }
		 $deleteval=$this->admin_model->deleteadminuser($_POST['deleteid']);
		 if(!empty($deleteval))
			{
				$this->session->set_flashdata('success','Admin user has been deleted successfully!');
				redirect('admin/adminusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Admin user has not been deleted');
				redirect('admin/adminusers'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	public function verifyadminemail() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['email']))
    {
      $value=$_POST['email'];
    }
    elseif(!empty($_POST['editemail']))
    {
       $value=$_POST['editemail'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where A.email='".$value."' or B.email='".$value."'" ; 
    }
    $options['query'] ='select A.* from admin A inner join users as B on A.admin_id=B.adminuser';
     $data = $this->admin_model->getJoin($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function verifyadminuser() {
   //	$lender=$_POST['lend_name'];
    if(!empty($_POST['username']))
    {
      $value=$_POST['username'];
    }
    elseif(!empty($_POST['editusername']))
    {
       $value=$_POST['editusername'];
    }
    $options=array();
    if(!empty($value))
    {
    $options['key'] = " where admin_username='".$value."'"; 
    }
    $options['table'] ='admin';
     $data = $this->admin_model->getRecord($options);
     if(!$data)
     {
      echo "true";
     }
     else
     {
      echo "false";
     }
	}
	public function changepassword()
	{
		 $editval=$this->admin_model->changepassword($_POST);
		 if(!empty($editval))
			{
				$this->session->set_flashdata('success','Password has been changed successfully!');
				redirect('admin/dashboard'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
			else
			{
				$this->session->set_flashdata('failure','Invalid old password.');
				redirect('admin/dashboard'.@$paginate.'?q='.@$_GET['q'].'&stat='.@$_GET['stat']);
			}
	}
	 public function logout() 
	 {
	 	$this->session->sess_destroy();
	 	redirect('admin');
	 }
}