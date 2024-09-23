<?php

session_start();
include("./php/config.php");

if (isset($_POST['login'])) {
    // Fetch form data
    $input_username = mysqli_real_escape_string($conn, $_POST['username']);
    $input_password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query to check the email and password
    $login_query = "SELECT * FROM users WHERE username='$input_username' AND password='$input_password'";
    $result = mysqli_query($conn, $login_query); //excute query
    $row = mysqli_fetch_assoc($result);

    

    

    // Check if user exists and verify password
    if (is_array($row) && !empty($row)) {
        $_SESSION['valid'] = $row['username'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; 


    } else {
        // If login fails, display error message
        $error_message = "Wrong Username or Password";
    }

    if(isset($_SESSION['valid'])){
        // Redirect based on role
        switch ($row['role']) {
            case 'admin':
                header("Location: admindashboard.php");
                break;
            case 'inventory':
                header("Location: inventorydashboard.php");
                break;
            case 'support':
                header("Location: customerdashboard.php");
                break;
            
        }
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Login</title>
    <link rel="stylesheet" href="./companyside.css">
    
</head>
<body>
    <header>
        <div class="top-container">
            <div class="logo-notification" >
                <div class="logo-content">
                    <a href="Index.html"> <img src="./images/versori 2.png" alt="logo" > </a>
                </div>
            
                <div class="notification">
                    <i class="fa fa-bell" style="font-size:30px"></i>
                </div>
            </div>

            <div class="title">
                <h1>Admin</h1>
            </div>

            <div class="profile-container" >
                
            </div>

            


            
        </div>
    </header>

    <div class="container">
        <div class="form-box">

            <?php if (isset($error_message)): ?>
                <div class="errormessage">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>


            <h3>Admin Login</h3>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="field input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="login" value="Login" required>
                    <!-- <button type="submit" name="login">Login</button> -->
                </div>

                
            </form>
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
</body>
</html>