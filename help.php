<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Centre Page</title>
    <link rel="stylesheet" href="/styles/helpcentre.css">
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
                
                <!-- Dropdown Menu content; links for Login, Logout, and My Orders -->
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Login</a>
                    <a href="#">My Orders</a>
                    <a href="#">Logout</a>
                </div>
            </div>
    
    
        </header>

        <main>

            <div id="heading-1">
                <h2>Hi How Can We Help You?</h2>

            </div>



            <div class="container-1">
                <div class="card">
                    <div class="icon-item">
                        <img src="/images/manage-order.svg" alt="Manage Orders Icon" class="icon">
                        <span>Manage Orders</span>
                    </div>
                    <div class="icon-item">
                        <img src="/images/edit profile.svg" alt="Edit Profile Icon" class="icon">
                        <span>Edit Profile</span>
                    </div>

                </div>
            </div>
            






            <p style="text-align: center; font-family: Questrial, sans-serif; font-size: 15px;">Please fill in the form below and we will get back to you as soon as possible.</p>
            <!--Inquiry Submit Form-->
            <div class="container">


                <?php

                    include("php/config.php");

                    if (isset($_POST['submit'])) {
                        //collect form data

                        $First_name = mysqli_real_escape_string($conn, $_POST['First_name']);
                        $Last_name = mysqli_real_escape_string($conn, $_POST['Last_name']);
                        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $topic = mysqli_real_escape_string($conn, $_POST['topic']);
                        $other_comments = mysqli_real_escape_string($conn, $_POST['other_comments']);

                        //Query to get the last Inquiry ID
                        $find = mysqli_query($conn, "SELECT MAX(Inquiry_ID) AS max_id FROM Inquiries");
                        $row = mysqli_fetch_assoc($find);

                        //Assingin customer ID
                        if ($row['max_id']) {
                            $last_id = $row['max_id'];
                            // Extract numeric part from last ID
                            $last_num = (int)preg_replace("/[^0-9]/", "", $last_id);
                            $num = $last_num + 1; // Increment the numeric part

                            // Generate new customer ID with 'CONSULT_' prefix
                            $customerid = 'INQUIRY_' . str_pad($num, 4, '0', STR_PAD_LEFT);
                        } else {
                            $customerid = 'INQUIRY_0001';
                        }
                        
                        //Insert form data into the database
                        $query = "INSERT INTO Inquiries (Inquiry_ID, First_name, Last_name, Phone_no, Email, Topic, Other_comments)
                                VALUES ('$customerid', '$First_name', '$Last_name', '$telephone', '$email', '$topic', '$other_comments')";

                        if (mysqli_query($conn, $query)) {
                            echo "<div class='successmessage'>
                                    <p style='font-family:Questrial,san-serif; text-align:center; font-size: 40px'>Thank you! Your consultation request has been received. We will get back to you shortly.</p>
                                    <button onclick='goBack()' style='font-family:Questrial,san-serif; font-size: 20px; padding: 10px 20px; background-color: #697565; color: white; border: none; border-radius: 5px; cursor: pointer;'>Go Back</button>
                                </div>";                   } else {
                            echo "<div class="errormessage">
                                    <p>Error: " . mysqli_error($conn) . "</p>
                                    <button onclick='goBack()' style='font-family:Questrial,san-serif; font-size: 20px; padding: 10px 20px; background-color: #697565; color: white; border: none; border-radius: 5px; cursor: pointer;'>Go Back</button>
                                </div>";
                        }
                   
                    }else{

                        ?>

                            <form action="" method="post" class="form-box">
                                        <div class="field input">
                                            <input type="text" name="First_name" placeholder="First Name*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                                        </div>

                                        <div class="field input">
                                            <input type="text" name="Last_name" placeholder="Last Name*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                                        </div>

                                        <div class="field input">
                                            <input type="email" name="email" placeholder="Email*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                                        </div>

                                        <div class="field input">
                                            <input type="text" name="telephone" placeholder="Telephone*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                                        </div>

                                        <div class="field input">
                                            <input type="text" name="topic" placeholder="Subject*" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;" required>
                                        </div>

                                        <div class="field input">
                                            <textarea name="other_comments" placeholder="Please State your problem" rows="8" style="border-radius: 5px; outline: none; font-family:Questrial,san-serif;"></textarea>
                                        </div>

                                        <div class="field">
                                            <input class="btn" type="submit" name="submit" value="Submit" >
                                        </div>
                            </form>


                    <?php}>


            </div>


            <div id="faq-button">
                <a href="faq.html"><button id="faq">Frequently Asked Questions</button></a>
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