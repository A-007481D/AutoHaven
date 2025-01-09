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
require_once '../classes/Comment.class.php';
require_once '../classes/Tag.class.php';
require_once '../classes/Theme.class.php';

$db = new Database();
$article = new Article($db->getConnection());
$comment = new Comment($db->getConnection());
$tag = new Tag($db->getConnection());
$theme = new Theme($db->getConnection());

if (!isset($_GET['articleID']) || empty($_GET['articleID'])) {
    echo "Invalid article ID.";
    exit;
}

$articleID = (int)$_GET['articleID'];

$articleData = $article->getArticleByID($articleID);
if (!$articleData) {
    echo "Article not found.";
    exit;
}

$author = $article->getAuthorBy($articleID);
$tags = $tag->getTagsBy($articleID);
$comments = $comment->getCommentsBy($articleID);
// print_r($comments); 


// var_dump($articleID);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoHaven | Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <nav class="fixed w-full bg-white/90 backdrop-blur-md shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-2">
                    <a href="../pages/index.php">
                        <span class="text-3xl font-bold text-blue-600"></span>
                        <span class="text-2xl font-bold text-blue-800">AutoHaven</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="../pages/index.php" class="text-gray-700 font-bold hover:text-blue-600 transition-colors">Home</a>
                    <a href="../pages/fleet.php" class="text-gray-700 font-bold hover:text-blue-600 transition-colors">Our Fleet</a>
                    <a href="../pages/testpage.php" class="text-gray-700 font-bold hover:text-blue-600 transition-colors">Blog</a>
                    <?php if (isset($_SESSION['name'])) { ?>
                        <div class="text-blue-500 font-bold bg-transparent">
                            Welcome, <?php echo $_SESSION['name']; ?>
                        </div>
                        <button class="text-red-500 font-bold bg-transparent px-4 py-2 border-solid border-2 border-red-500 hover:text-white rounded-full hover:bg-red-700 transition-all transform hover:scale-105 duration-200">
                            <a href="../Auth/logout.php">Logout</a>
                        </button>
                    <?php } else { ?>
                        <button class="text-blue-500 font-bold bg-transparent px-4 py-2 border-solid border-2 border-blue-500 hover:text-white rounded-full hover:bg-blue-700 transition-all transform hover:scale-105 duration-200">
                            <a href="../pages/login.php">Sign In</a>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white shadow-sm pt-10">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Car Enthusiast Blog</h1>
            <p class="text-gray-600">Discover the latest in automotive news and insights</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <article class="bg-white rounded-lg shadow mb-8">
            <img src="<?php echo htmlspecialchars($articleData['images'] ?? '../img/placeholder.jpg' ); ?>" alt="Blog header" class="w-full h-64 object-cover rounded-t-lg">
            <div class="p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="../img/677941e5d787b-bmw-s.jpeg" alt="<?php echo htmlspecialchars($articleData['first_name'] ?? 'Anonymous'); ?>" class="w-10 h-10 rounded-full">
                    <div>
                        <h4 class="font-medium">John Doe</h4>
                        <p class="text-gray-500 text-sm"><?php echo htmlspecialchars($articleData['created_at'] ?? 'No timestamp'); ?></p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($articleData['title'] ?? 'No Title'); ?></h2>
                <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($articleData['content'] ?? 'No content available'); ?></p>

                <div class="flex flex-wrap gap-2 mb-6">
                    <?php if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            echo '<span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">#' . htmlspecialchars($tag['tag_name'] ?? 'No Tags') . '</span>';
                        }
                    } else {
                        echo '<span class="text-gray-500 text-sm">No tags available.</span>';
                    } ?>
                </div>

                <div class="mt-6">
                    <h3 class="font-bold text-lg mb-4">Comments (<?php echo count($comments); ?>)</h3>
                    <div class="space-y-4">
                        <?php if (!empty($comments)) {
                            foreach ($comments as $comment) { ?>
                                <div class="flex space-x-3">
                                    <img src="../img/car2.jpeg" alt="Commenter" class="w-8 h-8 rounded-full">
                                    <div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <h4 class="font-medium"><?php echo htmlspecialchars($comment['first_name'] ?? 'Anonymous'); ?></h4>
                                            <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($comment['comment'] ?? 'Unavailable comment!'); ?></p>
                                        </div>
                                        <span class="text-xs text-gray-500"><?php echo htmlspecialchars($comment['created_at'] ?? 'Unknown'); ?></span>
                                    </div>
                                </div>
                        <?php }
                        } else {
                            echo '<p class="text-gray-500 text-sm">No comments yet.</p>';
                        } ?>
                    </div>

                    <form method="POST" action="../processes/clientProcesses/add_comment.php" class="mt-6">
                        <textarea rows="3" placeholder="Write a comment..." class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Post Comment</button>
                    </form>
                </div>
            </div>
        </article>

        <div class="mt-8 flex justify-center">
            <nav class="flex space-x-2">
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Previous</button>
                <button class="px-4 py-2 border rounded-lg bg-blue-600 text-white">1</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">3</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Next</button>
            </nav>
        </div>
    </div>
</body>

</html>
