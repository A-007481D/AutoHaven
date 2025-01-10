    <<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../pages/login.php");
        exit;
    }

    require_once '../classes/Database.class.php';
    require_once '../classes/Article.class.php';
    require_once '../classes/Theme.class.php';
    require_once '../classes/Tag.class.php';

    $db = new Database();
    $article = new Article($db->getConnection());
    $theme = new Theme($db->getConnection());
    $tag = new Tag($db->getConnection());

    $articlesPerPage = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $totalArticles = $article->getTotalArticles();
    $totalPages = ceil($totalArticles / $articlesPerPage);
    $offset = ($page - 1) * $articlesPerPage;
    $paginatedArticles = $article->getAllArticles($articlesPerPage, $offset);

    $themes = $theme->getAllThemes();

    $tags = $tag->getAllTags();

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
                    <a href="../pages/articlesDash.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
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
                    <a href="../pages/blogDash.php" class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg transition-colors">
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
                            <button onclick="document.getElementById('addArticleModal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <span class="mr-2">+</span> Add Article
                            </button>
                            <button onclick="document.getElementById('addThemeModal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <span class="mr-2">+</span> Add Theme
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-medium text-gray-700">Articles</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                            <tr class="bg-gray-50">
                                <th class="p-4">ID</th>
                                <th class="p-4">Title</th>
                                <th class="p-4">Content</th>
                                <th class="p-4">Tags</th>
                                <th class="p-4">UserID</th>
                                <th class="p-4">Theme</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Created At</th>
                                <th class="p-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all as $article) { ?>
                                <tr class="border-b">
                                    <td class="p-4"><?php echo $article['articleID']; ?></td>
                                    <td class="p-4"><?php echo $article['title']; ?></td>
                                    <td class="p-4"><?php echo $article['content']; ?></td>
                                    <td class="p-4"><?php echo $article['tags']; ?></td>
                                    <td class="p-4"><?php echo $article['userID']; ?></td>
                                    <td class="p-4"><?php echo $article['theme']; ?></td>
                                    <td class="p-4"><?php echo $article['created_at']; ?></td>
                                    <td class="p-4"><?php echo $article['status']; ?></td>
                                    <td class="flex p-4 space-x-2">
                                        <button type="button" onclick="editArticle(<?php echo $article['articleID'] ?>)" class="px-2 py-1 bg-blue-500 text-white rounded-lg text-sm">Edit</button>
                                        <?php if ($article['availability'] === 'INACTIVE') { ?>
                                            <form method="POST" action="../processes/edit_article.php">
                                                <input type="hidden" name="articleID" value="<?php echo $article['articleID']; ?>">
                                                <input type="hidden" name="availability" value="ACTIVE">
                                                <input type="hidden" name="type" value="availability">
                                                <button type="submit" class="text-white hover:text-white bg-green-500 rounded-md p-1">Activate</button>
                                            </form>
                                        <?php } ?>
                                        <?php if ($article['availability'] === 'ACTIVE') { ?>
                                            <form method="POST" action="../processes/edit_article.php">
                                                <input type="hidden" name="articleID" value="<?php echo $article['articleID']; ?>">
                                                <input type="hidden" name="availability" value="INACTIVE">
                                                <input type="hidden" name="type" value="availability">
                                                <button type="submit" class="text-white bg-red-500 rounded-md p-1.5">Deactivate</button>
                                            </form>
                                        <?php } ?>
                                        <form method="POST" action="../processes/delete_article.php">
                                            <input type="hidden" name="articleID" value="<?php echo $article['articleID']; ?>">
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

    <div id="addArticleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Add New Article</h3>
                <button onclick="document.getElementById('addArticleModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>
            <form method="POST" action="../processes/add_article.php" class="space-y-6" enctype="multipart/form-data">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Article Title</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Article Title" required>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="content" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Write a description..." required></textarea>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" required>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Theme</label>
                    <select name="themeID" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" required>
                        <option value="" disabled selected>Select a theme</option>
                        <?php foreach ($themes as $theme): ?>
                            <option value="<?= htmlspecialchars($theme['themeID']) ?>">
                                <?= htmlspecialchars($theme['theme_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Tags</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        <?php foreach ($tags as $tag): ?>
                            <div>
                                <input type="checkbox" name="tags[]" value="<?= htmlspecialchars($tag['tagID']) ?>" id="tag_<?= htmlspecialchars($tag['tagID']) ?>">
                                <label for="tag_<?= htmlspecialchars($tag['tagID']) ?>" class="text-sm text-gray-700">
                                    <?= htmlspecialchars($tag['tag_name']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('addArticleModal').classList.add('hidden')" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-[#2b62e3] hover:bg-blue-600 rounded-lg transition-colors duration-200">Save Article</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editArticleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Edit Article</h3>
                <button onclick="document.getElementById('editArticleModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>
            <form method="POST" action="../processes/edit_article.php" class="space-y-6" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input type="hidden" name="articleID" id="articleID">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Article Brand</label>
                        <input id="brand" type="text" name="brand" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Article brand" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Article Model</label>
                        <input id="model" type="text" name="model" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Enter Article model" required>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Article Image</label>
                        <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2b62e3] focus:border-[#2b62e3] transition-colors duration-200" placeholder="Describe the Article..." required></textarea>
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
                    <button type="button" onclick="document.getElementById('editArticleModal').classList.add('hidden')" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-[#2b62e3] hover:bg-blue-600 rounded-lg transition-colors duration-200">Save Article</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../JS/getArticle.js"></script>
    </body>

    </html>