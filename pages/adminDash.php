<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/Database.class.php';
require_once '../classes/Person.class.php';
require_once '../classes/Client.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/fleet.php");
    exit;
}

$db = new Database();
$dbcon = $db->getConnection();
$client = new  Client($dbcon); 

$recentClients = $client->getRecentClients();
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
                    <a href="../pages/eservationsDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📋</span>
                        Reservations
                    </a>
                    <a href="../pages/vehiclesDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">🚗</span>
                        Vehicles
                    </a>
                    <a href="../pages/categoryDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <span class="mr-3">📁</span>
                        Categories
                    </a>
                    <a href="../pages/adminDash.php" class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg transition-colors">
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
                            <a href="add_vehicle.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                Add Vehicle
                            </a>
                            <a href="add_category.php" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
                                Add Category
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-700">Recent Users</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left p-4 border-b">User ID</th>
                                    <th class="text-left p-4 border-b">First Name</th>
                                    <th class="text-left p-4 border-b">Last Name</th>
                                    <th class="text-left p-4 border-b">Email</th>
                                    <th class="text-left p-4 border-b">Role</th>
                                    <th class="text-left p-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $recentClients = $client->getRecentClients(); 
                                    foreach ($recentClients as $client) { ?>
                                        <tr>
                                            <td class="p-4 border-b"><?php echo $client['userID']; ?></td>
                                            <td class="p-4 border-b"><?php echo $client['first_name']; ?></td>
                                            <td class="p-4 border-b"><?php echo $client['last_name']; ?></td>
                                            <td class="p-4 border-b"><?php echo $client['email']; ?></td>
                                            <td class="p-4 border-b"><?php echo $client['role']; ?></td>
                                            <td class="p-4 border-b">
                                                <?php if ($client['role'] === 'client') { ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="userID" value="<?php echo $client['userID']; ?>"> 
                                                        <button type="submit" class="text-white hover:text-white bg-green-500 rounded-md p-1">Promote</button>
                                                    </form>
                                                <?php } ?>
                                                <?php if ($client['role'] === 'admin') { ?>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="userID" value="<?php echo $client['userID']; ?>"> 
                                                        <button type="submit" class="text-white bg-red-500 rounded-md p-1.5">Demote</button>
                                                    </form>
                                                <?php } ?>
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
</body>
</html>
