CREATE DATABASE autohaven;
use autohaven;

CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    role ENUM('client', 'admin') DEFAULT 'client', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY,
    catName VARCHAR(255) UNIQUE NOT NULL
);


CREATE TABLE vehicles (
    vehicleID INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    categoryID INT, 
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    fuel VARCHAR(255),
    seats INT,
    doors INT,
    features JSON,
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
);

CREATE TABLE reservations (
    reservationID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT,
    vehicleID INT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    pickup_location VARCHAR(255),
    return_location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (vehicleID) REFERENCES vehicles(vehicleID)
);

CREATE TABLE reviews (
    reviewID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT,
    vehicleID INT,
    rating INT, 
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (vehicleID) REFERENCES vehicles(vehicleID)
);