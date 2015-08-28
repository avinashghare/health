<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewdoctor()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewdoctor";
    $data["base_url"]=site_url("site/viewdoctorjson");
    $data["title"]="View doctor";
    $this->load->view("template",$data);
    }
    function viewdoctorjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_doctor`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_doctor`.`name`";
    $elements[1]->sort="1";
    $elements[1]->header="Name";
    $elements[1]->alias="name";
    $elements[2]=new stdClass();
    $elements[2]->field="`health_doctor`.`experiance`";
    $elements[2]->sort="1";
    $elements[2]->header="Experiance";
    $elements[2]->alias="experiance";
    $elements[3]=new stdClass();
    $elements[3]->field="`health_doctor`.`description`";
    $elements[3]->sort="1";
    $elements[3]->header="Description";
    $elements[3]->alias="description";
    $elements[4]=new stdClass();
    $elements[4]->field="`health_doctor`.`image`";
    $elements[4]->sort="1";
    $elements[4]->header="Image";
    $elements[4]->alias="image";
    $elements[5]=new stdClass();
    $elements[5]->field="`health_doctor`.`status`";
    $elements[5]->sort="1";
    $elements[5]->header="Status";
    $elements[5]->alias="status";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctor`");
    $this->load->view("json",$data);
    }

    public function createdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data['typeofdoctor']=$this->typeofdoctor_model->typeofdoctordropdown();
        $data['status']=$this->doctor_model->getstatusdropdown();
        $data["page"]="createdoctor";
        $data["title"]="Create doctor";
        $this->load->view("template",$data);
    }
    public function createdoctorsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("experiance","Experiance","trim");
        $this->form_validation->set_rules("description","Description","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data['typeofdoctor']=$this->typeofdoctor_model->typeofdoctordropdown();
            $data['status']=$this->doctor_model->getstatusdropdown();
            $data["page"]="createdoctor";
            $data["title"]="Create doctor";
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            $experiance=$this->input->get_post("experiance");
            $description=$this->input->get_post("description");
//            $image=$this->input->get_post("image");
            $status=$this->input->get_post("status");
            $typeofdoctor=$this->input->get_post("typeofdoctor");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            
            if($this->doctor_model->create($name,$experiance,$description,$image,$status,$typeofdoctor)==0)
                $data["alerterror"]="New doctor could not be created.";
            else
                $data["alertsuccess"]="doctor created Successfully.";
            $data["redirect"]="site/viewdoctor";
            $this->load->view("redirect",$data);
        }
    }
    public function editdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctor";
        $data["page2"]="block/doctorblock";
        $data["title"]="Edit doctor";
        $data['typeofdoctor']=$this->typeofdoctor_model->typeofdoctordropdown();
        
        $data['selectedtypeofdoctor']=$this->doctor_model->gettypeofdoctorbyproperty($this->input->get('id'));
     
        $data['status']=$this->doctor_model->getstatusdropdown();
        $data["before"]=$this->doctor_model->beforeedit($this->input->get("id"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("experiance","Experiance","trim");
        $this->form_validation->set_rules("description","Description","trim");
//        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctor";
            $data["page2"]="block/doctorblock";
            $data["title"]="Edit doctor";
            $data['status']=$this->doctor_model->getstatusdropdown();
            $data["before"]=$this->doctor_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            $experiance=$this->input->get_post("experiance");
            $description=$this->input->get_post("description");
//            $image=$this->input->get_post("image");
            $status=$this->input->get_post("status");
            $typeofdoctor=$this->input->get_post("typeofdoctor");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->doctor_model->getdoctorimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
            if($this->doctor_model->edit($id,$name,$experiance,$description,$image,$status,$typeofdoctor)==0)
                $data["alerterror"]="New doctor could not be Updated.";
            else
                $data["alertsuccess"]="doctor Updated Successfully.";
            $data["redirect"]="site/viewdoctor";
            $this->load->view("redirect",$data);
        }
    }
    public function deletedoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->doctor_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewdoctor";
        $this->load->view("redirect",$data);
    }
    public function viewtypeofdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewtypeofdoctor";
        $data["base_url"]=site_url("site/viewtypeofdoctorjson");
        $data["title"]="View typeofdoctor";
        $this->load->view("template",$data);
    }
    function viewtypeofdoctorjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_typeofdoctor`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_typeofdoctor`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_typeofdoctor`");
        $this->load->view("json",$data);
    }

    public function createtypeofdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createtypeofdoctor";
        $data["title"]="Create typeofdoctor";
        $this->load->view("template",$data);
    }
    public function createtypeofdoctorsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createtypeofdoctor";
            $data["title"]="Create typeofdoctor";
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            if($this->typeofdoctor_model->create($name)==0)
            $data["alerterror"]="New typeofdoctor could not be created.";
            else
            $data["alertsuccess"]="typeofdoctor created Successfully.";
            $data["redirect"]="site/viewtypeofdoctor";
            $this->load->view("redirect",$data);
        }
    }
    public function edittypeofdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="edittypeofdoctor";
        $data["title"]="Edit typeofdoctor";
        $data["before"]=$this->typeofdoctor_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function edittypeofdoctorsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edittypeofdoctor";
            $data["title"]="Edit typeofdoctor";
            $data["before"]=$this->typeofdoctor_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            if($this->typeofdoctor_model->edit($id,$name)==0)
            $data["alerterror"]="New typeofdoctor could not be Updated.";
            else
            $data["alertsuccess"]="typeofdoctor Updated Successfully.";
            $data["redirect"]="site/viewtypeofdoctor";
            $this->load->view("redirect",$data);
        }
    }
    public function deletetypeofdoctor()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->typeofdoctor_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewtypeofdoctor";
        $this->load->view("redirect",$data);
    }
    public function viewdoctorservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctorservice";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorservicejson?id=".$this->input->get('id'));
        $data["title"]="View doctorservice";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorservicejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctorservice`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctorservice`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctorservice`.`service`";
        $elements[2]->sort="1";
        $elements[2]->header="Service";
        $elements[2]->alias="service";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctorservice`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorservice`","WHERE `health_doctorservice`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctorservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctorservice";
        $data["title"]="Create doctorservice";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorservicesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("service","Service","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctorservice";
            $data["title"]="Create doctorservice";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $service=$this->input->get_post("service");
            $order=$this->input->get_post("order");
            if($this->doctorservice_model->create($doctor,$service,$order)==0)
            $data["alerterror"]="New doctorservice could not be created.";
            else
            $data["alertsuccess"]="doctorservice created Successfully.";
            $data["redirect"]="site/viewdoctorservice?id=".$doctor;
            $this->load->view("redirect",$data);
        }
    }
    public function editdoctorservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctorservice";
        $data["title"]="Edit doctorservice";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctorservice"]=$this->doctorservice_model->beforeedit($this->input->get("doctorserviceid"));
        $this->load->view("template",$data);
    }
    public function editdoctorservicesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("service","Service","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctorservice";
            $data["title"]="Edit doctorservice";
            $data["before"]=$this->doctorservice_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $service=$this->input->get_post("service");
            $order=$this->input->get_post("order");
            if($this->doctorservice_model->edit($id,$doctor,$service,$order)==0)
                $data["alerterror"]="New doctorservice could not be Updated.";
            else
                $data["alertsuccess"]="doctorservice Updated Successfully.";
            $data["redirect"]="site/viewdoctorservice?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctorservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get('id');
        $this->doctorservice_model->delete($this->input->get("doctorserviceid"));
        $data["redirect"]="site/viewdoctorservice?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctorspecialization()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctorspecialization";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorspecializationjson?id=".$this->input->get('id'));
        $data["title"]="View doctorspecialization";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorspecializationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctorspecialization`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctorspecialization`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctorspecialization`.`specialization`";
        $elements[2]->sort="1";
        $elements[2]->header="Specialization";
        $elements[2]->alias="specialization";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctorspecialization`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorspecialization`","WHERE `health_doctorspecialization`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctorspecialization()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctorspecialization";
        $data["title"]="Create doctorspecialization";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorspecializationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("specialization","Specialization","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctorspecialization";
            $data["title"]="Create doctorspecialization";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $specialization=$this->input->get_post("specialization");
            $order=$this->input->get_post("order");
            if($this->doctorspecialization_model->create($doctor,$specialization,$order)==0)
            $data["alerterror"]="New doctorspecialization could not be created.";
            else
            $data["alertsuccess"]="doctorspecialization created Successfully.";
            $data["redirect"]="site/viewdoctorspecialization?id=".$doctor;
            $this->load->view("redirect",$data);
        }
    }
    public function editdoctorspecialization()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctorspecialization";
        $data["title"]="Edit doctorspecialization";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctorspecialization"]=$this->doctorspecialization_model->beforeedit($this->input->get("doctorspecializationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorspecializationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("specialization","Specialization","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctorspecialization";
            $data["title"]="Edit doctorspecialization";
            $data["before"]=$this->doctorspecialization_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $specialization=$this->input->get_post("specialization");
            $order=$this->input->get_post("order");
            if($this->doctorspecialization_model->edit($id,$doctor,$specialization,$order)==0)
            $data["alerterror"]="New doctorspecialization could not be Updated.";
            else
            $data["alertsuccess"]="doctorspecialization Updated Successfully.";
            $data["redirect"]="site/viewdoctorspecialization?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctorspecialization()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get('id');
        $this->doctorspecialization_model->delete($this->input->get("doctorspecializationid"));
        $data["redirect"]="site/viewdoctorspecialization?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctoreducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctoreducation";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctoreducationjson?id=".$this->input->get('id'));
        $data["title"]="View doctoreducation";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctoreducationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctoreducation`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctoreducation`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctoreducation`.`degree`";
        $elements[2]->sort="1";
        $elements[2]->header="Degree";
        $elements[2]->alias="degree";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctoreducation`.`university`";
        $elements[3]->sort="1";
        $elements[3]->header="University";
        $elements[3]->alias="university";
        $elements[4]=new stdClass();
        $elements[4]->field="`health_doctoreducation`.`year`";
        $elements[4]->sort="1";
        $elements[4]->header="Year";
        $elements[4]->alias="year";
        $elements[5]=new stdClass();
        $elements[5]->field="`health_doctoreducation`.`order`";
        $elements[5]->sort="1";
        $elements[5]->header="Order";
        $elements[5]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctoreducation`","WHERE `health_doctoreducation`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctoreducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctoreducation";
        $data["title"]="Create doctoreducation";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctoreducationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("degree","Degree","trim");
        $this->form_validation->set_rules("university","University","trim");
        $this->form_validation->set_rules("year","Year","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctoreducation";
            $data["title"]="Create doctoreducation";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $degree=$this->input->get_post("degree");
            $university=$this->input->get_post("university");
            $year=$this->input->get_post("year");
            $order=$this->input->get_post("order");
            if($this->doctoreducation_model->create($doctor,$degree,$university,$year,$order)==0)
            $data["alerterror"]="New doctoreducation could not be created.";
            else
            $data["alertsuccess"]="doctoreducation created Successfully.";
            $data["redirect"]="site/viewdoctoreducation?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function editdoctoreducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctoreducation";
        $data["title"]="Edit doctoreducation";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctoreducation"]=$this->doctoreducation_model->beforeedit($this->input->get("doctoreducationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctoreducationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("degree","Degree","trim");
        $this->form_validation->set_rules("university","University","trim");
        $this->form_validation->set_rules("year","Year","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctoreducation";
            $data["title"]="Edit doctoreducation";
            $data["before"]=$this->doctoreducation_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $degree=$this->input->get_post("degree");
            $university=$this->input->get_post("university");
            $year=$this->input->get_post("year");
            $order=$this->input->get_post("order");
            if($this->doctoreducation_model->edit($id,$doctor,$degree,$university,$year,$order)==0)
            $data["alerterror"]="New doctoreducation could not be Updated.";
            else
            $data["alertsuccess"]="doctoreducation Updated Successfully.";
            $data["redirect"]="site/viewdoctoreducation?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctoreducation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get('id');
        $this->doctoreducation_model->delete($this->input->get("doctoreducationid"));
        $data["redirect"]="site/viewdoctoreducation?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctorexperiance()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctorexperiance";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorexperiancejson?id=".$this->input->get('id'));
        $data["title"]="View doctorexperiance";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorexperiancejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctorexperiance`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctorexperiance`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctorexperiance`.`experiance`";
        $elements[2]->sort="1";
        $elements[2]->header="Experiance";
        $elements[2]->alias="experiance";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctorexperiance`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorexperiance`","WHERE `health_doctorexperiance`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctorexperiance()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctorexperiance";
        $data["title"]="Create doctorexperiance";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorexperiancesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("experiance","Experiance","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctorexperiance";
            $data["title"]="Create doctorexperiance";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $experiance=$this->input->get_post("experiance");
            $order=$this->input->get_post("order");
            if($this->doctorexperiance_model->create($doctor,$experiance,$order)==0)
            $data["alerterror"]="New doctorexperiance could not be created.";
            else
            $data["alertsuccess"]="doctorexperiance created Successfully.";
            $data["redirect"]="site/viewdoctorexperiance?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function editdoctorexperiance()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctorexperiance";
        $data["title"]="Edit doctorexperiance";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctorexperiance"]=$this->doctorexperiance_model->beforeedit($this->input->get("doctorexperianceid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorexperiancesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("experiance","Experiance","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctorexperiance";
            $data["title"]="Edit doctorexperiance";
            $data["before"]=$this->doctorexperiance_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $experiance=$this->input->get_post("experiance");
            $order=$this->input->get_post("order");
            if($this->doctorexperiance_model->edit($id,$doctor,$experiance,$order)==0)
            $data["alerterror"]="New doctorexperiance could not be Updated.";
            else
            $data["alertsuccess"]="doctorexperiance Updated Successfully.";
            $data["redirect"]="site/viewdoctorexperiance?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctorexperiance()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get("id");
        $this->doctorexperiance_model->delete($this->input->get("doctorexperianceid"));
        $data["redirect"]="site/viewdoctorexperiance?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctoraward()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctoraward";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorawardjson?id=".$this->input->get('id'));
        $data["title"]="View doctoraward";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorawardjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctoraward`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctoraward`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctoraward`.`award`";
        $elements[2]->sort="1";
        $elements[2]->header="Award";
        $elements[2]->alias="award";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctoraward`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctoraward`","WHERE `health_doctoraward`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctoraward()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctoraward";
        $data["title"]="Create doctoraward";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorawardsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("award","Award","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctoraward";
            $data["title"]="Create doctoraward";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $award=$this->input->get_post("award");
            $order=$this->input->get_post("order");
            if($this->doctoraward_model->create($doctor,$award,$order)==0)
            $data["alerterror"]="New doctoraward could not be created.";
            else
            $data["alertsuccess"]="doctoraward created Successfully.";
            $data["redirect"]="site/viewdoctoraward?id=".$doctor;
            $this->load->view("redirect",$data);
        }
    }
    public function editdoctoraward()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctoraward";
        $data["title"]="Edit doctoraward";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctoraward"]=$this->doctoraward_model->beforeedit($this->input->get("doctorawardid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorawardsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("award","Award","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctoraward";
            $data["title"]="Edit doctoraward";
            $data["before"]=$this->doctoraward_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $award=$this->input->get_post("award");
            $order=$this->input->get_post("order");
            if($this->doctoraward_model->edit($id,$doctor,$award,$order)==0)
            $data["alerterror"]="New doctoraward could not be Updated.";
            else
            $data["alertsuccess"]="doctoraward Updated Successfully.";
            $data["redirect"]="site/viewdoctoraward?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctoraward()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get("id");
        $this->doctoraward_model->delete($this->input->get("doctorawardid"));
        $data["redirect"]="site/viewdoctoraward?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctormembership()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctormembership";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctormembershipjson?id=".$this->input->get('id'));
        $data["title"]="View doctormembership";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctormembershipjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctormembership`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctormembership`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctormembership`.`membership`";
        $elements[2]->sort="1";
        $elements[2]->header="Membership";
        $elements[2]->alias="membership";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctormembership`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctormembership`","WHERE `health_doctormembership`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctormembership()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctormembership";
        $data["title"]="Create doctormembership";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctormembershipsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("membership","Membership","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctormembership";
            $data["title"]="Create doctormembership";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $membership=$this->input->get_post("membership");
            $order=$this->input->get_post("order");
            if($this->doctormembership_model->create($doctor,$membership,$order)==0)
                $data["alerterror"]="New doctormembership could not be created.";
            else
                $data["alertsuccess"]="doctormembership created Successfully.";
            $data["redirect"]="site/viewdoctormembership?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function editdoctormembership()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctormembership";
        $data["title"]="Edit doctormembership";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctormembership"]=$this->doctormembership_model->beforeedit($this->input->get("doctormembershipid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctormembershipsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("membership","Membership","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctormembership";
            $data["title"]="Edit doctormembership";
            $data["before"]=$this->doctormembership_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $membership=$this->input->get_post("membership");
            $order=$this->input->get_post("order");
            if($this->doctormembership_model->edit($id,$doctor,$membership,$order)==0)
            $data["alerterror"]="New doctormembership could not be Updated.";
            else
            $data["alertsuccess"]="doctormembership Updated Successfully.";
            $data["redirect"]="site/viewdoctormembership?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctormembership()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get("id");
        $this->doctormembership_model->delete($this->input->get("doctormembershipid"));
        $data["redirect"]="site/viewdoctormembership?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctorregistration()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctorregistration";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorregistrationjson?id=".$this->input->get('id'));
        $data["title"]="View doctorregistration";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorregistrationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctorregistration`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctorregistration`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctor";
        $elements[1]->alias="doctor";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctorregistration`.`registration`";
        $elements[2]->sort="1";
        $elements[2]->header="Registration";
        $elements[2]->alias="registration";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctorregistration`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorregistration`","WHERE `health_doctorregistration`.`doctor`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctorregistration()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctorregistration";
        $data["title"]="Create doctorregistration";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorregistrationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("registration","Registration","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctorregistration";
            $data["title"]="Create doctorregistration";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $registration=$this->input->get_post("registration");
            $order=$this->input->get_post("order");
            if($this->doctorregistration_model->create($doctor,$registration,$order)==0)
                $data["alerterror"]="New doctorregistration could not be created.";
            else
                $data["alertsuccess"]="doctorregistration created Successfully.";
            $data["redirect"]="site/viewdoctorregistration?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function editdoctorregistration()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctorregistration";
        $data["title"]="Edit doctorregistration";
        $data["page2"]="block/doctorblock";
        $data['doctor']=$this->input->get('id');
        $data['before']=$this->doctor_model->beforeedit($this->input->get('id'));
        $data["beforedoctorregistration"]=$this->doctorregistration_model->beforeedit($this->input->get("doctorregistrationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorregistrationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("registration","Registration","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctorregistration";
            $data["title"]="Edit doctorregistration";
            $data["before"]=$this->doctorregistration_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $registration=$this->input->get_post("registration");
            $order=$this->input->get_post("order");
            if($this->doctorregistration_model->edit($id,$doctor,$registration,$order)==0)
                $data["alerterror"]="New doctorregistration could not be Updated.";
            else
                $data["alertsuccess"]="doctorregistration Updated Successfully.";
            $data["redirect"]="site/viewdoctorregistration?id=".$doctor;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctorregistration()
    {
        $access=array("1");
        $this->checkaccess($access);
        $doctor=$this->input->get("id");
        $this->doctorregistration_model->delete($this->input->get("doctorregistrationid"));
        $data["redirect"]="site/viewdoctorregistration?id=".$doctor;
        $this->load->view("redirect2",$data);
    }
    public function viewclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewclinic";
        $data["base_url"]=site_url("site/viewclinicjson");
        $data["title"]="View clinic";
        $this->load->view("template",$data);
    }
    function viewclinicjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_clinic`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_clinic`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_clinic`.`description`";
        $elements[2]->sort="1";
        $elements[2]->header="Description";
        $elements[2]->alias="description";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_clinic`.`street`";
        $elements[3]->sort="1";
        $elements[3]->header="Street";
        $elements[3]->alias="street";
        $elements[4]=new stdClass();
        $elements[4]->field="`health_clinic`.`landmark`";
        $elements[4]->sort="1";
        $elements[4]->header="Landmark";
        $elements[4]->alias="landmark";
        $elements[5]=new stdClass();
        $elements[5]->field="`health_clinic`.`locality`";
        $elements[5]->sort="1";
        $elements[5]->header="Locality";
        $elements[5]->alias="locality";
        $elements[6]=new stdClass();
        $elements[6]->field="`health_clinic`.`area`";
        $elements[6]->sort="1";
        $elements[6]->header="Area";
        $elements[6]->alias="area";
        $elements[7]=new stdClass();
        $elements[7]->field="`health_clinic`.`city`";
        $elements[7]->sort="1";
        $elements[7]->header="City";
        $elements[7]->alias="city";
        $elements[8]=new stdClass();
        $elements[8]->field="`health_clinic`.`pincode`";
        $elements[8]->sort="1";
        $elements[8]->header="Pincode";
        $elements[8]->alias="pincode";
        $elements[9]=new stdClass();
        $elements[9]->field="`health_clinic`.`state`";
        $elements[9]->sort="1";
        $elements[9]->header="State";
        $elements[9]->alias="state";
        $elements[10]=new stdClass();
        $elements[10]->field="`health_clinic`.`country`";
        $elements[10]->sort="1";
        $elements[10]->header="Country";
        $elements[10]->alias="country";
        $elements[11]=new stdClass();
        $elements[11]->field="`health_clinic`.`lat`";
        $elements[11]->sort="1";
        $elements[11]->header="Latitude";
        $elements[11]->alias="lat";
        $elements[12]=new stdClass();
        $elements[12]->field="`health_clinic`.`long`";
        $elements[12]->sort="1";
        $elements[12]->header="Longitude";
        $elements[12]->alias="long";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinic`");
        $this->load->view("json",$data);
    }

    public function createclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createclinic";
        $data['typeofclinic']=$this->typeofclinic_model->typeofclinicdropdown();
        $data["title"]="Create clinic";
        $this->load->view("template",$data);
    }
    public function createclinicsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("description","Description","trim");
        $this->form_validation->set_rules("street","Street","trim");
        $this->form_validation->set_rules("landmark","Landmark","trim");
        $this->form_validation->set_rules("locality","Locality","trim");
        $this->form_validation->set_rules("area","Area","trim");
        $this->form_validation->set_rules("city","City","trim");
        $this->form_validation->set_rules("pincode","Pincode","trim");
        $this->form_validation->set_rules("state","State","trim");
        $this->form_validation->set_rules("country","Country","trim");
        $this->form_validation->set_rules("lat","Latitude","trim");
        $this->form_validation->set_rules("long","Longitude","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createclinic";
            $data["title"]="Create clinic";
            $data['typeofclinic']=$this->typeofclinic_model->typeofclinicdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            $description=$this->input->get_post("description");
            $street=$this->input->get_post("street");
            $landmark=$this->input->get_post("landmark");
            $locality=$this->input->get_post("locality");
            $area=$this->input->get_post("area");
            $city=$this->input->get_post("city");
            $pincode=$this->input->get_post("pincode");
            $state=$this->input->get_post("state");
            $country=$this->input->get_post("country");
            $lat=$this->input->get_post("lat");
            $long=$this->input->get_post("long");
            $typeofclinic=$this->input->get_post("typeofclinic");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($this->clinic_model->create($name,$description,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long,$image,$typeofclinic)==0)
            $data["alerterror"]="New clinic could not be created.";
            else
            $data["alertsuccess"]="clinic created Successfully.";
            $data["redirect"]="site/viewclinic";
            $this->load->view("redirect",$data);
        }
    }
    public function editclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editclinic";
        $data["page2"]="block/clinicblock";
        $data["title"]="Edit clinic";
        $data['typeofclinic']=$this->typeofclinic_model->typeofclinicdropdown();
        $data['selectedtypeofclinic']=$this->clinic_model->gettypeofclinicbyclinic($this->input->get('id'));
        $data["before"]=$this->clinic_model->beforeedit($this->input->get("id"));
        $this->load->view("templatewith2",$data);
    }
    public function editclinicsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("description","Description","trim");
        $this->form_validation->set_rules("street","Street","trim");
        $this->form_validation->set_rules("landmark","Landmark","trim");
        $this->form_validation->set_rules("locality","Locality","trim");
        $this->form_validation->set_rules("area","Area","trim");
        $this->form_validation->set_rules("city","City","trim");
        $this->form_validation->set_rules("pincode","Pincode","trim");
        $this->form_validation->set_rules("state","State","trim");
        $this->form_validation->set_rules("country","Country","trim");
        $this->form_validation->set_rules("lat","Latitude","trim");
        $this->form_validation->set_rules("long","Longitude","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editclinic";
            $data["title"]="Edit clinic";
            $data["page2"]="block/clinicblock";
            $data['typeofclinic']=$this->typeofclinic_model->typeofclinicdropdown();
            $data["before"]=$this->clinic_model->beforeedit($this->input->get("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            $description=$this->input->get_post("description");
            $street=$this->input->get_post("street");
            $landmark=$this->input->get_post("landmark");
            $locality=$this->input->get_post("locality");
            $area=$this->input->get_post("area");
            $city=$this->input->get_post("city");
            $pincode=$this->input->get_post("pincode");
            $state=$this->input->get_post("state");
            $country=$this->input->get_post("country");
            $lat=$this->input->get_post("lat");
            $long=$this->input->get_post("long");
            $typeofclinic=$this->input->get_post("typeofclinic");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->clinic_model->getclinicimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
            if($this->clinic_model->edit($id,$name,$description,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long,$image,$typeofclinic)==0)
                $data["alerterror"]="New clinic could not be Updated.";
            else
                $data["alertsuccess"]="clinic Updated Successfully.";
            $data["redirect"]="site/viewclinic";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->clinic_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewclinic";
        $this->load->view("redirect",$data);
    }
    public function viewtypeofclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewtypeofclinic";
        $data["base_url"]=site_url("site/viewtypeofclinicjson");
        $data["title"]="View typeofclinic";
        $this->load->view("template",$data);
    }
    function viewtypeofclinicjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_typeofclinic`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_typeofclinic`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_typeofclinic`");
        $this->load->view("json",$data);
    }

    public function createtypeofclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createtypeofclinic";
        $data["title"]="Create typeofclinic";
        $this->load->view("template",$data);
    }
    public function createtypeofclinicsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createtypeofclinic";
            $data["title"]="Create typeofclinic";
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            if($this->typeofclinic_model->create($name)==0)
            $data["alerterror"]="New typeofclinic could not be created.";
            else
            $data["alertsuccess"]="typeofclinic created Successfully.";
            $data["redirect"]="site/viewtypeofclinic";
            $this->load->view("redirect",$data);
        }
    }
    public function edittypeofclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="edittypeofclinic";
        $data["title"]="Edit typeofclinic";
        $data["before"]=$this->typeofclinic_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function edittypeofclinicsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edittypeofclinic";
            $data["title"]="Edit typeofclinic";
            $data["before"]=$this->typeofclinic_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            if($this->typeofclinic_model->edit($id,$name)==0)
            $data["alerterror"]="New typeofclinic could not be Updated.";
            else
            $data["alertsuccess"]="typeofclinic Updated Successfully.";
            $data["redirect"]="site/viewtypeofclinic";
            $this->load->view("redirect",$data);
        }
    }
    public function deletetypeofclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->typeofclinic_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewtypeofclinic";
        $this->load->view("redirect",$data);
    }
    public function viewclinicservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewclinicservice";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewclinicservicejson?id=".$this->input->get('id'));
        $data["title"]="View clinicservice";
        $this->load->view("templatewith2",$data);
    }
    function viewclinicservicejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_clinicservice`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_clinicservice`.`clinic`";
        $elements[1]->sort="1";
        $elements[1]->header="Clinic";
        $elements[1]->alias="clinic";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_clinicservice`.`service`";
        $elements[2]->sort="1";
        $elements[2]->header="Service";
        $elements[2]->alias="service";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_clinicservice`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinicservice`","WHERE `health_clinicservice`.`clinic`='$id'");
        $this->load->view("json",$data);
    }

    public function createclinicservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createclinicservice";
        $data["title"]="Create clinicservice";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createclinicservicesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("service","Service","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createclinicservice";
            $data["title"]="Create clinicservice";
            $this->load->view("template",$data);
        }
        else
        {
            $clinic=$this->input->get_post("clinic");
            $service=$this->input->get_post("service");
            $order=$this->input->get_post("order");
            if($this->clinicservice_model->create($clinic,$service,$order)==0)
                $data["alerterror"]="New clinicservice could not be created.";
            else
                $data["alertsuccess"]="clinicservice created Successfully.";
            $data["redirect"]="site/viewclinicservice?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function editclinicservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editclinicservice";
        $data["title"]="Edit clinicservice";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["beforeclinicservice"]=$this->clinicservice_model->beforeedit($this->input->get("clinicserviceid"));
        $this->load->view("template",$data);
    }
    public function editclinicservicesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("service","Service","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editclinicservice";
            $data["title"]="Edit clinicservice";
            $data["before"]=$this->clinicservice_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $clinic=$this->input->get_post("clinic");
            $service=$this->input->get_post("service");
            $order=$this->input->get_post("order");
            if($this->clinicservice_model->edit($id,$clinic,$service,$order)==0)
                $data["alerterror"]="New clinicservice could not be Updated.";
            else
                $data["alertsuccess"]="clinicservice Updated Successfully.";
            $data["redirect"]="site/viewclinicservice?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteclinicservice()
    {
        $access=array("1");
        $this->checkaccess($access);
        $clinic=$this->input->get("id");
        $this->clinicservice_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewclinicservice?id=".$clinic;
        $this->load->view("redirect2",$data);
    }
    public function viewclinicimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewclinicimage";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewclinicimagejson?id=".$this->input->get('id'));
        $data["title"]="View clinicimage";
        $this->load->view("templatewith2",$data);
    }
    function viewclinicimagejson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_clinicimage`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_clinicimage`.`clinic`";
        $elements[1]->sort="1";
        $elements[1]->header="Clinic";
        $elements[1]->alias="clinic";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_clinicimage`.`image`";
        $elements[2]->sort="1";
        $elements[2]->header="Image";
        $elements[2]->alias="image";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_clinicimage`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinicimage`","WHERE `health_clinicimage`.`clinic`='$id'");
        $this->load->view("json",$data);
    }

    public function createclinicimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createclinicimage";
        $data["title"]="Create clinicimage";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createclinicimagesubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["page"]="createclinicimage";
            $data["title"]="Create clinicimage";
            $data["page2"]="block/clinicblock";
            $data['clinic']=$this->input->get_post('id');
            $data['before']=$this->clinic_model->beforeedit($this->input->get_post('id'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $clinic=$this->input->get_post("clinic");
            $image=$this->input->get_post("image");
            $order=$this->input->get_post("order");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            
            if($this->clinicimage_model->create($clinic,$image,$order)==0)
            $data["alerterror"]="New clinicimage could not be created.";
            else
            $data["alertsuccess"]="clinicimage created Successfully.";
            $data["redirect"]="site/viewclinicimage?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function editclinicimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editclinicimage";
        $data["title"]="Edit clinicimage";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["beforeclinicimage"]=$this->clinicimage_model->beforeedit($this->input->get("clinicimageid"));
        $this->load->view("templatewith2",$data);
    }
    public function editclinicimagesubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editclinicimage";
            $data["title"]="Edit clinicimage";
            $data["page2"]="block/clinicblock";
            $data['clinic']=$this->input->get('id');
            $data['before']=$this->clinic_model->beforeedit($this->input->get_post('clinic'));
            $data["beforeclinicimage"]=$this->clinicimage_model->beforeedit($this->input->get("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $clinic=$this->input->get_post("clinic");
//            $image=$this->input->get_post("image");
            $order=$this->input->get_post("order");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->clinicimage_model->getclinicimageimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
            
            if($this->clinicimage_model->edit($id,$clinic,$image,$order)==0)
            $data["alerterror"]="New clinicimage could not be Updated.";
            else
            $data["alertsuccess"]="clinicimage Updated Successfully.";
            $data["redirect"]="site/viewclinicimage?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function deleteclinicimage()
    {
        $access=array("1");
        $this->checkaccess($access);
        $clinic=$this->input->get_post("id");
        $this->clinicimage_model->delete($this->input->get("clinicimageid"));
        $data["redirect"]="site/viewclinicimage?id=".$clinic;
        $this->load->view("redirect2",$data);
    }
    public function viewdoctorclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewdoctorclinic";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewdoctorclinicjson?id=".$this->input->get('id'));
        $data["title"]="View doctorclinic";
        $this->load->view("templatewith2",$data);
    }
    function viewdoctorclinicjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_doctorclinic`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_doctorclinic`.`doctor`";
        $elements[1]->sort="1";
        $elements[1]->header="Doctorid";
        $elements[1]->alias="doctorid";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_doctorclinic`.`clinic`";
        $elements[2]->sort="1";
        $elements[2]->header="Clinic";
        $elements[2]->alias="clinic";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_doctorclinic`.`price`";
        $elements[3]->sort="1";
        $elements[3]->header="Price";
        $elements[3]->alias="price";
        $elements[4]=new stdClass();
        $elements[4]->field="`health_doctor`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="doctor";
        $elements[4]->alias="doctor";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinic` LEFT OUTER JOIN `health_doctor` ON `health_doctor`.`id`=`health_doctorclinic`.`doctor`","WHERE `health_doctorclinic`.`clinic`='$id'");
        $this->load->view("json",$data);
    }

    public function createdoctorclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createdoctorclinic";
        $data["title"]="Create doctorclinic";
        $data["page2"]="block/clinicblock";
        $data['clinic']=$this->input->get('id');
        $data['doctor']=$this->doctor_model->getdoctordropdown();
        $data['week']=$this->week_model->getweek();
        $data['timing']=$this->timing_model->gettimingdropdown();
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createdoctorclinicsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("price","Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createdoctorclinic";
            $data['doctor']=$this->doctor_model->getdoctordropdown();
            $data["title"]="Create doctorclinic";
            $this->load->view("template",$data);
        }
        else
        {
            $doctor=$this->input->get_post("doctor");
            $clinic=$this->input->get_post("clinic");
            $price=$this->input->get_post("price");
            $weektiming=$this->input->get_post("weektiming");
            if($this->doctorclinic_model->create($doctor,$clinic,$price,$weektiming)==0)
                $data["alerterror"]="New doctorclinic could not be created.";
            else
                $data["alertsuccess"]="doctorclinic created Successfully.";
            $data["redirect"]="site/viewdoctorclinic?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function editdoctorclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editdoctorclinic";
        $data["title"]="Edit doctorclinic";
        $data["page2"]="block/clinicblock";
        $data['week']=$this->week_model->getweek();
        $data['timing']=$this->timing_model->gettimingdropdown();
        
        $data['selectedweek']=$this->doctorclinic_model->getweekbydoctorclinic($this->input->get('doctorclinicid'));
        $data['selectedweektime']=$this->doctorclinic_model->getweektimebydoctorclinic($this->input->get('doctorclinicid'));
//        print_r($data['selectedweektime']);
        $data['doctor']=$this->doctor_model->getdoctordropdown();
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["beforedoctorclinic"]=$this->doctorclinic_model->beforeedit($this->input->get("doctorclinicid"));
        $this->load->view("templatewith2",$data);
    }
    public function editdoctorclinicsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("doctor","Doctor","trim");
        $this->form_validation->set_rules("clinic","Clinic","trim");
        $this->form_validation->set_rules("price","Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editdoctorclinic";
            $data["title"]="Edit doctorclinic";
            $data["page2"]="block/clinicblock";
            $data['doctor']=$this->doctor_model->getdoctordropdown();
            $data['clinic']=$this->input->get('id');
            $data['before']=$this->clinic_model->beforeedit($this->input->get_post('clinic'));
            $data["beforedoctorclinic"]=$this->doctorclinic_model->beforeedit($this->input->get_post("id"));
            $this->load->view("template2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $doctor=$this->input->get_post("doctor");
            $clinic=$this->input->get_post("clinic");
            $price=$this->input->get_post("price");
            $weektiming=$this->input->get_post("weektiming");
            
            if($this->doctorclinic_model->edit($id,$doctor,$clinic,$price,$weektiming)==0)
            $data["alerterror"]="New doctorclinic could not be Updated.";
            else
            $data["alertsuccess"]="doctorclinic Updated Successfully.";
            $data["redirect"]="site/viewdoctorclinic?id=".$clinic;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletedoctorclinic()
    {
        $access=array("1");
        $this->checkaccess($access);
        $clinic=$this->input->get("id");
        $this->doctorclinic_model->delete($this->input->get("doctorclinicid"));
        $data["redirect"]="site/viewdoctorclinic?id=".$clinic;
        $this->load->view("redirect",$data);
    }
    public function viewlab()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlab";
        $data["base_url"]=site_url("site/viewlabjson");
        $data["title"]="View lab";
        $this->load->view("template",$data);
    }
    function viewlabjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_lab`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_lab`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_lab`.`image`";
        $elements[2]->sort="1";
        $elements[2]->header="Image";
        $elements[2]->alias="image";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_lab`.`street`";
        $elements[3]->sort="1";
        $elements[3]->header="Street";
        $elements[3]->alias="street";
        $elements[4]=new stdClass();
        $elements[4]->field="`health_lab`.`landmark`";
        $elements[4]->sort="1";
        $elements[4]->header="Landmark";
        $elements[4]->alias="landmark";
        $elements[5]=new stdClass();
        $elements[5]->field="`health_lab`.`locality`";
        $elements[5]->sort="1";
        $elements[5]->header="Locality";
        $elements[5]->alias="locality";
        $elements[6]=new stdClass();
        $elements[6]->field="`health_lab`.`area`";
        $elements[6]->sort="1";
        $elements[6]->header="Area";
        $elements[6]->alias="area";
        $elements[7]=new stdClass();
        $elements[7]->field="`health_lab`.`city`";
        $elements[7]->sort="1";
        $elements[7]->header="City";
        $elements[7]->alias="city";
        $elements[8]=new stdClass();
        $elements[8]->field="`health_lab`.`pincode`";
        $elements[8]->sort="1";
        $elements[8]->header="Pincode";
        $elements[8]->alias="pincode";
        $elements[9]=new stdClass();
        $elements[9]->field="`health_lab`.`state`";
        $elements[9]->sort="1";
        $elements[9]->header="State";
        $elements[9]->alias="state";
        $elements[10]=new stdClass();
        $elements[10]->field="`health_lab`.`country`";
        $elements[10]->sort="1";
        $elements[10]->header="Country";
        $elements[10]->alias="country";
        $elements[11]=new stdClass();
        $elements[11]->field="`health_lab`.`lat`";
        $elements[11]->sort="1";
        $elements[11]->header="Latitude";
        $elements[11]->alias="lat";
        $elements[12]=new stdClass();
        $elements[12]->field="`health_lab`.`long`";
        $elements[12]->sort="1";
        $elements[12]->header="Longitude";
        $elements[12]->alias="long";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_lab`");
        $this->load->view("json",$data);
    }

    public function createlab()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlab";
        $data["title"]="Create lab";
        $this->load->view("template",$data);
    }
    public function createlabsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("street","Street","trim");
        $this->form_validation->set_rules("landmark","Landmark","trim");
        $this->form_validation->set_rules("locality","Locality","trim");
        $this->form_validation->set_rules("area","Area","trim");
        $this->form_validation->set_rules("city","City","trim");
        $this->form_validation->set_rules("pincode","Pincode","trim");
        $this->form_validation->set_rules("state","State","trim");
        $this->form_validation->set_rules("country","Country","trim");
        $this->form_validation->set_rules("lat","Latitude","trim");
        $this->form_validation->set_rules("long","Longitude","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlab";
            $data["title"]="Create lab";
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
//            $image=$this->input->get_post("image");
            $street=$this->input->get_post("street");
            $landmark=$this->input->get_post("landmark");
            $locality=$this->input->get_post("locality");
            $area=$this->input->get_post("area");
            $city=$this->input->get_post("city");
            $pincode=$this->input->get_post("pincode");
            $state=$this->input->get_post("state");
            $country=$this->input->get_post("country");
            $lat=$this->input->get_post("lat");
            $long=$this->input->get_post("long");
            
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
//                $image1 = imagecreatefromjpeg(base_url("uploads")."/".$image);
////                echo "hello";
////                print_r($image1);
//                imagefilter($image1, IMG_FILTER_MEAN_REMOVAL);
//                imageinterlace($image1, 1);
////                imagegif($im, './php_interlaced.gif');
//                header("content-type: image/png");
//                imagejpeg($image1, './uploads/thumbnail/'.$image, 100);
//                imagejpeg($image1,base_url("uploads")."/".$image);
//                echo $image1;
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
                
            if($this->lab_model->create($name,$image,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long)==0)
                $data["alerterror"]="New lab could not be created.";
            else
                $data["alertsuccess"]="lab created Successfully.";
            $data["redirect"]="site/viewlab";
            $this->load->view("redirect",$data);
        }
    }
    public function editlab()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlab";
        $data["title"]="Edit lab";
        $data['page2']="block/labblock";
        $data["before"]=$this->lab_model->beforeedit($this->input->get("id"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("image","Image","trim");
        $this->form_validation->set_rules("street","Street","trim");
        $this->form_validation->set_rules("landmark","Landmark","trim");
        $this->form_validation->set_rules("locality","Locality","trim");
        $this->form_validation->set_rules("area","Area","trim");
        $this->form_validation->set_rules("city","City","trim");
        $this->form_validation->set_rules("pincode","Pincode","trim");
        $this->form_validation->set_rules("state","State","trim");
        $this->form_validation->set_rules("country","Country","trim");
        $this->form_validation->set_rules("lat","Latitude","trim");
        $this->form_validation->set_rules("long","Longitude","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlab";
            $data["title"]="Edit lab";
            $data["before"]=$this->lab_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
//            $image=$this->input->get_post("image");
            $street=$this->input->get_post("street");
            $landmark=$this->input->get_post("landmark");
            $locality=$this->input->get_post("locality");
            $area=$this->input->get_post("area");
            $city=$this->input->get_post("city");
            $pincode=$this->input->get_post("pincode");
            $state=$this->input->get_post("state");
            $country=$this->input->get_post("country");
            $lat=$this->input->get_post("lat");
            $long=$this->input->get_post("long");
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->lab_model->getlabimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
            
            if($this->lab_model->edit($id,$name,$image,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long)==0)
                $data["alerterror"]="New lab could not be Updated.";
            else
                $data["alertsuccess"]="lab Updated Successfully.";
            $data["redirect"]="site/viewlab";
            $this->load->view("redirect",$data);
        }
    }
    public function deletelab()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->lab_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewlab";
        $this->load->view("redirect",$data);
    }
    public function viewlabfacility()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlabfacility";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewlabfacilityjson?id=".$this->input->get('id'));
        $data["title"]="View labfacility";
        $this->load->view("templatewith2",$data);
    }
    function viewlabfacilityjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_labfacility`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_labfacility`.`lab`";
        $elements[1]->sort="1";
        $elements[1]->header="Lab";
        $elements[1]->alias="lab";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_labfacility`.`facility`";
        $elements[2]->sort="1";
        $elements[2]->header="Facility";
        $elements[2]->alias="facility";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_labfacility`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labfacility`","WHERE `health_labfacility`.`lab`='$id'");
        $this->load->view("json",$data);
    }

    public function createlabfacility()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlabfacility";
        $data["title"]="Create labfacility";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createlabfacilitysubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("facility","Facility","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlabfacility";
            $data["title"]="Create labfacility";
            $data["page2"]="block/labblock";
            $data['lab']=$this->input->get('id');
            $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $lab=$this->input->get_post("lab");
            $facility=$this->input->get_post("facility");
            $order=$this->input->get_post("order");
            if($this->labfacility_model->create($lab,$facility,$order)==0)
                $data["alerterror"]="New labfacility could not be created.";
            else
                $data["alertsuccess"]="labfacility created Successfully.";
            $data["redirect"]="site/viewlabfacility?id=".$lab;
            $this->load->view("redirect",$data);
        }
    }
    public function editlabfacility()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlabfacility";
        $data["title"]="Edit labfacility";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["beforelabfacility"]=$this->labfacility_model->beforeedit($this->input->get("labfacilityid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabfacilitysubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("facility","Facility","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlabfacility";
            $data["title"]="Edit labfacility";
            $data["page2"]="block/labblock";
            $data['lab']=$this->input->get('id');
            $data['before']=$this->lab_model->beforeedit($this->input->get_post('lab'));
            $data["beforelabfacility"]=$this->labfacility_model->beforeedit($this->input->get_post("id"));
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $lab=$this->input->get_post("lab");
            $facility=$this->input->get_post("facility");
            $order=$this->input->get_post("order");
            if($this->labfacility_model->edit($id,$lab,$facility,$order)==0)
            $data["alerterror"]="New labfacility could not be Updated.";
            else
            $data["alertsuccess"]="labfacility Updated Successfully.";
            $data["redirect"]="site/viewlabfacility?id=".$lab;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletelabfacility()
    {
        $access=array("1");
        $this->checkaccess($access);
        $lab=$this->input->get("id");
        $this->labfacility_model->delete($this->input->get("labfacilityid"));
        $data["redirect"]="site/viewlabfacility?id=".$lab;
        $this->load->view("redirect2",$data);
    }
    public function viewlabtest()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlabtest";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewlabtestjson?id=".$this->input->get('id'));
        $data["title"]="View labtest";
        $this->load->view("templatewith2",$data);
    }
    function viewlabtestjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_labtest`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_labtest`.`lab`";
        $elements[1]->sort="1";
        $elements[1]->header="Lab";
        $elements[1]->alias="lab";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_labtest`.`name`";
        $elements[2]->sort="1";
        $elements[2]->header="Name";
        $elements[2]->alias="name";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_labtest`.`price`";
        $elements[3]->sort="1";
        $elements[3]->header="Price";
        $elements[3]->alias="price";
        $elements[4]=new stdClass();
        $elements[4]->field="`health_labtest`.`order`";
        $elements[4]->sort="1";
        $elements[4]->header="Order";
        $elements[4]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labtest`","WHERE `health_labtest`.`lab`='$id'");
        $this->load->view("json",$data);
    }

    public function createlabtest()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlabtest";
        $data["title"]="Create labtest";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createlabtestsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("price","Price","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlabtest";
            $data["title"]="Create labtest";
            $this->load->view("templatewith2",$data);
        }
        else
        {
            $lab=$this->input->get_post("lab");
            $name=$this->input->get_post("name");
            $price=$this->input->get_post("price");
            $order=$this->input->get_post("order");
            if($this->labtest_model->create($lab,$name,$price,$order)==0)
            $data["alerterror"]="New labtest could not be created.";
            else
            $data["alertsuccess"]="labtest created Successfully.";
            $data["redirect"]="site/viewlabtest?id=".$lab;
            $this->load->view("redirect2",$data);
        }
    }
    public function editlabtest()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlabtest";
        $data["title"]="Edit labtest";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["beforelabtest"]=$this->labtest_model->beforeedit($this->input->get("labtestid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabtestsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("price","Price","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlabtest";
            $data["title"]="Edit labtest";
            $data["before"]=$this->labtest_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $lab=$this->input->get_post("lab");
            $name=$this->input->get_post("name");
            $price=$this->input->get_post("price");
            $order=$this->input->get_post("order");
            if($this->labtest_model->edit($id,$lab,$name,$price,$order)==0)
            $data["alerterror"]="New labtest could not be Updated.";
            else
            $data["alertsuccess"]="labtest Updated Successfully.";
            $data["redirect"]="site/viewlabtest?id=".$lab;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletelabtest()
    {
        $access=array("1");
        $this->checkaccess($access);
        $lab=$this->input->get("id");
        $this->labtest_model->delete($this->input->get("labtestid"));
        $data["redirect"]="site/viewlabtest?id=".$lab;
        $this->load->view("redirect2",$data);
    }
    public function viewlabaccrediation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlabaccrediation";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["base_url"]=site_url("site/viewlabaccrediationjson?id=".$this->input->get('id'));
        $data["title"]="View labaccrediation";
        $this->load->view("templatewith2",$data);
    }
    function viewlabaccrediationjson()
    {
        $id=$this->input->get('id');
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_labaccrediation`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_labaccrediation`.`lab`";
        $elements[1]->sort="1";
        $elements[1]->header="Lab";
        $elements[1]->alias="lab";
        $elements[2]=new stdClass();
        $elements[2]->field="`health_labaccrediation`.`accrediation`";
        $elements[2]->sort="1";
        $elements[2]->header="Accrediation";
        $elements[2]->alias="accrediation";
        $elements[3]=new stdClass();
        $elements[3]->field="`health_labaccrediation`.`order`";
        $elements[3]->sort="1";
        $elements[3]->header="Order";
        $elements[3]->alias="order";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labaccrediation`","WHERE `health_labaccrediation`.`lab`='$id'");
        $this->load->view("json",$data);
    }

    public function createlabaccrediation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlabaccrediation";
        $data["title"]="Create labaccrediation";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $this->load->view("templatewith2",$data);
    }
    public function createlabaccrediationsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("accrediation","Accrediation","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlabaccrediation";
            $data["title"]="Create labaccrediation";
            $this->load->view("template",$data);
        }
        else
        {
            $lab=$this->input->get_post("lab");
            $accrediation=$this->input->get_post("accrediation");
            $order=$this->input->get_post("order");
            if($this->labaccrediation_model->create($lab,$accrediation,$order)==0)
                $data["alerterror"]="New labaccrediation could not be created.";
            else
                $data["alertsuccess"]="labaccrediation created Successfully.";
            $data["redirect"]="site/viewlabaccrediation?id=".$lab;
            $this->load->view("redirect2",$data);
        }
    }
    public function editlabaccrediation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlabaccrediation";
        $data["title"]="Edit labaccrediation";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["beforelabaccrediation"]=$this->labaccrediation_model->beforeedit($this->input->get("labaccrediationid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabaccrediationsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("lab","Lab","trim");
        $this->form_validation->set_rules("accrediation","Accrediation","trim");
        $this->form_validation->set_rules("order","Order","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlabaccrediation";
            $data["title"]="Edit labaccrediation";
            $data["before"]=$this->labaccrediation_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $lab=$this->input->get_post("lab");
            $accrediation=$this->input->get_post("accrediation");
            $order=$this->input->get_post("order");
            if($this->labaccrediation_model->edit($id,$lab,$accrediation,$order)==0)
            $data["alerterror"]="New labaccrediation could not be Updated.";
            else
            $data["alertsuccess"]="labaccrediation Updated Successfully.";
            $data["redirect"]="site/viewlabaccrediation?id=".$lab;
            $this->load->view("redirect2",$data);
        }
    }
    public function deletelabaccrediation()
    {
        $access=array("1");
        $this->checkaccess($access);
        $lab=$this->input->get("id");
        $this->labaccrediation_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewlabaccrediation?id=".$lab;
        $this->load->view("redirect2",$data);
    }
    public function viewweek()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewweek";
        $data["base_url"]=site_url("site/viewweekjson");
        $data["title"]="View week";
        $this->load->view("template",$data);
    }
    function viewweekjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`health_week`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        $elements[1]=new stdClass();
        $elements[1]->field="`health_week`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_week`");
        $this->load->view("json",$data);
    }

    public function createweek()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createweek";
        $data["title"]="Create week";
        $this->load->view("template",$data);
    }
    public function createweeksubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createweek";
            $data["title"]="Create week";
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            if($this->week_model->create($name)==0)
            $data["alerterror"]="New week could not be created.";
            else
            $data["alertsuccess"]="week created Successfully.";
            $data["redirect"]="site/viewweek";
            $this->load->view("redirect",$data);
        }
    }
    public function editweek()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editweek";
        $data["title"]="Edit week";
        $data["before"]=$this->week_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editweeksubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editweek";
            $data["title"]="Edit week";
            $data["before"]=$this->week_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            if($this->week_model->edit($id,$name)==0)
            $data["alerterror"]="New week could not be Updated.";
            else
            $data["alertsuccess"]="week Updated Successfully.";
            $data["redirect"]="site/viewweek";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteweek()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->week_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewweek";
        $this->load->view("redirect",$data);
    }
    public function viewtiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewtiming";
    $data["base_url"]=site_url("site/viewtimingjson");
    $data["title"]="View timing";
    $this->load->view("template",$data);
    }
    function viewtimingjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_timing`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_timing`.`time1`";
    $elements[1]->sort="1";
    $elements[1]->header="Time1";
    $elements[1]->alias="time1";
    $elements[2]=new stdClass();
    $elements[2]->field="`health_timing`.`time2`";
    $elements[2]->sort="1";
    $elements[2]->header="Time2";
    $elements[2]->alias="time2";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_timing`");
    $this->load->view("json",$data);
    }

    public function createtiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createtiming";
    $data["title"]="Create timing";
    $this->load->view("template",$data);
    }
    public function createtimingsubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("time1","Time1","trim");
    $this->form_validation->set_rules("time2","Time2","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createtiming";
    $data["title"]="Create timing";
    $this->load->view("template",$data);
    }
    else
    {
    $time1=$this->input->get_post("time1");
    $time2=$this->input->get_post("time2");
    if($this->timing_model->create($time1,$time2)==0)
    $data["alerterror"]="New timing could not be created.";
    else
    $data["alertsuccess"]="timing created Successfully.";
    $data["redirect"]="site/viewtiming";
    $this->load->view("redirect",$data);
    }
    }
    public function edittiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="edittiming";
    $data["title"]="Edit timing";
    $data["before"]=$this->timing_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function edittimingsubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("time1","Time1","trim");
    $this->form_validation->set_rules("time2","Time2","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="edittiming";
    $data["title"]="Edit timing";
    $data["before"]=$this->timing_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $time1=$this->input->get_post("time1");
    $time2=$this->input->get_post("time2");
    if($this->timing_model->edit($id,$time1,$time2)==0)
    $data["alerterror"]="New timing could not be Updated.";
    else
    $data["alertsuccess"]="timing Updated Successfully.";
    $data["redirect"]="site/viewtiming";
    $this->load->view("redirect",$data);
    }
    }
    public function deletetiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->timing_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewtiming";
    $this->load->view("redirect",$data);
    }
    public function viewdoctorclinicweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewdoctorclinicweek";
    $data["base_url"]=site_url("site/viewdoctorclinicweekjson");
    $data["title"]="View doctorclinicweek";
    $this->load->view("template",$data);
    }
    function viewdoctorclinicweekjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_doctorclinicweek`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_doctorclinicweek`.`doctorclinic`";
    $elements[1]->sort="1";
    $elements[1]->header="Doctor Clinic";
    $elements[1]->alias="doctorclinic";
    $elements[2]=new stdClass();
    $elements[2]->field="`health_doctorclinicweek`.`week`";
    $elements[2]->sort="1";
    $elements[2]->header="Week";
    $elements[2]->alias="week";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinicweek`");
    $this->load->view("json",$data);
    }

    public function createdoctorclinicweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createdoctorclinicweek";
    $data["title"]="Create doctorclinicweek";
    $this->load->view("template",$data);
    }
    public function createdoctorclinicweeksubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("doctorclinic","Doctor Clinic","trim");
    $this->form_validation->set_rules("week","Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createdoctorclinicweek";
    $data["title"]="Create doctorclinicweek";
    $this->load->view("template",$data);
    }
    else
    {
    $doctorclinic=$this->input->get_post("doctorclinic");
    $week=$this->input->get_post("week");
    if($this->doctorclinicweek_model->create($doctorclinic,$week)==0)
    $data["alerterror"]="New doctorclinicweek could not be created.";
    else
    $data["alertsuccess"]="doctorclinicweek created Successfully.";
    $data["redirect"]="site/viewdoctorclinicweek";
    $this->load->view("redirect",$data);
    }
    }
    public function editdoctorclinicweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editdoctorclinicweek";
    $data["title"]="Edit doctorclinicweek";
    $data["before"]=$this->doctorclinicweek_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editdoctorclinicweeksubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("doctorclinic","Doctor Clinic","trim");
    $this->form_validation->set_rules("week","Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editdoctorclinicweek";
    $data["title"]="Edit doctorclinicweek";
    $data["before"]=$this->doctorclinicweek_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $doctorclinic=$this->input->get_post("doctorclinic");
    $week=$this->input->get_post("week");
    if($this->doctorclinicweek_model->edit($id,$doctorclinic,$week)==0)
    $data["alerterror"]="New doctorclinicweek could not be Updated.";
    else
    $data["alertsuccess"]="doctorclinicweek Updated Successfully.";
    $data["redirect"]="site/viewdoctorclinicweek";
    $this->load->view("redirect",$data);
    }
    }
    public function deletedoctorclinicweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->doctorclinicweek_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewdoctorclinicweek";
    $this->load->view("redirect",$data);
    }
    public function viewdoctorclinicweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewdoctorclinicweektiming";
    $data["base_url"]=site_url("site/viewdoctorclinicweektimingjson");
    $data["title"]="View doctorclinicweektiming";
    $this->load->view("template",$data);
    }
    function viewdoctorclinicweektimingjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_doctorclinicweektiming`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_doctorclinicweektiming`.`doctorclinicweek`";
    $elements[1]->sort="1";
    $elements[1]->header="Doctor clinic week";
    $elements[1]->alias="doctorclinicweek";
    $elements[2]=new stdClass();
    $elements[2]->field="`health_doctorclinicweektiming`.`timing`";
    $elements[2]->sort="1";
    $elements[2]->header="Timing";
    $elements[2]->alias="timing";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinicweektiming`");
    $this->load->view("json",$data);
    }

    public function createdoctorclinicweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createdoctorclinicweektiming";
    $data["title"]="Create doctorclinicweektiming";
    $this->load->view("template",$data);
    }
    public function createdoctorclinicweektimingsubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("doctorclinicweek","Doctor clinic week","trim");
    $this->form_validation->set_rules("timing","Timing","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createdoctorclinicweektiming";
    $data["title"]="Create doctorclinicweektiming";
    $this->load->view("template",$data);
    }
    else
    {
    $doctorclinicweek=$this->input->get_post("doctorclinicweek");
    $timing=$this->input->get_post("timing");
    if($this->doctorclinicweektiming_model->create($doctorclinicweek,$timing)==0)
    $data["alerterror"]="New doctorclinicweektiming could not be created.";
    else
    $data["alertsuccess"]="doctorclinicweektiming created Successfully.";
    $data["redirect"]="site/viewdoctorclinicweektiming";
    $this->load->view("redirect",$data);
    }
    }
    public function editdoctorclinicweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editdoctorclinicweektiming";
    $data["title"]="Edit doctorclinicweektiming";
    $data["before"]=$this->doctorclinicweektiming_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editdoctorclinicweektimingsubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("doctorclinicweek","Doctor clinic week","trim");
    $this->form_validation->set_rules("timing","Timing","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editdoctorclinicweektiming";
    $data["title"]="Edit doctorclinicweektiming";
    $data["before"]=$this->doctorclinicweektiming_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $doctorclinicweek=$this->input->get_post("doctorclinicweek");
    $timing=$this->input->get_post("timing");
    if($this->doctorclinicweektiming_model->edit($id,$doctorclinicweek,$timing)==0)
    $data["alerterror"]="New doctorclinicweektiming could not be Updated.";
    else
    $data["alertsuccess"]="doctorclinicweektiming Updated Successfully.";
    $data["redirect"]="site/viewdoctorclinicweektiming";
    $this->load->view("redirect",$data);
    }
    }
    public function deletedoctorclinicweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->doctorclinicweektiming_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewdoctorclinicweektiming";
    $this->load->view("redirect",$data);
    }
    public function viewlabweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewlabweek";
    $data["base_url"]=site_url("site/viewlabweekjson");
    $data["title"]="View labweek";
    $this->load->view("template",$data);
    }
    function viewlabweekjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_labweek`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_labweek`.`lab`";
    $elements[1]->sort="1";
    $elements[1]->header="Lab";
    $elements[1]->alias="lab";
    $elements[2]=new stdClass();
    $elements[2]->field="`health_labweek`.`week`";
    $elements[2]->sort="1";
    $elements[2]->header="Week";
    $elements[2]->alias="week";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labweek`");
    $this->load->view("json",$data);
    }

    public function createlabweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createlabweek";
    $data["title"]="Create labweek";
    $this->load->view("template",$data);
    }
    public function createlabweeksubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("lab","Lab","trim");
    $this->form_validation->set_rules("week","Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createlabweek";
    $data["title"]="Create labweek";
    $this->load->view("template",$data);
    }
    else
    {
    $lab=$this->input->get_post("lab");
    $week=$this->input->get_post("week");
    if($this->labweek_model->create($lab,$week)==0)
    $data["alerterror"]="New labweek could not be created.";
    else
    $data["alertsuccess"]="labweek created Successfully.";
    $data["redirect"]="site/viewlabweek";
    $this->load->view("redirect",$data);
    }
    }
    public function editlabweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editlabweek";
    $data["title"]="Edit labweek";
    $data["before"]=$this->labweek_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editlabweeksubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("lab","Lab","trim");
    $this->form_validation->set_rules("week","Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editlabweek";
    $data["title"]="Edit labweek";
    $data["before"]=$this->labweek_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $lab=$this->input->get_post("lab");
    $week=$this->input->get_post("week");
    if($this->labweek_model->edit($id,$lab,$week)==0)
    $data["alerterror"]="New labweek could not be Updated.";
    else
    $data["alertsuccess"]="labweek Updated Successfully.";
    $data["redirect"]="site/viewlabweek";
    $this->load->view("redirect",$data);
    }
    }
    public function deletelabweek()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->labweek_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewlabweek";
    $this->load->view("redirect",$data);
    }
    public function viewlabweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewlabweektiming";
    $data["base_url"]=site_url("site/viewlabweektimingjson");
    $data["title"]="View labweektiming";
    $this->load->view("template",$data);
    }
    function viewlabweektimingjson()
    {
    $elements=array();
    $elements[0]=new stdClass();
    $elements[0]->field="`health_labweektiming`.`id`";
    $elements[0]->sort="1";
    $elements[0]->header="ID";
    $elements[0]->alias="id";
    $elements[1]=new stdClass();
    $elements[1]->field="`health_labweektiming`.`labweek`";
    $elements[1]->sort="1";
    $elements[1]->header="Lab Week";
    $elements[1]->alias="labweek";
    $search=$this->input->get_post("search");
    $pageno=$this->input->get_post("pageno");
    $orderby=$this->input->get_post("orderby");
    $orderorder=$this->input->get_post("orderorder");
    $maxrow=$this->input->get_post("maxrow");
    if($maxrow=="")
    {
    $maxrow=20;
    }
    if($orderby=="")
    {
    $orderby="id";
    $orderorder="ASC";
    }
    $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labweektiming`");
    $this->load->view("json",$data);
    }

    public function createlabweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createlabweektiming";
    $data["title"]="Create labweektiming";
    $this->load->view("template",$data);
    }
    public function createlabweektimingsubmit() 
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("labweek","Lab Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="createlabweektiming";
    $data["title"]="Create labweektiming";
    $this->load->view("template",$data);
    }
    else
    {
    $labweek=$this->input->get_post("labweek");
    if($this->labweektiming_model->create($labweek)==0)
    $data["alerterror"]="New labweektiming could not be created.";
    else
    $data["alertsuccess"]="labweektiming created Successfully.";
    $data["redirect"]="site/viewlabweektiming";
    $this->load->view("redirect",$data);
    }
    }
    public function editlabweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editlabweektiming";
    $data["title"]="Edit labweektiming";
    $data["before"]=$this->labweektiming_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    public function editlabweektimingsubmit()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->form_validation->set_rules("id","ID","trim");
    $this->form_validation->set_rules("labweek","Lab Week","trim");
    if($this->form_validation->run()==FALSE)
    {
    $data["alerterror"]=validation_errors();
    $data["page"]="editlabweektiming";
    $data["title"]="Edit labweektiming";
    $data["before"]=$this->labweektiming_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
    }
    else
    {
    $id=$this->input->get_post("id");
    $labweek=$this->input->get_post("labweek");
    if($this->labweektiming_model->edit($id,$labweek)==0)
    $data["alerterror"]="New labweektiming could not be Updated.";
    else
    $data["alertsuccess"]="labweektiming Updated Successfully.";
    $data["redirect"]="site/viewlabweektiming";
    $this->load->view("redirect",$data);
    }
    }
    public function deletelabweektiming()
    {
    $access=array("1");
    $this->checkaccess($access);
    $this->labweektiming_model->delete($this->input->get("id"));
    $data["redirect"]="site/viewlabweektiming";
    $this->load->view("redirect",$data);
    }
//interlace and pregressive images
    
    
    
    
    //labtiming
    
    public function editlabtimingold()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlabtiming";
        $data["title"]="Edit Lab Timing";
        $data["page2"]="block/labblock";
        $data['week']=$this->week_model->getweek();
        $data['timing']=$this->timing_model->gettimingdropdown();
        
        $data['selectedweek']=$this->doctorclinic_model->getweekbydoctorclinic($this->input->get('doctorclinicid'));
        $data['selectedweektime']=$this->doctorclinic_model->getweektimebydoctorclinic($this->input->get('doctorclinicid'));
//        print_r($data['selectedweektime']);
        $data['doctor']=$this->doctor_model->getdoctordropdown();
        $data['clinic']=$this->input->get('id');
        $data['before']=$this->clinic_model->beforeedit($this->input->get('id'));
        $data["beforedoctorclinic"]=$this->doctorclinic_model->beforeedit($this->input->get("doctorclinicid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabtiming()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlabtiming";
        $data["title"]="Lab Timing";
        $data["page2"]="block/labblock";
        $data['lab']=$this->input->get('id');
        
        $data['week']=$this->week_model->getweek();
        $data['timing']=$this->timing_model->gettimingdropdown();
        
//        $data['selectedweek']=$this->lab_model->getweekbylab($this->input->get('id'));
        $data['selectedweektime']=$this->lab_model->getweektimebylab($this->input->get('id'));
        
        $data['before']=$this->lab_model->beforeedit($this->input->get('id'));
        $data["beforelabfacility"]=$this->labfacility_model->beforeedit($this->input->get("labfacilityid"));
        $this->load->view("templatewith2",$data);
    }
    public function editlabtimingsubmit()
    {
            $id=$this->input->get_post("id");
            $weektiming=$this->input->get_post("weektiming");
            
            if($this->lab_model->editlabtiming($id,$weektiming)==0)
            $data["alerterror"]="New Lab Timing could not be Updated.";
            else
            $data["alertsuccess"]="Lab Timing Updated Successfully.";
            $data["redirect"]="site/editlabtiming?id=".$id;
            $this->load->view("redirect2",$data);
    }
}
?>
