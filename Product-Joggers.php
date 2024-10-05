<?php
session_start();
// echo $_SESSION['user_id'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - Joggers</title>
    <link rel="stylesheet" href="styles/ProductDetails copy.css">
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
</head>
<body>

<header style="padding: 8px 20px;">
    <!-- Side Navigation Menu -->
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
    <div class="page">
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
            <h1><b>JOGGERS</b></h1><br>
            <div class="product-images">
                <div>
                    <img src="PRODUCT IMAGES/PRODUCT-JOGGERS/j-black.webp" alt="Black Jogger" class="main-image">
                    <div class="thumbnail-images">
                        <img src="PRODUCT IMAGES/PRODUCT-JOGGERS/madmext-beyaz-jogger-pantolon-4242-293-c7.webp" alt="White Jogger" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-JOGGERS/Navy-Blue_06b35c30-afe4-41df-a658-2831a0511e13.webp" alt="Blue Jogger" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-JOGGERS/jogger-green.webp" alt="Green Jogger" class="thumbnail">
                    </div>
                </div>

            <?php
            include 'php/config.php';
            $price_sql = "SELECT JOGGERS FROM Price";
            $price_result = $conn->query($price_sql);
            if ($price_result->num_rows > 0) {
                $row = $price_result->fetch_assoc();
                $joggers_price = $row['JOGGERS'];
            } else {
                $joggers_price = 0; // Fallback if no price is found
            }
            ?>
        </div>
    </div>

    <div class="container-2">
        <div class="form-box">
            <?php
            include("php/config.php");
            if (isset($_POST['submit'])) {
                // Collect form data
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $productName = mysqli_real_escape_string($conn, $_POST['productName']);
                $productID = mysqli_real_escape_string($conn, $_POST['productID']);
                $size = mysqli_real_escape_string($conn, $_POST['size']);
                $color = mysqli_real_escape_string($conn, $_POST['color']);
                $material = mysqli_real_escape_string($conn, $_POST['material']);
                $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);


                $price_total = $joggers_price * $quantity;


                // Query to get the last cartID
                $find = mysqli_query($conn, "SELECT MAX(cartID) AS max_id FROM Cart");
                $row = mysqli_fetch_assoc($find);
                
                // Assigning cart ID

                if ($row['max_id']) {
                    $last_id = $row['max_id'];
                    // Extract numeric part from last ID
                    $last_num = (int)preg_replace("/[^0-9]/", "", $last_id);
                    $num = $last_num + 1; // Increment the numeric part
                    
                // Generate new customer ID with 'CONSULT_' prefix
                    $cartID = 'CART_' . str_pad($num, 4, '0', STR_PAD_LEFT); 
                } else {
                    $cartID = 'CART_0001'; // Use the correct prefix here
                }

                // Build your insert query
                $query = "INSERT INTO Cart (cartID,Customer_ID, productName, productID, size, color, quantity, price_single, price_total, material) 
                VALUES ('$cartID','$user_id', '$productName', '$productID', '$size', '$color', $quantity, $joggers_price, $price_total, '$material')";

                if (mysqli_query($conn, $query)) {
                    echo "<div class='successmessage'>
                            <p style='font-family:Questrial,san-serif; text-align:center; font-size: 40px'>Your Product Has been added to your cart</p>
                            <button onclick='goBack()' style='font-family:Questrial,san-serif; font-size: 20px; padding: 10px 20px; background-color: #697565; color: white; border: none; border-radius: 5px; cursor: pointer;'>Go Back</button>
                        </div>";
                        
                } else {
                    echo "<div class='errormessage'>
                            <p>Error: " . mysqli_error($conn) . "</p>
                            <button onclick='goBack()' style='font-family:Questrial,san-serif; font-size: 20px; padding: 10px 20px; background-color: #697565; color: white; border: none; border-radius: 5px; cursor: pointer;'>Go Back</button>
                            </div>";
                }
            } else {
            ?>
            <form action="" method="POST" class="product-options">
                <div class="product-options">
                    <label for="colour"><b>Colour</b></label>
                    <select id="colour" name="color" required>
                        <option disabled selected>Select color</option>
                        <option value="yellow">Yellow</option>
                        <option value="black">Black</option>
                        <option value="red">Red</option>
                        <option value="white">White</option>
                    </select>

                    <label for="material"><b>Material</b></label>
                    <select id="material" name="material" required>
                        <option disabled selected>Select Material</option>
                        <option value="cotton">Cotton</option>
                        <option value="polyester">Polyester</option>
                    </select>

                    <label for="size"><b>Size</b></label>
                    <select id="size" name="size" required>
                        <option disabled selected>Select Size</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>

                    <div class="quantity-selector">
                        <button type="button" id="decrease-button">-</button>
                        <input  name="quantity" id="quantity" value="50" min="50" required>
                        <button type="button" id="increase-button">+</button>
                    </div>

                    <div>
                        <label for="price"> Price (per unit):</label>
                        <input style="width: 300px;height: 45px;text-align: center;font-size: 1.2em;border: 2px solid #ff5e00;border-radius: 10px;" id="price" value="<?php echo $joggers_price; ?>.00" aria-label="price" readonly>
                    </div>
                    
                    <label for="final-price"> Final Price:</label>
                    <div style="width: 300px; height:45px;text-align: center;font-size: 1.2em;border: 2px solid green;border-radius: 10px;">
                        <span id="finalprice"></span>
                    </div>

                </div>



                <input type="hidden" name="cartID" value="<?php echo $cartID; ?>">
                <input type="hidden" name="productName" value="Jogger">
                <input type="hidden" name="productID" value="J001">

                <div class="purchase-btn" style="margin-top: 20px;">

                <button class="buy-now">Buy Now</button>
                <button type="submit" name="submit" class="add-cart">Add to Cart</button>

                </div>

            </form>
            <?php } ?>
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

    // Quantity Adjustment
    const quantityInput = document.getElementById('quantity');
    const increaseButton = document.getElementById('increase-button');
    const decreaseButton = document.getElementById('decrease-button');

    function calculateFinalPrice() {
        const joggers_price = <?php echo $joggers_price; ?>; // Price from the database
        const quantity = parseInt(quantityInput.value);
        const finalPrice = joggers_price * quantity;
        document.getElementById('finalprice').textContent = finalPrice.toFixed(2);
    }

    increaseButton.addEventListener('click', function(event) {
        event.preventDefault();
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        calculateFinalPrice();
    });

    decreaseButton.addEventListener('click', function(event) {
        event.preventDefault();
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 50) {
            quantityInput.value = currentValue - 1;
            calculateFinalPrice();
        }
    });

    // Initial calculation
    window.onload = calculateFinalPrice;

    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
