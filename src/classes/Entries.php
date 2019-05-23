<?php

class Entries extends Mapper{

    public function getPosts() {
        $statement = $this->db->prepare("SELECT * FROM entries");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

      }

      public function sendPost(){
          $statement = $this->db->prepare("INSERT INTO entries(title,content,createdBy,createdAt)
          VALUES(':title',':content',:createdBy,':createdAt');");

          $statement->execute(array('createdBy' => $_SESSION['userID']));
      }

} // end