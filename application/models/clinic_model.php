<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class clinic_model extends CI_Model
{
    public function create($name,$description,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long,$image,$typeofclinic)
    {
        $data=array("name" => $name,"description" => $description,"street" => $street,"landmark" => $landmark,"locality" => $locality,"area" => $area,"city" => $city,"pincode" => $pincode,"state" => $state,"country" => $country,"lat" => $lat,"long" => $long,"image" => $image);
        $query=$this->db->insert( "health_clinic", $data );
        $id=$this->db->insert_id();
        
        foreach($typeofclinic AS $key=>$value)
        {
            $this->clinic_model->createclinictypeofclinic($value,$id);
        }
        if(!$query)
        return  0;
        else
        return  $id;
    }
    
    public function createclinictypeofclinic($value,$id)
	{
		$data  = array(
			'typeofclinic' => $value,
			'clinic' => $id
		);
		$query=$this->db->insert( 'clinictypeofclinic', $data );
		return  1;
	}
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_clinic")->row();
        return $query;
    }
    function getsingleclinic($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_clinic")->row();
        return $query;
    }
    public function edit($id,$name,$description,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long,$image,$typeofclinic)
    {
        $data=array("name" => $name,"description" => $description,"street" => $street,"landmark" => $landmark,"locality" => $locality,"area" => $area,"city" => $city,"pincode" => $pincode,"state" => $state,"country" => $country,"lat" => $lat,"long" => $long,"image" => $image);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_clinic", $data );
        
        $querydelete=$this->db->query("DELETE FROM `clinictypeofclinic` WHERE `clinic`='$id'");
        
        foreach($typeofclinic AS $key=>$value)
        {
            $this->clinic_model->createclinictypeofclinic($value,$id);
        }
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_clinic` WHERE `id`='$id'");
        return $query;
    }
    public function getclinicimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `health_clinic` WHERE `id`='$id'")->row();
		return $query;
	}
    
    public function gettypeofclinicbyclinic($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`,`clinic`,`typeofclinic` FROM `clinictypeofclinic`  WHERE `clinic`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->typeofclinic;
            }
        }
         return $return;
         
		
	}
}
?>
