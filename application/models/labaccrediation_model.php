<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class labaccrediation_model extends CI_Model
{
public function create($lab,$accrediation,$order)
{
$data=array("lab" => $lab,"accrediation" => $accrediation,"order" => $order);
$query=$this->db->insert( "health_labaccrediation", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_labaccrediation")->row();
return $query;
}
function getsinglelabaccrediation($id){
$this->db->where("id",$id);
$query=$this->db->get("health_labaccrediation")->row();
return $query;
}
public function edit($id,$lab,$accrediation,$order)
{
$data=array("lab" => $lab,"accrediation" => $accrediation,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_labaccrediation", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_labaccrediation` WHERE `id`='$id'");
return $query;
}
}
?>
