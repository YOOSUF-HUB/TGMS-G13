<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="index.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


<style>
    #about-us{
        font-family: 'Questrial', sans-serif;
        text-align: center;
        margin-left: 200px;
        margin-right: 200px;
    }
</style>


</head>

<body>

    <!-- Navigation Bar Section-->
    <header style="padding: 8px 20px;">
        <!-- Side Navigation Menu -->
        <nav id="mySidenav" class="sidenav">
            <!-- Close button -->
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            
            <!-- Navigation links -->
            <a href="homepage.php">Home</a>
            <a href="about.php">About</a>
            <a href="consultation.php">Consultations</a>
            <a href="contact us page.php">Contact</a>
            <a href="termspage.php">Terms of Services</a>
        </nav>
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">

        <!-- Search Bar section -->
        <section id="searchBar" style="position: relative;">
            <img src="images/search-google.svg" id="searchIcon" style="width: 30px;cursor: pointer;" onclick="opensearchBar()">
            <div id="searchBarContainer">
                <input type="text" id="searchInput" placeholder="Search...">
                <button onclick="performSearch()">Search</button>
            </div>
        </section>

        <!-- Logo Section -->
        <section class="logo">
            <div class="logo-content">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 50px; padding-right: 90px;"> </a>
            </div>
        </section>

        <!-- Profile and Dropdown -->
        <div class="profile-container">
            <img src="images/profile-google.svg" alt="Profile Icon" class="profile-icon" onclick="toggleDropdown()">
            
            <!-- Dropdown Menu content -->
            <?php 
            if (isset($_SESSION['user_id'])) {
            ?>    
                <div id="myDropdown" class="dropdown-content">
                    <a href="./myaccount.php">My Account</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="cart.php">My Cart</a>
                    <a href="./logout.php">Logout</a>
                </div>
            <?php }else{?>
                <div id="myDropdown" class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./register.php">Create Account</a>
                </div>
            <?php }?>
            
        </div>
    </header>

    <!-- Main Content: About Us Section -->
    <main>
        <section id="about-us">

            <h1 style="font-size: 50px; ">Why Choose Us?</h1>
            <p style="font-size: 20px;">
                With a commitment to excellence and a focus on the needs of textile businesses, Versori is your trusted partner for optimizing operations. Our platform is designed with both simplicity and functionality in mind, ensuring that businesses can quickly adopt and benefit from our solutions.
            </p>
        </section>



        <section id="quote-img-intro">
        <div class="quote">
            <div class="quote-image-container">
                <img class="quote-image" src="PRODUCT IMAGES/aboutus.jpg" style="top: -9%;" alt="Products">
            </div>
            <div class="quote-detail">
                <h1>ABOUT US</h1>
                <p>Welcome to Versori, a leading provider in textile and garment management solutions. Our mission is to streamline and enhance the operational efficiency of textile businesses, from managing raw materials to overseeing final product delivery. Versori offers an integrated platform that simplifies inventory management, supplier coordination, customer interactions, and overall business operations.</p>
                
                

            </div>
        </div>

        <div class="quote">
            <div class="quote-detail">
                <h1>OUR MISSION</h1>
                <p>At Versori, our mission is to empower textile and garment businesses by providing innovative, scalable, and user-friendly solutions. We aim to bridge the gap between traditional management practices and modern technology to help businesses thrive in a competitive market.</p>
                
            </div>
            <div class="quote-image-container" style="box-shadow: -4px 4px 8px rgba(0, 0, 0, 0.2);" >
                <img class="quote-image" src="PRODUCT IMAGES/quottailor-inspecting-finished-custom-suit-qualityquot.jpg" alt="Clothing-manufacturer" >
            </div>

        </div>

        <div class="quote">
            <div class="quote-image-container">
                <img class="quote-image" src="PRODUCT IMAGES/man-with-bike-helmet.jpg" alt="brand-consultancy">
            </div>
            <div class="quote-detail">
                <h1>OUR VISION</h1>
                <p>Our vision is to become the leading textile and garment management platform globally, known for innovation, reliability, and exceptional customer service. We envision a future where businesses of all sizes can operate seamlessly and grow sustainably with the help of our platform.</p>
                
            </div>
        </div>
    </section>
    </main>

    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="homepage.php"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
                <ul style="list-style-type: none; display: flex; padding: 0; font-size: 30px;">
                    <li style="margin-left: 20px;"><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="footer-left">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.5rem; letter-spacing: 0.04rem;">Versori</li>
                    <li><a href="Policy.php">Privacy Policy</a></li>
                    <li><a href="termspage.php">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="footer-middle">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Our service</li>
                    <li><a href="help.php" >Manufacturing</a></li>
                    <li><a href="consultation.php">Consultancy</a></li>
                    <li><a href="help.php">Sampling</></li>
                </ul>
            </div>
            <div class="footer-right">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Useful Links</li>
                    <li><a href="about.php">About us</a></li>
                    <li><a href="contact us page.php">Contact us</a></li>
                    <li><a href="productpage.php">Products</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>    
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Versori 2024</p>
        </div>
    </footer>

    <script src="index.js"></script>
</body>
</html>
