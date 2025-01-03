<?php 
session_start();

?>

    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AutoHaven | Our Fleet</title>
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
                    <a href="#" class="text-gray-700 font-bold  hover:text-blue-600 transition-colors">About</a>
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

        <div class="relative pt-16">
            <div class="h-[60vh] flex items-center relative overflow-hidden">
                <img src="../img/car2.jpeg" alt="Luxury Cars Fleet" class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6">
                        Choose Your<br/>
                        Perfect Ride
                    </h1>
                    <p class="text-xl mb-8 max-w-2xl">
                        Explore our extensive collection of premium vehicles for any occasion.
                    </p>
                </div>
            </div>
        </div>

        <!-- search -->
        <div class="max-w-7xl mx-auto px-4 -mt-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>All Vehicles</option>
                            <option>Luxury Sedans</option>
                            <option>SUVs</option>
                            <option>Sports Cars</option>
                            <option>Electric Vehicles</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pick-up Date</label>
                        <input type="date" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>1 Day</option>
                            <option>2-3 Days</option>
                            <option>4-7 Days</option>
                            <option>7+ Days</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">&nbsp;</label>
                        <button class="w-full bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 transition-colors">
                            Search Vehicles
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- categories -->
        <section class="py-16 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Browse by Category</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6" id="categories">
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow text-center cursor-pointer category-card" data-category="luxury">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚙</span>
                        </div>
                        <h3 class="font-bold">Luxury Sedans</h3>
                        <p class="text-gray-500 text-sm mt-2">12 vehicles</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow text-center cursor-pointer category-card" data-category="luxury">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚙</span>
                        </div>
                        <h3 class="font-bold">SUV's</h3>
                        <p class="text-gray-500 text-sm mt-2">12 vehicles</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow text-center cursor-pointer category-card" data-category="luxury">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚙</span>
                        </div>
                        <h3 class="font-bold">Sports</h3>
                        <p class="text-gray-500 text-sm mt-2">12 vehicles</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow text-center cursor-pointer category-card" data-category="luxury">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚙</span>
                        </div>
                        <h3 class="font-bold">Electrics</h3>
                        <p class="text-gray-500 text-sm mt-2">12 vehicles</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Available Cars -->
        <section class="py-16" id="cars-section">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Available Vehicles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="cars-grid">
                    
                        <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer">
                            <div class="relative">
                                <img src="../img/bmw-s.jpeg" alt="tomobil" 
                                    class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300" />
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-blue-600 font-semibold">DZ 10299/day</span>
                                </div>
                            </div>
                            <div class="p-6 bg-white">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">BMW 7</h3>
                                        <p class="text-gray-500">Luxury Sedans</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                    <span>🛢️ Mazot akhoya</span>
                                    <span>🪑 4 Seats</span>
                                    <span>🚪 4 Doors</span>
                                </div>
                                <p class="text-gray-600 mb-6">loto impermeaaable hbibi</p>
                                <button class="w-full bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                        <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer">
                            <div class="relative">
                                <img src="../img/bmw-s.jpeg" alt="tomobil" 
                                    class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300" />
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <span class="text-blue-600 font-semibold">DZ 10299/day</span>
                                </div>
                            </div>
                            <div class="p-6 bg-white">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">BMW 7</h3>
                                        <p class="text-gray-500">Luxury Sedans</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                    <span>🛢️ Mazot akhoya</span>
                                    <span>🪑 4 Seats</span>
                                    <span>🚪 4 Doors</span>
                                </div>
                                <p class="text-gray-600 mb-6">loto impermeaaable hbibi</p>
                                <button class="w-full bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                 </div>
            </div>
        </section>

        <!-- reviews -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">What Our Customers Say</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="../img/car1.jpeg" alt="Reviewer" class="w-12 h-12 rounded-full mr-4"/>
                            <div>
                                <h4 class="font-bold">Mahdi Rahhab</h4>
                                <div class="text-yellow-400">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "俺は進み続ける。この地獄のような道の先に何があろうとも"
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="../img/wissam.jpg" alt="Reviewer" class="w-12 h-12 rounded-full mr-4"/>
                            <div>
                                <h4 class="font-bold">Wissam Douskary</h4>
                                <div class="text-yellow-400">★</div>
                            </div>
                        </div>
                        <p class="text-gray-600">
                        "Amazing mountain biking experience! The guide was professional and the trails were perfect for all skill levels."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- car details -->
        <div id="car-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6" id="modal-content">

                </div>
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
        <script src="../JS/fleetCars.js"></script>
    </body>
    </html>