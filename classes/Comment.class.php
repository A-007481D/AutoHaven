<?php

    class Comment {

        private PDO $db;

         public function __construct(PDO $dbConnection) {
            $this->db = $dbConnection;
        }


        public function addComment($userID, $articleID, $comment): bool {

            $stmt = $this->db->prepare("INSERT INTO comments (comment, articleID, userID) 
                                        VALUES (:comment, :articleID, :userID)");
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':articleID', $articleID);
            $stmt->bindParam(':userID', $userID);
            return $stmt->execute();


        }



        public function updateComment($commentID, $articleID,$comment): bool {
            $stmt = $this->db->prepare("UPDATE comments SET comment = :comment WHERE commentID = :commentID");
            $stmt->bindParam(':articleID', $articleID);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':commentID', $commentID);
            return $stmt->execute();

        }



        public function deleteComment($commentID): bool {
             $stmt = $this->db->prepare("DELETE FROM comments WHERE commentID = :commentID");
             $stmt->bindParam(':commentID', $commentID);
             return $stmt->execute();
        }


        public function getCommentsBy($articleID): array {
            $stmt = $this->db->prepare("SELECT comments.comment, comments.created_at, users.first_name 
                FROM comments 
                JOIN users ON comments.userID = users.userID
                WHERE comments.articleID = :articleID");
            $stmt->bindParam(':articleID', $articleID, PDO::PARAM_INT); // Ensure proper type binding
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array
        }
        
















    }
?>