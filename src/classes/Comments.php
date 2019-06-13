<?php
class Comments extends Mapper {

  public function getAllComments(){
    $statement = $this->db->prepare("SELECT users.username, comments.content, comments.createdAt, comments.entryID
                                      FROM comments
                                      JOIN entries
                                      ON entries.entryID = comments.entryID 
                                      JOIN users
                                      ON users.userID = comments.createdBy");
    $statement-> execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function sendComment($data) {
    $statement = $this->db->prepare("INSERT INTO comments(entryID,content,createdBy,createdAt)
                                      VALUES(:entryID,:content,:createdBy,:createdAt)");
    
      $createdBy = $_SESSION['userId'];
      $statement->bindParam(':createdBy', $createdBy, PDO::PARAM_INT);                    
      $statement->execute([
       ':entryID' => $data['entryID'],
       ':content' => $data['content'],
       ':createdBy' => $createdBy,
       ':createdAt' => date("Y-m-d H:i:s")]);
      //  return $data;
      } 
     

      
};