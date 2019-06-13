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
      public function getLatestPosts() {
        $statement = $this->db->prepare("SELECT title,content,createdBy,createdAt,entryID, users.username FROM entries LEFT JOIN users ON users.userID = entries.createdBy ORDER BY createdAt DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      public function getLatestUserPosts($userID) {
        $statement = $this->db->prepare("SELECT * FROM entries WHERE createdBy = :userID ORDER BY createdAt DESC");
        $statement->execute([":userID" => $userID]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        
      }
      
      public function removePost($entryID){
        $statement = $this->db->prepare("DELETE FROM entries WHERE entryID = :id");
        $statement->bindParam('id', $entryID);
        $statement->execute();
       return  [$entryID];
       }


       public function updatePost($title, $content, $editID) {
        $statement = $this->db->prepare("UPDATE entries SET title = :title, content = :content WHERE entryID = :id");
        $statement->bindParam('title', $title);
        $statement->bindParam('content', $content);
        $statement->bindParam('id', $editID);
        $statement->execute();
        return ['title' => $title, 'content' => $content];

      }

      
    };