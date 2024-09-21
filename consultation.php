<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulation Booking</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/consultation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->
    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

</head>
<body>
    
    <header>
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
            <div id="myDropdown" class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Login</a>
                <a href="#">My Orders</a>
                <a href="#">Logout</a>
            </div>
        </div>


    </header>






    <div class="first-head">

        <h1 style="margin-top: 2rem;">BOOK A BRAND CONSULTATION</h1>

        <p>At Versori, we provide a comprehensive system designed to manage every stage of your textile and garment production, from raw materials to the final product. Our platform offers personalized support, streamlining your operations and tailoring solutions to the specific needs of your business. Whether you're a small boutique or a large-scale manufacturer, Versori adapts to your requirements, helping you achieve operational excellence. We welcome businesses of all sizes within the textile and garment industry to experience our cutting-edge tools and expertise.Versori is built on decades of expertise in the textile and garment industry: Our system offers comprehensive: tools for managing every aspect of your textile and garment production process, To your final product deliver with our platform, you'll have access to personalized support, ensuring that your operations are streamlined and tailored to the unique needs of your business. Whether you're a small boutique or a large-scale manufacturer, our system adapts to your needs and helps you achieve operational excellence. All levels of the textile and garment industry are welcome.</p>
        <br>
        <br>
    </div>

    <div class="brand-consultancy-image-container">
        <img src="images/brand-consultancy-2.jpg" id="brand-consultancy-2">
    </div>

    <div class="first-head">

        <h1 style="margin-top: 4rem;">WHY DO YOU NEED A BRAND CONSULTATION?</h1>

        <p>A strong, well-defined brand is essential in today’s competitive marketplace. Brand consultation offers expert guidance to refine your brand’s identity, positioning, and strategy. Whether you are launching a new brand, rebranding, or enhancing an existing one, professional consultation ensures your brand resonates with your target audience and stands out in the market. Investing in brand consultation is a strategic step towards building lasting brand loyalty and achieving long-term success.</p>

    </div>

    <div class="container">

        <div class="form-box">
                <?php

                include("./php/config.php");
                
                if (isset($_POST['submit'])) {
                    // Collect form data
                    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
                    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
                    $company_website = mysqli_real_escape_string($conn, $_POST['company_website']);
                    $company_scale = mysqli_real_escape_string($conn, $_POST['company_scale']);
                    $brand_overview = mysqli_real_escape_string($conn, $_POST['brand_overview']);
                    $other_comments = mysqli_real_escape_string($conn, $_POST['other_comments']);


                    // Query to get the last Consultation_ID
                    $find = mysqli_query($conn, "SELECT MAX(Consultation_ID) AS max_id FROM Consultation");
                    $row = mysqli_fetch_assoc($find);

                    // Assigning customer ID
                    if ($row['max_id']) {
                        $last_id = $row['max_id'];
                        $num = intval($last_id) + 1; // Increment the numeric ID directly
                        
                    // Generate new customer ID with 'CONSULT_' prefix
                        $customerid = 'CONSULT_' . str_pad($num, 4, '0', STR_PAD_LEFT); 
                    } else {
                        $customerid = 'CONSULT_0001'; // Use the correct prefix here
                    }


                    // Insert form data into the database
                    $query = "INSERT INTO Consultation (Consultation_Date, Full_name, Email, Phone_no, Company_name, Company_website_URL, Company_scale, Brand_overview, Other)
                            VALUES (NOW(), '$full_name', '$email', '$telephone', '$company_name', '$company_website', '$company_scale', '$brand_overview', '$other_comments')";

                    if (mysqli_query($conn, $query)) {
                        echo "<div class='successmessage'>
                                <p style='font-family:Questrial,san-serif; text-align:center; font-size: 40px'>Thank you! Your consultation request has been received. We will get back to you shortly.</p>
                            </div>";
                    } else {
                        echo "<div class='errormessage'>
                                <p>Error: " . mysqli_error($conn) . "</p>
                            </div>";
                    }
                } else {
                ?>
                    <h3>Book a Consultancy</h3>
                    <p style="font-family:Questrial,san-serif; text-align:center;color: #697565; font-size: 20px;">We will respond within 24 Hours</p>


                    <form action="" method="post">
                        <div class="field input">
                            <input type="text" name="full_name" placeholder="Full Name*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>

                        <div class="field input">
                            <input type="email" name="email" placeholder="Email*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>

                        <div class="field input">
                            <input type="text" name="telephone" placeholder="Telephone*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>

                        <div class="field input">
                            <input type="text" name="company_name" placeholder="Company Name*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                        </div>

                        <div class="field input">
                            <input type="url" name="company_website" placeholder="Company Website URL" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;">
                        </div>

                        <div class="field input">
                            <input type="text" name="company_scale" placeholder="Company Scale" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;">
                        </div>

                        <div class="field input">
                            <textarea name="brand_overview" placeholder=" Brand Overview*" rows="4" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required></textarea>
                        </div>

                        <div class="field input">
                            <textarea name="other_comments" placeholder=" Other" rows="8" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;"></textarea>
                        </div>

                        <div class="field">
                            <input class="btn" type="submit" name="submit" value="Submit" required>
                        </div>
                    </form>


                <?php } ?>


            </div>


    </div>











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