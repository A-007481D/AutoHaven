<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../classes/Database.class.php';
require_once '../classes/Category.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

$db = new Database();
$category = new  Category($db->getConnection());

$categories = $category->getAllCategories();
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
                        <span class="mr-3">🏠</span>
                        Home
                    </a>
                    <a href="../pages/reservationsDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📋</span>
                        Reservations
                    </a>
                    <a href="../pages/vehiclesDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">🚗</span>
                        Vehicles
                    </a>
                    <a href="../pages/categoriesDash.php" class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📁</span>
                        Categories
                    </a>
                    <a href="../pages/adminDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">👥</span>
                        Manage Users
                    </a>
                    <a href="../pages/reviewsDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">💬</span>
                        Reviews
                    </a>
                    <a href="../pages/blogDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📝</span> Blogs
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- <a href="add_vehicle.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                Add Vehicle
                            </a> -->

                            <form action="../processes/add_category.php" method="POST" class="space-y-4">
                                <label for="categoryName" class="block text-sm font-medium text-gray-700">Add New Category</label>
                                <input type="text" name="categoryName" id="categoryName" class="block w-full p-3 text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50" placeholder="Enter category name" required />
                                <button type="submit" class="w-full py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md transition">
                                    Add Category
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-700">Categories</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left p-4 border-b">Category ID</th>
                                    <th class="text-left p-4 border-b">category name </th>
                                    <th class="text-left p-4 border-b">availability</th>
                                    <th class="text-left p-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($categories as $category) { ?>
                                    <tr>
                                        <td class="p-4 border-b"><?php echo $category['categoryID']; ?></td>
                                        <td class="p-4 border-b">
                                            <form action="../processes/edit_category.php" method="POST">
                                                <div class="relative space-y-2">
                                                    <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>">
                                                    <input type="hidden" name="type" value="categoryName">
                                                    <input readonly name="categoryName" value="<?php echo $category['catName']; ?>" type="text" id="catName<?php echo $category['categoryID']; ?>" class="block w-full p-3 text-sm text-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50" placeholder="Enter category name" required />
                                                    <button type="submit" id="btn-<?php echo $category['categoryID']; ?>" style="display:none;" class="absolute top-1/2 -translate-y-1/2 right-2 text-white bg-green-600 hover:bg-green-700 rounded-lg py-1 px-3 shadow-md transition">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>


                                        </td>

                                        <td class="p-4 border-b"><?php echo $category['availability']; ?></td>
                                        <td class="p-4 border-b">
                                            <button type="button" onclick="editCatName(<?php echo $category['categoryID']; ?>)" class="text-white hover:text-white bg-green-500 rounded-md p-1">Edit</button>

                                            <?php if ($category['availability'] === 'INACTIVE') { ?>
                                                <form method="POST" action="../processes/edit_category.php">
                                                    <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>">
                                                    <input type="hidden" name="availability" value="ACTIVE">
                                                    <input type="hidden" name="type" value="availability">
                                                    <button type="submit" class="text-white hover:text-white bg-green-500 rounded-md p-1">Activate</button>
                                                </form>
                                            <?php } ?>
                                            <?php if ($category['availability'] === 'ACTIVE') { ?>
                                                <form method="POST" action="../processes/edit_category.php">
                                                    <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>">
                                                    <input type="hidden" name="availability" value="INACTIVE">
                                                    <input type="hidden" name="type" value="availability">
                                                    <button type="submit" class="text-white bg-red-500 rounded-md p-1.5">Deactivate</button>
                                                </form>
                                            <?php } ?>
                                            <form method="POST" action="../processes/delete_category.php" onsubmit="return confirmDelete()">
                                                <input type="hidden" name="categoryID" value="<?php echo $category['categoryID']; ?>">
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
    </div>
    </main>
    </div>
    <script src="../JS/editCategory.js"></script>
</body>

</html>