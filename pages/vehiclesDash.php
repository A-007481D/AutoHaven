<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/Database.class.php';
require_once '../classes/Vehicle.class.php';
require_once '../classes/Category.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/fleet.php");
    exit;
}

$db = new Database();
$dbcon = $db->getConnection();
$vehicle = new Vehicle($dbcon);
$category = new Category($dbcon);
$allVehicles = $vehicle->getAllVehicles();
$allCategories = $category->getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoHaven - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <a href="../../index.php" class="text-2xl font-bold text-blue-600">AutoHaven</a>
            </div>
            <nav class="mt-6 px-6">
                <div class="space-y-4">
                    <a href="../index.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">🏠</span> Home
                    </a>
                    <a href="../pages/reservationsDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📋</span> Reservations
                    </a>
                    <a href="../pages/vehiclesDash.php" class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">🚗</span> Vehicles
                    </a>
                    <a href="../pages/categoryDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📁</span> Categories
                    </a>
                    <a href="../pages/adminDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">👥</span> Manage Users
                    </a>
                    <a href="../pages/reviewsDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">💬</span> Reviews
                    </a>
                </div>
            </nav>
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200">
                <form method="POST" action="../Auth/logout.php">
            <button class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">AutoHaven Admin Dashboard</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-lg font-medium text-gray-700">Manage</h2>
                        <button onclick="document.getElementById('addVehicleModal').classList.remove('hidden')"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                            <span class="mr-2">+</span> Add Vehicle
                        </button>

                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-medium text-gray-700">Vehicles List</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="p-4">ID</th>
                                    <th class="p-4">Brand</th>
                                    <th class="p-4">Model</th>
                                    <th class="p-4">Price</th>
                                    <th class="p-4">Fuel</th>
                                    <th class="p-4">Seats</th>
                                    <th class="p-4">Doors</th>
                                    <th class="p-4">Features</th>
                                    <th class="p-4">Availability</th>
                                    <th class="p-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allVehicles as $vehicle) { ?>
                                    <tr class="border-b">
                                        <td class="p-4"><?php echo $vehicle['vehicleID']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['brand']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['model']; ?></td>
                                        <td class="p-4"><?php echo '$' . $vehicle['price']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['fuel']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['seats']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['doors']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['features']; ?></td>
                                        <td class="p-4"><?php echo $vehicle['availability']; ?></td>
                                        <td class="p-4 space-x-2">
                                            <button type="button" onclick="editVehicle(<?php echo $vehicle['vehicleID'] ?>)" class="px-2 py-1 bg-blue-500 text-white rounded-lg text-sm">Edit</button>
                                            <?php if ($vehicle['availability'] === 'INACTIVE') { ?>
                                                <form method="POST" action="../processes/edit_vehicle.php">
                                                    <input type="hidden" name="vehicleID" value="<?php echo $vehicle['vehicleID']; ?>">
                                                    <input type="hidden" name="availability" value="ACTIVE">
                                                    <input type="hidden" name="type" value="availability">
                                                    <button type="submit" class="text-white hover:text-white bg-green-500 rounded-md p-1">Activate</button>
                                                </form>
                                            <?php } ?>
                                            <?php if ($vehicle['availability'] === 'ACTIVE') { ?>
                                                <form method="POST" action="../processes/edit_vehicle.php">
                                                    <input type="hidden" name="vehicleID" value="<?php echo $vehicle['vehicleID']; ?>">
                                                    <input type="hidden" name="availability" value="INACTIVE">
                                                    <input type="hidden" name="type" value="availability">
                                                    <button type="submit" class="text-white bg-red-500 rounded-md p-1.5">Deactivate</button>
                                                </form>
                                            <?php } ?>
                                            <form method="POST" action="../processes/delete_vehicle.php">
                                                    <input type="hidden" name="vehicleID" value="<?php echo $vehicle['vehicleID']; ?>">
                                                    <button type="submit" class="text-white hover:text-white bg-red-500 rounded-md p-1">Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

    <div id="addVehicleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Add New Vehicle</h3>
                <button onclick="document.getElementById('addVehicleModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>
            <form method="POST" action="../processes/add_vehicle.php" class="space-y-6" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Brand</label>
                        <input type="text" name="brand" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Vehicle brand" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Model</label>
                        <input type="text" name="model" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Vehicle model" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">$</span>
                            </div>
                            <input type="number" name="price" class="w-full pl-8 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="0.00" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="categoryID" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" required>
                            <option value="" disabled selected>Select a category</option>
                                    <?php foreach($allCategories as $category) {
                                     ?> 
                                     <option value="<?= $category['categoryID'] ?>"><?= $category['catName'] ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Image</label>
                        <input type="file" name="image" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Describe the Vehicle..." required></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fuel Type</label>
                        <input type="text" name="fuel" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="e.g., Gasoline, Diesel" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seats</label>
                        <input type="number" name="seats" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" min="1" placeholder="Number of seats" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Doors</label>
                        <input type="number" name="doors" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" min="1" placeholder="Number of doors" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
                    <input type="text" name="features" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Comma-separated features (e.g., Bluetooth, GPS, AC)">
                </div>
                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('addVehicleModal').classList.add('hidden')" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-[#2b62e3] hover:bg-blue-600 rounded-lg transition-colors duration-200">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editVehicleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Edit Vehicle</h3>
                <button onclick="document.getElementById('editVehicleModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>
            <form method="POST" action="../processes/edit_vehicle.php" class="space-y-6" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input type="hidden" name="vehicleID" id="vehicleID">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Brand</label>
                        <input id="brand" type="text" name="brand" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Vehicle brand" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Model</label>
                        <input id="model" type="text" name="model" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Vehicle model" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">$</span>
                            </div>
                            <input id="price" type="number" name="price" class="w-full pl-8 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="0.00" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="categoryID" name="categoryID" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" required>
                            <option value="" disabled selected>Select a category</option>
                                    <?php foreach($allCategories as $category) {
                                     ?> 
                                     <option value="<?= $category['categoryID'] ?>"><?= $category['catName'] ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Image</label>
                        <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Describe the Vehicle..." required></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fuel Type</label>
                        <input id="fuel" type="text" name="fuel" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="e.g., Gasoline, Diesel" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seats</label>
                        <input id="seats" type="number" name="seats" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" min="1" placeholder="Number of seats" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Doors</label>
                        <input id="doors" type="number" name="doors" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" min="1" placeholder="Number of doors" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
                    <input id="features" type="text" name="features" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Comma-separated features (e.g., Bluetooth, GPS, AC)">
                </div>
                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('editVehicleModal').classList.add('hidden')" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-[#2b62e3] hover:bg-blue-600 rounded-lg transition-colors duration-200">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>

<script src="../JS/getVehicle.js"></script>
</body>

</html>