<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class labtest_model extends CI_Model
{
public function create($lab,$name,$price,$order)
{
$data=array("lab" => $lab,"name" => $name,"price" => $price,"order" => $order);
$query=$this->db->insert( "health_labtest", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_labtest")->row();
return $query;
}
function getsinglelabtest($id){
$this->db->where("id",$id);
$query=$this->db->get("health_labtest")->row();
return $query;
}
public function edit($id,$lab,$name,$price,$order)
{
$data=array("lab" => $lab,"name" => $name,"price" => $price,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_labtest", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_labtest` WHERE `id`='$id'");
return $query;
}
}
?>
