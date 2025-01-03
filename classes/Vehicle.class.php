<?php
    require_once '.././classes/Database.class.php';

class Vehicle {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function addVehicle($model, $brand, $categoryID, $price, $description, $image, $fuel, $seats, $doors, $features) {
        $stmt = $this->db->prepare(
            "INSERT INTO vehicles (model, brand, categoryID, price, description, image, fuel, seats, doors, features) 
             VALUES (:model, :brand, :categoryID, :price, :description, :image, :fuel, :seats, :doors, :features)"
        );
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':fuel', $fuel);
        $stmt->bindParam(':seats', $seats);
        $stmt->bindParam(':doors', $doors);
        $stmt->bindParam(':features', $features);
        return $stmt->execute();
    }

    public function editVehicle($vehicleID, $model, $brand, $categoryID, $price, $description, $image, $fuel, $seats, $doors, $features) {
        $stmt = $this->db->prepare(
            "UPDATE vehicles SET model = ?, brand = ?, categoryID = ?, price = ?, description = ?, image = ?, fuel = ?, seats = ?, doors = ?, features = ? 
             WHERE vehicleID = ?"
        );
        return $stmt->execute([$model, $brand, $categoryID, $price, $description, $image, $fuel, $seats, $doors, json_encode($features), $vehicleID]);
    }

    public function deleteVehicle($vehicleID) {
        $stmt = $this->db->prepare("DELETE FROM vehicles WHERE vehicleID = ?");
        return $stmt->execute([$vehicleID]);
    }

    public function getAllVehicles() {
        $stmt = $this->db->query("SELECT * FROM vehicles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVehiclesByCategory($categoryID) {
        $stmt = $this->db->prepare("SELECT * FROM vehicles WHERE categoryID = ?");
        $stmt->execute([$categoryID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}





