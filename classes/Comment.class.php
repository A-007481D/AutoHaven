<?php

    class Comment {

        private PDO $db;

         public function __construct(PDO $dbConnection) {
            $this->db = $dbConnection;
        }


        public function addComment($userID, $articleID, $content): bool {

            $stmt = $this->db->prepare("INSERT INTO comments (content, articleID, userID) 
                                        VALUES (:content, :articleID, :userID)");
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':articleID', $articleID);
            $stmt->bindParam(':userID', $userID);
            return $stmt->execute();


        }



        public function updateComment($commentID, $articleID,$content): bool {
            $stmt = $this->db->prepare("UPDATE comments SET content = :content WHERE commentID = :commentID");
            $stmt->bindParam(':articleID', $articleID);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':commentID', $commentID);
            return $stmt->execute();

        }



        public function deleteComment($commentID): bool {
             $stmt = $this->db->prepare("DELETE FROM comments WHERE commentID = :commentID");
             $stmt->bindParam(':commentID', $commentID);
             return $stmt->execute();
        }


        public function getComments($articleID): array {
             $stmt = $this->db->prepare("SELECT * FROM comments WHERE articleID = :articleID");
             $stmt->bindParam(':articleID', $articleID);
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getComment($commentID): array {
             $stmt = $this->db->prepare("SELECT * FROM comments WHERE commentID = :commentID");
             $stmt->bindParam(':commentID', $commentID);
             $stmt->execute();
             return $stmt->fetch(PDO::FETCH_ASSOC);
        }














        
    }
?>