<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff Account</title>
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

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


    <!-- REGISTRATION FORM -->
    <div class="container">
        <div class="form-box">

            <?php

            include("php/config.php");
            if(isset($_POST['submit'])){
                $fname = $_POST['fname'];
                $username = $_POST['username'];
                $staff_role = $_POST['staff_role'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Query to get the last Customer_ID
                $find = mysqli_query($conn, "SELECT MAX(Staff_ID) AS max_id FROM Staff_account");
                $row = mysqli_fetch_assoc($find);
                //assigning customer id
                if ($row['max_id']) {
                    $last_id = $row['max_id'];
                    $num = intval(substr($last_id, 1)) + 1; 
                    
                    $customerid = 'STF' . str_pad($num, 4, '0', STR_PAD_LEFT); 
                } else {
                    $customerid = 'STF0001'; 
                }

                //verifying the unique email
                $verify_query = mysqli_query ($conn, "SELECT Email FROM Staff_account WHERE Email='$email'");
                
                if(mysqli_num_rows($verify_query) != 0){
                    // Email already exists, show error
                    echo "<div class= 'errormessage'>
                            <p>This email is already registered. Please use a different email.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }
                else{

                    $insert_query = "INSERT INTO Staff_account (Staff_ID, Full_name, username, staff_role, Email, Password) VALUES ('$customerid','$fname', '$username', '$staff_role' , '$email', '$password')";
                    $result = mysqli_query($conn, $insert_query);
                    

                    if($result){
                        echo "<div class= 'successmessage'>
                            <p>Registration Successfully!.</p>
                            </div> <br>";
                        echo "<a href='adminlogin.php'><button class='btn'>Login now</button></a>";
                    }else{
                        echo "<div class= 'errormessage'>
                            <p>This email is already registered. Please use a different email.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                    }

                    
                }
            }else{

            

            ?>
            <h3>Create Account</h3>
            <form action="" method="post">
                <div class="field input">
                    <!-- <label for="fname">First Name</label> -->
                    <input type="text" name="fname" id="fname" placeholder="First Name" required>
                </div>

                <div class="field input">
                    <!-- <label for="lname">Last Name</label> -->
                    <input type="text" name="username" id="username" placeholder="User Name" required>
                </div>
                
                <div class="field input">
                    <!-- <label for="email">Email</label> -->
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="email">Email</label> -->
                    <input type="text" name="staff_role" id="staff_role" placeholder="Permission" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Create" required>
                </div>

            </form>
        </div>
        <?php } ?>
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
                    <li style="font-weight: bolder; font-size: 1.5rem;">Versori</li>
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

    
    
   


    <script src="Index.js"></script>
</body>
</html>