<?php 
  class Category {
      private $categoryName;
      private $categoryImg;
      private $scName;

      public function __construct($categoryName,$categoryImg,$link){
           $this->categoryName = $categoryName;
           $this->categoryImg = $categoryImg;
           $this->link = $link;
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
      
      public function setLink($link){
        $this->link = $link;
      }

      public function getLink(){
        return $this->link; 
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