<?php
session_start();
echo $_SESSION['user_id'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/contactpage.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

    <!-- Questrial Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

    <style>
            /* General styles */
    body {
        font-family: 'Questrial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    main {
        font-family: 'Questrial', sans-serif;
        margin-left: 100px;
        margin-right: 100px;
    }
    
    h1, h2 {
        color: #333;
        text-align: center;
    }
    
    p {
        color: #555;
        line-height: 1.6;
        text-align: center;
    }
    
    /* FAQ and container buttons */
    button {
        background-color: #ff6200;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    
    .faq{
        margin-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .faq #button-1{
        height: 90px;
        width: 250px;
    }
    
    
    
    button:hover {
        background-color: #ff8d45;
    }
    
    button img {
        width: 30px;
        height: auto;
        margin-top: 10px;
    }
    
    /* Form section */
    form {
        width: 1000px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;  /* Centers the form horizontally */
        margin-bottom: 100px;
    }
    
    input, textarea {
        width: 90%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-top: 8px;
        margin-bottom: 16px;
        resize: vertical;
        font-size: 14px;
    }
    
    input:focus, textarea:focus {
        border-color: #ff6b6b;
        outline: none;
    }
    
    /* Grouping input fields */
    .one, .two {
        display: flex;
        gap: 20px;
    }
    
    .one div, .two div {
        flex: 1;
    }
    
    /* Message textarea */
    textarea {
        height: 150px;
        line-height: 1.5;
    }
    
    /* Submit button */
    .submit {
        text-align: center;
    }
    
    .submit button {
        background-color: #ff6200;
        color: #fff;
        padding: 12px 24px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .submit button:hover {
        background-color: #ff904c;
    }
    
    /* Box shadow for the form and buttons */
    .faq button, .email button, .contact button {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    
    .container {
        justify-content: center;
        display: flex;
        gap: 70px;
        margin-top: 100px;
        margin-bottom: 100px;
    }
    
    
    .container div button {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        text-align: center;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    
    .container div button:hover {
        background-color: #ff873d ;
    }
    
    
    /* Responsive styles */
    @media screen and (max-width: 768px) {
        main {
            margin-left: 20px;
            margin-right: 20px;
        }
    
        form {
            width: 100%;
        }
    
        .container {
            flex-direction: column;
            gap: 10px;
        }
    }
    </style>

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
                    <a href="./cart.php">My Cart</a>
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
        <h1>Get in touch with us</h1>
        <p id="intro">We'd love to hear from you! Feel free to get in touch by filling the form below and we will be happy to help. You can also find answers to some of our most Frequently Asked Questions here.</p>
        <div class="faq">
            <a href="faq.php"><button id="button-1">Frequently Asked Questions</button></a>
        </div>

        <div class="container">
        <div class="email">
            <button>
                <p style="color:white;">Send us an Email if there is any concerns. Our team will help you out.</p>

                <h2>Email us</h2>
            </button>
        </div>

        <div class="contact">
            <button>
                <p style="color:white;">We are waiting for you and your team to reach out. Do not hesitate!</p>

                <h2>Contact us</h2>
            </button>
        </div>
        </div>


        <h2>Send us a message</h2>
        <p id="txt">We will respond within 24 hours</p>

        <div id="form-box">
        <?php
        include("./php/config.php");

        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            if (isset($_POST['submit'])) {
                // Collect form data and insert it into the database (your existing code)

                // Query to get the last Help_ID
                $find = mysqli_query($conn, "SELECT MAX(Help_ID) AS max_id FROM Help");
                $row = mysqli_fetch_assoc($find);

                // Assign help ID
                if ($row['max_id']) {
                    $last_id = $row['max_id'];
                    $last_num = (int)preg_replace("/[^0-9]/", "", $last_id);
                    $num = $last_num + 1;
                    $helpid = 'HELP_' . str_pad($num, 4, '0', STR_PAD_LEFT);
                } else {
                    $helpid = 'HELP_0001';
                }

                // Insert the form data
                $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $subject = mysqli_real_escape_string($conn, $_POST['subject']);
                $message = mysqli_real_escape_string($conn, $_POST['message']);
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

                $query = "INSERT INTO Help (Help_ID, Customer_ID, First_name, Last_name, Email, Subject, Message, Date_created)
                          VALUES ('$helpid', '$user_id', '$first_name', '$last_name', '$email', '$subject', '$message', NOW())";

                if (mysqli_query($conn, $query)) {
                    echo "<div class='successmessage'>
                            <p>Thank you! Your request has been received.</p>
                          </div>";
                } else {
                    echo "<div class='errormessage'>
                            <p>Error: " . mysqli_error($conn) . "</p>
                          </div>";
                }
            } else {
                // Display the form if user is logged in
                ?>
                <form action="" method="POST" id="contact">
                    <div class="one">
                        <div id="first_name">
                            <input type="text" name="first_name" placeholder="First Name" required>
                        </div>
                        <div id="last_name">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="two">
                        <div>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div>
                            <input type="text" name="subject" placeholder="Subject" required>
                        </div>
                    </div>

                    <div class="three">
                        <textarea name="message" cols="104" rows="10" placeholder="Message" required></textarea>
                    </div>

                    <div class="submit">
                        <button type="submit" name="submit">Submit</button> 
                    </div>
                </form>
                <?php
                    }
                } else {
                    // If the user is not logged in, show a message
                    echo "<p>You must <a href='login.php'>log in</a> to submit a request.</p>";
                }
                ?>
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