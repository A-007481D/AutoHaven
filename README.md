# AutoHaven: Car Rental Management System

## Project Overview
AutoHaven agency aims to enhance its website by introducing a car rental management system. This platform is creative and functional, allowing clients to browse and book vehicles according to their needs.

### Project Goals
- Develop a car rental module using PHP OOP and SQL.
- Create an engaging user experience for clients to explore and book vehicles.
- Provide administrative functionalities for efficient system management.

## User Stories

### Client Features
1. 🚗 **Authentication**: As a client, I must log in to access the rental platform.
2. 🏍️ **Explore Vehicles**: As a client, I can browse various vehicle categories.
3. 🚗 **View Vehicle Details**: As a client, I can click on a vehicle to see its details (model, price, availability, etc.).
4. 🛣️ **Make Reservations**: As a client, I can book a vehicle by specifying pickup dates and locations.
5. 🔎 **Search for Vehicles**: As a client, I can search for a specific vehicle by its model or features.
6. 🏍️ **Filter Vehicles**: As a client, I can filter available vehicles by category without refreshing the page.
7. 📝 **Add Reviews**: As a client, I can leave a review or rating for a vehicle I have rented.
9. 🚙 **Modify Reviews**: As a client, I can edit or soft-delete my reviews.

### Admin Features
1. 🏦 **Mass Insertion**: As an admin, I can add multiple vehicles or categories simultaneously.
2. 🚨 **Dashboard Management**: As an admin, I can manage reservations, vehicles, reviews, categories, and view system statistics.

#### Blog Features
1. 🛣️ **Explore Blog Themes**: As a client, I can browse various blog themes.
2. 🚗 **View Articles**: As a client, I can click on a theme to view associated articles.
3. ✍️ **Create Articles**: As a client, I can submit articles with a title, content, tags, and optional images/videos.
4. 🔍 **Search Articles**: As a client, I can search for an article by its title.
5. 🏷️ **Filter Articles**: As a client, I can filter articles by tags.
6. 💬 **Comments**:
    - View comments on articles.
    - Add, edit, or delete my comments.
7. ❤️ **Favorites**: As a client, I can add articles to my favorites.

#### Admin Blog Features
1. 🛠️ **Manage Content**: As an admin, I can manage themes, articles, tags, and comments through a dashboard.
2. 🏷️ **Mass Tag Insertion**: As an admin, I can add multiple tags at once.
3. ✅ **Approve Articles**: As an admin, I can approve client-submitted articles before publication.

## Backend Development Features
1. **SQL View for Vehicles**: Create a SQL view `ListeVehicules` that combines essential details for displaying vehicle lists, including category details, associated reviews, and availability.
2. **Stored Procedure for Reservations**: Develop a stored procedure `AjouterReservation` to handle reservation creation with the required parameters.

## Technologies
- **Backend**: PHP OOP
- **Database**: MySQL
- **Frontend**: HTML, TAILWIND CSS, JavaScript.

## Deployment
- **Server**: Nginx on Ubuntu

## Installation Instructions
1. Clone the repository.
2. Set up the MySQL database and import the provided schema.
3. Configure the PHP environment and ensure Composer is installed.
4. Deploy the application on an Nginx server.
5. Start exploring the platform.
