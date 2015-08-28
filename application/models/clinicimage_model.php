<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class clinicimage_model extends CI_Model
{
    public function create($clinic,$image,$order)
    {
        $data=array("clinic" => $clinic,"image" => $image,"order" => $order);
        $query=$this->db->insert( "health_clinicimage", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_clinicimage")->row();
        return $query;
    }
    function getsingleclinicimage($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_clinicimage")->row();
        return $query;
    }
    public function edit($id,$clinic,$image,$order)
    {
        $data=array("clinic" => $clinic,"image" => $image,"order" => $order);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_clinicimage", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_clinicimage` WHERE `id`='$id'");
        return $query;
    }
    
	public function getclinicimageimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `health_clinicimage` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
