<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class timing_model extends CI_Model
{
    public function create($time1,$time2)
    {
        $data=array("time1" => $time1,"time2" => $time2);
        $query=$this->db->insert( "health_timing", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_timing")->row();
        return $query;
    }
    function getsingletiming($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_timing")->row();
        return $query;
    }
    public function edit($id,$time1,$time2)
    {
        $data=array("time1" => $time1,"time2" => $time2);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_timing", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_timing` WHERE `id`='$id'");
        return $query;
    }
    
    public function gettiming()
    {
        $query=$this->db->query("SELECT * FROM `health_timing`")->result();
        return $query;
    }
    public function gettimingdropdown()
	{
		$query=$this->db->query("SELECT * FROM `health_timing`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->time1;
		}
		
		return $return;
	}
}
?>
