<?php
    require_once '.././classes/Database.class.php';

class Vehicle {
    private PDO $db;

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
        if ($image !== NULL) {
            $img  = ", image = :image";
        } else {
            $img = "";
        }
        $stmt = $this->db->prepare(
            "UPDATE vehicles SET model = :model, brand = :brand, categoryID = :categoryID, price = :price,  description = :description $img, fuel = :fuel, seats = :seats, doors = :doors, features = :features WHERE vehicleID = :vehicleID"
 );
        $stmt->bindParam(':vehicleID', $vehicleID);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        if($image !== NULL ) {
            $stmt->bindParam(':image', $image);
        }
        $stmt->bindParam(':fuel', $fuel);
        $stmt->bindParam(':seats', $seats);
        $stmt->bindParam(':doors', $doors);
        $stmt->bindParam(':features', $features);
        return $stmt->execute();
    }


    public function editVehicleAvailability($vehicleID, $availability) {
        $stmt = $this->db->prepare("UPDATE vehicles SET availability = :availability WHERE vehicleID = :vehicleID");
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':vehicleID', $vehicleID);
        return $stmt->execute();
    }


    public function deleteVehicle($vehicleID) {
        $stmt = $this->db->prepare("DELETE FROM vehicles WHERE vehicleID = :vehicleID");
        $stmt->bindParam(':vehicleID', $vehicleID);
        return $stmt->execute();
    }

    public function getAllVehicles() {
        $stmt = $this->db->query("SELECT * FROM vehicles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getVehicle($vehicleID) {
        $stmt = $this->db->query("SELECT * FROM vehicles WHERE vehicleID = $vehicleID");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getVehiclesByCategory($categoryID) {
        $stmt = $this->db->prepare("SELECT * FROM vehicles WHERE categoryID = ?");
        $stmt->execute([$categoryID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   // client methodes 
    public function getActiveVehicles($limit, $offset) {
        $stmt = $this->db->prepare("SELECT v.* FROM vehicles v INNER JOIN categories c ON v.categoryID = c.categoryID WHERE v.availability = 'ACTIVE' AND c.availability = 'ACTIVE' LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}





