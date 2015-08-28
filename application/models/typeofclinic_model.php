<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class typeofclinic_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "health_typeofclinic", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_typeofclinic")->row();
        return $query;
    }
    function getsingletypeofclinic($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_typeofclinic")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_typeofclinic", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_typeofclinic` WHERE `id`='$id'");
        return $query;
    }
    public function typeofclinicdropdown()
    {
		$query=$this->db->query("SELECT * FROM `health_typeofclinic`  ORDER BY `id` ASC")->result();
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
