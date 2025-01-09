<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoHaven- Premium Car Rentals</title>
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
                    <a href="view_article.php" class="text-gray-700 font-bold  hover:text-blue-600 transition-colors">Blog</a>
                    <?php 
                    if (isset($_SESSION['name'])) {


                    ?>
                        <div class="text-blue-500 font-bold bg-transparent">
                            Welcome, 
                            <?php echo $_SESSION['name']; ?>
                    </div> 
                    <button class="text-red-500 font-bold bg-transparent px-4 py-2 border-solid border-2 border-red-500 hover:text-white rounded-full hover:bg-red-700 transition-all transform hover:scale-105 duration-200">
                            <a href="../Auth/logout.php">Logout</a>
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

    <div class="relative pt-16">
        <div class="min-h-screen flex items-center relative overflow-hidden">
            <img src="../img/car2.jpeg" alt="Luxury Car" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative max-w-7xl ml-8 mt-[-5rem] px-4 sm:px-6 lg:px-8 text-white py-32">
                <h1 class="text-5xl md:text-[6.5rem] font-bold mb-6">
                    Drive Your<br />
                    Dreams
                </h1>
                <p class="text-xl mb-8 max-w-2xl">
                    Experience luxury and comfort with our premium fleet of vehicles. Your perfect ride awaits.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="bg-blue-600 font-bold text-white px-8 py-3 rounded-full hover:bg-blue-700 transition-colors inline-flex items-center justify-center">
                        Rent Now
                    </button>
                    <button class="bg-white font-bold text-gray-900 px-8 py-3 rounded-full hover:bg-gray-100 transition-colors inline-flex items-center justify-center">
                        View Fleet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16">Featured Vehicles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <div class="relative group-hover:scale-105 transition-transform duration-300">
                        <img src="../img/tesla-m-s.jpeg" alt="Tesla Model S" class="w-full h-64 object-cover" />
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent">
                            <h3 class="text-white text-xl font-bold">Tesla Model S</h3>
                            <p class="text-white/80">From $199/day</p>
                        </div>
                    </div>
                    <div class="p-6 bg-white">
                        <p class="text-gray-600 mb-4">Luxury electric vehicle with autopilot capabilities and premium interior.</p>
                        <button class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                            Reserve Now →
                        </button>
                    </div>
                </div>

                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <div class="relative group-hover:scale-105 transition-transform duration-300">
                        <img src="../img/bmw-s.jpeg" alt="BMW 5 Series" class="w-full h-64 object-cover" />
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent">
                            <h3 class="text-white text-xl font-bold">BMW 5 Series</h3>
                            <p class="text-white/80">From $159/day</p>
                        </div>
                    </div>
                    <div class="p-6 bg-white">
                        <p class="text-gray-600 mb-4">Executive sedan combining comfort with outstanding performance.</p>
                        <button class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                            Reserve Now →
                        </button>
                    </div>
                </div>

                <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                    <div class="relative group-hover:scale-105 transition-transform duration-300">
                        <img src="../img/range-rover.jpeg" alt="Range Rover" class="w-full h-64 object-cover" />
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent">
                            <h3 class="text-white text-xl font-bold">Range Rover Sport</h3>
                            <p class="text-white/80">From $249/day</p>
                        </div>
                    </div>
                    <div class="p-6 bg-white">
                        <p class="text-gray-600 mb-4">Luxury SUV perfect for both city drives and adventures.</p>
                        <button class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                            Reserve Now →
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16">Why Choose AutoHaven</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                        <span class="text-2xl">💎</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Premium Fleet</h3>
                    <p class="text-gray-600">Luxury vehicles maintained to the highest standards.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                        <span class="text-2xl">⚡</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Instant Booking</h3>
                    <p class="text-gray-600">Quick and easy online reservation system.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="text-xl font-bold mb-4">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock customer service and roadside assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-20">
        <img src="../img/hit-the-road.jpeg" alt="Driving Scene" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Ready to Hit the Road?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of satisfied customers who trust us for their premium car rental needs.</p>
            <button class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition-colors">
                Book Your Car Now
            </button>
        </div>
    </section>

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