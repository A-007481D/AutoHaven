<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUtoHaven | Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<nav class="fixed w-full bg-white/90 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-2">
                <a href="../pages/index.php"><span class="text-3xl font-bold text-blue-600"></span>
                    <span class="text-2xl font-bold text-blue-800">AutoHaven</span></a>

            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="../pages/index.php" class="text-gray-700 font-bold  hover:text-blue-600 transition-colors">Home</a>
                <a href="../pages/fleet.php" class="text-gray-700 font-bold  hover:text-blue-600 transition-colors">Our Fleet</a>
                <a href="../pages/blog.php" class="text-gray-700 font-bold  hover:text-blue-600 transition-colors">Blog</a>
                <?php
                if (isset($_SESSION['name'])) {


                    ?>
                    <div class="text-blue-500 font-bold bg-transparent">
                        Welcome,
                        <?php echo $_SESSION['name']; ?>
                    </div>
                    <button class="text-blue-500 font-bold bg-transparent px-4 py-2 border-solid border-2 border-blue-500 hover:text-white rounded-full hover:bg-blue-700 transition-all transform hover:scale-105 duration-200">
                        <a href="../Auth/logout.php" class="">Logout</a>
                    </button>
                <?php } else {

                    ?>
                    <button class="text-blue-500 font-bold bg-transparent px-4 py-2 border-solid border-2 border-blue-500 hover:text-white rounded-full hover:bg-blue-700 transition-all transform hover:scale-105 duration-200">
                        <a href="../pages/login.php" class="">Sign In</a>
                    </button>
                <?php } ?>

            </div>
        </div>
    </div>
</nav>

<div class="bg-white shadow-sm pt-10">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Car Enthusiast Blog</h1>
                <p class="mt-2 text-gray-600">Discover the latest in automotive news and insights</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Search blogs..."
                           class="w-full md:w-64 pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Categories</h3>
                <div class="space-y-2">
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-50 text-blue-600">All Posts</button>
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-50">Car Reviews</button>
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-50">Maintenance Tips</button>
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-50">Industry News</button>
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-blue-50">Travel Stories</button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-lg mb-4">My Favorites</h3>
                <div class="space-y-4">

                    <!-- favorites section -->
                    <div class="flex items-start space-x-3">
                        <img src="../img/6778713872a63-image.webp" alt="Blog thumbnail" class="w-16 h-16 rounded object-cover">
                        <div>
                            <h4 class="font-medium text-sm">Top 10 Electric Cars in 2024</h4>
                            <p class="text-gray-500 text-sm">March 15, 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">

            <div class="grid gap-8">

                <article class="bg-white rounded-lg shadow">
                    <img src="../img/67787201c7472-image.webp" alt="Blog header" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="../img/677941e5d787b-bmw-s.jpeg" alt="Author" class="w-10 h-10 rounded-full">
                            <div>
                                <h4 class="font-medium">John Doe</h4>
                                <p class="text-gray-500 text-sm">March 20, 2024</p>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold mb-4">The Future of Autonomous Driving</h2>
                        <p class="text-gray-600 mb-4">Preview text of the blog post goes here...</p>

                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">#Technology</span>
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">#Innovation</span>
                            </div>
                            <button class="text-gray-500 hover:text-red-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <h3 class="font-bold mb-4">Comments (3)</h3>
                            <div class="space-y-4">
                                <div class="flex space-x-3">
                                    <img src="../img/car2.jpeg" alt="Commenter" class="w-8 h-8 rounded-full">
                                    <div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <h4 class="font-medium">Sarah Smith</h4>
                                            <p class="text-gray-600 text-sm">Great article! Very informative.</p>
                                        </div>
                                        <div class="flex items-center mt-1 space-x-4">
                                            <span class="text-xs text-gray-500">2 hours ago</span>
                                            <button class="text-sm text-gray-500 hover:text-blue-600">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="mt-6">
                                    <textarea rows="3" placeholder="Write a comment..."
                                              class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                                <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

            </div>

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
    </div>
</div>
</body>
</html>