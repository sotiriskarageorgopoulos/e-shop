<?php 
  class Category {
      private $categoryName;
      private $categoryImg;
      private $scName;

      public function __construct($categoryName,$categoryImg,$scName){
           $this->categoryName = $categoryName;
           $this->categoryImg = $categoryImg;
           $this->scName = $scName;
      }

      public function setCategoryName($categoryName){
          $this->categoryName = $categoryName;
      } 

      public function setCategoryImg($categoryImg){
        $this->categoryImg = $categoryImg;
      } 

      public function setSubcategoryName($scName){
        $this->scName = $scName;
    } 

      public function getCategoryName(){
          return $this->categoryName;
      }

      public function getSubcategoryName(){
        return $this->scName;
    }

      public function getCategoryImg(){
          return $this->categoryImg;
      }
  }
?>