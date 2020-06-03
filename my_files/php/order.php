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

    public function __construct($orderId,$road,$roadNumber,$postalCode,$delivery,$wayOfPayment,
    $cardNumber,$expirationDateOfCard,$username,$productId,$completionDate)
    {
        $this->orderId = $orderId;
        $this->road = $road;
        $this->roadNumber = $roadNumber;
        $this->postalCode = $postalCode;
        $this->delivery = $delivery;
        $this->wayOfPayment = $wayOfPayment;
        $this->cardNumber = $cardNumber;
        $this->expirationDateOfCard = $expirationDateOfCard;
        $this->username = $username;
        $this->productId = $productId;
        $this->completionDate = $completionDate;
    }

    public function setOrderId($orderId){
        $this->orderId = $orderId;
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
        return $this->delivery;
    }

    public function getPayment() {
        return $this->wayOfPayment;
    }

    public function getCardNumber() {
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
}

?>