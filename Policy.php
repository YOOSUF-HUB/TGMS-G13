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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="/styles/policy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


    <style>
        html{
    background-color: #ECDFCC ;
}

/* General Styles */
body {
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

header {
    background-color: #697565;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button{
    font-family: questrial, sans-serif;
}


/* HEADER */
/* HEADER */

/* Container for centering the logo */
.logo {
    text-align: center;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    width: 100vw; /* Full viewport width to center horizontally */
}

.logo-content p{
    margin-right: 55px;
}




#menuIcon{
    margin-bottom: 3px;
}

.menu-icon {
    font-size: 24px;
    cursor: pointer;
    margin-right: 20px; /* Space between menu icon and search bar */
}


.sidenav {
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);
    opacity: 90%;
    backdrop-filter: blur(100px);
    height: 100%; 
    width: 0;  /* Initially hidden with 0 width */
    position: fixed; /* Fixed in place while scrolling */
    z-index: 1; /* Places the sidenav above other content */
    top: 0; 
    left: 0; 
    background-color:  #ffffff;
    overflow-x: hidden; /* Prevents horizontal scrolling */
    transition: 0.6s; /* Smooth transition for opening and closing */
    padding-top: 60px; /* Adds padding to the top of the sidenav */
}

/* Styling for links inside the sidenav */
.sidenav a {
    margin-top: 20px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    padding: 8px 8px 8px 32px; /* Padding inside links */
    text-decoration: none; 
    font-size: 1rem; 
    color: #000000; 
    display: block; 
    transition: 0.3s; /* Smooth transition for hover */
}

/* Changes link color when hovered */
.sidenav a:hover {
    color: #ECDFCC; 
    background-color: #697565;
}

/* Close button inside the side navigation */
.sidenav .closebtn {
    position: absolute; /* Positions the close button relative to the sidenav */
    top: 0; 
    right: 25px; 
    font-size: 36px; 
    margin-left: 50px;
    margin-top: 20px;
    cursor: pointer;
}

.sidenav .closebtn :hover{
    
    color: #f1f1f1;
}

#mySidenav .closebtn{
    display: flex;
    justify-content: flex-start;
    align-items: center;

}

/* When the side navigation is active (open) */
.sidenav.active {
    width: 250px; 
}




#searchIcon{
    margin-left: 40px;
}

/* Search Bar*/
#searchBarContainer {

    border-radius: 10px;
    position: absolute; /* Align next to the search icon */
    top: -55%; 
    left: 120%;
    overflow: hidden; /* Hide overflow content */
    transition: 0.3s; 
    background-color: #f9f9f9; 
    padding: 10px; 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Shadow  */
    display: flex; 
    justify-content: center;
    align-items: center; 
    margin-top: 10px;
    width: 0; 
    opacity: 0; 
    visibility: hidden; /* Ensure the search bar is not interactable */
}

/* Search input field styling */
#searchInput {
    width:200px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    padding: 8px;
    font-size: 10px;
    margin-right: 10px;
    border: 1px solid #ccc; 
    border-radius: 10px;
}

/* Search button styling */
#searchBarContainer button {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 10px;
    cursor: pointer;
    border: none; 
    background-color: #333; 
    color: white; 
}

/* Active class for showing the search bar */
#searchBarContainer.active {
    width: 300px; 
    opacity: 1; 
    visibility: visible; 
}




/* Profile image icon styling */
.profile-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
}

/* Profile container */
.profile-container {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    position: relative; /* Position the dropdown relative to this container */
    display: inline-block; /* Keeps the profile container only as wide as its contents */
    font-size: 1rem;
}





/* Dropdown menu styling */
.dropdown-content {
    position: absolute; 
    right: 0; 
    top: 100%; 
    background-color: black;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    transform: translateY(-20px); 
    opacity: 0; 
    visibility: hidden; 
    transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease; /* Smooth transition for transform, opacity, and visibility */
}

/* Styling for links inside the dropdown */
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Changes background color of dropdown links when hovered */
.dropdown-content a:hover {
    background-color: #697565;
    transition: 0.3s;
}

/* Show dropdown when active */
.dropdown-content.show {
    transform: translateY(0); /* Move the dropdown */
    opacity: 1; 
    visibility: visible; 
}

/* END OF HEADER */
/* END OF HEADER */

/* FOOTER */
/* FOOTER */

/* Footer Section */
footer {
    background-color: #697565;
    color: white;
    padding: 40px 20px;
}

.social-media{
    margin-right: 100px;
}

.fa {
    padding: 20px;
    font-size: 30px;
    width: 30px;
    text-align: center;
    text-decoration: none;
    border-radius: 50%;
    color: #ECDFCC;
}

