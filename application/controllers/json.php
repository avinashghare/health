<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getalldoctor()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctor`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctor`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctor`.`experiance`";
$elements[2]->sort="1";
$elements[2]->header="Experiance";
$elements[2]->alias="experiance";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctor`.`description`";
$elements[3]->sort="1";
$elements[3]->header="Description";
$elements[3]->alias="description";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`health_doctor`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`health_doctor`.`status`";
$elements[5]->sort="1";
$elements[5]->header="Status";
$elements[5]->alias="status";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctor`");
$this->load->view("json",$data);
}
public function getsingledoctor()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctor_model->getsingledoctor($id);
$this->load->view("json",$data);
}
function getalltypeofdoctor()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_typeofdoctor`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_typeofdoctor`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_typeofdoctor`");
$this->load->view("json",$data);
}
public function getsingletypeofdoctor()
{
$id=$this->input->get_post("id");
$data["message"]=$this->typeofdoctor_model->getsingletypeofdoctor($id);
$this->load->view("json",$data);
}
function getalldoctorservice()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorservice`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorservice`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorservice`.`service`";
$elements[2]->sort="1";
$elements[2]->header="Service";
$elements[2]->alias="service";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctorservice`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorservice`");
$this->load->view("json",$data);
}
public function getsingledoctorservice()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorservice_model->getsingledoctorservice($id);
$this->load->view("json",$data);
}
function getalldoctorspecialization()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorspecialization`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorspecialization`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorspecialization`.`specialization`";
$elements[2]->sort="1";
$elements[2]->header="Specialization";
$elements[2]->alias="specialization";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctorspecialization`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorspecialization`");
$this->load->view("json",$data);
}
public function getsingledoctorspecialization()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorspecialization_model->getsingledoctorspecialization($id);
$this->load->view("json",$data);
}
function getalldoctoreducation()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctoreducation`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctoreducation`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctoreducation`.`degree`";
$elements[2]->sort="1";
$elements[2]->header="Degree";
$elements[2]->alias="degree";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctoreducation`.`university`";
$elements[3]->sort="1";
$elements[3]->header="University";
$elements[3]->alias="university";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`health_doctoreducation`.`year`";
$elements[4]->sort="1";
$elements[4]->header="Year";
$elements[4]->alias="year";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`health_doctoreducation`.`order`";
$elements[5]->sort="1";
$elements[5]->header="Order";
$elements[5]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctoreducation`");
$this->load->view("json",$data);
}
public function getsingledoctoreducation()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctoreducation_model->getsingledoctoreducation($id);
$this->load->view("json",$data);
}
function getalldoctorexperiance()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorexperiance`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorexperiance`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorexperiance`.`experiance`";
$elements[2]->sort="1";
$elements[2]->header="Experiance";
$elements[2]->alias="experiance";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctorexperiance`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorexperiance`");
$this->load->view("json",$data);
}
public function getsingledoctorexperiance()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorexperiance_model->getsingledoctorexperiance($id);
$this->load->view("json",$data);
}
function getalldoctoraward()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctoraward`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctoraward`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctoraward`.`award`";
$elements[2]->sort="1";
$elements[2]->header="Award";
$elements[2]->alias="award";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctoraward`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctoraward`");
$this->load->view("json",$data);
}
public function getsingledoctoraward()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctoraward_model->getsingledoctoraward($id);
$this->load->view("json",$data);
}
function getalldoctormembership()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctormembership`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctormembership`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctormembership`.`membership`";
$elements[2]->sort="1";
$elements[2]->header="Membership";
$elements[2]->alias="membership";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctormembership`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctormembership`");
$this->load->view("json",$data);
}
public function getsingledoctormembership()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctormembership_model->getsingledoctormembership($id);
$this->load->view("json",$data);
}
function getalldoctorregistration()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorregistration`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorregistration`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorregistration`.`registration`";
$elements[2]->sort="1";
$elements[2]->header="Registration";
$elements[2]->alias="registration";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctorregistration`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorregistration`");
$this->load->view("json",$data);
}
public function getsingledoctorregistration()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorregistration_model->getsingledoctorregistration($id);
$this->load->view("json",$data);
}
function getallclinic()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_clinic`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_clinic`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_clinic`.`description`";
$elements[2]->sort="1";
$elements[2]->header="Description";
$elements[2]->alias="description";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_clinic`.`street`";
$elements[3]->sort="1";
$elements[3]->header="Street";
$elements[3]->alias="street";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`health_clinic`.`landmark`";
$elements[4]->sort="1";
$elements[4]->header="Landmark";
$elements[4]->alias="landmark";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`health_clinic`.`locality`";
$elements[5]->sort="1";
$elements[5]->header="Locality";
$elements[5]->alias="locality";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`health_clinic`.`area`";
$elements[6]->sort="1";
$elements[6]->header="Area";
$elements[6]->alias="area";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`health_clinic`.`city`";
$elements[7]->sort="1";
$elements[7]->header="City";
$elements[7]->alias="city";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`health_clinic`.`pincode`";
$elements[8]->sort="1";
$elements[8]->header="Pincode";
$elements[8]->alias="pincode";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`health_clinic`.`state`";
$elements[9]->sort="1";
$elements[9]->header="State";
$elements[9]->alias="state";

$elements=array();
$elements[10]=new stdClass();
$elements[10]->field="`health_clinic`.`country`";
$elements[10]->sort="1";
$elements[10]->header="Country";
$elements[10]->alias="country";

$elements=array();
$elements[11]=new stdClass();
$elements[11]->field="`health_clinic`.`lat`";
$elements[11]->sort="1";
$elements[11]->header="Latitude";
$elements[11]->alias="lat";

$elements=array();
$elements[12]=new stdClass();
$elements[12]->field="`health_clinic`.`long`";
$elements[12]->sort="1";
$elements[12]->header="Longitude";
$elements[12]->alias="long";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinic`");
$this->load->view("json",$data);
}
public function getsingleclinic()
{
$id=$this->input->get_post("id");
$data["message"]=$this->clinic_model->getsingleclinic($id);
$this->load->view("json",$data);
}
function getalltypeofclinic()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_typeofclinic`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_typeofclinic`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_typeofclinic`");
$this->load->view("json",$data);
}
public function getsingletypeofclinic()
{
$id=$this->input->get_post("id");
$data["message"]=$this->typeofclinic_model->getsingletypeofclinic($id);
$this->load->view("json",$data);
}
function getallclinicservice()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_clinicservice`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_clinicservice`.`clinic`";
$elements[1]->sort="1";
$elements[1]->header="Clinic";
$elements[1]->alias="clinic";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_clinicservice`.`service`";
$elements[2]->sort="1";
$elements[2]->header="Service";
$elements[2]->alias="service";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_clinicservice`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinicservice`");
$this->load->view("json",$data);
}
public function getsingleclinicservice()
{
$id=$this->input->get_post("id");
$data["message"]=$this->clinicservice_model->getsingleclinicservice($id);
$this->load->view("json",$data);
}
function getallclinicimage()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_clinicimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_clinicimage`.`clinic`";
$elements[1]->sort="1";
$elements[1]->header="Clinic";
$elements[1]->alias="clinic";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_clinicimage`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_clinicimage`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_clinicimage`");
$this->load->view("json",$data);
}
public function getsingleclinicimage()
{
$id=$this->input->get_post("id");
$data["message"]=$this->clinicimage_model->getsingleclinicimage($id);
$this->load->view("json",$data);
}
function getalldoctorclinic()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorclinic`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorclinic`.`doctor`";
$elements[1]->sort="1";
$elements[1]->header="Doctor";
$elements[1]->alias="doctor";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorclinic`.`clinic`";
$elements[2]->sort="1";
$elements[2]->header="Clinic";
$elements[2]->alias="clinic";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_doctorclinic`.`price`";
$elements[3]->sort="1";
$elements[3]->header="Price";
$elements[3]->alias="price";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinic`");
$this->load->view("json",$data);
}
public function getsingledoctorclinic()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorclinic_model->getsingledoctorclinic($id);
$this->load->view("json",$data);
}
function getalllab()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_lab`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_lab`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_lab`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_lab`.`street`";
$elements[3]->sort="1";
$elements[3]->header="Street";
$elements[3]->alias="street";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`health_lab`.`landmark`";
$elements[4]->sort="1";
$elements[4]->header="Landmark";
$elements[4]->alias="landmark";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`health_lab`.`locality`";
$elements[5]->sort="1";
$elements[5]->header="Locality";
$elements[5]->alias="locality";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`health_lab`.`area`";
$elements[6]->sort="1";
$elements[6]->header="Area";
$elements[6]->alias="area";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`health_lab`.`city`";
$elements[7]->sort="1";
$elements[7]->header="City";
$elements[7]->alias="city";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`health_lab`.`pincode`";
$elements[8]->sort="1";
$elements[8]->header="Pincode";
$elements[8]->alias="pincode";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`health_lab`.`state`";
$elements[9]->sort="1";
$elements[9]->header="State";
$elements[9]->alias="state";

$elements=array();
$elements[10]=new stdClass();
$elements[10]->field="`health_lab`.`country`";
$elements[10]->sort="1";
$elements[10]->header="Country";
$elements[10]->alias="country";

$elements=array();
$elements[11]=new stdClass();
$elements[11]->field="`health_lab`.`lat`";
$elements[11]->sort="1";
$elements[11]->header="Latitude";
$elements[11]->alias="lat";

$elements=array();
$elements[12]=new stdClass();
$elements[12]->field="`health_lab`.`long`";
$elements[12]->sort="1";
$elements[12]->header="Longitude";
$elements[12]->alias="long";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_lab`");
$this->load->view("json",$data);
}
public function getsinglelab()
{
$id=$this->input->get_post("id");
$data["message"]=$this->lab_model->getsinglelab($id);
$this->load->view("json",$data);
}
function getalllabfacility()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_labfacility`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_labfacility`.`lab`";
$elements[1]->sort="1";
$elements[1]->header="Lab";
$elements[1]->alias="lab";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_labfacility`.`facility`";
$elements[2]->sort="1";
$elements[2]->header="Facility";
$elements[2]->alias="facility";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_labfacility`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labfacility`");
$this->load->view("json",$data);
}
public function getsinglelabfacility()
{
$id=$this->input->get_post("id");
$data["message"]=$this->labfacility_model->getsinglelabfacility($id);
$this->load->view("json",$data);
}
function getalllabtest()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_labtest`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_labtest`.`lab`";
$elements[1]->sort="1";
$elements[1]->header="Lab";
$elements[1]->alias="lab";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_labtest`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_labtest`.`price`";
$elements[3]->sort="1";
$elements[3]->header="Price";
$elements[3]->alias="price";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`health_labtest`.`order`";
$elements[4]->sort="1";
$elements[4]->header="Order";
$elements[4]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labtest`");
$this->load->view("json",$data);
}
public function getsinglelabtest()
{
$id=$this->input->get_post("id");
$data["message"]=$this->labtest_model->getsinglelabtest($id);
$this->load->view("json",$data);
}
function getalllabaccrediation()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_labaccrediation`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_labaccrediation`.`lab`";
$elements[1]->sort="1";
$elements[1]->header="Lab";
$elements[1]->alias="lab";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_labaccrediation`.`accrediation`";
$elements[2]->sort="1";
$elements[2]->header="Accrediation";
$elements[2]->alias="accrediation";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`health_labaccrediation`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labaccrediation`");
$this->load->view("json",$data);
}
public function getsinglelabaccrediation()
{
$id=$this->input->get_post("id");
$data["message"]=$this->labaccrediation_model->getsinglelabaccrediation($id);
$this->load->view("json",$data);
}
function getallweek()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_week`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_week`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_week`");
$this->load->view("json",$data);
}
public function getsingleweek()
{
$id=$this->input->get_post("id");
$data["message"]=$this->week_model->getsingleweek($id);
$this->load->view("json",$data);
}
function getalltiming()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_timing`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_timing`.`time1`";
$elements[1]->sort="1";
$elements[1]->header="Time1";
$elements[1]->alias="time1";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_timing`.`time2`";
$elements[2]->sort="1";
$elements[2]->header="Time2";
$elements[2]->alias="time2";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_timing`");
$this->load->view("json",$data);
}
public function getsingletiming()
{
$id=$this->input->get_post("id");
$data["message"]=$this->timing_model->getsingletiming($id);
$this->load->view("json",$data);
}
function getalldoctorclinicweek()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorclinicweek`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorclinicweek`.`doctorclinic`";
$elements[1]->sort="1";
$elements[1]->header="Doctor Clinic";
$elements[1]->alias="doctorclinic";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorclinicweek`.`week`";
$elements[2]->sort="1";
$elements[2]->header="Week";
$elements[2]->alias="week";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinicweek`");
$this->load->view("json",$data);
}
public function getsingledoctorclinicweek()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorclinicweek_model->getsingledoctorclinicweek($id);
$this->load->view("json",$data);
}
function getalldoctorclinicweektiming()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_doctorclinicweektiming`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_doctorclinicweektiming`.`doctorclinicweek`";
$elements[1]->sort="1";
$elements[1]->header="Doctor clinic week";
$elements[1]->alias="doctorclinicweek";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_doctorclinicweektiming`.`timing`";
$elements[2]->sort="1";
$elements[2]->header="Timing";
$elements[2]->alias="timing";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_doctorclinicweektiming`");
$this->load->view("json",$data);
}
public function getsingledoctorclinicweektiming()
{
$id=$this->input->get_post("id");
$data["message"]=$this->doctorclinicweektiming_model->getsingledoctorclinicweektiming($id);
$this->load->view("json",$data);
}
function getalllabweek()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_labweek`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_labweek`.`lab`";
$elements[1]->sort="1";
$elements[1]->header="Lab";
$elements[1]->alias="lab";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`health_labweek`.`week`";
$elements[2]->sort="1";
$elements[2]->header="Week";
$elements[2]->alias="week";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labweek`");
$this->load->view("json",$data);
}
public function getsinglelabweek()
{
$id=$this->input->get_post("id");
$data["message"]=$this->labweek_model->getsinglelabweek($id);
$this->load->view("json",$data);
}
function getalllabweektiming()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`health_labweektiming`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`health_labweektiming`.`labweek`";
$elements[1]->sort="1";
$elements[1]->header="Lab Week";
$elements[1]->alias="labweek";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `health_labweektiming`");
$this->load->view("json",$data);
}
public function getsinglelabweektiming()
{
$id=$this->input->get_post("id");
$data["message"]=$this->labweektiming_model->getsinglelabweektiming($id);
$this->load->view("json",$data);
}
} ?>