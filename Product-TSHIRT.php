<?php
session_start();
// echo $_SESSION['user_id'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
include("php/config.php");
if (isset($_POST['buy'])) {
    // Collect form data
    $user_id =  $_SESSION['user_id'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $material = $_POST['material'];
    $quantity =  $_POST['quantity'];

    $currentDate = date('Y-m-d');
    // Default values
    $deliveryDate = null;
    $fprice = 0;
    $shipping = 0;


    
    $search = mysqli_query($conn, "SELECT MAX(Order_ID) AS max_id FROM Orders"); //order id
    $order_row = mysqli_fetch_assoc($search);
    if ($order_row['max_id']) {
        $last_id = $order_row['max_id'];
        $num = intval(substr($last_id, 1)) + 1; 
        
        $orderid = 'O' . str_pad($num, 4, '0', STR_PAD_LEFT); 
    } else {
        $orderid = 'O1001'; 
    }

    $sql = "SELECT * FROM Inventory WHERE `Name`= 'T-Shirt' AND `Colour` = '$color' AND `Size` = '$size' AND `Type` = '$material'"; //product ID
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $productID = $product['Product_ID'];
        $price = $product['Price'];
        $inventory_qty = $product['Quantity'];

        if ($quantity > $inventory_qty) {
            echo "Not enough inventory available.";
            exit;
        }

        $price_total = $price * $quantity; //calculate total price
        
        $balance_qty = $inventory_qty - $quantity;//find balance inventory


        

        if ($quantity>=50 && $quantity<500){ // setting dellivery date
            $deliveryDate = (date('Y-m-d', strtotime('+1 week')));
        }else if ($quantity>=500 && $quantity<1000) {
            $deliveryDate = date('Y-m-d', strtotime('+2 week')); 
        }else if ($quantity>=1000) {
            $deliveryDate = date('Y-m-d', strtotime('+6 week')); 
        }


        if ($quantity>=50 && $quantity<500){
            $fprice = ($price_total-($price_total/10)); // calculate discount price
        }else if ($quantity>=500 && $quantity<1000) {
            $fprice = ($price_total-($price_total/15));
        }else if ($quantity>=1000) {
            $fprice = ($price_total-($price_total/20));
        }

        if ($quantity>=49 && $quantity<500){ // setting shipping price
            $shipping = ($quantity * 25); 
        }else if ($quantity>=500 && $quantity<1000) {
            $shipping = ($quantity * 20);
        }else if ($quantity>=1000) {
            $shipping = ($quantity * 15);
        }


        $grand_total = ($fprice + $shipping);
        

        
        $buy_now = "INSERT INTO `Orders`(`Order_ID`, `Customer_ID`, `Product_ID`, `Order_Date`, `Delivery_Date`, `Status`, `Order_type`, `Quantity`) 
        VALUES ('$orderid','$user_id','$productID','$currentDate','$deliveryDate','In-Progress', 'Wholesale' ,$quantity)";
        //$buy_result = mysqli_query($conn, $buy_now);

        setcookie('buy_now', $buy_now, time() + 3600, "/");
        setcookie('fprice', $fprice, time() + 3600, "/");
        setcookie('shippingPrice', $shipping, time() + 3600, "/");
        setcookie('productID', $productID, time() + 3600, "/"); 
        setcookie('orderid', $orderid, time() + 3600, "/"); 
        setcookie('grand_total',$grand_total, time() + 3600, "/");
        setcookie('balance_qty',$balance_qty, time() + 3600, "/"); 

        header("Location: checkout.php"); 
        exit(); 
    } else {
        echo "Product not found.";
        exit;
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - TSHIRT</title>
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
    <div class="page">
        <div class="container">
            <div class="item">
                <b>50 - 499 pieces</b><br>
                <label><b><button id="button">10%</button></b></label>
            </div>
            <div class="item">
                <b>499 - 999 pieces</b><br>
                <label><b><button id="button">15%</button></b></label>
            </div>
            <div class="item">
                <b>More than 1000 pieces</b><br>
                <label><b><button id="button">20%</button></b></label>
            </div>
        </div>

            <!-- Product Image Section -->
            <h1><b>TSHIRTS</b></h1><br>
            <div class="product-images">
                <div>
                    <img src="PRODUCT IMAGES/PRODUCT-TSHIRT/Jet-Black-Sports-T-Shirt.webp" alt="Black Tshirt" class="main-image">
                    <div class="thumbnail-images">
                        <img src="PRODUCT IMAGES/PRODUCT-TSHIRT/Electric-Red-Sports-T-Shirt.webp" alt="Red Tshirt" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-TSHIRT/Neon-Yellow-Sports-T-Shirt-1.webp" alt="Yellow Tshirt" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-TSHIRT/White-Sports-T-Shirt.webp" alt="White Tshirt" class="thumbnail">
                        <img src="PRODUCT IMAGES/PRODUCT-TSHIRT/Maroon-Sports-T-Shirt-300x300.webp" alt="Maroon Tshirt" class="thumbnail">
                    </div>
                </div>
    </div>

    <div class="container-2">
        <div class="form-box">
            <?php
            //fatching price to show display price
            $findPrice = "SELECT * FROM Inventory WHERE `Name`= 'T-Shirt'"; //product ID
            $result_findPrice = mysqli_query($conn, $findPrice);
            $product = mysqli_fetch_assoc($result_findPrice);
            $price = $product['Price'];
            ?>
            <form action="" method="POST" class="product-options" id="product-form">
                <div class="product-options">
                    <label for="colour"><b>Colour</b></label>
                    <select id="colour" name="color" required>
                        <option disabled selected>Select color</option>
                        <option value="Blue">Blue</option>
                        <option value="White">White</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Red">Red</option>
                    </select>
                    

                    <label for="material"><b>Material</b></label>
                    <select id="material" name="material" required>
                        <option disabled selected>Select Material</option>
                        <option value="Cotton">Cotton</option>
                    </select> 

                    <label for="size"><b>Size</b></label>
                    <select id="size" name="size" required>
                        <option disabled selected>Select Size</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                        <option value="Small">Small</option>
                        <option value="Extra-Large">Extra-Large</option>
                    </select>

                    <div class="quantity-selector">
                        <button type="button" id="decrease-button">-</button>
                        <input  name="quantity" id="quantity" value="50" min="50" required>
                        <button type="button" id="increase-button">+</button>
                    </div>

                    <div>
                        <label for="price"> Price (per unit):</label>
                        <input style="width: 300px;height: 45px;text-align: center;font-size: 1.2em;border: 2px solid #ff5e00;border-radius: 10px;" id="price" value="<?php echo $price; ?>" aria-label="price" readonly>
                    </div>
                    
                    <label for="final-price"> Final Price:</label>
                    <div style="width: 300px; height:45px;text-align: center;font-size: 1.2em;border: 2px solid green;border-radius: 10px;">
                        <span id="finalprice"></span>
                    </div>

                </div>



                <div class="purchase-btn" style="margin-top: 20px;">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <button type="submit" name="buy"   class="buy-now" id="buy-now" >Buy Now</button>
                    <?php } else {?>
                    <button type="submit" name="buy"   class="buy-now" id="buy-now" >Buy Now</button>
                    <?php } ?>
                </div>

            </form>
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
        const hoodiePrice = <?php echo $price; ?>; // Price from the database
        const quantity = parseInt(quantityInput.value);
        const finalPrice = hoodiePrice * quantity;
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