.footer-links {
    font-family: questrial, sans-serif;
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.footer-links ul {
    margin: 10px;
    list-style-type: none;
}

.footer-links ul a {
    color: #fff;
    text-decoration: none;
}

.footer-links ul a:hover {
    color: #ECDFCC;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-bottom {
    text-align: center;
    padding-top: 10px;
}


/* END OF FOOTER */
/* END OF FOOTER */




main{
    font-family: Questrial, sans-serif;
    margin-left: 300px;
    margin-right: 300px;
}

#tc{
    margin-top: 30px;
    font-size: 50px;
    text-align: center;
    padding: 0;
}


main h6{
    font-size: 30px;
    margin: 0;
    padding: 0;
}

#terms-end{
    margin: 40px;
    text-align: center;
    font-size: 20px;
}

#contact-terms{
    text-decoration: none;
    color: black;
    font-size: 21px;
    transition: 0.5s ease;
}

#contact-terms:hover{
    font-size: 21.5px;
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
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="services.html">Services</a>
            <a href="contact.php">Contact</a>
            <a href="terms.html">Terms of Services</a>
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

    


    <main id="content">

<h4 id="tc" style="padding:0; margin-top:50px;">Privacy Policy</h4>

<p style="text-align: center;">Welcome to Versori. This Privacy Policy outlines how we collect, use, disclose, and safeguard your information when you visit our website and use our services. Please read it carefully.</p>
<ol style="list-style-type: square; font-size: 1rem;">

    <li>
        <h6>Information We Collect</h6>
        <ul>
            <li>
                <p>Personal Information: When you register or use our services, we may collect personal information such as your name, email address, phone number, and payment details.</p>
            </li>
            <li>
                <p>Usage Data: We may collect information about how you access and use our website, including your IP address, browser type, and pages visited.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>How We Use Your Information</h6>
        <ul>
            <li>
                <p>To provide and maintain our services, process your transactions, and communicate with you.</p>
            </li>
            <li>
                <p>To improve our website and services, including analyzing usage patterns to enhance user experience.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Disclosure of Your Information</h6>
        <ul>
            <li>
                <p>We do not sell or rent your personal information to third parties. We may share your information with:</p>
                <ul>
                    <li>
                        <p>Service Providers: Third-party vendors who assist us in providing our services.</p>
                    </li>
                    <li>
                        <p>Legal Authorities: If required by law or to protect our rights, we may disclose your information to comply with legal obligations.</p>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li>
        <h6>Data Security</h6>
        <ul>
            <li>
                <p>We take appropriate security measures to protect your personal information from unauthorized access, use, or disclosure.</p>
            </li>
            <li>
                <p>However, no method of transmission over the internet or electronic storage is 100% secure. Therefore, we cannot guarantee its absolute security.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Your Rights</h6>
        <ul>
            <li>
                <p>You have the right to access, correct, or delete your personal information. You can also withdraw your consent for processing your data at any time.</p>
            </li>
            <li>
                <p>To exercise these rights, please contact us using the contact information provided in this policy.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Cookies and Tracking Technologies</h6>
        <ul>
            <li>
                <p>We use cookies and similar tracking technologies to enhance your experience on our website. You can choose to accept or decline cookies in your browser settings.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Third-Party Links</h6>
        <ul>
            <li>
                <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these sites. We encourage you to read their privacy policies before providing any personal information.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Children's Privacy</h6>
        <ul>
            <li>
                <p>Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children. If we become aware that we have collected such information, we will take steps to delete it.</p>
            </li>
        </ul>
    </li>

    <li>
        <h6>Changes to This Privacy Policy</h6>
        <p>We may update this Privacy Policy from time to time. Changes will be posted on our website and will take effect upon posting. Your continued use of our services constitutes acceptance of the modified policy.</p>
    </li>

    <li>
        <h6>Contact Us</h6>
        <p>If you have any questions or concerns about this Privacy Policy, <a href="contact.php" id="contact-privacy">please contact us</a>.</p>
    </li>

</ol>

</main>

    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
                <ul style="list-style-type: none; display: flex; padding: 0; font-size: 30px;">
                    <li style="margin-left: 20px;"><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="footer-left">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.5rem; letter-spacing: 0.04rem;">Versori</li>
                    <li><a href="policy.html">Privacy Policy</a></li>
                    <li><a href="terms.html">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="footer-middle">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Our service</li>
                    <li><a href="manufacturing.html">Manufacturing</a></li>
                    <li><a href="consultancy.php">Consultancy</a></li>
                    <li><a href="sampling.html">Sampling</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <ul>
                    <li style="font-weight: bolder; font-size: 1.2rem;">Useful Links</li>
                    <li><a href="about.html">About us</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="faq.html">FAQ</a></li>
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