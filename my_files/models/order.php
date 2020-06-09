<?php 
class Order {
    private $orderId;
    private $road;
    private $roadNumber;
    private $postalCode;
    private $delivery;
    private $wayOfPayment;
    private $cardNumber;
    private $expirationDateOfCard;
    private $username;
    private $productId;
    private $completionDate;
    private $typeOfCard;

    public function __construct($road,$roadNumber,$postalCode,$delivery,$wayOfPayment,$username,$productId,$completionDate)
    {
        $this->road = $road;
        $this->roadNumber = $roadNumber;
        $this->postalCode = $postalCode;
        $this->delivery = $delivery;
        $this->wayOfPayment = $wayOfPayment;
        $this->username = $username;
        $this->productId = $productId;
        $this->completionDate = $completionDate;
    }

    public function setOrderId($orderId){
        $this->orderId = $orderId;
    }

    public function setTypeOfCard($typeOfCard){
        $this->typeOfCard = $typeOfCard;
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

    public function setDelivery($delivery){
        $this->delivery = $delivery;
    }

    public function setPayment($payment){
        $this->wayOfPayment = $payment;
    }

    public function setCardNumber($cardNumber){
        $this->cardNumber = $cardNumber;
    }

    public function setExpirationDateOfCard($date){
        $this->expirationDateOfCard = $date;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setCompletionDate($date) {
        $this->completionDate = $date;
    }

    public function getOrderId(){
      return $this->orderId;
    }

    public function getRoad(){
      return $this->road;
    }

    public function getRoadNumber(){
      return $this->roadNumber;
    }

    public function getPostalCode(){
        return $this->postalCode;
    }

    public function getDelivery() {
        if($this->delivery === "") return "-";
        return $this->delivery;
    }

    public function getPayment() {
        return $this->wayOfPayment;
    }

    public function getCardNumber() {
        if($this->cardNumber == null) return "-";
        return $this->cardNumber;
    }

    public function getExpirationDateOfCard(){
        return $this->expirationDateOfCard;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function getCompletionDate(){
        return $this->completionDate;
    }

    public function getTypeOfCard(){
        return $this->typeOfCard;
    }
}

?>