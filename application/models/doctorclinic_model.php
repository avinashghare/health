<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class doctorclinic_model extends CI_Model
{
    public function create($doctor,$clinic,$price,$weektiming)
    {
        $data=array(
            "doctor" => $doctor,
            "clinic" => $clinic,
            "price" => $price
        );
        
        $query=$this->db->insert( "health_doctorclinic", $data );
        $id=$this->db->insert_id();
//        $id=1;
        $weektiming=json_decode($weektiming);
        if(!empty($weektiming))
        {
            foreach ($weektiming as $key=>$value)
            {
                $weekdays=intval($value->weekdays);
                $fromtime=intval($value->fromtime);
                $totime=intval($value->totime);

                $insertdoctorclinicweek=$this->db->query("INSERT INTO  `health_doctorclinicweek`(`doctorclinic`, `week`,`fromtime`,`totime`) VALUES ('$id','$weekdays','$fromtime','$totime')");
                $doctorclinicweekid=$this->db->insert_id();

            }
        }
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctorclinic")->row();
        return $query;
    }
    function getsingledoctorclinic($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("health_doctorclinic")->row();
        return $query;
    }
    public function edit($id,$doctor,$clinic,$price,$weektiming)
    {
        $data=array(
            "doctor" => $doctor,
            "clinic" => $clinic,
            "price" => $price
        );
        $this->db->where( "id", $id );
        $query=$this->db->update( "health_doctorclinic", $data );
        $deletequery=$this->db->query("DELETE FROM `health_doctorclinicweek` WHERE `doctorclinic`='$id'");
        $weektiming=json_decode($weektiming);
        if(!empty($weektiming))
        {
            foreach ($weektiming as $key=>$value)
            {
                $weekdays=intval($value->weekdays);
                $fromtime=intval($value->fromtime);
                $totime=intval($value->totime);

                $insertdoctorclinicweek=$this->db->query("INSERT INTO  `health_doctorclinicweek`(`doctorclinic`, `week`,`fromtime`,`totime`) VALUES ('$id','$weekdays','$fromtime','$totime')");
                $doctorclinicweekid=$this->db->insert_id();

            }
        }
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `health_doctorclinic` WHERE `id`='$id'");
        return $query;
    }
     public function getweekbydoctorclinic($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`, `doctorclinic`, `week`, `fromtime`, `totime` FROM `health_doctorclinicweek`  WHERE `doctorclinic`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->week;
            }
        }
         return $return;
         
		
	}
     public function getweektimebydoctorclinic($id)
	{
         $return=array();
//		$query=$this->db->query("SELECT `id`, `doctorclinic`, `week`, `fromtime`, `totime` FROM `health_doctorclinicweek` LEFT OUTER JOIN `health_week` ON `health_week`.`id`=`health_doctorclinicweek`.`week`  WHERE `doctorclinic`='$id'")->result();
         
		$query=$this->db->query("SELECT  `health_doctorclinicweek`.`doctorclinic`, `health_doctorclinicweek`.`week`, `health_doctorclinicweek`.`fromtime`,`health_doctorclinicweek`. `totime`,`health_week`.`name`,`health_week`.`id` FROM `health_doctorclinicweek` RIGHT OUTER JOIN `health_week` ON `health_week`.`id`=`health_doctorclinicweek`.`week`  AND `doctorclinic`='$id'")->result();
         
//         $query['hotels']=$this->db->query("SELECT `hotel_hotel`.`id`, `hotel_hotel`.`name`, `hotel_hotel`.`initialbalance`, `hotel_hotel`.`location` ,`hotel_order`.`id` AS `orderid`, `hotel_order`.`user`, `hotel_order`.`admin`, `hotel_order`.`hotel`, `hotel_order`.`days`, `hotel_order`.`userrate`, `hotel_order`.`hotelrate`, `hotel_order`.`status`, `hotel_order`.`price`, `hotel_order`.`timestamp` FROM `hotel_order` RIGHT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` AND `hotel_order`.`user`='$userid'")->result();
         
//         $query=$this->db->query("SELECT  `health_doctorclinicweek`.`doctorclinic`, `health_doctorclinicweek`.`week`, `health_doctorclinicweek`.`fromtime`,`health_doctorclinicweek`. `totime`,`health_week`.`name`,`health_week`.`id` FROM `health_week` 
//         LEFT OUTER JOIN `health_doctorclinicweek` ON `health_week`.`id`=`health_doctorclinicweek`.`week`  
//         WHERE `doctorclinic`='$id'")->result();
         return $query;
//        if($query->num_rows() > 0)
//        {
//            $query=$query->result();
//            foreach($query as $row)
//            {
//                $return[]=$row->week;
//            }
//        }
         return $return;
         
		
	}
}
?>
