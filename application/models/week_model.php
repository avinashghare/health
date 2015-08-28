<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class week_model extends CI_Model
{
    public function create($name)
    {
        $data=array("name" => $name);
        $query=$this->db->insert( "health_week", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_week")->row();
        return $query;
    }
    function getsingleweek($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_week")->row();
        return $query;
    }
    public function edit($id,$name)
    {
        $data=array("name" => $name);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_week", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_week` WHERE `id`='$id'");
        return $query;
    }
    public function getweek()
    {
        $query=$this->db->query("SELECT * FROM `health_week`")->result();
        return $query;
    }
}
?>
