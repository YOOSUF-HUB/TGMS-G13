<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Navigation Bar Section-->
    <header style="padding: 8px 20px;">
        <nav id="mySidenav" class="sidenav">
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="services.html">Services</a>
            <a href="contact.php">Contact</a>
            <a href="terms.html">Terms of Services</a>
        </nav>
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">

        <section id="searchBar" style="position: relative;">
            <img src="images/search-google.svg" id="searchIcon" style="width: 30px;cursor: pointer;" onclick="opensearchBar()">
            <div id="searchBarContainer">
                <input type="text" id="searchInput" placeholder="Search...">
                <button onclick="performSearch()">Search</button>
            </div>
        </section>

        <section class="logo">
            <div class="logo-content">
                <a href="Index.html"> <img src="./images/Versori.png" alt="logo" style="height: 50px; padding-right: 90px;"> </a>
            </div>
        </section>

        <div class="profile-container">
            <img src="images/profile-google.svg" alt="Profile Icon" class="profile-icon" onclick="toggleDropdown()">
            <?php 
            if (isset($_SESSION['user_id'])) {
            ?>    
                <div id="myDropdown" class="dropdown-content">
                    <a href="./myaccount.php">My Account</a>
                    <a href="myorders.php">My Orders</a>
                    <a href="./logout.php">Logout</a>
                </div>
            <?php } else { ?>
                <div id="myDropdown" class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./register.php">Create Account</a>
                </div>
            <?php } ?>
        </div>
    </header>

    <main>
        <div id="checkout">
            <h1>Checkout</h1>
        </div>

        <div style="justify-content: centre;" class="checkout-container" >
            <!-- Shipping Address Form -->
            <div class="shipping-address">
                <h2>Shipping Address</h2>
                <form id="checkoutForm" action="payment.php" method="post">
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
                        <input type="text" id="full_name" name="full_name" placeholder="Full Name*" required>
                    </div>

                    <div class="input-field">
                        <label for="mobile">Mobile Number</label>
                        <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number*" required>
                    </div>

                    <!-- Address Section -->
                    <div class="address-section">
                        <div class="input-field">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" name="address" placeholder="Street address*" required>
                        </div>

                        <div class="input-field">
                            <label for="apartment">Apt, suite, unit, etc.</label>
                            <input type="text" id="apartment" name="apartment" placeholder="Apt, suite, unit, etc.">
                        </div>

                        <div class="input-field">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="City*" required>
                        </div>

                        <div class="input-field">
                            <label for="province">Province</label>
                            <select name="province" id="province" required>
                                <option value="" disabled selected>Choose province</option>
                                <option value="province1">Province 1</option>
                                <option value="province2">Province 2</option>
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

                    <!-- Order Summary -->
                    <div class="order-summary" style="width:70%; margin-top:30px;">
                        <h2>Order Summary</h2>
                        <div id="checkout">
                            <p>Total Price: Rs. <span id="totalPrice">0</span></p>
                        </div>
                        <div class="summary-item">
                            <span>Shipping fee ( 10% )</span>
                            <span id="shipping">Rs. 0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total</span>
                            <span id="sub-total">Rs. 0</span>
                        </div>

                        <div class="place-order-btn">
                            <input class="btn" type="submit" name="submit" value="Pay Now">
                        </div>

                        <!-- Error message display -->
                        <div id="error-message" style="color: red; margin-top: 10px;"></div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="index.js"></script>
    <script>
        // Function to update the subtotal and shipping fee
        function updateOrderSummary() {
            const totalPriceElement = document.getElementById('totalPrice');
            const shippingElement = document.getElementById('shipping');
            const subTotalElement = document.getElementById('sub-total');

            if (totalPriceElement) {
                let totalPrice = parseFloat(totalPriceElement.innerText.replace(/[^\d.-]/g, '')) || 0;
                const shippingFee = totalPrice * 0.10;
                shippingElement.innerText = `Rs. ${shippingFee.toFixed(2)}`;
                const subTotal = totalPrice + shippingFee;
                subTotalElement.innerText = `Rs. ${subTotal.toFixed(2)}`;
            } else {
                console.log('Total price element not found.');
            }
        }

        // Retrieve the final price from sessionStorage
        const finalPrice = sessionStorage.getItem('finalPrice');
        if (finalPrice) {
            document.getElementById('totalPrice').textContent = finalPrice;
        } else {
            console.log('No final price found in sessionStorage.');
        }

        updateOrderSummary();
    </script>
</body>
</html>
