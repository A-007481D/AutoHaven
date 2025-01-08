<?php

    class Tag {
        private PDO $db;

        public function __construct(PDO $dbConnection) {
            $this->db = $dbConnection;
        }

       public function addTags(): void {
            $stmt = $this->db->prepare("INSERT INTO tags (tag_name) VALUES (:tag_name)");
            $stmt->bindParam(':tag_name', $_POST['tag_name']);
            $stmt->execute();
       }


       public function deleteTags() : bool {
            $stmt = $this->db->prepare("DELETE FROM tags WHERE tag_name = :tag_name");
            $stmt->bindParam(':tag_name', $_POST['tag_name']);
            return $stmt->execute();
       }

       public function getAllTags() : array {
            $stmt = $this->db->prepare("SELECT * FROM tags");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }




    }
?>