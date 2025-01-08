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

    -- V2 Queries 

    CREATE TABLE themes (
        themeID INT AUTO_INCREMENT PRIMARY KEY,
        theme_name VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE articles (
        articleID INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        tags TEXT,
        images VARCHAR(255),
        userID INT NOT NULL,
        themeID INT NOT NULL,
        status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
        FOREIGN KEY (themeID) REFERENCES themes(themeID) ON DELETE CASCADE
    );

    CREATE TABLE comments (
        commentID INT AUTO_INCREMENT PRIMARY KEY,
        comment TEXT NOT NULL,
        userID INT NOT NULL,
        articleID INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
        FOREIGN KEY (articleID) REFERENCES articles(articleID) ON DELETE CASCADE
    );

    CREATE TABLE tags (
        tagID INT AUTO_INCREMENT PRIMARY KEY,
        tag_name VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE article_tag (
        articleID INT NOT NULL,
        tagID INT NOT NULL,
        FOREIGN KEY (articleID) REFERENCES articles(articleID) ON DELETE CASCADE,
        FOREIGN KEY (tagID) REFERENCES tags(tagID) ON DELETE CASCADE,
        PRIMARY KEY (articleID, tagID)
    );

    CREATE TABLE favorites (
        id INT AUTO_INCREMENT PRIMARY KEY,
        userID INT NOT NULL,
        articleID INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
        FOREIGN KEY (articleID) REFERENCES articles(articleID) ON DELETE CASCADE
    );
