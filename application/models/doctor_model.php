<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctor_model extends CI_Model
{
    public function create($name,$experiance,$description,$image,$status,$typeofdoctor)
    {
        $data=array(
            "name" => $name,
            "experiance" => $experiance,
            "description" => $description,
            "image" => $image,
            "status" => $status
        );
        $query=$this->db->insert( "health_doctor", $data );
        $id=$this->db->insert_id();
        
        foreach($typeofdoctor AS $key=>$value)
        {
            $this->doctor_model->createdoctortypeofdoctor($value,$id);
        }
        
        if(!$query)
        return  0;
        else
        return  $id;
    }
    
    public function createdoctortypeofdoctor($value,$id)
	{
		$data  = array(
			'typeofdoctor' => $value,
			'doctor' => $id
		);
		$query=$this->db->insert( 'doctortypeofdoctor', $data );
		return  1;
	}
    
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctor")->row();
        return $query;
    }
    function getsingledoctor($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctor")->row();
        return $query;
    }
    public function edit($id,$name,$experiance,$description,$image,$status,$typeofdoctor)
    {
        $data=array(
            "name" => $name,
            "experiance" => $experiance,
            "description" => $description,
            "image" => $image,
            "status" => $status
        );
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_doctor", $data );
        
        $querydelete=$this->db->query("DELETE FROM `doctortypeofdoctor` WHERE `doctor`='$id'");
        
        foreach($typeofdoctor AS $key=>$value)
        {
            $this->doctor_model->createdoctortypeofdoctor($value,$id);
        }
        
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_doctor` WHERE `id`='$id'");
        return $query;
    }
    
	public function getstatusdropdown()
	{
		$status= array(
			 "1" => "Enabled",
			 "0" => "Disabled",
			);
		return $status;
	}
    
	public function getdoctorimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `health_doctor` WHERE `id`='$id'")->row();
		return $query;
	}
    public function gettypeofdoctorbyproperty($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`,`doctor`,`typeofdoctor` FROM `doctortypeofdoctor`  WHERE `doctor`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->typeofdoctor;
            }
        }
         return $return;
         
		
	}
    
    public function getdoctordropdown()
	{
		$query=$this->db->query("SELECT * FROM `health_doctor`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
}
?>
