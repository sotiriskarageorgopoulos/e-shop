<?php 
class Comment {
    private $commentId;
    private $desc;
    private $grade;
    private $submissionDate;
    private $username;
    private $postId;
    private $averageOfGrade;

    public function __construct($commentId,$desc,$grade,$submissionDate,$username,$postId)
    {
        $this->commentId = $commentId;
        $this->desc = $desc;
        $this->grade = $grade;
        $this->submissionDate = $submissionDate;
        $this->username = $username;
        $this->postId = $postId;
    }

    public function setCommentId($id){
        $this->commentId = $id;
    }

    public function setAverageOfGrade($avg) {
        $this->averageOfGrade = $avg; 
    }

    public function setDesc($desc){
        $this->desc = $desc;
    }

    public function setGrade($grade){
        $this->grade = $grade;
    }

    public function setSubmissionDate($date){
        $this->submissionDate = $date;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPostId($id){
        $this->postId = $id;
    }

    public function getCommentId(){
        return $this->commentId;
    }

    public function getDesc(){
        return $this->desc;
    }

    public function getGrade(){
        return $this->grade;
    }

    public function getSubmissionDate(){
        return $this->submissionDate;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPostId(){
        return $this->postId;
    }

    public function getAvgOfGrade(){
        return $this->averageOfGrade;
    }
}
?>