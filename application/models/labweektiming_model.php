<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class labweektiming_model extends CI_Model
{
public function create($labweek)
{
$data=array("labweek" => $labweek);
$query=$this->db->insert( "health_labweektiming", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_labweektiming")->row();
return $query;
}
function getsinglelabweektiming($id){
$this->db->where("id",$id);
$query=$this->db->get("health_labweektiming")->row();
return $query;
}
public function edit($id,$labweek)
{
$data=array("labweek" => $labweek);
$this->db->where( "id", $id );
$query=$this->db->update( "health_labweektiming", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_labweektiming` WHERE `id`='$id'");
return $query;
}
}
?>
