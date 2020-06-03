<?php 
class Post {
  private $postId;
  private $postImg;
  private $submissionDate;
  private $username;
  private $averageOfGrade;

  public function __construct($postId,$postImg,$submissionDate,$username,$averageOfGrade)
  {
      $this->postId = $postId;
      $this->postImg = $postImg;
      $this->submissionDate = $submissionDate;
      $this->username = $username;
      $this->averageOfGrade = $averageOfGrade;
  }

  public function setPostId($postId){
    $this->postId = $postId;
  }

  public function setPostImg($img){
    $this->postImg = $img;
  }

  public function setSubmissionDate($date){
    $this->submissionDate = $date;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function setAverageOfGrade($avg) {
    $this->averageOfGrade = $avg; 
  }

  public function getPostId(){
      return $this->postId;
  }

  public function getPostImg(){
      return $this->postImg;
  }

  public function getSubmissionDate(){
      return $this->submissionDate;
  }

  public function getUsername(){
      return $this->username;
  }

  public function getAvgOfGrade(){
      return $this->averageOfGrade;
  }
}
?>