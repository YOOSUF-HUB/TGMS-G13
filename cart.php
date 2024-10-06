<?php
session_start();
//echo $_SESSION['user_id'];
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'php/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="styles/cart.css">
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

<?php

    // SQL query to fetch data from customer account table
    $cart_sql = "SELECT cartID, Customer_ID, productName, productID, size, color, quantity, price_single, price_total, material FROM Cart";
    $cart_result = $conn->query($cart_sql);
    ?>

<main class="dashboard-container">
        <section class="content">
        <div>
                            <!-- Customer Accounts Section -->
            <h1 style="text-align:left; margin-left:25px;">Your Cart</h1>

            <div id="viewMode" class="table-container">
                <div >

                    <?php if ($cart_result->num_rows > 0): ?>
                        <table class="customer_table" style="justify-content:center; ">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>material</th>
                                    <th>Price for a Unit</th>
                                    <th>Sub Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $cart_result->fetch_assoc()): ?>
                                    <?php if($row["Customer_ID"] == $_SESSION['user_id']): // Check if the customer ID matches the session user ID ?>
                                        <tr>
                                            <td><?php echo $row["productName"]; ?></td>
                                            <td><?php echo $row["size"]; ?></td>
                                            <td><?php echo $row["color"]; ?></td>
                                            <td><?php echo $row["quantity"]; ?></td>
                                            <td><?php echo $row["material"]; ?></td>
                                            <td><?php echo $row["price_single"]; ?></td>
                                            <td><?php echo $row["price_total"]; ?></td>

                                        </tr>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No customer records found.</p>
                    <?php endif; ?>

                </div>

            </div>


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
