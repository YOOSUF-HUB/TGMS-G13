<?php
session_start();
//echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - LTSHIRT</title>
    <link rel="stylesheet" href="styles/ProductDetails.css">
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
        <div class="page">
            <!-- Discount Section -->
            <div class="container">
                <div class="item">
                    <b>50 - 999 pieces</b><br>
                    <label><b><button id="button">10%</button></b></label>
                </div>
                <div class="item">
                    <b>1000 - 9999 pieces</b><br>
                    <label><b><button id="button">15%</button></b></label>
                </div>
                <div class="item">
                    <b>More than 10000 pieces</b><br>
                    <label><b><button id="button">20%</button></b></label>
                </div>
            </div>

            <!-- Product Image Section -->
            <h1><b>LONG SLEEVE - TSHIRT</b></h1><br>
            <div class="product-images">
                <div>
                    <img src="PRODUCT IMAGES/PRODUCT-LSLEEVE/Raven-Black-Long-Sleeve-T-Shirt-V10.webp" alt="Product Image" class="main-image">
                    <div class="thumbnail-images">
                        <img src="PRODUCT IMAGES/PRODUCT-LSLEEVE/Navy-Blue-Long-Sleeve-T-Shirt-V10.webp" alt="Yellow Hoodie" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-LSLEEVE/Army-Green-Long-Sleeve-T-Shirt-V10.webp" alt="Black Hoodie" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-LSLEEVE/Sea-Green-long-Sleeve-T-Shirt-V10.webp" alt="Black Hoodie" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-LSLEEVE/Cotton-White-Long-Sleeve-T-Shirt-V10.webp" alt="Black Hoodie" class="thumbnail">
                    </div>
                </div>

                <?php
                    // Include the database connection file here
                    include 'php/config.php';

                    // SQL query to fetch hoodie price from the Price table
                    $price_sql = "SELECT LSLEEVE FROM Price";
                    $price_result = $conn->query($price_sql);

                    // Fetch the hoodie price
                    if ($price_result->num_rows > 0) {
                        $row = $price_result->fetch_assoc();
                        $lsleeve_price = $row['LSLEEVE'];
                    } else {
                        $lsleeve_price = 0; // Fallback if no price is found
                    }
                ?>
    
                <!-- Select Options -->
                <div class="product-options">
                    <label for="colour"><b>Colour</b></label>
                    <select id="colour">
                        <option disabled selected>Select color</option>
                        <option value="Black">Black</option>
                        <option value="Blue">Blue</option>
                        <option value="Green">Green</option>
                        <option value="Sea Green">Sea Green</option>
                        <option value="white">White</option>
                    </select>
    
                    <label for="material"><b>Material</b></label>
                    <select id="material">
                        <option disabled selected>Select Material</option>
                        <option value="cotton">Cotton</option>
                        <option value="polyester">Polyester</option>
                    </select>
    
                    <label for="size"><b>Size</b></label>
                    <select id="size">
                        <option disabled selected>Select Size</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
    
                    <div class="quantity-selector">
                        <button id="decrease">-</button>
                        <input id="quantity" value="50" min="50" aria-label="Quantity">
                        <button id="increase">+</button><br><br>
                    </div>
                    
                    <div>
                        <label for="price"> Price (per unit):</label>
                        <input style="width: 300px;height: 45px;text-align: center;font-size: 1.2em;border: 2px solid #ff5e00;border-radius: 10px;" id="price" value="<?php echo $lsleeve_price; ?>.00" aria-label="price" readonly>
                    </div>
                    
                    <label for="final-price"> Final Price:</label>
                    <div style="width: 300px; height:45px;text-align: center;font-size: 1.2em;border: 2px solid green;border-radius: 10px;">
                        <span id="final-price"></span>
                    </div>
    
                    <label><b style="font-family: Questrial, sans-serif;">
                    Elevate your wardrobe with our premium long-sleeve t-shirts, designed for all-day comfort and effortless style. Crafted from soft, breathable fabrics like cotton and jersey, these shirts offer lightweight warmth and a versatile fit. Whether you're layering up for cooler weather or wearing it solo, our long-sleeve tees feature a relaxed yet tailored look, perfect for any occasion. Available in a range of vibrant colors and timeless neutrals, these shirts come with ribbed cuffs and a classic crew neck for a sleek finish. Ideal for casual wear, these t-shirts are your go-to choice for comfort, style, and year-round versatility.
                    </b></label>
                    
                    <!-- Buy and Add to Cart Buttons -->
                    <div class="action-buttons">
                        <button class="buy-now" onclick="storeFinalPrice()">Buy Now</button>
                        <button class="add-cart">Add to Cart</button>
                    </div>
                </div>
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
                        <li><a href="#">Shipping & Return Policy</a></li>
                        <li><a href="#">Secure Payment</a></li>
                        <li><a href="#">Track Your Order</a></li>
                    </ul>
                </div>
            </div>
        </footer>


    <script src="Index.js"></script>

    <script>
        // Get elements
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantityInput = document.getElementById('quantity');
    
        // Decrease quantity function
        decreaseButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 50) { // Ensure quantity doesn't go below 50
                quantityInput.value = currentValue - 1;
            }
        });
    
        // Increase quantity function
        increaseButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });

        // Get references to the price input fields, and final price display span
        const priceInput = document.getElementById('price');
        const finalPriceSpan = document.getElementById('final-price');

        // Function to calculate and display the final price
        function calculateFinalPrice() {
            // Multiply the quantity by the price and display the result, rounded to two decimal places
            finalPriceSpan.textContent = (quantityInput.value * priceInput.value).toFixed(2);
        }

        // Event listener for the 'increase' button
        // When clicked, increment the quantity and recalculate the final price
        document.getElementById('increase').addEventListener('click', () => {
            quantityInput.value++;  // Increase quantity by 1
            calculateFinalPrice();  // Recalculate final price
        });

        // Event listener for the 'decrease' button
        // When clicked, decrement the quantity if it's greater than 50, and recalculate the final price
        document.getElementById('decrease').addEventListener('click', () => {
            if (quantityInput.value > 50) quantityInput.value--;  // Decrease quantity by 1 only if it's greater than 50
            calculateFinalPrice();  // Recalculate final price
        });

        // Event listener for changes to the price input field
        // When the price changes, recalculate the final price
        priceInput.addEventListener('input', calculateFinalPrice);

        // Event listener for changes to the quantity input field
        // When the quantity changes, recalculate the final price
        quantityInput.addEventListener('input', calculateFinalPrice);

        // Perform the initial calculation when the page loads
        calculateFinalPrice();

        function storeFinalPrice() {
            const finalPrice = document.getElementById('final-price').textContent; // Get the final price from the page
            sessionStorage.setItem('finalPrice', finalPrice); // Store the final price in sessionStorage
            window.location.href = 'checkout.php'; // Redirect to payment page
        }

    </script>
    
</body>
</html>
