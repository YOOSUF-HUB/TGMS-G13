<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- social media icons -->

</head>
<body>
    <!-- Navigation Bar Section-->
    <header style="padding: 8px 20px;">
        <!-- Side Navigation Menu -->
        <nav id="mySidenav" class="sidenav">
            <!-- Close button -->
            <img onclick="closeNav()" src="images/close-google.svg" class="closebtn" style="width: 30px;">
            
            <!-- Navigation links -->
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="productpage.php">Products</a>
            <a href="consultation.php">Consultations</a>
            <a href="contact us page.php">Contact</a>
            <a href="termspage.php">Terms of Services</a>
        </nav>
        <!-- Menu icon (with open function)-->
        <img src="images/menu-google.svg" id="menuIcon" style="width:30px;cursor:pointer" onclick="openNav()">

        <!-- Logo Section -->
        <section class="logo">

            <div class="logo-content">
                <a href="index.php"> <img src="./images/Versori.png" alt="logo" style="height: 50px; padding-right: 90px;"> </a>
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


    <!-- REGISTRATION FORM -->
    <div class="container">
        <div class="form-box">

            <?php

            include("./php/config.php");
            if(isset($_POST['submit'])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Query to get the last Customer_ID
                $find = mysqli_query($conn, "SELECT MAX(Customer_ID) AS max_id FROM Customer_account");
                $row = mysqli_fetch_assoc($find);
                //assigning customer id
                if ($row['max_id']) {
                    $last_id = $row['max_id'];
                    $num = intval(substr($last_id, 1)) + 1; 
                    
                    $customerid = 'C' . str_pad($num, 4, '0', STR_PAD_LEFT); 
                } else {
                    $customerid = 'C1001'; 
                }

                //verifying the unique email
                $verify_query = mysqli_query ($conn, "SELECT Email FROM Customer_account WHERE Email='$email'");
                
                if(mysqli_num_rows($verify_query) != 0){
                    // Email already exists, show error
                    echo "<div class= 'errormessage'>
                            <p>This email is already registered. Please use a different email.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }
                else{

                    $insert_query = "INSERT INTO customer_account (Customer_ID, First_name, Last_name, Email, Password, Date_created) VALUES ('$customerid','$fname', '$lname', '$email', '$password', DEFAULT)";
                    $result = mysqli_query($conn, $insert_query);
                    

                    if($result){
                        echo "<div class= 'successmessage'>
                            <p>Registration Successfully!.</p>
                            </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Login now</button></a>";
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
                    <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                </div>
                
                <div class="field input">
                    <!-- <label for="email">Email</label> -->
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Create" required>
                </div>

                <div class="link">
                    <p>Already have an account? <a href="login.php"> Login</a></p>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    
 

    <!-- Footer Section -->
    <footer>
        
        <div class="footer-links">
            <div class="social-media">
                <a href="index.php"> <img src="./images/Versori.png" alt="logo" style="height: 90px; padding-left: 20px; "> </a>
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
            <p style="font-family:Questrial,sans-serif;">&copy; Versori 2024</p>
        </div>
    </footer>

    
    
   


    <script src="./index.js"></script>
</body>
</html>