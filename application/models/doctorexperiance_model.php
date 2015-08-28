<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorexperiance_model extends CI_Model
{
public function create($doctor,$experiance,$order)
{
$data=array("doctor" => $doctor,"experiance" => $experiance,"order" => $order);
$query=$this->db->insert( "health_doctorexperiance", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctorexperiance")->row();
return $query;
}
function getsingledoctorexperiance($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctorexperiance")->row();
return $query;
}
public function edit($id,$doctor,$experiance,$order)
{
$data=array("doctor" => $doctor,"experiance" => $experiance,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctorexperiance", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctorexperiance` WHERE `id`='$id'");
return $query;
}
}
?>
