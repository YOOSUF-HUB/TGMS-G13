<?php
session_start();
//echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/faq.css">
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

        <section id="faq">
                <h1 style="text-align: center;">Frequently Asked Questions (FAQ)</h1>

            <section id="faq-items">
                <div class="faq-item">
                    <h2>1. What is the Textile and Garment Management System (TGMS)?</h2>
                    <p>The TGMS is a comprehensive platform designed to streamline operations for textile and garment businesses. It allows users to manage inventory, track orders, communicate with suppliers, and handle customer inquiries efficiently.</p>
                </div>
            
                <div class="faq-item">
                    <h2>2. Who can use TGMS?</h2>
                    <p>TGMS is designed for various roles within the textile and garment industry, including:</p>
                    <ul>
                        <li><strong>Suppliers:</strong> Manage raw materials, supplies, and deliveries.</li>
                        <li><strong>Customers:</strong> Place orders, track purchases, and inquire about products.</li>
                        <li><strong>System Admins:</strong> Oversee user accounts and ensure smooth IT operations.</li>
                        <li><strong>Customer Support:</strong> Handle customer inquiries and provide assistance.</li>
                        <li><strong>Inventory Managers:</strong> Track stock levels, manage orders, and generate sales reports.</li>
                    </ul>
                </div>
            
                <div class="faq-item">
                    <h2>3. How do I register as a customer?</h2>
                    <p>To register, go to the registration page, fill in the required details such as your name, contact information, and password, and submit the form. Once registered, you can log in to place orders, track shipments, and manage your account.</p>
                </div>
            
                <div class="faq-item">
                    <h2>4. Can I register as a supplier or system admin?</h2>
                    <p>No, registration is currently open only for customers. System admins and suppliers are registered by the admin or the business directly.</p>
                </div>
            
                <div class="faq-item">
                    <h2>5. How can I track my order status?</h2>
                    <p>Once logged in, go to the 'My Orders' section where you can view the status of your orders, including pending, processed, and shipped orders.</p>
                </div>
            
                <div class="faq-item">
                    <h2>6. What happens if an item is out of stock?</h2>
                    <p>If an item is out of stock, it will be marked as unavailable in the system. You can opt to be notified via email or SMS once the stock is replenished.</p>
                </div>
            
                <div class="faq-item">
                    <h2>7. How can I contact customer support?</h2>
                    <p>You can contact customer support by filling out the contact form on the 'Contact Us' page or reaching out through the live chat feature. You can also track and manage your inquiries in the 'My Inquiries' section.</p>
                </div>
            
                <div class="faq-item">
                    <h2>8. How do I view my cart?</h2>
                    <p>Once logged in, you can click on 'My Cart' in the top navigation menu to view all the products you have added, including their details, prices, and quantities.</p>
                </div>
            
                <div class="faq-item">
                    <h2>9. Can I modify or cancel an order?</h2>
                    <p>Yes, you can modify or cancel an order before it has been processed. Visit the 'My Orders' section, select the order you want to modify, and follow the provided options. Once the order is processed or shipped, modifications are no longer possible.</p>
                </div>
            
                <div class="faq-item">
                    <h2>10. How can I provide feedback on my purchase?</h2>
                    <p>After receiving your order, you can provide feedback by going to the 'My Orders' section and selecting the 'Feedback' option for each completed order.</p>
                </div>
            
                <div class="faq-item">
                    <h2>11. What types of payments are accepted?</h2>
                    <p>TGMS supports multiple payment options, including credit/debit cards, bank transfers, and digital wallets. Ensure that your payment method is up to date in the 'My Account' section.</p>
                </div>
            
                <div class="faq-item">
                    <h2>12. How is my personal data protected?</h2>
                    <p>We prioritize the privacy and security of your data. All personal information is encrypted and stored securely, and we comply with data protection regulations to ensure your information is safeguarded.</p>
                </div>
            
                <div class="faq-item">
                    <h2>13. Can I request a custom product or bulk order?</h2>
                    <p>Yes, TGMS allows customers to place bulk orders and request customizations for certain products. Please contact customer support or the relevant supplier through the system to discuss your requirements.</p>
                </div>
            
                <div class="faq-item">
                    <h2>14. What should I do if I forget my password?</h2>
                    <p>If you forget your password, click on the 'Forgot Password' link on the login page. You will be prompted to enter your registered email address, and instructions for resetting your password will be sent to you.</p>
                </div>
            
                <div class="faq-item">
                    <h2>15. Can I manage multiple locations or branches in TGMS?</h2>
                    <p>Yes, if you are a supplier or inventory manager, you can manage stock levels and orders for multiple locations or branches through the system's dashboard.</p>
                </div>
            
                <div class="faq-item">
                    <h2>16. How do I update my account information?</h2>
                    <p>To update your account details, log in and go to the 'My Account' section, where you can change your personal information, payment methods, and preferences.</p>
                </div>

            </section>

        </section>
        



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