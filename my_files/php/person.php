<?php 
 
class Person {
    private $name ;
    private $surname;
    private $username;
    private $email;
    private $password;
    private $address;
    private $city;
    private $postalCode;
    private $phoneNumber;
    private $notify;

    public function __construct($name,$surname,$username,$email,$password,$address,$city,$postalCode,$phoneNumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->city = $city;
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

    public function setCity($city) {
        $this->city = $city;
    }

    public function setAddress($address){
       $this->address = $address;
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

    public function getCity() {
        return $this->city;
    }

    public function getAddress() {
        return $this->address;
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