<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctoraward_model extends CI_Model
{
public function create($doctor,$award,$order)
{
$data=array("doctor" => $doctor,"award" => $award,"order" => $order);
$query=$this->db->insert( "health_doctoraward", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctoraward")->row();
return $query;
}
function getsingledoctoraward($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctoraward")->row();
return $query;
}
public function edit($id,$doctor,$award,$order)
{
$data=array("doctor" => $doctor,"award" => $award,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctoraward", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctoraward` WHERE `id`='$id'");
return $query;
}
}
?>
