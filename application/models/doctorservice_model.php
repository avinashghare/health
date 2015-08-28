<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorservice_model extends CI_Model
{
public function create($doctor,$service,$order)
{
$data=array("doctor" => $doctor,"service" => $service,"order" => $order);
$query=$this->db->insert( "health_doctorservice", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctorservice")->row();
return $query;
}
function getsingledoctorservice($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctorservice")->row();
return $query;
}
public function edit($id,$doctor,$service,$order)
{
$data=array("doctor" => $doctor,"service" => $service,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctorservice", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctorservice` WHERE `id`='$id'");
return $query;
}
}
?>
