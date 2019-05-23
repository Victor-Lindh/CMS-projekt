<?php

class Entry extends Mapper {
   //Steg 4
   public function getAllEntries() {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries");
     //Steg 6
     $statement->execute();
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getEntryByID($userID) {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries WHERE userID = :userID");
     //Steg 6
     $statement->execute([
       ':userID' => $userID
     ]);
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getFirstEntry($num) {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries ORDER BY createdAt ASC LIMIT :num");
     $statement->bindParam(':num', $num, PDO::PARAM_INT);
     //Steg 6
     $statement->execute();
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getLastEntry($num) {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries ORDER BY createdAt DESC LIMIT :num");
     $statement->bindParam(':num', $num, PDO::PARAM_INT);
     //Steg 6
     $statement->execute();
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getEntryByUserFirst($userID, $num) {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries WHERE userID = :userID ORDER BY createdAt ASC LIMIT :num");
     $statement->bindParam(':num', $num, PDO::PARAM_INT);
     $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
     //Om det är str använd PARAM_STR
     // ':userID' => $userID
     //Steg 6
     $statement->execute();
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getEntryByUserLast($userID, $num) {
     //Steg 5
     $statement = $this->db->prepare("SELECT * FROM entries WHERE userID = :userID ORDER BY createdAt DESC LIMIT :num");
     $statement->bindParam(':num', $num, PDO::PARAM_INT);
     $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
     //Steg 6
     $statement->execute();
     //Steg 7
     return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function sendNewPost($data) {
      $statement = $this->db->prepare("INSERT INTO entries(title, content, createdBy, createdAt)
                                      VALUES(:title, :content, :createdBy, :createdAt)");

      $statement->execute([
       ':title' => $data['title'],
        ':content' => $data['content'],
       ':createdBy' => $_SESSION['userId'],
        ':createdAt' => date("Y-m-d H:i:s")
      ]);
     
   }
 }