<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorclinicweek_model extends CI_Model
{
    public function create($doctorclinic,$week)
    {
        $data=array("doctorclinic" => $doctorclinic,"week" => $week);
        $query=$this->db->insert( "health_doctorclinicweek", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctorclinicweek")->row();
        return $query;
    }
    function getsingledoctorclinicweek($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctorclinicweek")->row();
        return $query;
    }
    public function edit($id,$doctorclinic,$week)
    {
        $data=array("doctorclinic" => $doctorclinic,"week" => $week);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_doctorclinicweek", $data );
        return 1;
    }
    public function delete($id)
        {
        $query=$this->db->query("DELETE FROM `health_doctorclinicweek` WHERE `id`='$id'");
        return $query;
    }
}
?>
