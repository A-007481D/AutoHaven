<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
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
    <title>Blog Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
 
<nav class="fixed w-full bg-white/90 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="../pages/index.php" class="text-2xl font-bold text-blue-800">AutoHaven</a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="../pages/index.php" class="text-gray-700 font-bold hover:text-blue-600">Home</a>
                <a href="../pages/fleet.php" class="text-gray-700 font-bold hover:text-blue-600">Our Fleet</a>
                <a href="view_article.php" class="text-gray-700 font-bold hover:text-blue-600">Blog</a>
                <?php if (isset($_SESSION['name'])): ?>
                    <div class="text-blue-500 font-bold">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></div>
                    <a href="../Auth/logout.php" class="text-red-500 font-bold border-2 border-red-500 px-4 py-2 rounded-full hover:bg-red-700 hover:text-white transition">Logout</a>
                <?php else: ?>
                    <a href="../pages/login.php" class="text-blue-500 font-bold border-2 border-blue-500 px-4 py-2 rounded-full hover:bg-blue-700 hover:text-white transition">Sign In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>


<header class="bg-blue-100 pt-20">
    <div class="max-w-7xl mx-auto px-4 py-5">
        <h1 class="text-4xl font-bold text-gray-900">Welcome to the Blog</h1>
        <p class="mt-2 text-gray-600">Your daily dose of articles and insights</p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Latest Posts</h2>
        <button onclick="document.getElementById('addArticleModal').classList.remove('hidden')"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
            <span class="mr-2">+</span>Add Article
        </button>
    </div>


    <div class="flex flex-col md:flex-row md:justify-between items-center mb-6 space-y-4 md:space-y-0">
        <div class="flex items-center space-x-2">
            <label for="themeFilter" class="text-gray-700 font-bold">Filter by:</label>
            <select id="themeFilter" class="px-4 py-2 bg-white border rounded-lg">
                <option value="all">All Themes</option>
                <?php foreach($themes as $theme) {
                    ?>
                    <option value="<?= $theme['themeID'] ?>"><?= $theme['theme_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <input type="text" placeholder="Search articles..." class="px-4 py-2 bg-white border rounded-lg flex-grow">
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($paginatedArticles as $article): ?>
            <article class="bg-white rounded-lg shadow overflow-hidden cursor-pointer">
                <img src="../img/<?= htmlspecialchars($article['images'] ?? '../img/1.jpg') ?>"
                     alt="<?= htmlspecialchars($article['title'] ?? 'No Title') ?>"
                     class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($article['title']) ?></h3>
                    <p class="text-gray-600 mt-2"><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
                    <div class="mt-4 flex justify-between items-center">
                        <a href="view_article.php?articleID=<?= $article['articleID'] ?>" class="text-blue-600 hover:underline">Read More</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>


    <div class="mt-8 flex justify-center">
        <nav class="flex space-x-2">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 border rounded-lg <?= $i === $page ? 'bg-blue-600 text-white' : 'hover:bg-gray-50' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Next</a>
            <?php endif; ?>
        </nav>
    </div>
</main>


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



<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center space-x-2 mb-4">
                <span class="text-3xl"></span>
                <span class="text-2xl font-bold">AutoHaven</span>
            </div>
            <p class="text-gray-400">Your premium car rental service</p>
        </div>
        <div>
            <h4 class="font-bold mb-4">Quick Links</h4>
            <ul class="space-y-2 text-gray-400">
                <li><a href="#" class="hover:text-white transition-colors">Our Fleet</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Rental Terms</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Locations</a></li>
                <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-4">Contact Us</h4>
            <ul class="space-y-2 text-gray-400">
                <li>123 Auto Boulevard</li>
                <li>New York, NY 10001</li>
                <li>Phone: (555) 123-4567</li>
                <li>Email: info@AutoHaven.com</li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-4">Newsletter</h4>
            <p class="text-gray-400 mb-4">Subscribe for special offers and updates</p>
            <div class="flex gap-2">
                <input type="email" placeholder="Your email" class="px-4 py-2 rounded-full bg-gray-800 text-white flex-grow">
                <button class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
