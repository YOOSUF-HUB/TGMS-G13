<?php
session_start();
//echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">




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
                    <a href="./logout.php">Logout</a>
                </div>
            <?php }else{?>
                <div id="myDropdown" class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./register.php">Create Account</a>
                </div>

            <?php }?>


    </header>

    <!-- Need to PHP so that it captures the session and Customer ID in that session to be used -->

    <main>

        <div id="checkout">
            <h1>Checkout</h1>
        </div>

        <div class="checkout-container">
            <!-- Shipping Address Form -->
            <div class="shipping-address">
                <h2>Shipping Address</h2>
                <form>
                    <!-- Country Dropdown -->
                    <div class="input-field">
                        <label for="country">Country</label>
                        <select name="country" id="country" required>
                            <option value="" disabled selected>Choose your country</option>
                            <option value="USA">United States</option>
                            <option value="UK">United Kingdom</option>
                            <option value="CA">Canada</option>
                            <option value="IN">India</option>
                            <option value="AU">Australia</option>
                            <!-- Add more countries -->
                        </select>
                    </div>
    
                    <!-- Contact Information -->
                    <div class="input-field">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Full Name*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                    </div>
    
                    <div class="input-field">
                        <label for="mobile">Mobile Number</label>
                        <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                    </div>
    
                    <!-- Address Section -->
                    <div class="address-section">
                        <div class="input-field">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" name="address" placeholder="Street address*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>
    
                        <div class="input-field">
                            <label for="apartment">Apt, suite, unit, etc.</label>
                            <input type="text" id="apartment" name="apartment" placeholder="Apt, suite, unit, etc." style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" >
                        </div>
    
                        <div class="input-field">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="City*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>
    
                        <div class="input-field">
                            <label for="province">Province</label>
                            <select name="province" id="province" required>
                                <option value="" disabled selected>Choose province</option>
                                <option value="province1">Province 1</option>
                                <option value="province2">Province 2</option>
                                <!-- Add more provinces -->
                            </select>
                        </div>
    
                        <div class="input-field">
                            <label for="zip">Zip Code</label>
                            <input type="text" id="zip" name="zip" placeholder="Zip code*" required>
                        </div>
                    </div>
    
                    <!-- Payment Methods -->
                    <div class="payment-methods">
                        <h2>Payment Methods</h2>
                        <label>
                            <input type="radio" name="payment_method" value="credit_card" required>
                            <span>
                                Credit or Debit Card
                                <img src="https://example.com/visa.png" alt="Visa" width="20px">
                                <img src="https://example.com/mastercard.png" alt="MasterCard" width="20px">
                                <img src="https://example.com/amex.png" alt="American Express" width="20px">
                                
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="other">
                            Other
                        </label>
                    </div>
                </form>
            </div>
    
            <!-- Order Summary Page -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div id="checkout">
                    <h1>Checkout</h1>
                    <p>Total Price: Rs. <span id="totalPrice">0</span></p>
                </div>
                <div class="summary-item">
                    <span>Shipping fee</span>
                    <span id="shipping">Rs. 0</span>
                </div>
                <div class="summary-item">
                    <span>Total</span>
                    <span id="sub-total">Rs. 0</span>
                </div>

                <div class="place-order-btn">
                    <input class="btn" type="submit" name="submit" value="Submit" >
                </div>

                <!-- Error message will be displayed here -->
                <div id="error-message" style="color: red; margin-top: 10px; font-family: Questrial,sans-serif;"></div>
            </div>
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

    <script>
        // Retrieve the stored final price from sessionStorage on the checkout page
        const finalPrice = sessionStorage.getItem('finalPrice-payment'); // Get the price from sessionStorage
        if (finalPrice) {
            document.getElementById('totalPrice').textContent = totalPrice; // Display the price on the checkout page
        } else {
            console.log('No final price found.');
        }
    </script>



</body>
</html>