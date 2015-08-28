<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctoreducation_model extends CI_Model
{
public function create($doctor,$degree,$university,$year,$order)
{
$data=array("doctor" => $doctor,"degree" => $degree,"university" => $university,"year" => $year,"order" => $order);
$query=$this->db->insert( "health_doctoreducation", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("health_doctoreducation")->row();
return $query;
}
function getsingledoctoreducation($id){
$this->db->where("id",$id);
$query=$this->db->get("health_doctoreducation")->row();
return $query;
}
public function edit($id,$doctor,$degree,$university,$year,$order)
{
$data=array("doctor" => $doctor,"degree" => $degree,"university" => $university,"year" => $year,"order" => $order);
$this->db->where( "id", $id );
$query=$this->db->update( "health_doctoreducation", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `health_doctoreducation` WHERE `id`='$id'");
return $query;
}
}
?>
