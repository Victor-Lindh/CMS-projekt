<?php
class Likes extends Mapper {
    public function getLikedEntry(){

        $stmt = $this->db->prepare(
            "SELECT
                entries.entryID,
                entries.title,
                entries.content,
                entries.createdAt,
                users.username,
                COUNT(likes.likesID) as likes
                FROM  entries
                LEFT JOIN likes
                ON likes.entryID = entries.entryID
                JOIN users
                ON users.userID = entries.createdBy
                GROUP BY entries.entryID ");
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function addLike($userID , $entryID){
        $stmt = $this->db->prepare("INSERT INTO likes (userID, entryID)
            SELECT $userID, $entryID FROM entries
            WHERE EXISTS
            (SELECT entryID FROM entries WHERE entryID = $entryID) AND
            NOT EXISTS
            (SELECT likesID FROM likes WHERE userID = $userID  AND entryID = $entryID)
            LIMIT 1
            ");
        $stmt->execute([
            ":userID" => $userID,
            ":entryID" => $entryID
        ]);
        return "One Like Added";
    }
}
