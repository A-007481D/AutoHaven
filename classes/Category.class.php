<?php
    require_once '.././classes/Database.class.php';

class Category {
    private $db;

    public function __construct($dbcon) {
        $this->db = $dbcon;
    }

    public function addCategory($catName) {
        $stmt = $this->db->prepare("INSERT INTO categories (catName) VALUES (?)");
        return $stmt->execute([$catName]);
    }

    public function editCategory($categoryID, $catName) {
        $stmt = $this->db->prepare("UPDATE categories SET catName = ? WHERE categoryID = ?");
        return $stmt->execute([$catName, $categoryID]);
    }

    public function deleteCategory($categoryID) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE categoryID = ?");
        return $stmt->execute([$categoryID]);
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}