<?php
session_start();
//echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textile and Garment Management System</title>
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


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
        <!-- Menu icon (with open function)-->
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">


        <!-- Search Bar section -->
        <section id="searchBar" style="position: relative;">
            <img src="images/search-google.svg" id="searchIcon" style="width: 30px;cursor: pointer;" onclick="opensearchBar()">
            
            <!-- Search bar container -->
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
            <!-- Profile Image Icon; clicking on this toggles the dropdown -->
            <img src="images/profile-google.svg" alt="Profile Icon" class="profile-icon" onclick="toggleDropdown()">
            
            <!-- Dropdown Menu content; links for Login, Logout, and My Orders -->
            <?php 
            if (isset($_SESSION['user_id'])) {
            ?>    
                <div id="myDropdown" class="dropdown-content">
                    <a href="./myaccount.php">My Account</a>
                    <a href="myorders.php">My Orders</a>
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



    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-content" style="background-image: url('./images/rubens-nguyen-Fy7RX0gHZRM-unsplash.jpg'); background-size: cover; background-position: center; ">
            <!-- <div class="home-title" style="position:absolute; bottom:6rem;">
                <h1 style="font-size: 5rem;">Unraveling Complexity,<br> Thread by Thread</h1>
            </div>
            <img id="banner-img" src="" alt="banner image"> -->
            
        </div>
        
    </section>

    <div class="banner-text-section" >

        <div id="banner-text" >
            <h1>LOOKING FOR A CLOTHING MANUFACTURER?</h1>
            <p style="line-height: 2;">At Versori, we specialize in clothing design and manufacturing, having worked with a diverse range of brands from start-ups and SMEs to global fashion icons. With extensive expertise in the fashion industry, we provide comprehensive support including tech packs, pattern cutting, sampling, and clothing manufacture. Our deep understanding of the fashion brand lifecycle ensures that we can help you bring your vision to life with precision and excellence.</p>
            <a href="contact us page.php" id="banner-contact"><button class="banner-contact-button">Contact Us</button></a>
        </div>

    </div>

   
     <!-- Quote Section -->
    <section id="quote-img-intro">
        <div class="quote">
            <div class="quote-image-container">
                <img class="quote-image" src="./images/pexels-gabby-k-6311142.jpg" style="top: -9%;" alt="Products">
            </div>
            <div class="quote-detail">
                <h1>EXPLORE OUR HIGH-QUALITY TEXTILE PRODUCTS TO ELEVATE YOUR BRAND</h1>
                <p>Experience the pinnacle of textile excellence with our curated collection of high-quality fabrics. Designed to offer unparalleled durability and luxury, our textiles are perfect for enhancing your brand’s prestige. Choose from a variety of sophisticated options to bring your creative vision to life with superior quality and timeless appeal.</p>
                
                <a href="productpage.php"><button class="quote-btn1">Product</button></a>

            </div>
        </div>

        <div class="quote">
            <div class="quote-detail">
                <h1>BUILD YOUR BRAND WITH OUR CLOTHING MANUFACTURING AND DESIGN SERVICES</h1>
                <p>Partner with us to bring your vision to life with precision and quality. Our comprehensive manufacturing and design services offer bespoke solutions that cater to your unique needs,ensuring that your brand stands out in a competitive market. From concept to creation, we focus on delivering exceptional craftsmanship, innovative designs, and premium materials, guaranteeing durability and elegance in every piece. Let us help you craft a brand identity that resonates with your audience and leaves a lasting impression.</p>
                <button class="quote-btn1">Manufacturing</button>
            </div>
            <div class="quote-image-container" style="box-shadow: -4px 4px 8px rgba(0, 0, 0, 0.2);" >
                <img class="quote-image" src="images/CLOTH-MANUFACTURER.jpg" alt="Clothing-manufacturer" >
            </div>

        </div>

        <div class="quote">
            <div class="quote-image-container">
                <img class="quote-image" src="images/brand-consulatncy.jpg" alt="brand-consultancy">
            </div>
            <div class="quote-detail">
                <h1>ELEVATE YOUR IDENTITY WITH OUR EXPERT BRAND CONSULTANCY AND STRATEGY SERVICES</h1>
                <p>Unlock your brand’s full potential with our tailored consultancy services. We help you build a strong, lasting presence in the market through strategic planning, creative solutions, and industry expertise. Partner with us to define your brand’s identity, strengthen customer connections, and drive long-term growth. Let’s create a strategy that makes your brand stand out and thrive in a competitive world.</p>
                <a href="consultation.php"> <button class="quote-btn1">Brand Consultancy</button> </a>
            </div>
        </div>
    </section>

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