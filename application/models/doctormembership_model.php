<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctormembership_model extends CI_Model
{
public function create($doctor,$membership,$order)
{
$data=array("doctor" => $doctor,"membership" => $membership,"order" => $order);
$query=$this->db->insert( "health_doctormembership", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctormembership")->row();
return $query;
}
function getsingledoctormembership($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctormembership")->row();
return $query;
}
public function edit($id,$doctor,$membership,$order)
{
$data=array("doctor" => $doctor,"membership" => $membership,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctormembership", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctormembership` WHERE `id`='$id'");
return $query;
}
}
?>
