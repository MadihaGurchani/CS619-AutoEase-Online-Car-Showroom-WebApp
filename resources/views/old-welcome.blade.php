<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoEase.com</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <script src="{{ asset('build/assets/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<!-- Header Section -->
<header>
    <!--Google Fonts for Navbar-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="logo">
            <!-- {{--           <a href = "#"><img src="{{ asset('images/LOGODESIGN.png') }}" alt="AutoEase Logo"></a>--}} -->
            <h1>AutoEase.com</h1>
        </div>
        <div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Cars</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><button id="loginBtn">Admin Login</button></li>
                    <li><a href="{{ route('login') }}"><button id="loginBtn2">User Login</button></li>
                    <li><a href="{{ route('register') }}"><button id="RegisterBtn">Register</button></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Hero Section with Search Bar -->
<section class="hero" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); position: relative; background-size: cover; background-position: center; min-height: 500px;">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="container">
            <h1>Find Your Dream Car</h1>
            <p>Explore the best deals on new and used cars.</p>
            <div class="search-bar">
                <form action="{{ url('/search') }}" method="GET" id="searchForm">
                    <select name="cat_id" class="form-control">
                        <option value="">Search by Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="model" placeholder="Search by Model">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- Remove all commented sections like:
        {{--    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">--}}
        -->
    </div>
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;" onclick="event.stopPropagation();"></div>
</section>

<!-- Add this script at the bottom of your body tag -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const formElements = searchForm.querySelectorAll('input, select, button');
    
    formElements.forEach(element => {
        element.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});
</script>

<!-- Car Listings Section -->
<section class="car-listings">
    <div class="container">
        <h2>Featured Cars</h2>
        <div class="cars-grid">
            <!-- Car Listing 1 -->
            <div class="car-card">
                <img src="{{ asset('images/Honda City.png') }}" alt="Honda City">
                <h3>Honda City</h3>
                <p>PKR 3,500,000</p>
                <p>2022 | 20,000 km</p>
                <button>View Details</button>
            </div>
            <!-- Car Listing 2 -->
            <div class="car-card">
                <img src="{{ asset('images/Honda Civic.png') }}" alt="Honda Civic">
                <h3>Honda Civic</h3>
                <p>PKR 4,200,000</p>
                <p>2021 | 15,000 km</p>
                <button>View Details</button>
            </div>
            <!-- Car Listing 3 -->
            <div class="car-card">
                <img src="{{ asset('images/Suzuki Mehran.png') }}" alt="Suzuki Mehran">
                <h3>Suzuki Mehran</h3>
                <p>PKR 1,800,000</p>
                <p>2020 | 30,000 km</p>
                <button>View Details</button>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4>About Us</h4>
                <p>AutoEase is your trusted partner for buying and selling cars in Pakistan. We offer the best deals on new and used cars.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Cars</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: info@autoease.com</p>
                <p>Phone: +92 322 1234567</p>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 AutoEase. All rights reserved.</p>
        </div>
    </div>
</footer>

{{--<script src="{{ asset('js/scripts.js') }}"></script>--}}
</body>
</html>


<style>
    .box {
        width: 300px;  /* Reduced from original size */
        height: 200px; /* Reduced from original size */
        margin: 15px;
        padding: 20px;
        /* ... rest of box styles remain unchanged ... */
    }

   
    .footer-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
