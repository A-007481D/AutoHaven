<?php 
require_once '../classes/Category.class.php';
require_once '../classes/Vehicle.class.php';

$db = new Database();
$dbcon = $db->getConnection();
$categoryManager = new Category($dbcon);
$vehicleManager = new Vehicle($dbcon);
$categories = $categoryManager->getAllCategories();
$vehicles = $vehicleManager->getAllVehicles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories and Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Manage Categories and Vehicles</h1>

        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Categories</h2>
            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openModal('addCategoryModal')">Add Category</button>

            <table class="table-auto w-full mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2"><?= $category['categoryID'] ?></td>
                            <td class="px-4 py-2"><?= $category['catName'] ?></td>
                            <td class="px-4 py-2">
                                <button class="text-blue-500" onclick="editCategory(<?= $category['categoryID'] ?>, '<?= $category['catName'] ?>')">Edit</button>
                                <button class="text-red-500" onclick="deleteCategory(<?= $category['categoryID'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Vehicles Section -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Vehicles</h2>
            <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="openModal('addVehicleModal')">Add Vehicle</button>

            <table class="table-auto w-full mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Model</th>
                        <th class="px-4 py-2">Brand</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2"><?= $vehicle['vehicleID'] ?></td>
                            <td class="px-4 py-2"><?= $vehicle['model'] ?></td>
                            <td class="px-4 py-2"><?= $vehicle['brand'] ?></td>
                            <td class="px-4 py-2">
                                <?= $vehicle['categoryID'] ? $categories[array_search($vehicle['categoryID'], array_column($categories, 'categoryID'))]['catName'] : 'Uncategorized' ?>
                            </td>
                            <td class="px-4 py-2">$<?= $vehicle['price'] ?></td>
                            <td class="px-4 py-2">
                                <button class="text-blue-500" onclick="editVehicle(<?= $vehicle['vehicleID'] ?>)">Edit</button>
                                <button class="text-red-500" onclick="deleteVehicle(<?= $vehicle['vehicleID'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Modals -->
        <div id="addCategoryModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded">
                <h3 class="text-xl font-bold mb-4">Add Category</h3>
                <form action="add_category.php" method="POST">
                    <input type="text" name="catName" placeholder="Category Name" class="border p-2 w-full mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('addCategoryModal')">Cancel</button>
                </form>
            </div>
        </div>

        <div id="addVehicleModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded">
                <h3 class="text-xl font-bold mb-4">Add Vehicle</h3>
                <form action="add_vehicle.php" method="POST">
                    <input type="text" name="model" placeholder="Model" class="border p-2 w-full mb-4">
                    <input type="text" name="brand" placeholder="Brand" class="border p-2 w-full mb-4">
                    <select name="categoryID" class="border p-2 w-full mb-4">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['categoryID'] ?>"><?= $category['catName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" step="0.01" name="price" placeholder="Price" class="border p-2 w-full mb-4">
                    <textarea name="description" placeholder="Description" class="border p-2 w-full mb-4"></textarea>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Submit</button>
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('addVehicleModal')">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</body>
</html>
