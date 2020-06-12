<?php 
 
class Person {
    private $name ;
    private $surname;
    private $username;
    private $email;
    private $password;
    private $road;
    private $roadNumber;
    private $region;
    private $postalCode;
    private $phoneNumber;
    private $notify;

    public function __construct($name,$surname,$username,$email,$password,$road,$roadNumber,$region,$postalCode,$phoneNumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->road = $road;
        $this->roadNumber = $roadNumber;
        $this->region = $region;
        $this->postalCode = $postalCode;
        $this->phoneNumber = $phoneNumber;
        $this->notify = false;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setUserName($username){
        $this->username = $username;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function setPassword($password){
        $this->password = $password;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function setRoad($road){
       $this->road = $road;
    }
     
    public function setRoadNumber($roadNum){
        $this->roadNumber = $roadNum;
     }

    public function setPostalCode($postalCode){
        $this->postalCode = $postalCode;
    }
    
    public function setphoneNumber($phoneNum){
        $this->phoneNumber = $phoneNum;
    }

    public  function setNotify($notify) {
        $this->notify = $notify;
    }

    public function getName(){
        return $this->name;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getRoad() {
        return $this->road;
    }

    public function getRoadNumber() {
        return $this->roadNumber;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getNotify() {
        return $this->notify;
    }
}

?>