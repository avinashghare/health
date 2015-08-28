<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorregistration_model extends CI_Model
{
public function create($doctor,$registration,$order)
{
$data=array("doctor" => $doctor,"registration" => $registration,"order" => $order);
$query=$this->db->insert( "health_doctorregistration", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctorregistration")->row();
return $query;
}
function getsingledoctorregistration($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctorregistration")->row();
return $query;
}
public function edit($id,$doctor,$registration,$order)
{
$data=array("doctor" => $doctor,"registration" => $registration,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctorregistration", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctorregistration` WHERE `id`='$id'");
return $query;
}
}
?>
