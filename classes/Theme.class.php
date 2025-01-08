<?php

    class Theme {
            private PDO $db;
            public function __construct($dbConnection) {
                $this->db = $dbConnection;
            }

            public function addTheme(Theme $theme): bool {
                $stmt = $this->db->prepare("INSERT INTO themes (theme_name) VALUES (:theme_name)");
                $stmt->bindParam(':theme_name', $theme_name);
                return $stmt->execute();
            }

            public function updateTheme($theme_name, $themeID): bool {
                $stmt = $this->db->prepare("UPDATE themes SET theme_name = :theme_name WHERE id = :themeID");
                $stmt->bindParam(':$theme_name', $theme_name);
                $stmt->bindParam(':themeID', $themeID);
                return $stmt->execute();
            }

            public function deleteTheme(Theme $themeID): bool {
                $stmt = $this->db->prepare("DELETE FROM themes WHERE themeID = :themeID");
                $stmt->bindParam(':themeID', $themeID);
                return $stmt->execute();
            }

          public function getAllThemes() : array {
                $stmt = $this->db->prepare("SELECT * FROM themes");
                $stmt->execute();
               return $stmt->fetchALl(PDO::FETCH_ASSOC);

          }










    }



?>