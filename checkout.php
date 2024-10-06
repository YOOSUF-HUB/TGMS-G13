<?php
session_start();

?>
<?php
include("php/config.php");
if (isset($_POST['submit'])){
    $user_id = $_SESSION['user_id']; 
    // Collect form data
    $country = $_POST['country'];
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $apartment = $_POST['apartment'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];

    $shipping_info = "INSERT INTO `Shipping_details`(`Customer_ID`, `Country`, `Full_name`, `Mobile`, `Address`, `Apartment`, `City`, `Province`, `Zip`, `Payment_method`)
    VALUES ('$user_id','$country','$full_name','$mobile','$address','$apartment','$city','$province','$zip','$payment_method')";
    
    //$result = mysqli_query($conn, $shipping_info);
    setcookie('shipping_info', $shipping_info, time() + 3600, "/");
    setcookie('payment_method', $payment_method, time() + 3600, "/");


    header("Location: payment.php"); 
    exit(); 

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

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

    <main>
        <div id="checkout">
            <h1>Checkout</h1>
        </div>

        <div style="justify-content: centre;" class="checkout-container" >
            <!-- Shipping Address Form -->
            <div class="shipping-address">
                <h2>Shipping Address</h2>
                <form id="checkoutForm" action="" method="post">
                    <!-- Country Dropdown -->
                    <div class="input-field">
                        <label for="country">Country</label>
                        <select name="country" id="country" required>
                            <option value="" disabled selected>Choose your country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BT">Bhutan</option>
                            <option value="IN">India</option>
                            <option value="MV">Maldives</option>
                            <option value="NP">Nepal</option>
                            <option value="PK">Pakistan</option>
                            <option value="LK">Sri Lanka</option>
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
                            <label for="province">State/Province</label>
                            <input type="text" id="province" name="province" placeholder="State/Province*" required>
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
                        <img src="PRODUCT IMAGES/visa.svg" alt="Visa" width="60px">
                        <img src="PRODUCT IMAGES/mastercard.svg" alt="MasterCard" width="60px">
                        <img src="PRODUCT IMAGES/amex.svg" alt="American Express" width="60px">
                        <label style="margin-top: 20px">
                            <input type="radio" name="payment_method" value="credit_card" required>
                            <span>
                                Credit Card
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="payment_method" value="other">
                            Debit Card
                        </label>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary" style="width:95%; margin-top:30px;">
                        <h2>Order Summary</h2>
                        <div id="checkout">
                            <p>Total Price: Rs. <?php echo $_COOKIE['grand_total'];  ?></p>
                        </div>
                        <div class="summary-item">
                            <span>Shipping fee </span>
                            <span id="shipping">Rs. <?php echo $_COOKIE['shippingPrice'];?></span>
                        </div>
                        <div class="summary-item">
                            <span>Total</span>
                            <span id="sub-total">Rs. <?php echo $_COOKIE['fprice'];?></span>
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
