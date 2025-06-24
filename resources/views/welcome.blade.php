<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoEase.com</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/styles.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="bg-black py-3">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="logo">
                <h1 class="text-white abril-fatface-regular">AutoEase.com</h1>
            </div>
            <nav>
                <ul class="flex items-center space-x-6">
                    <li><a href="{{ url('/') }}" class="text-white hover:text-gray-300">Home</a></li>
                    <li><a href="#about-section" class="text-white hover:text-gray-300">About Us</a></li>
                    <li><a href="#contact-section" class="text-white hover:text-gray-300">Contact</a></li>
                    <li><a href="{{ route('admin.login') }}"><button id="loginBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Admin Login</button></a></li>
                    <li><a href="{{ route('login') }}"><button id="loginBtn2" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">User Login</button></a></li>
                    <li><a href="{{ route('register') }}"><button id="RegisterBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Register</button></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero relative min-h-[500px] bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}')">
        <div class="container mx-auto px-4 relative z-10 text-center py-20">
            <h1 class="text-red-600 text-5xl mb-12 abril-fatface-regular">Find Your Dream Car</h1>
            <p class="text-red-600 text-4xl mb-12">Explore the best deals on new and used cars.</p>
            <div class="search-bar">
                <form action="{{ url('/search') }}" method="GET" id="searchForm" class="flex justify-center items-center gap-4">
                    <select name="cat_id" class="form-control bg-white text-black border border-gray-300 rounded">
                        <option value="">Search by Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="model" placeholder="Search by Model" class="border border-gray-300 rounded px-3 py-2 text-black bg-white" style="color: black !important;">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Search</button>
                </form>
            </div>
        </div>
        <div class="absolute inset-0 z-0" onclick="event.stopPropagation();"></div>
    </section>

    <!-- Car Listings Section -->
    <section class="car-listings py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-3xl mb-12">Featured Cars</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Car Cards -->
                <div class="car-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('images/Honda City.png') }}" alt="Honda City" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl mb-2">Honda City</h3>
                        <p class="text-gray-700">PKR 3,500,000</p>
                        <p class="text-gray-600 mb-4">2022 | 20,000 km</p>

                    </div>
                </div>

                <div class="car-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('images/Honda Civic.png') }}" alt="Honda Civic" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl mb-2">Honda Civic</h3>
                        <p class="text-gray-700">PKR 4,200,000</p>
                        <p class="text-gray-600 mb-4">2021 | 15,000 km</p>

                    </div>
                </div>

                <div class="car-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('images/Suzuki Mehran.png') }}" alt="Suzuki Mehran" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl mb-2">Suzuki Mehran</h3>
                        <p class="text-gray-700">PKR 1,800,000</p>
                        <p class="text-gray-600 mb-4">2020 | 30,000 km</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="footer-section" id="about-section">
                    <h4 class="text-xl mb-4">About Us</h4>
                    <p class="text-gray-400">AutoEase is your trusted partner for buying and selling cars in Pakistan. We offer the best deals on new and used cars.</p>
                </div>
                <div class="footer-section">
                    <h4 class="text-xl mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Cars</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section" id="contact-section">
                    <h4 class="text-xl mb-4">Contact Us</h4>
                    <p class="text-gray-400">Email: info@autoease.com</p>
                    <p class="text-gray-400">Phone: +92 322 1234567</p>
                </div>
                <div class="footer-section">
                    <h4 class="text-xl mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2025 AutoEase. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Existing search form code
            const searchForm = document.getElementById('searchForm');
            const formElements = searchForm.querySelectorAll('input, select, button');

            formElements.forEach(element => {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
