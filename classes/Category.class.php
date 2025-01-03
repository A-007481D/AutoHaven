<?php
    require_once '.././classes/Database.class.php';

class Category {
    private $db;

    public function __construct($dbcon) {
        $this->db = $dbcon;
    }
    
    public function addCategory($catName) {
        $stmt = $this->db->prepare("INSERT INTO categories (catName) VALUES (:catName)");
        $stmt->bindParam(':catName', $catName);
        return $stmt->execute();
    }

    public function editCategory($categoryID, $catName) {
        $stmt = $this->db->prepare("UPDATE categories SET catName = :categoryName WHERE categoryID = :categoryID");
        $stmt->bindParam(':categoryName', $catName);
        $stmt->bindParam(':categoryID', $categoryID);
        return $stmt->execute();
    }

    public function editCategoryAvailability($categoryID, $availability) {
        $stmt = $this->db->prepare("UPDATE categories SET availability = :availability WHERE categoryID = :categoryID");
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':categoryID', $categoryID);
        return $stmt->execute();
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