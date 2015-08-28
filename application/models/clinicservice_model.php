<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class clinicservice_model extends CI_Model
{
public function create($clinic,$service,$order)
{
$data=array("clinic" => $clinic,"service" => $service,"order" => $order);
$query=$this->db->insert( "health_clinicservice", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_clinicservice")->row();
return $query;
}
function getsingleclinicservice($id){
$this->db->where("id",$id);
$query=$this->db->get("health_clinicservice")->row();
return $query;
}
public function edit($id,$clinic,$service,$order)
{
$data=array("clinic" => $clinic,"service" => $service,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_clinicservice", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_clinicservice` WHERE `id`='$id'");
return $query;
}
}
?>
