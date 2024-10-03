<?php
// Include the database connection file here
include 'php/config.php';

// SQL query to fetch all prices from the Price table
$price_sql = "SELECT HOODIES, TSHIRT, JOGGERS, TANKTOP FROM Price";
$price_result = $conn->query($price_sql);

// Fetch prices and set default fallback
$hoodie_price = $tshirt_price = $jogger_price = $tanktop_price = 0;

if ($price_result->num_rows > 0) {
    $row = $price_result->fetch_assoc();
    $hoodie_price = $row['HOODIES'];
    $tshirt_price = $row['TSHIRT'];
    $jogger_price = $row['JOGGERS'];
    $tanktop_price = $row['TANKTOP'];
}
?>


<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Page</title>
        <link rel="stylesheet" href="styles/productpage.css">
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

            <div class="head">
                <h1>Explore Our Main Collection</h1>
                <p>At Versori, we offer a diverse collection of high-quality garments designed to meet the needs of every customer. 
                    Our products range from casual wear to activewear, all crafted with premium fabrics and attention to detail. 
                    Whether you're looking for stylish hoodies, comfortable joggers, or versatile tshirts, you'll find it all here in our curated selection.</p>
                    <p>Each product is available in multiple sizes and colors, providing options for every preference. Shop now and discover the perfect fit for your wardrobe!</p>    
            </div>
            
            <!-- 1st product -->
            <div class="container">
                <div class="item1"> 
                    <img src="images/hoodie-product.jpg" class="product-img" alt="img"> 
                </div>
                <div class="item2">
                    <form>
                        <a href="Product-Hoodie.php" style="text-decoration: none; color: black;">
                        <fieldset>
                            <b class="product-title">HOODIES</b><br><br>
                            <b style="font-size: 20px;">Category: </b>Casualwear<br><br>
                            <b style="font-size: 20px;">Style: </b> Pullover<br><br>
                            <b style="font-size: 20px;">Fabric: </b>Cotton, Polyester, Fleece, or a Blend (with weight typically between 200 to 400 GSM depending on warmth and durability)<br><br>
                            <b style="font-size: 20px;">Features: </b><br><br>
                            <b>Hood:</b> Adjustable drawstring hood.<br>
                            <b>Pockets:</b> Front kangaroo pocket or side pockets (for zip-up variants).<br>
                            <b>Sleeves:</b>Long sleeves, often with ribbed cuffs.<br>
                            <b>Hem:</b> Ribbed hem for elasticity.<br>
                            <b>Lining:</b> May be lined with fleece for warmth or without for lightweight options.<br><br>
                            <b style="font-size: 20px;">Size Range: </b> S, M, L (custom sizes may also be available).<br><br>
                            <b style="font-size: 20px;">Care Instructions: </b>Machine wash, tumble dry or air dry, based on fabric type.
                            <div style="margin-top: 30px;">
                                <button class="price">Rs.<?php echo $hoodie_price; ?>.00</button>
                                <button class="add">Buy Now</button>
                            </div>

                        </fieldset>

                        </a>

                    </form>
                </div>
            </div>   
            
            <!-- 2nd product -->
            <div class="container">
                <div class="item2">
                    <form>
                        <a href="Product_Tshirt.php" style="text-decoration: none; color: black;">
                        <fieldset>
                            <b class="product-title">T-Shirt</b><br><br>
                            <b style="font-size: 20px;">Category: </b>Casualwear<br><br>
                            <b style="font-size: 20px;">Style: </b> Crewneck T-shirt<br><br>
                            <b style="font-size: 20px;">Fabric: </b> Cotton, Polyester, or a Blend (with weight typically between 150 to 200 GSM for breathability and durability)<br><br>
                            <b style="font-size: 20px;">Features: </b><br><br>
                            <b>Neckline:</b> Classic crew neck, double-stitched for durability.<br>
                            <b>Fit: </b> Regular or slim fit options for a comfortable, flattering silhouette.<br>
                            <b>Sleeves:</b>Short sleeves with double-stitched cuffs for durability.<br>
                            <b>Hem:</b> Straight hemline with reinforced stitching for added strength.<br>
                            <b>Design: </b>Available in solid colors, graphic prints, or patterns.<br><br>    
                            <b style="font-size: 20px;">Size Range: </b> S, M, L (custom sizes may also be available).<br><br>
                            <b style="font-size: 20px;">Care Instructions: </b>Machine wash cold, tumble dry low or air dry. Avoid bleach or ironing on print.
                            <div style="margin-top: 30px;">
                            <button class="price">Rs.<?php echo $tshirt_price; ?>.00</button>
                            <button class="add">Buy Now</button>
                                
                            </div>
                        </fieldset>

                        </a>
                    </form>
                </div>
                <div class="item1">
                    <img src="images/tshirt-product.png" class="product-img" alt="img">
                </div>
            </div>   
            
            <!-- 3rd product -->
            <div class="container">
                <div class="item1">
                    <img src="images/joggers-product.png" class="product-img" alt="img">
                </div>
                <div class="item2">
                    <form>
                        <a href="Product-Joggers.php" style="text-decoration: none; color: black;">
                            <fieldset>
                                <b class="product-title">JOGGERS</b><br><br>
                                <b style="font-size: 20px;">Category: </b>Casualwear<br><br>
                                <b style="font-size: 20px;">Style: </b>Elastic Waistband Trousers<br><br>
                                <b style="font-size: 20px;">Fabric: </b>Cotton, Polyester, or a Blend (with weight typically between 180 to 300 GSM for breathability and comfort)<br><br>
                                <b style="font-size: 20px;">Features: </b><br><br>
                                <b>Waistband: </b> Elastic waistband with adjustable drawstring for a custom fit.<br>
                                <b>Pockets:</b> Side pockets and back patch pocket for convenience.<br>
                                <b>Fit:</b>Regular or slim fit for everyday comfort.<br>
                                <b>Hem:</b> Elasticated or straight hem options available.<br>
                                <b>Leg Style:</b>Tapered or straight leg for a modern look.<br>
                                <b>Lining:</b> May be lined with fleece for warmth or without for a lightweight feel.<br><br>
                                <b style="font-size: 20px;">Size Range: </b>S, M, L (custom sizes may also be available).<br><br>
                                <b style="font-size: 20px;">Care Instructions: </b>Machine wash cold, tumble dry low or air dry. Avoid bleach or ironing.
                                <div style="margin-top: 30px;">
                                <button class="price">Rs.<?php echo $jogger_price; ?>.00</button>
                                    <button class="add">Buy Now</button>
                                </div>
                            </fieldset>

                        </a>

                    </form>
                </div>
            </div>   
            
            <!-- 4th product -->
            <div class="container">
                <div class="item2">
                    <form>
                        <a href="Product-TankTop.php" style="text-decoration: none; color: black;">
                        <fieldset>
                            <b class="product-title">TANK TOP</b><br><br>
                            <b style="font-size: 20px;">Category: </b>Activewear, Sportswear<br><br>
                            <b style="font-size: 20px;">Style: </b>Tops (T-shirts, tank tops), Bottoms (shorts, leggings), Jackets<br><br>
                            <b style="font-size: 20px;">Fabric: </b>Polyester, Spandex (Lycra), Nylon, or Cotton blends<br><br>
                            <b style="font-size: 20px;">Features: </b>Moisture-wicking, quick-dry, stretchable, breathable, lightweight<br><br>
                            <b>Fit: </b>Regular fit, Compression fit, or Relaxed fit<br><br>
                            <b style="font-size: 20px;">Size Range: </b> S, M, L (custom sizes may also be available).<br><br>
                            <b style="font-size: 20px;">Care Instructions: Machine washable, tumble dry low or hang dry, avoid fabric softeners to maintain moisture-wicking properties.</b>
                            <div style="margin-top: 30px;">
                            <button class="price">Rs.<?php echo $tanktop_price; ?>.00</button>
                                <button class="add">Buy Now</button>
                            </div>
                        </fieldset>

                        </a>

                    </form>
                </div>
                <div class="item1">
                    <img src="images/tanktop-product.png"  class="product-img"  alt="img">
                </div>
            </div>   
            
            <div class="consultation-Booking">

                <h2>Want Something More?</h2>
                <p>At Versori, we believe your clothing should be as unique as you are. That’s why we offer a tailored design experience where you get to create pieces that perfectly fit your style. Whether it's selecting fabrics, colors, or even specific design elements, our team is here to bring your vision to life. With our personalized consultation, you can shape your wardrobe just the way you want it. Let’s collaborate to make your clothing truly yours!</p>

                <a href="consultation.php"> <button id="book-consultation">Book Your Consultation to Design Your Own Custom Clothing</button> </a>
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