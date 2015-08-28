<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class lab_model extends CI_Model
{
    public function create($name,$image,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long)
    {
        $data=array("name" => $name,"image" => $image,"street" => $street,"landmark" => $landmark,"locality" => $locality,"area" => $area,"city" => $city,"pincode" => $pincode,"state" => $state,"country" => $country,"lat" => $lat,"long" => $long);
        $query=$this->db->insert( "health_lab", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_lab")->row();
        return $query;
    }
    function getsinglelab($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_lab")->row();
        return $query;
    }
    public function edit($id,$name,$image,$street,$landmark,$locality,$area,$city,$pincode,$state,$country,$lat,$long)
    {
        $data=array("name" => $name,"image" => $image,"street" => $street,"landmark" => $landmark,"locality" => $locality,"area" => $area,"city" => $city,"pincode" => $pincode,"state" => $state,"country" => $country,"lat" => $lat,"long" => $long);
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_lab", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_lab` WHERE `id`='$id'");
        return $query;
    }
    
	public function getlabimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `health_lab` WHERE `id`='$id'")->row();
		return $query;
	}
    
     public function getweektimebylab($id)
	{
		$query=$this->db->query("SELECT  `health_labweek`.`lab`, `health_labweek`.`week`, `health_labweek`.`fromtime`,`health_labweek`. `totime`,`health_week`.`name`,`health_week`.`id` FROM `health_labweek` RIGHT OUTER JOIN `health_week` ON `health_week`.`id`=`health_labweek`.`week`  AND `health_labweek`.`lab`='$id'")->result();
         
         return $query;
         
		
	}
    
    public function editlabtiming($id,$weektiming)
    {
        
        $weektiming=json_decode($weektiming);
        if(!empty($weektiming))
        {
            $deletequery=$this->db->query("DELETE FROM `health_labweek` WHERE `lab`='$id'");
            foreach ($weektiming as $key=>$value)
            {
                $weekdays=intval($value->weekdays);
                $fromtime=intval($value->fromtime);
                $totime=intval($value->totime);

                $insertlabweek=$this->db->query("INSERT INTO  `health_labweek`(`lab`, `week`,`fromtime`,`totime`) VALUES ('$id','$weekdays','$fromtime','$totime')");
                $labweekid=$this->db->insert_id();

            }
        }
        return 1;
    }
}
?>
