<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorclinicweektiming_model extends CI_Model
{
public function create($doctorclinicweek,$timing)
{
$data=array("doctorclinicweek" => $doctorclinicweek,"timing" => $timing);
$query=$this->db->insert( "health_doctorclinicweektiming", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctorclinicweektiming")->row();
return $query;
}
function getsingledoctorclinicweektiming($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctorclinicweektiming")->row();
return $query;
}
public function edit($id,$doctorclinicweek,$timing)
{
$data=array("doctorclinicweek" => $doctorclinicweek,"timing" => $timing);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctorclinicweektiming", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctorclinicweektiming` WHERE `id`='$id'");
return $query;
}
}
?>
