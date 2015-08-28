<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class labfacility_model extends CI_Model
{
public function create($lab,$facility,$order)
{
$data=array("lab" => $lab,"facility" => $facility,"order" => $order);
$query=$this->db->insert( "health_labfacility", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_labfacility")->row();
return $query;
}
function getsinglelabfacility($id){
$this->db->where("id",$id);
$query=$this->db->get("health_labfacility")->row();
return $query;
}
public function edit($id,$lab,$facility,$order)
{
$data=array("lab" => $lab,"facility" => $facility,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_labfacility", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_labfacility` WHERE `id`='$id'");
return $query;
}
}
?>
