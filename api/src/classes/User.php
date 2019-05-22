<?php

class User extends Mapper {

  public function getUserByID($userID) {
    $statement = $this->db->prepare("SELECT * FROM users WHERE userID = :userID");
    $statement->execute([
      ':userID' => $userID
    ]);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getAllUsers() {
    $statement = $this->db->prepare("SELECT * FROM users");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function getUserName() {
    $statement = $this->db->prepare("SELECT username FROM users");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  
}
class Entries extends Mapper{
      public function getContent($content) {
        $statement = $this->db->prepare("SELECT content FROM entries");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getPosts($post) {
        $statement = $this->db->prepare("SELECT * FROM entries");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }
   
      public function getPostId() {

        $uid= $_SESSION['userID']; 
              
        $statement = $pdo->prepare("SELECT * FROM entries Where userID = $uid"); 
        $statement->execute(); 
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;

      }

      

}
