<?php
session_start();
//echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Textile and Garment Management System</title>
    <link rel="stylesheet" href="styles/terms.css">
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



    <main id="content">

        <h4 id="tc">Terms and Conditions</h4>

        <p style="text-align: center;">Welcome to Versori. By accesing or using our website and services you agree to be bound by the following terms and conditions. Please read them carefully.</p>
        <ol style="list-style-type: square; font-size: 1rem;">

            <li>
                <h6>Acceptance of terms</h6>
                <ul>
                    <li>
                        <p>By registering, accessing, or using the services provided by Versori, you acknowledge that you have read, understood, and agreed to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree to these terms, please refrain from using our services.</p>
                    </li>
                </ul>
            </li>        

            <li>
                <h6>Eligibility</h6>
                <ul>
                    <li>
                        <p>Be at least 18 years old or have parental consent to use the services </p>
                    </li>
                    <li>
                        <p>Provide accurate, current, and complete information during registration and maintain the accuracy of such information.</p>
                    </li>
                </ul>
            </li>

            <li>
                <h6>User Accounts</h6>
                <ul>
                    <li>
                        <p>Account Creation: To access certain features of Versori, you will need to create an account. You are responsible for maintaining the confidentiality of your login information and for all activities under your account.
                        </p>
                    </li>
                    <li>
                        <p>
                            Account Termination: We reserve the right to suspend or terminate your account if you violate these Terms or engage in fraudulent or illegal activities.
                        </p>
                        
                    </li>
                </ul>
            </li>

            <li>
                <h6>Use of the Services</h6>
                <p> You agree to use Versori's services only for lawful purposes. You are prohibited from:</p>
                <ul>
                    <li>
                        <p> Interfering with the functionality of our services or trying to access unauthorized areas of the platform</p>
                    </li>
                    <li>
                        <p> Submitting false, misleading, or inappropriate information</p>
                    </li>
                </ul>
            </li>
            
            <li>
                <h6>Intellectual Property</h6>
                <ul>
                    <li>
                        <p>Ownership: All content, including but not limited to text, graphics, logos, icons, and software on the Versori platform, are the exclusive property of Versori or its licensors.</p>
                    </li>
                    <li>
                        <p>Restrictions: You may not copy, modify, distribute, sell, or lease any part of our services or software without explicit permission from Versori.</p>
                    </li>
                </ul>
            </li>

            <li>
                <h6>Orders and Transactions</h6>
                <ul>
                    <li>
                        <p>Order Processing: All orders placed through Versori are subject to acceptance and availability. We reserve the right to cancel or refuse orders if there is a technical issue or pricing error.</p>
                    </li>
                    <li>
                        <p>Payments: You agree to provide valid and accurate payment information for transactions made on our platform. All payments are processed through secure third-party gateways, and we are not responsible for any issues arising from these external services.</p>
                    </li>
                </ul>
            </li>

            <li>
                <h6>Data Protection</h6>
                <ul>
                        <p>Your personal data is collected and processed in accordance with our Privacy Policy. We are committed to ensuring that your information is secure and will not share it with third parties except as outlined in the Privacy Policy.</p>
                </ul>
            </li>

            <li>
                <h6>Service Availability</h6>
                <ul>
                    <li>
                        <p>Service Interruptions: While we strive to provide continuous access to Versori services, there may be occasional downtime for maintenance, updates, or technical issues. Versori is not liable for any losses caused by such interruptions</p>
                    </li>
                    <li>
                        <p>Modifications: Versori reserves the right to modify or discontinue any of its services or features at any time without prior notice</p>
                    </li>
                </ul>
            </li>

            <li>
                <h6>Limitation of Liability</h6>
                <p>To the maximum extent permitted by law:</p>
                <ul>
                    <li>
                        <p>Versori is not liable for any indirect, incidental, special, or consequential damages arising from your use of our services.</p>
                    </li>
                    <li>
                        <p>We do not guarantee that our services will be error-free, secure, or free from harmful components.</p>
                    </li>
                </ul>
            </li>

            <li>
                <h6>Indemnification</h6>
                    <p>You agree to indemnify and hold harmless Versori, its affiliates, employees, and agents from any claims, liabilities, damages, and expenses arising out of your violation of these Terms or misuse of our services.</p>
            </li>

            <li>
                <h6>Termination of Access</h6>
                    <p>We reserve the right to suspend or terminate your access to Versori's services at our sole discretion for any breach of these Terms and Conditions. Upon termination, your right to use the services will cease immediately.</p>
            </li>

            <li>
                <h6>Governing Law</h6>
                    <p>These Terms and Conditions are governed by and construed in accordance with the laws of the country, without regard to its conflict of law principles. You agree to submit to the exclusive jurisdiction of the courts of Sri Lanka.</p>
            </li>

            <li>
                <h6>Amendments</h6>
                <p>Versori reserves the right to modify these Terms and Conditions at any time. Changes will be posted on our website and will take effect upon posting. Your continued use of our services constitutes acceptance of the modified terms.</p>
            </li>
        </ol>

        <div id="terms-end">
            <p>If you have any questions or concerns about these Terms and Conditions, <a href="contact.php" id="contact-terms">Please Contact us</a></p>
        </div>

    </main>

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


    <script src="index.js"></script>
</body>
</html>