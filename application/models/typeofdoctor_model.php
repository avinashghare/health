<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class typeofdoctor_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "health_typeofdoctor", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_typeofdoctor")->row();
        return $query;
    }
    function getsingletypeofdoctor($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_typeofdoctor")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_typeofdoctor", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_typeofdoctor` WHERE `id`='$id'");
        return $query;
    }
    public function typeofdoctordropdown()
    {
		$query=$this->db->query("SELECT * FROM `health_typeofdoctor`  ORDER BY `id` ASC")->result();
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
