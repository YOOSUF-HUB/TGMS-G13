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

    


        <main>

            <h2>Privacy Policy</h2>

            <p>At Versori, we are committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible manner. This Privacy Policy outlines how we collect, use, and protect your personal information when you use our Textile and Garment Management System.</p>
        <div>
            <ol>
                <li>
                    <h6>Information We Collect</h6>
                    <p>We collect the following types of information when you use the System:</p>
                    <ul>
                        <li>
                            <p>Personal Information: Name, email address, phone number, and other contact details when you create an account.</p>
                        </li>
                        <li>
                            <p>Transactional Data: Information related to your purchases, orders, and inquiries.</p>
                        </li>
                        <li>
                            <p>Technical Data: IP address, browser type, and device information collected automatically when you interact with our System.</p>
                        </li>
                    </ul>
                </li>        

                <li>
                    <h6>How We Use Your Information</h6>
                    <p>We use the information collected to :</p>
                    <ul>
                        <li>
                            <p>Provide and maintain the System</p>
                        </li>
                        <li>
                            <p>Process your orders and manage your account.</p>
                        </li>
                        <li>
                            <p>Respond to inquiries and provide customer support</p>
                        </li>
                        <li>
                            <p>Improve our services, website, and user experience</p>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6>Sharing Your Information</h6>
                    <p>We do not sell, trade, or rent your personal information. We may share information with third parties only for:</p>
                    <ul>
                        <li>
                            <p>Processing payments and completing orders.</p>
                        </li>
                        <li>
                            <p>Complying with legal obligations.</p>
                            
                        </li>
                        <li>
                            <p>Protecting the rights and safety of our users.</p>
                        </li>
                    </ul>
                </li>

                    <h6>Data Security</h6>
                    <p>We implement strict security measures to protect your personal information from unauthorized access, alteration, or disclosure. However, no data transmission over the internet can be guaranteed to be completely secure</p>
                
                <li>
                    <h6>Your Rights</h6>
                    <p>You have the right to: </p>
                    <ul>
                        <li>
                            <p>Ownership: All content, including but not limited to text, graphics, logos, icons, and software on the Versori platform, are the exclusive property of Versori or its licensors.</p>
                        </li>
                        <li>
                            <p>Restrictions: You may not copy, modify, distribute, sell, or lease any part of our services or software without explicit permission from Versori.</p>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6>Orders and Transactions</h6>
                    <ul>
                        <li>
                            <p>Order Processing: All orders placed through Versori are subject to acceptance and availability. We reserve the right to cancel or refuse orders if there is a technical issue or pricing error.</p>
                        </li>
                        <li>
                            <p>Payments: You agree to provide valid and accurate payment information for transactions made on our platform. All payments are processed through secure third-party gateways, and we are not responsible for any issues arising from these external services.</p>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6>Data Protection</h6>
                    <ul>
                            <p>Your personal data is collected and processed in accordance with our Privacy Policy. We are committed to ensuring that your information is secure and will not share it with third parties except as outlined in the Privacy Policy.</p>
                    </ul>
                </li>

                <li>
                    <h6>Service Availability</h6>
                    <ul>
                        <li>
                            <p>Service Interruptions: While we strive to provide continuous access to Versori services, there may be occasional downtime for maintenance, updates, or technical issues. Versori is not liable for any losses caused by such interruptions</p>
                        </li>
                        <li>
                            <p>Modifications: Versori reserves the right to modify or discontinue any of its services or features at any time without prior notice</p>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6>Limitation of Liability</h6>
                    <p>To the maximum extent permitted by law:</p>
                    <ul>
                        <li>
                            <p>Versori is not liable for any indirect, incidental, special, or consequential damages arising from your use of our services.</p>
                        </li>
                        <li>
                            <p>We do not guarantee that our services will be error-free, secure, or free from harmful components.</p>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6>Indemnification</h6>
                        <p>You agree to indemnify and hold harmless Versori, its affiliates, employees, and agents from any claims, liabilities, damages, and expenses arising out of your violation of these Terms or misuse of our services.</p>
                </li>

                <li>
                    <h6>Termination of Access</h6>
                        <p>We reserve the right to suspend or terminate your access to Versori's services at our sole discretion for any breach of these Terms and Conditions. Upon termination, your right to use the services will cease immediately.</p>
                </li>

                <li>
                    <h6>Governing Law</h6>
                        <p>These Terms and Conditions are governed by and construed in accordance with the laws of [Insert Jurisdiction], without regard to its conflict of law principles. You agree to submit to the exclusive jurisdiction of the courts of Sri Lanka.</p>
                </li>

                <li>
                    <h6>Amendments</h6>
                        <p>Versori reserves the right to modify these Terms and Conditions at any time. Changes will be posted on our website and will take effect upon posting. Your continued use of our services constitutes acceptance of the modified terms.</p>
                </li>

                <li>
                    <h6>Contact Us</h6>
                        <p>If you have any questions or concerns about these Terms and Conditions, please contact us</p>
                </li>
            </ol>

        </div>
            


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