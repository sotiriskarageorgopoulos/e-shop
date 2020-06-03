<?php 
class Product {
  private $productId;
  private $productName;
  private $price;
  private $quantity;
  private $desc;
  private $productImg;
  private $scName;
   
  public function __construct($productId,$productName,$price,$quantity,$desc,$productImg,$scName)
  {
      $this->productId = $productId;
      $this->productName = $productName;
      $this->price = $price;
      $this->quantity = $quantity;
      $this->desc = $desc;
      $this->productImg = $productImg;
      $this->scName = $scName;
  }

  public function setProductId($productId){
    $this->productId = $productId;
  }

  public function setProductName($productName){
    $this->productName = $productName;
  }

  public function setPrice($price){
    $this->price = $price;
  }

  public function setQuantity($quantity){
    $this->quantity = $quantity;
  }

  public function setDesc($desc) {
    $this->desc = $desc;
  }

  public function setProductImg($img) {
    $this->productImg = $img;
  }

  public function setScName($scName){
    $this->scName = $scName;
  }

  public function getProductId(){
    return $this->productId;
  }

  public function getProductName(){
    return $this->productName;
  }

  public function getPrice(){
    return $this->price;
  }

  public function getQunatity(){
    return $this->quantity;
  }

  public function getDesc(){
    return  $this->desc;
  }

  public function getProductImg(){
    return $this->productImg;
  }

  public function getScName(){
    return $this->scName;
  }
}
?>