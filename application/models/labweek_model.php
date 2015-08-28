<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class labweek_model extends CI_Model
{
public function create($lab,$week)
{
$data=array("lab" => $lab,"week" => $week);
$query=$this->db->insert( "health_labweek", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_labweek")->row();
return $query;
}
function getsinglelabweek($id){
$this->db->where("id",$id);
$query=$this->db->get("health_labweek")->row();
return $query;
}
public function edit($id,$lab,$week)
{
$data=array("lab" => $lab,"week" => $week);
$this->db->where( "id", $id );
$query=$this->db->update( "health_labweek", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_labweek` WHERE `id`='$id'");
return $query;
}
}
?>
