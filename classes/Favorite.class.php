<?php

    class Favorite {
        private PDO $db;

        public function __construct(PDO $dbConnection) {
            $this->db = $dbConnection;
        }

        public function addFavorite(Favorite $favorite): bool{
            $stmt = $this->db->prepare("INSERT INTO favorites (userID, articleID) VALUES (:userID, :articleID)");
            $stmt->execute();
            return $stmt->execute();
        }

        public function deleteFavorite(Favorite $favorite, $articleID): bool {
            $stmt = $this->db->prepare("DELETE FROM favorites WHERE articleID = :articleID");
            $stmt->bindParam(':articleID', $articleID);
            return $stmt->execute();
        }

        public function getFavorites(int $articleID): array {
            $stmt = $this->db->prepare("SELECT * FROM favorites WHERE articleID = :articleID");
            $stmt->bindParam(':articleID', $articleID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        





    }
?>