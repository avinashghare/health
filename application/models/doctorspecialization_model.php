<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorspecialization_model extends CI_Model
{
public function create($doctor,$specialization,$order)
{
$data=array("doctor" => $doctor,"specialization" => $specialization,"order" => $order);
$query=$this->db->insert( "health_doctorspecialization", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctorspecialization")->row();
return $query;
}
function getsingledoctorspecialization($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctorspecialization")->row();
return $query;
}
public function edit($id,$doctor,$specialization,$order)
{
$data=array("doctor" => $doctor,"specialization" => $specialization,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctorspecialization", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctorspecialization` WHERE `id`='$id'");
return $query;
}
}
?>
